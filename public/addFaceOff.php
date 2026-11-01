<?php
declare(strict_types=1);

require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/../inc/Header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $troupe_score = $_POST['troupe_score'] ?? null;
    $opponent_score = $_POST['opponent_score'] ?? null;
    $date = $_POST['date'] ?? null;
    $troupe_id = $_POST['troupe_id'] ?? null;
    $city = $_POST['city'] ?? null;
    $opposing_club_id = $_POST['opposing_club_id'] ?? null;

    if ($troupe_score !== null && $opponent_score !== null && $date !== null && $troupe_id !== null && $city !== null && $opposing_club_id !== null) {
        $faceOff = new FaceOff(0,$troupe_score,$opponent_score,new DateTime($date),TroupeBDD::getTroupe($troupe_id),$city,TroupeOpposeeBDD::getTroupeOpposee($opposing_club_id));
        FaceOffBDD::addFaceOff($faceOff);
        header("Location: index.php");
        exit;
    }
    header("Location: addFaceOff.php");
    exit;
}

$troupes = TroupeBDD::getAllTroupes();
$opposingClubs = TroupeOpposeeBDD::getAllTroupesOpposees();
?>

<div class="w-1/5 mx-auto">
    <h2 class="collapse-title font-semibold ">Ajouter un match</h2>

    <form method="post" action="" class="space-y-4">
        <label class="floating-label">
            <span>Troupe</span>
            <select id="troupe_id" name="troupe_id" class="select" required>
                <option value="" disabled selected>Choisir une troupe</option>
                <?php 
                foreach ($troupes as $troupe) { 
                ?>
                    <option value="<?= $troupe->getId() ?>">
                        <?= htmlspecialchars($troupe->getName()) ?>
                    </option>
                <?php 
                } 
                ?>
            </select>
        </label>

        <label class="floating-label">
            <span>Troupe adverse</span>
            <select id="opposing_club_id" name="opposing_club_id" class="select" required>
                <option value="" disabled selected>Choisir une troupe adverse</option>
                <?php 
                foreach ($opposingClubs as $club) { 
                ?>
                    <option value="<?= $club->getId() ?>">
                        <?= htmlspecialchars($club->getCity()) ?>
                    </option>
                <?php
                }
                ?>
            </select>
        </label>

        <label class="floating-label">
            <span>Score de la troupe</span>
            <input id="troupe_score" name="troupe_score" type="number" min="0" placeholder="Score de la troupe" class="input input-bordered w-full" />
        </label>

        <label class="floating-label">
            <span>Score adverse</span>
            <input id="opponent_score" name="opponent_score" type="number" min="0" placeholder="Score adverse" class="input input-bordered w-full" />
        </label>

        <label class="input input-bordered w-full">
            <span class="label">Date</span>
            <input id="date" name="date" type="date" />
        </label>

        <label class="floating-label">
            <span>Ville</span>
            <input id="city" name="city" type="text" placeholder="Ville" class="input input-bordered w-full" />
        </label>

        <button type="submit" class="btn btn-block  btn-neutral">Ajouter le match </button>
    </form>
</div>

<?php require __DIR__ . '/../inc/Footer.php'; ?>
