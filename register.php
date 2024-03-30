<?php
    // Memanggil file register.php yang berisi fungsi-fungsi terkait registrasi
    require 'function/register.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Pengaturan informasi meta dan judul dokumen HTML -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <title>Buat Akun</title>

     <!-- Menyertakan file CSS eksternal untuk tata letak dan gaya tampilan halaman -->
    <link href="css/register/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="css/register/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Menyertakan font eksternal dari Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <!-- Menyertakan file CSS eksternal untuk komponen-komponen pihak ketiga -->
    <link href="css/register/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="css/register/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">
     <!-- Menyertakan file CSS utama yang mengatur tata letak dan gaya tampilan halaman -->
    <link href="css/register/css/main7.css" rel="stylesheet" media="all">

    <style>
        /* selector CSS yang menargetkan elemen dengan kelas */
        .input--style-2:hover {
            border-bottom: 1px solid #FA4251;
            color: #4DAE3C
        }
    </style>
</head>

<body>
     <!-- Wrapper untuk halaman dengan latar belakang merah dan tata letak font Roboto -->
    <div class="page-wrapper bg-red p-t-180 p-b-100 font-robo">
        <div class="wrapper wrapper--w960">
            <div class="card card-2">
                <div class="card-heading"></div>
                <div class="card-body">
                      <!-- Judul formulir registrasi -->
                    <h2 class="title">Buat Akun</h2>
                    <!-- Formulir registrasi dengan metode POST dan aksi kosong (diisi setelah penjelasan) -->
                    <form action="" method="post">
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <!-- Input untuk username dengan gaya-2 saat dihover -->
                                    <input class="input--style-2" type="text" placeholder="Username" minlength="4" maxlength="16" name="username" required>
                                </div>
                            </div>
                            <!-- Kolom kedua untuk input password -->
                            <div class="col-2">
                                <div class="input-group">
                                    <!-- Input untuk password dengan gaya-2 saat dihover -->
                                    <input class="input--style-2" type="password" placeholder="Password" name="password" required>
                                </div>
                            </div>
                        </div>

                        <div class="input-group">
                            <!-- Input untuk nama lengkap -->
                            <input class="input--style-2" type="text" placeholder="Nama lengkap" name="name" required>
                        </div>
                        <!-- Baris kedua formulir dengan dua kolom -->
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <!-- Input untuk nomor HP dengan gaya-2 saat dihover -->
                                    <input class="input--style-2" type="text" placeholder="No. HP" minlength="9" maxlength="15" name="phone_number" required>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <!-- Input untuk email dengan gaya-2 saat dihover -->
                                    <input class="input--style-2" minlength="10" type="email" placeholder="Email" name="email" required>
                                </div>
                            </div>
                        </div>
                        <div class="input-group">
                            <!-- Input untuk alamat -->
                            <input class="input--style-2" type="text" placeholder="Alamat" name="address" required>
                        </div>
                        <div class="p-t-30">
                            <!-- Tombol submit untuk mengirim formulir -->
                            <button class="btn btn--radius btn--green" type="submit" name="submit">Daftar</button>
                        </div>
                    </form>
                    <?php 
                        // Mengecek apakah tombol submit ditekan dan memanggil fungsi register() jika iya
                        if(isset($_POST['submit'])){
                            register();
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>