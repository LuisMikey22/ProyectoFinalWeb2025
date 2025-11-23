<?php 
    require_once __DIR__.'/../config/config.php';
    require_once __DIR__.'/../config/database.php';
    
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

    function getArt($category) {
        $pdo = getPDO();

        try {
            $sql = "SELECT * FROM $category";

            $stmt = $pdo->query($sql);

            $art = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $art;
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
        if($productId === null) {
            return [];
        }

        $urlArray = explode('-', $productId); //separar el string en '-', se crea un arreglo
        $id = $urlArray[0]; //obtener primer elemento (id)
        $category = end($urlArray); //obtener el último elemento (categoría)

        $pdo = getPDO();

        try {
            $sql = "SELECT * FROM $category WHERE id LIKE :id LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => "%$id%"]);
            $productDetails = $stmt->fetch(PDO::FETCH_ASSOC);

            if(!$productDetails) {
                return []; // Carrera no encontrada
            }

            return $productDetails;
        }catch(PDOException $e) {
            error_log("Error al consultar la base de datos: ".$e->getMessage());
            return [];
        }
    }
?>