<?php
require_once __DIR__ . '/../inc/actor_has_troupe.php';
require_once __DIR__ . '/../inc/actor.php';
require_once __DIR__ . '/../inc/face_off.php';
require_once __DIR__ . '/../inc/staff_members.php';
require_once __DIR__ . '/../inc/troupe_opposee.php';
require_once __DIR__ . '/../inc/troupe.php';

$actor1 = new Actor("Felix","Plus",2005-03-12,"photo1");
$actor2 = new Actor("Charles","Dumesnil-Mombilliard",2007-05-07,"photo2");
$actor3 = new Actor("Lucas","Longuet",2007-05-13,"photo3");
$actor4 = new Actor("Kevin","Mohamed",2005-07-12,"photo4");
$actor5 = new Actor("Lucien","Badluck",2002-02-22,"photo5");

$troupe1 = new Troupe("Tartuffes");
$troupe2 = new Troupe("Roméos et Julliettes");
$troupe3 = new Troupe("Malades Imaginaires");
$troupe4 = new Troupe("Improvisateurs");
$troupe5 = new Troupe("Antigones");

$actorTroupe1 = new ActorsHasTroupe($actor1,$troupe1,"Narrateur");
$actorTroupe2 = new ActorsHasTroupe($actor2,$troupe1,"Personnage principal");
$actorTroupe3 = new ActorsHasTroupe($actor3,$troupe1,"Personnage secondaire");
$actorTroupe4 = new ActorsHasTroupe($actor4,$troupe2,"Figurants");
$actorTroupe5 = new ActorsHasTroupe($actor5,$troupe2,"Personnage principal");

$troupeOpposee1 = new TroupeOpposee("10 rue de Paris","Paris");
$troupeOpposee2 = new TroupeOpposee("25 rue Victor Hugo","Lyon");
$troupeOpposee3 = new TroupeOpposee("8 avenue du Stade","Marseille");
$troupeOpposee4 = new TroupeOpposee("15 rue Nationale","Lille");
$troupeOpposee5 = new TroupeOpposee("30 boulevard Gambetta","Bordeaux");

$member1 = new StaffMember("Jean", "Dupont", "photo6", "scénariste");
$member2 = new StaffMember("Cassandre", "Charbon", "photo7", "régisseur lumiere");
$member3 = new StaffMember("Elena", "Rousset", "photo8", "metteur en scene");
$member4 = new StaffMember("Léo", "Dicahan", "photo9", "scénariste");
$member5 = new StaffMember("Hugo", "Moins", "photo10", "metteur en scene");

$faceOff1 = new FaceOff(1, 3, 1, 2026-10-05, $troupe1, "Paris", $troupeOpposee1);
$faceOff2 = new FaceOff(1, 3, 1, 2026-10-12, $troupe2, "Lyon", $troupeOpposee2);
$faceOff3 = new FaceOff(1, 3, 1, 2026-10-19, $troupe3, "Marseille", $troupeOpposee3);
$faceOff4 = new FaceOff(1, 3, 1, 2026-10-26, $troupe4, "Lille", $troupeOpposee4);
$faceOff5 = new FaceOff(1, 3, 1, 2026-11-02, $troupe5, "Bordeaux", $troupeOpposee5);





