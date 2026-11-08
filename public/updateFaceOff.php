<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

$id = filter_var($_GET['id'] ?? '', FILTER_VALIDATE_INT);
if ($id === false || $id <= 0) {
    header('Location: index.php');
    exit;
}

$faceOff = FaceOffBDD::getFaceOff($id);
$troupeId = $faceOff->getTroupe()->getId();
$opponentId = $faceOff->getOpposingClub()->getId();
$troupeScore = $faceOff->getTroupeScore();
$opponentScore = $faceOff->getOpponentScore();
$city = $faceOff->getCity();
$date = $faceOff->getDate()->format('Y-m-d');
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete') {
    try {
        FaceOffBDD::deleteFaceOff($id);
        header('Location: index.php');
        exit;
    } catch (Exception $e) {
        $errors[] = 'Erreur lors de la suppression du battle : '.$e->getMessage();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $troupeId = filter_var($_POST['troupe_id'] ?? '', FILTER_VALIDATE_INT);
    $opponentId = filter_var($_POST['opponent_id'] ?? '', FILTER_VALIDATE_INT);
    $troupeScore = filter_var($_POST['troupe_score'] ?? '', FILTER_VALIDATE_INT);
    $opponentScore = filter_var($_POST['opponent_score'] ?? '', FILTER_VALIDATE_INT);
    $city = trim($_POST['city'] ?? '');
    $date = trim($_POST['date'] ?? '');

    if ($troupeId === false || $troupeId <= 0) {
        $errors[] = 'Il faut choisir la troupe du club.';
    }
    if ($opponentId === false || $opponentId <= 0) {
        $errors[] = 'Il faut choisir la troupe opposée.';
    }
    if ($troupeScore === false || $troupeScore < 0) {
        $errors[] = 'Le score de la troupe est invalide.';
    }
    if ($opponentScore === false || $opponentScore < 0) {
        $errors[] = "Le score de l'adversaire est invalide.";
    }
    if ($city === '') {
        $errors[] = 'La ville est obligatoire.';
    }
    $battleDate = DateTime::createFromFormat('Y-m-d', $date);
    if ($date === '' || $battleDate === false || $battleDate->format('Y-m-d') !== $date) {
        $errors[] = 'La date du battle est invalide.';
    }

    if ($errors === [] && $battleDate !== false && $troupeId !== false && $opponentId !== false && $troupeScore !== false && $opponentScore !== false) {
        try {
            $updatedFaceOff = new FaceOff(
                $id,
                $troupeScore,
                $opponentScore,
                $battleDate,
                TroupeBDD::getTroupe($troupeId),
                $city,
                TroupeOpposeeBDD::getTroupeOpposee($opponentId)
            );
            FaceOffBDD::updateFaceOff($updatedFaceOff);
            header('Location: index.php');
            exit;
        } catch (Exception $e) {
            $errors[] = 'Erreur lors de la modification du battle : '.$e->getMessage();
        }
    }
}

$troupes = TroupeBDD::getAllTroupes();
$troupesOpposees = TroupeOpposeeBDD::getAllTroupesOpposees();
require_once __DIR__.'/../src/template/Header.php';
?>
<div class="w-2/5 mx-auto">
    <h2 class="collapse-title font-semibold">Modifier un battle</h2>
    <?php if ($errors !== []): ?>
        <ul class="list-disc text-error px-6 mb-4">
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <form method="post" class="space-y-4">
        <select id="troupe_id" name="troupe_id" class="select select-bordered w-full" required>
            <?php foreach ($troupes as $troupe): ?>
                <option value="<?= $troupe->getId() ?>" <?= $troupeId === $troupe->getId() ? 'selected' : '' ?>><?= htmlspecialchars($troupe->getName(), ENT_QUOTES, 'UTF-8') ?></option>
            <?php endforeach; ?>
        </select>
        <select id="opponent_id" name="opponent_id" class="select select-bordered w-full" required>
            <?php foreach ($troupesOpposees as $opposingClub): ?>
                <option value="<?= $opposingClub->getId() ?>" <?= $opponentId === $opposingClub->getId() ? 'selected' : '' ?>><?= htmlspecialchars($opposingClub->getAddress().' ('.$opposingClub->getCity().')', ENT_QUOTES, 'UTF-8') ?></option>
            <?php endforeach; ?>
        </select>
        <label class="input input-bordered w-full">
            <span class="label">Date du battle</span>
            <input id="date" name="date" type="date" value="<?= htmlspecialchars($date, ENT_QUOTES, 'UTF-8') ?>" required>
        </label>
        <label class="floating-label">
            <span>Ville</span>
            <input id="city" name="city" type="text" class="input input-bordered w-full" value="<?= htmlspecialchars($city, ENT_QUOTES, 'UTF-8') ?>" required>
        </label>
        <div class="flex gap-4">
            <label class="floating-label w-1/2">
                <span>Score de la troupe</span>
                <input id="troupe_score" name="troupe_score" type="number" min="0" step="1" value="<?= htmlspecialchars((string) $troupeScore, ENT_QUOTES, 'UTF-8') ?>" class="input input-bordered w-full" required>
            </label>
            <label class="floating-label w-1/2">
                <span>Score de l'adversaire</span>
                <input id="opponent_score" name="opponent_score" type="number" min="0" step="1" value="<?= htmlspecialchars((string) $opponentScore, ENT_QUOTES, 'UTF-8') ?>" class="input input-bordered w-full" required>
            </label>
        </div>
        <button type="submit" class="btn btn-block btn-neutral">Enregistrer</button>
        <button type="submit" name="action" value="delete" formnovalidate class="btn btn-block btn-error" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce battle ?');">Supprimer le battle</button>
    </form>
</div>
<?php require __DIR__.'/../src/template/Footer.php'; ?>
