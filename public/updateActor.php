<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../inc/Header.php';

$id = (int) ($_GET['id'] ?? 0);
$actor = ActorBDD::getActor($id) ?? null;

if ($actor === null) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $birth_date = $_POST['birth_date'] ?? '';
    $picture = trim($_POST['picture'] ?? '');

    if ($first_name !== null && $last_name !== null && $birth_date !== null) {
        $newActor = new Actor($actor->getId(),$first_name,$last_name,new DateTime($birth_date),$picture);
        ActorBDD::updateActor($newActor);
        header("Location: index.php");
        exit;
    }
    header("Location: updateActor.php?id=" . $id);
    exit;
}

?>

<div class="w-1/5 mx-auto">
    <h2 class="collapse-title font-semibold ">Modifier un acteur</h2>

    <form method="post" action="" class="space-y-4">
        <label class="floating-label">
            <span>Prénom</span>
            <input id="first_name" name="first_name" type="text" placeholder="Prénom" class="input input-bordered w-full" value="<?= htmlspecialchars($actor->getFirstName()) ?>" />
        </label>

        <label class="floating-label">
            <span>Nom</span>
            <input id="last_name" name="last_name" type="text" placeholder="Nom" class="input input-bordered w-full" value="<?= htmlspecialchars($actor->getLastName()) ?>"/>
        </label>

        <label class="input input-bordered w-full">
            <span class="label">Date de naissance</span>
            <input id="birth_date" name="birth_date" type="date" value="<?= $actor->getBirthDate()->format('Y-m-d') ?>"/>
        </label>

        <label class="floating-label">
            <span>Photo</span>
            <input id="picture" name="picture" type="text" placeholder="URL de la photo (facultatif)" class="input input-bordered w-full" value="<?= htmlspecialchars($actor->getPicture() ?? '') ?>"/>
        </label>

        <button type="submit" class="btn btn-block  btn-neutral">Modifier l'acteur</button>
    </form>
</div>

<?php require __DIR__ . '/../inc/Footer.php'; ?>
