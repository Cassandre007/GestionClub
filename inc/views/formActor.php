<div class="w-1/5 mx-auto">
    <h2 class="collapse-title font-semibold">Ajouter un acteur</h2>

    <?php if (!empty($errors)): ?>
        <ul class="list-disc text-error px-6 mb-4">
            <?php foreach ($errors as $e): ?>
                <li><?= htmlspecialchars($e) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="post" action="" class="space-y-4">
        <label class="floating-label">
            <span>Prénom</span>
            <input id="first_name" name="first_name" type="text" placeholder="Prénom" class="input input-bordered w-full" value="<?= htmlspecialchars($first_name, ENT_QUOTES, 'UTF-8') ?>" required />
        </label>

        <label class="floating-label">
            <span>Nom</span>
            <input id="last_name" name="last_name" type="text" placeholder="Nom" class="input input-bordered w-full" value="<?= htmlspecialchars($last_name, ENT_QUOTES, 'UTF-8') ?>" required />
        </label>

        <label class="input input-bordered w-full">
            <span class="label">Date de naissance</span>
            <input id="birth_date" name="birth_date" type="date" value="<?= htmlspecialchars($birth_date, ENT_QUOTES, 'UTF-8') ?>" required />
        </label>

        <label class="floating-label">
            <span>Photo</span>
            <input id="picture" name="picture" type="text" placeholder="URL de la photo (facultatif)" class="input input-bordered w-full" value="<?= htmlspecialchars($picture, ENT_QUOTES, 'UTF-8') ?>" />
        </label>

        <button type="submit" class="btn btn-block btn-neutral">Ajouter l'acteur</button>
    </form>
</div>
