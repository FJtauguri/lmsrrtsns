<!-- PHP START -->
<?php

session_start();

include('../database/connection.php');

if (isset($_POST['login'])) {
    $username = htmlentities($_POST['username']);
    $password = htmlentities($_POST['password']);

    $stmt = mysqli_prepare($con, "SELECT * FROM admin WHERE username=?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        // Verify password
        if ($row && password_verify($password, $row['password'])) {
            $_SESSION['id'] = $row['admin_id'];
            // $_SESSION['admin_type'] = 'Super Admin';

            if ($row['admin_type'] === 'Super Admin') {
                $_SESSION['admin_type'] = 'Super Admin';
                header("Location: users/super_admin/index.php");
                exit();
            } else {
                $_SESSION['admin_type'] = 'Adviser';
                header("Location: users/admin/index.php");
                exit();
            }
        } else { ?>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-12">
                        <div class="alert alert-danger text-center mt-3">
                            <h3 class="blink_text">Access Denied</h3>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        echo "Error: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
}

?>
<!-- PHP END -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RRTNS</title>

    <!-- ------------------------------------------- -->
    <!-- -------------ASSETS FILES------------------ -->
    <!-- ------------------------------------------- -->

    <!-- LOCAL CSS -->
    <link rel="stylesheet" href="assets/css/login.css">

    <!-- CDN Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

</head>

<body>

    <!-- Main Body Start -->

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box"
                style="background: #103cbe;">
                <div class="featured-image mb-3">
                    <img src="image/local_image/books.png" class="img-fluid" style="width: 250px;">
                </div>
                <p class="text-white fs-4 text-center"
                    style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">
                    R. Tangson Sr. National High School's Library
                </p>
                <small class="text-white text-wrap text-center"
                    style="width: 17rem;font-family: 'Courier New', Courier, monospace;">
                    Unlock a world of insights.
                </small>
            </div>

            <!-- RIGHT -->
            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2>Hola! <b>Admin</b> </h2>
                        <p>Sign in to discover the gems within our digital bookshelves.</p>
                    </div>
                    <form method="post">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-lg bg-light fs-6" name="username"
                                maxlength="12" placeholder="username">
                        </div>
                        <div class="input-group mb-1">
                            <input type="password" class="form-control form-control-lg bg-light fs-6" name="password"
                                maxlength="8" placeholder="Password">
                        </div>
                        <div class="input-group mb-5 d-flex justify-content-between">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="formCheck">
                                <label for="formCheck" class="form-check-label text-secondary">
                                    <small>Remember Me</small>
                                </label>
                            </div>
                            <div class="forgot">
                                <small><a href="#">Forgot Password?</a></small>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <button class="btn btn-lg btn-primary w-100 fs-6" ype="submit" name="login">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Body End -->


    <!-- ------------------------------------------- -->
    <!-- -------------ASSETS FILES------------------ -->
    <!-- ------------------------------------------- -->

    <!-- LOCAL JS -->
    <script src="assets/js/main_footer.js"></script>

    <!-- CDN BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

</body>

</html>