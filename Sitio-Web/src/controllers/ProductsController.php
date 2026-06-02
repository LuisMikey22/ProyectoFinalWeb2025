<?php
require_once __DIR__ . '/../Models/Product.php';
require_once __DIR__ . '/../helpers/functions.php';

/**
 * Controlador encargado de gestionar el catálogo de productos.
 * Todas las funciones están en inglés, siguiendo el estándar del proyecto.
 */
class ProductsController {
    private Product $productModel;

    /**
     * Constructor que inyecta la dependencia de la base de datos.
     * @param PDO $pdo Conexión a la base de datos anuiesne_ehqa.
     */
    public function __construct(PDO $pdo) {
        $this->productModel = new Product($pdo);
    }

    /**
     * Muestra la vista principal con el listado de todos los productos.
     * @return void
     */
    public function showList() {
        $products = $this->productModel->getAll();
        return view('admin/products.index', ['products' => $products]);
    }

    /**
     * Muestra los detalles de un producto específico.
     * @param int $id Identificador del producto (id_product).
     * @return void
     */
    public function showDetails($id) {
        $product = $this->productModel->findById($id);
        if (!$product) {
            return view('errors/404');
        }
        return view('products/products.details', ['product' => $product]);
    }

    /**
     * Muestra el formulario para modificar un producto existente.
     * @param int $id Identificador del producto.
     * @return void
     */
    public function showEditForm($id) {
        $product = $this->productModel->findById($id);
        if (!$product) {
            return view('errors/404');
        }
        return view('admin/products.mod', ['product' => $product]);
    }

    /**
     * Procesa la actualización de datos de un producto en la base de datos.
     * @param int $id Identificador del producto a actualizar.
     * @return void
     */
    public function updateProduct($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return view('errors/500', ['msg' => 'Invalid method']);
        }

        $data = [
            'name'        => $_POST['name'] ?? '',
            'id_category' => $_POST['id_category'] ?? 1,
            'price'       => $_POST['price'] ?? 0,
            'description' => $_POST['description'] ?? '',
            'image_url'   => ''
        ];

        // Lógica de subida de imagen
        if (!empty($_FILES['image']['name'])) {
            $filename = time() . "_" . basename($_FILES['image']['name']);
            $path = __DIR__ . "/../../public/assets/images/" . $filename;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
                $data['image_url'] = $filename;
            }
        }

        $success = $this->productModel->update($id, $data);

        if (!$success) {
            return view('errors/500', ['msg' => 'Error al actualizar el producto']);
        }

        header("Location: " . BASE_PATH . "/products/$id");
        exit;
    }

    /**
     * Elimina un producto del catálogo.
     * @param int $id Identificador del producto.
     * @return void
     */
    public function deleteProduct($id) {
        $success = $this->productModel->delete($id);

        if ($success) {
            header("Location: " . BASE_PATH . "/admin/products");
            exit;
        } else {
            return view('errors/500', ['msg' => 'Error al eliminar el producto.']);
        }
    }

    /**
     * Muestra el formulario para registrar un nuevo producto.
     * @return void
     */
    public function showAddForm() {
        return view('admin/products.add');
    }

    /**
     * Procesa la creación de un nuevo producto en la base de datos.
     * @return void
     */
    public function createProduct() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return view('errors/500', ['msg' => 'Invalid method']);
        }

        $data = [
            'id_category' => $_POST['id_category'] ?? 1,
            'name'        => $_POST['name'] ?? '',
            'description' => $_POST['description'] ?? '',
            'price'       => $_POST['price'] ?? 0,
            'stock'       => $_POST['stock'] ?? 10,
            'image_url'   => ''
        ];

        if (!empty($_FILES['image']['name'])) {
            $filename = time() . "_" . basename($_FILES['image']['name']);
            $path = __DIR__ . "/../../public/assets/images/" . $filename;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
                $data['image_url'] = $filename;
            }
        }

        $success = $this->productModel->add($data);

        if ($success) {
            header("Location: " . BASE_PATH . "/admin/products");
            exit;
        } else {
            return view('errors/500', ['msg' => 'Error al agregar producto.']);
        }
    }
}