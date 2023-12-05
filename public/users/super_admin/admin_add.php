<?php
include('../../../database/connection.php');

// Fetch sections from the grade_section table
$query = mysqli_query($con, "SELECT * FROM grade_section");
$sections = mysqli_fetch_all($query, MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = mysqli_real_escape_string($con, $_POST['first-name']);
    $middlename = mysqli_real_escape_string($con, $_POST['middle-name']);
    $lastname = mysqli_real_escape_string($con, $_POST['last-name']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $grade_lvl = isset($_POST['flexRadioDefault']) ? intval($_POST['flexRadioDefault']) : 0; 


    $sections_array = isset($_POST['sections']) ? $_POST['sections'] : [];
    $section = implode(', ', $sections_array);

    $result = mysqli_query($con, "SELECT * FROM admin WHERE username='$username'");
    $row = mysqli_num_rows($result);

    if ($row > 0) {
        echo "<script>alert('Username already taken!'); window.location='add_admin.php'</script>";
    } else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $profile = $_FILES["image"]["name"];

        if (!empty($profile)) {
            move_uploaded_file($_FILES["image"]["tmp_name"], "upload/" . $_FILES["image"]["name"]);
        }

        mysqli_query($con, "INSERT INTO admin (firstname, middlename, lastname, username, password, admin_image, admin_type, admin_added, grade_lvl, section)
            VALUES ('$firstname', '$middlename', '$lastname', '$username', '$hashed_password', '$profile', 'Adviser', NOW(), '$grade_lvl', '$section')") or die(mysqli_error());

        echo "<script>alert('Account successfully added!'); window.location='admin.php'</script>";
    }
}

?>

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

    <link rel="stylesheet" href="../../assets/css/profile.css">

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
                <!-- TABLE START-->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <div class="container d-flex pb-3"
                                style="list-style: none; justify-content: space-between;">
                                <li>
                                    <p class="fs-5 justify-content-center align-item-center">
                                        <a href="students.php"><span class="material-icons">arrow_back_ios</span></a>
                                        Teacher
                                    </p>
                                </li>

                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <!-- content starts here -->

                            <div class="container">
                                <div class="row">
                                    <div class="col-5">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="col-12 " id="left">
                                                <p class="fs-5 p-3">
                                                    <b>
                                                    Personal Information
                                                    </b>
                                                </p>
                                                <div class="row p-3" id="left-profile">
                                                    <div class="col-12" id="username">
                                                        <label for="username">Username: </label>
                                                        <input type="text" name="username" id="username">
                                                    </div>
                                                    
                                                    <div class="col-12" id="password">
                                                        <label for="password">Password: </label>
                                                        <input type="password" name="password" id="password">
                                                    </div>
                                                                                                    
                                                    <div class="col-12" id="first-name">
                                                        <label for="first-name">First Name: </label>
                                                        <input type="text" name="first-name" id="first-name">
                                                    </div>
                                                                                                    
                                                    <div class="col-12" id="middle-name">
                                                        <label for="middle-name">Middle Name: </label>
                                                        <input type="text" name="middle-name" id="middle-name">
                                                    </div>
                                                                                                    
                                                    <div class="col-12" id="last-name">
                                                        <label for="last-name">Last Name: </label>
                                                        <input type="text" name="last-name" id="last-name">
                                                    </div>
                                                                                                
                                                    <!-- grade level -->
                                                    <div class="col-12" id="grade">
                                                        <label for="grade_box">Grade: </label>
                                                        <div class="container" id="grade_box">
                                                        <?php
                                                            for ($i = 7; $i <= 12; $i++) {
                                                                ?>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault<?php echo $i; ?>" value="<?php echo $i; ?>">
                                                                    <label class="form-check-label" for="flexRadioDefault<?php echo $i; ?>">
                                                                        <?php echo $i; ?>
                                                                    </label>
                                                                </div>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>

                                                    <!-- section -->
                                                    <div class="col-12" id="section">
                                                        <label for="section_box">Section: </label>
                                                        <div class="container" id="section_box">
                                                            <?php foreach ($sections as $section): ?>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="sections[]" value="<?php echo $section['section_name']; ?>" id="flexCheck<?php echo $section['id']; ?>">
                                                                <label class="form-check-label" for="flexCheck<?php echo $section['id']; ?>">
                                                                    <?php echo $section['section_name']; ?>
                                                                </label>
                                                            </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                                                                    
                                                    <div class="col-12" id="image">
                                                        <label for="image">Profile: </label>
                                                        <input type="file" name="image" id="imageview">
                                                    </div>
                                                    <button class="btn btn-primary" type="submit" name="submit">
                                                        Add
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-7">
                                       <div class="image container" id="masterlists">
                                            <p class="fs-6"><b>Lists of Teachers</b></p>
                                            
                                            <!-- table here bro -->

                                            <div class="table-responsive">
                                                <table cellpadding="0" cellspacing="0"
                                                    class="table table-striped table-bordered" id="example">

                                                    <thead>
                                                        <tr>
                                                            <th>Full Name</th>
                                                            <th>Grade Cover</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php
                                                            $result = mysqli_query($con, "select * from admin WHERE admin_type='Adviser' order by admin_id ASC") or die(mysqli_error());
                                                            while ($row = mysqli_fetch_array($result)) {
                                                                $id = $row['admin_id'];                                            
                                                        ?>
                                                            <tr>
                                                                
                                                                <td style="word-wrap: break-word; width: 10em;">
                                                                    <?php echo $row['firstname'] . " " . $row['middlename'] . " " . $row['lastname']; ?>
                                                                </td>
                                                                <td class="fs-6" style="word-wrap: break-word; width: 10em;">
                                                                    <?php echo $row['grade_lvl'] . " " . "'" . $row['section'] . "'"; ?>
                                                                </td>
                                                            </tr>
                                                            <?php } ?>
                                                        
                                                    </tbody>

                                                </table>
                                            </div>

                                            <!-- end of table here bro -->

                                       </div>
                                    </div>
                                </div>
                            </div>

                            <!-- content ends here -->
                        </div>
                    </div>
                </div>
                <!-- TABLE END -->
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


    <!------------------------------------------- DATATABLES ------------------------------------------->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>

    <!-- DataTables JavaScript -->
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <!-- DataTables Button CSS and JavaScript (for search functionality) -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/2.1.1/css/buttons.dataTables.min.css">
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'searchPanes',
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: ':visible:not(.no-export)'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':visible:not(.no-export)'
                        }
                    }
                ]
            });
        });
    </script>

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