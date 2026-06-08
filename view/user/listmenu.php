<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="/Kantin-Sederhana/view/src/style.css">
    <title>Daftar Menu - SIKANTIN</title>
</head>
<body>

    <header>
        <nav class="navbar">
            <a href="#" class="nav-logo">
                <h2 class="logo-text">SIKANTIN-PENJUAL</h2>
            </a>

            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="index.php?page=penjual-dashboard" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=penjual-menu" class="nav-link active">List Menu</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=penjual-status-pesanan" class="nav-link"></a>
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

    <div class="dashboard-hero">
        <div class="dashboard-hero-inner">
            <p class="greeting">Daftar Menu Toko Kamu 👋</p>
            <h1 class="dashboard-title">Kelola hidangan lezat terbaikmu di sini!</h1>
        </div>
    </div>

    <main class="menu-container">
        <div class="menu-section-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
            <h3>Daftar Menu Kantin Kamu !</h3>
            <button class="btn-add-product" id="openModalBtn">
                <i class="fa-solid fa-plus"></i> Tambah Menu Baru
            </button>
        </div>

        <div class="menu-grid">
    <?php if (!empty($menus)): ?>
        <?php foreach ($menus as $menu): ?>
            <div class="menu-card">
                <div class="menu-image">
                    <img src="<?= htmlspecialchars($menu['Produk_url'] ?? '') ?>" alt="<?= htmlspecialchars($menu['Nama_Produk'] ?? 'Menu') ?>">
                </div>
                <div class="menu-info">
                    <h4 class="menu-title"><?= htmlspecialchars($menu['Nama_Produk']) ?></h4>
                    <span class="menu-tenant"><i class="fa-solid fa-store"></i> Kategori: <?= htmlspecialchars($menu['Nama_Kategori'] ?? $menu['ID_Kategori']) ?></span>
                    
                    <?php if (!empty($menu['Deskripsi_Produk'])): ?>
                        <p style="font-size: 0.8rem; color: #666; margin: 4px 0;"><?= htmlspecialchars($menu['Deskripsi_Produk']) ?></p>
                    <?php endif; ?>

                    <div class="menu-footer" style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px;">
                        <span class="menu-price">Rp <?= number_format($menu['Harga_Produk'] ?? 0, 0, ',', '.') ?></span>
                        
                        <div class="action-buttons">
                            <a href="index.php?page=penjual-hapus-menu&id=<?= $menu['ID_Produk'] ?>" 
                               class="btn-delete" 
                               onclick="return confirm('Apakah Anda yakin ingin menghapus menu ini?')"
                               style="color: #e74c3c; font-size: 1.1rem; margin-left: 10px;">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div style="grid-column: 1 / -1; text-align: center; color: #888; padding: 50px 0;">
            <i class="fa-solid fa-bowl-food" style="font-size: 3rem; color: #ccc; margin-bottom: 10px;"></i>
            <p>Belum ada produk terdaftar. Yuk, tambah hidangan pertamamu!</p>
        </div>
    <?php endif; ?>
</div>
    </main>

    <div id="productModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fa-solid fa-cookie-bite"></i> Tambah Produk Baru</h3>
                <button class="close-modal-btn" id="closeModalBtn">&times;</button>
            </div>
            
            <form action="index.php?page=penjual-tambah-menu" method="POST" class="modal-form">
    <div class="form-group">
        <label for="nama_produk">Nama Produk/Makanan</label>
        <input type="text" id="nama_produk" name="nama" placeholder="Contoh: Nasi Goreng Gila" required>
    </div>
    
    <div class="form-group">
        <label for="harga_produk">Harga (Rp)</label>
        <input type="number" id="harga_produk" name="harga" placeholder="Contoh: 15000" required>
    </div>
    
    <div class="form-group">
        <label for="id_kategori">Kategori Menu</label>
        <select id="id_kategori" name="id_kategori" required>
            <option value="">-- Pilih Kategori --</option>
            <option value="1">Makanan Berat</option>
            <option value="2">Makanan Ringan</option>
            <option value="3">Minuman</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="produk_url">URL Link Gambar Makanan</label>
        <input type="text" id="produk_url" name="Produk_url" placeholder="Contoh: https://images.unsplash.com/... atau /src/img/food.jpg" required>
    </div>
    
    <div class="form-group">
        <label for="deskripsi_produk">Deskripsi Menu</label>
        <textarea id="deskripsi_produk" name="deskripsi" rows="3" placeholder="Jelaskan kelezatan menu barumu..." required></textarea>
    </div>
    
    <div class="modal-actions">
        <button type="button" class="btn-cancel" id="cancelModalBtn">Batal</button>
        <button type="submit" class="btn-submit">Simpan Menu</button>
    </div>
</form>
    <script>
        const modal = document.getElementById('productModal');
        const openModalBtn = document.getElementById('openModalBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const cancelModalBtn = document.getElementById('cancelModalBtn');

        openModalBtn.addEventListener('click', () => {
            modal.classList.add('show');
        });

        closeModalBtn.addEventListener('click', () => {
            modal.classList.remove('show');
        });

        cancelModalBtn.addEventListener('click', () => {
            modal.classList.remove('show');
        });

        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.remove('show');
            }
        });
    </script>
</body>
</html>