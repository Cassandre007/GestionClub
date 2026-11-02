<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../inc/Header.php';

$errors = [];

$source = ($_SERVER['REQUEST_METHOD'] === 'POST') ? $_POST : $_GET;
$selectedTroupeId = filter_var($source['troupe_id'] ?? '', FILTER_VALIDATE_INT);
if ($selectedTroupeId === false || $selectedTroupeId <= 0) {
    $selectedTroupeId = null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $actorId   = filter_var($_POST['actor_id'] ?? '', FILTER_VALIDATE_INT);
    $troupeId  = filter_var($_POST['troupe_id'] ?? '', FILTER_VALIDATE_INT);
    $role      = RoleActor::tryFrom((string)($_POST['role'] ?? ''));

    if ($actorId === false || $actorId <= 0) {
        $errors[] = "Il faut choisir un acteur.";
    }
    if ($troupeId === false || $troupeId <= 0) {
        $errors[] = "Il faut choisir une troupe.";
    }
    if ($role === null) {
        $errors[] = "Le rôle est invalide.";
    }

    if (empty($errors)) {
        try {
            $actorHasTroupe = new ActorHasTroupe(
                ActorBDD::getActor($actorId),
                TroupeBDD::getTroupe($troupeId),
                $role
            );
            ActorHasTroupeBDD::addActorHasTroupe($actorHasTroupe);
            header("Location: index.php");
            exit;
        } catch (Exception $e) {
            $errors[] = "Erreur lors de l'ajout de l'acteur dans la troupe : " . $e->getMessage();
        }
    }
}


$listActors  = ActorBDD::getAllActors();
$listTroupes = TroupeBDD::getAllTroupes();

require_once __DIR__ . '/../inc/views/formActorHasTroupe.php';
require_once __DIR__ . '/../inc/Footer.php';
