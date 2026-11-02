<div class="w-2/5 mx-auto">
    <h2 class="collapse-title font-semibold">Ajouter un battle</h2>

    <?php if (!empty($errors)): ?>
        <ul class="list-disc text-error px-6 mb-4">
            <?php foreach ($errors as $e): ?>
                <li><?= htmlspecialchars($e) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="post" action="" class="space-y-4">
        <select id="troupe_id" name="troupe_id" class="select select-bordered w-full" required>
            <option value="">-- Choisir la troupe du club --</option>
            <?php foreach ($listTroupes as $t): ?>
                <option value="<?= $t->getId() ?>"><?= htmlspecialchars($t->getName()) ?></option>
            <?php endforeach; ?>
        </select>

        <select id="opponent_id" name="opponent_id" class="select select-bordered w-full" required>
            <option value="">-- Choisir la troupe opposée --</option>
            <?php foreach ($listTroupesOpposees as $o): ?>
                <option value="<?= $o->getId() ?>"><?= htmlspecialchars($o->getAddress() . ' (' . $o->getCity() . ')') ?></option>
            <?php endforeach; ?>
        </select>

        <label class="input input-bordered w-full">
            <span class="label">Date du battle</span>
            <input id="date" name="date" type="date" required />
        </label>

        <label class="floating-label">
            <span>Ville</span>
            <input id="city" name="city" type="text" placeholder="Ville du battle" class="input input-bordered w-full" required />
        </label>

        <div class="flex gap-4">
            <label class="floating-label w-1/2">
                <span>Score de la troupe</span>
                <input id="troupe_score" name="troupe_score" type="number" min="0" step="1" value="0" class="input input-bordered w-full" />
            </label>

            <label class="floating-label w-1/2">
                <span>Score de l'adversaire</span>
                <input id="opponent_score" name="opponent_score" type="number" min="0" step="1" value="0" class="input input-bordered w-full" />
            </label>
        </div>

        <button type="submit" class="btn btn-block btn-neutral">Ajouter le battle</button>
    </form>
</div>
