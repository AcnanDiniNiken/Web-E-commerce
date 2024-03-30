<?php 
    // Memasukkan file header.php yang berisi bagian awal dari halaman
    include 'layouts/header.php';

    // Memasukkan file produk_function.php yang berisi fungsi terkait produk
    include 'function/produk_function.php';

    // Mengambil seluruh produk dari database
    $allProducts = get_all_product();

    // Menentukan jumlah item yang ditampilkan per halaman
    $itemPerPage = 8;

    // Menghitung offset (mulai dari item keberapa data akan ditampilkan)
    $offset = ($pageSekarang - 1) * $itemPerPage;

    // Mengambil produk terbatas sesuai dengan item per halaman dan offset
    $products = get_limit_product($itemPerPage, $offset);

    // Membuat navigasi halaman (pagination) berdasarkan jumlah produk dan item per halaman
    $pagination = pagination($pageSekarang, $itemPerPage, count($allProducts));
?>

<!-- Bagian header dari halaman -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <!-- Judul halaman -->
                    <h6 class="h2 text-white d-inline-block mb-0">Kelola Produk</h6>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <!-- Tombol tambah produk dengan tautan ke halaman tambah_produk.php -->
                    <a href="tambah_produk.php" class="btn btn-sm btn-neutral">Tambah</a>
                </div>
            </div>
        </div>
    </div>
</div>
 <!-- Bagian konten halaman -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Bagian header dari card -->
                <div class="card-header">
                    <!-- Judul card -->
                    <h3 class="mb-0">Kelola Produk</h3>
                </div>

                <?php if ( count($products) > 0) : ?>
                <!-- Bagian body dari card -->
                <div class="card-body">
                    <!-- Baris (row) untuk menampilkan produk dalam bentuk kartu-kartu kecil -->
                    <div class="row">
                        <?php foreach ($products as $product) : ?>
                            <!-- Kolom (col-md-3) untuk setiap produk, dengan batasan 4 produk per baris -->
                            <div class="col-md-3">
                                <!-- Kartu (card) untuk menampilkan informasi produk -->
                                <div class="card card-primary">
                                    <!-- Bagian header dari kartu -->
                                    <div class="card-header">
                                        <!-- Judul atau nama produk -->
                                        <h3 class="card-heading"><?php echo $product['name']; ?></h3>
                                    </div>
                                    <!-- Bagian body dari kartu -->
                                    <div class="card-body">
                                        <div class="text-center">
                                            <!-- Gambar produk -->
                                            <div class="image-fix">
                                                <img class="img-fluid" src="produk_gambar/<?php echo $product['picture_name']?>" alt="<?php echo $product['name']; ?>">
                                            </div>
                                            <br>
                                            <br>
                                            <!-- Informasi stok dan harga produk -->
                                            <?php echo ($product['stock'] > 0) ? $product['stock'] .' '. $product['product_unit']: '<span class="text-danger"><em>Stok habis</em></span>'; ?> / Rp. <?php echo number_format($product['price'], 0, '.', '.'); ?>
                                        </div>
                                    </div>
                                    <!-- Bagian footer dari kartu -->
                                    <div class="card-footer text-center">
                                        <!-- Tombol untuk melihat detail produk dan mengedit produk -->
                                        <a href="view_produk.php?id=<?php echo $product['id'] ?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                        <a href="edit_produk.php?id=<?php echo $product['id'] ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                </div>
            </div>
            <!-- Bagian footer dari card, menampilkan pagination -->
<div class="card-footer">
    <?php echo $pagination; ?>
</div>

<?php else : ?>
<!-- Bagian body dari card jika tidak ada produk yang ditampilkan -->
<div class="card-body">
    <!-- Baris (row) untuk menampilkan pesan bahwa belum ada data produk -->
    <div class="row">
        <div class="col-md-8">
            <!-- Kotak peringatan (alert) dengan warna primary -->
            <div class="alert alert-primary">
                Belum ada data produk yang ditambahkan. Silahkan menambahkan baru.
            </div>
        </div>
        <div class="col-md-4">
            <!-- Tombol untuk menambah produk baru dan mengelola kategori -->
            <a href="add_new_product.php"><i class="fa fa-plus"></i> Tambah produk baru</a>
            <br>
            <a href="kategori.php"><i class="fa fa-list"></i> Kelola kategori</a>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Penutup dari card -->
</div>
</div>
</div>

<?php 
    // Termasuk file footer.php untuk menutup halaman
    include 'layouts/footer.php';
?>
