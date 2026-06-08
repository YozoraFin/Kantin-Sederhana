<?php
require_once  'Model/KantinModel.php';
require_once  'Model/TransactionModel.php';
require_once  'Model/ProductModel.php';

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
        $kantin = $this->kantinM->getKantinByUserId($_SESSION['user_id']);

        require_once 'view/user/penjual.php'; // Menunggu
    }

    public function updateStatusPesanan() {
        // 1. Ambil parameter dari URL jika diklik via JS Fetch
        $idTrx = $_GET['id_trx'] ?? null;
        $status = $_GET['status'] ?? null;

        // 2. JIKA parameter valid, jalankan update database untuk AJAX
        if ($idTrx && $status) {
            $result = $this->trxM->updateStatus($idTrx, $status);

            header('Content-Type: application/json');
            if ($result) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Gagal memperbarui status di database.']);
            }
            exit(); // Memastikan respons hanya berupa JSON untuk JavaScript
        }
        
        // Jika tidak ada parameter (refresh biasa), abaikan fungsi ini agar rute index.php berlanjut normal
    }

    public function toggleStatus() {
        $toggle = $this->kantinM->toggleStatusKantin($this->kantinId);
        if($toggle) {
            header("Location: index.php?page=penjual-dashboard");
        } else {
            echo "<script>alert('Terjadi kesalahan'); window.location='index.php?page=penjual-dashboard';</script>";
        }
    }

    public function menuList() {
        $menus = $this->productM->getMenuByKantin($this->kantinId);
        require_once 'view/user/listmenu.php'; // Menunggu
    }

    public function addMenu() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->productM->createProduct($_POST['nama'], $_POST['harga'], $_POST['id_kategori'], $this->kantinId, $_POST['deskripsi'], $_POST['Produk_url']);
            header("Location: index.php?page=penjual-menu");
        }
    }

    public function detailMenu() {
        $idProduk = $_GET['id_produk'];
        $data = $this->productM->getProductById($idProduk);
        require_once ''; // Belum
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