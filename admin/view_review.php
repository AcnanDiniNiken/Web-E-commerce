<?php
    include 'layouts/header.php';

    include 'function/view_review_function.php';
    $review = get_data_review($_GET['id']);
?>
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Review Order #<?php echo $review['order_number']; ?></h6>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="review.php">Review</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Order #<?php echo $review['order_number']; ?></li>
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
                <h3 class="mb-0">Review Order #<?php echo $review['order_number']; ?></h3>
              </div>
              <div class="card-body p-0">
              <table class="table align-items-center table-flush table-hover">
              <tr>
                        <td>Judul</td>
                        <td><b><?php echo $review['title']; ?></b></td>
                    </tr>
                    <tr>
                        <td>Order</td>
                        <td><b>#<?php echo $review['order_number']; ?></b></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td><b><?php echo $review['review_date']; ?></b></td>
                    </tr>
                    <tr>
                        <td>Review</td>
                        <td><b><?php echo $review['review_text']; ?></b></td>
                    </tr>
                </table>
              </div>
              
            </div>
            
          </div>

        </div>
        <div class="col-md-4">
            <div class="card card-primary">
              <div class="card-header">
                  <h3 class="mb-0">Tindakan</h3>
              </div>
              <div class="card-body">
              <a href="#" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger">
                <i class="fa fa-trash"></i> Hapus
            </a>
              </div>
              
            </div>
        </div>
      </div>

      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deletelModalLabel">Hapus Review</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="deleteText">Anda yakin ingin menghapus review?</p>
      </div>
      <div class="modal-footer">
      <form action="" method="post">
        <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
      </form>
      <?php 
        if(isset($_POST['hapus'])){
          delete_review($review['reviews_id']);
        }
      ?>
      </div>
    </div>
  </div>
</div>

<?php
    include 'layouts/footer.php';
?>