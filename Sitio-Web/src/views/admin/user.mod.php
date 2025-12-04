<section style="padding: 40px;">
    <h2>Modificar Usuario</h2>

    <?php var_dump($user); ?>

    <form action="<?= BASE_PATH ?>/admin/updateUser" method="POST" style="background:#f2f2f2; padding:20px; border-radius:10px;">

        <input type="hidden" name="id" value="<?= $user['id'] ?>">

        <label>Nombre:</label>
        <input type="text" name="user" value="<?= htmlspecialchars($user->user ?? '') ?>" style="display:block; margin-bottom:20px; padding:8px;">

        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user->email ?? '') ?>" style="display:block; margin-bottom:20px; padding:8px;">

        <button type="submit">Guardar</button>

        <a href="<?= BASE_PATH ?>/admin/users">Cancelar</a>
    </form>
</section>
