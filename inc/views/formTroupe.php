<div class="w-1/5 mx-auto">
    <h2 class="collapse-title font-semibold">Ajouter une troupe</h2>

    <?php if (!empty($errors)): ?>
        <ul class="list-disc text-error px-6 mb-4">
            <?php foreach ($errors as $e): ?>
                <li><?= htmlspecialchars($e) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="post" action="" class="space-y-4">
        <label class="floating-label">
            <span>Nom de la troupe</span>
            <input id="name" name="name" type="text" placeholder="Nom de la troupe" class="input input-bordered w-full" required />
        </label>

        <button type="submit" class="btn btn-block btn-neutral">Ajouter la troupe</button>
    </form>
</div>
