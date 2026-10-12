<?php
require_once __DIR__ . '/../inc/repository/ActorHasTroupeBDD.php';
require_once __DIR__ . '/../inc/repository/ActorBDD.php';
require_once __DIR__ . '/../inc/repository/FaceOffBDD.php';
require_once __DIR__ . '/../inc/repository/StaffMemberBDD.php';
require_once __DIR__ . '/../inc/repository/TroupeBDD.php';
require_once __DIR__ . '/../inc/repository/TroupeOpposeeBDD.php';
require_once __DIR__ . '/../inc/enum/RoleActor.php';
require_once __DIR__ . '/../inc/enum/RoleStaff.php';

$actor1 = new ActorBDD($GLOBALS['pdo'])->addActor("Felix","Plus",2005-03-12,"photo1");
$actor2 = new ActorBDD($GLOBALS['pdo'])->addActor("Charles","Dumesnil-Mombilliard",2007-05-07,"photo2");
$actor3 = new ActorBDD($GLOBALS['pdo'])->addActor("Lucas","Longuet",2007-05-13,"photo3");
$actor4 = new ActorBDD($GLOBALS['pdo'])->addActor("Kevin","Mohamed",2005-07-12,"photo4");
$actor5 = new ActorBDD($GLOBALS['pdo'])->addActor("Lucien","Badluck",2002-02-22,"photo5");

$troupe1 = new TroupeBDD($GLOBALS['pdo'])->addTroupe("Tartuffes");
$troupe2 = new TroupeBDD($GLOBALS['pdo'])->addTroupe("Roméos et Julliettes");
$troupe3 = new TroupeBDD($GLOBALS['pdo'])->addTroupe("Malades Imaginaires");
$troupe4 = new TroupeBDD($GLOBALS['pdo'])->addTroupe("Improvisateurs");
$troupe5 = new TroupeBDD($GLOBALS['pdo'])->addTroupe("Antigones");

$actorTroupe1 = new ActorHasTroupeBDD($GLOBALS['pdo'])->addActorHasTroupe($actor1,$troupe1, RoleActor::Narrateur);
$actorTroupe2 = new ActorHasTroupeBDD($GLOBALS['pdo'])->addActorHasTroupe($actor2,$troupe1, RoleActor::PersonnagePrincipal);
$actorTroupe3 = new ActorHasTroupeBDD($GLOBALS['pdo'])->addActorHasTroupe($actor3,$troupe1, RoleActor::PersonnageSecondaire);
$actorTroupe4 = new ActorHasTroupeBDD($GLOBALS['pdo'])->addActorHasTroupe($actor4,$troupe2, RoleActor::Figurants);
$actorTroupe5 = new ActorHasTroupeBDD($GLOBALS['pdo'])->addActorHasTroupe($actor5,$troupe2, RoleActor::PersonnagePrincipal);

$troupeOpposee1 = new TroupeOpposeeBDD($GLOBALS['pdo'])->addTroupeOpposee("10 rue de Paris","Paris");
$troupeOpposee2 = new TroupeOpposeeBDD($GLOBALS['pdo'])->addTroupeOpposee("25 rue Victor Hugo","Lyon");
$troupeOpposee3 = new TroupeOpposeeBDD($GLOBALS['pdo'])->addTroupeOpposee("8 avenue du Stade","Marseille");
$troupeOpposee4 = new TroupeOpposeeBDD($GLOBALS['pdo'])->addTroupeOpposee("15 rue Nationale","Lille");
$troupeOpposee5 = new TroupeOpposeeBDD($GLOBALS['pdo'])->addTroupeOpposee("30 boulevard Gambetta","Bordeaux");

$member1 = new StaffMemberBDD($GLOBALS['pdo'])->addStaffMember("Jean", "Dupont", "photo6", RoleStaff::Scénariste);
$member2 = new StaffMemberBDD($GLOBALS['pdo'])->addStaffMember("Cassandre", "Charbon", "photo7", RoleStaff::RégisseurLumière);
$member3 = new StaffMemberBDD($GLOBALS['pdo'])->addStaffMember("Elena", "Rousset", "photo8", RoleStaff::MetteurEnScène);
$member4 = new StaffMemberBDD($GLOBALS['pdo'])->addStaffMember("Léo", "Dicahan", "photo9", RoleStaff::Scénariste);
$member5 = new StaffMemberBDD($GLOBALS['pdo'])->addStaffMember("Hugo", "Moins", "photo10", RoleStaff::MetteurEnScène);

$faceOff1 = new FaceOffBDD($GLOBALS['pdo'])->addFaceOff(1, 3, 1, 2026-10-05, $troupe1, "Paris", $troupeOpposee1);
$faceOff2 = new FaceOffBDD($GLOBALS['pdo'])->addFaceOff(1, 3, 1, 2026-10-12, $troupe2, "Lyon", $troupeOpposee2);
$faceOff3 = new FaceOffBDD($GLOBALS['pdo'])->addFaceOff(1, 3, 1, 2026-10-19, $troupe3, "Marseille", $troupeOpposee3);
$faceOff4 = new FaceOffBDD($GLOBALS['pdo'])->addFaceOff(1, 3, 1, 2026-10-26, $troupe4, "Lille", $troupeOpposee4);
$faceOff5 = new FaceOffBDD($GLOBALS['pdo'])->addFaceOff(1, 3, 1, 2026-11-02, $troupe5, "Bordeaux", $troupeOpposee5);

