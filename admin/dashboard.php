<?php 
  // Include file header.php untuk menampilkan bagian atas halaman
    include 'layouts/header.php';

    // Include file dashboard_function.php untuk mendapatkan data dasbor
    include 'function/dashboard_function.php';

     // Memanggil fungsi data_dashboard() untuk mendapatkan data dasbor
    $data = data_dashboard();
?>
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Dasbor</h6>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dasbor</li>
                </ol>
              </nav>
            </div>
          </div>
          <!-- Card stats -->
          <!-- Card untuk menampilkan jumlah produk -->
          <div class="row">
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Produk</h5>
                      <!-- Menampilkan jumlah produk dari data yang didapatkan -->
                      <span class="h2 font-weight-bold mb-0"><?php echo $data['total_product']['total_product']?></span>
                    </div>
                    <div class="col-auto">
                      <!-- Icon dengan latar belakang gradasi merah untuk merepresentasikan produk -->
                      <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                        <i class="fa-solid fa-store"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                    <span class="text-nowrap">Jumlah produk yang tersedia</span>
                  </p>
                </div>
              </div>
            </div>

            <!-- Card untuk menampilkan jumlah pelanggan -->
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Pelanggan</h5>
                      <!-- Menampilkan jumlah pelanggan dari data yang didapatkan -->
                      <span class="h2 font-weight-bold mb-0"><?php echo $data['total_customer']['total_customer']?></span>
                    </div>
                    <div class="col-auto">
                      <!-- Icon dengan latar belakang gradasi oranye untuk merepresentasikan pelanggan -->
                      <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i class="fa fa-user-circle"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                    <span class="text-nowrap">Pelanggan yang terdaftar</span>
                  </p>
                </div>
              </div>
            </div>
            <!-- Card untuk menampilkan jumlah pesanan -->
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Pesanan</h5>
                        <!-- Menampilkan jumlah pesanan dari data yang didapatkan -->
                      <span class="h2 font-weight-bold mb-0"><?php echo $data['total_order']['total_order']?></span>
                    </div>
                    <div class="col-auto">
                      <!-- Icon dengan latar belakang gradasi hijau untuk merepresentasikan pesanan -->
                      <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                        <i class="fa fa-bar-chart"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                    <span class="text-nowrap">Jumlah pesanan diterima</span>
                  </p>
                </div>
              </div>
            </div>
            <!-- Card untuk menampilkan total pendapatan -->
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Pendapatan</h5>
                      <!-- Menampilkan total pendapatan dari data yang didapatkan -->
                      <span class="h2 font-weight-bold mb-0">Rp <?php echo number_format($data['total_income'],0,'.','.')?></span>
                    </div>
                    <div class="col-auto">
                      <!-- Icon dengan latar belakang gradasi biru untuk merepresentasikan pendapatan -->
                      <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                        <i class="fa fa-money"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                    <span class="text-nowrap">Total pendapatan</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    </div>

<?php 
    include 'layouts/footer.php';
?>