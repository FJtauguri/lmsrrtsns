<!-- baka -->
<?php
include('../../../database/connection.php');

// account setting
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['submitProfile'])) {
        $admin_id = $_SESSION['id'];

        $firstname = mysqli_real_escape_string($con, $_POST['fname']);
        $middlename = mysqli_real_escape_string($con, $_POST['mname']);
        $lastname = mysqli_real_escape_string($con, $_POST['lname']);

        if (isset($_FILES['image'])) {
            $targetDirectory = "upload/";
            $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {

                if ($_FILES["image"]["size"] > 5000000) {
                    echo "Sorry, your file is too large.";
                } else {

                    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
                    if (in_array($imageFileType, $allowedExtensions)) {

                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {

                            $insertQuery = "UPDATE admin SET ";
                            $params = array();

                            if (!empty($firstname)) {
                                $insertQuery .= "firstname = ?, ";
                                $params[] = $firstname;
                            }

                            if (!empty($middlename)) {
                                $insertQuery .= "middlename = ?, ";
                                $params[] = $middlename;
                            }

                            if (!empty($lastname)) {
                                $insertQuery .= "lastname = ?, ";
                                $params[] = $lastname;
                            }

                            if (!empty($targetFile)) {
                                $insertQuery .= "admin_image = ?, ";
                                $params[] = $targetFile;
                            }

                            $insertQuery = rtrim($insertQuery, ', ') . " WHERE admin_id = ?";
                            $params[] = $admin_id;
                            $stmt = mysqli_prepare($con, $insertQuery);

                            if ($stmt) {
                                mysqli_stmt_bind_param($stmt, str_repeat('s', count($params)), ...$params);
                                $result = mysqli_stmt_execute($stmt);

                                if ($result) {
                                    header('Location: account_setting.php');
                                } else {
                                    echo "Error updating profile: " . mysqli_error($con);
                                }

                                mysqli_stmt_close($stmt);
                            } else {
                                echo "Error in preparing the statement: " . mysqli_error($con);
                            }
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    } else {
                        echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
                    }
                }
            } else {
                echo "File is not an image.";
            }
        } else {
            echo "Image file not provided.";
        }
    } elseif (isset($_POST['submitChangePwd'])) {
        // Handle password change form blabla
        $current_password = mysqli_real_escape_string($con, $_POST['current_password']);
        $new_password = mysqli_real_escape_string($con, $_POST['password']);
        $repassword = mysqli_real_escape_string($con, $_POST['repassword']);

        if (isset($_SESSION['id'])) {
            $admin_id = $_SESSION['id'];

            // Fetch hashed password from the 'admin' table
            $query = "SELECT password FROM admin WHERE admin_id = ?";
            $stmt = mysqli_prepare($con, $query);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 'i', $admin_id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) > 0) {
                    mysqli_stmt_bind_result($stmt, $hashed_password);
                    mysqli_stmt_fetch($stmt);

                    // Verify if current_password matches the hashed_password
                    if (password_verify($current_password, $hashed_password)) {
                        // Check if the new password and confirm password match
                        if ($new_password === $repassword) {
                            // Hash the new password
                            $hashed_new_password = password_hash($new_password, PASSWORD_BCRYPT);

                            // Update the password in the 'admin' table
                            $update_query = "UPDATE admin SET password = ? WHERE admin_id = ?";
                            $update_stmt = mysqli_prepare($con, $update_query);

                            if ($update_stmt) {
                                mysqli_stmt_bind_param($update_stmt, 'si', $hashed_new_password, $admin_id);
                                $result = mysqli_stmt_execute($update_stmt);

                                if ($result) {
                                    header('Location: account_setting.php');
                                } else {
                                    echo "Error updating password: " . mysqli_error($con);
                                }

                                mysqli_stmt_close($update_stmt);
                            } else {
                                echo "Error in preparing the update statement: " . mysqli_error($con);
                            }
                        } else {
                            echo "New password and confirm password do not match!";
                        }
                    } else {
                        echo "Current password is incorrect!";
                    }
                } else {
                    echo "Admin not found!";
                }

                mysqli_stmt_close($stmt);
            } else {
                echo "Error in preparing the statement: " . mysqli_error($con);
            }
        }
    } else {
        echo "Invalid Action";
    }
}

?>
<!-- bakaEND -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>R. Tangson Sr. National High School's Library</title>

    <!-- ------------------------------------------- -->
    <!-- -------------ASSETS FILES------------------ -->
    <!-- ------------------------------------------- -->

    <!-- LOCAL CSS -->
    <link rel="stylesheet" href="../../assets/css/users.css">

    <!-- CDN Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- LOCAL CDN Bootrap CSS -->
    <link rel="stylesheet" href="../../assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../assets/css/datatable/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="../../assets/css/datatable/select.dataTables.min.css">

    <!-- CDN Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- CDN Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">

    <!-- custom ng mga tamad -->
    <style>

    </style>

</head>

<body class="wrapper">

    <!-- Main Body Start -->

    <div class="body-overlay"></div>

    <!-------------------------sidebar------------>
    <!-- Sidebar  -->
    <?php include("navbar.php") ?>

    <!--------page-content---------------->

    <div id="content">
        <div class="top-navbar">
            <?php include("topbar.php") ?>
            <div class="xp-breadcrumbbar text-center">
                <!-- <h4 class="page-title">Dashboard</h4> -->
                <ol class="breadcrumb mb-1 text-white">
                    <li class="breadcrumb-item"><a href="#">RRTSNS</a></li>
                    <li class="breadcrumb-item active" aria-current="page">PROFILE</li>
                </ol>
            </div>
        </div>

        <!--------main-content------------->

        <div class="main-content">
            <div class="row">
                <div class="container mb-3">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12" style="display: grid; align-items: center;">
                            <div class="d-flex row">
                                <!-- left -->
                                <form method="post" enctype=multipart/form-data class="w-100 col-md-6 col-sm-12"
                                    style="" id="profileForm">
                                    <!-- LEFT -->
                                    <div class="col-md-6 col-sm-12">
                                        <div class="mb-3">
                                            <h3>Personal Information</h3>
                                        </div>
                                        <div class="mb-3 current-password">
                                            <label class="m-0" for="fname">First Name</label>
                                            <input id="first_name" type="text" name="fname" class="form-control"
                                                maxlength="50">
                                        </div>
                                        <div class="mb-3 current-password">
                                            <label class="m-0" for="mname">Middle Name</label>
                                            <input id="middle_name" type="text" name="mname" class="form-control"
                                                maxlength="1">
                                        </div>
                                        <div class="mb-3 current-password">
                                            <label class="m-0" for="lname">Last Name</label>
                                            <input id="last_name" type="text" name="lname" class="form-control"
                                                maxlength="50">
                                        </div>
                                        <div class="mb-3 current-password">
                                            <label class="m-0" for="image">Profile Image</label>
                                            <input id="profile_image" type="file" name="image" class="form-control">
                                        </div>
                                        <button class="mt-4 btn btn-sm btn-block btn-outline-primary"
                                            style="margin: 2rem 0 0 0;" name="submitProfile">Confirm
                                        </button>
                                    </div>
                                </form>

                                <!-- right -->
                                <form method="post" class="w-100 col-md-6 col-sm-12" style="" id="passwordForm">
                                    <!-- RIGHT -->
                                    <div class="col-md-6 col-sm-12" style="display: grid; justify-content: center;">
                                        <div class="col-6" style="justify-items: center; ">
                                            <div class="mb-3">
                                                <h3>Change Password</h3>
                                            </div>
                                            <div class="mb-3 current-password" style="width: 200px;">
                                                <label class="m-0" for="current_password">Current
                                                    Password</label>
                                                <input id="current_password" type="text" name="current_password"
                                                    class="form-control">
                                            </div>
                                            <div class="mb-3 new-password" style="width: 200px;">
                                                <label class="m-0 mt-4" for="password">Password</label>
                                                <input id="password" type="text" name="password" class="form-control"
                                                    maxlength="8">
                                            </div>
                                            <div class="mb-3 new-repassword" style="width: 200px;">
                                                <label class="m-0 mt-4" for="repassword">Confirm
                                                    Password</label>
                                                <input id="repassword" type="text" name="repassword"
                                                    class="form-control" maxlength="8">
                                                <p id="password-error" class="error-message"></p>
                                            </div>
                                            <button class="mt-4 btn btn-sm btn-block btn-outline-primary"
                                                style="margin: 2rem 0 0 0; width: 200px;" name="submitChangePwd">Confirm
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- FOOTER -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="footer-in">
                        <p class="mb-0">&copy 2023 RRTSNS - All Rights Reserved.</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Main Body End -->



    <!-- ------------------------------------------- -->
    <!-- -------------ASSETS FILES------------------ -->
    <!-- ------------------------------------------- -->

    <!-- LOCAL JS -->
    <script src="../../assets/js/main_footer.js"></script>
    <script src="../../assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="../../assets/js/popper.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../../assets/js/ham.js"></script>
    <script src="../../assets/js/author_limit.js"></script>
    <script src="../../assets/js/search.js"></script>

    <!-- CDN BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

    <!-- Password sync -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var password = document.getElementById('password');
            var repassword = document.getElementById('repassword');
            var passwordError = document.getElementById('password-error');

            repassword.addEventListener('input', function () {
                if (password.value !== repassword.value) {
                    passwordError.textContent = 'Passwords do not match';
                    passwordError.style.color = 'red'
                } else {
                    passwordError.textContent = 'Nice move!';
                    passwordError.style.color = 'blue';
                }
            });
        });
    </script>

    <!-- Password and Button handler -->
    <script>
        $(document).ready(function () {
            $("#repassword").on("input", function () {
                var password = $("#password").val();
                var confirmPassword = $("#repassword").val();
                var passwordError = $("#password-error");

                if (password !== confirmPassword) {
                    passwordError.text("Passwords do not match");
                    $("button[type='submit']").prop("disabled", true);
        echo 'we';
                } else {
                    passwordError.text("Nice move!");
                    $("button[type='submit']").prop("disabled", false);
                }
            });
        });
    </script>


</body>

</html>

</body>

</html>