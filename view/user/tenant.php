<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../src/style.css">
    <title>Tenant - SIKANTIN</title>
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
        <div class="dashboard-hero">
            <div class="dashboard-hero-inner">
                <h1 class="dashboard-title">Cari Tenant Favoritmu</h1>
                <form action="index.php" method="GET" class="search-box" style="display: flex; gap: 10px; margin-top: 15px;">
                    <input type="hidden" name="page" value="kantin-list">
                    <input type="text" name="search" placeholder="Cari tenant..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" style="flex: 1; padding: 10px; border-radius: 8px; border: none;">
                    <button type="submit" style="padding: 10px 20px; background: #28a745; color: white; border: none; border-radius: 8px; cursor: pointer;"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </div>

        <div class="dashboard-content">
            <section class="section">
                <h2>Tenant Tersedia</h2>
                
                <div class="tenant-grid" style="display: flex; gap: 20px; flex-wrap: wrap; margin-top: 20px;">
                    <?php if (!empty($kantins)): ?>
                        <?php foreach ($kantins as $kantin): ?>
                            
                            <a href="index.php?page=kantin-detail&id=<?= $kantin['ID_Kantin'] ?? $kantin['id_kantin'] ?>" class="tenant-card" style="text-decoration: none; color: inherit; background: white; padding: 15px; border-radius: 12px; width: 280px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                                <div class="tenant-card-img" style="margin-bottom: 10px;">
                                    <img src="Kantin Upn.jpeg" alt="" style="width: 100%; height: 150px; object-fit: cover; border-radius: 8px;">
                                </div>
                                <div class="tenant-card-info">
                                    <h3 class="tenant-name" style="margin: 5px 0;"><?= htmlspecialchars($kantin['Nama_Kantin'] ?? '') ?></h3>
                                    <p class="tenant-kategori" style="color: #666; font-size: 0.9rem;">🏪 <?= htmlspecialchars($kantin['Alamat_Kantin'] ?? 'Kantin Kampus') ?></p>
                                    <span class="status-buka" style="background: #28a745; color: white; padding: 2px 6px; font-size: 0.8rem; border-radius: 4px; font-weight: bold;">Buka</span>
                                </div>
                            </a>

                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="color: #888; font-style: italic;">Tenant tidak ditemukan.</p>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    </main>

</body>
</html>