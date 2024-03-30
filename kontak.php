<?php
    include 'layouts/header.php';

    include 'function/home_function.php';

    // Mendapatkan data toko dan ulasan menggunakan fungsi-fungsi dari home_function.php
    $data = get_data_store();
    $reviews = get_all_review();
?>
<style type="text/css">
.style1 {
	color: #FFFBF0;
	font-size: 42px;
	font-weight: bold;
}
</style>
<!-- Bagian hero atau banner halaman dengan gambar latar -->
<div class="hero-wrap hero-bread" style="background-image: url('images/kontak.jpg');">
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span></p>
            <h1 class="style1">Hubungi Kami</h1>
        </div>
      </div>
    </div>
  </div>

  <!-- Bagian Section untuk kontak -->
  <section class="ftco-section contact-section bg-light">
    <div class="container">
        <div class="row d-flex mb-5 contact-info">
        <div class="w-100"></div>
        </div>
        <div class="right-content">
        <div class="pb-md-5 text-justify">
          <h4>Customer Service</h4>
            <p>Dalam layanan Customer Service kami, kami berkomitmen untuk menyediakan pelayanan terbaik yang responsif dan berorientasi pada kepuasan pelanggan.
              Tim kami terdiri dari profesional berpengalaman yang siap membantu kapan pun diperlukan, 24/7. Kami memprioritaskan transparansi, menyediakan informasi dengan jujur,
              dan memiliki sistem pengelolaan keluhan yang efisien.Kami berusaha untuk berpikir luar kotak, memberikan solusi kreatif, dan mengambil inisiatif positif untuk memastikan 
              kebutuhan pelanggan terpenuhi. Kami senantiasa terbuka terhadap umpan balik pelanggan dan menggunakan masukan tersebut sebagai landasan untuk terus meningkatkan kualitas layanan kami.</p>
            <!-- <a href="https://m.facebook.com/muhamad.roin.58" class="social" target='_BLANK'><i class="fab fa-facebook-f"></i></a> |
            <a href="https://api.whatsapp.com/send?phone=+6281382055381&text=saya ingin melakukan pemesanan mobil." class="social" target='_BLANK'><i class="fab fa-whatsapp"></i></a> |
            <a href="https://twitter.com/RoinMuhamad" class="social" target='_BLANK'><i class="fab fa-twitter"></i></a> -->
        </div>
        <!-- Bagian informasi kontak -->
        <div class="container">
        <div class="row d-flex mb-5 contact-info">
        <div class="w-100"></div>
        <!-- Informasi Alamat -->
        <div class="col-md-3 d-flex">
            <div class="info bg-white p-4">
              <p><span>Alamat</span> <?php echo $data[8]['content'] ?></p>
            </div>
        </div>
        <!-- Informasi Email -->
        <div class="col-md-3 d-flex">
            <div class="info bg-white p-4">
              <p><span>Email</span> <a href="#">KaryaTamanA@gmail.com</a></p>
            </div>
        </div>
        <!-- Informasi Website -->
        <div class="col-md-3 d-flex">
            <div class="info bg-white p-4">
              <p><span>Website</span> www.KaryaTamanAlam.com</p>
            </div>
        </div>
        <!-- Informasi instagram -->
        <div class="col-md-3 d-flex">
            <div class="info bg-white p-4">
              <p><span>Instagram</span> @KaryaTamanAlam</p>
            </div>
      </div>
     
        
      </div>
    </div>
  </section>
  <!-- Bagian Section untuk layanan dan produk -->
  <section class="ftco-section" id="products">
      <div class="container">
          <div class="row no-gutters ftco-services">
    <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
      <div class="media block-6 services mb-md-0 mb-4">
        <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
              <span class="flaticon-shipped"></span>
        </div>
        <div class="media-body">
          <h3 class="heading">Gratis Ongkir</h3>
          <span>Tanpa Minimum Belanja</span>
        </div>
      </div>      
    </div>
    <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
      <div class="media block-6 services mb-md-0 mb-4">
        <div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
              <span class="flaticon-award"></span>
        </div>
        <div class="media-body">
          <h3 class="heading">Kualitas No 1</h3>
          <span>Kualitas Terjamin</span>
        </div>
      </div>    
    </div>
    <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
      <div class="media block-6 services mb-md-0 mb-4">
        <div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
              <span class="flaticon-award"></span>
        </div>
        <div class="media-body">
          <h3 class="heading">Produk asli toyota</h3>
          <span>Barang Terjamin Keasliannya </span>
        </div>
      </div>      
    </div>
    <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
      <div class="media block-6 services mb-md-0 mb-4">
        <div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
              <span class="flaticon-customer-service"></span>
        </div>
        <div class="media-body">
          <h3 class="heading">Bantuan</h3>
          <span>Bantuan Selalu Online</span>
        </div>
      </div>      
    </div>
  </div>
      </div>
  </section>

  <?php
    include 'layouts/footer.php';
?>