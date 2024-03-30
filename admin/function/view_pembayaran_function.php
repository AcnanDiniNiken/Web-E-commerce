<?php 
    include '../config/database.php';

    function get_data_pembayaran($idPembayaran){
        global $conn;
        $result = mysqli_query($conn, "SELECT p.id as payment_id, o.id as order_id, p.*, o.* FROM payments p JOIN orders o ON o.id = p.order_id WHERE p.id = $idPembayaran");
        $payments = mysqli_fetch_assoc($result);

        return $payments;
    }

    function get_bank_payment($namaBank){
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM settings WHERE settings.key = 'payment_banks'");
        $payments = mysqli_fetch_assoc($result);

        $payments = json_decode($payments['content'], true);
        foreach($payments as $py){
            if(strtolower($py['bank']) == $namaBank){
                $payments = $py;
            }
        }
        return $payments;
    }

    function get_payment_status($status)
    {
        if ($status == 1)
            return 'Menunggu konfirmasi';
        else if ($status == 2)
            return 'Berhasil dikonfirmasi';
        else if ($status == 3)
            return 'Pembayaran tidak ditemukan';
    }

    function validasi_pembayaran($order_id, $id, $action){
        global $conn;

        if ($action == 1)
        {
            $status = 2;
            // $flash = 'Pembayaran berhasil dikonfirmasi';
        }
        else if($action == 2)
        {
            $status = 3;
            // $flash = 'Pembayaran ditandai sebagai tidak ada';
        }
        else
        {
            // $flash = 'Tidak ada tindakan dilakukan';
        }

        $query = mysqli_query($conn, "UPDATE orders SET order_status='2' WHERE id=$order_id");
        $query2 = mysqli_query($conn, "UPDATE payments SET payment_status='$status' WHERE id=$id");
        if($query && $query2){
            echo "
                <script>
                    alert('Status berhasil di perbaharui');
                    window.location='pembayaran.php'
                </script>
                ";
        }else{
            echo "
                <script>
                    alert('Status gagal diperbaharui');
                </script>
                ";
        }
    }
?>