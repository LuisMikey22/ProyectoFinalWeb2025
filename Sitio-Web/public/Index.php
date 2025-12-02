<?php 
    require __DIR__ . '/../src/helpers/functions.php';
    include __DIR__.'/../src/controllers/UsersController.php';
    include __DIR__.'/../src/Models/Product.php';
    include __DIR__.'/../src/Models/User.php';

    // Obtener ruta limpia desde $_GET['route']
    $route = trim($_GET['route'] ?? '', '/');
    $method = $_SERVER['REQUEST_METHOD'];

    if($route === '' || $route === 'home') {
        return view('home/index');
    }

    if($route === 'search') {
        return view('search/index');
    }

    if($route === 'admin') {
        if($method === 'GET') {
            $productModel = new Product(getPDO());
            $products = $productModel->all(); 
            return view('admin/products.index', ['products' => $products]);
        }
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

    if(preg_match('#^search/(\d+)$#', $route, $matches)) {
        $searchId = filter_var($matches[1], FILTER_SANITIZE_NUMBER_INT);

        if($method === 'GET') {
            $searchModel = new Product(getPDO());
            $search = $searchModel->search($searchId);
            return view('search/search.index', ['search' => $search]);
        }
    }

    if (preg_match('#^products/mod/(\d+)$#', $route, $matches)) {
        $id = (int)$matches[1];

        if ($method === 'GET') {
            $productModel = new Product(getPDO());
            $product = $productModel->find($id);
            return view('products/products.mod', ['product' => $product]);
        }
    }

    if (preg_match('#^products/update/(\d+)$#', $route, $matches)) {
    $id = (int)$matches[1];

        if ($method === 'POST') {

            $pdo = getPDO();
            $productModel = new Product($pdo);

            $product = $productModel->find($id);
            if (!$product) {
                die("Producto no encontrado");
            }

            $name        = $_POST['name'] ?? '';
            $category    = $_POST['category'] ?? '';
            $price       = $_POST['price'] ?? 0;
            $description = $_POST['description'] ?? '';
            $image       = $product->image;

            if (!empty($_FILES['image']['name'])) {
                $tmp       = $_FILES['image']['tmp_name'];
                $fileName  = time() . "_" . basename($_FILES['image']['name']);
                $destino   = __DIR__ . "/assets/images/" . $fileName;

                if (move_uploaded_file($tmp, $destino)) {
                    $image = $fileName;
                }
            }

            $ok = $productModel->updateProduct($id, [
                'name'        => $name,
                'category'    => $category,
                'price'       => $price,
                'description' => $description,
                'image'       => $image
            ]);

            if (!$ok) {
                die("Error al actualizar el producto.");
            }

            $updatedProduct = $productModel->find($id);

            return view('products/products.update', [
                'product' => $updatedProduct
            ]);
        }
    }

    if (preg_match('#^products/delete/(\d+)$#', $route, $matches)) {
        $id = (int)$matches[1];

        if ($method === 'GET') {

            $pdo = getPDO();
            $productModel = new Product($pdo);

            $product = $productModel->find($id);

            if (!$product) {
                return view('errors/404');
            }

            $ok = $productModel->deleteProduct($id);

            if (!$ok) {
                die("Error al eliminar producto.");
            }

            return view("products/products.delete", [
                "name" => $product->name,
                "id"   => $id
            ]);
        }
    }

    if ($route === 'products/add' && $method === 'GET') {
        return view('products/products.add');
    }

    if ($route === 'products/create' && $method === 'POST') {

        $productModel = new Product(getPDO());

        $name        = $_POST['name'] ?? '';
        $category    = $_POST['category'] ?? '';
        $price       = $_POST['price'] ?? '';
        $description = $_POST['description'] ?? '';

        $imageName = null;

        if (!empty($_FILES['image']['name'])) {
            
            $uploadsDir = __DIR__ . "/assets/images/";

            if (!is_dir($uploadsDir)) {
                mkdir($uploadsDir, 0777, true);
            }

            $imageName = time() . "_" . basename($_FILES['image']['name']);

            $destino = $uploadsDir . $imageName;

            move_uploaded_file($_FILES['image']['tmp_name'], $destino);
        }

        $productModel->addProduct([
            'name'        => $name,
            'category'    => $category,
            'price'       => $price,
            'description' => $description,
            'image'       => $imageName
        ]);

        header("Location: " . BASE_PATH . "/products");
        exit;
    }

    if($route === 'account') {
        return view('account/account.register');
    }

    if ($route === 'account/register' && $method === 'GET') {
        $controller = new UsersController(getPDO());
        return $controller->showRegisterForm();
    }

    if ($route === 'account/register' && $method === 'POST') {
        $controller = new UsersController(getPDO());
        return $controller->register();
    }

    if (preg_match('#^account/profile/(\d+)$#', $route, $matches)) {
        $id = (int)$matches[1];

        $pdo = getPDO();
        $controller = new UsersController($pdo);

        return $controller->profile($id);
    }

    http_response_code(404);
    return view('errors/404');
