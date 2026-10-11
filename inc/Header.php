<?php 
require_once __DIR__ . '/class/ActorHasTroupe.php';
require_once __DIR__ . '/class/Actor.php';
require_once __DIR__ . '/class/FaceOff.php';
require_once __DIR__ . '/class/StaffMember.php';
require_once __DIR__ . '/class/TroupeOpposee.php';
require_once __DIR__ . '/class/Troupe.php';
require_once __DIR__ . '/enum/RoleActor.php';
require_once __DIR__ . '/enum/RoleStaff.php';

?>

<!DOCTYPE html>
<html lang="fr" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GestionClub</title>
    <link rel="stylesheet" href="assets/css/app.css">
</head>
<body class="min-h-screen bg-base-200">

    <div class="navbar bg-base-100 shadow-sm">
        <div class="flex-1">
            <span class="btn btn-ghost text-xl">GestionClub</span>
        </div>
        <div class="flex-none">
            <ul class="menu menu-horizontal px-1">
                <li><a>Troupes</a></li>
                <li><a>Acteurs</a></li>
                <li><a>Représentations</a></li>
            </ul>
        </div>
    </div>
