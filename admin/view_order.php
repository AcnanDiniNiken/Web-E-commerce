<?php
    // Include file header.php
    include 'layouts/header.php';

    // Include file view_order_function.php yang berisi fungsi-fungsi terkait tampilan pesanan
    include 'function/view_order_function.php';

    // Mendapatkan data pesanan berdasarkan ID yang diterima dari parameter URL ($_GET['id'])
    $data = get_data_order_by_id($_GET['id']);

    // Mendapatkan data item pesanan berdasarkan ID pesanan
    $items = get_data_items_order($data['id']);

    // Mendapatkan data pembayaran pesanan berdasarkan ID pesanan
    $payment = get_data_payment_by_order_id($data['id']);
?>

    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Order #<?php echo $data['order_number']; ?></h6>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="order.php">Order</a></li>
                  <li class="breadcrumb-item active" aria-current="page">#<?php echo $data['order_number']; ?></li>
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
        <div class="col-md-8">
          <div class="card-wrapper">
            <div class="card">
              <div class="card-header">
                <h3 class="mb-0">Data Produk</h3>
              </div>
        
              <div class="card-body p-0">
                <!-- Tabel untuk menampilkan informasi pesanan -->
                <table class="table align-items-center table-flush table-striped">
                    <tr>
                      <!-- Baris untuk menampilkan Nomor Pesanan dll-->
                        <td>Nomor</td>
                        <td><b>#<?php echo $data['order_number']; ?></b></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td><b><?php echo $data['order_date']; ?></b></td>
                    </tr>
                    <tr>
                        <td>Item</td>
                        <td><b><?php echo $data['total_items']; ?></b></td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td><b>Rp <?php echo number_format($data['total_price'], 0, '.', '.'); ?></b></td>
                    </tr>
                    <tr>
                        <td>Metode pembayaran</td>
                        <td><b><?php echo ($data['payment_method'] == 1) ? 'Transfer bank' : 'Bayar ditempat'; ?></b></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td><b class="statusField"><?php echo get_order_status($data['order_status'], $data['payment_method']); ?></b></td>
                    </tr>
                </table>
              </div>
              <!-- Bagian Footer dari Kartu (Card) -->
              <div class="card-footer">
                 <!-- Form untuk mengubah status pesanan -->
                <form action="" method="POST">
                  <!-- Input tersembunyi untuk menyimpan ID pesanan -->
                <input type="hidden" name="order" value="<?php echo $data['id']; ?>">
                  <div class="row">
                    <div class="col-md-10">
                      <div class="form-group">
                        <!-- Dropdown untuk memilih status pesanan -->
                        <?php if ($data['payment_method'] == 1) : ?>
                        <select class="form-control" id="status" name="status">
                          <option value="2"<?php echo ($data['order_status'] == 2) ? ' selected' : ''; ?>>Dalam proses</option>
                          <option value="3"<?php echo ($data['order_status'] == 3) ? ' selected' : ''; ?>>Dalam pengiriman</option>
                          <option value="4"<?php echo ($data['order_status'] == 4) ? ' selected' : ''; ?>>Selesai</option>
                          <option value="5"<?php echo ($data['order_status'] == 5) ? ' selected' : ''; ?>>Batalkan</option>
                        </select>
                        <?php else : ?>
                        <select class="form-control" id="status" name="status">
                          <option value="1"<?php echo ($data['order_status'] == 1) ? ' selected' : ''; ?>>Dalam proses</option>
                          <option value="2"<?php echo ($data['order_status'] == 2) ? ' selected' : ''; ?>>Dalam pengiriman</option>
                          <option value="3"<?php echo ($data['order_status'] == 3) ? ' selected' : ''; ?>>Selesai</option>
                          <option value="4"<?php echo ($data['order_status'] == 4) ? ' selected' : ''; ?>>Batalkan</option>
                        </select>
                        <?php endif; ?>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="text-right">
                        <input type="submit" value="OK" name="payment_submit" class="btn btn-md btn-primary">
                      </div>
                    </div>
                  </div>
                </form>
                <?php 
                    if(isset($_POST['payment_submit'])){
                        update_status_order($data['id'], $_POST['status']);
                    }
                ?>
              </div>
            </div>
            
            <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="mb-0">Barang dalam pesanan</h3>
                    </div>
                    <div class="card-body p-0">
                      <!-- Tabel untuk Menampilkan Barang dalam Pesanan -->
                        <table class="table align-items-center table-flush">
                          <thead class="thead-light">
                            <!-- Baris Header Tabel -->
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Produk</th>
                                <th scope="col">Jumlah beli</th>
                                <th scope="col">Harga satuan</th>
                            </tr>
                          </thead>
                          <tbody>
                            
                <!-- Loop untuk Menampilkan Setiap Barang dalam Pesanan -->
                          <?php foreach ($items as $item) : ?>
                            <tr>
                              <!-- Kolom untuk Menampilkan Gambar Produk dll-->
                                <td>
                                    <img class="img img-fluid rounded" style="width: 60px; height: 60px;" alt="<?php echo $item['name']; ?>" src="produk_gambar/<?php echo $item['picture_name']; ?>">
                                </td>
                                <td>
                                    <h5 class="mb-0"><?php echo $item['name']; ?></h5>
                                </td>
                                <!-- Kolom untuk Menampilkan Jumlah Barang yang Dibeli -->
                                <td><?php echo $item['order_qty']; ?></td>
                                <!-- Kolom untuk Menampilkan Harga Satuan Barang -->
                                <td>Rp <?php echo number_format($item['order_price'], 0, '.', '.'); ?></td>
                            </tr>
                          <?php endforeach; ?>
                          </tbody>
                        </table>
                    </div>
                </div>
            
          </div>

        </div>
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="mb-0">Data Penerima</h3>
                </div>
                <div class="card-body p-0">
                   <!-- Tabel untuk Menampilkan Data Penerima -->
                    <table class="table align-items-center table-flush table-hover">
                    <?php $customer = json_decode($data['delivery_data'], true);?>
                        <tr>
                            <td>Nama</td>
                            <td><b><?php echo $customer['customer']['name']; ?></b></td>
                        </tr>
                        <tr>
                            <td>No. HP</td>
                            <td><b><?php echo $customer['customer']['phone_number']; ?></b></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td><b><?php echo $customer['customer']['address']; ?></b></td>
                        </tr>
                        <tr>
                            <td>Catatan</td>
                            <td><b><?php echo $customer['note']; ?></b></td>
                        </tr>
                    </table>
                </div>
            </div>

                <div class="card card-primary" id="#payments">
                    <div class="card-header">
                        <h3 class="mb-0">Pembayaran</h3>
                    </div>
                    <div class="card-body <?php echo ($data['payment_method'] == 1) ? 'p-0' : ''; ?>">
                        <?php if ($payment == NULL) : ?>
                      <div class="alert alert-info m-2">Tidak ada data pembayaran.</div>
                      <?php else : ?>

                         <!-- Gambar Bukti Pembayaran -->
                        <div>
                            <img class="img img-fluid" src="../customer/bukti_pembayaran/<?php echo $payment['picture_name']; ?>">
                        </div>
                        
                        <!-- Tabel untuk Menampilkan Detail Pembayaran -->
                        <table class="table align-items-center table-flush table-hover">
                            <tr>
                              <!-- Baris-baris Informasi Pembayaran -->
                                <td>Transfer</td>
                                <td><b>Rp <?php echo number_format($payment['payment_price'], 0, '.', '.'); ?></b></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td><b><?php echo $payment['payment_date']; ?></b></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td><b>
                                  <?php if ($payment['payment_status'] == 1) : ?>
                                    <span class="badge badge-info">Menunggu konfirmasi</span>
                                  <?php elseif ($payment['payment_status'] == 2) : ?>
                                    <span class="badge badge-success">Dikonfirmasi</span>
                                  <?php elseif ($payment['payment_status'] == 3) : ?>
                                    <span class="badge badge-danger">Gagal</span>
                                  <?php endif; ?>
                                </b></td>
                            </tr>
                            <tr>
                                <td>Transfer ke</td>
                                <td><div style="white-space: initial;"><b>
                                    <?php
                                        $bank_data = json_decode($payment['payment_data']);
                                        $bank_data  = (Array) $bank_data;
                                        
                                        $transfer_to = get_bank_payment($bank_data['transfer_to']);
                                    ?>
                                    <?php echo $transfer_to['bank']; ?> a.n <?php echo $transfer_to['name']; ?> (<?php echo $transfer_to['number']; ?>)
                                </b></div></td>
                            </tr>
                            <tr>
                                <td>Transfer dari</td>
                                <td><div style="white-space: initial;">
                                <b><?php echo $bank_data['source']->bank; ?> a.n <?php echo $bank_data['source']->name; ?> (<?php echo $bank_data['source']->number; ?>)</b>
                                </div></td>
                            </tr>
                        </table>
                      <?php endif; ?>
                    </div>
                    <?php if ($payment != NULL) : ?>
                    <div class="card-footer">
                      <!-- Form untuk Konfirmasi Pembayaran -->
                        <form action="" method="POST">
                        <div class="row">
                          <!-- Input Tersembunyi untuk ID Pembayaran dan ID Pesanan -->
                          <input type="hidden" name="id" value="<?php echo $payment['payment_id']; ?>">
                          <input type="hidden" name="order" value="<?php echo $payment['order_id']; ?>">
                          <!-- Pilihan Status Pembayaran -->
                            <div class="col-md-9">
                                <select class="form-control" name="action">
                                  <?php if ($payment['payment_status'] == 1) : ?>
                                    <!-- Pilihan untuk Pembayaran Menunggu Konfirmasi -->
                                    <option value="1">Konfirmasi Pembayaran</option>
                                    <option value="2">Pembayaran Tidak Ada</option>
                                  <?php else : ?>
                                    <!-- Pembayaran Sudah Dikonfirmasi, Tidak Ada Pilihan -->
                                    <option value="4" readonly>Tidak ada pilihan</option>
                                  <?php endif; ?>
                                </select>
                            </div>
                             <!-- Tombol OK untuk Mengirim Form -->
                            <div class="col-md-3 text-right">
                                <input type="submit" name="confirm" class="btn btn-primary" value="OK">
                            </div>
                        </div>
                        </form>
                        <?php 
                          if(isset($_POST['confirm'])){
                              konfirmasi_pembayaran($_POST['order'], $_POST['id'], $_POST['action']);
                          }
                        ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php 
                 // Cek apakah terdapat data pembayaran dan status pembayaran sudah dikonfirmasi
                  if ($payment != NULL && $payment['payment_status'] == 2) :
                    // Cek apakah kwitansi belum diupload
                    if($data['kwitansi'] == NULL):
                ?>
                <!-- Kartu (Card) Upload Kwitansi -->
                <div class="card card-primary" id="#payments">
                    <div class="card-header">
                        <h3 class="mb-0">Upload Kwitansi</h3>
                    </div>
                    <div class="card-body">
                      <!-- Form Upload Kwitansi -->
                      <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row">
                          <!-- Input Tersembunyi untuk ID Pesanan -->
                          <div class="col-md-8">
                            <input type="hidden" name="id_order" value="<?php echo $_GET['id']?>">
                            <input type="file" name="kwitansi" class="form-control">
                          </div>
                           <!-- Tombol Upload -->
                          <div class="lom-md-6">
                            <button type="submit" name="upload" class="btn btn-primary">Upload</button>
                          </div>
                        </div>
                      </form>
                    </div>
                </div>
                <?php else :?>
                   <!-- Kartu (Card) Kwitansi Sudah Diupload -->
                  <div class="card card-primary" id="#payments">
                    <div class="card-header">
                        <h3 class="mb-0">Upload Kwitansi</h3>
                    </div>
                    <div class="card-body">
                      <!-- Informasi bahwa Kwitansi Sudah Diupload -->
                      <form action="" method="POST" enctype="multipart/form-data">
                      <div class="alert alert-info m-2">Kwitansi Sudah Diupload</div>
                      </form>
                    </div>
                <?php endif ;?>
                <?php 
                // Pemrosesan Upload Kwitansi
                  if(isset($_POST['upload'])){
                    $id_order = $_POST['id_order'];
                    upload_kwitansi($id_order);
                  }
                ?>
                <?php endif;?>
        </div>
      </div>

<?php
    include 'layouts/footer.php';
?>
