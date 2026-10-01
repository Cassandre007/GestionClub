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

$ActorTroupe1 = new ActorsHasTroupe($actor1,$troupe1,"Narrateur");
$ActorTroupe2 = new ActorsHasTroupe($actor2,$troupe1,"Personnage principal");
$ActorTroupe3 = new ActorsHasTroupe($actor3,$troupe1,"Personnage secondaire");
$ActorTroupe4 = new ActorsHasTroupe($actor4,$troupe2,"Figurants");
$ActorTroupe5 = new ActorsHasTroupe($actor5,$troupe2,"Personnage principal");

$FaceOff = new ActorsHasTroupe($actor1,$troupe1,"Narrateur");




