<section class="new-art">
    <h3 class="new-art-title">Eliminar Usuario</h3>

    <p>¿Seguro que quieres eliminar este usuario?</p>

    <div class="product-action-container">
        <div class="art-item-image-container">
            <h4 class="card-title art-desc"><?= htmlspecialchars($user->user ?? '') ?></h4>
            <p><?= htmlspecialchars($user->email ?? '') ?></p>
        </div>

        <div class="operation-container">
            <form action="<?= BASE_PATH ?>/admin/deleteUser" method="POST">
                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                <button type="submit" class="delete-button">Sí, eliminar</button>
            </form>

            <a href="<?= BASE_PATH ?>/admin/users" class="edit-button">Cancelar</a>
        </div>
    </div>
</section>