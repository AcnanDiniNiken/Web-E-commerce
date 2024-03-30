<?php 
    // Memasukkan file konfigurasi database
    include 'config/database.php';

    // Fungsi untuk mendapatkan data pelanggan berdasarkan ID
    function get_data_customer($id){
        global $conn;

        // Mengeksekusi query SQL untuk mendapatkan data pelanggan
        $result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
        $users = mysqli_fetch_assoc($result);

        // Mengembalikan data pelanggan
        return $users; 
    }

    // Fungsi untuk mendapatkan semua barang di keranjang berdasarkan ID pelanggan
    function get_all_keranjang($id){
        global $conn;

        // Mengeksekusi query SQL untuk mendapatkan data barang di keranjang
        $result = mysqli_query($conn, "SELECT id, product_id, qty FROM keranjang WHERE user_id = $id GROUP BY product_id");
        $carts = [];

        // Mengambil hasil query dan memasukkannya ke dalam array
        while ($row = mysqli_fetch_assoc($result)) {
            $carts[] = $row;
        }

        // Mengkonversi array ke dalam format JSON
        $carts = json_encode($carts);

        // Mengembalikan data keranjang dalam format JSON
        return $carts;
    }

    // Fungsi untuk mendapatkan total harga belanjaan berdasarkan ID pelanggan
    function get_total_price($user_id){
        global $conn;
        $total_price = 0;

        // Mengeksekusi query SQL untuk mendapatkan data barang di keranjang
        $result = mysqli_query($conn, "SELECT id, product_id, qty FROM keranjang WHERE user_id = $user_id GROUP BY product_id");
        $items = [];

        // Mengambil hasil query dan memasukkannya ke dalam array
        while ($row = mysqli_fetch_assoc($result)) {
            $items[] = $row;
        }
        
        // Menghitung total harga belanjaan
        foreach($items as $it){
            global $conn;
            $id_items = $it['product_id'];
            $result = mysqli_query($conn, "SELECT * FROM produk WHERE id=$id_items");
            $products = mysqli_fetch_assoc($result);
            
            $total_price += $products['price'] * $it['qty'];
        }

        // Mengembalikan total harga belanjaan
        return $total_price;
    }

    // Fungsi untuk membuat nomor pesanan
    function createOrderNumber($quantity, $user_id) {
        $alpha = strtoupper(substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 3));
        $num = mt_rand(100, 999);
        $count_qty = $quantity;
    
        $number = $alpha . date('j') . date('n') . date('y') . $count_qty . $user_id . $num;
    
        return $number;
    }

    // Fungsi untuk mendapatkan total item di keranjang berdasarkan ID pelanggan
    function get_total_items($user_id){
        global $conn;

        // Mengeksekusi query SQL untuk mendapatkan data barang di keranjang
        $result = mysqli_query($conn, "SELECT * FROM keranjang WHERE user_id=$user_id");
        $items = [];

        // Mengambil hasil query dan memasukkannya ke dalam array
        while ($row = mysqli_fetch_assoc($result)) {
            $items[] = $row;
        }

        // Menghitung total item di keranjang
        $total_item = count($items);

        // Mengembalikan total item di keranjang
        return $total_item;
    }

    // Fungsi untuk mendapatkan data produk berdasarkan ID
    function get_data_product($id){
        global $conn;

        // Mengeksekusi query SQL untuk mendapatkan data produk
        $result = mysqli_query($conn, "SELECT * FROM produk WHERE id=$id");
        $products = mysqli_fetch_assoc($result);

        // Mengembalikan data produk
        return $products;
    }

    // Fungsi untuk menyelesaikan pesanan
    function checkout_order($user_id){
        global $conn;

        // Membuat nomor pesanan
        $order_number = createOrderNumber(get_total_items($user_id), $user_id);
        $order_date = date('Y-m-d H:i:s');
        $total_price = $_POST['total_price'];
        $total_items = get_total_items($user_id);
        $payment_method = $_POST['payment'];
        
        // Mengumpulkan data pengiriman dalam format JSON
        $delivery_data = array(
            'customer' => array(
                'name' => $_POST['name'],
                'phone_number' => $_POST['phone_number'],
                'address' => $_POST['address']
            ),
            'note' => $_POST['note']
        );

        $delivery_data = json_encode($delivery_data);

        // Menyimpan data pesanan dalam database
        $query = mysqli_query($conn, "INSERT INTO orders(user_id, order_number, order_status, order_date, total_price, total_items, payment_method, delivery_data) VALUES ($user_id, '$order_number', 1, '$order_date', '$total_price', $total_items, $payment_method, '$delivery_data')");

        // Memproses data barang di keranjang
        if($query){
            $order_id = mysqli_insert_id($conn);
            $items = json_decode($_POST['keranjang']);

            foreach ($items as $it){
                $product = get_data_product($it->product_id);
                $product_id = $it->product_id;
                $qty = $it->qty;
                $order_price = $it->qty * $product['price'];
                
                // Menyimpan data barang di pesanan dalam database
                mysqli_query($conn, "INSERT INTO order_item(order_id, product_id, order_qty, order_price) VALUES ($order_id, $product_id, $qty, '$order_price')");
                
                // Menghapus barang dari keranjang
                delete_from_carts($it->id);
            }
        }

        // Menampilkan pesan sukses dan mengarahkan pengguna ke halaman keranjang
        echo "
              <script>
                  alert('Berhasil melakukan checkout.');
                  window.location='keranjang.php';
              </script>
              ";
    }
    
    // Fungsi untuk menghapus barang dari keranjang berdasarkan ID
    function delete_from_carts($id){
        global $conn;
        
        // Menghapus barang dari keranjang dalam database
        mysqli_query($conn, "DELETE FROM keranjang WHERE id=$id");
    }
?>
