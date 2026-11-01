<?php
declare(strict_types=1);

require_once __DIR__ . '/../inc/repository/ActorBDD.php';
require_once __DIR__ . '/../inc/repository/ActorHasTroupeBDD.php';
require_once __DIR__ . '/../inc/repository/FaceOffBDD.php';
require_once __DIR__ . '/../inc/repository/StaffMemberBDD.php';
require_once __DIR__ . '/../inc/repository/TroupeBDD.php';
require_once __DIR__ . '/../inc/repository/TroupeOpposeeBDD.php';

require_once __DIR__ . '/../inc/class/Database.php';
require_once __DIR__ . '/../inc/Header.php';

$listActors = ActorBDD::getAllActors();
$listActorsHasTroupes =ActorHasTroupeBDD::getAllActorsHasTroupes(); ;
$listFaceOffs = FaceOffBDD::getAllFaceOffs(); ;
$listStaffMembers = StaffMembersBDD::getAllStaffMembers();
$listTroupes = TroupeBDD::getAllTroupes();
$listTroupesOpposees = TroupeOpposeeBDD::getAllTroupesOpposees();

?>

<div class="w-3/4 mx-auto">
    <h1 class="collapse-title font-semibold">Bienvenue!</h1>
</div>
<?php
if($listActors!= null) {
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
                <div><?= $actor->getFirstName() . ' ' . $actor->getLastName(); ?></div>
                <div class="text-xs uppercase font-semibold opacity-60"><?= $actor->getBirthDate(); ?></div>

            </div>
        </li>
    <?php
    }
    ?>
    </ul>
</div>
<?php
} 
else{
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



<?php require __DIR__ . '/../inc/Footer.php'; ?>


