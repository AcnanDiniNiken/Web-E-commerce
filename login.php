<?php 
    // Menggunakan file fungsi login.php
    require 'function/login.php';
     // Memulai sesi
    session_start();
?>
<!DOCTYPE html>
<html lang="id-ID">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title> Karya Taman Alam </title>
        <!-- Menghubungkan dengan file CSS -->
        <link href="css/login.css" rel="stylesheet" type="text/css" />
        <link href="css/font.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    </head>
    <body>
        <!-- Bagian Header -->
        <h1>Login ke <a href="#">Karya Taman Alam</a></h1>
        <!-- Bagian Form Login -->
        <div class=" w3l-login-form">
            <h2>Login Akun</h2>
            <!-- Menampilkan pesan kesalahan jika username tidak ditemukan atau password salah -->
            <?php if (isset($_SESSION['errorNotFound']) && $_SESSION['errorNotFound'] == true) : ?>
            <div class="flash-message">
                <?php echo "Username tidak ditemukan"; ?>
            </div>
            <?php elseif (isset($_SESSION['errorNotMatch']) && $_SESSION['errorNotMatch'] == true) : ?>
            <div class="flash-message">
                <?php echo "Password yang anda masukkan salah"; ?>
            </div>
            <?php endif; ?>

            <!-- Form Login -->
            <form action="" method="post">
            <!-- Input untuk Username -->
            <div class=" w3l-form-group">
                <label>Username:</label>
                <div class="group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" class="form-control" placeholder="Username" minlength="4" maxlength="16" required>
                </div>
            </div>
            <!-- Input untuk Password -->
            <div class=" w3l-form-group">
                <label>Password:</label>
                <div class="group">
                    <i class="fas fa-unlock"></i>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
            </div>
            <!-- Tombol untuk Login -->
            <button type="submit" name="submit">Login</button>
            </form>
            <?php
                // Memanggil fungsi login() jika tombol login ditekan
                if(isset($_POST['submit'])){
                   login();
                }
            ?>
        </div>

         <!-- Bagian Footer -->
        <footer>
            <p class="copyright-agileinfo"> &copy; 2023 <a href="#">Karya Taman Alam</a></p>
        </footer>
        
        <!-- Menghubungkan dengan library Font Awesome -->
        <script src="https://kit.fontawesome.com/8d85ff5c78.js" crossorigin="anonymous"></script>
    </body>
</html>