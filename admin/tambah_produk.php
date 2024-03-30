<?php 
    // Memasukkan file header.php yang berisi struktur awal halaman
    include 'layouts/header.php';

    // Memasukkan file fungsi produk_function.php yang berisi fungsi terkait produk
    include 'function/produk_function.php';

    // Mendapatkan semua kategori produk
    $categories = get_all_categories();
?>
    <!-- Bagian Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <!-- Menampilkan judul halaman -->
              <h6 class="h2 text-white d-inline-block mb-0">Tambah Produk</h6>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <!-- Menampilkan breadcrumb (navigasi) -->
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="produk.php">Produk</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>

   <!-- Bagian Page Content -->
<div class="container-fluid mt--6">
    <!-- Form untuk menambahkan produk -->
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-8">
                <!-- Card untuk menampilkan data produk -->
                <div class="card-wrapper">
                    <div class="card">
                        <!-- Card header dengan judul "Data Produk" -->
                        <div class="card-header">
                            <h3 class="mb-0">Data Produk</h3>
                        </div>
                
                        <!-- Card body dengan form data produk -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Form group untuk memilih kategori produk -->
                                    <div class="form-group">
                                        <label class="form-control-label" for="pakcage">Kategori:</label>
                                        <!-- Dropdown untuk memilih kategori produk -->
                                        <select name="category_id" class="form-control" id="package">
                                            <option>Pilih kategori</option>
                                            <?php 
                                                // Memeriksa apakah terdapat kategori produk
                                                if (count($categories) > 0) :
                                                    // Melooping semua kategori produk
                                                    foreach ($categories as $category) :
                                            ?>
                                                        <!-- Menampilkan opsi kategori produk -->
                                                        <option value="<?php echo $category['id']; ?>">› <?php echo $category['nama']; ?></option>
                                            <?php 
                                                    // Selesai looping kategori produk
                                                    endforeach; 
                                                // Selesai pemeriksaan kategori produk
                                                endif; 
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

              <!-- Lanjutan Form untuk Data Produk -->

<div class="form-group">
    <!-- Label dan input untuk nama produk -->
    <label class="form-control-label" for="name">Nama produk:</label>
    <input type="text" name="name" class="form-control" id="name" required>
</div>

<div class="form-group">
    <!-- Label dan input untuk harga produk -->
    <label class="form-control-label" for="price">Harga:</label>
    <!-- Input group untuk menampilkan mata uang (Rp) di depan input harga -->
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">Rp</span>
        </div>
        <input type="text" name="price" class="form-control" id="price" required>
    </div>
</div>

<div class="row">
    <div class="col-6">
        <div class="form-group">
            <!-- Label dan input untuk stok produk -->
            <label class="form-control-label" for="stock">Stok:</label>
            <input type="text" name="stock" class="form-control" id="stock" required>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <!-- Label dan input untuk satuan produk -->
            <label class="form-control-label" for="unit">Satuan:</label>
            <input type="text" name="unit" class="form-control" id="unit" required>
        </div>
    </div>
</div>

<div class="form-group">
    <!-- Label dan textarea untuk deskripsi produk -->
    <label class="form-control-label" for="desc">Deskripsi:</label>
    <textarea name="descript" class="form-control" id="descript"></textarea>
</div>
    </div> 
        </div> 
          </div>
        </div>
        <!-- Form untuk Foto Produk -->
<div class="col-md-4">
    <div class="card">
        <div class="card-header">
            <h3 class="mb-0">Foto</h3>
        </div>
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <!-- Label dan input untuk memilih foto produk -->
                    <label class="form-control-label" for="pic">Foto:</label>
                    <input type="file" name="picture" class="form-control" id="pic">
                    <small class="text-muted">Pilih foto PNG atau JPG dengan ukuran maksimal 2MB</small>
                </div>
                <div class="card-footer text-right">
                    <!-- Tombol submit untuk menambah produk baru -->
                    <input type="submit" value="Tambah Produk Baru" name="submit" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Akhir Form untuk Foto Produk -->

<?php 
    // Memproses form ketika tombol submit ditekan
    if(isset($_POST['submit'])){
        add_new_product();
    }
?>

<?php 
// Menyertakan footer pada halaman
include 'layouts/footer.php';
?>
