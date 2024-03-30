<?php
    // Include file database.php yang berisi koneksi ke database
    include '../config/database.php';

    // Fungsi untuk mendapatkan data pengaturan dari tabel settings
    function get_data_pengaturan(){
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM settings");
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    // Fungsi untuk melakukan update pada seluruh pengaturan
    function update_all_setting(){
        global $conn;

        // Daftar kunci pengaturan yang akan diupdate
        $keys = array(
            'store_name', 'store_phone_number', 'store_email', 'store_tagline', 'store_description',
            'store_address', 'min_shop_to_free_shipping_cost', 'shipping_cost'
        );
        
        // Melakukan iterasi pada setiap kunci pengaturan
        foreach ($keys as $key) {
            // Jika nilai $_POST untuk kunci tersebut ada, lakukan update
            if (isset($_POST[$key])) {
                $content = $_POST[$key];
                update_setting($key, $content);
            }
        }

        // Menghandle update untuk logo toko
        if(!empty($_FILES['picture']['name'])){
            $namaFile = $_FILES['picture']['name'];
            $tmpName = $_FILES['picture']['tmp_name'];

            $ekstensiFile = ['jpeg', 'jpg', 'png'];
            $ekstensiGambar = explode('.', $namaFile);
            $ekstensiGambar2 = $ekstensiGambar[1];

            // Memeriksa ekstensi file
            if(!in_array($ekstensiGambar2, $ekstensiFile)){
                echo "<script>
                    alert('Ekstensi harus jpeg jpg png');
                </script>";
            }else{
                $namaBaru = 'produk'.time().'.'.$ekstensiGambar2;
                move_uploaded_file($tmpName, "admin_gambar/".$namaBaru);
            }

            // Melakukan update untuk kunci 'store_logo'
            mysqli_query($conn, "UPDATE settings SET settings.content='$namaBaru' WHERE settings.key = 'store_logo'");
        }

        // Menghandle update untuk informasi bank pembayaran
        if (isset($_POST["banks"])) {
            $banks = $_POST["banks"];
    
            $formatBanks = [];
    
            foreach ($banks as $index => $bank) {
                $bankName = strtolower($bank["bank"]);
                $formatBanks[$bankName] = [
                    "bank" => $bank["bank"],
                    "number" => $bank["number"],
                    "name" => $bank["name"]
                ];
            }
    
            $banks = json_encode($formatBanks);

            // Melakukan update untuk kunci 'payment_banks'
            mysqli_query($conn, "UPDATE settings SET settings.content='$banks' WHERE settings.key = 'payment_banks'");
        } 

        // Menampilkan pesan sukses setelah berhasil melakukan update
        echo "
        <script>
            alert('Pengaturan berhasil diubah');
            window.location='pengaturan.php'
        </script>
        ";
    }

    // Fungsi untuk melakukan update pada suatu pengaturan berdasarkan kunci (key)
    function update_setting($key, $content){
        global $conn;
        mysqli_query($conn, "UPDATE settings SET settings.content='$content' WHERE settings.key = '$key'");
    }
?>
