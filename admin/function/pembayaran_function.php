<?php 
    // Menginclude file konfigurasi database
    include '../config/database.php';

    // Mendapatkan halaman saat ini dari parameter URL, jika tidak ada, diatur sebagai 1
    $pageSekarang = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    // Fungsi untuk mendapatkan semua data pembayaran pelanggan
    function get_all_payment_customer(){
        global $conn;
        $result = mysqli_query($conn, "SELECT p.*, o.order_number FROM payments p JOIN orders o ON o.id = p.order_id ORDER BY p.payment_date DESC");
        $payments = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $payments[] = $row;
        }
        return $payments;
    }

    // Fungsi untuk mendapatkan data pelanggan berdasarkan ID pesanan
    function get_data_customer_by_order_id($orderId){
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM orders WHERE id=$orderId");
        $orders = mysqli_fetch_assoc($result);
        $userId = $orders['user_id'];
        $queryUser = mysqli_query($conn, "SELECT * FROM users WHERE id=$userId");
        $users = mysqli_fetch_assoc($queryUser);
        return $users;
    }

    // Fungsi untuk mendapatkan status pembayaran
    function get_payment_status($status)
    {
        if ($status == 1)
            return 'Menunggu konfirmasi';
        else if ($status == 2)
            return 'Berhasil dikonfirmasi';
        else if ($status == 3)
            return 'Pembayaran tidak ditemukan';
    }

    // Fungsi untuk mendapatkan sejumlah pembayaran dengan batasan dan offset tertentu
    function get_limit_payment_customer($limit, $offset) {
        global $conn;
        $result = mysqli_query($conn, "SELECT p.*, o.order_number FROM payments p JOIN orders o ON o.id = p.order_id ORDER BY p.payment_date DESC LIMIT $offset,$limit ");
        $payments = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $payments[] = $row;
        }
        return $payments;
    }

    function pagination($pageSekarang, $itemsPerPage, $totalPembayaran){
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
        
        // $config berisi konfigurasi tampilan paginasi
        $pagination = $config['full_tag_open'];
    
        // Menghitung total halaman berdasarkan jumlah pembayaran dan item per halaman
        $totalPages = ceil($totalPembayaran / $itemsPerPage);
    
        // Menambahkan tombol 'Prev' jika halaman saat ini lebih dari 1
        if ($pageSekarang > 1) {
            $pagination .= '<li>' . $config['prev_tag_open'] . '<a href="?page=' . ($pageSekarang - 1) . '">' . $config['prev_link'] . '</a>' . '</li>';
        }
    
        // Menambahkan tombol angka untuk setiap halaman
        for ($i = 1; $i <= $totalPages; $i++) {
            $pagination .= '<li' . ($i == $pageSekarang ? ' class="active"' : '') . '>' . $config['num_tag_open'] . '<a href="?page=' . $i . '">' . $i . '</a>' . $config['num_tag_close'] . '</li>';
        }
    
        // Menambahkan tombol 'Next' jika halaman saat ini kurang dari total halaman
        if ($pageSekarang < $totalPages) {
            $pagination .= '<li>' . $config['next_tag_open'] . '<a href="?page=' . ($pageSekarang + 1) . '">' . $config['next_link'] . '</a>' . '</li>';
        }
    
        // Menutup tag paginasi
        $pagination .= $config['full_tag_close'];
    
        // Mengembalikan HTML paginasi yang sudah dibuat
        return $pagination;
    }
    ?>
    