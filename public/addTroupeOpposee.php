<?php
declare(strict_types=1);

require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/../inc/Header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post = $_POST;
    $address = $post['address'] ?? null;
    $city = $post['city'] ?? null;

    if ($address !== null && $city !== null) {
        $troupeOpposee = new TroupeOpposee(0, $address, $city);
        TroupeOpposeeBDD::addTroupeOpposee($troupeOpposee);

        header("Location: index.php");
        exit;
    }

    header("Location: addTroupeOpposee.php");
    exit;
}

?>

<div class="w-1/5 mx-auto">
    <h2 class="collapse-title font-semibold ">Ajouter une troupe opposée</h2>

    <form method="post" action="" class="space-y-4">
        <label class="floating-label">
            <span>Adresse</span>
            <input id="address" name="address" type="text" placeholder="Adresse" class="input input-bordered w-full" />
        </label>

        <label class="floating-label">
            <span>Ville</span>
            <input id="city" name="city" type="text" placeholder="Ville" class="input input-bordered w-full" />
        </label>

        <button type="submit" class="btn btn-block  btn-neutral">Ajouter la troupe opposée</button>

    </form>
</div>

<?php require __DIR__ . '/../inc/Footer.php'; ?>
