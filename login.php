<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require('db.php');

// Handle login form submission
if (isset($_POST['login'])) {
    // Get user login data
    $email_username = $_POST['email_username'];
    $password = $_POST['password'];

    // Perform login validation here (e.g., checking against the database)
    // Replace this with your own login validation logic

    // For demonstration purposes, assume login is successful
    $is_login_successful = true;

    if ($is_login_successful) {
        // Set a session variable to indicate that the user is logged in
        $_SESSION['loggedin'] = true;

        // Redirect the user to main.php on successful login
        header("Location: index.php");
        exit;
    } else {
        // If login fails, redirect back to index.php with login_error parameter
        header("Location: index.php?login_error=true");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LOGIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body class="bg-dark">
    <div class="container-fluid mt-3">
        <div class="card" style="height:1000px;">
            <div class="card-header text-center">
                <h1>Welcome my blog</h1>
            </div>
            <div class="card-body">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    
                    <form class="justify-content-end">
                        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) : ?>
                            <button type='button' class='btn btn-success m-1'>Welcome, <?php echo $_SESSION['username']; ?></button>
                        <?php else : ?>
                            <button type='button' class='btn btn-success m-1' data-bs-toggle='modal' data-bs-target='#loginModal'>Login</button>
                            <button type='button' class='btn btn-success m-1' data-bs-toggle='modal' onclick="location.href='register.php'">Register</button>
                        <?php endif; ?>
                    </form>
                </nav>
            </div>
        </div>
        
        <div class="modal fade" id="loginModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="loginModalLabel">Login</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="index.php" method="post">
                        <div class="modal-body">
                            <?php if (isset($_GET['login_error']) && $_GET['login_error'] === 'true') : ?>
                                <div class="alert alert-danger" role="alert">
                                    Login failed. Please try again.
                                </div>
                            <?php endif; ?>
                            <div class="mb-3">
                                <label>Email : </label>
                                <input type="text" name="email_username" class="form-control" placeholder="Email">
                            </div>
                            <div class="mb-3">
                                <label>Password : </label>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" name="login" class="btn btn-primary">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
