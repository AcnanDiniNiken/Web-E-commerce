<?php 
    include '../config/database.php';

    session_start();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $action = isset($_POST['action']) ? $_POST['action'] : '';
    }else{
        $action = isset($_GET['action']) ? $_GET['action'] : '';
    }

    switch ($action) {
        case 'get_chat':
            $chats = get_all_chat($_SESSION['customer']['id']);
            $response = array('data' => $chats);
            break;
        case 'send_chat':
            send_message($_SESSION['customer']['id']);
            $chats = get_all_chat($_SESSION['customer']['id']);
            $response = array('data' => $chats);
            break;
        default:
            $response = array('error' => 'Invalid action');
            break;
    }

    header('Content-Type: application/json');
    echo json_encode($response);

    function get_all_chat($user_id){
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM chat WHERE user_id = $user_id");
        $chats = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $chats[] = $row;
        }

        return $chats;
    }

    function send_message($id){
        global $conn;
        $text = $_POST['text'];
        $date = date('Y-m-d H:i:s');
        mysqli_query($conn, "INSERT INTO chat(text, date, type, user_id) VALUES ('$text', '$date', 'customer', $id)");
    }
?>