<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="EstaHambreQueAta">
        <meta name="description" content="EstaHambreQueAta desata la creatividad">

        <link rel="icon" href="<?=ASSETS_PATH?>/images/EHQALogoCropped2.svg" type="image/x-icon">
        <link href="<?=BASE_PATH?>/output.css" rel="stylesheet">
        <link href="<?=SRC_PATH?>/css/style.css" rel="stylesheet" > 

        <title>Crear cuenta</title>
    </head>

    <body>
        <header>
            <?php
                require __DIR__.'/partials/nav.php';
                //$carreras = getCarreras();
            ?>
        </header>
        
        <section class="create-account-section">
            <form class="create-account-form" action="Index.html" method="post">
                <fieldset class="create-account-fieldset">
                    <legend>Crear cuenta</legend>

                    <div class="name-input-container">
                        <label for="name">Nombre de usuario:</label>
                        <input id="name" type="text" name="name" placeholder="Usuario" required>
                    </div>
                    
                    <div class="email-input-container">
                        <label for="email">Correo electrónico:</label>
                        <input id="email" type="email" name="email" placeholder="Ejemplo@gmail.com" required>
                    </div>
                    
                    <div class="password-input-container">
                        <label for="password">Contraseña:</label>
                        <input id="password" type="password" name="password" placeholder="Contraseña" required>
                    </div>

                    <div class="desc-container">
                        <label for="description">Descripción de perfil:</label>
                        <textarea name="description" placeholder="Descripción"></textarea>
                    </div>

                    <div class="techniques-options-container">
                        <label for="fabric-techniques">Técnica de tejido favorita</label>

                        <select id="fabric-techniques" name="fabric-techniques" required>
                            <optgroup label="Tejidos">
                                <option value="loom">Telares</option>
                                <option value="knitting">Tejido a aguja</option>
                                <option value="crochet">Tejido a crochet</option>
                                <option value="needle-felting">Fieltro a aguja</option>
                                <option value="lace">Encaje</option>
                                <option value="embroidery">Bordado</option>
                                <option value="macramé">Macramé</option>
                                <option value="quilting">Edredón bordado</option> 
                                <option value="patchwork">Manta bordada</option>
                                <option value="Nålebinding">Tejido Escandinavo (Nålebinding)</option>  
                            </optgroup>
                        </select> 
                    </div>
                    

                    <div class="age-range-container">
                        <label for="Age">Edad</label>

                        <input id="age" list="ages" name="age" placeholder="Edad" required>

                        <datalist id="ages">
                            <option value="15"></option>
                            <option value="16"></option>
                            <option value="17"></option>
                            <option value="18"></option>
                            <option value="19"></option>
                            <option value="20"></option>
                            <option value="21"></option>
                            <option value="22"></option>
                            <option value="23"></option>
                            <option value="24"></option>
                            <option value="25"></option>
                            <option value="30"></option>
                            <option value="40"></option>
                            <option value="50"></option>
                            <option value="60"></option>
                            <option value="70"></option>
                        </datalist>
                    </div>

                    <button class="create-account-button" type="submit">Crear Cuenta</button>
                </fieldset>
            </form>
        </section>

        <?php 
            require __DIR__.'/partials/footer.php';
        ?>
    </body>

    <script src="scripts/script.js" defer></script>
</html>