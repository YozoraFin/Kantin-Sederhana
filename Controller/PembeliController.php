<?php
require_once 'Model/KantinModel.php';
require_once 'Model/ProductModel.php';
require_once 'Model/CartModel.php';
require_once 'Model/TransactionModel.php';  

class PembeliController {
    private $kantinM, $productM, $cartM, $trxM;

    public function __construct($db) {
        $this->kantinM = new KantinModel($db);
        $this->productM = new ProductModel($db);
        $this->cartM = new CartModel($db);
        $this->trxM = new TransactionModel($db);
    }

    public function dashboard() {
        $ongoing = $this->trxM->getOrdersByPembeli($_SESSION['user_id'], true);
        $history = $this->trxM->getOrdersByPembeli($_SESSION['user_id'], false);
        require_once 'view/user/home.php'; // Sudah Diubah
    }

    public function listKantin() {
        $keyword = $_GET['search'] ?? '';
        $kantins = (!empty($keyword)) ? $this->kantinM->searchKantin($keyword) : $this->kantinM->getAllKantin();
        require_once 'view/user/tenant.php'; // Menunggu
    }

    public function detailKantin() {
        $idKantin = $_GET['id'];
        $kantin = $this->kantinM->getKantinById($idKantin);
        $menus = $this->productM->getMenuByKantin($idKantin);
        require_once 'view/user/detail_kantin.php'; // tak tambahin detail kantin.php
    }

    public function addToCart() {
        $idProduk = $_GET['id_produk'];
        $idKantin = $_GET['id_kantin'];
        $product = $this->productM->getProductById($idProduk);
        
        $idCart = $this->cartM->getOrCreateCart($_SESSION['user_id'], $idKantin);
        $this->cartM->addToCart($idCart, $idProduk, $product['Harga_Produk']);
        header("Location: index.php?page=kantin-detail&id=" . $idKantin);
    }

    public function cart() {
        $items = $this->cartM->getCartContent($_SESSION['user_id']);
        require_once 'view/user/keranjang.php'; // 
    }

    public function deleteCartItem() {
        $this->cartM->deleteItem($_GET['id_detail']);
        header("Location: index.php?page=keranjang");
    }

    public function checkout() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idKantin = $_POST['id_kantin'];
            $catatan = $_POST['catatan'];
            $idCart = $this->trxM->checkout($_SESSION['user_id'], $idKantin, $catatan);
            if($idCart) {
                $this->cartM->clearCart($idCart);
            }
            header("Location: index.php?page=pembeli-dashboard");
        }
    }

    public function updateStatusAmbil() {
        $this->trxM->updateStatus($_GET['id_trx'], 'Selesai');
        header("Location: index.php?page=pembeli-dashboard");
    }
}