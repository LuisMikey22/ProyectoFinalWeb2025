<?php 
    require  __DIR__.'/partials/nav.php';
?>

<section class="login-account-section">
    <form class="login-account-form" action="<?=BASE_PATH?>/index.php" method="post">
        <fieldset class="login-account-fieldset">
            <legend>Iniciar sesión </legend>

           <div class="email-input-container">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" placeholder="Ejemplo@gmail.com" required>
            </div>

            <div class="password-input-container">
                <label for="password">Contraseña</label>
                <input id="password" type="password" name="password" placeholder="Contraseña" required>
            </div>

            <a class="small-link" href="#">¿Olvidaste tu contraseña?</a>

            <div class="action-container">
                <a class="small-link" href="<?=SRC_PATH?>/views/createAccount.php">¿Aún no te has registrado? Crea una cuenta</a>
                <button class="login-account-button" type="submit">Iniciar sesión</button>
            </div>
        </fieldset>
    </form>
</section>

<?php 
    include  __DIR__.'/partials/footer.php';
?>