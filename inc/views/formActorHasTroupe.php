<div class="w-2/5 mx-auto">
    <h2 class="collapse-title font-semibold">Ajouter un acteur dans une troupe</h2>

    <?php if (!empty($errors)): ?>
        <ul class="list-disc text-error px-6 mb-4">
            <?php foreach ($errors as $e): ?>
                <li><?= htmlspecialchars($e) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="post" action="" class="space-y-4">
        <select id="troupe_id" name="troupe_id" class="select select-bordered w-full" required>
            <option value="">-- Choisir la troupe --</option>
            <?php foreach ($listTroupes as $t): ?>
                <option value="<?= $t->getId() ?>" <?= ($selectedTroupeId === $t->getId()) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($t->getName()) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <select id="actor_id" name="actor_id" class="select select-bordered w-full" required>
            <option value="">-- Choisir l'acteur --</option>
            <?php foreach ($listActors as $a): ?>
                <option value="<?= $a->getId() ?>">
                    <?= htmlspecialchars($a->getFirstName().' '.$a->getLastName()) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <select id="role" name="role" class="select select-bordered w-full" required>
            <option value="">-- Choisir le rôle dans la troupe --</option>
            <?php foreach (RoleActor::cases() as $case): ?>
                <option value="<?= $case->value ?>"><?= htmlspecialchars($case->value) ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit" class="btn btn-block btn-neutral">Ajouter l'acteur à la troupe</button>
    </form>
</div>
