<?php
    if (!defined('ROOT_PATH')) {
        define('ROOT_PATH', dirname(__DIR__, 2));
    }
    
    $port = $_SERVER['SERVER_PORT'] ?? '80';

    if (!defined('BASE_PATH')) {
        if ($port == '8080' || $port >= 3000) {
            define('BASE_PATH', '/ProyectoFinalWeb2025/Sitio-Web/public');
            define('SRC_PATH', '/ProyectoFinalWeb2025/Sitio-Web/src');
            define('ASSETS_PATH', '/ProyectoFinalWeb2025/Sitio-Web/public/assets');
        } else {
            define('BASE_PATH', '/ProyectoFinalWeb2025/Sitio-Web/public');
            define('SRC_PATH', '/ProyectoFinalWeb2025/Sitio-Web/src');
            define('ASSETS_PATH', '/ProyectoFinalWeb2025/Sitio-Web/public/assets');
        }
    }
    
    if (!class_exists('Dotenv\Dotenv')) {
        require __DIR__ . '/../../vendor/autoload.php';
    }

    if (!isset($_ENV['DB_CONNECTION'])) {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../../');
        $dotenv->load();
    }

    return [
        'db' => [
            'connection' => $_ENV['DB_CONNECTION'],
            'host' => $_ENV['DB_HOST'],
            'name' => $_ENV['DB_DATABASE'],
            'user' => $_ENV['DB_USERNAME'],
            'password' => $_ENV['DB_PASSWORD'],
            'port' => $_ENV['DB_PORT'],
            'charset' => $_ENV['DB_CHARSET']
        ]
    ];
?>