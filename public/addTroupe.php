<?php
declare(strict_types=1);

require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/../inc/Header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post = $_POST;
    $name = $post['name'] ?? null;

    if ($name !== null) {
        $troupe = new Troupe(0, $name);
        TroupeBDD::addTroupe($troupe);
        header("Location: index.php");
        exit;
    }
    header("Location: addTroupe.php");
    exit;
}

?>

<div class="w-1/5 mx-auto">
    <h2 class="collapse-title font-semibold ">Ajouter une troupe</h2>

    <form method="post" action="" class="space-y-4">
        <label class="floating-label">
            <span>Nom</span>
            <input id="name" name="name" type="text" placeholder="Nom de la troupe" class="input input-bordered w-full" />
        </label>

        <button type="submit" class="btn btn-block  btn-neutral">Ajouter la troupe</button>

    </form>
</div>

<?php require __DIR__ . '/../inc/Footer.php'; ?>
