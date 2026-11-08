<?php
declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/template/Header.php';

$id = (int) ($_GET['id'] ?? 0);
$actor = ActorBDD::getActor($id) ?? null;

if ($actor === null) {
    header('Location: index.php');
    exit;
}

$errors = [];
$first_name = $actor->getFirstName();
$last_name = $actor->getLastName();
$birth_date = $actor->getBirthDate()->format('Y-m-d');
$picture = $actor->getPicture();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete') {
    try {
        ActorBDD::deleteActor($actor->getId());
        header('Location: index.php');
        exit;
    } catch (Exception $e) {
        $errors[] = "Erreur lors de la suppression de l'acteur : ".$e->getMessage();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $birth_date = trim($_POST['birth_date'] ?? '');
    $picture = trim($_POST['picture'] ?? '');

    if ($first_name === '') {
        $errors[] = 'Le prénom est obligatoire.';
    }
    if ($last_name === '') {
        $errors[] = 'Le nom est obligatoire.';
    }
    $birthDate = DateTime::createFromFormat('Y-m-d', $birth_date);
    if ($birth_date === '' || $birthDate === false || $birthDate->format('Y-m-d') !== $birth_date) {
        $errors[] = 'La date de naissance est invalide.';
    } elseif ($birth_date > (new DateTimeImmutable('today'))->format('Y-m-d')) {
        $errors[] = 'La date de naissance ne peut pas être dans le futur.';
    }
    if ($first_name !== '' && $last_name !== '' && ActorBDD::hasHomonym($first_name, $last_name, $actor->getId())) {
        $errors[] = 'Un autre acteur porte déjà ce prénom et ce nom.';
    }

    if ($errors === [] && $birthDate !== false) {
        $newActor = new Actor($actor->getId(), $first_name, $last_name, $birthDate, $picture);
        ActorBDD::updateActor($newActor);
        header('Location: index.php');
        exit;
    }
}

?>

<div class="w-1/5 mx-auto">
    <h2 class="collapse-title font-semibold ">Modifier un acteur</h2>

    <?php if ($errors !== []): ?>
        <div class="alert alert-error" role="alert">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" action="" class="space-y-4">
        <label class="floating-label">
            <span>Prénom</span>
            <input id="first_name" name="first_name" type="text" placeholder="Prénom" class="input input-bordered w-full" value="<?= htmlspecialchars($first_name, ENT_QUOTES, 'UTF-8') ?>" required />
        </label>

        <label class="floating-label">
            <span>Nom</span>
            <input id="last_name" name="last_name" type="text" placeholder="Nom" class="input input-bordered w-full" value="<?= htmlspecialchars($last_name, ENT_QUOTES, 'UTF-8') ?>" required/>
        </label>

        <label class="input input-bordered w-full">
            <span class="label">Date de naissance</span>
            <input id="birth_date" name="birth_date" type="date" value="<?= htmlspecialchars($birth_date, ENT_QUOTES, 'UTF-8') ?>" required/>
        </label>

        <label class="floating-label">
            <span>Photo</span>
            <input id="picture" name="picture" type="text" placeholder="URL de la photo (facultatif)" class="input input-bordered w-full" value="<?= htmlspecialchars($picture, ENT_QUOTES, 'UTF-8') ?>"/>
        </label>

        <button type="submit" class="btn btn-block  btn-neutral">Modifier l'acteur</button>
        <button type="submit" name="action" value="delete" formnovalidate class="btn btn-block btn-error" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet acteur ?');">Supprimer l'acteur</button>
    </form>
</div>

<?php require __DIR__.'/../src/template/Footer.php'; ?>
