<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/template/Header.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $address = trim($_POST['address'] ?? '');
    $city = trim($_POST['city'] ?? '');

    if ($address === '') {
        $errors[] = "L'adresse est obligatoire.";
    }
    if ($city === '') {
        $errors[] = 'La ville est obligatoire.';
    }

    if (empty($errors)) {
        try {
            TroupeOpposeeBDD::addTroupeOpposee(new TroupeOpposee(0, $address, $city));
            header('Location: index.php');
            exit;
        } catch (Exception $e) {
            $errors[] = "Erreur lors de l'ajout de la troupe opposée : ".$e->getMessage();
        }
    }
}

require_once __DIR__.'/../inc/views/formTroupeOpposee.php';
require_once __DIR__.'/../src/template/Footer.php';
