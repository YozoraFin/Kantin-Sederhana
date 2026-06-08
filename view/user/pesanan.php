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
                <a href="profil.php" class="nav-profil">
                    <i class="fa-solid fa-circle-user"></i>
                </a>

                <a href="keranjang.php" class="keranjang" title="Keranjang">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>
            </div>
        </nav>
    </header>
    <main class="menu-container">
        <div class="menu-section-header">
            <h3>Daftar Menu Kantin</h3>
            <p>Pilih hidangan lezat favoritmu hari ini</p>
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

        <button type="submit" name="beli_menu" class="btn-add-cart">
            <i class="fa-solid fa-plus"></i> Beli
        </button>
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
                        <button class="btn-add-cart" title="Tambah ke Keranjang">
                            <i class="fa-solid fa-plus"></i> Beli
                        </button>
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

        <button type="submit" name="beli_menu" class="btn-add-cart">
            <i class="fa-solid fa-plus"></i> Beli
        </button>
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

        <button type="submit" name="beli_menu" class="btn-add-cart">
            <i class="fa-solid fa-plus"></i> Beli
        </button>
    </form>
</div>
                </div>
            </div>

        </div>
    </main>