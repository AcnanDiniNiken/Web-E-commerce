<?php
    // Sertakan file header.php
    include 'layouts/header.php';

    // Sertakan file view_pembayaran_function.php yang berisi fungsi-fungsi terkait pembayaran
    include 'function/view_pembayaran_function.php';

    // Dapatkan data pembayaran berdasarkan ID yang diterima dari parameter GET
    $payment = get_data_pembayaran($_GET['id']);

    // Decode data pembayaran dari format JSON ke array
    $data_payment = json_decode($payment['payment_data']);
?>
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <!-- Tampilkan judul header pembayaran dengan nomor order -->
                    <h6 class="h2 text-white d-inline-block mb-0">Pembayaran Order #<?php echo $payment['order_number']; ?></h6>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <!-- Tampilkan breadcrumb navigation -->
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="pembayaran.php">Pembayaran</a></li>
                            <!-- Tampilkan breadcrumb aktif dengan nomor order -->
                            <li class="breadcrumb-item active" aria-current="page">#<?php echo $payment['order_number']; ?></li>
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
                        <h3 class="mb-0">Pembayaran #<?php echo $payment['order_number']; ?></h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table align-items-center table-flush table-hover">
                            <!-- Informasi Transfer -->
                            <tr>
                                <td>Transfer</td>
                                <td><b>Rp <?php echo number_format($payment['payment_price'], 0, '.', '.'); ?></b></td>
                            </tr>
                            <!-- Informasi Tanggal Pembayaran -->
                            <tr>
                                <td>Tanggal</td>
                                <td><b><?php echo $payment['payment_date']; ?></b></td>
                            </tr>
                          <tr>
                        <td>Status</td>
                       <!-- Pengkondisian Status Pembayaran -->
                      <td><b>
                          <?php if ($payment['payment_status'] == 1) : ?>
                              <!-- Menampilkan badge info jika status pembayaran menunggu konfirmasi -->
                              <span class="badge badge-info">Menunggu konfirmasi</span>
                          <?php elseif ($payment['payment_status'] == 2) : ?>
                              <!-- Menampilkan badge success jika status pembayaran sudah dikonfirmasi -->
                              <span class="badge badge-success">Dikonfirmasi</span>
                          <?php elseif ($payment['payment_status'] == 3) : ?>
                              <!-- Menampilkan badge danger jika status pembayaran gagal -->
                              <span class="badge badge-danger">Gagal</span>
                          <?php endif; ?>
                      </b></td>
                    </tr>
                    <tr>
                       <!-- Menampilkan Informasi Transfer Pembayaran -->
                    <tr>
                        <td>Transfer ke</td>
                        <td>
                            <div style="white-space: initial;">
                                <b>
                                    <?php
                                        // Mendekode data pembayaran yang berisi informasi rekening tujuan
                                        $bank_data = json_decode($payment['payment_data']);
                                        // Mengonversi objek menjadi array
                                        $bank_data  = (Array) $bank_data;

                                        // Mendapatkan informasi rekening tujuan menggunakan fungsi get_bank_payment
                                        $transfer_to = get_bank_payment($bank_data['transfer_to']);
                                    ?>
                                    <!-- Menampilkan informasi rekening tujuan transfer -->
                                    <?php echo $transfer_to['bank']; ?> a.n <?php echo $transfer_to['name']; ?> (<?php echo $transfer_to['number']; ?>)
                                </b>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Transfer dari</td>
                        <td>
                            <div style="white-space: initial;">
                                <b>
                                    <!-- Menampilkan informasi rekening asal transfer -->
                                    <?php echo $bank_data['source']->bank; ?> a.n <?php echo $bank_data['source']->name; ?> (<?php echo $bank_data['source']->number; ?>)
                                </b>
                            </div>
                        </td>
                    </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- Menampilkan Bukti Pembayaran -->
<div class="col-md-4">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="mb-0">Bukti Pembayaran</h3>
        </div>
        <div class="card-body p-0">
            <!-- Menampilkan gambar bukti pembayaran -->
            <img alt="Pembayaran Order #<?php echo $payment['order_number']; ?>" class="img img-fluid" src="../customer/bukti_pembayaran/<?php echo $payment['picture_name']; ?>">
        </div>
        <div class="card-footer">
            <form action="" method="POST">
                <!-- Menambahkan input hidden untuk redirect -->
                <input type="hidden" name="redir" value="1">

                <div class="row">
                    <!-- Menambahkan input hidden untuk menyimpan informasi pembayaran -->
                    <input type="hidden" name="id" value="<?php echo $payment['id']; ?>">
                    <input type="hidden" name="order" value="<?php echo $payment['order_id']; ?>">

                    <div class="col-md-9">
                        <!-- Menampilkan dropdown untuk memilih aksi sesuai status pembayaran -->
                        <select class="form-control" name="action">
                            <?php if ($payment['payment_status'] == 1) : ?>
                                <option value="1">Konfirmasi Pembayaran</option>
                                <option value="2">Pembayaran Tidak Ada</option>
                            <?php else : ?>
                                <!-- Jika status bukan 1 (Menunggu konfirmasi), dropdown tidak dapat diubah -->
                                <option value="4" readonly>Tidak ada pilihan</option>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="col-md-3 text-right">
                        <!-- Menambahkan tombol OK untuk melakukan validasi pembayaran -->
                        <input type="submit" name="validasi_pembayaran" class="btn btn-primary" value="OK">
                    </div>
                </div>
            </form>
            <?php 
                // Menangani validasi pembayaran jika tombol OK ditekan
                if(isset($_POST['validasi_pembayaran'])){
                    validasi_pembayaran($payment['order_id'], $payment['payment_id'], $_POST['action']);
                }
            ?>
        </div>
    </div>
</div>
<?php
    include 'layouts/footer.php';
?>