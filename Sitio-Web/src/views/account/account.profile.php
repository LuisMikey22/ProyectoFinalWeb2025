<section class="home-info">
    <div class="home-info" style="width: auto; margin: auto;">

        <h3 class="new-art-title">Información del Perfil</h2>

        <div class="text-input-container">
            <label class="input-label"><b>Nombre de usuario:</b></label> 
            <label class="input-label"><?= htmlspecialchars($user->user ?? '') ?></label>
        </div>

        <div class="text-input-container">
            <label class="input-label"><b>Email:</b></label> 
            <label class="input-label"><?= htmlspecialchars($user->email ?? '') ?></label>
        </div>

        <div class="desc-container">
            <label class="input-label"><b>Descripción:</b></label>
            <textarea class="bordered-input" disabled><?= isset($user->description) ? htmlspecialchars($user->description) : '' ?></textarea>
        </div>
    </div>

    <a href="<?=BASE_PATH?>/logout">
        <button class="action-button" type= "button">Cerrar sesión</button>
    </a>
</section>