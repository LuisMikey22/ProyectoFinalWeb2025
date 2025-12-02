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

        return view("account/account.profile", ["user" => $data]);
    }

    public function logIn() {
        $correo = $_POST['correo'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->users->findByEmail($correo);

        if(!$user || $user->password !== $password){
            return view('account/account.login', ["error" => "Credenciales incorrectas"]);
        }

        $_SESSION['user_id'] = $user->id;

        return view('account/account.profile', ["user" => $user]);
    }

    public function profile($id) {
        $user = $this->users->view($id);

        return view('account/account.profile', [
            'user' => $user
        ]);
    }

}
