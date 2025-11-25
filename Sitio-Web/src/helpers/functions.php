<?php 
    require_once __DIR__.'/../config/config.php';
    require_once __DIR__.'/../config/database.php';
    
    function getParsedURL() {
        $scheme = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']==='on'?'https':'http';
        $url = $scheme.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; //url completa
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
    }

    function getProducts() {
        $pdo = getPDO();

        try {
            $sql = "SELECT * FROM `products`";

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
        $pdo = getPDO();

        try {
            $sql = "SELECT * FROM `products` WHERE id = :id LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $productId]);
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

    function getFoundArt($searchValue = null) {
        if($searchValue == null && isset($_GET['search'])){
            $searchValue = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);
        }

        //Si no se envió una carrera
        if($searchValue === null) {
            return [];
        }

        $allProducts = getProducts();
        $foundProducts = array();
        
        $lastPos = 0;
        $positions = array();

        foreach($allProducts as $product) :
            while(($lastPos = mb_strpos(strtolower($product['name']), strtolower($searchValue), $lastPos))!== false) { //si el valor buscado coincide con la descripción
                array_push($foundProducts, $product);
                $lastPos = $lastPos + strlen($searchValue);
            }
        endforeach;

        $uniqueProducts = array_map('unserialize', array_unique(array_map('serialize', $foundProducts)));
        $foundQuantity = count($uniqueProducts);

        return [$searchValue, $foundQuantity, $uniqueProducts]; 
    }
?>