<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

$id = filter_var($_GET['id'] ?? '', FILTER_VALIDATE_INT);
if ($id === false || $id <= 0) {
    header('Location: index.php');
    exit;
}

$troupeOpposee = TroupeOpposeeBDD::getTroupeOpposee($id);
$address = $troupeOpposee->getAddress();
$city = $troupeOpposee->getCity();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete') {
    try {
        TroupeOpposeeBDD::deleteTroupeOpposee($id);
        header('Location: index.php');
        exit;
    } catch (Exception $e) {
        $errors[] = 'Erreur lors de la suppression de la troupe opposée : '.$e->getMessage();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $address = trim($_POST['address'] ?? '');
    $city = trim($_POST['city'] ?? '');

    if ($address === '') {
        $errors[] = "L'adresse est obligatoire.";
    }
    if ($city === '') {
        $errors[] = 'La ville est obligatoire.';
    }

    if ($errors === []) {
        try {
            TroupeOpposeeBDD::updateTroupeOpposee(new TroupeOpposee($id, $address, $city));
            header('Location: index.php');
            exit;
        } catch (Exception $e) {
            $errors[] = 'Erreur lors de la modification de la troupe opposée : '.$e->getMessage();
        }
    }
}

require_once __DIR__.'/../src/template/Header.php';
?>
<div class="w-1/5 mx-auto">
    <h2 class="collapse-title font-semibold">Modifier une troupe opposée</h2>
    <?php if ($errors !== []): ?>
        <ul class="list-disc text-error px-6 mb-4">
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <form method="post" class="space-y-4">
        <label class="floating-label">
            <span>Adresse</span>
            <input id="address" name="address" type="text" class="input input-bordered w-full" value="<?= htmlspecialchars($address, ENT_QUOTES, 'UTF-8') ?>" required>
        </label>
        <label class="floating-label">
            <span>Ville</span>
            <input id="city" name="city" type="text" class="input input-bordered w-full" value="<?= htmlspecialchars($city, ENT_QUOTES, 'UTF-8') ?>" required>
        </label>
        <button type="submit" class="btn btn-block btn-neutral">Enregistrer</button>
        <button type="submit" name="action" value="delete" formnovalidate class="btn btn-block btn-error" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette troupe opposée ?');">Supprimer la troupe opposée</button>
    </form>
</div>
<?php require __DIR__.'/../src/template/Footer.php'; ?>
