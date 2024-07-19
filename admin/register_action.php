<?php
include 'config.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
$response = [];

if ($conn->query($sql) === TRUE) {
    $response['status'] = 'success';
    $response['message'] = 'Registration successful. Redirecting to login page...';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Error: ' . $sql . '<br>' . $conn->error;
}

echo json_encode($response);
?>