<?php 
// Memulai sesi PHP
session_start();

// Mengimpor file fungsi profil
include 'function/profile_function.php';

// Mengambil data pengguna dari sesi admin yang telah masuk
$user = get_data_user($_SESSION['admin']['id']);
?>
<!DOCTYPE html>
<html>

<head>
    <!-- Pengaturan charset dan viewport -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Judul halaman -->
    <title> Dashboard Admin </title>

    <!-- Favicon -->
    <link rel="icon" href="../images/brand/favicon.png" type="image/png">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="../css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="../css/all.min.css" type="text/css">
    <link rel="stylesheet" href="../css/argon9f1e.css?v=1.1.0" type="text/css">
    <link rel="stylesheet" href="../css/chat.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

    <!-- Bootstrap CSS dari CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Bootstrap JS dari CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
</head>

 
 <body>
   <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-sm navbar-light bg-white" id="sidenav-main">
     <div class="scrollbar-inner">
       <!-- Brand -->
       <div class="sidenav-header d-flex align-items-center">
         
		   <a class="navbar-brand" href="dashboard.php">
          Karya Taman Alam
         </a>
         <div class="ml-auto">
           <!-- Sidenav toggler -->
           <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
             <div class="sidenav-toggler-inner">
               <i class="sidenav-toggler-line"></i>
               <i class="sidenav-toggler-line"></i>
               <i class="sidenav-toggler-line"></i>
             </div>
           </div>
         </div>
       </div>
       <div class="navbar-inner">
         <!-- Collapse -->
         <div class="collapse navbar-collapse" id="sidenav-collapse-main">
           <!-- Nav items -->
           <ul class="navbar-nav">
             <li class="nav-item">
               <a class="nav-link" href="dashboard.php">
                 <i class="fa fa-television text-primary"></i>
                 <span class="nav-link-text">Dasbor</span>
               </a>
             </li>
             <li class="nav-item">
              <a class="nav-link" href="kategori.php">
                <i class="fa fa-list text-info"></i>
                <span class="nav-link-text">Kategori Produk</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="produk.php">
                <i class="fa fa-shopping-cart text-success"></i>
                <span class="nav-link-text">Produk</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="order.php">
                <i class="fa fa-file-invoice text-danger"></i>
                <span class="nav-link-text">Pesanan</span>
              </a>
            </li>
           
            <li class="nav-item">
              <a class="nav-link" href="pembayaran.php">
                <i class="fa fa-money-bill-alt text-warning"></i>
                <span class="nav-link-text">Pembayaran</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pelanggan.php">
                <i class="fa fa-users text-primary"></i>
                <span class="nav-link-text">Pelanggan</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="review.php">
                <i class="fa fa-edit text-info"></i>
                <span class="nav-link-text">Review Pelanggan</span>
              </a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="chat.php">
                 <i class="fa fa-television text-primary"></i>
                 <span class="nav-link-text">Chat</span>
               </a>
             </li>		
			
        
           </ul>
         </div>
       </div>
     </div>
   </nav>
   <!-- Main content -->
   <div class="main-content" id="panel">
     <!-- Topnav -->
     <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
       <div class="container-fluid">
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
           <!-- Search form -->
           <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main" action="produk/cari" required>
             <div class="form-group mb-0">
               <div class="input-group input-group-alternative input-group-merge">
                 <div class="input-group-prepend">
                   <span class="input-group-text"><i class="fas fa-search"></i></span>
                 </div>
                 <input class="form-control" value="<?php echo (isset($query) ? $query : ''); ?>" name="search_query" placeholder="Cari..." type="text" required>
               </div>
             </div>
             <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
               <span aria-hidden="true">×</span>
             </button>
           </form>
           <!-- Navbar links -->
           <ul class="navbar-nav align-items-center ml-md-auto">
             <li class="nav-item d-xl-none">
               <!-- Sidenav toggler -->
               <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                 <div class="sidenav-toggler-inner">
                   <i class="sidenav-toggler-line"></i>
                   <i class="sidenav-toggler-line"></i>
                   <i class="sidenav-toggler-line"></i>
                 </div>
               </div>
             </li>
             <li class="nav-item d-sm-none">
               <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                 <i class="ni ni-zoom-split-in"></i>
               </a>
             </li>

           </ul>
           <ul class="navbar-nav align-items-center ml-auto ml-md-0">
             <li class="nav-item dropdown">
               <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <div class="media align-items-center">
                   <span class="avatar avatar-sm rounded-circle">
                     <img src="admin_gambar/<?php echo $user['profile_picture']?>" alt="">
                   </span>
                   <div class="media-body ml-2 d-none d-lg-block">
                     <span class="mb-0 text-sm  font-weight-bold">Administator</span>
                   </div>
                 </div>
               </a>
               <div class="dropdown-menu dropdown-menu-right">
                 <div class="dropdown-header noti-title">
                   <h6 class="text-overflow m-0">Welcome!</h6>
                 </div>
                 <a href="profile.php" class="dropdown-item">
                   <i class="ni ni-single-02"></i>
                   <span>Profil</span>
                 </a>
                 <a href="pengaturan.php" class="dropdown-item">
                   <i class="ni ni-settings-gear-65"></i>
                   <span>Pengaturan</span>
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="logout.php" class="dropdown-item">
                   <i class="ni ni-user-run"></i>
                   <span>Logout</span>
                 </a>
               </div>
             </li>
           </ul>
         </div>
       </div>
     </nav>