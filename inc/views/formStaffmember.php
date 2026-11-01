<div class="w-1/5 mx-auto">
    <h2 class="collapse-title font-semibold">Ajouter un membre du staff</h2>

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
            <input id="first_name" name="first_name" type="text" placeholder="Prénom" class="input input-bordered w-full" required />
        </label>

        <label class="floating-label">
            <span>Nom</span>
            <input id="last_name" name="last_name" type="text" placeholder="Nom" class="input input-bordered w-full" required />
        </label>

        <label class="floating-label">
            <span>Photo</span>
            <input id="picture" name="picture" type="text" placeholder="URL de la photo (facultatif)" class="input input-bordered w-full" />
        </label>

        <select id="role" name="role" class="select select-bordered w-full" required>
            <option value="">-- Choisir un rôle --</option>
            <?php foreach (RoleStaff::cases() as $case): ?>
                <option value="<?= $case->value ?>"><?= htmlspecialchars($case->value) ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit" class="btn btn-block btn-neutral">Ajouter le membre du staff</button>
    </form>
</div>
