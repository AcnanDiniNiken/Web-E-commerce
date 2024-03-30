<?php

    include 'layouts/header.php';

    include 'function/lihat_keranjang_function.php';

    // Memeriksa apakah pengguna (customer) sudah masuk atau belum
    if(isset($_SESSION['customer']['id'])){
      // Jika sudah masuk, mendapatkan semua barang dalam keranjang dan total harga
      $carts = get_all_keranjang($_SESSION['customer']['id']);
      $total_price = get_total_price($_SESSION['customer']['id']);
    }else{
      // Jika belum masuk, menginisialisasi keranjang sebagai array kosong
      $carts = array();
    }
?>
<div class="hero-wrap hero-bread" style="background-image: url('images/cart.jpg');">
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Keranjang Belanja</span></p>
          <h1 class="mb-0 bread">Keranjang Belanja Saya</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-section ftco-Keranjang Belanja">
          <div class="container">
          <?php if ( count($carts) > 0 && isset($_SESSION['customer']['id'])) : ?>
            <!-- Membuat formulir metode POST  -->
            <form action="" method="POST">
              <div class="row">
              <div class="col-md-12 ftco-animate">
                  <div class="cart-list">
                  <!-- Membuat tabel dengan class table untuk menampilkan detail produk di keranjang -->
                      <table class="table">
                          <thead class="thead-primary">
                            <tr class="text-center">
                              <th>&nbsp;</th>
                              <th>&nbsp;</th>
                              <th>Produk</th>
                              <th>Harga</th>
                              <th>Kuantitas</th>
                              <th>Sub Total</th>
                            </tr>
                          </thead>
                          <tbody>
                              <?php foreach ($carts as $index => $item) : ?>
                                <!-- Mengambil data produk berdasarkan ID produk yang ada di keranjang -->
                                <?php 
                                    $produk = get_product_by_id($item['product_id']);
                                ?>
                                <!-- <input type="hidden" name="index" value="" readonly> -->
                             <tr class="text-center cart-<?php echo $produk['id']?>">
                              <!-- Membuat sel tabel untuk tombol hapus produk dari keranjang -->
                              <td class="product-remove"><a href="#" class="remove-item" data-id="<?php echo $produk['id']; ?>"><span><ion-icon name="close"></ion-icon></span></a></td>
                              
                              <!-- Membuat sel tabel untuk menampilkan gambar produk -->
                              <td class="image-prod"><div class="img img-fluid rounded" style="background-image:url(admin/produk_gambar/<?php echo $produk['picture_name']; ?>);"></div></td>
                              
                              <!-- Membuat sel tabel untuk menampilkan nama produk -->
                              <td class="product-name">
                                  <h3><?php echo $produk['name']; ?></h3>
                              </td>
                              
                              <!-- Membuat sel tabel untuk menampilkan harga produk -->
                              <td class="price">Rp <?php echo number_format($produk['price'], 0, '.', '.'); ?></td>
                              
                              <!-- Membuat sel tabel untuk menampilkan input kuantitas produk -->
                              <td class="quantity">
                                  <div class="input-group mb-3">
                                   <input type="text" name="quantity[<?php echo $index;?>]" class="quantity form-control input-number" value="<?php echo $item['qty']; ?>" min="1" max="100">
                                </div>
                            </td>
                              
                            <!-- Membuat sel tabel untuk menampilkan sub total harga produk -->
                              <td class="total">Rp <?php echo number_format($produk['price'] * $item['qty'], 0, '.', '.'); ?></td>
                            </tr><!-- END TR-->
                              <?php endforeach; ?>
                          </tbody>
                        </table>
                    </div>
              </div>
          </div>
          <div class="row justify-content-end">
             
              
              <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                  <div class="cart-total mb-3">
                      <h3>Rincian Keranjang</h3>
                      <hr>
                      <p class="d-flex total-price">
                          <span>Total</span>
                          <!-- Menampilkan total harga dengan format mata uang rupiah dan menyimpan nilai dalam input tersembunyi -->
                          <span class="n-total font-weight-bold">Rp <?php echo number_format($total_price, 0, '.', '.'); ?></span>
                          <input type="hidden" name="total_price" value="<?php echo $total_price ?>">
                          <!-- Menyimpan data keranjang dalam bentuk JSON dalam input tersembunyi -->
                          <input type="hidden" name="carts" value='<?php echo json_encode($carts) ?>'>
                      </p>
                  </div>
                  <!-- button checkout -->
                  <p><button type="submit" name="checkout" class="btn btn-primary py-3 px-4">Checkout</button></p>
              </div>
          </div>
          </form>
          <?php
            if(isset($_POST['checkout'])){
              // Memanggil fungsi checkout_save jika tombol checkout ditekan
              checkout_save($carts);
            }
          ?>
          <?php else : ?>
            <div class="row">
              <div class="col-md-12 ftco-animate">
                  <!-- Menampilkan pesan informasi jika tidak ada barang dalam keranjang -->
                <div class="alert alert-info">Tidak ada barang dalam keranjang.<br><a href="index.php">Jelajahi produk kami</a> dan mulailah berbelanja!</div>
              </div>
            </div>
          <?php endif; ?>
          </div>
      </section>

<script>
  // Menggunakan jQuery untuk menangani penghapusan item dari keranjang
  $('.remove-item').click(function(e) {
    e.preventDefault();

    var id = $(this).data('id');
    var tr = $('.cart-'+ id);

    // Mengubah teks nama produk dengan ikon spinner
    $('.product-name', tr).html('<i class="fa fa-spin fa-spinner"></i> Menghapus...');

    // Mengirimkan permintaan AJAX untuk menghapus item dari keranjang
    $.ajax({
      method: 'POST',
      url: 'function/cart_function.php',
      data: { 
        id: id,
        action:'remove_item' 
        },
      success: function (res) {
        if (res.code == 204) {
          // Menambahkan kelas alert dan alert-danger untuk memberi efek warna merah saat item dihapus
          tr.addClass('alert alert-danger');
          
          // Mengatur timeout untuk menyembunyikan baris item setelah 2 detik
          setTimeout(function(e) {
            tr.hide('fade');

            // Mengubah total harga setelah item dihapus
            $('.n-total').text(res.total);
          }, 2000);
        }
      }
    })
  })
</script>

<?php 
    include 'layouts/footer.php';
?>