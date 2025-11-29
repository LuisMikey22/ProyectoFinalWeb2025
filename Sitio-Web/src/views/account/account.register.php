<section class="create-account-section">
    <h3 class="product-title">🧶Por favor complete todos los campos:</h3>

    <form class="create-account-form" action="?route=account" method="post">
        <fieldset class="create-account-fieldset">
            <div class="name-input-container">
                <label class="input-label" for="name">Nombre de usuario</label>
                <input class="bordered-input" id="name" type="text" name="name" placeholder="Usuario" required>
            </div>
            
            <div class="email-input-container">
                <label class="input-label" for="email">Correo electrónico</label>
                <input class="bordered-input" id="email" type="email" name="email" placeholder="Ejemplo@gmail.com" required>
            </div>
            
            <div class="password-input-container">
                <label class="input-label" for="password">Contraseña</label>
                <input class="bordered-input" id="password" type="password" name="password" placeholder="Contraseña" required>
            </div>

            <div class="desc-container">
                <label class="input-label" for="description">Descripción de perfil</label>
                <textarea class="bordered-input" name="description" placeholder="Descripción"></textarea>
            </div>
            
            <div class="action-container">
                <a class="small-link" href="<?=BASE_PATH?>/login">¿Ya tienes una cuenta? Inicia sesión aquí</a>
                <button class="action-button" type="submit">Registrarme</button>
            </div>
        </fieldset>
    </form>
</section>