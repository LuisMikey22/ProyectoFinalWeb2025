<?php
    class Product {
        private PDO $pdo;
        public $id;
        public $category;
        public $image;
        public $name;
        public $description;
        public $price;

        public function __construct(PDO $pdo) {
            $this->pdo = $pdo;
        }

        public function all() {
            try {
                $sql = "SELECT * FROM products";

                $stmt = $this->pdo->query($sql);

                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $products = [];

                foreach($rows as $row) {
                    $product = new Product($this->pdo);
                    $product->id = $row['id'];
                    $product->category = $row['category'];
                    $product->image = $row['image'];
                    $product->name = $row['name'];
                    $product->description = $row['description'];
                    $product->price = $row['price'];
                    array_push($products, $product);
                }

                return $products;
            }catch(PDOException $e) {
                error_log("Error al consultar la base de datos: ". $e->getMessage());
                return [];
            }
        }

        public function find($id) {
            if(!is_numeric($id) || $id <= 0) {
                return null;
            }

            try {
                $sql = "SELECT * FROM products WHERE id = :id LIMIT 1";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute(['id' => $id]);
                $productDetails = $stmt->fetch(PDO::FETCH_ASSOC);

                if(!$productDetails) {
                    return null; // Producto no encontrada
                }

                $this->id = $productDetails['id'];
                $this->category = $productDetails['category'];
                $this->image = $productDetails['image'];
                $this->name = $productDetails['name'];
                $this->description = $productDetails['description'];
                $this->price = $productDetails['price'];

                return $this;
            }catch(PDOException $e) {
                error_log("Error al consultar la base de datos: " . $e->getMessage());
                return [];
            }
        }

        /*public function search($searchValue, $allProducts) {
            $foundProducts = [];
            
            $lastPos = 0;
            $positions = [];

            foreach($allProducts as $product) :
                while(($lastPos = mb_strpos(strtolower($product['name']), strtolower($searchValue), $lastPos))!== false) { //si el valor buscado coincide con la descripción
                    array_push($foundProducts, $product);
                    $lastPos = $lastPos + strlen($searchValue);
                }
            endforeach;

            $uniqueProducts = array_map('unserialize', array_unique(array_map('serialize', $foundProducts)));
            $foundQuantity = count($uniqueProducts);

            return [$searchValue, $foundQuantity, $uniqueProducts]; 
        }*/

        public function deleteProduct($id) {
            if (!is_numeric($id) || $id <= 0) {
                return false;
            }

            try {
                $sql = "DELETE FROM products WHERE id = :id LIMIT 1";
                $stmt = $this->pdo->prepare($sql);
                return $stmt->execute(['id' => $id]);

            } catch (PDOException $e) {
                error_log("Error al eliminar producto: " . $e->getMessage());
                return false;
            }
        }

        public function addProduct($data) {
            try {
                $sql = "INSERT INTO products (category, image, name, description, price) 
                        VALUES (:category, :image, :name, :description, :price)";

                $stmt = $this->pdo->prepare($sql);

                return $stmt->execute([
                'category'     => $data['category'],
                'image'        => $data['image'],
                'name'         => $data['name'],
                'description'  => $data['description'],
                'price'        => $data['price']
                ]);

            } catch (PDOException $e) {
                error_log("Error al agregar producto: " . $e->getMessage());
                return false;
            }
        }

        public function updateProduct($id, $data) {
            if (!is_numeric($id) || $id <= 0) {
                return false;
            }

            try {
                $sql = "UPDATE products 
                        SET category = :category, 
                            image = :image, 
                            name = :name, 
                            description = :description, 
                            price = :price
                        WHERE id = :id";

                $stmt = $this->pdo->prepare($sql);

                return $stmt->execute([
                    'category'    => $data['category'],
                    'image'       => $data['image'],
                    'name'        => $data['name'],
                    'description' => $data['description'],
                    'price'       => $data['price'],
                    'id'          => $id
                ]);

            } catch (PDOException $e) {
                error_log("Error al actualizar producto: " . $e->getMessage());
                return false;
            }
        }
    }
?>