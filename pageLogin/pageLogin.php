<?php
session_start();
require '../db_config/connection.php'; // Your database connection file

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Query to fetch user based on email
    $query = "SELECT * FROM user WHERE user_email='$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        // Verify password using salt and hashing
        $hashedPassword = hash('sha256', $password . $row['salt']);
        if ($hashedPassword === $row['pass_user']) {
            // Set session variables
            $_SESSION['loggedIn'] = true;
            $_SESSION['username'] = $row['name_user'];
            $_SESSION['user_id'] = $row['id_user']; // Ensure user_id is being set
            $_SESSION['email'] = $row['user_email'];
            $_SESSION['role'] = $row['role']; // Optional, for handling roles

            // Check if 'redirect' parameter is set
    if (isset($_GET['redirect'])) {
        $redirectPage = $_GET['redirect'];
        header("Location: $redirectPage"); // Redirect to the specified page
        exit();
    } else {
        // If no redirect parameter is present, redirect to the default page
        header("Location: ../pageReview/pagePreview.php");
        exit();
    }
            exit;
        } else {
            $error = "Invalid email or password!";
        }
    } else {
        $error = "No user found with that email!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="pageLoginCSS.css" />
    <title>Login Page</title>
</head>
<body>
    <div>
        <div>
            <nav class="header">
                <div class="header-top-1">
                    <div style="display: inline-flex; align-items: center">
                        <span class="material-symbols-outlined">call</span>
                        <span style="font-family: 'SpongeBob', sans-serif; font-weight: bold">
                            334-441-8088
                        </span>
                    </div>
                </div>

                <nav class="navbar navbar-expand-lg">
                    <!-- logo-->
                    <a class="navbar-brand" href="#">
                        <img src="../Image/KrustyLogo.png" style="width: 100px;" class="krusty-logo" />
                    </a>

                    <!-- Navbar links -->
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav align-items-center">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="../pageReview/pagePreview.php">Home</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

            <div class="main-content d-flex justify-content-center align-items-center" id="background">
                <div class="card p-4 shadow-lg" style="width: 30rem; border-radius: 10px;">
                    <form method="POST" class="needs-validation" id="loginForm" novalidate>
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-3 col-form-label text-end">Email Address</label>
                            <div class="col-sm-9">
                                <input type="email" id="email" name="email" class="form-control" placeholder="name@example.com" required />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-3 col-form-label text-end">Password</label>
                            <div class="col-sm-9">
                                <input type="password" id="password" name="password" class="form-control" placeholder="secret" required />
                            </div>
                        </div>
                        <div class="text-center">
                            <button id="submit" type="submit" name="login" class="btn btn-primary w-100">Login</button>
                        </div>
                    </form>
                    <div class="d-flex justify-content-center align-items-center" style="display: flex; flex-direction:column">
                        <div style="flex-direction: column;">
                            Dont have an account?
                        </div>
                        <div>
                            <a href="../pageRegister/pageRegister.html">Register</a>
                        </div>
                    </div>

                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="footer">
                <p>&copy; Krusty Tower. All rights reserved to Mr.Krabs and Nickelodeon.</p>
            </div>
        </div>
    </div>
</body>
</html>
