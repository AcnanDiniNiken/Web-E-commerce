<?php
    // Mengambil file header.php dan review_function.php
    include 'layouts/header.php';
    include 'function/review_function.php';

    // Mengambil semua review
    $allReview = get_all_review();

    // Konfigurasi jumlah item per halaman dan offset
    $itemPerPage = 10;
    $offset = ($pageSekarang - 1) * $itemPerPage;

    // Mengambil review dengan batasan jumlah item dan offset
    $reviews = get_limit_review_customer($itemPerPage, $offset);

    // Membuat pagination
    $pagination = pagination($pageSekarang, $itemPerPage, count($allReview));
?>
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Review Pelanggan</h6>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item active" aria-current="page">Review</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
          <!-- Card header -->
          <div class="card-header">
              <!-- Menampilkan judul "Kelola Review" -->
              <h3 class="mb-0">Kelola Review</h3>
            </div>

            <?php if ( count($reviews) > 0) : ?>
            <!-- Jika terdapat review, tampilkan tabel -->
            <div class="card-body p-0">
                <div class="table-responsive">
              <!-- Projects table -->
              <!-- Tabel untuk menampilkan daftar review -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <!-- Baris header tabel -->
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Order</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Review</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($reviews as $review) : ?>
                    <?php 
                        // Mengambil informasi order berdasarkan ID review
                        $order = get_order_by_id($review['order_id']);
                    ?>
                    <?php 
                        // Mengambil informasi customer berdasarkan ID review
                        $customer = get_customer_by_id($review['user_id']);
                    ?>
                  <tr>
                    <th scope="col">
                      <?php echo $review['id']; ?>
                    </th>
                    <td><?php 
                            if(isset($order['id'])){
                        ?>
                        <!-- Jika order masih ada, tampilkan link ke halaman view_review -->
                        <a href="view_review.php?id=<?php echo $review['id'];?>"><?php echo '#'. $order['order_number'];?></a>
                        <?php 
                            }else{
                        ?>
                        <!-- Jika order sudah dihapus, tampilkan pesan -->
                        Data Order Sudah Dihapus
                        <?php
                            }
                        ?></td>
                    <td><?php 
                            if(isset($customer['id'])){
                                // Jika customer masih ada, tampilkan nama customer
                                echo $customer['name'];
                        ?>
                        <?php 
                            }else{
                        ?>
                        <!-- Jika customer sudah dihapus, tampilkan pesan -->
                        Data Customer Sudah Dihapus
                        <?php
                            }
                        ?>
                    </td>
                    <td>
                    <td><?php echo $review['review_date']; ?></td>
                    <!-- Menampilkan tanggal review -->

                    <td><?php echo $review['review_text']; ?></td>
                    <!-- Menampilkan isi dari review -->
                  </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
            </div>
                </div>
            
            <div class="card-footer">
                <!-- Menampilkan navigasi halaman (pagination) -->
                <?php echo $pagination; ?>
            </div>
            <?php else : ?>
             <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <!-- Menampilkan pesan jika belum ada review dari user -->
                        <div class="alert alert-primary">
                           Belum ada review dari user
                        </div>
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
