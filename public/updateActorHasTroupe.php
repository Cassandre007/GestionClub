<?php
declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/template/Header.php';

$old_actor_id = (int) ($_GET['actor_id'] ?? 0);
$old_troupe_id = (int) ($_GET['troupe_id'] ?? 0);

$association = ActorHasTroupeBDD::getActorHasTroupe($old_actor_id, $old_troupe_id) ?? null;

if ($association === null) {
    header('Location: index.php');
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete') {
    try {
        ActorHasTroupeBDD::deleteActorHasTroupe($old_actor_id, $old_troupe_id);
        header('Location: index.php');
        exit;
    } catch (Exception $e) {
        $errors[] = "Erreur lors de la suppression de l'association : ".$e->getMessage();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role = RoleActor::tryFromName((string) ($_POST['role'] ?? ''));
    $actor_id = $_POST['actor_id'] ?? null;
    $troupe_id = $_POST['troupe_id'] ?? null;
    if ($role !== null && $actor_id !== null && $troupe_id !== null) {
        $newActorHasTroupe = new ActorHasTroupe(
            ActorBDD::getActor((int) $actor_id),
            TroupeBDD::getTroupe((int) $troupe_id),
            $role
        );
        ActorHasTroupeBDD::updateActorHasTroupe($old_actor_id, $old_troupe_id, $newActorHasTroupe);
        header('Location: index.php');
        exit;
    }
    header('Location: updateActorHasTroupe.php?troupe_id='.$old_troupe_id.'&actor_id='.$old_actor_id);
    exit;
}

$actors = ActorBDD::getAllActors();
$troupes = TroupeBDD::getAllTroupes();
$oldRole = $association->getRole();
?>

<div class="w-1/5 mx-auto">
    <h2 class="collapse-title font-semibold ">Modifier l'association</h2>
    <?php if ($errors !== []): ?>
        <div class="alert alert-error" role="alert">
            <?php foreach ($errors as $error): ?>
                <p><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <form method="post" action="" class="space-y-4">
        <label class="floating-label">
            <span>Acteur</span>
            <select id="actor_id" name="actor_id" class="select">
                <?php
                foreach ($actors as $actor) {
                    ?>
                    <option value="<?= $actor->getId() ?>" <?= $actor->getId() === $association->getActor()->getId() ? 'selected' : '' ?>>
                        <?= htmlspecialchars($actor->getFirstName().' '.$actor->getLastName()) ?>
                    </option>
                <?php
                }
?>
            </select>
        </label>
 
        <label class="floating-label">
            <span>Troupe</span>
            <select id="troupe_id" name="troupe_id" class="select" required>
                <?php foreach ($troupes as $troupe) { ?>
                    <option value="<?= $troupe->getId() ?>" <?= $troupe->getId() === $association->getTroupe()->getId() ? 'selected' : '' ?>>
                        <?= htmlspecialchars($troupe->getName()) ?>
                    </option>
                <?php } ?>
            </select>
        </label>

        <label class="floating-label">
            <span>Rôle</span>
            <select id="role" name="role" class="select" required>
                <?php foreach (RoleActor::cases() as $case): ?>
                    <option value="<?= htmlspecialchars($case->name) ?>" <?= $case === $oldRole ? 'selected' : '' ?>>
                        <?= htmlspecialchars($case->value) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>

        <button type="submit" class="btn btn-block  btn-neutral">Modifier le rôle</button>
        <button type="submit" name="action" value="delete" formnovalidate class="btn btn-block btn-error" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet acteur de cette troupe ?');">Supprimer l'association</button>
    </form>
</div>

<?php require __DIR__.'/../src/template/Footer.php'; ?>