<?php
declare(strict_types=1);

require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/../inc/Header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'] ?? null;
    $last_name = $_POST['last_name'] ?? null;
    $picture = $_POST['picture'] ?? null;
    $role = RoleStaff::tryFromName($_POST['role'] ?? null);

    if ($first_name !== null && $last_name !== null && $role !== null) {
        $staffMember = new StaffMember(0, $first_name, $last_name, $picture, $role);
        StaffMembersBDD::addStaffMember($staffMember);
        header("Location: index.php");
        exit;
    }
    header("Location: addStaffMember.php");
    exit;
}
?>

<div class="w-1/5 mx-auto">
    <h2 class="collapse-title font-semibold ">Ajouter un membre du staff</h2>

    <form method="post" action="" class="space-y-4">
        <label class="floating-label">
            <span>Prénom</span>
            <input id="first_name" name="first_name" type="text" placeholder="Prénom" class="input input-bordered w-full" />
        </label>

        <label class="floating-label">
            <span>Nom</span>
            <input id="last_name" name="last_name" type="text" placeholder="Nom" class="input input-bordered w-full" />
        </label>

        <label class="floating-label">
            <span>Photo</span>
            <input id="picture" name="picture" type="text" placeholder="URL de la photo (facultatif)" class="input input-bordered w-full" />
        </label>

        <label class="floating-label">
            <span>Rôle</span>
            <select id="role" name="role" class="select" required>
                <option value="" disabled selected>Choisir un rôle</option>
                <?php foreach (RoleStaff::cases() as $role): ?>
                    <option value="<?= htmlspecialchars($role->value) ?>">
                        <?= htmlspecialchars($role->value) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>

        <button type="submit" class="btn btn-block  btn-neutral">Ajouter le membre </button>
    </form>
</div>

<?php require __DIR__ . '/../inc/Footer.php'; ?>
