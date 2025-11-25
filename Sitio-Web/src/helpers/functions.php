<?php 
    require __DIR__.'/../config/database.php';
    
    $config = require __DIR__.'/../config/config.php';
    define('BASE_PATH', $config['base_url']);
    define('ASSETS_PATH', $config['assets_url']);

    function view($template, $data = []) {
        // Convierte cada clave del array en una variable
        extract($data);

        // Rutas absolutas
        $viewsPath = __DIR__.'/../views/';
        $partialPath = $viewsPath.'partials/';

        // Header
        require $partialPath.'nav.php';

        // Vista solicitada
        require $viewsPath.$template.'.php';
        
        // Footer
        require $partialPath.'footer.php';
    }
?>