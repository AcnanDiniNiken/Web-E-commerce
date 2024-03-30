<?php 
    include "../config/database.php";

    $pageSekarang = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    function get_all_categories() {
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM kategori");
        $categories = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = $row;
        }
        return $categories;
    }
    
    function get_all_product() {
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM produk");
        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
        return $products;
    }

    function get_limit_product($limit, $offset) {
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM produk LIMIT $limit OFFSET $offset");
        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
        return $products;
    }

    function get_product_by_id($id) {
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM produk WHERE id=$id");
        $products = mysqli_fetch_assoc($result);
        return $products;
    }

    function category_data($id) {
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM kategori WHERE id=$id");
        $categories = mysqli_fetch_assoc($result);
        return $categories;
    }

    function get_all_order_produk($id){
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM order_item WHERE product_id=$id");
        $orders = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $orders[] = $row;
        }
        return $orders;
    }

    function get_order_by_id($id){
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM orders WHERE id=$id");
        $orders = mysqli_fetch_assoc($result);
        return $orders;
    }

    function get_user_by_id($id){
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
        $users = mysqli_fetch_assoc($result);
        return $users;
    }

    function pagination($pageSekarang, $itemsPerPage, $totalProducts){
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

        $totalPages = ceil($totalProducts / $itemsPerPage);
    
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

    function add_new_product(){
        global $conn;

        $kategori = $_POST['category_id'];
        $nama = $_POST['name'];
        $harga = $_POST['price'];
        $stock = $_POST['stock'];
        $unit = $_POST['unit'];
        $deskripsi = $_POST['descript'];

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
            $namaBaru = 'produk'.time().'.'.$ekstensiGambar2;
            move_uploaded_file($tmpName, "produk_gambar/".$namaBaru);
        }

        $sku = create_product_sku($nama, $kategori, $harga, $stock);

        $query = mysqli_query($conn, "insert into produk(category_id, sku, name, descript, picture_name, price, stock, product_unit, add_date) values 
                                            ($kategori, '$sku', '$nama', '$deskripsi', '$namaBaru', $harga, $stock, $unit, current_timestamp())");

        if($query){
            echo "
                <script>
                    alert('Produk berhasil di tambahkan');
                    window.location='produk.php'
                </script>
                ";
        }else{
            echo "
                <script>
                    alert('Produk gagal ditambahkan');
                </script>
                ";
        }
    }

    function create_product_sku($name, $category, $price, $stock) {
        $name = create_acronym($name);
        $category = create_acronym($category);
        $price = create_acronym($price);
        $stock = $stock;
        $key = substr(strval(time()), -3);
    
        $sku = $name . $category . $price . $stock . $key;
        return $sku;
    }
    
    function create_acronym($words) {
        $words = explode(' ', $words);
        $acronym = '';
    
        foreach ($words as $word) {
            $acronym .= $word[0];
        }
    
        $acronym = strtoupper($acronym);
    
        return $acronym;
    }

    function count_percent_discount($discount, $from, $num = 1)
    {
        $count = ($discount / $from) * 100;
        $count = number_format($count, $num);

        return $count;
    }

    function edit_product($id){
        global $conn;

        $kategori = $_POST['category_id'];
        $nama = $_POST['name'];
        $harga = $_POST['price'];
        $stock = $_POST['stock'];
        $unit = $_POST['unit'];
        $deskripsi = $_POST['descript'];
        $discount = $_POST['price_discount'];
        
        if (!($_FILES['picture']['error'] == 4 || ($_FILES['picture']['size'] == 0 && $_FILES['picture']['error'] == 0))){
            $query = "SELECT picture_name FROM produk WHERE id = $id";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $data = mysqli_fetch_assoc($result);
                $picture_name = $data['picture_name'];
                $file = 'produk_gambar/' . $picture_name;

                if (file_exists($file) && is_readable($file) && unlink($file)) {
                    $query = "UPDATE produk SET picture_name=null WHERE id = $id";
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
                $namaBaru = 'produk'.time().'.'.$ekstensiGambar2;
                move_uploaded_file($tmpName, "produk_gambar/".$namaBaru);
            }

            $query = mysqli_query($conn, "UPDATE produk SET category_id=$kategori, name='$nama', price=$harga, stock=$stock, product_unit=$unit, descript='$deskripsi', current_discount=$discount, picture_name='$namaBaru' WHERE id=$id");
        }

        $query = mysqli_query($conn, "UPDATE produk SET category_id=$kategori, name='$nama', price=$harga, stock=$stock, product_unit=$unit, descript='$deskripsi', current_discount=$discount WHERE id=$id");

        if($query){
            echo "
                <script>
                    alert('Produk berhasil di ubah');
                    window.location='produk.php'
                </script>
                ";
        }else{
            echo "
                <script>
                    alert('Produk gagal diubah');
                </script>
                ";
        }
    }
?>

