<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/template/Header.php';

$errors = [];
$first_name = '';
$last_name = '';
$birth_date = '';
$picture = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $birth_date = trim($_POST['birth_date'] ?? '');
    $picture = trim($_POST['picture'] ?? '');

    if ($first_name === '') {
        $errors[] = 'Le prénom est obligatoire.';
    }
    if ($last_name === '') {
        $errors[] = 'Le nom est obligatoire.';
    }
    $birthDate = DateTime::createFromFormat('Y-m-d', $birth_date);
    if ($birth_date === '' || $birthDate === false || $birthDate->format('Y-m-d') !== $birth_date) {
        $errors[] = 'La date de naissance est invalide.';
    } elseif ($birth_date > (new DateTimeImmutable('today'))->format('Y-m-d')) {
        $errors[] = 'La date de naissance ne peut pas être dans le futur.';
    }
    if ($first_name !== '' && $last_name !== '' && ActorBDD::hasHomonym($first_name, $last_name)) {
        $errors[] = 'Un acteur porte déjà ce prénom et ce nom.';
    }

    if ($errors === [] && $birthDate !== false) {
        $actor = new Actor(0, $first_name, $last_name, $birthDate, $picture);
        try {
            ActorBDD::addActor($actor);
            header('Location: index.php');
            exit;
        } catch (Exception $e) {
            $errors[] = "Erreur lors de l'ajout de l'acteur : ".$e->getMessage();
        }
    }
}

require_once __DIR__.'/../inc/views/formActor.php';
require_once __DIR__.'/../src/template/Footer.php';
