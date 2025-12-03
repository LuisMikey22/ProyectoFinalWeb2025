<?php
require __DIR__ . '/../Models/Users.php';
require_once __DIR__ . '/../helpers/functions.php';

class UsersController {

    private Users $users;

    public function __construct(PDO $pdo) {
        $this->users = new Users($pdo);
    }

    public function showRegisterForm() {
        return view('account/account.register');
    }

    public function showLoginForm(){
        return view('account/account.login');
    }

    public function register() {
        $data = [
            'user'        => $_POST['user'] ?? '',
            'correo'      => $_POST['correo'] ?? '',
            'password'    => $_POST['password'] ?? '',
            'rol'         => $_POST['rol'] ?? '',
            'description' => $_POST['description'] ?? ''
        ];

        $ok = $this->users->addUser($data);

        if(!$ok){
            return view("errors/500", ["msg"=>"Error al registrar usuario"]);
        }

        $user = $this->users->findByEmail($data['correo']);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['user_id'] = $user->id;

        return view("account/account.profile", ["user" => $user]);
    }

    public function logIn() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $correo = $_POST['correo'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->users->findByEmail($correo);

        if(!$user || !password_verify($password, $user->password)){
            return view('account/account.login', ["error" => "Credenciales incorrectas"]);
        }

        $_SESSION['user_id'] = $user->id;

        return view('account/account.profile', ["user" => $user]);
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $_SESSION = array();
        
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time()-3600, '/');
        }
        
        session_destroy();
        
        header('Location: ' . BASE_PATH);
        exit();
    }

    public function profile($id) {
        $user = $this->users->view($id);

        return view('account/account.profile', [
            'user' => $user
        ]);
    }

    public function listUsers() {
        $allUsers = $this->users->all();
        
        return view('admin/user.index', [
            'users' => $allUsers
        ]);
    }

    public function showUserDetails($id) {
        $user = $this->users->view($id);

        if (!$user) {
            return view('errors/404');
        }

        return view('admin/user.details', [
            'user' => $user
        ]);
    }

    public function showAddUserForm() {
        return view('admin/user.add');
    }

    public function createUser() {
        $data = [
            'user'        => $_POST['user'] ?? '',
            'correo'      => $_POST['correo'] ?? '',
            'password'    => $_POST['password'] ?? '',
            'rol'         => $_POST['rol'] ?? 'user',
            'description' => $_POST['description'] ?? ''
        ];

        $ok = $this->users->addUser($data);

        if(!$ok){
            return view("errors/500", ["msg"=>"Error al crear usuario"]);
        }

        header('Location: ' . BASE_PATH . '/admin/users');
        exit();
    }

    public function showModUserForm($id) {
        $user = $this->users->view($id);

        if (!$user) {
            return view('errors/404');
        }

        return view('admin/user.mod', [
            'user' => $user
        ]);
    }

    public function updateUser($id) {
        $user = $this->users->view($id);

        if (!$user) {
            return view('errors/404');
        }

        $data = [
            'user'        => $_POST['user'] ?? $user->user,
            'correo'      => $_POST['correo'] ?? $user->correo,
            'rol'         => $_POST['rol'] ?? $user->rol,
            'description' => $_POST['description'] ?? $user->description,
            'password'    => $user->password
        ];
    
        if (!empty($_POST['password'])) {
            $data['password'] = $_POST['password'];
        }

        $ok = $this->users->updateUser($id, $data);

        if (!$ok) {
            return view("errors/500", ["msg"=>"Error al actualizar usuario"]);
        }

        header('Location: ' . BASE_PATH . '/admin/users/' . $id);
        exit();
    }

    public function deleteUser($id) {
        $user = $this->users->view($id);

        if (!$user) {
            return view('errors/404');
        }

        // evita que eliminarse a si mismo
        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $id) {
            return view("errors/500", ["msg"=>"No puedes eliminarte a ti mismo"]);
        }

        $ok = $this->users->deleteUser($id);

        if (!$ok) {
            return view("errors/500", ["msg"=>"Error al eliminar usuario"]);
        }

        return view('admin/user.delete', [
            'name' => $user->user,
            'id' => $id
        ]);
    }

}
