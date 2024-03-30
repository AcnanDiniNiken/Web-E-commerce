<?php 
    include '../config/database.php';

    $pageSekarang = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    function get_all_review(){
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM reviews");
        $reviews = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $reviews[] = $row;
        }

        return $reviews;
    }

    function get_order_by_id($id){
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM orders WHERE id=$id");
        $orders = mysqli_fetch_assoc($result);
        return $orders;
    }

    function get_limit_review_customer($limit, $offset){
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM reviews LIMIT $limit OFFSET $offset");
        $reviews = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $reviews[] = $row;
        }

        return $reviews;
    }

    function get_customer_by_id($id){
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
        $users = mysqli_fetch_assoc($result);
        return $users;
    }

    function pagination($pageSekarang, $itemsPerPage, $totalReview){
        $config = array(
            'next_link' => '›',
            'prev_link' => '‹',
            'full_tag_open' => '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">',
            'full_tag_close' => '</ul></nav></div>',
            'num_tag_open' => '<li class="page-item"><span class="page-link">',
            'num_tag_close' => '</span></li>',
            'cur_tag_open' => '<li class="page-item active"><span class="page-link">',
            'cur_tag_close' => '<span class="sr-only">(current)</span></span></li>',
            'next_tag_open' => '<li class="page-item"><span class="page-link">',
            'next_tagl_close' => '<span aria-hidden="true">&raquo;</span></span></li>',
            'prev_tag_open' => '<li class="page-item"><span class="page-link">',
            'prev_tagl_close' => '</span>Next</li>',
            'first_tag_open' => '<li class="page-item"><span class="page-link">',
            'first_tagl_close' => '</span></li>',
            'last_tag_open' => '<li class="page-item"><span class="page-link">',
            'last_tagl_close' => '</span></li>'
        );
        
        $pagination = $config['full_tag_open'];

        $totalPages = ceil($totalReview / $itemsPerPage);
    
        if ($pageSekarang > 1) {
            $pagination .= '<li>' . $config['prev_tag_open'] . '<a href="?page=' . ($pageSekarang - 1) . '">' . $config['prev_link'] . '</a>' . '</li>';
        }
    
        for ($i = 1; $i <= $totalPages; $i++) {
            $pagination .= '<li' . ($i == $pageSekarang ? ' class="active"' : '') . '>' . $config['num_tag_open'] . '<a href="?page=' . $i . '">' . $i . '</a>' . $config['num_tag_close'] . '</li>';
        }
    
        if ($pageSekarang < $totalPages) {
            $pagination .= '<li>' . $config['next_tag_open'] . '<a href="?page=' . ($pageSekarang + 1) . '">' . $config['next_link'] . '</a>' . '</li>';
        }
    
        $pagination .= $config['full_tag_close'];
    
        return $pagination;
    }
?>