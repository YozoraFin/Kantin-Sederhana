<?php
require_once 'app/models/KantinModel.php';
require_once 'app/models/TransactionModel.php';
require_once 'app/models/ProductModel.php';

class PenjualController {
    private $kantinM, $trxM, $productM, $kantinId;

    public function __construct($db) {
        $this->kantinM = new KantinModel($db);
        $this->trxM = new TransactionModel($db);
        $this->productM = new ProductModel($db);
        
        $kantin = $this->kantinM->getKantinByUserId($_SESSION['user_id']);
        $this->kantinId = $kantin['ID_Kantin'] ?? null;
    }

    public function dashboard() {
        $revenue = $this->kantinM->getTotalRevenue($this->kantinId);
        $incoming = $this->trxM->getOrdersByPenjual($this->kantinId, 'Proses');
        require_once 'view/user/pesanan.php'; // Menunggu
    }

    public function updateStatusPesanan() {
        $idTrx = $_GET['id_trx'];
        $status = $_GET['status']; // 'Siap' atau 'Ditolak'
        $this->trxM->updateStatus($idTrx, $status);
        header("Location: index.php?page=penjual-dashboard");
    }

    public function menuList() {
        $menus = $this->productM->getMenuByKantin($this->kantinId);
        require_once 'app/views/penjual/menu.php'; // Menunggu
    }

    public function addMenu() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->productM->createProduct($_POST['nama'], $_POST['harga'], $_POST['id_kategori'], $this->kantinId, $_POST['deskripsi']);
            header("Location: index.php?page=penjual-menu");
        }
    }

    public function editMenu() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->productM->updateProduct($_POST['id_produk'], $_POST['nama'], $_POST['harga'], $_POST['id_kategori'], $_POST['deskripsi']);
            header("Location: index.php?page=penjual-menu");
        }
    }

    public function deleteMenu() {
        $this->productM->deleteProduct($_GET['id']);
        header("Location: index.php?page=penjual-menu");
    }
}