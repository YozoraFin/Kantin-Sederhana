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
            </div>
        </nav>
    </header>

    <div class="profile-wrapper">
        <div class="profile-card">
            
            <div class="profile-seller-container">
                
            </div>
        <img src="Kantin Upn.jpeg" alt="Banner Warung">

            <div class="profile-details">
                
                <div class="detail-item">
                    <i class="fa-solid fa-id-card"></i>
                    <div class="detail-text">
                        <span class="detail-label">Nama Usaha</span>
                        <span class="detail-value">Warung Mas Amba</span>
                    </div>
                </div>


                <div class="detail-item">
                    <i class="fa-solid fa-envelope"></i>
                    <div class="detail-text">
                        <span class="detail-label">Email</span>
                        <span class="detail-value">masamba@upnjatim.ac.id</span>
                    </div>
                </div>

                <!-- <div class="detail-item">
                    <i class="fa-solid fa-wallet"></i>
                    <div class="detail-text">
                        <span class="detail-label">Saldo Sikantin-Pay</span>
                        <span class="detail-value" style="color: #11b237; font-weight: 700;">Rp 75.000</span>
                    </div>
                </div> -->

            </div>

            <div class="profile-actions">
                <a href="edit_profil.php" class="btn-edit-profile">
                    <i class="fa-solid fa-pen-to-square"></i> Edit Profil
                </a>
                <a href="logout.php" class="btn-logout">
                    <i class="fa-solid fa-right-from-bracket"></i> Keluar Akun
                </a>
            </div>

        </div>
    </div>

</body>
</html>