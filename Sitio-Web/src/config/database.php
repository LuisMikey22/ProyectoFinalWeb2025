<?php 
    function getPDO() : PDO {
        static $pdo = null;

        if($pdo === null) {
            $config = require __DIR__.'/config.php';
            $db = $config['db'];

            try {
                $pdo = new PDO("mysql:host={$db['host']};dbname={$db['name']};charset={$db['charset']}", 
                $db['user'], 
                $db['password']);
            }catch(PDOException $e) {
                die("Error en conexión a la base de datos: " . $e->getMessage());
            }
        }

        return $pdo;
    }
?>