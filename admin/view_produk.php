<?php
    // Memasukkan file header.php ke dalam halaman
    include 'layouts/header.php';

    // Memasukkan file produk_function.php yang berisi fungsi-fungsi terkait produk
    include 'function/produk_function.php';

    // Mengambil data produk berdasarkan ID yang diterima dari parameter URL
    $product = get_product_by_id($_GET['id']);

    // Mengambil data kategori produk berdasarkan ID kategori pada produk tersebut
    $kategori = category_data($product['category_id']);

    // Mengambil semua data pesanan yang terkait dengan produk
    $orders = get_all_order_produk($product['id']);
?>
<!-- Bagian Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <!-- Menampilkan judul halaman dengan nama produk -->
                    <h6 class="h2 text-white d-inline-block mb-0"><?php echo $product['name']; ?></h6>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <!-- Menampilkan breadcrumb navigasi -->
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="admin.php"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="produk.php">Produk</a></li>
                            <!-- Menampilkan breadcrumb aktif dengan nama produk -->
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $product['name']; ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Bagian Konten Halaman -->
<div class="container-fluid mt--6">
    <div class="row">
        <!-- Kolom lebar medium (md) 4 -->
        <div class="col-md-4">
            <div class="card-wrapper">
                <div class="card">
                    <!-- Bagian Header Kartu -->
                    <div class="card-header">
                        <!-- Judul Kartu -->
                        <h3 class="mb-0">Data Produk</h3>
                    </div>
                    <!-- Bagian Tubuh Kartu -->
                    <div class="card-body p-0">
                        <!-- Menampilkan gambar produk dengan nama dan sumber gambar yang diperoleh dari data produk -->
                        <div>
                            <img alt="<?php echo $product['name']; ?>" class="img img-fluid rounded" src="<?php echo 'produk_gambar/'. $product['picture_name']; ?>">
                        </div>
                        <!-- Tabel Informasi Produk -->
                        <table class="table table-hover table-striped">
                            <!-- Baris 1: Nama Produk -->
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <!-- Menampilkan nama produk -->
                                <td><b><?php echo $product['name']; ?></b></td>
                            </tr>
                            <!-- Baris 2: SKU Produk -->
                            <tr>
                                <td>SKU</td>
                                <td>:</td>
                                <!-- Menampilkan SKU produk -->
                                <td><b><?php echo $product['sku']; ?></b></td>
                            </tr>
                            <!-- Baris 3: Harga Produk -->
                            <tr>
                                <td>Harga</td>
                                <td>:</td>
                                <!-- Menampilkan harga produk dengan format mata uang -->
                                <td><b>Rp <?php echo number_format($product['price'], 0, '.', '.'); ?></b></td>
                            </tr>
                            <!-- Baris 4: Diskon Produk -->
                            <tr>
                                <td>Diskon</td>
                                <td>:</td>
                                <!-- Menampilkan diskon produk beserta persentasenya -->
                                <td><b>Rp <?php echo number_format($product['current_discount']); ?> (<?php echo count_percent_discount($product['current_discount'], $product['price'], 2); ?> %)</b></td>
                            </tr>
                            <!-- Baris 5: Kategori Produk -->
                            <tr>
                                <td>Kategori</td>
                                <td>:</td>
                                <!-- Menampilkan nama kategori produk dengan tautan ke halaman kategori -->
                                <td><b><a href=<?php echo "kategori.php?id=" . $kategori['id']?>><?php echo $kategori['nama']?></a></b></td>
                            </tr>
                            <!-- Baris 6: Stok Produk -->
                            <tr>
                                <td>Stok / Satuan</td>
                                <td>:</td>
                                <!-- Menampilkan stok dan satuan produk, atau pesan 'Stok habis' jika stok nol -->
                                <td><b><?php echo ($product['stock'] > 0) ? $product['stock'] .' '. $product['product_unit'] : 'Stok habis'; ?></b></td>
                            </tr>
                            <!-- Baris 7: Deskripsi Produk -->
                            <tr>
                                <td>Deskripsi</td>
                                <td>:</td>
						    <td><b>
                  <!-- Bagian Informasi Produk -->
                  <?php echo $product['descript']; ?></b></td>
                    </tr>
                    <tr>
                        <td>Tersedia</td>
                        <td>:</td>
                        <td>
                          <?php echo ($product['is_available'] == 1) ? '<b class="text-success">Tersedia</b>' : '<b class="text-danger">Tidak</b>'; ?>
                        </td>
                    </tr>
                </table>
              </div>
              <!-- Bagian Footer Kartu Informasi Produk -->
              <div class="card-footer text-right">
                <!-- Tautan untuk Mengedit Produk -->
                  <a href="edit_produk.php?id=<?php echo $product['id'];?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                   <!-- Tautan untuk Menghapus Produk (membuka modal konfirmasi) -->
                  <a href="#" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger"><i class="fa fa-trash"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-8">
            <div class="card card-primary">
              <div class="card-header">
                 <!-- Bagian Header Kartu Order -->
<h3 class="mb-0">Order</h3>
</div>

<!-- Bagian Isi Kartu Order -->
<div class="card-body p-0">
    <div class="table-responsive">
        <!-- Tabel Proyek -->
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <!-- Baris Header Tabel -->
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Order</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Total Harga</th>
                </tr>
            </thead>
            <tbody>
                <!-- Looping untuk Menampilkan Data Order -->
                <?php foreach ($orders as $order) : ?>
                    <?php
                        // Mendapatkan data order, produk, dan pengguna terkait
                        $orderData = get_order_by_id($order['order_id']);
                        $product = get_product_by_id($order['product_id']);
                        $userData = get_user_by_id($orderData['user_id']);
                    ?>
                    <!-- Baris Data Tabel -->
                    <tr>
                        <th scope="col">
                            <?php echo $order['id']; ?>
                        </th>
                        <td><b><a href="order.php?id=<?php echo $orderData['id'];?>">#<?php echo $orderData['order_number']?></a></b></td>
                        <td>
                            <?php echo $userData['name']; ?>
                        </td>
                        <td><?php echo $order['order_qty']; ?></td>
                        <td>Rp <?php echo number_format($orderData['total_price'], 0, '.', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
            </div>
              </div>
            </div>
        </div>
      </div>

      <!-- Modal Hapus Produk -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- Judul Modal -->
                <h6 class="modal-title" id="modal-title-default">Hapus Produk</h6>
                <!-- Tombol Close Modal -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!-- Form untuk Pengiriman Data Hapus -->
            <form action="#" id="deleteProductForm" method="POST">
                <!-- Input ID Produk yang Akan Dihapus -->
                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                <div class="modal-body">
                    <!-- Pesan Konfirmasi Hapus -->
                    <p class="deleteText">Yakin ingin menghapus produk ini? Semua data yang terkait seperti data order juga akan dihapus. Tindakan ini tidak dapat dibatalkan.</p>
                </div>
          <!-- Bagian Footer Modal -->
<div class="modal-footer">
    <!-- Tombol Hapus -->
    <button type="submit" class="btn btn-danger btn-delete">Hapus</button>
    <!-- Tombol Batal (Tutup Modal) -->
    <button type="button" class="btn btn-link ml-auto" data-dismiss="modal">Batal</button>
</div>
</form> <!-- Penutup Form -->

<!-- Script JavaScript -->
<script>
    // Ketika Form Delete di-Submit
    $('#deleteProductForm').submit(function(e) {
        e.preventDefault(); // Mencegah aksi default form (pengiriman ke halaman lain)

        // Variabel btn untuk tombol hapus
        var btn = $('.btn-delete');
        // Mengambil data formulir
        var data = $(this).serialize();

        // Mengubah tampilan tombol hapus dan menonaktifkannya
        btn.html('<i class="fa fa-spin fa-spinner"></i> Menghapus...').attr('disabled', true);

        // Mengirim permintaan Ajax ke server
        $.ajax({
            method: 'POST',
            url: 'function/produk_delete.php',
            data: data + "&action=delete_product",
            success: function (res) {
                console.log(res);
                // Jika kode respon adalah 204 (berhasil)
                if (res.code == 204) {
                    // Menampilkan pesan sukses dan mengubah tampilan tombol
                    setTimeout(function() {
                        btn.html('<i class="fa fa-check"></i> Terhapus!');
                        $('.deleteText').fadeOut(function() {
                            $(this).text('Produk berhasil dihapus')
                        }).fadeIn();
                    }, 2000);

                    // Menampilkan pesan "Mengalihkan..."
                    setTimeout(function() {
                        $('.deleteText').fadeOut(function() {
                            $(this).text('Mengalihkan...')
                        }).fadeIn();
                    }, 4000);

                    // Mengalihkan halaman ke 'produk.php' setelah beberapa detik
                    setTimeout(function() {
                        window.location = 'produk.php';
                    }, 6000);
                }
                else {
                    console.log('Terjadi kesalahan saat menghapus produk');
                }
            }
        })
    })
</script>
<?php
    include 'layouts/footer.php';
?>