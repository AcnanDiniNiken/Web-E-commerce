<?php
session_start();

// Mengosongkan $_SESSION
$_SESSION = array();

// Menghancurkan sesi
session_destroy();

// Menampilkan pesan logout berhasil menggunakan JavaScript
echo "
    <script>
        alert('Logout berhasil');
        window.location='../login.php';
    </script>
";

// Menghentikan eksekusi skrip
exit();
?>
