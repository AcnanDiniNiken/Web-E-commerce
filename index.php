<?php
    // Menyertakan file header.php untuk bagian kepala halaman
    include 'layouts/header.php';

    // Menyertakan file home_function.php yang berisi fungsi-fungsi terkait halaman utama
    include 'function/home_function.php';

    // Memanggil fungsi get_data_store() untuk mendapatkan data toko
    $data = get_data_store();

    // Memanggil fungsi get_all_product() untuk mendapatkan semua produk
    $products = get_all_product();

    // Memanggil fungsi get_produk_terbaru() untuk mendapatkan produk terbaru
    $newProduct = get_produk_terbaru();

    // Memanggil fungsi get_all_review() untuk mendapatkan semua ulasan
    $reviews = get_all_review();
?>

<!-- Bagian awal dari section dengan ID 'home-section' dan kelas 'hero' -->
<section id="home-section" class="hero">
    <!-- Owl Carousel untuk slider di halaman utama -->
    <div class="home-slider owl-carousel">
        <!-- Item pertama dalam slider -->
        <div class="slider-item" style="background-image: url('images/slide1.jpg');">
            <!-- Overlay untuk efek transparansi pada gambar latar -->
            <div class="overlay"></div>
            <div class="container">
                <!-- Baris dan kolom dengan kelas 'slider-text' untuk teks di dalam slider -->
                <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">
                    <!-- Kolom dengan lebar 12 yang di-animate dan berada di tengah -->
                    <div class="col-md-12 ftco-animate text-center">
                        <!-- Judul besar dari data toko -->
                        <h1 class="mb-2"><?php echo $data[1]['content']?></h1>
                        <!-- Subjudul dari data toko -->
                        <h2 class="subheading mb-4"><?php echo $data[4]['content']?></h2>
                        <!-- Tombol untuk mengarahkan ke bagian produk -->
                        <p><a href="#products" class="btn btn-danger">Beli Sekarang</a></p>
                    </div>
                </div>
            </div>
        </div>
    <!-- Bagian kedua dari slider dengan gambar latar slide2.jpg -->
<div class="slider-item" style="background-image: url('images/slide2.jpg');">
    <!-- Overlay untuk efek transparansi pada gambar latar -->
    <div class="overlay"></div>
    <div class="container">
        <!-- Baris dan kolom dengan kelas 'slider-text' untuk teks di dalam slider -->
        <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">
            <!-- Kolom dengan lebar 12 yang di-animate dan berada di tengah -->
            <div class="col-sm-12 ftco-animate text-center">
                <!-- Judul besar dari data toko -->
                <h1 class="mb-2"><?php echo $data[1]['content']?></h1>
                <!-- Subjudul dari data toko -->
                <h2 class="subheading mb-4"><?php echo $data[4]['content']?> </h2>
                <!-- Tombol untuk mengarahkan ke bagian produk -->
                <p><a href="#products" class="btn btn-danger">Belanja Sekarang</a></p>
            </div>
        </div>
    </div>
</div>
<!-- Penutup dari bagian slider -->
</section>

<!-- Bagian ketiga dari halaman dengan ID 'products' -->
<section class="ftco-section" id="products">
    <div class="container">
        <div class="row no-gutters ftco-services">
            <!-- Layanan pertama: Gratis Ongkir -->
            <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-shipped"></span>
                    </div>
                    <!-- Tubuh media dengan judul "Gratis Ongkir" dan syaratnya -->
                    <div class="media-body">
                        <h3 class="heading">Gratis Ongkir</h3>
                        <span>Belanja minimal Rp 500.000.000</span>
                    </div>
                </div>
            </div>
            <!-- Layanan kedua: Kualitas No 1 -->
            <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-award"></span>
                    </div>
                    <!-- Tubuh media dengan judul "Kualitas No 1" dan penjelasan kualitas -->
                    <div class="media-body">
                        <h3 class="heading">Kualitas No 1</h3>
                        <span>Kualitas Terjamin</span>
                    </div>
                </div>
            </div>
            <!-- Layanan ketiga: Produk Terbaru -->
            <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-award"></span>
                    </div>
                    <!-- Tubuh media dengan judul "Produk Terbaru" dan penjelasan produk terbaru -->
                    <div class="media-body">
                        <h3 class="heading">Produk Terbaru</h3>
                        <span>Selalu terdapat tanaman keluaran terbaru </span>
                        <!-- Script untuk widget chat menggunakan Crisp -->
                        <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="eaa79761-ff7b-4293-8df7-9d66f7b4bfda";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
                    </div>
                </div>
            </div>
            <!-- Layanan keempat: Bantuan -->
            <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-customer-service"></span>
                    </div>
                    <!-- Tubuh media dengan judul "Bantuan" dan informasi tentang bantuan online -->
                    <div class="media-body">
                        <h3 class="heading">Bantuan</h3>
                        <span>Bantuan Selalu Online</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

 <!-- Bagian Produk Terbaru -->
<section class="ftco-section">
    <!-- Container untuk mengelompokkan konten -->
    <div class="container">
        <!-- Baris dan judul produk terbaru -->
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Produk Terbaru</span>
                <h2 class="mb-4"><a href="#">Aneka Tanaman Alam</a></h2>
                <p><a href="#">Berkualitas Dan Bergaransi</a></p>
            </div>
        </div>
    </div>
    <!-- Container untuk menampilkan produk terbaru -->
    <div class="container">
        <div class="row">
            <?php if (count($products) > 0) : ?>
                <?php foreach ($products as $product) : ?>
                    <!-- Produk dalam format kolom -->
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        <div class="product">
                            <!-- Tautan ke halaman detail produk dengan gambar produk -->
                            <a href="produk_detail.php?id=<?php echo $product['id']?>&sku=<?php echo $product['sku']?>" class="img-prod">
                                <div class="justify-content">
                                    <div class="image-fix">
                                        <img class="img-fluid" src="admin/produk_gambar/<?php echo $product['picture_name']?>" alt="<?php echo $product['name']; ?>">
                                    </div>
                                </div>
                            </a>
                            <!-- Informasi produk -->
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><a href="produk_detail.php?id=<?php echo $product['id']?>&sku=<?php echo $product['sku']?>"><?php echo $product['name']; ?></a></h3>
                                <div class="d-flex">
                                    <!-- Harga produk -->
                                    <div class="pricing">
                                        <p class="price">
                                            <span class="mr-2"><span class="price-sale">Rp <?php echo number_format($product['price'],0,'.','.'); ?></span>
                                        </p>
                                    </div>
                                </div>
                                <!-- Tombol untuk melihat detail dan menambahkan ke keranjang -->
                                <div class="bottom-area d-flex px-3">
                                    <div class="m-auto d-flex">
                                        <a href="produk_detail.php?id=<?php echo $product['id']?>&sku=<?php echo $product['sku']?>" class="buy-now d-flex justify-content-center align-items-center text-center">
                                            <span><ion-icon name="menu"></ion-icon></span>
                                        </a>
                                        <a href="#" class="add-to-chart add-cart d-flex justify-content-center align-items-center mx-1" data-id="<?php echo $product['id']; ?>">
                                            <span><ion-icon name="cart"></ion-icon></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Bagian Produk Paling Baru -->
<section class="ftco-section img" style="background-image: url('images/bg6.jpg');">
    <!-- Container untuk mengelompokkan konten -->
    <div class="container">
        <!-- Baris dan judul produk paling baru -->
        <div class="row justify-content-end">
            <div class="col-md-6 heading-section ftco-animate deal-of-the-day ftco-animate">
                <span class="subheading">Produk Paling Baru</span>
                <h2 class="mb-4">Produk keluaran terbaru dengan kualitas lebih</h2>
                <!-- Deskripsi dan harga produk paling baru -->
                <p><?php echo $newProduct['descript']; ?></p>
                <h3><a href="#"><?php echo $newProduct['name']; ?></a></h3>
                <span class="price">Rp <?php echo number_format($newProduct['price'],0,'.','.'); ?> <a href="#">sekarang hanya Rp <?php echo number_format($newProduct['price'],0,'.','.'); ?></a></span>
                <!-- Tombol untuk menambahkan ke keranjang -->
                <div id="timer" class="d-flex mt-5">
                    <div class="time pl-3">
                        <a href="#" class="btn btn-primary add-cart" data-sku="<?php echo $newProduct['sku']; ?>" data-name="<?php echo $newProduct['name']; ?>" data-price="<?php echo $newProduct['price']; ?>" data-id="<?php echo $newProduct['id']; ?>"><ion-icon name="cart"></ion-icon></a>
                    </div>
                    <!-- Tombol untuk melihat detail produk -->
                    <div class="time pl-3">
                        <a class="btn btn-info" href="produk_detail.php?id=<?php echo $product['id']?>&sku=<?php echo $product['sku']?>" class="buy-now d-flex justify-content-center align-items-center text-center">
                            <span><ion-icon name="menu" class="text-white"></ion-icon></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Bagian Testimoni Pelanggan -->
<section class="ftco-section testimony-section">
    <!-- Container untuk mengelompokkan konten -->
    <div class="container">
        <!-- Baris dan judul testimoni pelanggan -->
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section ftco-animate text-center">
                <span class="subheading">Testimony</span>
                <h2 class="mb-4">Apa yang pelanggan kami katakan?</h2>
            </div>
        </div>
        <!-- Baris untuk menampilkan testimonial menggunakan owl-carousel -->
        <div class="row ftco-animate">
            <div class="col-md-12">
                <div class="carousel-testimony owl-carousel">
                    <?php if (count($reviews) > 0) : ?>
                        <?php foreach ($reviews as $review) : ?>
                            <!-- Setiap item testimonial -->
                            <div class="item">
                                <div class="testimony-wrap p-4 pb-5">
                                    <!-- Gambar pelanggan -->
                                    <div class="user-img mb-5" style="background-image: url(<?php echo 'customer/customer_gambar/' . $review['profile_picture']; ?>)">
                                    </div>
                                    <div class="text text-center">
                                        <!-- Isi testimonial -->
                                        <p class="mb-5 pl-4 line"><?php echo $review['review_text']; ?></p>
                                        <!-- Nama pelanggan dan tanggal testimonial -->
                                        <p class="name"><?php echo $review['name']; ?></p>
                                        <span class="position"><?php echo get_formatted_date($review['review_date']); ?></span>
                                    </div>
                                </div>
                            </div>
            <?php endforeach; ?>
            <?php else : ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php 
    include 'layouts/footer.php';
  ?>