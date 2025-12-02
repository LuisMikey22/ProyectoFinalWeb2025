<?php
    class Users {
        private PDO $pdo;
        public $id;
        public $user;
        public $correo;
        public $password;
        public $rol;
        public $description;

        public function __construct(PDO $pdo) {
            $this->pdo = $pdo;
        }

        public function all() {
            try {
                $sql = "SELECT * FROM users";

                $stmt = $this->pdo->query($sql);

                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $users = [];

                foreach($rows as $row) {
                    $user = new Users($this->pdo);
                    $user->id = $row['id'];
                    $user->user = $row['user'];
                    $user->correo = $row['correo'];
                    $user->password = $row['password'];
                    $user->rol = $row['rol'];
                    $user->description = $row['description'];
                    $users[] = $user;
                }

                return $users;
            }catch(PDOException $e) {
                error_log("Error al consultar la base de datos: ". $e->getMessage());
                return [];
            }
        }

        public function view($id) {
            if(!is_numeric($id) || $id <= 0) {
                return null;
            }

            try {
                $sql = "SELECT * FROM users WHERE id = :id LIMIT 1";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute(['id' => $id]);
                $userDetails = $stmt->fetch(PDO::FETCH_ASSOC);   //hacer la vista de los usuarios

                if(!$userDetails) {
                    return null; // Usuario no encontrada
                }

                $this->id = $userDetails['id'];
                $this->user = $userDetails['user'];
                $this->correo = $userDetails['correo'];
                $this->password = $userDetails['password'];
                $this->rol = $userDetails['rol'];
                $this->description = $userDetails['description'];

                return $this;
            }catch(PDOException $e) {
                error_log("Error al consultar la base de datos: " . $e->getMessage());
                return [];
            }
        }

        public function findByEmail($correo) {
            $sql = "SELECT * FROM users WHERE correo = :correo LIMIT 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['correo' => $correo]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if(!$row) return null;

            $user = new Users($this->pdo);
            $user->id = $row['id'];
            $user->user = $row['user'];
            $user->correo = $row['correo'];
            $user->password = $row['password'];
            $user->rol = $row['rol'];
            $user->description = $row['description'];

            return $user;
        }

        public function deleteUser($id) {
            if (!is_numeric($id) || $id <= 0) {
                return false;
            }

            try {
                $sql = "DELETE FROM users WHERE id = :id LIMIT 1";
                $stmt = $this->pdo->prepare($sql);
                return $stmt->execute(['id' => $id]);

            } catch (PDOException $e) {
                error_log("Error al eliminar usuario: " . $e->getMessage());
                return false;
            }
        }

        public function addUser($data) {
            try {
                $sql = "INSERT INTO users (user, correo, password, rol, description) 
                        VALUES (:user, :correo, :password, :rol, :description)";

                $stmt = $this->pdo->prepare($sql);

                return $stmt->execute([
                'user'        => $data['user'],
                'correo'      => $data['correo'],
                'password'    => $data['password'],
                'rol'         => $data['rol'],
                'description' => $data['description']
                ]);

            } catch (PDOException $e) {
                error_log("Error al agregar usuario: " . $e->getMessage());
                return false;
            }
        }

        public function updateUser($id, $data) {
            if (!is_numeric($id) || $id <= 0) {
                return false;
            }

            try {
                $sql = "UPDATE users 
                        SET user = :user, 
                            correo = :correo, 
                            password = :password, 
                            rol = :rol, 
                            description = :description
                        WHERE id = :id";

                $stmt = $this->pdo->prepare($sql);

                return $stmt->execute([
                    'user'        => $data['user'],
                    'correo'      => $data['correo'],
                    'password'    => $data['password'], // puedes usar password_hash() si quieres
                    'rol'         => $data['rol'],
                    'description' => $data['description'],
                    'id'          => $id
                ]);

            } catch (PDOException $e) {
                error_log("Error al actualizar usuario: " . $e->getMessage());
                return false;
            }
        }
    }
?>