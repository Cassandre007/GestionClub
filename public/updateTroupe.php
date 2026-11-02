<?php
declare(strict_types=1);

require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/../inc/Header.php';

$id = (int) ($_GET['id'] ?? 0);
$troupe = TroupeBDD::getTroupe($id) ?? null;

if ($troupe === null) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? null;

    if ($name !== null) {
        $newTroupe = new Troupe($troupe->getId(), $name);
        TroupeBDD::updateTroupe($newTroupe);
        header("Location: index.php");
        exit;
    }
    header("Location: updateTroupe.php?id=" . $id);
    exit;
}

?>

<div class="w-1/5 mx-auto">
    <h2 class="collapse-title font-semibold ">Modifier une troupe</h2>
    <form method="post" action="" class="space-y-4">
        <label class="floating-label">
            <span>Nom</span>
            <input id="name" name="name" type="text" placeholder="Nom de la troupe" class="input input-bordered w-full" value="<?= htmlspecialchars($troupe->getName()) ?>"/>
        </label>
        <button type="submit" class="btn btn-block btn-neutral">Modifier la troupe</button>
    </form>
</div>

<?php require __DIR__ . '/../inc/Footer.php'; ?>