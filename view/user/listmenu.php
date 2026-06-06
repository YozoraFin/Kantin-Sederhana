<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../src/style.css">
    <title>Home - SIKANTIN</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <header>
        <nav class="navbar">
            <a href="#" class="nav-logo">
                <h2 class="logo-text">SIKANTIN-PENJUAL</h2>
            </a>

            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="penjual.php" class="nav-link active">Home</a>
                </li>
                <li class="nav-item">
                    <a href="listmenu.php" class="nav-link">List Menu</a>
                </li>
                <li class="nav-item">
                    <a href="riwayatpesananpenjual.php" class="nav-link">Pesanan</a>
                </li>
            </ul>

            <div class="nav-actions">
                <a href="profil.php" class="nav-profil">
                    <i class="fa-solid fa-circle-user"></i>
                </a>
            </div>
        </nav>
    </header>

    <div class="dashboard-hero">
        <div class="dashboard-hero-inner">
            <p class="greeting">Halo, Warung Berkah! 👋</p>
            <h1 class="dashboard-title">Semangat menyajikan makanan untuk hari ini ya!</h1>
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
            <div class="menu-card">
                <div class="menu-image">
                    <img src="https://images.unsplash.com/photo-1512058564366-18510be2db19?w=500" alt="Nasi Goreng">
                </div>
                <div class="menu-info">
                    <h4 class="menu-title">Nasi Goreng Spesial</h4>
                    <span class="menu-tenant"><i class="fa-solid fa-store"></i> Stand Kedai Barokah</span>
                    <div class="menu-footer">
                        <span class="menu-price">Rp 15.000</span>
                        <form action="proses_tambah.php" method="POST">
                            <input type="hidden" name="id_produk" value="1"> 
                            <input type="hidden" name="harga_produk" value="15000">
                            <input type="hidden" name="id_kantin" value="2"> 
                        </form>
                    </div>
                </div>
            </div>

            <div class="menu-card">
                <div class="menu-image">
                    <img src="https://images.unsplash.com/photo-1626804475315-9644b37a2fe4?w=500" alt="Mie Ayam">
                </div>
                <div class="menu-info">
                    <h4 class="menu-title">Mie Ayam Pangsit</h4>
                    <span class="menu-tenant"><i class="fa-solid fa-store"></i> Stand Mie Mantap</span>
                    <div class="menu-footer">
                        <span class="menu-price">Rp 13.000</span>
                    </div>
                </div>
            </div>

            <div class="menu-card">
                <div class="menu-image">
                    <img src="https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=500" alt="Es Teh Manis">
                </div>
                <div class="menu-info">
                    <h4 class="menu-title">Es Teh Manis Jumbo</h4>
                    <span class="menu-tenant"><i class="fa-solid fa-store"></i> Stand Aneka Minuman</span>
                    <div class="menu-footer">
                        <span class="menu-price">Rp 15.000</span>
                        <form action="proses_tambah.php" method="POST">
                            <input type="hidden" name="id_produk" value="1"> 
                            <input type="hidden" name="harga_produk" value="15000">
                            <input type="hidden" name="id_kantin" value="2"> 
                        </form>
                    </div>
                </div>
            </div>

            <div class="menu-card">
                <div class="menu-image">
                    <img src="https://images.unsplash.com/photo-1626132647523-66f5bf380027?w=500" alt="Ayam Geprek">
                </div>
                <div class="menu-info">
                    <h4 class="menu-title">Ayam Geprek Level 5</h4>
                    <span class="menu-tenant"><i class="fa-solid fa-store"></i> Stand Sambal Lalapan</span>
                    <div class="menu-footer">
                        <span class="menu-price">Rp 15.000</span>
                        <form action="proses_tambah.php" method="POST">
                            <input type="hidden" name="id_produk" value="1"> 
                            <input type="hidden" name="harga_produk" value="15000">
                            <input type="hidden" name="id_kantin" value="2"> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div id="productModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fa-solid fa-cookie-bite"></i> Tambah Produk Baru</h3>
                <button class="close-modal-btn" id="closeModalBtn">&times;</button>
            </div>
            
            <form action="proses_tambah_produk.php" method="POST" class="modal-form">
                <div class="form-group">
                    <label for="nama_produk">Nama Produk/Makanan</label>
                    <input type="text" id="nama_produk" name="Nama_Produk" placeholder="Contoh: Nasi Goreng Gila" required>
                </div>
                
                <div class="form-group">
                    <label for="harga_produk">Harga (Rp)</label>
                    <input type="number" id="harga_produk" name="Harga_Produk" placeholder="Contoh: 15000" required>
                </div>
                
                <div class="form-group">
                    <label for="id_kategori">Kategori Menu</label>
                    <select id="id_kategori" name="ID_Kategori" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="1">Makanan Utama</option>
                        <option value="2">Minuman</option>
                        <option value="3">Cemilan</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="deskripsi_produk">Deskripsi Menu</label>
                    <textarea id="deskripsi_produk" name="Deskripsi_Produk" rows="3" placeholder="Jelaskan kelezatan menu barumu..." required></textarea>
                </div>
                
                <div class="modal-actions">
                    <button type="button" class="btn-cancel" id="cancelModalBtn">Batal</button>
                    <button type="submit" class="btn-submit">Simpan Menu</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('productModal');
        const openModalBtn = document.getElementById('openModalBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const cancelModalBtn = document.getElementById('cancelModalBtn');

        // Klik tombol "Tambah Menu" -> Modal Muncul
        openModalBtn.addEventListener('click', () => {
            modal.classList.add('show');
        });

        // Klik tombol silang (x) -> Modal Tutup
        closeModalBtn.addEventListener('click', () => {
            modal.classList.remove('show');
        });

        // Klik tombol "Batal" -> Modal Tutup
        cancelModalBtn.addEventListener('click', () => {
            modal.classList.remove('show');
        });

        // Klik di area gelap luar kotak form -> Modal Tutup
        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.remove('show');
            }
        });
    </script>
</body>
</html>