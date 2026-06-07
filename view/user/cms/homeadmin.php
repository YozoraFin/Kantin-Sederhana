<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Kantin</title>
    <link rel="stylesheet" href="/Kantin-Sederhana/view/user/cms/style.css">
</head>
<body>

<div class="container">
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
                            <a href="/Kantin-Sederhana/index.php?page=admin-dashboard&edit=<?= $user['ID_User'] ?>" class="btn-edit" style="background-color: #f1c40f; color: black; padding: 5px 10px; border-radius: 4px; text-decoration: none; font-size: 14px; margin-right: 5px;">Edit</a>
    
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
        
    </div>
</div>

</body>
</html>