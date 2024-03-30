<?php 
    // Include file database.php yang berisi koneksi ke database
    include '../config/database.php';

    // Mendapatkan nilai halaman saat ini dari parameter GET, atau default 1 jika tidak ada
    $pageSekarang = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    // Fungsi untuk mendapatkan semua pesanan yang memiliki status "Selesai" (order_status=4)
    function get_all_order(){
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM orders WHERE order_status=4");
        $orders = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $orders[] = $row;
        }
        return $orders;
    }

    // Fungsi untuk mendapatkan total pendapatan dari semua pesanan yang memiliki status "Selesai"
    function get_total_income(){
        global $conn;
        $result = mysqli_query($conn, "SELECT SUM(total_price) AS total_income FROM orders WHERE order_status=4");
        $total_income = mysqli_fetch_assoc($result);
        return $total_income;
    }

    // Fungsi untuk mendapatkan sejumlah pesanan terbatas dengan batasan jumlah dan offset
    function get_limit_order($limit, $offset) {
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM orders WHERE order_status=4 LIMIT $limit OFFSET $offset");
        $orders = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $orders[] = $row;
        }
        return $orders;
    }

    // Fungsi untuk mendapatkan data pengguna berdasarkan ID
    function get_user_by_id($id){
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
        $users = mysqli_fetch_assoc($result);
        return $users;
    }

    // Fungsi untuk membuat tampilan pagination
    function pagination($pageSekarang, $itemsPerPage, $totalProducts){
        $config = array(
            'next_link' => '›',
            'prev_link' => '‹',
            'full_tag_open' => '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">',
            'full_tag_close' => '</ul></nav></div>',
            'num_tag_open' => '<li class="page-item"><span class="page-link">',
            'num_tag_close' => '</span></li>',
            'cur_tag_open' => '<li class="page-item active"><span class="page-link">',
            'cur_tag_close' => '<span class="sr-only">(current)</span></span></li>',
            'next_tag_open' => '<li class="page-item"><span class="page-link">',
            'next_tagl_close' => '<span aria-hidden="true">&raquo;</span></span></li>',
            'prev_tag_open' => '<li class="page-item"><span class="page-link">',
            'prev_tagl_close' => '</span>Next</li>',
            'first_tag_open' => '<li class="page-item"><span class="page-link">',
            'first_tagl_close' => '</span></li>',
            'last_tag_open' => '<li class="page-item"><span class="page-link">',
            'last_tagl_close' => '</span></li>'
        );
        
        // Inisialisasi variabel $pagination dengan tag pembukaan pagination dari konfigurasi
        $pagination = $config['full_tag_open'];
    
        // Menghitung total halaman berdasarkan jumlah produk per halaman
        $totalPages = ceil($totalProducts / $itemsPerPage);
    
        // Menambahkan tombol navigasi ke halaman sebelumnya jika halaman saat ini bukan halaman pertama
        if ($pageSekarang > 1) {
            $pagination .= '<li>' . $config['prev_tag_open'] . '<a href="?page=' . ($pageSekarang - 1) . '">' . $config['prev_link'] . '</a>' . '</li>';
        }
    
        // Menambahkan nomor halaman dengan tautan ke masing-masing halaman
        for ($i = 1; $i <= $totalPages; $i++) {
            $pagination .= '<li' . ($i == $pageSekarang ? ' class="active"' : '') . '>' . $config['num_tag_open'] . '<a href="?page=' . $i . '">' . $i . '</a>' . $config['num_tag_close'] . '</li>';
        }
    
        // Menambahkan tombol navigasi ke halaman berikutnya jika halaman saat ini bukan halaman terakhir
        if ($pageSekarang < $totalPages) {
            $pagination .= '<li>' . $config['next_tag_open'] . '<a href="?page=' . ($pageSekarang + 1) . '">' . $config['next_link'] . '</a>' . '</li>';
        }
    
        // Menambahkan tag penutup pagination dari konfigurasi
        $pagination .= $config['full_tag_close'];
    
        // Mengembalikan hasil pagination
        return $pagination;
    }
    ?>
    