<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../src/style.css">
    <title>Keranjang Belanja - SIKANTIN</title>
</head>
<body>

    <!-- NAVBAR MAHASISWA -->
    <header>
        <nav class="navbar">
            <a href="#" class="nav-logo"><h2 class="logo-text">SIKANTIN</h2></a>
            <ul class="nav-menu">
                <li class="nav-item"><a href="home.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="tenant.php" class="nav-link">Tenant</a></li>
                <li class="nav-item"><a href="pesanan.php" class="nav-link">Pesanan</a></li>
            </ul>
            <div class="nav-actions">
                <a href="profil.php" class="nav-profil"><i class="fa-solid fa-circle-user"></i></a>
                <a href="keranjang.php" class="nav-cart active"><i class="fa-solid fa-cart-shopping"></i></a>
            </div>
        </nav>
    </header>

    <!-- FORM UTAMA CHECKOUT -->
    <!-- Action form diarahkan ke file proses transaksi backend-mu -->
    <form action="proses_checkout.php" method="POST">
        
        <!-- ID_Kantin dikirim sembunyi (hidden) karena model checkout() butuh data ini -->
        <input type="hidden" name="id_kantin" value="1"> 

        <div class="cart-container">
            
            <!-- KIRI: DAFTAR ITEM MAKANAN -->
            <div class="cart-section">
                <div class="cart-title">
                    <i class="fa-solid fa-store" style="color: #013220;"></i> Pesanan dari: <strong>Warung Berkah</strong>
                </div>

                <!-- Item 1 -->
                <div class="cart-item">
                    <img src="https://images.unsplash.com/photo-1512058564366-18510be2db19?w=200" class="cart-item-img" alt="Nasi Goreng">
                    <div class="cart-item-info">
                        <div class="item-name">Nasi Goreng Gila</div>
                        <div class="item-price">Rp 15.000</div>
                    </div>
                    <div class="quantity-control">
                        <button type="button" class="quantity-btn">-</button>
                        <span>2</span>
                        <button type="button" class="quantity-btn">+</button>
                    </div>
                    <div class="item-subtotal">Rp 30.000</div>
                </div>

                <!-- Item 2 -->
                <div class="cart-item">
                    <img src="https://images.unsplash.com/photo-1497534446932-c925b458314e?w=200" class="cart-item-img" alt="Es Teh">
                    <div class="cart-item-info">
                        <div class="item-name">Es Teh Manis Segar</div>
                        <div class="item-price">Rp 3.000</div>
                    </div>
                    <div class="quantity-control">
                        <button type="button" class="quantity-btn">-</button>
                        <span>2</span>
                        <button type="button" class="quantity-btn">+</button>
                    </div>
                    <div class="item-subtotal">Rp 6.000</div>
                </div>

                <!-- KOLOM CATATAN (Sesuai parameter ketiga di fungsi checkout) -->
                <div class="note-group">
                    <label for="catatan"><i class="fa-solid fa-comment-dots"></i> Catatan untuk Penjual (Opsional)</label>
                    <textarea id="catatan" name="catatan" class="note-textarea" rows="2" placeholder="Contoh: Nasi gorengnya pedas bgt ya bang, es tehnya manis plastik aja..."></textarea>
                </div>
            </div>

            <!-- KANAN: RINGKASAN TOTAL & TOMBOL BAYAR -->
            <div class="summary-section">
                <div class="cart-title">Ringkasan Pesanan</div>
                
                <div class="summary-row">
                    <span>Subtotal Menu</span>
                    <span>Rp 36.000</span>
                </div>
                <div class="summary-row">
                    <span>Biaya Aplikasi / Layanan</span>
                    <span>Rp 1.000</span>
                </div>
                
                <!-- Total Bayar (Sinkron dengan $cart['Total_Harga'] di database) -->
                <div class="summary-row total-row">
                    <span>Total Pembayaran</span>
                    <span>Rp 37.000</span>
                </div>

                <button type="submit" class="btn-checkout">
                    <i class="fa-solid fa-wallet"></i> Konfirmasi & Pesang Sekarang
                </button>
            </div>

        </div>
    </form>

</body>
</html>