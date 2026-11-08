<?php
declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/template/Header.php';

$id = (int) ($_GET['id'] ?? 0);
$troupe = TroupeBDD::getTroupe($id) ?? null;

if ($troupe === null) {
    header('Location: index.php');
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete') {
    try {
        TroupeBDD::deleteTroupe($troupe->getId());
        header('Location: index.php');
        exit;
    } catch (Exception $e) {
        $errors[] = $e->getMessage();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? null;

    if ($name !== null) {
        $newTroupe = new Troupe($troupe->getId(), $name);
        TroupeBDD::updateTroupe($newTroupe);
        header('Location: index.php');
        exit;
    }
    header('Location: updateTroupe.php?id='.$id);
    exit;
}

?>

<div class="w-1/5 mx-auto">
    <h2 class="collapse-title font-semibold ">Modifier une troupe</h2>
    <?php if ($errors !== []): ?>
        <div class="alert alert-error" role="alert">
            <?php foreach ($errors as $error): ?>
                <p><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <form method="post" action="" class="space-y-4">
        <label class="floating-label">
            <span>Nom</span>
            <input id="name" name="name" type="text" placeholder="Nom de la troupe" class="input input-bordered w-full" value="<?= htmlspecialchars($troupe->getName()) ?>"/>
        </label>
        <button type="submit" class="btn btn-block btn-neutral">Modifier la troupe</button>
        <button type="submit" name="action" value="delete" formnovalidate class="btn btn-block btn-error" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette troupe ?');">Supprimer la troupe</button>
    </form>
</div>

<?php require __DIR__.'/../src/template/Footer.php'; ?>