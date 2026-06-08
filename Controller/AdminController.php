<?php
require_once 'Model/UserModel.php';
require_once 'Model/KantinModel.php';
require_once 'Model/TransactionModel.php';
require_once 'Model/ProductModel.php';

class AdminController {
    private $userM, $kantinM, $trxM, $productM;

    public function __construct($db) {
        $this->userM = new UserModel($db);
        $this->kantinM = new KantinModel($db);
        $this->trxM = new TransactionModel($db);
        $this->productM = new ProductModel($db);
    }

    public function dashboard() {
        $users = $this->userM->getAllUsers();
        $kantins = $this->kantinM->getAllKantinAdmin();
        $trxs = $this->trxM->getAllTransactionsAdmin();
        require_once 'view/user/cms/homeadmin.php'; // Menunggu
    }

    public function manageUsers() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['create'])) $this->userM->createUser($_POST['nama'], $_POST['email'], $_POST['pass'], $_POST['alamat'], $_POST['role']);
            if(isset($_POST['update'])) $this->userM->updateUser($_POST['id'], $_POST['nama'], $_POST['email'], $_POST['alamat'], $_POST['role']);
        }
        if(isset($_GET['delete'])) $this->userM->deleteUser($_GET['delete']);
        header("Location: index.php?page=admin-dashboard");
    }

    public function editUserPage() {
        $id = $_GET['id'];
        $user = $this->userM->getDetailUser($id);
        require_once 'view/user/cms/updateuser.php'; // Belum
    }

    public function manageKantin() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['create'])) $this->kantinM->createKantin($_POST['nama'], $_POST['telp'], $_POST['id_user'], $_POST['status'], $_POST['Kantin_url']);
            if(isset($_POST['update'])) $this->kantinM->updateKantin($_POST['id'], $_POST['nama'], $_POST['telp'], $_POST['status']);
        }
        if(isset($_GET['delete_kantin'])) $this->kantinM->deleteKantin($_GET['delete_kantin']);
        if(isset($_GET['delete_menu'])) $this->productM->deleteProduct($_GET['delete_menu']);
        header("Location: index.php?page=admin-dashboard");
    }

    public function deleteTransaction() {
        $this->trxM->deleteTransaction($_GET['id_trx']);
        header("Location: index.php?page=admin-dashboard");
    }
}