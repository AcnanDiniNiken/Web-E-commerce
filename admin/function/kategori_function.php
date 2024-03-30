<?php 
    // Memasukkan file konfigurasi database
    include "../../config/database.php";

    // Mengecek metode HTTP yang digunakan (POST atau GET)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = isset($_POST['action']) ? $_POST['action'] : '';
    } else {
        $action = isset($_GET['action']) ? $_GET['action'] : '';
    }

    // Menjalankan aksi sesuai dengan permintaan
    switch ($action) {
        // Jika aksi adalah 'list', maka ambil semua kategori
        case 'list':
            $categories = get_all_categories();
            $response = array('data' => $categories);
            break;
        // Jika aksi adalah 'view_data', maka ambil data kategori berdasarkan ID
        case 'view_data':
            $id = isset($_GET['id']) ? $_GET['id'] : 0;
            $data = category_data($id);
            $response = array('data' => $data);
            break;
        // Jika aksi adalah 'add_category', maka tambahkan kategori baru
        case 'add_category':
            $name = isset($_POST['name']) ? $_POST['name'] : '';
            add_category($name);
            $categories = get_all_categories();
            $response = array('data' => $categories);
            break;
        // Jika aksi adalah 'delete_category', maka hapus kategori berdasarkan ID
        case 'delete_category':
            $id = isset($_POST['id']) ? $_POST['id'] : 0;
            delete_category($id);
            $response = array('code' => 204, 'message' => 'Kategori berhasil dihapus!');
            break;
        // Jika aksi adalah 'edit_category', maka perbarui data kategori berdasarkan ID
        case 'edit_category':
            $id = isset($_POST['id']) ? $_POST['id'] : 0;
            $name = isset($_POST['name']) ? $_POST['name'] : '';
            edit_category($id, $name);
            $response = array('code' => 201, 'message' => 'Kategori berhasil diperbarui');
            break;
        // Jika aksi tidak valid
        default:
            $response = array('error' => 'Invalid action');
            break;
    }

    // Mengatur tipe konten sebagai JSON
    header('Content-Type: application/json');
    // Mengembalikan data sebagai JSON
    echo json_encode($response);

    // Fungsi untuk mendapatkan semua kategori
    function get_all_categories() {
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM kategori");
        $categories = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = $row;
        }
        return $categories;
    }

    // Fungsi untuk mendapatkan data kategori berdasarkan ID
    function category_data($id) {
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM kategori WHERE id=$id");
        $categories = mysqli_fetch_assoc($result);
        return $categories;
    }

    // Fungsi untuk menambahkan kategori baru
    function add_category($name) {
        global $conn;
        mysqli_query($conn, "INSERT INTO kategori(nama) VALUES ('$name')");
    }

    // Fungsi untuk menghapus kategori berdasarkan ID
    function delete_category($id) {
        global $conn;
        mysqli_query($conn, "DELETE FROM kategori WHERE id=$id");
    }

    // Fungsi untuk mengedit data kategori berdasarkan ID
    function edit_category($id, $name) {
        global $conn;
        mysqli_query($conn, "UPDATE kategori set nama='$name' WHERE id=$id");
    }
?>
