<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Pengguna - SIKANTIN</title>
    <link rel="stylesheet" href="view/user/cms/style.css">
</head>
<body>

<div class="container" style="max-width: 600px; margin-top: 50px;">
    <div class="card">
        <h2>Update Akun: <?= htmlspecialchars($update['Nama_User']) ?></h2>
        <p style="color: #666; font-size: 14px;">Silakan perbarui data pengguna di bawah ini.</p>
        <hr style="border: 0; border-top: 1px solid #eee; margin-bottom: 20px;">
        
        <form action="/Kantin-Sederhana/index.php?page=admin-action-user" method="POST">
            <input type="hidden" name="id_user" value="<?= $updateUser['ID_User'] ?>">

            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($updateUser['Nama_User']) ?>" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($updateUser['Email_User']) ?>" required>
            </div>
            
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea id="alamat" name="alamat" rows="3" required><?= htmlspecialchars($userToEdit['Alamat_User']) ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="role">Hak Akses (Role)</label>
                <select id="role" name="role" required>
                    <option value="Admin" <?= $userToEdit['Role_User'] === 'Admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="Penjual" <?= $userToEdit['Role_User'] === 'Penjual' ? 'selected' : '' ?>>Penjual</option>
                    <option value="Pembeli" <?= $userToEdit['Role_User'] === 'Pembeli' ? 'selected' : '' ?>>Pembeli</option>
                </select>
            </div>
            
            <div style="margin-top: 20px;">
                <button type="submit" name="update" class="btn" style="background-color: #2ecc71;">Simpan Perubahan</button>
                <a href="/Kantin-Sederhana/index.php?page=admin-dashboard" class="btn" style="background-color: #95a5a6; text-decoration: none; display: inline-block; text-align: center;">Batal</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>