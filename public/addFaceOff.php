<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/template/Header.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $troupeId = filter_var($_POST['troupe_id'] ?? '', FILTER_VALIDATE_INT);
    $opponentId = filter_var($_POST['opponent_id'] ?? '', FILTER_VALIDATE_INT);
    $troupeScore = filter_var($_POST['troupe_score'] ?? '', FILTER_VALIDATE_INT);
    $opponentScore = filter_var($_POST['opponent_score'] ?? '', FILTER_VALIDATE_INT);
    $city = trim($_POST['city'] ?? '');
    $date = trim($_POST['date'] ?? '');

    if ($troupeId === false || $troupeId <= 0) {
        $errors[] = 'Il faut choisir la troupe du club.';
    }
    if ($opponentId === false || $opponentId <= 0) {
        $errors[] = 'Il faut choisir la troupe opposée.';
    }
    if ($troupeScore === false || $troupeScore < 0) {
        $errors[] = 'Le score de la troupe est invalide.';
    }
    if ($opponentScore === false || $opponentScore < 0) {
        $errors[] = 'Le score de la troupe opposée est invalide.';
    }
    if ($city === '') {
        $errors[] = 'La ville est obligatoire.';
    }
    $battleDate = DateTime::createFromFormat('Y-m-d', $date);
    if ($date === '' || $battleDate === false || $battleDate->format('Y-m-d') !== $date) {
        $errors[] = 'La date du battle est invalide.';
    }

    if (empty($errors)) {
        try {
            $faceOff = new FaceOff(
                0,
                $troupeScore,
                $opponentScore,
                $battleDate,
                TroupeBDD::getTroupe($troupeId),
                $city,
                TroupeOpposeeBDD::getTroupeOpposee($opponentId)
            );
            FaceOffBDD::addFaceOff($faceOff);
            header('Location: index.php');
            exit;
        } catch (Exception $e) {
            $errors[] = "Erreur lors de l'ajout du battle : ".$e->getMessage();
        }
    }
}

$listTroupes = TroupeBDD::getAllTroupes();
$listTroupesOpposees = TroupeOpposeeBDD::getAllTroupesOpposees();

require_once __DIR__.'/../inc/views/formFaceOff.php';
require_once __DIR__.'/../src/template/Footer.php';
