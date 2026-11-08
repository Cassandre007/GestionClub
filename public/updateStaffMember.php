<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

$id = filter_var($_GET['id'] ?? '', FILTER_VALIDATE_INT);
if ($id === false || $id <= 0) {
    header('Location: index.php');
    exit;
}

$staffMember = StaffMembersBDD::getStaffMember($id);
$firstName = $staffMember->getFirstName();
$lastName = $staffMember->getLastName();
$picture = $staffMember->getPicture();
$role = $staffMember->getRole();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete') {
    try {
        StaffMembersBDD::deleteStaffMember($id);
        header('Location: index.php');
        exit;
    } catch (Exception $e) {
        $errors[] = 'Erreur lors de la suppression du membre du staff : '.$e->getMessage();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = trim($_POST['first_name'] ?? '');
    $lastName = trim($_POST['last_name'] ?? '');
    $picture = trim($_POST['picture'] ?? '');
    $role = RoleStaff::tryFrom((string) ($_POST['role'] ?? ''));

    if ($firstName === '') {
        $errors[] = 'Le prénom est obligatoire.';
    }
    if ($lastName === '') {
        $errors[] = 'Le nom est obligatoire.';
    }
    if ($role === null) {
        $errors[] = 'Le rôle est invalide.';
    }

    if ($errors === [] && $role !== null) {
        try {
            StaffMembersBDD::updateStaffMember(new StaffMember($id, $firstName, $lastName, $picture, $role));
            header('Location: index.php');
            exit;
        } catch (Exception $e) {
            $errors[] = 'Erreur lors de la modification du membre du staff : '.$e->getMessage();
        }
    }
}

require_once __DIR__.'/../src/template/Header.php';
?>
<div class="w-1/5 mx-auto">
    <h2 class="collapse-title font-semibold">Modifier un membre du staff</h2>
    <?php if ($errors !== []): ?>
        <ul class="list-disc text-error px-6 mb-4">
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <form method="post" class="space-y-4">
        <label class="floating-label">
            <span>Prénom</span>
            <input id="first_name" name="first_name" type="text" class="input input-bordered w-full" value="<?= htmlspecialchars($firstName, ENT_QUOTES, 'UTF-8') ?>" required>
        </label>
        <label class="floating-label">
            <span>Nom</span>
            <input id="last_name" name="last_name" type="text" class="input input-bordered w-full" value="<?= htmlspecialchars($lastName, ENT_QUOTES, 'UTF-8') ?>" required>
        </label>
        <label class="floating-label">
            <span>Photo</span>
            <input id="picture" name="picture" type="text" class="input input-bordered w-full" value="<?= htmlspecialchars($picture, ENT_QUOTES, 'UTF-8') ?>">
        </label>
        <select id="role" name="role" class="select select-bordered w-full" required>
            <?php foreach (RoleStaff::cases() as $case): ?>
                <option value="<?= htmlspecialchars($case->value, ENT_QUOTES, 'UTF-8') ?>" <?= $role === $case ? 'selected' : '' ?>><?= htmlspecialchars($case->value, ENT_QUOTES, 'UTF-8') ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="btn btn-block btn-neutral">Enregistrer</button>
        <button type="submit" name="action" value="delete" formnovalidate class="btn btn-block btn-error" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce membre du staff ?');">Supprimer le membre du staff</button>
    </form>
</div>
<?php require __DIR__.'/../src/template/Footer.php'; ?>
