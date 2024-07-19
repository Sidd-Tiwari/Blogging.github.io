<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container">
    <h2 class="my-4">User Registration</h2>
    <form id="registerForm" action="register_action.php" method="post">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Register</button>
    </form>
    <div id="registerMessage" class="alert mt-3" style="display: none;"></div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('#registerForm').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: 'register_action.php',
                type: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    $('#registerMessage').removeClass('alert-danger').addClass('alert-success').text(response.message).show();
                    setTimeout(function() {
                        window.location.href = 'login.php';
                    }, 2000);
                },
                error: function(xhr, status, error) {
                    $('#registerMessage').removeClass('alert-success').addClass('alert-danger').text('An error occurred: ' + xhr.responseText).show();
                }
            });
        });
    });
</script>
</body>
</html>
