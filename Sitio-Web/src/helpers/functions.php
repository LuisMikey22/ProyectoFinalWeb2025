<?php 
    require __DIR__.'/../config/database.php';

    $config = require __DIR__.'/../config/config.php';
    define('BASE_PATH', $config['base_url']);
    define('ASSETS_PATH', $config['assets_url']);
    define('SRC_PATH', $config['src_url']);


    /*function getParsedURL() {
        $scheme = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']==='on'?'https':'http';
        $url = $scheme . '://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; //url completa
        $parsedUrl = parse_url($url); //obtener componentes de la url
        return $parsedUrl;
    }

    function getLastSegmentURL() {
        $parsedUrl = getParsedURL();

        $path = $parsedUrl['path']; //obtener la url después de 'ProyectoFinalWeb2025'
        $segments = explode('/', $path); //separar el string cada '/', se crea un arreglo

        $lastSegment = end($segments); //obtener último segmento
        $lastSegment = urldecode($lastSegment); //decodificar string dejando solo texto legible 
        return $lastSegment;
    }*/

    function getNewArt() {
        $pdo = getPDO();

        try {
            $sql = "SELECT * FROM `newart` WHERE 1";

            $stmt = $pdo->query($sql);

            $careers = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $careers;
        }catch(PDOException $e) {
            error_log("Error al consultar la base de datos: ". $e->getMessage());
            return [];
        }
    }

    function getBestSellingArt() {
        $pdo = getPDO();

        try {
            $sql = "SELECT * FROM `bestsellingart` WHERE 1";

            $stmt = $pdo->query($sql);

            $careers = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $careers;
        }catch(PDOException $e) {
            error_log("Error al consultar la base de datos: ". $e->getMessage());
            return [];
        }
    }

    function getSeasonalArt() {
        $pdo = getPDO();

        try {
            $sql = "SELECT * FROM `seasonalart` WHERE 1";

            $stmt = $pdo->query($sql);

            $careers = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $careers;
        }catch(PDOException $e) {
            error_log("Error al consultar la base de datos: ". $e->getMessage());
            return [];
        }
    }

    function getProductDetails($productId = null) {
        if($productId == null && isset($_GET['productId'])){
            $productId = filter_input(INPUT_GET, 'productId', FILTER_SANITIZE_STRING);
        }

        //Si no se envió una carrera
        if ($productId === null) {
            return [];
        }

        $pdo = getPDO();

        try {
            $sql = "SELECT * FROM `newart` WHERE id = :id LIMIT 1
                    UNION SELECT * FROM `bestsellingart` WHERE id = :id LIMIT 1
                    UNION SELECT * FROM `seasonalart` WHERE id = :id LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $productId]);
            $productDetails = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$productDetails) {
                return []; // Producto no encontrada
            }

            return $productDetails;
        } catch (PDOException $e) {
            error_log("Error al consultar la base de datos: " . $e->getMessage());
            return [];
        }
    }
?>