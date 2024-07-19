$(document).ready(function() {
    $('#loginForm').submit(function(event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'login_action.php',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                $('#loginMessage').html(response.message);
                if (response.status === 'success') {
                    window.location.href = 'index.php';
                }
            }
        });
    });

    $('#postForm').submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'create_post.php',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                $('#postMessage').html(response.message);
                if (response.status === 'success') {
                    $('#postForm')[0].reset();
                    // Reload posts
                    loadPosts();
                }
            }
        });
    });

    function loadPosts() {
        $.ajax({
            url: 'index.php',
            type: 'GET',
            success: function(data) {
                $('#posts').html($(data).find('#posts').html());
                bindDeleteButtons();
            }
        });
    }

    function bindDeleteButtons() {
        $('.delete-post').click(function() {
            var postId = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: 'delete_post.php',
                data: { post_id: postId },
                dataType: 'json',
                success: function(response) {
                    alert(response.message);
                    if (response.status === 'success') {
                        // Reload posts
                        loadPosts();
                    }
                }
            });
        });
    }

    // Initial binding
    bindDeleteButtons();
});
