<?php
// Mengambil header.php dan penjualan_function.php
    include 'layouts/header.php';

    include 'function/penjualan_function.php';

    
    // Mendapatkan semua pesanan
    $allOrders = get_all_order();
    // Mendapatkan total pendapatan
    $total_income = get_total_income();

    $itemPerPage = 10;
    $offset = ($pageSekarang - 1) * $itemPerPage;
    $orders = get_limit_order($itemPerPage, $offset);
    $pagination = pagination($pageSekarang, $itemPerPage, count($allOrders));
?>
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Kelola Penjualan</h6>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item active" aria-current="page">Penjualan</li>
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
        <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="h3 font-weight-bold text-primary mb-1">Total Pendapatan</div>
                      <div class="h4 mb-0 font-weight-bold text-gray-800">Rp. <?php echo number_format($total_income['total_income'], 0, '.', '.');?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fa-solid fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Tombol Cetak Penjualan -->
        <a href="laporan_penjualan.php" class="btn btn-primary mb-3">Cetak Penjualan</a>
          <div class="card">
            <!-- Card header -->
             <!-- Tabel Kelola Penjualan -->
            <div class="card-header">
              <h3 class="mb-0">Kelola Penjualan</h3>
            </div>

            <?php if ( count($orders) > 0) : ?>
            <div class="card-body p-0">
                <div class="table-responsive">
              <!-- Tabel Pesanan -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Jumlah Item</th>
                    <th scope="col">Jumlah Harga</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($orders as $order) : ?>
    <?php 
        // Mendapatkan data user berdasarkan user_id pada pesanan
        $userData = get_user_by_id($order['user_id']);
    ?>
    <tr>
        <!-- Nomor pesanan dengan link ke halaman detail pesanan -->
        <th scope="col">
            <b><a href="view_order.php?id=<?php echo $order['id'];?>">#<?php echo $order['order_number']?></a></b>
        </th>
        <!-- Nama pelanggan -->
        <td><?php echo $userData['name']; ?></td>
        <!-- Tanggal pesanan -->
        <td><?php echo $order['order_date']; ?></td>
        <!-- Jumlah item dalam pesanan -->
        <td><?php echo $order['total_items']; ?></td>
        <!-- Jumlah harga pesanan -->
        <td>Rp <?php echo number_format($order['total_price'], 0, '.', '.'); ?></td>
    </tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>

<!-- Footer Tabel dengan Pagination -->
<div class="card-footer">
    <?php echo $pagination; ?>
</div>
<?php else : ?>
<!-- Tidak ada Pesanan -->
<div class="card-body">
    <div class="row">
        <div class="col-md-8">
            <!-- Pesan untuk memberitahu bahwa belum ada pesanan -->
            <div class="alert alert-primary">
                Belum ada data produk yang ditambahkan. Silahkan menambahkan baru.
            </div>
        </div>
        <div class="col-md-4">
            <!-- Tombol untuk menambah produk baru dan mengelola kategori -->
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
    // Include file footer.php
    include 'layouts/footer.php';
?>
