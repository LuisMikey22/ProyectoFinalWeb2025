<?php 
    require __DIR__ . '/../src/helpers/functions.php';
    include __DIR__.'/../src/Models/Product.php';

    // Obtener ruta limpia desde $_GET['route']
    $route = trim($_GET['route'] ?? '', '/');
    $method = $_SERVER['REQUEST_METHOD'];

    if($route === '' || $route === 'home') {
        return view('home/index');
    }

    if($route === 'products') {
        if($method === 'GET') {
            $productModel = new Product(getPDO());
            $products = $productModel->all(); 
            return view('products/products.index', ['products' => $products]);
        }
    }

    if(preg_match('#^products/(\d+)$#', $route, $matches)) {
        $productId = filter_var($matches[1], FILTER_SANITIZE_NUMBER_INT);

        if($method === 'GET') {
            $productModel = new Product(getPDO());
            $product = $productModel->find($productId);
            return view('products/products.details', ['product' => $product]);
        }
    }

    http_response_code(404);
    return view('errors/404');
