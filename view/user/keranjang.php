<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="/Kantin-Sederhana/view/src/style.css">
    <title>Keranjang Belanja - SIKANTIN</title>
</head>
<body>

    <header>
        <nav class="navbar">
            <a href="#" class="nav-logo"><h2 class="logo-text">SIKANTIN</h2></a>
            <ul class="nav-menu">
                <li class="nav-item"><a href="index.php?page=pembeli-dashboard" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="index.php?page=kantin-list" class="nav-link">Tenant</a></li>
            </ul>
            <div class="nav-actions">
                <a href="index.php?page=ganti-password" class="nav-profil"><i class="fa-solid fa-circle-user"></i></a>
                <a href="index.php?page=keranjang" class="nav-cart active"><i class="fa-solid fa-cart-shopping"></i></a>
            </div>
        </nav>
    </header>

    <form action="index.php?page=checkout" method="POST">
        
        <div class="cart-container">
            
            <div class="cart-section">
                <?php if (!empty($items)): ?>
                    <?php 
                    // Ambil info nama kantin & ID kantin dari item pertama yang ada di keranjang
                    $namaKantin = $items[0]['Nama_Kantin'] ?? 'Kantin';
                    $idKantin = $items[0]['ID_Kantin'] ?? '';
                    ?>
                    
                    <input type="hidden" name="id_kantin" value="<?= $idKantin ?>"> 

                    <div class="cart-title">
                        <i class="fa-solid fa-store" style="color: #013220;"></i> Pesanan dari: <strong><?= htmlspecialchars($namaKantin) ?></strong>
                    </div>

                    <?php 
                    $totalBelanjaan = 0; 
                    foreach ($items as $item): 
                        $subtotalItem = $item['Jumlah'] * $item['Harga_Produk'];
                        $totalBelanjaan += $subtotalItem;
                    ?>
                        <div class="cart-item" data-detail-id="<?= $item['ID_Detail_Keranjang'] ?? $item['id_detail'] ?>" data-harga="<?= $item['Harga_Produk'] ?>" data-cart-id="<?= $item['ID_Keranjang'] ?>">
                            <img src="<?= !empty($item['Produk_url']) ? htmlspecialchars($item['Produk_url']) : 'Kantin Upn.jpeg' ?>" class="cart-item-img" alt="<?= htmlspecialchars($item['Nama_Produk']) ?>">
                            
                            <div class="cart-item-info">
                                <div class="item-name"><?= htmlspecialchars($item['Nama_Produk']) ?></div>
                                <div class="item-price">Rp <?= number_format($item['Harga_Produk'], 0, ',', '.') ?></div>
                            </div>
                            
                            <div class="quantity-control">
                                <button type="button" class="quantity-btn btn-minus">-</button>
                                <input type="number" class="quantity-input" value="<?= $item['Jumlah'] ?>" readonly>
                                <button type="button" class="quantity-btn btn-plus">+</button>
                            </div>
                            <div class="harga_produk" hidden><?= $item['Harga_Produk'] ?></div>
                            
                            <div class="item-subtotal">Rp <span class="item-subtotal-val"><?= number_format($subtotalItem, 0, ',', '.') ?></span></div>
                        </div>
                    <?php endforeach; ?>

                    <div class="note-group">
                        <label for="catatan"><i class="fa-solid fa-comment-dots"></i> Catatan untuk Penjual (Opsional)</label>
                        <textarea id="catatan" name="catatan" class="note-textarea" rows="2" placeholder="Contoh: Nasi gorengnya pedas bgt ya bang, es tehnya manis plastik aja..."></textarea>
                    </div>

                <?php else: ?>
                    <div style="text-align: center; padding: 40px; color: #666;">
                        <i class="fa-solid fa-basket-shopping" style="font-size: 3rem; color: #ccc; margin-bottom: 15px;"></i>
                        <h3>Keranjang belanjamu masih kosong nih</h3>
                        <p style="margin-top: 10px;"><a href="index.php?page=kantin-list" style="color: #013220; font-weight: bold; text-decoration: underline;">Yuk, cari makanan enak dulu!</a></p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="summary-section">
                <div class="cart-title">Ringkasan Pesanan</div>
                
                <div class="summary-row">
                    <span>Subtotal Menu</span>
                    <span>Rp <span id="subtotal-menu-val"><?= isset($totalBelanjaan) ? number_format($totalBelanjaan, 0, ',', '.') : '0' ?></span></span>
                </div>
                
                <div class="summary-row total-row">
                    <span>Total Pembayaran</span>
                    <span>Rp <span id="total-pembayaran-val"><?= isset($totalBelanjaan) ? number_format($totalBelanjaan, 0, ',', '.') : '0' ?></span></span>
                </div>

                <button type="submit" class="btn-checkout" <?= empty($items) ? 'disabled style="background: #ccc; cursor: not-allowed;"' : '' ?>>
                    <i class="fa-solid fa-wallet"></i> Konfirmasi & Pesan Sekarang
                </button>
            </div>

        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cartItems = document.querySelectorAll('.cart-item');

            function hitungUlangTotal() {
                let totalSubtotalMenu = 0;
                document.querySelectorAll('.cart-item').forEach(item => {
                    const qty = parseInt(item.querySelector('.quantity-input').value);
                    const harga = parseInt(item.getAttribute('data-harga'));
                    totalSubtotalMenu += (qty * harga);
                });

                document.getElementById('subtotal-menu-val').innerText = totalSubtotalMenu.toLocaleString('id-ID');
                document.getElementById('total-pembayaran-val').innerText = totalSubtotalMenu.toLocaleString('id-ID');
            }

            cartItems.forEach(item => {
                const btnMinus = item.querySelector('.btn-minus');
                const btnPlus = item.querySelector('.btn-plus');
                const qtyInput = item.querySelector('.quantity-input');
                const subtotalText = item.querySelector('.item-subtotal-val');
                
                const detailId = item.getAttribute('data-detail-id');
                const harga = parseInt(item.getAttribute('data-harga'));
                const idCart = parseInt(item.getAttribute('data-cart-id'));

                // SINKRONISASI: Mengubah target asinkron AJAX ke route index.php agar ditangkap controller
                async function kirimKeBackend(aksi) {
                    try {
                        let targetUrl = '';
                        if (aksi === 'update') {
                            window.location.href = `index.php?page=update-keranjang&id_detail=${detailId}&Jumlah=${qtyInput.value}&Subtotal=${qtyInput.value * harga}&cartId=${idCart}`
                            return; 
                        } else if (aksi === 'hapus') {
                            window.location.href = `index.php?page=hapus-keranjang&id_detail=${detailId}`;
                            return;
                        }
                    } catch (eror) {
                        console.error('Koneksi ke backend bermasalah:', eror);
                    }
                }

                btnPlus.addEventListener('click', function() {
                    let angkaSkrg = parseInt(qtyInput.value);
                    angkaSkrg += 1;
                    qtyInput.value = angkaSkrg;
                    subtotalText.innerText = (angkaSkrg * harga).toLocaleString('id-ID');
                    hitungUlangTotal();
                    kirimKeBackend('update');
                });

                btnMinus.addEventListener('click', function() {
                    let angkaSkrg = parseInt(qtyInput.value);
                    if (angkaSkrg > 1) {
                        angkaSkrg -= 1;
                        qtyInput.value = angkaSkrg;
                        subtotalText.innerText = (angkaSkrg * harga).toLocaleString('id-ID');
                        hitungUlangTotal();
                        kirimKeBackend('update');
                    } else {
                        if (confirm('Hapus menu ini dari keranjang belanja?')) {
                            kirimKeBackend('hapus');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>