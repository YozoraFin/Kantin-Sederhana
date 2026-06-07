<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../src/style.css">
    <title>Menu <?= htmlspecialchars($kantin['Nama_Kantin'] ?? 'Kantin') ?> - SIKANTIN</title>
</head>
<body>

    <header>
        <nav class="navbar">
            <a href="#" class="nav-logo"><h2 class="logo-text">SIKANTIN</h2></a>
            <ul class="nav-menu">
                <li class="nav-item"><a href="index.php?page=pembeli-dashboard" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="index.php?page=kantin-list" class="nav-link active">Tenant</a></li>
                <li class="nav-item"><a href="index.php?page=pembeli-dashboard" class="nav-link">Pesanan</a></li>
            </ul>
            <div class="nav-actions">
                <a href="index.php?page=ganti-password" class="nav-profil"><i class="fa-solid fa-circle-user"></i></a>
                <a href="index.php?page=keranjang" class="keranjang"><i class="fa-solid fa-cart-shopping"></i></a>
            </div>
        </nav>
    </header>

    <main class="dashboard">
        <div class="dashboard-content" style="padding: 20px;">
            <section class="section">
                <div class="section-header">
                    <h2>Daftar Menu: <?= htmlspecialchars($kantin['Nama_Kantin'] ?? 'Kantin') ?></h2>
                    <p>Silakan pilih hidangan favoritmu</p>
                </div>

                <div class="tenant-grid" style="display: flex; gap: 20px; flex-wrap: wrap; margin-top: 20px;">
                    <?php if (!empty($menus)): ?>
                        <?php foreach ($menus as $menu): ?>
                            
                            <div class="tenant-card" style="background: white; padding: 15px; border-radius: 12px; width: 280px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                                <div class="tenant-card-img" style="margin-bottom: 10px;">
                                    <img src="Kantin Upn.jpeg" alt="" style="width: 100%; height: 150px; object-fit: cover; border-radius: 8px;">
                                </div>
                                <div class="tenant-card-info">
                                    <h3 class="tenant-name" style="margin: 5px 0;"><?= htmlspecialchars($menu['Nama_Product'] ?? $menu['Nama_Produk'] ?? 'Makanan') ?></h3>
                                    
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 15px;">
                                        <span style="font-weight: bold; color: #28a745;">
                                            Rp <?= number_format($menu['Harga_Product'] ?? $menu['Harga_Produk'] ?? 0, 0, ',', '.') ?>
                                        </span>
                                        <a href="index.php?page=tambah-keranjang&id_produk=<?= $menu['ID_Product'] ?? $menu['id_produk'] ?>&id_kantin=<?= $kantin['ID_Kantin'] ?? $kantin['id_kantin'] ?>" style="background: #013220; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 0.85rem; font-weight: bold;">
                                            <i class="fa-solid fa-plus"></i> Beli
                                        </a>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="color: #888; font-style: italic;">Belum ada menu makanan tersedia di kantin ini.</p>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    </main>

</body>
</html>