<?php
    include 'layouts/header.php'; // Memasukkan file berisi struktur HTML dan elemen-elemen umum.

    include 'function/checkout_function.php';
    // Mengambil data pelanggan berdasarkan data database
    $user = get_data_customer($_SESSION['customer']['id']);
    $total_price = get_total_price($_SESSION['customer']['id']);
    $carts = get_all_keranjang($_SESSION['customer']['id']);
?>
<div class="hero-wrap hero-bread" style="background-image: url('images/slide3.jfif');">
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Checkout</span></p>
          <h1 class="mb-0 bread">Checkout</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-section">
    <div class="container">
        <!-- Formulir checkout dengan metode POST -->
    <form action="" method="POST">

      <div class="row justify-content-center">
        <div class="col-xl-7 ftco-animate">
                <h3 class="mb-4 billing-heading">Alamat Pengiriman</h3>
                  <!-- Input terkait keranjang belanja yang disimpan dalam input tersembunyi -->
                <input type="hidden" name="keranjang" value='<?php echo $carts;?>'>

                 <!-- Formulir untuk alamat pengiriman -->
                <div class="form-group">
                    <label for="name" class="form-control-label">Pengiriman untuk (nama):</label>
                      <!-- Input untuk nama, nilai default diambil dari data pengguna-->
                    <input type="text" name="name" value="<?php echo $user['name']; ?>" class="form-control" id="name" required>
                </div>

                <div class="form-group">
                    <label for="hp" class="form-control-label">No. HP:</label>
                     <!-- Input untuk nomor HP, nilai default diambil dari data pengguna  -->
                    <input type="text" name="phone_number" value="<?php echo $user['no_hp']; ?>" class="form-control" id="hp" required>
                </div>

                <div class="form-group">
                    <label for="address" class="form-control-label">Alamat:</label>
                    <!-- memasukkan teks lebih dari satu baris. req dengan wajib isi  -->
                    <textarea name="address" class="form-control" id="address" required><?php echo $user['alamat']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="note" class="form-control-label">Catatan:</label>
                    <!-- Elemen textarea untuk memasukkan catatan. -->
                    <textarea name="note" class="form-control" id="note"></textarea>
                </div>

        </div>
        <!-- // Membuat kolom d baris di dalam grid sistem responsif Bootstrap -->
        <div class="col-xl-5"> 
            <div class="row mt-5 pt-3">
                <div class="col-md-12 d-flex mb-5">
                    <div class="cart-detail cart-total p-3 p-md-4">
                        <h3 class="billing-heading mb-4">Rincian Belanja</h3>
                        <!-- total harga belanja dengan menggunakan class d-flex untuk pengaturan fleksibel. -->
                              <p class="d-flex total-price">
                                  <span>Total</span>
                                  <!-- Menampilkan total harga belanja dalam format mata uang Rupiah dengan menggunakan fungsi number_format PHP. -->
                                  <span>Rp <?php echo number_format($total_price,0,'.','.'); ?></span>
                                  <input type="hidden" name="total_price" value="<?php echo $total_price?>">
                              </p>
                              </div>
                </div>
                <!-- // Membuat kolom d baris di dalam grid sistem responsif Bootstrap -->
                <div class="col-md-12">
                    <div class="cart-detail p-3 p-md-4">
                        <h3 class="billing-heading mb-4">Metode Pembayaran</h3>
                                  <div class="form-group">
                                      <div class="col-md-12">
                                          <div class="radio">
                                          <!-- Opsi radio untuk metode pembayaran transfer bank -->
                                             <label><input type="radio" name="payment" class="mr-2" value="1"> Transfer bank</label>
                                          </div>
                                      </div>
                                  </div>
                                  
                              </div>

                              <div class="form-group text-right" style="margin-top: 10px;">
                              <!-- Elemen input submit digunakan untuk mengirimkan formulir.  -->
                <input type="submit" name="checkout" class="btn btn-primary py-2 px-2" value="Buat Pesanan">
            </div>
                </div>

                
            </div>
        </div> <!-- .col-md-8 -->
      </div>

    </form>
    <?php 
        // kondisi PHP yang memeriksa apakah variabel POST dengan nama "checkout" telah diatur atau tidak. 
        if(isset($_POST['checkout'])){
            // Jika formulir checkout telah dikirim, fungsi checkout_order dipanggil dengan mengirimkan ID
            checkout_order($_SESSION['customer']['id']);
        }
    ?>
    </div>
  </section> <!-- .section -->

  <?php
    include 'layouts/footer.php';
?>