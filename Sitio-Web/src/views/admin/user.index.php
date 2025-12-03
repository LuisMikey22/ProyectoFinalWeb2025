<section class="new-art">
    <h3 class="new-art-title">Usuarios</h3>

    <a href="<?= BASE_PATH ?>/admin/users/add">
        <button class="add-button">Añadir Usuario</button>
    </a>

    <?php foreach($users as $user) : ?>
        <div class="product-action-container">
            <a class="image-link" href="<?=BASE_PATH?>/admin/users/<?=$user->id?>">
                <div class="user-info-container">
                    <h4 class="card-title art-desc"><?=$user->user?></h4>
                    <p class="user-email"><?=$user->correo?></p>
                </div>
            </a>

            <div class="operation-container">
                <a href="<?=BASE_PATH?>/admin/users/<?=$user->id?>" class="action-button">Ver</a>
                <a href="<?= BASE_PATH ?>/admin/users/mod/<?= $user->id ?>" class="edit-button">Modificar</a>
                <a href="<?= BASE_PATH ?>/admin/users/delete/<?= $user->id ?>" class="delete-button"
                onclick="return confirm('¿Seguro que quieres eliminar este usuario?')">Eliminar</a>
            </div>
        </div>
    <?php endforeach; ?>
</section>