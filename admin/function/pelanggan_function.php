<?php
    // Menginclude file konfigurasi database
    include "../../config/database.php";

    // Memeriksa metode permintaan HTTP (POST atau GET)
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $action = isset($_POST['action']) ? $_POST['action'] : '';
    } else {
        $action = isset($_GET['action']) ? $_GET['action'] : '';
    }

    // Menggunakan struktur switch untuk menangani berbagai tindakan yang mungkin dilakukan
    switch ($action) {
        // Jika tindakan adalah 'list', ambil semua data pelanggan
        case 'list':
            $pelanggan = get_all_pelanggan();
            $response = array('data' => $pelanggan);
            break;
        // Jika tindakan adalah 'delete_customer', hapus pelanggan berdasarkan ID
        case 'delete_customer':
            $id = isset($_POST['id']) ? $_POST['id'] : 0;
            delete_customer($id);
            $response = array('code' => 204, 'message' => 'Pelanggan berhasil dihapus!');
            break;
        // Jika tindakan tidak valid
        default:
            $response = array('error' => 'Invalid action');
            break;
    }

    // Mengatur tipe konten sebagai JSON dan mengirimkan respon dalam format JSON
    header('Content-Type: application/json');
    echo json_encode($response);

    // Fungsi untuk mendapatkan semua data pelanggan
    function get_all_pelanggan() {
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM users");
        $pelanggan = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $pelanggan[] = $row;
        }
        return $pelanggan;
    }

    // Fungsi untuk menghapus pelanggan berdasarkan ID
    function delete_customer($id) {
        global $conn;
        mysqli_query($conn, "DELETE FROM users WHERE id=$id");
    }
?>
