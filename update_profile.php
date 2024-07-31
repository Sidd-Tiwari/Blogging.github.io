<?php
    session_start();
    include 'config.php';

    $name = $_POST['name'];
    $email = $_POST['email'];
    $user_id = $_SESSION['user_id'];

    $sql = "UPDATE users SET name='$name', email='$email' WHERE id='$user_id'";
    $response = [];

    if ($conn->query($sql) === TRUE) {
        $response['status'] = 'success';
        $response['message'] = 'Profile updated successfully.';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error: ' . $sql . '<br>' . $conn->error;
    }

    echo json_encode($response);
?>
