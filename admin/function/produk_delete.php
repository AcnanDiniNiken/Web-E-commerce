<?php 
    // Mengimpor file konfigurasi database
    include "../../config/database.php";

    // Mengecek metode HTTP yang digunakan (POST atau GET)
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $action = isset($_POST['action']) ? $_POST['action'] : '';
    } else {
        $action = isset($_GET['action']) ? $_GET['action'] : '';
    }

    // Melakukan pemilihan aksi berdasarkan nilai dari variabel $action
    switch ($action) {
        case 'delete_product':
            $id = isset($_POST['id']) ? $_POST['id'] : 0;
            // Memanggil fungsi delete_product dengan parameter id
            delete_product($id);
            $response = array('code' => 204, 'message' => 'Product berhasil dihapus!');
            break;
        case 'delete_image':
            $id = isset($_POST['id']) ? $_POST['id'] : 0;
            // Memanggil fungsi delete_image dengan parameter id
            delete_image($id);
            $response = array('code' => 204, 'message' => 'Gambar berhasil dihapus');
            break;
        default:
            // Respon jika aksi tidak valid
            $response = array('error' => 'Invalid action');
            break;
    }

    // Menetapkan header Content-Type untuk respon JSON
    header('Content-Type: application/json');
    
    // Mengirimkan respon dalam format JSON
    echo json_encode($response);

    // Fungsi untuk menghapus produk berdasarkan id
    function delete_product($id) {
        global $conn;
        // Menghapus data produk dari tabel produk berdasarkan id
        mysqli_query($conn, "DELETE FROM produk WHERE id=$id");
    }

    // Fungsi untuk menghapus gambar produk berdasarkan id
    function delete_image($id) {
        global $conn;
        // Mengambil nama gambar dari database berdasarkan id
        $query = "SELECT picture_name FROM produk WHERE id = $id";
        $result = mysqli_query($conn, $query);

        // Mengecek apakah data ditemukan dan memiliki gambar terkait
        if ($result && mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_assoc($result);
            $picture_name = $data['picture_name'];
            $file = 'produk_gambar/' . $picture_name;

            // Mengecek apakah file gambar ada, dapat dibaca, dan berhasil dihapus
            if (file_exists($file) && is_readable($file) && unlink($file)) {
                // Mengupdate kolom picture_name pada tabel produk menjadi null
                $query = "UPDATE produk SET picture_name=null WHERE id = $id";
                mysqli_query($conn, $query);
            }
        }
    }
?>
