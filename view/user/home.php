<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../src/style.css">
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
                    <a href="home.php" class="nav-link active">Home</a>
                </li>
                <li class="nav-item">
                    <a href="tenant.php" class="nav-link">Tenant</a>
                </li>
                <li class="nav-item">
                    <a href="pesanan.php" class="nav-link">Pesanan</a>
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

    <main class="dashboard">

        <div class="dashboard-hero">
            <div class="dashboard-hero-inner">
                <p class="greeting">Halo, Mahasiswa! 👋</p>
                <h1 class="dashboard-title">Mau makan dimana hari ini?</h1>
            </div>
        </div>

        <div class="dashboard-content">

            <section class="section">
                <div class="promo-banner">
                    <div class="promo-text">
                        <p class="promo-sub">
                            Ayo kamu masih belum pesan nih
                        </p>

                        <h3 class="promo-title">
                            Banyak makanan kantin yang wajib kamu coba loh!
                        </h3>

                        <a href="tenant.php" class="promo-btn">
                            Yuk Beli!
                        </a>
                    </div>

                    <div class="promo-emoji">
                        🍱
                    </div>
                </div>
            </section>


            <section class="recent-section">

                <div class="section-header">
                    <h2>Pesanan Terakhir</h2>
                    <a href="riwayat.php" class="lihat-semua">
                        Lihat Semua
                    </a>
                </div>

                <div class="recent-container">

                    <div class="recent-card">
                        <div class="recent-info">
                            <h3>Nasi Goreng Pak Budi</h3>
                            <p>Kantin A • 2 Porsi</p>
                            <span class="status selesai">
                                Selesai
                            </span>
                        </div>

                        <div class="recent-price">
                            Rp 24.000
                        </div>
                    </div>

                    <div class="recent-card">
                        <div class="recent-info">
                            <h3>Ayam Geprek Mantap</h3>
                            <p>Kantin B • 1 Porsi</p>
                            <span class="status selesai">
                                selesai
                            </span>
                        </div>

                        <div class="recent-price">
                            Rp 15.000
                        </div>
                    </div>

                    <div class="recent-card">
                        <div class="recent-info">
                            <h3>Mie Ayam Bakso</h3>
                            <p>Kantin C • 1 Porsi</p>
                            <span class="status selesai">
                                Selesai
                            </span>
                        </div>

                        <div class="recent-price">
                            Rp 18.000
                        </div>
                    </div>

                </div>

            </section>

        </div>

    </main>

</body>
</html>