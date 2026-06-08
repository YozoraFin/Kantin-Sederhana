<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="/Kantin-Sederhana/view/src/style.css">
    <title>Home - SIKANTIN</title>
</head>
<body>

    <header>
        <nav class="navbar">
            <a href="#" class="nav-logo">
                <h2 class="logo-text">SIKANTIN</h2>
            </a>

            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="index.php?page=pembeli-dashboard" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=kantin-list" class="nav-link">Tenant</a>
                </li>
            </ul>

           <div class="nav-actions" style="display: flex; align-items: center; gap: 40px;">
    <a href="index.php?page=keranjang" class="nav-icon" title="Keranjang" 
       style="color: #ffffff; font-size: 1.5rem; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; transition: 0.2s;"
        onmouseover="this.style.color='var(--yellow-color)'; this.style.transform='scale(1.1)';"
       onmouseout="this.style.color='#ffffff'; this.style.transform='scale(1.0)';">
       <i class="fa-solid fa-cart-shopping"></i>
    </a>
    
    <a href="index.php?page=logout" class="nav-icon" title="Logout" onclick="return confirm('Apakah Anda yakin ingin keluar dari aplikasi SIKANTIN?')"
       style="color: #ffffff; font-size: 1.5rem; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; transition: 0.2s;"
       onmouseover="this.style.color='var(--yellow-color)'; this.style.transform='scale(1.1)';"
       onmouseout="this.style.color='#ffffff'; this.style.transform='scale(1.0)';">
        <i class="fa-solid fa-right-from-bracket"></i>
    </a>
</div>
        </nav>
    </header>

    <main class="dashboard">

        <div class="dashboard-hero">
            <div class="dashboard-hero-inner">
                <p class="greeting">Halo, <?= htmlspecialchars($_SESSION['user_name'] ?? 'Mahasiswa') ?>! 👋</p>
                <h1 class="dashboard-title">Mau makan dimana hari ini?</h1>
            </div>
        </div>

        <div class="dashboard-content">

            <section class="section">
                <div class="promo-banner">
                    <div class="promo-text">
                        <p class="promo-sub">Ayo kamu masih belum pesan nih</p>
                        <h3 class="promo-title">Banyak makanan kantin yang wajib kamu coba loh!</h3>
                        <a href="index.php?page=kantin-list" class="promo-btn">Yuk Beli!</a>
                    </div>
                    <div class="promo-emoji">🍱</div>
                </div>
            </section>

            <section class="recent-section">
                <div class="section-header">
                    <h2>Pesanan Saat Ini (Ongoing)</h2>
                </div>

                <div class="recent-container" style="margin-bottom: 30px;">
    <?php if (!empty($ongoing)): ?>
        <?php foreach ($ongoing as $order): ?>
            <?php 
                $idTransaksi = $order['ID_Trx'] ?? $order['ID_Transaksi'] ?? $order['id_trx'] ?? $order['ID_Transaction'] ?? 0; 
            ?>
            
            <div class="recent-card" style="display: flex; justify-content: space-between; align-items: center; background: white; padding: 15px; border-radius: 8px; margin-bottom: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                <div class="recent-info">
                    <h3>Nota #<?= htmlspecialchars($idTransaksi) ?></h3>
                    <p style="margin: 5px 0; color: #555;">Catatan: <?= htmlspecialchars($order['Catatan'] ?? 'Tidak ada catatan') ?></p>
                    <span class="status" style="background-color: #ffc107; color: #000; padding: 2px 8px; border-radius: 4px; font-size: 0.8rem; font-weight: bold;">
                        <?= htmlspecialchars($order['Status_Transaksi'] ?? $order['Status'] ?? 'Proses') ?>
                    </span>
                </div>
                
                <div class="recent-action" style="text-align: right;">
                    <div class="recent-price" style="margin-bottom: 8px; font-weight: bold; color: #013220;">
                        Rp <?= number_format($order['Total_Bayar'] ?? 0, 0, ',', '.') ?>
                    </div>
                    <a href="index.php?page=selesai-pesanan&id=<?= $idTransaksi ?>" color: white; font-size: 0.8rem; padding: 6px 10px; border-radius: 4px; text-decoration: none; font-weight: bold; display: inline-block;">
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="color: #888; font-style: italic; padding-left: 10px;">Tidak ada pesanan yang sedang berjalan.</p>
    <?php endif; ?>
</div> 



                <div class="recent-container">
                    <?php if (!empty($history)): ?>
                        <?php foreach ($history as $past_order): ?>
                            <div class="recent-card">
                                <div class="recent-info">
                                    <h3>Nota #<?= $past_order['ID_Transaksi'] ?? $past_order['id_trx'] ?></h3>
                                    <p>Status Pembayaran: Sukses</p>
                                    <span class="status selesai">Selesai</span>
                                </div>

                                <div class="recent-price">
                                    Rp <?= number_format($past_order['Total_Bayar'] ?? 0, 0, ',', '.') ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="color: #888; font-style: italic; padding-left: 10px;">Belum ada riwayat pesanan.</p>
                    <?php endif; ?>
                </div>

            </section>

        </div>
    </main>

</body>
</html>