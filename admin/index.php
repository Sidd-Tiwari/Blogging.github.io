<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/admin_style.css">
</head>
<body>
<div class="container">
    <h2 class="my-4">Admin Dashboard</h2>
    <a href="logout.php" class="btn btn-danger mb-4">Logout</a>
    <a href="create_post.php" class="btn btn-success mb-4">Create New Post</a>

    <h2 class="my-4">Manage Posts</h2>
    <div id="posts" class="row">
        <?php
        include '../config.php';
        $result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
        while($row = $result->fetch_assoc()):
        ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <?php if($row['image']): ?>
                    <img src="../uploads/<?php echo $row['image']; ?>" class="card-img-top" alt="<?php echo $row['title']; ?>">
                <?php endif; ?>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['title']; ?></h5>
                    <p class="card-text"><?php echo substr($row['content'], 0, 200); ?>...</p>
                </div>
                <div class="card-footer">
                    <a href="../post.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Read More</a>
                    <button class="btn btn-danger delete-post" data-id="<?php echo $row['id']; ?>">Delete</button>
                    <small class="text-muted float-right">Posted on <?php echo date('F j, Y', strtotime($row['created_at'])); ?></small>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>
<?php include '../includes/footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="../assets/js/admin_script.js"></script>
</body>
</html>
