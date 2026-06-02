<?php

/**
 * Entidad que representa la plantilla y estado persistente de un Producto.
 * Soporta la estructura normalizada mediante cruce de tablas (JOIN).
 */
class Product {
    private PDO $pdo;
    
    public $id_product;
    public $id_category;
    public $id_provider;
    public $sku;
    public $name;
    public $description;
    public $price;
    public $stock;
    public $minimum_stock_alert;
    public $is_active;
    public $created_at;

    /* Propiedades virtuales para mantener compatibilidad visual con el frontend actual */
    public $category; 
    public $image;

    /**
     * Constructor de la clase.
     * @param PDO $pdo Conexión activa a la base de datos anuiesne_ehqa.
     */
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Obtiene el catálogo completo cruzando información con categorías e imágenes principales.
     * @return array Arreglo de instancias de Product.
     */
    public function getAll() {
        try {
            $sql = "SELECT p.*, c.name AS category_name, i.image_url 
                    FROM products p
                    LEFT JOIN categories c ON p.id_category = c.id_category
                    LEFT JOIN product_images i ON p.id_product = i.id_product AND i.is_primary = TRUE";
            
            $stmt = $this->pdo->query($sql);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $products = [];
            foreach($rows as $row) {
                $product = new Product($this->pdo);
                $product->id_product          = $row['id_product'];
                $product->id_category         = $row['id_category'];
                $product->id_provider         = $row['id_provider'];
                $product->sku                 = $row['sku'];
                $product->name                = $row['name'];
                $product->description         = $row['description'];
                $product->price               = $row['price'];
                $product->stock               = $row['stock'];
                $product->minimum_stock_alert = $row['minimum_stock_alert'];
                $product->is_active           = $row['is_active'];
                $product->created_at          = $row['created_at'];
                
                $product->category = $row['category_name'] ?? 'general';
                $product->image    = $row['image_url'] ?? 'default.png';
                
                $products[] = $product;
            }
            return $products;
        } catch(PDOException $e) {
            error_log("Error en Product::getAll(): " . $e->getMessage());
            return [];
        }
    }

    /**
     * Busca los detalles de un producto en específico.
     * @param int $id_product Identificador del artículo.
     * @return Product|null
     */
    public function findById($id_product) {
        if(!is_numeric($id_product) || $id_product <= 0) {
            return null;
        }

        try {
            $sql = "SELECT p.*, c.name AS category_name, i.image_url 
                    FROM products p
                    LEFT JOIN categories c ON p.id_category = c.id_category
                    LEFT JOIN product_images i ON p.id_product = i.id_product AND i.is_primary = TRUE
                    WHERE p.id_product = :id_product LIMIT 1";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id_product' => $id_product]);
            $productDetails = $stmt->fetch(PDO::FETCH_ASSOC);

            if(!$productDetails) {
                return null;
            }

            $this->id_product          = $productDetails['id_product'];
            $this->id_category         = $productDetails['id_category'];
            $this->id_provider         = $productDetails['id_provider'];
            $this->sku                 = $productDetails['sku'];
            $this->name                = $productDetails['name'];
            $this->description         = $productDetails['description'];
            $this->price               = $productDetails['price'];
            $this->stock               = $productDetails['stock'];
            $this->minimum_stock_alert = $productDetails['minimum_stock_alert'];
            $this->is_active           = $productDetails['is_active'];
            $this->created_at          = $productDetails['created_at'];

            $this->category = $productDetails['category_name'] ?? 'general';
            $this->image    = $productDetails['image_url'] ?? 'default.png';

            return $this;
        } catch(PDOException $e) {
            error_log("Error en Product::findById(): " . $e->getMessage());
            return null;
        }
    }

    /**
     * Agrega un nuevo producto a la base de datos.
     * @param array $data Atributos del formulario de registro.
     * @return bool
     */
    public function add($data) {
        try {
            $sql = "INSERT INTO products (id_category, name, description, price, stock) 
                    VALUES (:id_category, :name, :description, :price, :stock)";

            $stmt = $this->pdo->prepare($sql);
            $success = $stmt->execute([
                'id_category' => $data['id_category'] ?? 1, // Se asigna una categoría por defecto si no existe
                'name'        => $data['name'],
                'description' => $data['description'],
                'price'       => $data['price'],
                'stock'       => $data['stock'] ?? 10
            ]);

            if ($success && !empty($data['image_url'])) {
                $lastId = $this->pdo->lastInsertId();
                $sqlImg = "INSERT INTO product_images (id_product, image_url, is_primary) VALUES (?, ?, TRUE)";
                $stmtImg = $this->pdo->prepare($sqlImg);
                $stmtImg->execute([$lastId, $data['image_url']]);
            }

            return $success;
        } catch(PDOException $e) {
            error_log("Error en Product::add(): " . $e->getMessage());
            return false;
        }
    }

    /**
     * Actualiza la información de un artículo de manualidades.
     * @param int $id_product
     * @param array $data
     * @return bool
     */
    public function update($id_product, $data) {
        if(!is_numeric($id_product) || $id_product <= 0) {
            return false;
        }

        try {
            $sql = "UPDATE products 
                    SET name = :name, 
                        description = :description, 
                        price = :price,
                        id_category = :id_category
                    WHERE id_product = :id_product";

            $stmt = $this->pdo->prepare($sql);
            $success = $stmt->execute([
                'name'        => $data['name'],
                'description' => $data['description'],
                'price'       => $data['price'],
                'id_category' => $data['id_category'] ?? 1,
                'id_product'  => $id_product
            ]);

            if ($success && !empty($data['image_url'])) {
                $sqlImg = "UPDATE product_images SET image_url = ? WHERE id_product = ? AND is_primary = TRUE";
                $stmtImg = $this->pdo->prepare($sqlImg);
                $stmtImg->execute([$data['image_url'], $id_product]);
            }

            return $success;
        } catch(PDOException $e) {
            error_log("Error en Product::update(): " . $e->getMessage());
            return false;
        }
    }

    /**
     * Ejecuta una eliminación física del producto en el inventario.
     * @param int $id_product
     * @return bool
     */
    public function delete($id_product) {
        if(!is_numeric($id_product) || $id_product <= 0) {
            return false;
        }

        try {
            $sql = "DELETE FROM products WHERE id_product = :id_product LIMIT 1";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute(['id_product' => $id_product]);
        } catch(PDOException $e) {
            error_log("Error en Product::delete(): " . $e->getMessage());
            return false;
        }
    }
    /**
     * Realiza una búsqueda de productos por nombre o descripción.
     * @param string $searchValue Término de búsqueda introducido por el usuario.
     * @return array Retorna un arreglo con [Término, CantidadEncontrada, Productos].
     */
    public function search($searchValue) {
        if(trim($searchValue) === '') {
            return [$searchValue, 0, []];
        }

        try {
            $search = '%' . strtolower($searchValue) . '%';

            // Cruza las tablas para traer la imagen principal y el nombre de la categoría
            $sql = "SELECT p.*, c.name AS category_name, i.image_url 
                    FROM products p
                    LEFT JOIN categories c ON p.id_category = c.id_category
                    LEFT JOIN product_images i ON p.id_product = i.id_product AND i.is_primary = TRUE
                    WHERE LOWER(p.name) LIKE :search OR LOWER(p.description) LIKE :search";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['search' => $search]);

            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $foundProducts = [];
            foreach($rows as $row) {
                $product = new Product($this->pdo);
                $product->id_product  = $row['id_product']; // Regla 18: Llave primaria
                $product->name        = $row['name'];
                $product->description = $row['description'];
                $product->price       = $row['price'];
                
                // Asignación de columnas cruzadas
                $product->category    = $row['category_name'] ?? 'general';
                $product->image       = $row['image_url'] ?? 'default.png';
                
                $foundProducts[] = $product;
            }

            $foundQuantity = count($foundProducts);

            return [$searchValue, $foundQuantity, $foundProducts];

        } catch(PDOException $e) {
            error_log("Error en Product::search(): " . $e->getMessage());
            return [$searchValue, 0, []];
        }
    }
}