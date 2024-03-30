<?php 
    include '../../config/database.php';

    session_start();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $action = isset($_POST['action']) ? $_POST['action'] : '';
    }else{
        $action = isset($_GET['action']) ? $_GET['action'] : '';
    }

    switch ($action) {
        case 'get_user':
            $chats = get_all_user();
            $response = array('data' => $chats);
            break;
        case 'get_user_by_id':
            $id = $_GET['user_id'];
            $user = get_user_by_id($id);
            $response = array('data' => $user);
            break;
        default:
            $response = array('error' => 'Invalid action');
            break;
    }

    header('Content-Type: application/json');
    echo json_encode($response);

    function get_all_user(){
        global $conn;
        $result = mysqli_query($conn, "SELECT DISTINCT c.user_id, u.*  FROM chat c JOIN users u ON c.user_id = u.id WHERE c.user_id != 1");
        $chats = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $chats[] = $row;
        }

        return $chats;
    }

    function get_user_by_id($id){
        global $conn;
        $result = mysqli_query($conn, "SELECT id, name, profile_picture FROM users WHERE id=$id");
        $user = mysqli_fetch_assoc($result);

        return $user;
    }
?>