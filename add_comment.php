<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = $_POST['post_id'];
    $author = $_POST['author'];
    $comment = $_POST['comment'];

    $sql = "INSERT INTO comments (post_id, author, comment, created_at) VALUES ('$post_id', '$author', '$comment', NOW())";

    if ($conn->query($sql) === TRUE) {
        header("Location: post.php?id=$post_id");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    header("Location: index.php");
}
?>
