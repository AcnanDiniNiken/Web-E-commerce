<?php 
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Karya Taman Alam</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">
	

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

	<link rel="stylesheet" href="css/ionicons.min.css">
	<link rel="stylesheet" href="css/all.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
	<link rel="stylesheet" href="css/style.css">

	<link rel="stylesheet" href="css/toastr.min.css">
	
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery-migrate-3.0.1.min.js"></script>
  </head>
  <body class="goto-here">
		<div class="py-1 bg-danger">
    	<div class="container">
    		<div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
	    		<div class="col-lg-12 d-block">
		    		<div class="row d-flex">
		    			<div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="fa fa-phone"></span></div>
						    <span class="text"><a href="#">081368389749</a></span>
					    </div>
					    <div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="fa-solid fa-paper-plane"></span></div>
						    <span class="text"><a href="#">karyatamanalam@gmail.com</a></span>
					    </div>
					    <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
						    <span class="text"><a href="#">Produk Berkulitas dan Bergransi</a></span>
					    </div>
				    </div>
			    </div>
		    </div>
		  </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.php"><a href="#">Karya Taman Alam</a></a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
	          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shop</a>
              <div class="dropdown-menu" aria-labelledby="dropdown04">
                <a class="dropdown-item" href="keranjang.php">Keranjang Belanja</a>
                <a class="dropdown-item" href="customer/konfirmasi_pembayaran.php">Konfirmasi Pembayaran</a>
              </div>
            </li>
	        <li class="nav-item"><a href="tentang_kami.php" class="nav-link">Tentang Kami</a></li>
          	<li class="nav-item"><a href="kontak.php" class="nav-link">Kontak</a></li>
			<li class="nav-item"><a href="chat.php" class="nav-link">Chat Admin</a></li>
              <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Akun</a>
              <div class="dropdown-menu" aria-labelledby="dropdown05">
				  <?php if (isset($_SESSION['customer']['id'])) : ?>
				  <a class="dropdown-item" href="customer/dashboard.php">Akun saya</a>
				  <a class="dropdown-item" href="customer/order.php">Order</a>
				  <div class="divider"></div>
				  <a class="dropdown-item" href="customer/logout.php">Logout</a>
				  <?php else : ?>
              	  <a class="dropdown-item" href="login.php">Masuk Log</a>
				  <a class="dropdown-item" href="register.php">Daftar</a>
				  <?php endif; ?>
              </div>
            </li>
	          <li class="nav-item cta cta-colored"><a href="keranjang.php" class="nav-link"><ion-icon name="cart"></ion-icon>[<span class="cart-item-total">0</span>]</a></li>

	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->