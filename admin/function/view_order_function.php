<?php 
    include "../config/database.php";

    function get_data_order_by_id($idOrder){
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM orders WHERE id=$idOrder");
        $orders = mysqli_fetch_assoc($result);
        return $orders;
    }

    function upload_kwitansi($id){
        global $conn;

        $namaFile = $_FILES['kwitansi']['name'];
        $tmpName = $_FILES['kwitansi']['tmp_name'];

        $ekstensiFile = ['jpeg', 'jpg', 'png'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar2 = $ekstensiGambar[1];

        if(!in_array($ekstensiGambar2, $ekstensiFile)){
            echo "<script>
                alert('Ekstensi harus jpeg jpg png');
            </script>";
        }else{
            $namaBaru = 'kwitansi'.time().'.'.$ekstensiGambar2;
            move_uploaded_file($tmpName, "kwitansi/".$namaBaru);
        }

        $query = mysqli_query($conn, "update orders set kwitansi='$namaBaru' where id=$id");

        if($query){
            echo "
                <script>
                    alert('Kwitansi diupload');
                    window.location='view_order.php?id=". $id ."'
                </script>
                ";
        }else{
            echo "
                <script>
                    alert('Kwitansi gagal diuplado');
                </script>
                ";
        }
    }

    function get_order_status($status, $payment)
    {
        if ($payment == 1)
        {
            // Bank
            if ($status == 1)
                return 'Menunggu pembayaran';
            else if ($status == 2)
                return 'Dalam proses';
            else if ($status == 3)
                return 'Dalam pengiriman';
            else if ($status == 4)
                return 'Selesai';
            else if ($status == 5)
                return 'Dibatalkan';
        }
        else if ($payment == 2)
        {
            //COD
            if ($status == 1)
                return 'Dalam proses';
            else if ($status == 2)
                return 'Dalam pengiriman';
            else if ($status == 3)
                return 'Selesai';
            else if ($status == 4)
                return 'Dibatalkan';
        }
    }

    function get_data_items_order($idOrder){
        global $conn;
        $result = mysqli_query($conn, "SELECT order_item.order_id, order_item.product_id, order_item.order_qty, order_item.order_price, produk.* FROM order_item JOIN produk ON order_item.product_id = produk.id WHERE order_id=$idOrder");
        $items = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $items[] = $row;
        }
        return $items;
    }

    function get_data_payment_by_order_id($idOrder){
        global $conn;
        $result = mysqli_query($conn, "SELECT p.id as payment_id, o.id as order_id, p.*, o.* FROM payments p JOIN orders o ON o.id = p.order_id WHERE o.id = $idOrder");
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

    function update_status_order($id, $status){
        global $conn;
        $query = mysqli_query($conn, "UPDATE orders set order_status='$status' WHERE id=$id");
        if($query){
            echo "
                <script>
                    alert('Status berhasil di perbaharui');
                    window.location='order.php'
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

    function konfirmasi_pembayaran($order_id, $id, $action){
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