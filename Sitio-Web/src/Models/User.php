<?php

/**
 * Entidad que representa la plantilla y estado persistente de un Usuario.
 * Mapea directamente con la tabla 'users' de la base de datos.
 */
class User {
    private PDO $pdo;
    
    public $id_user;
    public $username;
    public $email;
    public $password_hash;
    public $role;
    public $description;
    public $created_at;

    /**
     * Constructor de la clase.
     * @param PDO $pdo Conexión activa a la base de datos anuiesne_ehqa.
     */
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Obtiene todos los usuarios registrados en el sistema.
     * @return array Arreglo de instancias de la clase User.
     */
    public function getAll() {
        try {
            $sql = "SELECT * FROM users";
            $stmt = $this->pdo->query($sql);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $users = [];
            foreach($rows as $row) {
                $user = new User($this->pdo);
                $user->id_user       = $row['id_user'];
                $user->username      = $row['username'];
                $user->email         = $row['email'];
                $user->password_hash = $row['password_hash'];
                $user->role          = $row['role'];
                $user->description   = $row['description'];
                $user->created_at    = $row['created_at'];
                $users[]             = $user;
            }
            return $users;
        } catch(PDOException $e) {
            error_log("Error en User::getAll(): " . $e->getMessage());
            return [];
        }
    }

    /**
     * Busca un usuario específico mediante su identificador principal.
     * @param int $id_user Identificador único del usuario.
     * @return User|null Retorna el objeto del usuario o nulo si no se encuentra.
     */
    public function findById($id_user) {
        if(!is_numeric($id_user) || $id_user <= 0) {
            return null;
        }

        try {
            $sql = "SELECT * FROM users WHERE id_user = :id_user LIMIT 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id_user' => $id_user]);
            $userDetails = $stmt->fetch(PDO::FETCH_ASSOC);

            if(!$userDetails) {
                return null;
            }

            $this->id_user       = $userDetails['id_user'];
            $this->username      = $userDetails['username'];
            $this->email         = $userDetails['email'];
            $this->password_hash = $userDetails['password_hash'];
            $this->role          = $userDetails['role'];
            $this->description   = $userDetails['description'];
            $this->created_at    = $userDetails['created_at'];

            return $this;
        } catch(PDOException $e) {
            error_log("Error en User::findById(): " . $e->getMessage());
            return null;
        }
    }

    /**
     * Localiza a un usuario mediante su correo electrónico (utilizado en el Login).
     * @param string $email Correo electrónico registrado.
     * @return User|null
     */
    public function findByEmail($email) {
        try {
            $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['email' => $email]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if(!$row) return null;

            $user = new User($this->pdo);
            $user->id_user       = $row['id_user'];
            $user->username      = $row['username'];
            $user->email         = $row['email'];
            $user->password_hash = $row['password_hash'];
            $user->role          = $row['role'];
            $user->description   = $row['description'];
            $user->created_at    = $row['created_at'];

            return $user;
        } catch(PDOException $e) {
            error_log("Error en User::findByEmail(): " . $e->getMessage());
            return null;
        }
    }

    /**
     * Agrega un nuevo registro de usuario a la base de datos aplicando encriptación.
     * @param array $data Arreglo asociativo con la información capturada en el formulario.
     * @return bool Verdadero si la inserción fue exitosa.
     */
    public function add($data) {
        try {
            $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (username, email, password_hash, role, description) 
                    VALUES (:username, :email, :password_hash, :role, :description)";

            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                'username'      => $data['username'],
                'email'         => $data['email'],
                'password_hash' => $hashedPassword,
                'role'          => $data['role'],
                'description'   => $data['description']
            ]);
        } catch (PDOException $e) {
            error_log("Error en User::add(): " . $e->getMessage());
            return false;
        }
    }

    /**
     * Actualiza la información de perfil de un usuario existente.
     * @param int $id_user Identificador del usuario a modificar.
     * @param array $data Arreglo con la nueva información.
     * @return bool
     */
    public function update($id_user, $data) {
        if (!is_numeric($id_user) || $id_user <= 0) {
            return false;
        }

        try {
            if (isset($data['password']) && !empty($data['password'])) {
                $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
            } else {
                $current = $this->findById($id_user);
                $hashedPassword = $current->password_hash;
            }

            $sql = "UPDATE users 
                    SET username = :username, 
                        email = :email, 
                        password_hash = :password_hash, 
                        role = :role, 
                        description = :description
                    WHERE id_user = :id_user";

            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                'username'      => $data['username'],
                'email'         => $data['email'],
                'password_hash' => $hashedPassword,
                'role'          => $data['role'],
                'description'   => $data['description'],
                'id_user'       => $id_user
            ]);
        } catch (PDOException $e) {
            error_log("Error en User::update(): " . $e->getMessage());
            return false;
        }
    }

    /**
     * Ejecuta una eliminación física del registro del usuario.
     * @param int $id_user Identificador único.
     * @return bool
     */
    public function delete($id_user) {
        if (!is_numeric($id_user) || $id_user <= 0) {
            return false;
        }

        try {
            $sql = "DELETE FROM users WHERE id_user = :id_user LIMIT 1";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute(['id_user' => $id_user]);
        } catch (PDOException $e) {
            error_log("Error en User::delete(): " . $e->getMessage());
            return false;
        }
    }
}