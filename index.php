<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogging Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    
<h1 class="p-2 fw-bold text-center text-uppercase text-light bg-dark"><span class="text-danger">b</span><span class="text-warning">l</span><span class="text-success">o</span><span class="text-primary">g</span> <span class="text-danger">p</span><span class="text-warning">o</span><span class="text-success">s</span><span class="text-primary">t</span></h1><hr>
<div class="container">
    <div id="posts" class="row">
        <?php
        include 'config.php';
        $result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
        while($row = $result->fetch_assoc()):
        ?>
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
<?php include 'includes/footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="assets/js/script.js"></script>
</body>
</html>
