<?php
declare(strict_types=1);

require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/../inc/Header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $actor_id = $_POST['actor_id'] ?? null;
    $troupe_id = $_POST['troupe_id'] ?? null;
    $role = $_POST['role'] ?? null;

    if ($actor_id !== null && $troupe_id !== null && $role !== null) {
        $actor = ActorBDD::getActor((int) $actor_id);
        $troupe = TroupeBDD::getTroupe((int) $troupe_id);
        $role = RoleActor::tryFromName($role);
        ActorHasTroupeBDD::addActorHasTroupe(new ActorHasTroupe($actor, $troupe, $role));
        header("Location: index.php");
        exit;
    }
    header("Location: addActorHasTroupe.php");
    exit;
}

$actors = ActorBDD::getAllActors();
$troupes = TroupeBDD::getAllTroupes();
?>

<div class="w-1/5 mx-auto">
    <h2 class="collapse-title font-semibold ">Associer un acteur à une troupe</h2>

    <form method="post" action="" class="space-y-4">
        <label class="floating-label">
            <span>Acteur</span>
            <select id="actor_id" name="actor_id" class="select">
                <option value="null" disabled selected>Choisir un acteur</option>
                <?php 
                foreach ($actors as $actor) { 
                ?>
                    <option value="<?= $actor->getId() ?>">
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
                <option value="" disabled selected>Choisir une troupe</option>
                <?php 
                foreach ($troupes as $troupe) {
                ?>
                    <option value="<?= $troupe->getId() ?>">
                        <?= htmlspecialchars($troupe->getName()) ?>
                    </option>
                <?php 
                } 
                ?>
            </select>
        </label>

        <label class="floating-label">
            <span>Rôle</span>
            <select id="role" name="role" class="select" required>
                <option value="" disabled selected>Choisir un rôle</option>
                <?php foreach (RoleActor::cases() as $case): ?>
                    <option value="<?= htmlspecialchars($case->name) ?>">
                        <?= htmlspecialchars($case->value) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>

        <button type="submit" class="btn btn-block  btn-neutral">Associer l'acteur </button>
    </form>
</div>

<?php require __DIR__ . '/../inc/Footer.php'; ?>
