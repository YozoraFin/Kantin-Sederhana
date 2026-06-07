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
                    <a href="index.php?page=pembeli-dashboard">Home</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=kantin-list" class="nav-link">Tenant</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=pembeli-dashboard" class="nav-link">Pesanan</a>
                </li>
            </ul>

            <div class="nav-actions">
                <a href="index.php?page=ganti-password" class="nav-profil">
                    <i class="fa-solid fa-circle-user"></i>
                </a>

                <a href="index.php?page=keranjang" class="keranjang" title="Keranjang">
                    <i class="fa-solid fa-cart-shopping"></i>
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
                            <div class="recent-card">
                                <div class="recent-info">
                                    <h3>Nota #<?= $order['ID_Transaction'] ?? $order['id_trx'] ?></h3>
                                    <p>Catatan: <?= htmlspecialchars($order['Catatan'] ?? 'Tidak ada catatan') ?></p>
                                    <span class="status" style="background-color: #ffc107; color: #000; padding: 2px 8px; border-radius: 4px; font-size: 0.8rem; font-weight: bold;">
                                        <?= htmlspecialchars($order['Status_Transaksi'] ?? 'Diproses') ?>
                                    </span>
                                </div>
                                
                                <div class="recent-action" style="text-align: right;">
                                    <div class="recent-price" style="margin-bottom: 5px;">
                                        Rp <?= number_format($order['Total_Harga'] ?? 0, 0, ',', '.') ?>
                                    </div>
                                    <a href="index.php?page=pesanan-diambil&id_trx=<?= $order['ID_Transaction'] ?? $order['id_trx'] ?>" class="btn-ambil" style="background: #28a745; color: white; font-size: 0.8rem; padding: 4px 8px; border-radius: 4px; text-decoration: none; font-weight: bold;">
                                        Sudah Diambil
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="color: #888; font-style: italic; padding-left: 10px;">Tidak ada pesanan yang sedang berjalan.</p>
                    <?php endif; ?>
                </div>

                <div class="section-header">
                    <h2>Riwayat Pesanan Terakhir</h2>
                </div>

                <div class="recent-container">
                    <?php if (!empty($history)): ?>
                        <?php foreach ($history as $past_order): ?>
                            <div class="recent-card">
                                <div class="recent-info">
                                    <h3>Nota #<?= $past_order['ID_Transaction'] ?? $past_order['id_trx'] ?></h3>
                                    <p>Status Pembayaran: Sukses</p>
                                    <span class="status selesai">Selesai</span>
                                </div>

                                <div class="recent-price">
                                    Rp <?= number_format($past_order['Total_Harga'] ?? 0, 0, ',', '.') ?>
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