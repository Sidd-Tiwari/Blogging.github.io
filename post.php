<?php
    include 'config.php';

    if (!isset($_GET['id'])) {
        die('No post ID specified.');
    }

    $post_id = $_GET['id'];

    $sql = "SELECT * FROM posts WHERE id = $post_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $post = $result->fetch_assoc();
    } else {
        die('Post not found.');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $post['title']; ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container">
        <h1 class="my-4"><?php echo $post['title']; ?></h1>
        <?php if($post['image']): ?>
            <img src="uploads/<?php echo $post['image']; ?>" class="img-fluid" alt="<?php echo $post['title']; ?>">
        <?php endif; ?>
        <p><?php echo nl2br($post['content']); ?></p>
        <small class="text-muted">Posted on <?php echo date('F j, Y', strtotime($post['created_at'])); ?></small>

        <h3 class="my-4">Comments</h3>
        <div id="comments">
            <?php
            $comment_sql = "SELECT * FROM comments WHERE post_id = $post_id ORDER BY created_at DESC";
            $comment_result = $conn->query($comment_sql);

            if ($comment_result->num_rows > 0) {
                while ($comment = $comment_result->fetch_assoc()) {
                    echo '<div class="comment mb-3">';
                    echo '<h5>' . $comment['author'] . '</h5>';
                    echo '<p>' . nl2br($comment['comment']) . '</p>';
                    echo '<small class="text-muted">Posted on ' . date('F j, Y', strtotime($comment['created_at'])) . '</small>';
                    echo '</div>';
                }
            } else {
                echo '<p>No comments yet.</p>';
            }
            ?>
        </div>

        
    <h4 class="my-4">Leave a Comment</h4>
    <form action="add_comment.php" method="post">
        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
        <div class="form-group">
            <label for="author">Name:</label>
            <input type="text" class="form-control" id="author" name="author" required>
        </div>
        <div class="form-group">
            <label for="comment">Comment:</label>
            <textarea class="form-control" id="comment" name="comment" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Submit</button>
    </form>

    </div>
    <?php include 'includes/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</body>
</html>