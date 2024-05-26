<?php require 'includes/header.php'; ?>

<div class="container d-flex justify-content-center align-items-center min-vh-100 mx-auto">
    <div class="d-flex flex-column w-50 p-5 rounded-3 shadow-sm">
        <h2>Login</h2>
        <!-- <form action="" method="post"> -->
        <div class="mb-3">
            <label class="label" for="">Username</label>
            <input class="form-control" type="text" name="username" id="username">
        </div>
        <div class="mb-3">
            <label class="label" for="">Password</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>
        <input class="btn btn-success w-100" type="submit" id="btn-login" value="LOGIN">
        <!-- </form> -->
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#btn-login').click(function() {
            var username = $('#username').val()
            var password = $('#password').val()

            $.ajax({
                url: 'controllers/login_check.php',
                type: 'POST',
                data: {
                    username: username,
                    password: password
                },
                success: function(response) {
                    if (response == 'success') {
                        window.location.href = 'index.php'
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Login failed:', textStatus, errorThrown);
                }
            });
        })
    })
</script>

<?php require 'includes/footer.php' ?>