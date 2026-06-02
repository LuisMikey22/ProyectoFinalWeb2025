<section class="new-art">
    <h3 class="new-art-title">Eliminar Usuario de la Plataforma</h3>

    <p style="text-align: center; margin-bottom: 2rem; color: var(--color-dark-blue);">
        ¿Está completamente seguro de que desea eliminar de forma permanente el siguiente registro de usuario?
    </p>

    <div class="product-action-container" style="max-w: 500px; margin: 0 auto 2rem auto; padding: 2rem; background: #f9f9f9; border-radius: var(--border-radius-16); box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
        <div class="art-item-image-container" style="text-align: center; margin-bottom: 1rem;">
            <h4 class="card-title art-desc" style="font-size: 1.5rem; font-weight: bold; color: #115e59;">
                <?= htmlspecialchars($user->username ?? '') ?>
            </h4>
            <p class="art-price" style="font-size: 1rem; font-weight: normal; margin-top: 0.5rem;">
                <?= htmlspecialchars($user->email ?? '') ?>
            </p>
        </div>

        <div class="operation-container" style="margin-top: 2rem;">
            <form action="<?= BASE_PATH ?>/admin/users/delete/<?= $user->id_user ?>" method="POST" style="width: 100%; margin-bottom: 1rem;">
                <input type="hidden" name="id_usuario" value="<?= $user->id_user ?>">
                <button type="submit" class="delete-button" style="background-color: #dc2626; border: none;">
                    Sí, eliminar definitivamente
                </button>
            </form>

            <a href="<?= BASE_PATH ?>/admin/users" class="edit-button" style="display: block; text-decoration: none; width: 100%;">
                Cancelar y regresar
            </a>
        </div>
    </div>
</section>