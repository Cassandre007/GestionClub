<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../inc/Header.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name  = trim($_POST['last_name'] ?? '');
    $picture    = trim($_POST['picture'] ?? '');
    $role       = RoleStaff::tryFrom((string)($_POST['role'] ?? ''));

    if ($first_name === '') {
        $errors[] = "Le prénom est obligatoire.";
    }
    if ($last_name === '') {
        $errors[] = "Le nom est obligatoire.";
    }
    if ($role === null) {
        $errors[] = "Le rôle est invalide.";
    }

    if (empty($errors)) {
        $staffMember = new StaffMember(0, $first_name, $last_name, $picture, $role);
        try {
            StaffMembersBDD::addStaffMember($staffMember);
            header("Location: index.php");
            exit;
        } catch (Exception $e) {
            $errors[] = "Erreur lors de l'ajout du membre du staff : " . $e->getMessage();
        }
    }
}

require_once __DIR__ . '/../inc/views/formStaffmember.php';
require_once __DIR__ . '/../inc/Footer.php';

