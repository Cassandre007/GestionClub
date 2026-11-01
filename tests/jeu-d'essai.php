<?php
require_once __DIR__ . '/../autoload.php';

$actor1 = (ActorBDD)->addActor("Felix","Plus",2005-03-12,"photo1");
$actor2 = (ActorBDD)->addActor("Charles","Dumesnil-Mombilliard",2007-05-07,"photo2");
$actor3 = (ActorBDD)->addActor("Lucas","Longuet",2007-05-13,"photo3");
$actor4 = (ActorBDD)->addActor("Kevin","Mohamed",2005-07-12,"photo4");
$actor5 = (ActorBDD)->addActor("Lucien","Badluck",2002-02-22,"photo5");

$troupe1 = (TroupeBDD)->addTroupe("Tartuffes");
$troupe2 = (TroupeBDD)->addTroupe("Roméos et Julliettes");
$troupe3 = (TroupeBDD)->addTroupe("Malades Imaginaires");
$troupe4 = (TroupeBDD)->addTroupe("Improvisateurs");
$troupe5 = (TroupeBDD)->addTroupe("Antigones");

$actorTroupe1 = (ActorHasTroupeBDD)->addActorHasTroupe($actor1,$troupe1, RoleActor::Narrateur);
$actorTroupe2 = (ActorHasTroupeBDD)->addActorHasTroupe($actor2,$troupe1, RoleActor::PersonnagePrincipal);
$actorTroupe3 = (ActorHasTroupeBDD)->addActorHasTroupe($actor3,$troupe1, RoleActor::PersonnageSecondaire);
$actorTroupe4 = (ActorHasTroupeBDD)->addActorHasTroupe($actor4,$troupe2, RoleActor::Figurants);
$actorTroupe5 = (ActorHasTroupeBDD)->addActorHasTroupe($actor5,$troupe2, RoleActor::PersonnagePrincipal);

$troupeOpposee1 = (TroupeOpposeeBDD)->addTroupeOpposee("10 rue de Paris","Paris");
$troupeOpposee2 = (TroupeOpposeeBDD)->addTroupeOpposee("25 rue Victor Hugo","Lyon");
$troupeOpposee3 = (TroupeOpposeeBDD)->addTroupeOpposee("8 avenue du Stade","Marseille");
$troupeOpposee4 = (TroupeOpposeeBDD)->addTroupeOpposee("15 rue Nationale","Lille");
$troupeOpposee5 = (TroupeOpposeeBDD)->addTroupeOpposee("30 boulevard Gambetta","Bordeaux");

$member1 = (StaffMembersBDD)->addStaffMember("Jean", "Dupont", "photo6", RoleStaff::Scenariste);
$member2 = (StaffMembersBDD)->addStaffMember("Cassandre", "Charbon", "photo7", RoleStaff::RegisseurLumiere);
$member3 = (StaffMembersBDD)->addStaffMember("Elena", "Rousset", "photo8", RoleStaff::MetteurEnScene);
$member4 = (StaffMembersBDD)->addStaffMember("Léo", "Dicahan", "photo9", RoleStaff::Scenariste);
$member5 = (StaffMembersBDD)->addStaffMember("Hugo", "Moins", "photo10", RoleStaff::MetteurEnScene);

$faceOff1 = (FaceOffBDD)->addFaceOff(3, 1, 2026-10-05, $troupe1, "Paris", $troupeOpposee1);
$faceOff2 = (FaceOffBDD)->addFaceOff(3, 1, 2026-10-12, $troupe2, "Lyon", $troupeOpposee2);
$faceOff3 = (FaceOffBDD)->addFaceOff(3, 1, 2026-10-19, $troupe3, "Marseille", $troupeOpposee3);
$faceOff4 = (FaceOffBDD)->addFaceOff(3, 1, 2026-10-26, $troupe4, "Lille", $troupeOpposee4);
$faceOff5 = (FaceOffBDD)->addFaceOff(3, 1, 2026-11-02, $troupe5, "Bordeaux", $troupeOpposee5);

