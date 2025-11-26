<section class="create-account-section">
    <form class="create-account-form" action="<?=BASE_PATH?>/index.php" method="post">
        <fieldset class="create-account-fieldset">
            <legend>Por favor complete todos los campos: </legend>

            <div class="name-input-container">
                <label for="name">Nombre de usuario</label>
                <input id="name" type="text" name="name" placeholder="Usuario" required>
            </div>
            
            <div class="email-input-container">
                <label for="email">Correo electrónico</label>
                <input id="email" type="email" name="email" placeholder="Ejemplo@gmail.com" required>
            </div>
            
            <div class="password-input-container">
                <label for="password">Contraseña</label>
                <input id="password" type="password" name="password" placeholder="Contraseña" required>
            </div>

            <div class="desc-container">
                <label for="description">Descripción de perfil</label>
                <textarea name="description" placeholder="Descripción"></textarea>
            </div>
            
            <div class="action-container">
                <a class="small-link" href="<?=BASE_PATH?>/login">¿Ya tienes una cuenta? Inicia sesión aquí</a>
                <button class="create-account-button" type="submit">Registrarme</button>
            </div>
        </fieldset>
    </form>
</section>