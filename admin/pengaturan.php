<?php
    // Menggunakan file header.php sebagai bagian dari layout halaman
    include 'layouts/header.php';

    // Menggunakan fungsi dari file pengaturan_function.php untuk mendapatkan data pengaturan
    include 'function/pengaturan_function.php';

    // Mendapatkan data pengaturan
    $data = get_data_pengaturan();

    // Mendapatkan data bank dari indeks ke-11 dalam data pengaturan
    $banks = $data[11]['content'];

    // Mendekode JSON data bank menjadi array asosiatif
    $banks = json_decode($banks, true);
?>
    <!-- Header -->
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <!-- Judul halaman Pengaturan Situs -->
          <h6 class="h2 text-white d-inline-block mb-0">Pengaturan Situs</h6>
        </div>
        <div class="col-lg-6 col-5 text-right">
          <!-- Breadcrumb navigation untuk menunjukkan jalur navigasi pada halaman -->
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <!-- Ikon rumah sebagai tautan ke dashboard.php -->
              <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i></a></li>
              <!-- Tautan aktif yang menunjukkan halaman Pengaturan -->
              <li class="breadcrumb-item active" aria-current="page">Pengaturan</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>

    <!-- Page content -->
<div class="container-fluid mt--6">
  <!-- Form untuk mengupdate identitas toko -->
  <form action="" method="post" enctype="multipart/form-data">

    <div class="row">
      <div class="col-md-8">
        <!-- Wrapper untuk kartu (card) -->
        <div class="card-wrapper">
          <!-- Kartu (card) identitas toko -->
          <div class="card">
            <!-- Header kartu dengan judul "Identitas Toko" -->
            <div class="card-header">
              <h3 class="mb-0">Identitas Toko</h3>
            </div>

            <!-- Isi dari kartu (card) -->
            <div class="card-body">
              <!-- Form group untuk input nama toko -->
              <div class="form-group">
                <label class="form-control-label" for="name">Nama toko:</label>
                <!-- Input teks untuk nama toko dengan nilai default dari data yang sudah ada -->
                <input type="text" name="store_name" value="<?php echo $data[1]['content']; ?>" class="form-control" id="name">
              </div>

               <!-- Row untuk input nomor HP dan email -->
<div class="row">
  <!-- Kolom untuk input nomor HP -->
  <div class="col-6">
    <div class="form-group">
      <label class="form-control-label" for="phone_number">No. HP:</label>
      <!-- Input teks untuk nomor HP dengan nilai default dari data yang sudah ada -->
      <input type="text" name="store_phone_number" value="<?php echo $data[2]['content'];?>" class="form-control" id="phone_number">
    </div>
  </div>
  <!-- Kolom untuk input email -->
  <div class="col-6">
    <div class="form-group">
      <label class="form-control-label" for="email">Email:</label>
      <!-- Input teks untuk email dengan nilai default dari data yang sudah ada -->
      <input type="text" name="store_email" value="<?php echo $data[3]['content'];?>" class="form-control" id="email">
    </div>
  </div>
</div>

<!-- Form group untuk input alamat -->
<div class="form-group">
  <label class="form-control-label" for="address">Alamat:</label>
<!-- Textarea untuk alamat dengan nilai default dari data yang sudah ada -->
  <textarea name="store_address" class="form-control" id="address"><?php echo $data[8]['content'];?></textarea>
</div>

<!-- Form group untuk input tagline -->
<div class="form-group">
  <label class="form-control-label" for="tagline">Tagline:</label>
  <!-- Input teks untuk tagline dengan nilai default dari data yang sudah ada -->
  <input type="text" name="store_tagline" value="<?php echo $data[4]['content'];?>" class="form-control" id="tagline">
</div>

<!-- Form group untuk input deskripsi -->
<div class="form-group">
  <label class="form-control-label" for="description">Deskripsi:</label>
  <!-- Textarea untuk deskripsi dengan nilai default dari data yang sudah ada -->
  <textarea name="store_description" class="form-control" id="description"><?php echo $data[7]['content'];?></textarea>
</div>
 
            <div class="card">
              <div class="card-header">
                 <!-- Header kartu dengan judul "Pengaturan Pembayaran" -->
                <h3 class="mb-0">Pengaturan Pembayaran</h3>
                <!-- Tombol untuk menambahkan bank baru -->
                <button type="button" class="btn btn-outline-primary btn-add float-right btn-sm" style="margin-top: -30px;"><i class="fas fa-plus-square"></i></button>
              </div>
               <!-- Isi dari kartu (card) -->
              <div class="card-body">
                <!-- Pengecekan apakah terdapat data bank yang sudah ada -->
              <?php if ( is_array($banks) && count($banks) > 0) : ?>
                <?php $n = 0; ?>
                <!-- Container untuk bank-bank yang sudah ada -->
                <div class="increment">
              <?php foreach ($banks as $bank) : ?>
                
                <div class="row alert alert-info">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="">Nama bank:</label>
                       <!-- Input teks untuk nama bank dengan nilai default dari data yang sudah ada -->
                      <input type="text" class="form-control" name="banks[<?php echo $n; ?>][bank]" value="<?php echo $bank['bank']; ?>">
                    </div>
                  </div>
                  <div class="col-6">
                    <label for="">No. Rekening:</label>
                     <!-- Input teks untuk nomor rekening dengan nilai default dari data yang sudah ada -->
                    <input type="text" class="form-control" name="banks[<?php echo $n; ?>][number]" value="<?php echo $bank['number']; ?>">
                  </div>
                  <div class="col-6">
                    <label for="">Nama pemilik:</label>
                     <!-- Input teks untuk nama pemilik dengan nilai default dari data yang sudah ada -->
                    <input type="text" class="form-control" name="banks[<?php echo $n; ?>][name]" value="samsung jakarta">
                  </div>
                </div>
              
              <?php $n++; ?>
              <?php endforeach; ?>
              </div>
              <!-- Pengecekan apakah tidak ada data bank yang sudah ada -->
              <?php else : ?>
                 <!-- Informasi jika belum ada data bank yang ditambahkan -->
              <div class="alert alert-info alert-zero">Belum ada data bank yang ditambahkan. Tambahkan yang pertama!</div>
              <!-- Container untuk bank yang pertama -->
              <div class="increment">
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="">Nama bank:</label>
                      <!-- Input teks untuk nama bank -->
                      <input type="text" class="form-control" name="banks[0][bank]">
                    </div>
                  </div>
                  <!-- Kolom untuk input nomor rekening -->
                  <div class="col-6">
                    <label for="">No. Rekening:</label>
                    <!-- Input teks untuk nomor rekening -->
                    <input type="text" class="form-control" name="banks[0][number]">
                  </div>
                  <div class="col-6">
                    <label for="">Nama pemilik:</label>
                     <!-- Input teks untuk nama pemilik -->
                    <input type="text" class="form-control" name="banks[0][name]">
                  </div>
                </div>
              </div>

              <?php endif; ?>
              </div>
              <div class="card-footer">
                 <!-- Tombol untuk menyimpan perubahan -->
                
              </div>
            </div>
            
          </div>
        </div>

        <!-- Kolom untuk tampilan medium dan ke atas (col-md-4) -->
<div class="col-md-4">
  <!-- Kartu (card) untuk pengaturan logo -->
  <div class="card">
    <!-- Header kartu dengan judul "Logo" -->
    <div class="card-header">
      <h3 class="mb-0">Logo</h3>
    </div>
    <!-- Isi dari kartu (card) -->
    <div class="card-body">
      <!-- Form group untuk input foto/logo -->
      <div class="form-group">
        <label class="form-control-label" for="pic">Foto:</label>
        <!-- Input tipe file untuk memilih foto/logo -->
        <input type="file" name="picture" class="form-control" id="pic">
        <!-- Informasi tambahan untuk pengguna -->
        <small class="text-muted">Pilih foto PNG atau JPG dengan ukuran maksimal 2MB</small>
      </div>
    </div>
  </div>

  <!-- Kartu (card) untuk tombol Simpan -->
  <div class="card">
    <!-- Isi dari kartu (card) -->
    <div class="card-body">
      <!-- Input tipe submit untuk menyimpan perubahan -->
      <input type="submit" value="Simpan" name="ubah" class="btn btn-primary">
    </div>
  </div>
</div>
<!-- Penutup dari row -->
</div>
</form>

<?php 
  // Pengecekan apakah tombol "Simpan" (dengan nama "ubah") ditekan
  if(isset($_POST['ubah'])){
    // Panggil fungsi untuk memperbarui semua pengaturan
    update_all_setting();
  }
?>

   <!-- Skrip JavaScript untuk menangani penambahan dan penghapusan input bank -->
<script>
    // Saat dokumen telah dimuat sepenuhnya
    jQuery(document).ready(function () {
        // Inisialisasi variabel no dengan nilai 0
        let no = 0;
        
        // Iterasi melalui semua input dengan nama yang diawali "banks["
        $('input[name^="banks["]').each(function() {
            // Dapatkan nama atribut input
            var name = $(this).attr('name');
            
            // Cocokkan pola untuk mendapatkan nomor urut
            var match = name.match(/\[([0-9]+)\]/);
            
            // Jika ada cocokan dan nomor urut ditemukan, set nilai no
            if (match && match[1]) {
                no = parseInt(match[1]);
            }
        });

        // Saat tombol dengan kelas .btn-add ditekan
        jQuery(".btn-add").click(function () {
            // Tambahkan 1 ke nilai no
            no = no + 1;

            // Bangun markup HTML untuk input bank baru
            let markup = `<div class="row alert alert-success m-1">
              <div class="col-12">
                <div class="form-group">
                  <label for="">Nama bank:</label>
                  <input type="text" class="form-control" name="banks[${no}][bank]">
                </div>
              </div>
              <div class="col-6">
                <label for="">No. Rekening:</label>
                <input type="text" class="form-control" name="banks[${no}][number]">
              </div>
              <div class="col-6">
                <label for="">Nama pemilik:</label>
                <input type="text" class="form-control" name="banks[${no}][name]">
              </div>
            </div>`;

            // Tambahkan markup ke elemen dengan kelas .increment
            jQuery(".increment").append(markup);

            // Sembunyikan pesan "Belum ada data bank" jika ada
            let zero = $('.alert-zero');
            if (zero.length > 0) {
              zero.hide('fade');
            }
        });

        // Saat tombol dengan kelas .btn-remove ditekan
        jQuery("body").on("click", ".btn-remove", function () {
            // Hapus elemen input grup terkait
            jQuery(this).parents(".input-group").remove();

            // Tampilkan pesan "Belum ada data bank" jika tidak ada input bank lagi
            let zero = $('.alert-zero');
            if (zero.length > 0) {
              zero.show('fade')
            }
        })
    });
</script>

<?php
    include 'layouts/footer.php';
?>