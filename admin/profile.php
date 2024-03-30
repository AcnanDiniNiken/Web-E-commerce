<?php
    // Termasuk file header.php yang berisi bagian awal dari halaman
    include 'layouts/header.php';
?>

<!-- Bagian Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <!-- Menampilkan judul halaman -->
                    <h6 class="h2 text-white d-inline-block mb-0">Profil Saya</h6>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <!-- Navigasi breadcrumb untuk memberikan informasi lokasi halaman -->
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <!-- Tautan breadcrumb untuk kembali ke halaman dashboard -->
                            <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i></a></li>
                            <!-- Tautan breadcrumb untuk kembali ke halaman pengaturan -->
                            <li class="breadcrumb-item"><a href="pengaturan.php">Pengaturan</a></li>
                            <!-- Breadcrumb aktif yang menunjukkan halaman profil -->
                            <li class="breadcrumb-item active" aria-current="page">Profil</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
  <!-- Bagian Konten Halaman -->
<div class="container-fluid mt--6">
    <!-- Form untuk mengubah identitas -->
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-8">
                <div class="card-wrapper">
                    <div class="card">
                        <div class="card-header">
                            <!-- Judul Card -->
                            <h3 class="mb-0">Identitas</h3>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <!-- Kolom Nama -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <!-- Label dan Input untuk Nama -->
                                        <label class="form-control-label" for="name">Nama:</label>
                                        <input type="text" name="name" value="<?php echo $user['name']; ?>" class="form-control" id="name" minlength="4" maxlength="255" required>
                                    </div>
                                </div>
                                <!-- Kolom Email -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <!-- Label dan Input untuk Email -->
                                        <label class="form-control-label" for="email">Email:</label>
                                        <input type="email" name="email" value="<?php echo $user['email']; ?>" class="form-control" id="email" minlength="10" maxlength="255" required>
                                    </div>
                              </div>
                        </div>
                  <!-- Kolom untuk Memasukkan Username dan Password -->
<div class="row">
    <!-- Kolom untuk Username -->
    <div class="col-md-6">
        <div class="form-group">
            <!-- Label dan Input untuk Username -->
            <label class="form-control-label" for="username">Username:</label>
            <input type="text" name="username" value="<?php echo $user['username']; ?>" class="form-control" id="username" minlength="4" maxlength="16" required>
        </div>
    </div>
    <!-- Kolom untuk Password -->
    <div class="col-md-6">
        <div class="form-group">
            <!-- Label dan Input untuk Password -->
            <label class="form-control-label" for="password">Password:</label>
            <input type="password" name="password" value="" class="form-control" id="password" minlength="4" maxlength="100">
            <!-- Pemberitahuan untuk Pengguna -->
            <p class="text-muted"><small>Kosongkan password jika tidak ingin mengganti</small></p>
        </div>
    </div>
</div>

<!-- Tombol untuk Menyimpan Perubahan -->
<div class="card">
    <div class="card-body d-none d-md-block">
        <input type="submit" class="btn btn-primary float-right" value="Simpan" name="submit">
    </div>
        </div>
          </div>
          <!-- Kolom untuk Menampilkan Profil dan Mengganti Foto Profil -->
<div class="col-md-4">
    <div class="card card-profile">
        <?php if($user['profile_picture'] != null) {?>
            <!-- Menampilkan Foto Profil Jika Tersedia -->
            <img src="admin_gambar/<?php echo $user['profile_picture'] ?>" alt="<?php echo $user['name']; ?>" class="card-img-top">
        <?php }else{?>
            <!-- Menampilkan Pesan Jika Foto Profil Tidak Tersedia -->
            <p style="text-align: center; margin-top:10px;"></p>
        <?php }?>
        <div class="row justify-content-center">
            <div class="col-lg-6 order-lg-2">
                <div class="card-profile-image">
                    <a href="#" class="changeProfile">
                        <?php if($user['profile_picture'] != null) {?>
                            <!-- Menampilkan Foto Profil Jika Tersedia (Ukuran Kecil) -->
                            <img src="admin_gambar/<?php echo $user['profile_picture'] ?>" alt="<?php echo $user['name']; ?>" class="card-img-top">
                        <?php }else{?>
                            <!-- Form untuk Mengganti Foto Profil -->
                            <div class="form-group">
                                <label class="form-control-label" for="pic">Foto:</label>
                                <input type="file" name="picture" class="form-control" id="pic">
                                <small class="text-muted">Pilih foto PNG atau JPG dengan ukuran maksimal 2MB</small>
                            </div>
                        <?php }?>
                      </a>
                    </div>
                  </div>
                </div>
                
                <!-- Bagian Tampilan Profil Pengguna -->
<div class="card-body pt-0" style="margin-top: 80px">
    <div class="text-center">
        <!-- Menampilkan Nama dan Email Pengguna -->
        <h5 class="h3"><?php echo $user['name'] ?></h5>
        <div class="h5 mt-4">
            <i class="fa fa-at mr-2"></i><?php echo $user['email']; ?>
        </div>
    </div>
</div>
</div>
</div>
</form>

<?php 
    // Menangani pengiriman formulir untuk mengganti profil
    if(isset($_POST['submit'])){
        change_profile($user['id'], $user['password']);
    }
?>

<script>
// Script untuk menyembunyikan input file dan menampilkan formulir memilih file ketika tombol di-klik
$('.changeProfile').click(function(e) {
    $('#fileSelect').click();
})
</script>

<?php
    include 'layouts/footer.php';
?> 
