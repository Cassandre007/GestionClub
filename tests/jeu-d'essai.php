<?php
require_once __DIR__ . '/../vendor/autoload.php';

$actor1 = new ActorBDD();
$actor1->addActor("Felix","Plus",2005-03-12,"photo1");
$actor2 = new ActorBDD();
$actor2->addActor("Charles","Dumesnil-Mombilliard",2007-05-07,"photo2");
$actor3 = new ActorBDD();
$actor3->addActor("Lucas","Longuet",2007-05-13,"photo3");
$actor4 = new ActorBDD();
$actor4->addActor("Kevin","Mohamed",2005-07-12,"photo4");
$actor5 = new ActorBDD();
$actor5->addActor("Lucien","Badluck",2002-02-22,"photo5");

$troupe1 = new TroupeBDD();
$troupe1->addTroupe("Tartuffes");
$troupe2 = new TroupeBDD();
$troupe2->addTroupe("Roméos et Julliettes");
$troupe3 = new TroupeBDD();
$troupe3->addTroupe("Malades Imaginaires");
$troupe4 = new TroupeBDD();
$troupe4->addTroupe("Improvisateurs");
$troupe5 = new TroupeBDD();
$troupe5->addTroupe("Antigones");

$actorTroupe1 = new ActorHasTroupeBDD();
$actorTroupe1->addActorHasTroupe($actor1,$troupe1, RoleActor::Narrateur);
$actorTroupe2 = new ActorHasTroupeBDD();
$actorTroupe2->addActorHasTroupe($actor2,$troupe1, RoleActor::PersonnagePrincipal);
$actorTroupe3 = new ActorHasTroupeBDD();
$actorTroupe3->addActorHasTroupe($actor3,$troupe1, RoleActor::PersonnageSecondaire);
$actorTroupe4 = new ActorHasTroupeBDD();
$actorTroupe4->addActorHasTroupe($actor4,$troupe2, RoleActor::Figurants);
$actorTroupe5 = new ActorHasTroupeBDD();
$actorTroupe5->addActorHasTroupe($actor5,$troupe2, RoleActor::PersonnagePrincipal);

$troupeOpposee1 = new TroupeOpposeeBDD();
$troupeOpposee1->addTroupeOpposee("10 rue de Paris","Paris");
$troupeOpposee2 = new TroupeOpposeeBDD();
$troupeOpposee2->addTroupeOpposee("25 rue Victor Hugo","Lyon");
$troupeOpposee3 = new TroupeOpposeeBDD();
$troupeOpposee3->addTroupeOpposee("8 avenue du Stade","Marseille");
$troupeOpposee4 = new TroupeOpposeeBDD();
$troupeOpposee4->addTroupeOpposee("15 rue Nationale","Lille");
$troupeOpposee5 = new TroupeOpposeeBDD();
$troupeOpposee5->addTroupeOpposee("30 boulevard Gambetta","Bordeaux");

$member1 = new StaffMembersBDD();
$member1->addStaffMember("Jean", "Dupont", "photo6", RoleStaff::Scenariste);
$member2 = new StaffMembersBDD();
$member2->addStaffMember("Cassandre", "Charbon", "photo7", RoleStaff::RegisseurLumiere);
$member3 = new StaffMembersBDD();
$member3->addStaffMember("Elena", "Rousset", "photo8", RoleStaff::MetteurEnScene);
$member4 = new StaffMembersBDD();
$member4->addStaffMember("Léo", "Dicahan", "photo9", RoleStaff::Scenariste);
$member5 = new StaffMembersBDD();
$member5->addStaffMember("Hugo", "Moins", "photo10", RoleStaff::MetteurEnScene);

$faceOff1 = new FaceOffBDD();
$faceOff1->addFaceOff(3, 1, 2026-10-05, $troupe1, "Paris", $troupeOpposee1);
$faceOff2 = new FaceOffBDD();
$faceOff2->addFaceOff(3, 1, 2026-10-12, $troupe2, "Lyon", $troupeOpposee2);
$faceOff3 = new FaceOffBDD();
$faceOff3->addFaceOff(3, 1, 2026-10-19, $troupe3, "Marseille", $troupeOpposee3);
$faceOff4 = new FaceOffBDD();
$faceOff4->addFaceOff(3, 1, 2026-10-26, $troupe4, "Lille", $troupeOpposee4);
$faceOff5 = new FaceOffBDD();
$faceOff5->addFaceOff(3, 1, 2026-11-02, $troupe5, "Bordeaux", $troupeOpposee5);

