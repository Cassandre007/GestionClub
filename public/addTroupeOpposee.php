<?php
declare(strict_types=1);

require_once __DIR__ . '/../inc/repository/ActorBDD.php';
require_once __DIR__ . '/../inc/class/Database.php';
require_once __DIR__ . '/../inc/Header.php';

$pdo = Database::connexionBdd();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post = $_POST;
    $first_name = $post['first_name'] ?? null;
    $last_name = $post['last_name'] ?? null;
    $birth_date = $post['birth_date'] ?? null;
    $picture = $post['picture'] ?? null;

    if ($prenom !== null && $nom !== null && $date_naissance !== null) {
        $actor = new Actor($first_name, $last_name, new DateTime($birth_date), $picture );
        $actorManager->addActor($actor);
        header("Location: index.php");
        exit;
    }
    header("Location: addActor.php");
    exit;
}

?>

<div class="w-1/5 mx-auto">
    <h2 class="collapse-title font-semibold ">Ajouter un acteur</h2>

    <form method="post" action="" class="space-y-4">
        <label class="floating-label">
            <span>Prénom</span>
            <input id="first_name" name="first_name" type="text" placeholder="Prénom" class="input input-bordered w-full" />
        </label>

        <label class="floating-label">
            <span>Nom</span>
            <input id="last_name" name="last_name" type="text" placeholder="Nom" class="input input-bordered w-full" />
        </label>

        <label class="input input-bordered w-full">
            <span class="label">Date de naissance</span>
            <input id="birth_date" name="birth_date" type="date" />
        </label>

        <label class="floating-label">
            <span>Photo</span>
            <input id="picture" name="picture" type="text" placeholder="URL de la photo (facultatif)" class="input input-bordered w-full" />
        </label>

        <button type="submit" class="btn btn-block  btn-neutral">Ajouter l'acteur </button>

    </form>
</div>

<?php require __DIR__ . '/../inc/Footer.php'; ?>
