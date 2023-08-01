<?php
require ('db.php');

// Handle registration form submission
if (isset($_POST['register'])) {
    // Get user registration data
    $fullName = $_POST['fullName'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Perform registration logic here (e.g., insert data into the database)
    // Replace this with your own registration logic

    // For demonstration purposes, assume registration is successful
    $is_registration_successful = true;

    if ($is_registration_successful) {
        // Set a session variable to indicate that the user is logged in
        $_SESSION['loggedin'] = true;

        // Redirect the user to main.php on successful registration
        header("Location: main.php");
        exit;
    } else {
        // If registration fails, display an error message
        $registration_error = true;
    }
}

// Handle login form submission
if (isset($_POST['login'])) {
    // Perform login validation here (e.g., checking against the database)
    // Replace this with your own login validation logic

    // For demonstration purposes, assume login is successful
    $is_login_successful = true;

    if ($is_login_successful) {
        // Set a session variable to indicate that the user is logged in
        $_SESSION['loggedin'] = true;

        // Redirect the user to main.php on successful login
        header("Location: main.php");
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
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body class="bg-dark">
    <div class="container-fluid mt-3">
        <div class="card" style="height:590px;">
            <div class="card-header text-center">
                <h1>Welcome my blog</h1>
            </div>
            <div class="card-body">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <form class="justify-content-end">

                    
                        <button type='button' class='btn btn-danger m-1' data-bs-toggle='modal' data-bs-target='#RegisterModal'>Register</button>
                    
                    </form>
                </nav>
                  
            </div>
        </div>
        <div class="modal fade" id="RegisterModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="RegisterModalLabel">Register</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="registration.php" method="post">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Full Name : </label>
                                <input type="text" name="fullName" class="form-control" placeholder="Full Name">
                            </div>

                            <div class="mb-3">
                                <label>User Name : </label>
                                <input type="text" name="username" class="form-control" placeholder="User Name">
                            </div>

                            <div class="mb-3">
                                <label>Email : </label>
                                <input type="email" name="email" class="form-control" placeholder="Email">
                            </div>

                            <div class="mb-3">
                                <label>Password : </label>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" name="register" class="btn btn-primary">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
