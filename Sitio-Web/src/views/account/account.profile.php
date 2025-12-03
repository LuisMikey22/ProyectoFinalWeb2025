<section class="profile-section">
    <h3 class="seasonal-art-title">Información del Perfil</h3>

    <div class="name-input-container">
        <label class="input-label" for="name">Nombre de usuario</label>
        <input id="name" type="text" name="name" value="<?= htmlspecialchars($user->user ?? '') ?>" required>
    </div>
    
    <div class="email-input-container">
        <label class="input-label" for="email">Email</label>
        <input id="email" type="email" name="email" value="<?= htmlspecialchars($user->email ?? '') ?>" required>
    </div>

    <div class="desc-container">
        <label class="input-label" for="description">Descripción</label>
        <textarea name="description"><?= isset($user->description) ? htmlspecialchars($user->description) : '' ?></textarea>
    </div>

    <a href="<?=BASE_PATH?>/logout">
        <button class="action-button" type= "button">Cerrar sesión</button>
    </a>
</section>