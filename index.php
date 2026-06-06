<?php
session_start();
require_once 'config/database.php';

require_once 'Controller/AuthController.php';
require_once 'Controller/PembeliController.php';
require_once 'Controller/PenjualController.php';
require_once 'Controller/AdminController.php';

$page = $_GET['page'] ?? 'login';


if (!isset($_SESSION['user_id']) && $page !== 'login' && $page !== 'proses-login') {
    header("Location: index.php?page=login");
    exit;
}

switch ($page) {
    case 'login':
    case 'proses-login':
    case 'logout':
    case 'ganti-password':
        require_once 'Controller/AuthController.php';
        $auth = new AuthController($conn);
        if($page === 'login' || $page === 'proses-login') $auth->login();
        if($page === 'ganti-password') $auth->changePassword();
        if($page === 'logout') $auth->logout();
        break;

    case 'pembeli-dashboard':
        (new PembeliController($conn))->dashboard();
        break;
    case 'kantin-list':
        (new PembeliController($conn))->listKantin();
        break;
    case 'kantin-detail':
        (new PembeliController($conn))->detailKantin();
        break;
    case 'tambah-keranjang':
        (new PembeliController($conn))->addToCart();
        break;
    case 'keranjang':
        (new PembeliController($conn))->cart();
        break;
    case 'hapus-keranjang':
        (new PembeliController($conn))->deleteCartItem();
        break;
    case 'checkout':
        (new PembeliController($conn))->checkout();
        break;
    case 'pesanan-diambil':
        (new PembeliController($conn))->updateStatusAmbil();
        break;

    case 'penjual-dashboard':
        (new PenjualController($conn))->dashboard();
        break;
    case 'penjual-status-pesanan':
        (new PenjualController($conn))->updateStatusPesanan();
        break;
    case 'penjual-menu':
        (new PenjualController($conn))->menuList();
        break;
    case 'penjual-tambah-menu':
        (new PenjualController($conn))->addMenu();
        break;
    case 'penjual-edit-menu':
        (new PenjualController($conn))->editMenu();
        break;
    case 'penjual-hapus-menu':
        (new PenjualController($conn))->deleteMenu();
        break;

    case 'admin-dashboard':
        (new AdminController($conn))->dashboard();
        break;
    case 'admin-action-user':
        (new AdminController($conn))->manageUsers();
        break;
    case 'admin-action-kantin':
        (new AdminController($conn))->manageKantin();
        break;
    case 'admin-delete-trx':
        (new AdminController($conn))->deleteTransaction();
        break;

    default:
        echo "<h1>404 Halaman Tidak Ditemukan</h1>";
        break;
}