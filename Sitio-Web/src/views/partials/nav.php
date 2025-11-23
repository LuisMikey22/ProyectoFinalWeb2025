<?php 
    require __DIR__.'/../../helpers/functions.php';
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="EstaHambreQueAta">
        <meta name="description" content="EstaHambreQueAta desata la creatividad">

        <link rel="icon" href="<?=ASSETS_PATH?>/images/EHQALogoCropped2.svg" type="image/x-icon">
        
        <link href="output.css" rel="stylesheet">
        <link href="<?=SRC_PATH?>/css/Style.css" rel="stylesheet"> 

        <title>EstaHambreQueAta</title>
    </head>

    <script> 
        const SRC_PATH = "<?=SRC_PATH?>";
        const ASSETS_PATH = "<?=ASSETS_PATH?>";
    </script> 
    
    <script src="<?=BASE_PATH?>/scripts/script.js" defer></script>
    <body>
        <header>
            <input type="checkbox" id="menu-toggle" class="menu-toggle">
                        
            <nav>
                <div id="search-bar-container" class="search-bar-container-hidden">
                    <div class="search-bar-input-container">
                        <button id="search-bar-button" class="search-bar-button" type="submit" name="submit" title="Buscar">
                            <img src="<?=ASSETS_PATH?>/images/searchIcon.svg" alt="search">
                        </button>

                        <input id="search-bar-input" class="search-bar-input" type="text" name="inputValue" placeholder="Buscar" focus required>

                        <button id="close-button" class="close-button" type="button" name="close" title="Cerrar">
                            <img src="<?=ASSETS_PATH?>/images/closeIconDark.svg" alt="close">
                        </button>  
                    </div>
                </div>

                <label for="menu-toggle" class="menu-button"><img id="menu-button-image" src="<?=ASSETS_PATH?>/images/menuIcon.svg" alt="menu"></label>

                <span class="svg-logo">
                    <img  src="<?=ASSETS_PATH?>/images/EHQALogoIcon.svg" alt="EstaHambreQueAta-logo">
                </span>

                <ul class="nav-link-list">
                    <li><a><b>Estambres</b></a>
                        <ul class="nav-link-sub-list">
                            <li><a>Algodón</a></li>
                            <li><a>Lana</a></li>
                            <li><a>Lana merino</a></li>
                            <li><a>Lino</a></li>
                        </ul>
                    </li>

                    <li><a><b>Patrones</b></a>
                        <ul class="nav-link-sub-list">
                            <li><a>Principiantes</a></li>
                            <li><a>Intermedios</a></li>
                            <li><a>Avanzados</a></li>
                        </ul>
                    </li>

                    <li><a><b>Accesorios</b></a>
                        <ul class="nav-link-sub-list">
                            <li><a>Recién agregados</a></li>
                            <li><a>Mejor vendidos</a></li>
                            <li><a>De temporada</a></li>
                        </ul>
                    </li>

                    <li><a><b>Ganchos</b></a>
                        <ul class="nav-link-sub-list">
                            <li><a>Metal</a></li>
                            <li><a>Bambú</a></li>
                            <li><a>Plástico</a></li>
                            <li><a>Vidrio</a></li>
                        </ul>
                    </li>
                </ul>
                
                <div class="nav-button-bar">
                    <button id="search-button" class="search-button" title="Buscar"><img src="<?=ASSETS_PATH?>/images/searchIcon.svg" alt="search"></button>
                    <button class="account-button" title="Crear Cuenta"><a href="<?=SRC_PATH?>/views/loginAccount.php"><img src="<?=ASSETS_PATH?>/images/userIcon.svg" alt="account"></a></button>
                    <button class="cart-button" title="Tienda"><a href="<?=BASE_PATH?>/index.php"><img src="<?=ASSETS_PATH?>/images/cartIcon.svg" alt="cart"></a></button>
                </div>
            </nav>

            <div class="nav-decoration-line"></div>
        </header>