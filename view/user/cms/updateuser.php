<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Pengguna - SIKANTIN</title>
    <link rel="stylesheet" href="view/user/cms/style.css">
</head>
<body>

<div class="update-container">
    <div class="update-card">
        <h2>Update Akun: <?= htmlspecialchars($user['Nama_User'] ?? 'Pengguna') ?></h2>
        <p class="subtitle">Silakan perbarui data pengguna di bawah ini.</p>
        <hr class="divider">
        
        <form action="/Kantin-Sederhana/index.php?page=admin-action-user" method="POST">
            <input type="hidden" name="id" value="<?= $user['ID_User'] ?? '' ?>">

            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($user['Nama_User'] ?? '') ?>" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['Email_User'] ?? '') ?>" required>
            </div>
            
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea id="alamat" name="alamat" rows="3" required><?= htmlspecialchars($user['Alamat_User'] ?? '') ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="role">Hak Akses (Role)</label>
                <select id="role" name="role" required>
                    <?php $currentRole = $user['Role_User'] ?? ''; ?>
                    <option value="Admin" <?= $currentRole === 'Admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="Penjual" <?= $currentRole === 'Penjual' ? 'selected' : '' ?>>Penjual</option>
                    <option value="Pembeli" <?= $currentRole === 'Pembeli' ? 'selected' : '' ?>>Pembeli</option>
                </select>
            </div>
            
            <div class="btn-group">
                <button type="submit" name="update" class="btn btn-save">Simpan Perubahan</button>
                <a href="/Kantin-Sederhana/index.php?page=admin-dashboard" class="btn btn-cancel">Batal</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>