<section class="new-art">
    <h3 class="new-art-title">Usuarios</h3>

    <a href="<?= BASE_PATH ?>/admin/users/add">
        <button class="add-button">Añadir Usuario</button>
    </a>

    <?php foreach($users as $user) : ?>
        <div class="product-action-container">
            <a class="image-link" href="<?= BASE_PATH ?>/admin/users/details/<?= $user->id_user ?>">
                <div>
                    <h4 class="card-title art-desc"><?= htmlspecialchars($user->username) ?></h4>
                    <p class="art-price"><?= htmlspecialchars($user->email) ?></p>
                </div>
            </a>

            <div class="operation-container">
                <a href="<?= BASE_PATH ?>/admin/users/details/<?= $user->id_user ?>" class="action-button">Ver detalles</a>
                <a href="<?= BASE_PATH ?>/admin/users/mod/<?= $user->id_user ?>" class="edit-button">Modificar</a>
                <a href="<?= BASE_PATH ?>/admin/users/delete/<?= $user->id_user ?>" class="delete-button" onclick="return confirm('¿Seguro que quieres eliminar este usuario?')">Eliminar</a>
            </div>
        </div>
    <?php endforeach; ?>
</section>