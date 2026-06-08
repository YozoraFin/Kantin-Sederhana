<?php
require_once 'Model/UserModel.php';

class AuthController {
    private $userModel;

    public function __construct($db) { $this->userModel = new UserModel($db); }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $this->userModel->login($_POST['email'], $_POST['password']);
            if ($user) {
                $_SESSION['user_id'] = $user['ID_User'];
                $_SESSION['role'] = $user['Role_User'];
                $_SESSION['name'] = $user['Nama_User'];

                // Redirect sesuai role
                if ($user['Role_User'] === 'Pembeli') header("Location: index.php?page=pembeli-dashboard");
                elseif ($user['Role_User'] === 'Penjual') header("Location: index.php?page=penjual-dashboard");
                elseif ($user['Role_User'] === 'Admin') header("Location: index.php?page=admin-dashboard");
            } else {
                $error = "Email atau password salah!";
                require_once 'view/user/login.php'; // Menunggu
            }
        } else {
            require_once 'view/user/login.php'; // Menunggu
        }
    }

    public function changePassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->userModel->updatePassword($_SESSION['user_id'], $_POST['new_password']);
            echo "<script>alert('Password berhasil diubah!'); window.location='index.php';</script>";
        }
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?page=login");
    }
}