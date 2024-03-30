<?php 
    // Memasukkan file konfigurasi database
    include '../config/database.php';
    
    // Mengambil nilai halaman saat ini dari parameter URL, jika tidak ada, diatur menjadi 1
    $pageSekarang = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    // Fungsi untuk mendapatkan semua data order dari tabel orders
    function get_all_order(){
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM orders");
        $orders = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $orders[] = $row;
        }
        return $orders;
    }

    // Fungsi untuk mendapatkan data user berdasarkan ID dari tabel users
    function get_user_by_id($id){
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
        $users = mysqli_fetch_assoc($result);
        return $users;
    }

    // Fungsi untuk mendapatkan data order dengan batasan jumlah dan offset dari tabel orders
    function get_limit_order($limit, $offset) {
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM orders LIMIT $limit OFFSET $offset");
        $orders = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $orders[] = $row;
        }
        return $orders;
    }

     // Fungsi untuk mendapatkan status pesanan berdasarkan status dan metode pembayaran
    function get_order_status($status, $payment)
    {
        if ($payment == 1)
        {
            // Metode Pembayaran: Bank
            if ($status == 1)
                return 'Menunggu pembayaran';
            else if ($status == 2)
                return 'Dalam proses';
            else if ($status == 3)
                return 'Dalam pengiriman';
            else if ($status == 4)
                return 'Selesai';
            else if ($status == 5)
                return 'Dibatalkan';
        }
        else if ($payment == 2)
        {
            //COD
            if ($status == 1)
                return 'Dalam proses';
            else if ($status == 2)
                return 'Dalam pengiriman';
            else if ($status == 3)
                return 'Selesai';
            else if ($status == 4)
                return 'Dibatalkan';
        }
    }

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
        
        // Inisialisasi tautan paginasi dengan tanda buka tag penuh
        $pagination = $config['full_tag_open'];

        // Menghitung jumlah halaman berdasarkan jumlah produk per halaman
        $totalPages = ceil($totalProducts / $itemsPerPage);
    
        // Menambahkan tautan ke halaman sebelumnya jika bukan halaman pertama
        if ($pageSekarang > 1) {
            $pagination .= '<li>' . $config['prev_tag_open'] . '<a href="?page=' . ($pageSekarang - 1) . '">' . $config['prev_link'] . '</a>' . '</li>';
        }
    
        // Membangun tautan untuk setiap halaman
        for ($i = 1; $i <= $totalPages; $i++) {
            $pagination .= '<li' . ($i == $pageSekarang ? ' class="active"' : '') . '>' . $config['num_tag_open'] . '<a href="?page=' . $i . '">' . $i . '</a>' . $config['num_tag_close'] . '</li>';
        }
    
        // Menambahkan tautan ke halaman berikutnya jika bukan halaman terakhir
        if ($pageSekarang < $totalPages) {
            $pagination .= '<li>' . $config['next_tag_open'] . '<a href="?page=' . ($pageSekarang + 1) . '">' . $config['next_link'] . '</a>' . '</li>';
        }
    
        // Menutup tag penuh
        $pagination .= $config['full_tag_close'];
    
        // Mengembalikan HTML tautan paginasi
        return $pagination;
    }
?>