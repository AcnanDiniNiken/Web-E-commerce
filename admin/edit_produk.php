<?php
    // Memasukkan file header.php dan produk_function.php ke dalam halaman
    include 'layouts/header.php';
    include 'function/produk_function.php';

    // Mendapatkan data produk berdasarkan ID yang diterima dari parameter URL ($_GET['id'])
    $product = get_product_by_id($_GET['id']);
    // Mendapatkan semua kategori produk
    $categories = get_all_categories();
?>
    <!-- Bagian header dengan background warna biru (bg-primary) -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <!-- Bagian kiri header dengan judul "Edit Produk" -->
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Edit Produk</h6>
            </div>
            <!-- Bagian kanan header dengan navigasi breadcrumb -->
            <div class="col-lg-6 col-5 text-right">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <!-- Navigasi breadcrumb yang menunjukkan jalur halaman -->
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="admin.php"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="produk.php">Produk</a></li>
                  <li class="breadcrumb-item"><a href="view_produk.php?id=<?php echo $product['id']; ?>"><?php echo $product['name']; ?></a></li>
                  <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Page content -->
    <div class="container-fluid mt--6">
      <!-- Membuat formulir untuk mengedit data produk -->
    <form action="" method="post" enctype="multipart/form-data">
      <!-- Input tersembunyi untuk menyimpan ID produk yang sedang diubah -->
      <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

      <div class="row">
        <div class="col-md-8">
          <div class="card-wrapper">
            <div class="card">
               <!-- Bagian header kartu yang berisi judul "Data Produk" -->
              <div class="card-header">
                <h3 class="mb-0">Data Produk</h3>
              </div>

              <!--Bagian tubuh kartu yang berisi elemen-elemen formulir untuk mengedit data produk -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <!-- Label untuk input pemilihan kategori produk -->
                      <label class="form-control-label" for="pakcage">Kategori:</label>
                      <!-- Input pemilihan (dropdown) untuk memilih kategori produk -->
                      <select name="category_id" class="form-control" id="package">
                        <!-- Opsi dalam dropdown yang menampilkan kategori-kategori produk yang dapat dipilih -->
                        <option>Pilih kategori</option>
                        <?php if ( count($categories) > 0) : ?>
                          <?php foreach ($categories as $category) : ?>
                            <option value="<?php echo $category['id']; ?>" <?php if($product['category_id'] == $category['id']){echo 'selected';}?>>› <?php echo $category['nama']; ?></option>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </select>
                  </div>
                  </div>
                </div>

                <div class="form-group">
                  <!-- Label untuk input teks nama produk -->
                  <label class="form-control-label" for="name">Nama produk:</label>
                   <!-- Input teks untuk memasukkan nama produk -->
                  <input type="text" name="name" value="<?php echo $product['name']; ?>" class="form-control" id="name">
                </div>

                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <!-- Label untuk input teks harga produk -->
                      <label class="form-control-label" for="price">Harga:</label>
                      <div class="input-group mb-3">
                        <!-- Input teks dengan tambahan grup input untuk menampilkan simbol mata uang "Rp" -->
                        <div class="input-group-prepend">
                          <span class="input-group-text">Rp</span>
                        </div>
                        <!-- Input teks untuk memasukkan harga produk -->
                        <input type="text" name="price" value="<?php echo $product['price']; ?>" class="form-control" id="price">
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                  <div class="form-group">
                    <!-- Label untuk input teks diskon produk -->
                  <label class="form-control-label" for="price_d">Diskon:</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rp</span>
                    </div>
                     <!-- Input teks untuk memasukkan nilai diskon produk -->
                    <input type="text" name="price_discount" value="<?php echo $product['current_discount'] ?>" class="form-control" id="price_d">
                  </div>
                </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <!-- Label untuk input teks stok produk -->
                      <label class="form-control-label" for="stock">Stok:</label>
                      <!-- Input teks untuk memasukkan atau mengedit stok produk -->
                      <input type="text" name="stock" value="<?php echo $product['stock']?>" class="form-control" id="stock">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <!-- Label untuk input teks satuan produk -->
                      <label class="form-control-label" for="unit">Satuan:</label>
                       <!-- Input teks untuk memasukkan atau mengedit satuan produk -->
                      <input type="text" name="unit" value="<?php echo $product['product_unit']; ?>" class="form-control" id="unit">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                   <!-- Label untuk input teks deskripsi produk -->
                  <label class="form-control-label" for="desc">Deskripsi:</label>
                  <!-- Textarea untuk memasukkan atau mengedit deskripsi produk -->
                  <textarea name="descript" class="form-control" id="descript"><?php echo $product['descript']; ?></textarea>
                </div>

                <div class="form-group">
                  <label for="av" class="form-control-label">
                  <!-- Label dan input checkbox untuk menandai ketersediaan produk -->
                    <input type="checkbox" id="av" name="is_available" value="1"> Apakah produk ini tersedia?
                  </label>
                </div>
              
              </div>
              
            </div>
            
          </div>

        </div>
        <div class="col-md-4">
        !-- Card untuk mengelola foto produk -->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-4">
                            <h3 class="mb-0">Foto</h3>
                        </div>
                        <?php if ($product['picture_name']) : ?>
                           <!-- Kolom navigasi tab jika ada foto produk -->
                        <div class="col-8">
                          <!-- Navigasi tab untuk melihat foto saat ini, mengganti, atau menghapusnya -->
                            <ul class="nav nav-pills mb-3 float-right" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link p-1 active" id="pills-current-tab" data-toggle="pill" href="#pills-current" role="tab" aria-controls="pills-home" aria-selected="true">Current</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-1" id="pills-edit-tab" data-toggle="pill" href="#pills-edit" role="tab" aria-controls="pills-profile" aria-selected="false">Ganti</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-1" id="pills-delete-tab" data-toggle="pill" href="#pills-delete" role="tab" aria-controls="pills-contact" aria-selected="false">Hapus</a>
                                </li>
                            </ul>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body">
                    <?php if ($product['picture_name'] != NULL) : ?>
                      <!-- Konten tab untuk melihat foto saat ini -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-current" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="text-center">
                              <!-- Menampilkan foto saat ini -->
                                <img alt="<?php echo $product['name']; ?>" src="<?php echo 'produk_gambar/' . $product['picture_name']; ?>" class="img img-fluid rounded">
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-edit" role="tabpanel" aria-labelledby="pills-profile-tab">
                          <!-- Konten tab untuk mengganti foto -->
                            <div class="form-group">
                              <!-- Label untuk input berkas (file) -->
                                <label class="form-control-label" for="pic">Foto:</label>
                                <!-- Input berkas (file) untuk memilih foto baru -->
                                <input type="file" name="picture" class="form-control" id="pic">
                                <small class="text-muted">Pilih foto PNG atau JPG dengan ukuran maksimal 2MB</small>
                                <small class="newUploadText">Unggah file baru untuk mengganti foto saat ini.</small>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-delete" role="tabpanel" aria-labelledby="pills-contact-tab">
                          <!-- Konten tab untuk menghapus foto -->
                            <p class="deleteText">Klik link dibawah untuk menghapus foto. Tindakan ini tidak dapat dibatalkan.</p>
                             <!-- Tombol untuk menghapus foto -->
                            <div class="text-right">
                                <a href="#" class="deletePictureBtn btn btn-danger">Hapus</a>
                            </div>
                        </div>
                    </div>
                    <?php else : ?>
                       <!-- Bagian formulir untuk unggah foto baru jika tidak ada foto saat ini -->
                    <div class="form-group">
                        <label class="form-control-label" for="pic">Foto:</label>
                        <input type="file" name="picture" class="form-control" id="pic">
                        <small class="text-muted">Pilih foto PNG atau JPG dengan ukuran maksimal 2MB</small>
                    </div>
                    <?php endif; ?>
                </div>
                <!-- Bagian footer dari kartu (card) -->
                <div class="card-footer text-right">
                  <!-- Tombol untuk menyimpan perubahan pada produk -->
                    <input type="submit" value="Simpan" name="submit" class="btn btn-primary">
                </div>
            </div>
        </div>
      </div>

    </form>
    <?php 
    // Jika tombol submit pada formulir ditekan
        if(isset($_POST['submit'])){
          // Panggil fungsi untuk menyimpan perubahan pada produk
            edit_product($_GET['id']);
        }
    ?>
    
    <!-- Skrip JavaScript untuk menangani tindakan penghapusan foto -->
    <script>
      // Saat tombol penghapusan foto diklik
        $('.deletePictureBtn').click(function(e) {
            e.preventDefault();

            // Mengubah teks tombol menjadi indikator penghapusan
            $(this).html('<i class="fa fa-spin fa-spinner"></i> Menghapus...');

            $.ajax({ // Menggunakan jQuery Ajax untuk menghapus gambar produk
                method: 'POST',
                url: 'function/produk_delete.php', // URL tempat penghapusan gambar di-handle
                data: {
                    id: <?php echo $product['id']; ?>,   // Data yang dikirim bersama permintaan, termasuk ID produk dan tindakan yang diinginkan
                    action: 'delete_image'
                },
                context: this,  // Konteks (this) yang digunakan dalam pemanggilan fungsi sukses
                success: function(res) { // Fungsi yang dipanggil ketika permintaan sukses
                    if (res.code == 204) {
                      // Mengubah teks dan tampilan setelah gambar dihapus
                        $('.deleteText').text('Gambar berhasil dihapus. Produk ini akan menggunakan gambar default jika tidak ada gambar baru yang diunggah');
                        $(this).html('<i class="fa fa-check"></i> Terhapus!');

                        setTimeout(function() {
                          // Mengubah teks dan tampilan setelah menunggu
                            $('.newUploadText').text('Pilih gambar baru untuk mengganti gambar yang dihapus');
                            $('#pills-delete, #pills-delete-tab, #pills-current, #pills-current-tab').hide('fade');
                            $('#pills-edit').tab('show');
                            $('#pills-edit-tab').addClass('active').text('Upload baru');
                        }, 3000);
                    }
                    else {
                        console.log('Terdapat kesalahan'); // Menampilkan pesan kesalahan jika respons tidak sesuai yang diharapkan
                    }
                }
            })
        });
    </script>

<?php
    include 'layouts/footer.php';
?>