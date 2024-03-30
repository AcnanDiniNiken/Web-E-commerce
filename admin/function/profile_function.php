<?php 
    include '../config/database.php';

    function get_data_user($id){
        global $conn;

        $result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
        $users = mysqli_fetch_assoc($result);
        return $users;
    }

    function change_profile($id, $password_old){
        global $conn;

        $nama = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        if($_POST['password']){
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        }else{
            $password = $password_old;
        }

        if (!($_FILES['picture']['error'] == 4 || ($_FILES['picture']['size'] == 0 && $_FILES['picture']['error'] == 0))){
            $query = "SELECT profile_picture FROM users WHERE id = $id";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $data = mysqli_fetch_assoc($result);
                $profile_picture = $data['profile_picture'];
                $file = 'admin_gambar/' . $profile_picture;

                if (file_exists($file) && is_readable($file) && unlink($file)) {
                    $query = "UPDATE users SET profile_picture=null WHERE id = $id";
                    mysqli_query($conn, $query);
                }
            }
            
            $namaFile = $_FILES['picture']['name'];
            $tmpName = $_FILES['picture']['tmp_name'];

            $ekstensiFile = ['jpeg', 'jpg', 'png'];
            $ekstensiGambar = explode('.', $namaFile);
            $ekstensiGambar2 = $ekstensiGambar[1];

            if(!in_array($ekstensiGambar2, $ekstensiFile)){
                echo "<script>
                    alert('Ekstensi harus jpeg jpg png');
                </script>";
            }else{
                $namaBaru = 'admin'.time().'.'.$ekstensiGambar2;
                move_uploaded_file($tmpName, "admin_gambar/".$namaBaru);
            }

            $query = mysqli_query($conn, "UPDATE users SET name='$nama', email='$email', username='$username', password='$password', profile_picture='$namaBaru' WHERE id=$id");
        }

        $query = mysqli_query($conn, "UPDATE users SET name='$nama', email='$email', username='$username', password='$password' WHERE id=$id");

        if($query){
            echo "
                <script>
                    alert('Data berhasil di ubah');
                    window.location='profile.php'
                </script>
                ";
        }else{
            echo "
                <script>
                    alert('Data gagal diubah');
                </script>
                ";
        }
    }

?>