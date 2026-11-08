<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/template/Header.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');

    if ($name === '') {
        $errors[] = 'Le nom de la troupe est obligatoire.';
    }

    if (empty($errors)) {
        try {
            TroupeBDD::addTroupe(new Troupe(0, $name));
            header('Location: index.php');
            exit;
        } catch (Exception $e) {
            $errors[] = "Erreur lors de l'ajout de la troupe : ".$e->getMessage();
        }
    }
}

require_once __DIR__.'/../inc/views/formTroupe.php';
require_once __DIR__.'/../src/template/Footer.php';
