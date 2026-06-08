<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="/Kantin-Sederhana/view/src/style.css">
    <title>Menu <?= htmlspecialchars($kantin['Nama_Kantin'] ?? 'Kantin') ?> - SIKANTIN</title>
</head>
<body>

    <header>
        <nav class="navbar">
            <a href="#" class="nav-logo"><h2 class="logo-text">SIKANTIN</h2></a>
            <ul class="nav-menu">
                <li class="nav-item"><a href="index.php?page=pembeli-dashboard" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="index.php?page=kantin-list" class="nav-link active">Tenant</a></li>
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
        <div class="dashboard-content" style="padding: 20px;">
            <section class="section">
                <div class="section-header">
                    <h2>Daftar Menu: <?= htmlspecialchars($kantin['Nama_Kantin'] ?? 'Kantin') ?></h2>
                    <p>Silakan pilih hidangan favoritmu</p>
                </div>

                <div class="tenant-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 20px; margin-top: 20px; align-items: start;">
                <?php if (!empty($menus)): ?>
                 <?php foreach ($menus as $menu): ?>
            
        <div class="tenant-card" style="background: white; padding: 15px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); display: flex; flex-direction: column; height: 380px; box-sizing: border-box; justify-content: space-between;">
                <div class="tenant-card-img" style="width: 100%; height: 140px; overflow: hidden; border-radius: 8px;">
                    <img src="<?= !empty($menu['Produk_url']) ? htmlspecialchars($menu['Produk_url']) : 'Kantin Upn.jpeg' ?>" alt="<?= htmlspecialchars($menu['Nama_Produk']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                
                <div class="tenant-card-info" style="display: flex; flex-direction: column; flex-grow: 1; margin-top: 10px; overflow: hidden;">
                    <h3 class="tenant-name" style="margin: 0 0 8px 0; font-size: 1.1rem; font-weight: 600; color: #222; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= htmlspecialchars($menu['Nama_Produk']) ?></h3>
                    
                    <?php if (!empty($menu['Deskripsi_Produk'])): ?>
                        <div class="accordion-wrapper" style="display: flex; flex-direction: column;">
                            <input type="checkbox" id="desc-toggle-<?= $menu['ID_Produk'] ?>" class="accordion-checkbox" style="display: none;">
                            
                            <label for="desc-toggle-<?= $menu['ID_Produk'] ?>" class="accordion-header" style="display: flex; justify-content: space-between; align-items: center; padding: 4px 0; font-size: 0.82rem; color: #666; cursor: pointer; border-bottom: 1px dashed #e0e0e0;">
                                <span>Lihat Deskripsi</span>
                                <i class="fa-solid fa-chevron-down arrow-icon" style="font-size: 0.75rem; transition: transform 0.3s;"></i>
                            </label>
                            
                            <div class="accordion-content">
                                <p style="font-size: 0.8rem; line-height: 1.4; color: #555; margin: 5px 0 0 0; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                                    <?= htmlspecialchars($menu['Deskripsi_Produk']) ?>
                                </p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="tenant-card-footer" style="display: flex; justify-content: space-between; align-items: center; padding-top: 10px; border-top: 1px solid #f5f5f5; margin-top: auto;">
                    <span style="font-weight: bold; color: #28a745; font-size: 1.05rem;">
                        Rp <?= number_format($menu['Harga_Produk'] ?? 0, 0, ',', '.') ?>
                    </span>
                    <a href="index.php?page=tambah-keranjang&id_produk=<?= $menu['ID_Produk'] ?>&id_kantin=<?= $menu['ID_Kantin'] ?>" style="background: #013220; color: white; padding: 6px 14px; border-radius: 6px; text-decoration: none; font-size: 0.85rem; font-weight: bold; display: inline-flex; align-items: center; gap: 5px; transition: background 0.2s;">
                        <i class="fa-solid fa-plus"></i> Beli
                    </a>
                </div>
                
            </div>

        <?php endforeach; ?>
    <?php else: ?>
        <p style="color: #888; font-style: italic; grid-column: 1/-1; text-align: center;">Belum ada menu makanan tersedia di kantin ini.</p>
    <?php endif; ?>
</div>
            </section>
        </div>
    </main>

</body>
</html>