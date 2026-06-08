<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Admin Dashboard - Kantin</title>
    <link rel="stylesheet" href="/Kantin-Sederhana/view/user/cms/style.css">
</head>
<body>

<body>

<div class="container" style="position: relative;"> <!-- Ditambahkan position: relative -->
    
    <!-- ⬇️ TOMBOL LOGOUT KANAN ATAS ⬇️ -->
    <div style="position: absolute; top: 20px; right: 0;">
        <a href="index.php?page=logout" class="nav-profil" title="Logout" onclick="return confirm('Apakah Anda yakin ingin keluar dari aplikasi SIKANTIN?')">
                <i class="fa-solid fa-right-from-bracket" style="font-size: 20px; color: #ff0000;"></i>
            </a>
    </div>

    <h1>Dashboard Admin - Manajemen Akun Kantin</h1>
    <p>Selamat datang! Di sini Anda dapat mendaftarkan akun baru untuk Pembeli, Penjual, maupun sesama Admin.</p>
    
    <div class="dashboard-grid">
        
        <div class="card">
            <h2>Tambah Akun Baru</h2>
            <form action="/Kantin-Sederhana/index.php?page=admin-action-user" method="POST">
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama..." required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="contoh@email.com" required>
                </div>
                
                <div class="form-group">
                    <label for="pass">Password</label>
                    <input type="password" id="pass" name="pass" placeholder="Minimal 6 karakter" required>
                </div>
                
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea id="alamat" name="alamat" rows="3" placeholder="Alamat rumah atau lokasi stan..." required></textarea>
                </div>
                
                <div class="form-group">
                    <label for="role">Hak Akses (Role)</label>
                    <select id="role" name="role" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="Admin">Admin</option>
                        <option value="Penjual">Penjual</option>
                        <option value="Pembeli">Pembeli</option>
                    </select>
                </div>
                
                <button type="submit" name="create" class="btn">Daftarkan Akun</button>
            </form>
        </div>
        
        <div class="card">
            <h2>Daftar Pengguna Sistem</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= htmlspecialchars($user['Nama_User']) ?></td>
                                <td><?= htmlspecialchars($user['Email_User']) ?></td>
                                <td><?= htmlspecialchars($user['Alamat_User']) ?></td>
                                <td>
                                    <?php 
                                        $roleClass = 'badge-pembeli';
                                        if(strtolower($user['Role_User']) === 'admin') $roleClass = 'badge-admin';
                                        if(strtolower($user['Role_User']) === 'penjual') $roleClass = 'badge-penjual';
                                    ?>
                                    <span class="badge <?= $roleClass ?>"><?= htmlspecialchars($user['Role_User']) ?></span>
                                </td>
                                <td>
                                    <a href="/Kantin-Sederhana/index.php?page=admin-edit-user&id=<?= $user['ID_User'] ?>" class="btn-edit">Edit</a>
                                    <a href="/Kantin-Sederhana/index.php?page=admin-action-user&delete=<?= $user['ID_User'] ?>" 
                                       class="btn-danger" 
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">Belum ada data user.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="card">
            <h2>Tambah Stan Kantin Baru</h2>
            <form action="/Kantin-Sederhana/index.php?page=admin-action-kantin" method="POST">
                <div class="form-group">
                    <label for="nama_kantin">Nama Stan Kantin</label>
                    <input type="text" id="nama_kantin" name="nama" placeholder="Contoh: Kantin Mungil..." required>
                </div>

                <div class="form-group">
                    <label for="kantin_url">Gambar Kantin (url)</label>
                    <input type="text" id="kantin_url" name="Kantin_url" placeholder="Contoh: https://ik.imagekit.io/primaku..." required>
                </div>
                
                <div class="form-group">
                    <label for="telp_kantin">Nomor Telepon Stan</label>
                    <input type="text" id="telp_kantin" name="telp" placeholder="Contoh: 081123123..." required>
                </div>
                
                <div class="form-group">
                    <label for="id_user_pemilik">Pilih Pemilik Stan (User Penjual)</label>
                    <select id="id_user_pemilik" name="id_user" required>
                        <option value="">-- Pilih User Penjual --</option>
                        <?php if (!empty($users)): ?>
                            <?php foreach ($users as $u): ?>
                                <?php if (strtolower($u['Role_User']) === 'penjual'): ?>
                                    <option value="<?= $u['ID_User'] ?>"><?= htmlspecialchars($u['Nama_User']) ?> (ID: <?= $u['ID_User'] ?>)</option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status_buka">Status Operasional Awal</label>
                    <select id="status_buka" name="status" required>
                        <option value="1">Buka / Aktif</option>
                        <option value="0">Tutup / Nonaktif</option>
                    </select>
                </div>
                
                <button type="submit" name="create" class="btn" style="background-color: #013220; color: white;">Daftarkan Stan Kantin</button>
            </form>
        </div>

        <div class="card">
            <h2>Daftar Stan Kantin Terdaftar</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Stan</th>
                        <th>No. Telp</th>
                        <th>ID Pemilik</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($kantins)): ?>
                        <?php foreach ($kantins as $k): ?>
                            <tr>
                                <td><?= htmlspecialchars($k['ID_Kantin']) ?></td>
                                <td><strong><?= htmlspecialchars($k['Nama_Kantin']) ?></strong></td>
                                <td><?= htmlspecialchars($k['Telp_Kantin']) ?></td>
                                <td><?= htmlspecialchars($k['ID_User']) ?></td>
                                <td>
                                    <span class="badge <?= $k['Status_Buka'] == 1 ? 'badge-penjual' : 'badge-admin' ?>">
                                        <?= $k['Status_Buka'] == 1 ? 'Buka' : 'Tutup' ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="/Kantin-Sederhana/index.php?page=admin-action-kantin&delete_kantin=<?= $k['ID_Kantin'] ?>" 
                                       class="btn-danger" 
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus stan kantin ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align: center;">Belum ada data stan kantin.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
    </div>
</div>

</body>
</html>