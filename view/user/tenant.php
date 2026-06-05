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
            <a href="#" class="nav-logo">
                <h2 class="logo-text">SIKANTIN</h2>
            </a>

            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="home.php" class="nav-link">Home</a>
                </li>

                <li class="nav-item">
                    <a href="tenant.php" class="nav-link active">Tenant</a>
                </li>

                <li class="nav-item">
                    <a href="pesanan.php" class="nav-link">Pesanan</a>
                </li>
            </ul>

            <div class="nav-actions">
                <a href="profil.php" class="nav-profil">
                    <i class="fa-solid fa-circle-user"></i>
                </a>

                <a href="keranjang.php" class="keranjang">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>
            </div>
        </nav>
    </header>

    <main class="dashboard">

        <!-- Search Section -->
        <div class="dashboard-hero tenant-hero">
            <div class="dashboard-hero-inner">

                <h1 class="dashboard-title">
                    Cari Tenant Favoritmu
                </h1>

                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>

                    <input
                        type="text"
                        placeholder="Cari tenant..."
                    >
                </div>

            </div>
        </div>

        <!-- Tenant List -->
        <div class="dashboard-content">

            <section class="section">

                <div class="section-header">
                    <h2 class="section-title">Tenant</h2>
                </div>

                <div class="tenant-grid">

                    <a href="menu.php?tenant=1" class="tenant-card">
                        <div class="tenant-card-img">
                            <img src="Kantin Upn.jpeg" alt="Warung Mas Amba">
                            <span class="tenant-badge">Buka</span>
                        </div>

                        <div class="tenant-card-info">
                            <h3 class="tenant-name">Warung Mas Amba</h3>
                            <p class="tenant-kategori">🍚 Nasi · Ayam</p>

                            <div class="tenant-meta">
                                <span class="tenant-jam">07.00 - 15.00</span>
                            </div>
                        </div>
                    </a>

                    <a href="menu.php?tenant=2" class="tenant-card">
                        <div class="tenant-card-img">
                            <img src="Kantin Upn.jpeg" alt="Bakmie Saudagar">
                            <span class="tenant-badge">Buka</span>
                        </div>

                        <div class="tenant-card-info">
                            <h3 class="tenant-name">Bakmie Saudagar</h3>
                            <p class="tenant-kategori">🍜 Mie · Snack</p>

                            <div class="tenant-meta">
                                <span class="tenant-jam">08.00 - 16.00</span>
                            </div>
                        </div>
                    </a>

                    <a href="menu.php?tenant=3" class="tenant-card">
                        <div class="tenant-card-img">
                            <img src="Kantin Upn.jpeg" alt="Kedai Kicau Mania">
                            <span class="tenant-badge tutup">Tutup</span>
                        </div>

                        <div class="tenant-card-info">
                            <h3 class="tenant-name">Kedai Kicau Mania</h3>
                            <p class="tenant-kategori">🥤 Minuman</p>

                            <div class="tenant-meta">
                                <span class="tenant-jam">09.00 - 14.00</span>
                            </div>
                        </div>
                    </a>

                    <a href="menu.php?tenant=4" class="tenant-card">
                        <div class="tenant-card-img">
                            <img src="Kantin Upn.jpeg" alt="Warung Ndangak">
                            <span class="tenant-badge">Buka</span>
                        </div>

                        <div class="tenant-card-info">
                            <h3 class="tenant-name">Warung Ndangak</h3>
                            <p class="tenant-kategori">🍚 Nasi · Mie</p>

                            <div class="tenant-meta">
                                <span class="tenant-jam">07.00 - 15.00</span>
                            </div>
                        </div>
                    </a>

                </div>

            </section>

        </div>

    </main>

</body>
</html>