<?php 
declare(strict_types=1);

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
<html lang="fr"  >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GestionClub</title>
    <link href="css/output.css" rel="stylesheet">

</head>
<body class="bg-base-100 text-base-content space-y-8">
<header>
    <div class="navbar bg-neutral shadow-sm">
        <div class="flex-1">
            <a href="index.php" class="btn btn-ghost text-xl text-neutral-content ">GestionClub</a>
        </div>
    </div>
</header>
<main class= "space-y-8">