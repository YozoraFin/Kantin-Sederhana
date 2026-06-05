<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SIKANTIN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <link rel="stylesheet" href="../../src/style.css">
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="admin-dashboard-page">

    <div class="dashboard-header">
        <h1>Dashboard</h1>
        <div class="breadcrumb">
            <a href="../home.php">Home</a> / <span>Dashboard</span>
        </div>
    </div>

    <div class="stats-grid">
        
        <div class="card-stat bg-blue">
            <h3>150</h3>
            <p>New Orders</p>
            <i class="fa-solid fa-cart-shopping card-icon"></i>
            <a href="#" class="card-footer-link">More info <i class="fa-solid fa-circle-arrow-right"></i></a>
        </div>

        <div class="card-stat bg-green">
            <h3>53<sup style="font-size: 20px">%</sup></h3>
            <p>Bounce Rate</p>
            <i class="fa-solid fa-chart-simple card-icon"></i>
            <a href="#" class="card-footer-link">More info <i class="fa-solid fa-circle-arrow-right"></i></a>
        </div>

        <div class="card-stat bg-yellow">
            <h3>44</h3>
            <p>User Registrations</p>
            <i class="fa-solid fa-user-plus card-icon"></i>
            <a href="#" class="card-footer-link">More info <i class="fa-solid fa-circle-arrow-right"></i></a>
        </div>

        <div class="card-stat bg-red">
            <h3>65</h3>
            <p>Unique Visitors</p>
            <i class="fa-solid fa-pie-chart card-icon"></i>
            <a href="#" class="card-footer-link">More info <i class="fa-solid fa-circle-arrow-right"></i></a>
        </div>

    </div>

    <div class="main-content-grid">
        
        <div class="chart-box">
            <div class="chart-box-header">Sales Value</div>
            <div style="width: 100%; height: 300px;">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <div class="side-box">
            <div class="side-box-header">
                <span>Sales Value</span>
                <span class="btn-plus"><i class="fa-solid fa-plus"></i></span>
            </div>
            <div class="side-box-content">
                Belum ada aktivitas tambahan.
            </div>
        </div>

    </div>

    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        
        const gradientGreen = ctx.createLinearGradient(0, 0, 0, 300);
        gradientGreen.addColorStop(0, 'rgba(40, 167, 69, 0.4)');
        gradientGreen.addColorStop(1, 'rgba(40, 167, 69, 0.0)');

        const gradientBlue = ctx.createLinearGradient(0, 0, 0, 300);
        gradientBlue.addColorStop(0, 'rgba(0, 123, 255, 0.4)');
        gradientBlue.addColorStop(1, 'rgba(0, 123, 255, 0.0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan \'23', 'Feb \'23', 'Mar \'23', 'Apr \'23', 'May \'23', 'Jun \'23'],
                datasets: [
                    {
                        label: 'Target Penjualan',
                        data: [62, 58, 76, 75, 50, 42],
                        borderColor: '#28a745',
                        backgroundColor: gradientGreen,
                        fill: true,
                        tension: 0.4,
                        borderWidth: 3
                    },
                    {
                        label: 'Realisasi Penjualan',
                        data: [25, 34, 28, 15, 82, 30],
                        borderColor: '#007bff',
                        backgroundColor: gradientBlue,
                        fill: true,
                        tension: 0.4,
                        borderWidth: 3
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: {
                        min: 0,
                        max: 100,
                        ticks: { color: '#6c757d', stepSize: 20 },
                        grid: { color: '#343a40' }
                    },
                    x: {
                        ticks: { color: '#6c757d' },
                        grid: { display: false }
                    }
                }
            }
        });
    </script>
</body>
</html>