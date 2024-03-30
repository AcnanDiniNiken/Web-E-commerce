<?php 

$conn = mysqli_connect('localhost', 'root', '', 'karya_taman_alam');

if(!$conn){
    die("
    <script>
        alert('Gagal terhubung database');
    </script>
    ");
}
?>