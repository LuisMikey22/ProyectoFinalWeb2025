<?php

require_once __DIR__ . '/../Models/Product.php';
require_once __DIR__ . '/../helpers/functions.php';

class ProductsController
{
    public function index()
    {
        $productModel = new Product(getPDO());
        $products = $productModel->all();

        return view('products/products.index', [
            'products' => $products
        ]);
    }

    public function show($id)
    {
        $productModel = new Product(getPDO());
        $product = $productModel->find($id);

        return view('products/products.details', [
            'product' => $product
        ]);
    }

    public function mod($id)
    {
        $productModel = new Product(getPDO());
        $product = $productModel->find($id);

        return view('products/products.mod', [
            'product' => $product
        ]);
    }

    public function update($id)
    {
        $productModel = new Product(getPDO());

        $data = [
            'name'        => $_POST['name'],
            'category'    => $_POST['category'],
            'price'       => $_POST['price'],
            'description' => $_POST['description'],
            'image'       => $_POST['old_image'] ?? ''
        ];

        if (!empty($_FILES['image']['name'])) {
            $filename = time() . "_" . basename($_FILES['image']['name']);
            $path = __DIR__ . "/../../public/assets/images/" . $filename;

            move_uploaded_file($_FILES['image']['tmp_name'], $path);
            $data['image'] = $filename;
        }

        $productModel->updateProduct($id, $data);

        header("Location: " . BASE_PATH . "/products/$id");
        exit;
    }

    public function delete($id)
    {
        if (!is_numeric($id) || $id <= 0) {
            $mensaje = "ID inválido.";
            include ROOT_PATH . "/Sitio-Web/views/products/products.update.php";
            return;
        }

        $result = $this->model->deleteProduct($id);

        if ($result) {
            $mensaje = "Producto eliminado correctamente.";
            include ROOT_PATH . "/Sitio-Web/views/products/products.update.php";
        } else {
            $mensaje = "Error al eliminar el producto.";
            include ROOT_PATH . "/Sitio-Web/views/products/products.update.php";
        }
    }
}