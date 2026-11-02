<?php
declare(strict_types=1);

require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/../inc/Header.php';

$old_actor_id = (int) ($_GET['actor_id'] ?? 0);
$old_troupe_id = (int) ($_GET['troupe_id'] ?? 0);

$association = ActorHasTroupeBDD::getActorHasTroupe($old_actor_id, $old_troupe_id) ?? null;

if ($association === null) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role = RoleActor::tryFromName($_POST['role'] ?? null);
    $actor_id = $_POST['actor_id'] ?? null;
    $troupe_id = $_POST['troupe_id'] ?? null;
    if ($role !== null && $actor_id !== null && $troupe_id !== null) {
        $newActorHasTroupe = new ActorHasTroupe($actor_id, $troupe_id, $role);
        ActorHasTroupeBDD::updateActorHasTroupe($old_actor_id, $old_troupe_id, $newActorHasTroupe);
        header("Location: index.php");
        exit;
    }
    header("Location: updateActorHasTroupe.php?troupe_id=" . $old_troupe_id . "&actor_id=" . $old_actor_id);
    exit;
}

$actors = ActorBDD::getAllActors();
$troupes = TroupeBDD::getAllTroupes();
$oldRole = $association->getRole();
?>

<div class="w-1/5 mx-auto">
    <h2 class="collapse-title font-semibold ">Modifier l'association</h2>
    <form method="post" action="" class="space-y-4">
        <label class="floating-label">
            <span>Acteur</span>
            <select id="actor_id" name="actor_id" class="select">
                <?php 
                foreach ($actors as $actor) { 
                ?>
                    <option value="<?= $actor->getId() ?>" <?= $actor->getId() === $association->getActor()->getId() ? 'selected' : '' ?>>
                        <?= htmlspecialchars($actor->getFirstName() . ' ' . $actor->getLastName()) ?>
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
    </form>
</div>

<?php require __DIR__ . '/../inc/Footer.php'; ?>