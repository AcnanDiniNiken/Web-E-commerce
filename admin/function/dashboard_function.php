<?php 
    // Memasukkan file konfigurasi database
    include '../config/database.php';

    // Fungsi data_dashboard digunakan untuk mengambil data statistik untuk dashboard
    function data_dashboard(){
        // Variabel global untuk koneksi ke database
        global $conn;

        // Mengambil jumlah total produk dari tabel 'produk'
        $total_product = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total_product FROM produk"));

        // Mengambil jumlah total pelanggan (customers) dari tabel 'users' yang memiliki peran (role) 'Customer'
        $total_customer = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total_customer FROM users WHERE role = 'Customer'"));

        // Mengambil jumlah total pesanan (orders) dari tabel 'orders'
        $total_order = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total_order FROM orders"));

        // Mengambil semua pesanan (orders) yang memiliki status 4 (Selesai) dari tabel 'orders'
        $result = mysqli_query($conn, "SELECT * FROM orders WHERE order_status = 4");

        // Menyimpan pesanan ke dalam array $orders
        $orders = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $orders[] = $row;
        }
        
        // Menghitung total pendapatan dengan menjumlahkan total harga dari setiap pesanan
        $total_income = 0;
        foreach ($orders as $or){
            $total_income += $or['total_price'];
        }

        // Menyusun data dalam bentuk array
        $data = array(
            'total_product' => $total_product,
            'total_customer' => $total_customer,
            'total_order' => $total_order,
            'total_income' => $total_income
        );

        // Mengembalikan data sebagai hasil dari fungsi
        return $data;
    }
?>
