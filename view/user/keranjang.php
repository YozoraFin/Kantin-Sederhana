<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../src/style.css">
    <title>Keranjang Belanja - SIKANTIN</title>
</head>
<body>

    <header>
        <nav class="navbar">
            <a href="#" class="nav-logo"><h2 class="logo-text">SIKANTIN</h2></a>
            <ul class="nav-menu">
                <li class="nav-item"><a href="home.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="tenant.php" class="nav-link">Tenant</a></li>
                <li class="nav-item"><a href="pesanan.php" class="nav-link">Pesanan</a></li>
            </ul>
            <div class="nav-actions">
                <a href="profil.php" class="nav-profil"><i class="fa-solid fa-circle-user"></i></a>
                <a href="keranjang.php" class="nav-cart active"><i class="fa-solid fa-cart-shopping"></i></a>
            </div>
        </nav>
    </header>

    <form action="proses_checkout.php" method="POST">
        
        <input type="hidden" name="id_kantin" value="1"> 

        <div class="cart-container">
            
            <div class="cart-section">
                <div class="cart-title">
                    <i class="fa-solid fa-store" style="color: #013220;"></i> Pesanan dari: <strong>Warung Berkah</strong>
                </div>

                <div class="cart-item" data-detail-id="101" data-harga="15000">
                    <img src="https://images.unsplash.com/photo-1512058564366-18510be2db19?w=200" class="cart-item-img" alt="Nasi Goreng">
                    <div class="cart-item-info">
                        <div class="item-name">Nasi Goreng Gila</div>
                        <div class="item-price">Rp 15.000</div>
                    </div>
                    <div class="quantity-control">
                        <button type="button" class="quantity-btn btn-minus">-</button>
                        <input type="number" class="quantity-input" value="2" readonly>
                        <button type="button" class="quantity-btn btn-plus">+</button>
                    </div>
                    <div class="item-subtotal">Rp <span class="item-subtotal-val">30.000</span></div>
                </div>

                <div class="cart-item" data-detail-id="102" data-harga="3000">
                    <img src="https://images.unsplash.com/photo-1497534446932-c925b458314e?w=200" class="cart-item-img" alt="Es Teh">
                    <div class="cart-item-info">
                        <div class="item-name">Es Teh Manis Segar</div>
                        <div class="item-price">Rp 3.000</div>
                    </div>
                    <div class="quantity-control">
                        <button type="button" class="quantity-btn btn-minus">-</button>
                        <input type="number" class="quantity-input" value="2" readonly>
                        <button type="button" class="quantity-btn btn-plus">+</button>
                    </div>
                    <div class="item-subtotal">Rp <span class="item-subtotal-val">6.000</span></div>
                </div>

                <div class="note-group">
                    <label for="catatan"><i class="fa-solid fa-comment-dots"></i> Catatan untuk Penjual (Opsional)</label>
                    <textarea id="catatan" name="catatan" class="note-textarea" rows="2" placeholder="Contoh: Nasi gorengnya pedas bgt ya bang, es tehnya manis plastik aja..."></textarea>
                </div>
            </div>

            <div class="summary-section">
                <div class="cart-title">Ringkasan Pesanan</div>
                
                <div class="summary-row">
                    <span>Subtotal Menu</span>
                    <span>Rp <span id="subtotal-menu-val">36.000</span></span>
                </div>
                
                <div class="summary-row total-row">
                    <span>Total Pembayaran</span>
                    <span>Rp <span id="total-pembayaran-val">36.000</span></span>
                </div>

                <button type="submit" class="btn-checkout">
                    <i class="fa-solid fa-wallet"></i> Konfirmasi & Pesan Sekarang
                </button>
            </div>

        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            const cartItems = document.querySelectorAll('.cart-item');

            // Fungsi utama untuk mengkalkulasi ulang seluruh total belanja di layar
            function hitungUlangTotal() {
                let totalSubtotalMenu = 0;

                document.querySelectorAll('.cart-item').forEach(item => {
                    const qty = parseInt(item.querySelector('.quantity-input').value);
                    const harga = parseInt(item.getAttribute('data-harga'));
                    totalSubtotalMenu += (qty * harga);
                });

                // Update teks Subtotal Menu di sebelah kanan
                document.getElementById('subtotal-menu-val').innerText = totalSubtotalMenu.toLocaleString('id-ID');
                
                // LANGSUNG UPDATE: Total Pembayaran disamakan dengan totalSubtotalMenu (tanpa tambahan biayaLayanan)
                document.getElementById('total-pembayaran-val').innerText = totalSubtotalMenu.toLocaleString('id-ID');
            }

            cartItems.forEach(item => {
                const btnMinus = item.querySelector('.btn-minus');
                const btnPlus = item.querySelector('.btn-plus');
                const qtyInput = item.querySelector('.quantity-input');
                const subtotalText = item.querySelector('.item-subtotal-val');
                
                const detailId = item.getAttribute('data-detail-id');
                const harga = parseInt(item.getAttribute('data-harga'));

                // Fungsi kirim data asinkron (AJAX) ke Backend
                async function kirimKeBackend(aksi) {
                    try {
                        let respon = await fetch('update_keranjang.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            body: `id_detail=${detailId}&action=${aksi}`
                        });
                        let data = await respon.json();
                        
                        if (!data.success) {
                            alert('Gagal memperbarui data di server.');
                        }
                    } catch (eror) {
                        console.error('Koneksi ke backend bermasalah:', eror);
                    }
                }

                // Tombol TAMBAH (+)
                btnPlus.addEventListener('click', function() {
                    let angkaSkrg = parseInt(qtyInput.value);
                    angkaSkrg += 1;
                    qtyInput.value = angkaSkrg;

                    subtotalText.innerText = (angkaSkrg * harga).toLocaleString('id-ID');
                    hitungUlangTotal();
                    kirimKeBackend('tambah');
                });

                // Tombol KURANG (-)
                btnMinus.addEventListener('click', function() {
                    let angkaSkrg = parseInt(qtyInput.value);
                    
                    if (angkaSkrg > 1) {
                        angkaSkrg -= 1;
                        qtyInput.value = angkaSkrg;

                        subtotalText.innerText = (angkaSkrg * harga).toLocaleString('id-ID');
                        hitungUlangTotal();
                        kirimKeBackend('kurang');
                    } else {
                        if (confirm('Hapus menu ini dari keranjang belanja?')) {
                            item.remove();
                            hitungUlangTotal();
                            kirimKeBackend('hapus');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>