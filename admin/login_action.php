<?php
session_start();
include '../config.php';

$email = $_POST['email'];
$password = $_POST['password'];

$result = $conn->query("SELECT * FROM users WHERE email='$email' AND password='$password'");
$response = [];

if ($result->num_rows > 0) {
    $_SESSION['email'] = $email;
    $response['status'] = 'success';
    $response['message'] = 'Login successful.';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid email or password.';
}

echo json_encode($response);
?>
