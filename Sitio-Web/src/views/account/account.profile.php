<section class="create-account-section">
    <h3 class="product-title">Información del Perfil</h3>

    <div class="create-account-form">
        <div class="create-account-fieldset">
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

            <div class="action-container">
                <a href="<?=BASE_PATH?>/logout">
                    <button class="action-button" style="width: fit-content; margin: auto;" type= "button">Cerrar sesión</button>
                </a>
            </div>
        </div>
    </div>
</section>