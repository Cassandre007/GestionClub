<?php
declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/template/Header.php';

$listActors = ActorBDD::getAllActors();
$listFaceOffs = FaceOffBDD::getAllFaceOffs();
$listStaffMembers = StaffMembersBDD::getAllStaffMembers();
$listTroupes = TroupeBDD::getAllTroupes();
$listTroupesOpposees = TroupeOpposeeBDD::getAllTroupesOpposees();

?>

<div class="w-3/4 mx-auto">
    <h1 class="collapse-title font-semibold">Bienvenue!</h1>
</div>

<?php // ACTORS?>

<?php
if ($listActors != null) {
    ?>
<div class="w-3/4 mx-auto">
    <ul class="list bg-base-100 rounded-box shadow-md">
    
    <li class="p-4 pb-2 text-xs opacity-60 tracking-wide">Liste des acteurs</li>
    <?php
        foreach ($listActors as $actor) {
            ?> 
        <li class="list-row">
            <div class = "w-32">
            <?php
                        if ($actor->getPicture() != null) {
                            ?>
                <img class="rounded-xl" alt="" src="<?= $actor->getPicture(); ?>"/>
            <?php
                        }
            ?>
            </div>
            <div class= "space-y-2">
                <div><?= $actor->getFirstName().' '.$actor->getLastName(); ?></div>
                <div class="text-xs uppercase font-semibold opacity-60"><?= $actor->getBirthDate()->format('d/m/Y'); ?></div>
            </div>
            <a class="btn btn-ghost" href="updateActor.php?id=<?= $actor->getId(); ?>">Editer</a>
        </li>
    <?php
        }
    ?>
    </ul>
</div>
<?php
} else {
    ?>
<div class="w-3/4 mx-auto">
    <p class="collapse-title font-semibold">Il n'y a pas d'acteur enregistré</p>
</div>

<?php
}
?>
<div class="w-3/4 mx-auto">
    <a class="btn btn-ghost" href="addActor.php">Ajouter un acteur</a>
</div>

<?php // TROUPES?>

<?php
if ($listTroupes != null) {
    ?>
<div class="w-3/4 mx-auto">
    <ul class="list bg-base-100 rounded-box shadow-md">
    
    <li class="p-4 pb-2 text-xs opacity-60 tracking-wide">Liste des troupes</li>
    <?php
        foreach ($listTroupes as $troupe) {
            ?> 
        <li class="list-row">
            <div class = "w-32"></div>
            <div class= "space-y-2">
                <div><?= $troupe->getName(); ?></div>
                <?php
                            $listMembresTroupes = ActorHasTroupeBDD::getAllActorsHasTroupes($troupe->getId());
            if ($listMembresTroupes != null) {
                foreach ($listMembresTroupes as $troupeMembre) {
                    ?>
                        <div class="text-xs uppercase font-semibold opacity-60"><?= $troupeMembre->getActor()->getFirstName().' '.$troupeMembre->getActor()->getLastName().' :  '.$troupeMembre->getRole()->value; ?><a class="pl-4" href="updateActorHasTroupe.php?troupe_id=<?= $troupe->getId(); ?>&actor_id=<?= $troupeMembre->getActor()->getId(); ?>"> Editer</a> </div>
                <?php
                }
            }
            ?>   
            </div>
            <a class="btn btn-ghost" href="updateTroupe.php?id=<?= $troupe->getId(); ?>">Editer</a>
        </li>
    <?php
        }
    ?>
    </ul>
</div>
<?php
} else {
    ?>
<div class="w-3/4 mx-auto">
    <p class="collapse-title font-semibold">Il n'y a pas de troupe enregistrée</p>
</div>

<?php
}
?>
<div class="w-3/4 mx-auto">
    <a class="btn btn-ghost" href="addTroupe.php">Ajouter une troupe</a>
    <a class="btn btn-ghost" href="addActorToTroupe.php">Ajouter un acteur à une troupe</a>
</div>

<?php // TROUPES OPOSEES?>

<?php
if ($listTroupesOpposees != null) {
    ?>
<div class="w-3/4 mx-auto">
    <ul class="list bg-base-100 rounded-box shadow-md">
    
    <li class="p-4 pb-2 text-xs opacity-60 tracking-wide">Liste des troupes opposées</li>
    <?php
        foreach ($listTroupesOpposees as $troupeOpposee) {
            ?> 
        <li class="list-row">
            <div class = "w-32"></div>
            <div class= "space-y-2">
                <div><?= $troupeOpposee->getAddress(); ?></div>
                <div class="text-xs uppercase font-semibold opacity-60"><?= $troupeOpposee->getCity(); ?></div>
            </div>
            <a class="btn btn-ghost" href="updateTroupeOpposee.php?id=<?= $troupeOpposee->getId(); ?>">Modifier</a>
        </li>
    <?php
        }
    ?>
    </ul>
</div>
<?php
} else {
    ?>
<div class="w-3/4 mx-auto">
    <p class="collapse-title font-semibold">Il n'y a pas de troupe opposée enregistrée</p>
</div>

<?php
}
?>
<div class="w-3/4 mx-auto">
    <a class="btn btn-ghost" href="addTroupeOpposee.php">Ajouter une troupe opposée</a>
</div>

<?php // FACEOFFS?>

<?php
if ($listFaceOffs != null) {
    ?>
<div class="w-3/4 mx-auto">
    <ul class="list bg-base-100 rounded-box shadow-md">
    
    <li class="p-4 pb-2 text-xs opacity-60 tracking-wide">Liste des battles</li>
    <?php
        foreach ($listFaceOffs as $faceOff) {
            ?> 
        <li class="list-row">
            <div class = "w-32">
                <div>
                    <span class="collapse-title font-semibold" ><?= $faceOff->getCity(); ?></span>
                </div>
            </div>
            <div class= "space-y-2">
                <div><?= $faceOff->getTroupe()->getName().' vs '.$faceOff->getOpposingClub()->getCity(); ?></div>
                <div class="text-xs uppercase font-semibold opacity-60"><?= $faceOff->getDate()->format('d/m/Y'); ?></div>
            </div>
            <div class= "space-y-2">
                <div class="text-xs uppercase font-semibold opacity-60"><?= $faceOff->getTroupeScore().' / '.$faceOff->getOpponentScore(); ?></div>
            </div>
            <a class="btn btn-ghost" href="updateFaceOff.php?id=<?= $faceOff->getId(); ?>">Modifier</a>
        </li>
    <?php
        }
    ?>
    </ul>
</div>
<?php
} else {
    ?>
<div class="w-3/4 mx-auto">
    <p class="collapse-title font-semibold">Il n'y a pas de battle enregistré</p>
</div>

<?php
}
?>
<div class="w-3/4 mx-auto">
    <a class="btn btn-ghost" href="addFaceOff.php">Ajouter un battle</a>
</div>

<?php // STAFF MEMBERS?>

<?php
if ($listStaffMembers != null) {
    ?>
<div class="w-3/4 mx-auto">
    <ul class="list bg-base-100 rounded-box shadow-md">
    
    <li class="p-4 pb-2 text-xs opacity-60 tracking-wide">Liste des membres du staff</li>
    <?php
        foreach ($listStaffMembers as $staffMember) {
            ?> 
        <li class="list-row">
            <div class = "w-32">
            <?php
                        if ($staffMember->getPicture() != null) {
                            ?>
                <img class="rounded-xl" alt="" src="<?= $staffMember->getPicture(); ?>"/>
            <?php
                        }
            ?>
            </div>
            <div class= "space-y-2">
                <div><?= $staffMember->getFirstName().' '.$staffMember->getLastName(); ?></div>
                <div class="text-xs uppercase font-semibold opacity-60"><?= $staffMember->getRole()->value ?></div>

            </div>
            <a class="btn btn-ghost" href="updateStaffMember.php?id=<?= $staffMember->getId(); ?>">Modifier</a>
        </li>
    <?php
        }
    ?>
    </ul>
</div>
<?php
} else {
    ?>
<div class="w-3/4 mx-auto">
    <p class="collapse-title font-semibold">Il n'y a pas de membre du staff enregistré</p>
</div>

<?php
}
?>
<div class="w-3/4 mx-auto">
    <a class="btn btn-ghost" href="addStaffmember.php">Ajouter un membre du staff</a>
</div>


<?php require __DIR__.'/../src/template/Footer.php'; ?>
