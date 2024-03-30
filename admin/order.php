<?php
// menyertakan file
    include 'layouts/header.php';

    include 'function/order_function.php';

    // Dapatkan semua order dari database
    $allOrders = get_all_order();

    // Tentukan jumlah item yang akan ditampilkan per halaman
    $itemPerPage = 10;
     // Hitung offset (mulai dari mana data ditampilkan) berdasarkan halaman saat ini
    $offset = ($pageSekarang - 1) * $itemPerPage;
    // Dapatkan sejumlah order terbatas berdasarkan paginasi
    $orders = get_limit_order($itemPerPage, $offset);
      // Hitung informasi paginasi, seperti halaman saat ini, jumlah item per halaman, dan total jumlah item
    $pagination = pagination($pageSekarang, $itemPerPage, count($allOrders));
?>
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
             <!-- Kolom Untuk Judul Halaman -->
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Kelola Order Customer</h6>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                   <!-- Navigasi ke Halaman Dashboard -->
                  <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item active" aria-current="page">Order</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
              <h3 class="mb-0">Kelola Order</h3>
            </div>

            <!-- Cek Jumlah Order -->
            <?php if ( count($orders) > 0) : ?>
            <div class="card-body p-0">
                <div class="table-responsive">
              <!-- Tabel untuk Menampilkan Data Order -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <!-- Kolom Header Tabel -->
                    <th scope="col">ID</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Jumlah Item</th>
                    <th scope="col">Jumlah Harga</th>
                    <th scope="col">Status</th>
                    <th scope="col">Kwitansi</th>
                  </tr>
                </thead>
                <tbody>
                <!-- Melakukan iterasi (perulangan) untuk setiap order dalam array $orders -->
                <?php foreach ($orders as $order) : ?>
                  <!-- Mendapatkan data user berdasarkan ID user pada order saat ini. -->
                  <?php $userData = get_user_by_id($order['user_id']);?>
                    <tr>
                    <th scope="col">
                       <!-- Membuat tautan ke halaman view_order.php dengan parameter id -->
                    <b><a href="view_order.php?id=<?php echo $order['id'];?>">#<?php echo $order['order_number']?></a></b>
                    </th>
                    <td><?php echo $userData['name']; ?></td>
                    <td>
                      <?php echo $order['order_date']; ?>
                    </td>
                    <td>
                      <?php echo $order['total_items']; ?>
                    </td>
                    <td>
                      <!-- Menampilkan total harga dengan format mata uang -->
                      Rp <?php echo number_format($order['total_price'],0,'.','.'); ?>
                    </td>
                     <!-- Menampilkan status order dan metode pembayaran -->
                    <td><?php echo get_order_status($order['order_status'], $order['payment_method']); ?></td>
                    <!-- Menampilkan tombol berwarna merah jika kwitansi belum ada dan tombol berwarna hijau jika kwitansi sudah ada. Tombolnya dinonaktifkan dengan atribut disabled. -->
                    <td><?php if($order['kwitansi'] == NULL) :?>
                      <!-- Tombol nonaktif jika kwitansi belum ada -->
                      <button class="btn btn-danger" disabled>Belum</button>
                    <?php else :?>
                       <!-- Tombol nonaktif jika kwitansi sudah ada -->
                      <button class="btn btn-success" disabled>Sudah</button>
                      <!-- Menutup struktur pengulangan dan kondisional sebelumnya. -->
                    <?php endif; ?></td> 
                  </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
            </div>
                </div>
            
            <div class="card-footer">
                <?php echo $pagination; ?>
            </div>
            <?php else : ?>
              <!-- Tampilan jika tidak ada data order -->
             <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                       <!-- Alert informasi bahwa belum ada data order -->
                        <div class="alert alert-primary">
                            Belum ada data produk yang ditambahkan. Silahkan menambahkan baru.
                        </div>
                    </div>
                    <div class="col-md-4">
                      <!-- Tombol untuk tambah produk baru dan kelola kategori -->
                        <a href="tambah_produk.php"><i class="fa fa-plus"></i> Tambah produk baru</a>
                        <br>
                        <a href="kategori.php"><i class="fa fa-list"></i> Kelola kategori</a>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
          </div>
        </div>
      </div>

      <?php
    include 'layouts/footer.php';
?>