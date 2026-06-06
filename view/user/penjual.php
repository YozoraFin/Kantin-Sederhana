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
<h2 class="logo-text">DASHBOARD PENJUAL</h2>
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

 <main class="seller-container">
        <div class="seller-page-header">
            <h2>Laporan Penjualan Mingguan</h2>
            <p>Pantau performa tokomu minggu ini</p>
        </div>

        <div class="seller-content-grid">
            
            <div class="seller-main-content">
                <div class="seller-chart-box">
                    <div class="chart-title">
                        <i class="fa-solid fa-chart-line"></i> Grafik Omset Penjualan
                    </div>
                    <div class="canvas-wrapper">
                        <canvas id="weeklySalesChart"></canvas>
                    </div>
                </div>

                <div class="seller-summary-box">
                    <div class="summary-card">
                        <span class="summary-label">Total Pendapatan</span>
                        <h3 class="summary-value text-green">Rp 1.450.000</h3>
                        <span class="summary-sub">Minggu ini</span>
                    </div>
                    <div class="summary-card">
                        <span class="summary-label">Pesanan Selesai</span>
                        <h3 class="summary-value text-blue">98 Pesanan</h3>
                        <span class="summary-sub">Rata-rata 14 pesanan/hari</span>
                    </div>
                </div>
            </div>

            <div class="seller-status-sidebar">
                <div class="status-box-title">
                    <i class="fa-solid fa-utensils"></i> Status Masakan Live
                </div>
                
                <div class="order-status-list">
                    <div class="order-status-item" id="order-101">
                        <div class="order-info">
                            <span class="order-id">#101</span>
                            <p class="order-menu">Nasi Goreng Ayam (2x)</p>
                            <span class="status-badge pending">Sedang Dimasak</span>
                        </div>
                        <button class="btn-check-done" onclick="completeOrder('101')">
                            <i class="fa-solid fa-check"></i>
                        </button>
                    </div>

                    <div class="order-status-item" id="order-102">
                        <div class="order-info">
                            <span class="order-id">#102</span>
                            <p class="order-menu">Mie Goreng Spesial (1x)</p>
                            <span class="status-badge pending">Sedang Dimasak</span>
                        </div>
                        <button class="btn-check-done" onclick="completeOrder('102')">
                            <i class="fa-solid fa-check"></i>
                        </button>
                    </div>

                    <div class="order-status-item" id="order-103">
                        <div class="order-info">
                            <span class="order-id">#103</span>
                            <p class="order-menu">Es Teh Manis (3x)</p>
                            <span class="status-badge pending">Sedang Dimasak</span>
                        </div>
                        <button class="btn-check-done" onclick="completeOrder('103')">
                            <i class="fa-solid fa-check"></i>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </main>
<script>
const ctx = document.getElementById('weeklySalesChart').getContext('2d');

const gradientPrimary = ctx.createLinearGradient(0, 0, 0, 300);
gradientPrimary.addColorStop(0, '#013220'); // Hijau tua SIKANTIN sesuai variabelmu
gradientPrimary.addColorStop(1, '#11b237'); // Hijau terang

new Chart(ctx, {
        type: 'bar',
        data: {
        labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
        datasets: [{
        label: 'Pendapatan (Rp)',
         data: [150000, 230000, 180000, 310000, 250000, 190000, 140000], 
        backgroundColor: gradientPrimary,
        borderRadius: 6,
        borderWidth: 0
        }]
    },
        options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
        legend: { display: false }
    },
        scales: {
    y: {
beginAtZero: true,
 ticks: {
 color: '#555',
callback: function(value) {
 return 'Rp ' + value.toLocaleString('id-ID');
}
 },
 grid: { color: '#eef2f5' }
},
 x: {
 ticks: { color: '#555' },
 grid: { display: false }
 }
 }
 }
 });

 // Fungsi untuk memproses tombol centang masakan selesai
function completeOrder(orderId) {
    // Ambil element item pesanan berdasarkan ID
    const orderItem = document.getElementById('order-' + orderId);
    
    if (orderItem) {
        // Tambahkan class penanda selesai (mengubah background box menjadi hijau soft)
        orderItem.classList.add('is-done');
        
        // Cari element badge status di dalamnya, lalu ubah teks dan warnanya
        const badge = orderItem.querySelector('.status-badge');
        if (badge) {
            badge.textContent = 'Masakan Selesai';
            badge.className = 'status-badge success'; // Ganti class ke sukses (hijau)
        }
        
        // Disable tombol centangnya agar tidak bisa diklik berulang-ulang
        const button = orderItem.querySelector('.btn-check-done');
        if (button) {
            button.removeAttribute('onclick');
        }
    }
}
 </script>
</body>
</html>

