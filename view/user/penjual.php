<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="/Kantin-Sederhana/view/src/style.css">
    <title>Home - SIKANTIN</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<header>
    <nav class="navbar">
        <a href="#" class="nav-logo">
            <h2 class="logo-text">DASHBOARD PENJUAL</h2>
        </a>

        <ul class="nav-menu">
            <li class="nav-item">
                <a href="index.php?page=penjual-dashboard" class="nav-link active">Home</a>
            </li>
            <li class="nav-item">
                <a href="index.php?page=penjual-menu" class="nav-link">List Menu</a>
            </li>
        </ul>

        <div class="nav-actions">
                <a href="index.php?page=logout" class="nav-profil" title="Logout" onclick="return confirm('Apakah Anda yakin ingin keluar dari aplikasi SIKANTIN?')">
                    <i class="fa-solid fa-right-from-bracket" style="font-size: 20px; color: #fff;"></i>
                </a>
        </div>
    </nav>
</header>

<main class="seller-container">
    <div class="seller-page-header">
        <h2>Laporan Penjualan</h2>
        <p>Pantau performa tokomu</p>
    </div>

    <div class="status-kantin-container" style="display: flex; align-items: center; gap: 15px; background: white; padding: 12px 20px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); width: fit-content; margin-bottom: 25px;">
        <span style="font-weight: bold; font-size: 0.95rem; color: #333;">Status Operasional:</span>
            <label class="switch-button-wrapper" style="position: relative; display: inline-block; width: 50px; height: 26px; cursor: pointer;">
                <input type="checkbox" id="statusSakelar" <?= (isset($kantin['Status_Buka']) && $kantin['Status_Buka'] == 1) ? 'checked' : '' ?> style="opacity: 0; width: 0; height: 0;">
                    <?php if (isset($kantin['Status_Buka']) && $kantin['Status_Buka'] == 1): ?>
                        <span class="slider-round slider-buka"></span>
                    <?php else: ?>
                        <span class="slider-round slider-tutup"></span>
                    <?php endif; ?>
            </label>
    
        <span style="font-weight: bold; font-size: 0.9rem; color: <?= (isset($kantin['Status_Buka']) && $kantin['Status_Buka'] == 1) ? '#28a745' : '#dc3545' ?>;">
            <?= (isset($kantin['Status_Buka']) && $kantin['Status_Buka'] == 1) ? 'BUKA (MENERIMA PESANAN)' : 'TUTUP (STAN TIDAK AKTIF)' ?>
        </span>
    </div>


    <script>
        document.getElementById('statusSakelar').addEventListener('change', function() {
        window.location.href = 'index.php?page=penjual-toggle-status';
        });
    </script>
    <div class="seller-content-grid">
        <div class="seller-summary-box">
            <div class="summary-card">
                <span class="summary-label">Total Pendapatan</span>
                    <h3 class="summary-value text-green">Rp <?= number_format($revenue ?? 0, 0, ',', '.') ?></h3>
                <span class="summary-sub">Semua transaksi sukses</span>
            </div>
            <div class="summary-card">
                <span class="summary-label">Pesanan Masak (Live)</span>
                    <h3 class="summary-value text-blue"><?= count($incoming ?? []) ?> Pesanan</h3>
                <span class="summary-sub">Perlu segera disajikan</span>
            </div>
        </div>
    </div>

        <div class="seller-status-sidebar">
            <div class="status-box-title">
                <i class="fa-solid fa-utensils"></i> Status Masakan Live
            </div>
            
            <div class="order-status-list">
                <?php if (!empty($incoming)): ?>
                    <?php foreach ($incoming as $order): ?>
                        <div class="order-status-item" id="order-<?= $order['ID_Transaksi'] ?>">
                            <div class="order-info">
                                <span class="order-id">Nota #<?= $order['ID_Transaksi'] ?></span>
                                <!-- <p class="order-menu"><?= htmlspecialchars($order['Nama_Menu'] ?? 'Menu Pesanan') ?></p> -->
                                <span class="status-badge pending"><?= htmlspecialchars($order['Status_Pesanan'] ?? 'Proses') ?></span>
                            </div>
                            <button class="btn-check-done" onclick="completeOrder('<?= $order['ID_Transaksi'] ?>')">
                                <i class="fa-solid fa-check"></i>
                            </button>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div style="text-align: center; color: #888; padding: 40px 10px; font-style: italic;">
                        <i class="fa-solid fa-bell-slashed" style="font-size: 28px; margin-bottom: 8px; color: #ccc;"></i>
                        <p>Belum ada masakan yang perlu diproses.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</main>

    <script>
        const ctx = document.getElementById('weeklySalesChart').getContext('2d');
        const gradientPrimary = ctx.createLinearGradient(0, 0, 0, 300);
        gradientPrimary.addColorStop(0, '#013220'); 
    gradientPrimary.addColorStop(1, '#11b237'); 

    function completeOrder(orderId) {
    fetch('/Kantin-Sederhana/index.php?page=penjual-status-pesanan'+'&id_trx=' + orderId + '&status=Selesai' , {
        method: 'GET',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const orderItem = document.getElementById('order-' + orderId);
            if (orderItem) {
                orderItem.classList.add('is-done');
                orderItem.style.background = '#e8f5e9'; 
                
                const badge = orderItem.querySelector('.status-badge');
                if (badge) {
                    badge.textContent = 'Selesai';
                    badge.className = 'status-badge success'; 
                }
                
                const button = orderItem.querySelector('.btn-check-done');
                if (button) {
                    button.removeAttribute('onclick');
                    button.style.opacity = '0.4';
                }
            }
        } else {
            alert('Gagal memperbarui data dapur: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kendala jaringan komunikasi sistem kantin.');
    });
}
</script>
</body>
</html>