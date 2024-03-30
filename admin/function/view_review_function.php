<?php 
    include "../config/database.php";

    function get_data_review($id){
        global $conn;
        $result = mysqli_query($conn, "SELECT reviews.id as reviews_id, reviews.user_id, reviews.order_id, reviews.title, reviews.review_text, reviews.review_date, reviews.status, orders.* FROM reviews JOIN orders ON reviews.order_id = orders.id WHERE reviews.id = $id");
        $payments = mysqli_fetch_assoc($result);

        return $payments;
    }

    function delete_review($idReview){
        global $conn;
        $query = mysqli_query($conn, "DELETE FROM reviews WHERE id=$idReview");

        if($query){
            echo "
                <script>
                    alert('Review berhasil di hapus');
                    window.location='review.php'
                </script>
                ";
        }else{
            echo "
                <script>
                    alert('Review gagal dihapus');
                </script>
                ";
        }
    }
?>