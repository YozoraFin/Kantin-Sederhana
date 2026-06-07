<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="/Kantin-Sederhana/view/src/style.css">
    <title>Login - SIKANTIN</title>
</head>
<body class="register-page"> 
    <div class="register-box">
        <h2>Masuk SIKANTIN</h2>
        
        <form action="index.php?page=proses-login" method="POST">
            <div class="register-input-group">
                <label>Nama</label>
                <input type="text" name="email" required>
            </div>

            <form action="index.php?page=proses-login" method="POST">
            <div class="register-input-group">
                <label>Email</label>
                <input type="text" name="email" required>
            </div>

            <form action="index.php?page=proses-login" method="POST">
            <div class="register-input-group">
                <label>Password</label>
                <input type="text" name="email" required>
            </div>

            <form action="index.php?page=proses-login" method="POST">
            <div class="register-input-group">
                <label>Alamat</label>
                <input type="text" name="email" required>
            </div>

            
            <div class="register-input-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" class="btn-register">Register</button>
        </form>
    </div>

</body>
</html>
