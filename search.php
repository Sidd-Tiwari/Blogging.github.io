<?php
    include 'config.php';
    $search_query = $_GET['q'];
    $result = $conn->query("SELECT * FROM posts WHERE title LIKE '%$search_query%' OR content LIKE '%$search_query%' ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Search Results</h1>
        <div id="posts" class="row">
            <?php while($row = $result->fetch_assoc()): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <?php if($row['image']): ?>
                        <img src="uploads/<?php echo $row['image']; ?>" class="card-img-top" alt="<?php echo $row['title']; ?>">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['title']; ?></h5>
                        <p class="card-text"><?php echo substr($row['content'], 0, 200); ?>...</p>
                    </div>
                    <div class="card-footer">
                        <a href="post.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Read More</a>
                        <small class="text-muted float-right">Posted on <?php echo date('F j, Y', strtotime($row['created_at'])); ?></small>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>
