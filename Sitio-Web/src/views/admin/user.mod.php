<section class="product-section">
    <h3 class="product-title">Modificar Usuario</h3>

    <form action="<?= BASE_PATH ?>/admin/users/update/<?= $user->id ?>" method="POST" class="create-product-form">
        <fieldset class="product-fieldset">

            <input class="bordered-input" type="hidden" name="id" value="<?= $user->id ?>">

            <div class="text-input-container">
                <label class="input-label" for="user">Nombre</label>
                <input class="bordered-input" id="user" type="text" name="user" value="<?= htmlspecialchars($user->user) ?>" required>
            </div>

            <div class="text-input-container">
                <label class="input-label" for="email">Email</label>
                <input class="bordered-input" id="email" type="text" name="email" value="<?= htmlspecialchars($user->email) ?>" required>
            </div>

            <div class="action-container">
                <button class="action-button" type="submit">Guardar</button>
                <button class="delete-button" href="<?= BASE_PATH ?>/admin/users">Cancelar</button>
            </div>
        </fieldset>
    </form>
</section>