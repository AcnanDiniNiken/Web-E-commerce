<?php
    // Mengimpor file header.php ke dalam halaman saat ini
    include 'layouts/header.php';
    // Mengimpor fungsi-fungsi terkait halaman tentang kami dari file home_function.php
    include 'function/home_function.php';

    // Mendapatkan data melalui database
    $data = get_data_store();
    $reviews = get_all_review();
?>

<!-- Bagian awal elemen hero-wrap dengan latar belakang gambar dari url 'images/ttg.jpg' -->
<div class="hero-wrap hero-bread" style="background-image: url('images/ttg.jpg');">
    <!-- Container untuk mengatur tata letak elemen-elemen di dalamnya -->
    <div class="container">
       <!-- Baris untuk menata elemen-elemen tanpa margin dan mengatur tata letak slider-text -->
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <!-- Kolom dengan lebar 9 untuk menampilkan teks dengan animasi -->
        <div class="col-md-9 ftco-animate text-center">
            <!-- Teks untuk menampilkan tautan breadcrumbs dan judul halaman -->
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Tentang Kami</span></p>
          <h1 class="mb-0 bread">Tentang Kami</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-section ftco-no-pb ftco-no-pt bg-light">
          <div class="container">
             <!-- Kolom gambar  -->
              <div class="row">
                  <div class="col-md-5 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url('images/ttg2.jpeg');">
                  </div>
                  <!-- Kolom teks -->
                  <div class="col-md-7 py-5 wrap-about pb-md-5 ftco-animate">
            <div class="heading-section-bold mb-4 mt-md-5">
                <div class="ml-md-0">
                  <h2 class="mb-4">Selamat Datang <a href="#">Karya Taman Alam</a></h2>
              </div>
            </div>

            <!-- Bagian isi teks -->
            <div class="pb-md-5">
            <div class="pb-md-5 text-justify">
                <!-- Paragraf yang menampilkan konten dari data toko -->
                <p><?php echo $data[7]['content']?></p>
                <div class="pb-md-5">
                <!-- Konten Visi dan Misi -->
                <h4 class="mb-3">Visi:</h4>
                <p>Mewujudkan lingkungan hijau dan indah melalui kreasi taman alam yang unik dan berkelanjutan, Mewujudkan keindahan dan keberlanjutan lingkungan melalui kreasi taman alam yang unik, memikat, dan berkelanjutan untuk kebahagiaan dan kesejahteraan bersama.</p>
                <h4 class="mb-3">Misi:</h4>
                <!-- Daftar misi dalam bentuk unordered list -->
                <ul>
                    <li>Memberikan pelayanan konsultasi taman yang berkualitas tinggi, menggabungkan keahlian seni dan ilmu kebun sehingga setiap proyek mencerminkan keinginan dan gaya hidup pelanggan.</li>
                    <li>Menyediakan beragam produk-produk landscape berkualitas tinggi yang tidak hanya memperindah lingkungan, tetapi juga mendukung keberlanjutan alam.</li>
                    <li>Mengutamakan keberlanjutan dengan menerapkan praktik-praktik ramah lingkungan dalam setiap desain taman, termasuk penggunaan tanaman lokal dan bahan-bahan daur ulang.</li>
                </ul>
                <!-- Akhir Konten Visi dan Misi -->
                <!-- Tombol untuk menuju ke bagian produk -->
                <p><a href="index.php#products" class="btn btn-danger">Belanja sekarang!</a></p>
            </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- Bagian testimonial -->       
      <section class="ftco-section testimony-section">
    <div class="container">
      <div class="row justify-content-center mb-5 pb-3">
        <!-- Kolom untuk judul testimoni -->
        <div class="col-md-7 heading-section ftco-animate text-center">
            <span class="subheading">Testimony</span>
          <h2 class="mb-4">Apa yang pelanggan kami katakan?</h2>
        </div>
      </div>
      <div class="row ftco-animate">
        <!-- Kolom untuk menampilkan daftar testimoni menggunakan carousel -->
        <div class="col-md-12">
          <div class="carousel-testimony owl-carousel">
            <?php if ( count($reviews) > 0) : ?>
            <?php foreach ($reviews as $review) : ?>
              <!-- Item testimoni dalam bentuk carousel -->
            <div class="item">
              <div class="testimony-wrap p-4 pb-5">
                <div class="user-img mb-5" style="background-image: url(<?php echo 'customer/customer_gambar/'. $review['profile_picture']; ?>)">
                </div>
                <!-- Teks testimoni dan informasi pelanggan -->
                <div class="text text-center">
                  <p class="mb-5 pl-4 line"><?php echo $review['review_text']; ?></p>
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
  // Memasukkan file footer.php ke dalam halaman
    include 'layouts/footer.php';
?>
  
  