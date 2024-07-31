<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header('Location: login.php');
    }

    include '../config.php';

    $post_id = $_POST['post_id'];
    $response = [];

    $sql = "DELETE FROM posts WHERE id = $post_id";

    if ($conn->query($sql) === TRUE) {
        $response['status'] = 'success';
        $response['message'] = 'Post deleted successfully.';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error: ' . $conn->error;
    }

    echo json_encode($response);
?>
