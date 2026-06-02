<?php
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../helpers/functions.php';

/**
 * Controlador encargado de la gestión de usuarios, perfiles y autenticación.
 */
class UsersController {
    private User $userModel;

    /**
     * Constructor del controlador de usuarios.
     * @param PDO $pdo Conexión activa a la base de datos.
     */
    public function __construct(PDO $pdo) {
        $this->userModel = new User($pdo);
    }

    /**
     * Muestra el formulario de registro de cuenta.
     * @return void
     */
    public function showRegisterForm() {
        return view('account/account.register');
    }

    /**
     * Muestra el formulario de inicio de sesión.
     * @return void
     */
    public function showLoginForm() {
        return view('account/account.login');
    }

    /**
     * Procesa la solicitud de registro de un nuevo usuario.
     * @return void
     */
    public function registerUser() {
        $data = [
            'username'    => $_POST['username'] ?? '',
            'email'       => $_POST['email'] ?? '',
            'password'    => $_POST['password'] ?? '',
            'role'        => $_POST['role'] ?? 'client',
            'description' => $_POST['description'] ?? ''
        ];

        $success = $this->userModel->add($data);

        if (!$success) {
            return view("errors/500", ["msg" => "Error al registrar usuario"]);
        }

        $user = $this->userModel->findByEmail($data['email']);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['id_user'] = $user->id_user; // Adaptado al nuevo ID
        $_SESSION['role'] = $user->role;

        header("Location: " . BASE_PATH . "/account/profile/" . $user->id_user);
        exit();
    }

    /**
     * Procesa las credenciales para iniciar sesión.
     * @return void
     */
    public function loginUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->userModel->findByEmail($email);

            if ($user && password_verify($password, $user->password_hash)) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                $_SESSION['id_user'] = $user->id_user;
                $_SESSION['role']    = $user->role;

                header("Location: " . BASE_PATH . "/account/profile/" . $user->id_user);
                exit();
            }

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['login_error'] = "Credenciales incorrectas.";
            header("Location: " . BASE_PATH . "/login");
            exit();
        }
    }

    /**
     * Cierra la sesión activa del usuario y limpia las cookies.
     * @return void
     */
    public function logoutUser() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $_SESSION = array();
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 3600, '/');
        }
        session_destroy();
        
        header('Location: ' . BASE_PATH);
        exit();
    }

    /**
     * Muestra el perfil público o privado de un usuario.
     * @param int $id Identificador del usuario.
     * @return void
     */
    public function showProfile($id) {
        $user = $this->userModel->findById($id);
        if (!$user) return view('errors/404');

        return view('account/account.profile', ['user' => $user]);
    }

    /**
     * Lista todos los usuarios en el panel de administración.
     * @return void
     */
    public function showUserList() {
        $allUsers = $this->userModel->getAll();
        return view('admin/user.index', ['users' => $allUsers]);
    }

    /**
     * Elimina a un usuario desde el panel de administrador.
     * @param int $id Identificador del usuario.
     * @return void
     */
    public function deleteUser($id) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Evita que el admin se elimine a sí mismo
        if (isset($_SESSION['id_user']) && $_SESSION['id_user'] == $id) {
            return view("errors/500", ["msg" => "No puedes eliminarte a ti mismo"]);
        }

        $success = $this->userModel->delete($id);

        if (!$success) {
            return view("errors/500", ["msg" => "Error al eliminar usuario"]);
        }

        header('Location: ' . BASE_PATH . '/admin/users');
        exit();
    }
}