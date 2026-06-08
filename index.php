<?php
session_start();
require_once 'Config/config.php';

require_once 'Controller/AuthController.php';
require_once 'Controller/PembeliController.php';
require_once 'Controller/PenjualController.php';
require_once 'Controller/AdminController.php';

function checkRole($allowedRole) {
    if (!isset($_SESSION['role']) || $_SESSION['role'] != $allowedRole) {
        // Jika tidak punya akses, arahkan ke halaman 403 atau dashboard mereka
        echo "<script>alert('Akses Ditolak: Anda tidak memiliki izin.'); window.location='index.php?page=login';</script>";
        exit;
    }
}

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
        $auth = new AuthController($conn);
        if($page === 'login' || $page === 'proses-login') $auth->login();
        if($page === 'ganti-password') $auth->changePassword();
        if($page === 'logout') $auth->logout();
        break;

    case 'pembeli-dashboard':
        checkRole("Pembeli");
        (new PembeliController($conn))->dashboard();
        break;
    case 'kantin-list':
        checkRole("Pembeli");
        (new PembeliController($conn))->listKantin();
        break;
    case 'kantin-detail':
        checkRole("Pembeli");
        (new PembeliController($conn))->detailKantin();
        break;
    case 'tambah-keranjang':
        checkRole("Pembeli");
        (new PembeliController($conn))->addToCart();
        break;
    case 'keranjang':
        checkRole("Pembeli");
        (new PembeliController($conn))->cart();
        break;
    case 'hapus-keranjang':
        checkRole("Pembeli");
        (new PembeliController($conn))->deleteCartItem();
        break;
    case 'update-keranjang':
        checkRole("Pembeli");
        (new PembeliController($conn))->updateTotalCartItem();
        break;
    case 'checkout':
        checkRole("Pembeli");
        (new PembeliController($conn))->checkout();
        break;
    case 'pesanan-diambil':
        checkRole("Pembeli");
        (new PembeliController($conn))->updateStatusAmbil();
        break;

    case 'penjual-dashboard':
        checkRole("Penjual");
        (new PenjualController($conn))->dashboard();
        break;
    case 'penjual-toggle-status':
        checkRole("Penjual");
        (new PenjualController($conn))->toggleStatus();
        break;
    case 'penjual-status-pesanan':
        checkRole("Penjual");
        (new PenjualController($conn))->updateStatusPesanan();
        break;
    case 'penjual-menu':
        checkRole("Penjual");
        (new PenjualController($conn))->menuList();
        break;
    case 'penjual-tambah-menu':
        checkRole("Penjual");
        (new PenjualController($conn))->addMenu();
        break;
    case 'penjual-edit-menu':
        checkRole("Penjual");
        (new PenjualController($conn))->editMenu();
        break;
    case 'penjual-hapus-menu':
        checkRole("Penjual");
        (new PenjualController($conn))->deleteMenu();
        break;

    case 'admin-dashboard':
        checkRole("Admin");
        (new AdminController($conn))->dashboard();
        break;
    case 'admin-edit-user':
        checkRole("Admin");
        (new AdminController($conn))->editUserPage();
        break;
    case 'admin-action-user':
        checkRole("Admin");
        (new AdminController($conn))->manageUsers();
        break;
    case 'admin-action-kantin':
        checkRole("Admin");
        (new AdminController($conn))->manageKantin();
        break;
    case 'admin-delete-trx':
        checkRole("Admin");
        (new AdminController($conn))->deleteTransaction();
        break;

    default:
        echo "<h1>404 Halaman Tidak Ditemukan</h1>";
        break;
}