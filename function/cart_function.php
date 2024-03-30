<?php
// Memulai sesi PHP
session_start();

// Memasukkan file konfigurasi database
include '../config/database.php';

// Menangani permintaan HTTP POST atau GET
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : '';
} else {
    $action = isset($_GET['action']) ? $_GET['action'] : '';
}

// Melakukan switch case berdasarkan nilai variabel $action
switch ($action) {
    case 'add_item':
        // Mengambil data dari formulir tambah item
        $id = $_POST['id'];
        $qty = $_POST['qty'];
        $user_id = $_SESSION['customer']['id'];

        // Memeriksa apakah item sudah ada di keranjang
        $result = mysqli_query($conn, "SELECT * FROM keranjang WHERE product_id=$id AND user_id=$user_id");
        $items = mysqli_fetch_assoc($result);

        // Jika item sudah ada, update jumlahnya; jika tidak, tambahkan item baru ke keranjang
        if ($items != NULL) {
            $newQty = $items['qty'] + $qty;
            mysqli_query($conn, "UPDATE keranjang SET qty = $newQty WHERE product_id=$id AND user_id=$user_id");
        } else {
            add_cart($id, $qty, $user_id);
        }

        // Mengambil data keranjang setelah penambahan item
        $result = mysqli_query($conn, "SELECT * FROM keranjang WHERE user_id=$user_id");
        $items = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $items[] = $row;
        }
        $total_item = count($items);

        // Menyiapkan respons dalam bentuk array
        $response = array('code' => 200, 'message' => 'Item dimasukkan dalam keranjang', 'total_item' => $total_item);
        break;

    case 'display_cart':
        // Menyiapkan array untuk menyimpan data keranjang
        $carts = [];

        // Mengambil data keranjang menggunakan objek cart (tidak ditemukan dalam kode yang diberikan)
        foreach ($this->cart->contents() as $items) {
            $carts[$items['rowid']]['id'] = $items['id'];
            $carts[$items['rowid']]['name'] = $items['name'];
            $carts[$items['rowid']]['qty'] = $items['qty'];
            $carts[$items['rowid']]['price'] = $items['price'];
            $carts[$items['rowid']]['subtotal'] = $items['subtotal'];
        }

        // Menyiapkan respons dalam bentuk array
        $response = array('code' => 200, 'carts' => $carts);
        break;

    case 'cart_info':
        // Mengambil ID pengguna dari sesi
        $user_id = $_SESSION['customer']['id'];

        // Mengambil data keranjang dari database
        $result = mysqli_query($conn, "SELECT * FROM keranjang WHERE user_id=$user_id");
        $items = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $items[] = $row;
        }
        $total_item = count($items);

        // Menyiapkan data total item dalam bentuk array
        $data['total_item'] = $total_item;

        // Menyiapkan respons dalam bentuk array
        $response['data'] = $data;
        break;

    case 'remove_item':
        // Mengambil ID pengguna dari sesi
        $user_id = $_SESSION['customer']['id'];

        // Mengambil ID item yang akan dihapus
        $id = isset($_POST['id']) ? $_POST['id'] : '';

        // Menghapus item dari keranjang
        delete_cart($id, $user_id);

        // Menghitung total harga setelah penghapusan item
        $total_price = 0;

        // Mengambil data keranjang setelah penghapusan item
        $result = mysqli_query($conn, "SELECT id, product_id, SUM(qty) AS total_qty FROM keranjang WHERE user_id = $user_id GROUP BY product_id");
        $items = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $items[] = $row;
        }

        // Menghitung total harga dari item-item yang tersisa
        foreach ($items as $it) {
            global $conn;
            $id_items = $it['product_id'];
            $result = mysqli_query($conn, "SELECT * FROM produk WHERE id=$id_items");
            $products = mysqli_fetch_assoc($result);

            $total_price += $products['price'] * $it['total_qty'];
        }

        // Menyiapkan data respons dalam bentuk array
        $data['code'] = 204;
        $data['message'] = 'Item dihapus dari keranjang';
        $data['total'] = 'Rp ' . number_format($total_price);
        $data['id'] = $id;
        $data['user_id'] = $user_id;

        // Menyiapkan respons dalam bentuk array
        $response = $data;
        break;
}

// Mengkonversi respons menjadi format JSON
$response = json_encode($response);

// Menetapkan tipe konten sebagai JSON
header('Content-Type: application/json');

// Menampilkan respons JSON
echo $response;

// Fungsi untuk menambahkan item ke dalam keranjang
function add_cart($id, $qty, $user_id)
{
    global $conn;
    mysqli_query($conn, "INSERT INTO keranjang(product_id, qty, user_id) VALUES ($id, $qty, $user_id)");
}

// Fungsi untuk menghapus item dari keranjang
function delete_cart($id, $user_id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM keranjang WHERE product_id=$id AND user_id=$user_id");
}
?>
