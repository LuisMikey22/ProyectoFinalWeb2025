<?php
require __DIR__ . '/../Models/Users.php';

class UsersController {

    private Users $users;

    public function __construct(PDO $pdo) {
        $this->users = new Users($pdo);
    }

    public function showRegisterForm() {
        return view('account/account.register');
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ?route=account');
            exit;
        }

        $data = [
            'user'        => $_POST['user'] ?? '',
            'correo'      => $_POST['correo'] ?? '',
            'password'    => password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT),
            'rol'         => 'user',
            'description' => $_POST['description'] ?? ''
        ];

        $ok = $this->users->addUser($data);

        if ($ok) {
            header('Location: ?route=login&success=1');
        } else {
            header('Location: ?route=account&error=1');
        }
        exit;
    }
}
