<div class="w-1/5 mx-auto">
    <h2 class="collapse-title font-semibold">Ajouter une troupe opposée</h2>

    <?php if (!empty($errors)): ?>
        <ul class="list-disc text-error px-6 mb-4">
            <?php foreach ($errors as $e): ?>
                <li><?= htmlspecialchars($e) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="post" action="" class="space-y-4">
        <label class="floating-label">
            <span>Adresse</span>
            <input id="address" name="address" type="text" placeholder="Adresse" class="input input-bordered w-full" required />
        </label>

        <label class="floating-label">
            <span>Ville</span>
            <input id="city" name="city" type="text" placeholder="Ville" class="input input-bordered w-full" required />
        </label>

        <button type="submit" class="btn btn-block btn-neutral">Ajouter la troupe opposée</button>
    </form>
</div>
