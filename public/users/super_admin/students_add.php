<!-- baka -->
<?php
include('../../../database/connection.php');
$ID = isset($_GET['cn']) ? $_GET['cn'] : null;
// echo "ID: $ID";

// Fetch sections from the grade_section table
$query = mysqli_query($con, "SELECT * FROM grade_section");
$sections = mysqli_fetch_all($query, MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        $school_number = mysqli_real_escape_string($con, $_POST['school_number']);
        $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
        $middlename = mysqli_real_escape_string($con, $_POST['middlename']);
        $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
        $contact = mysqli_real_escape_string($con, $_POST['contact']);
        $gender = mysqli_real_escape_string($con, $_POST['gender']);
        $address = mysqli_real_escape_string($con, $_POST['address']);
        $type = mysqli_real_escape_string($con, $_POST['type']);
        $level = mysqli_real_escape_string($con, $_POST['level']);
        $section = mysqli_real_escape_string($con, $_POST['sections']);

        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $user_image = $_FILES['image']['name'];
            $uploadDir = "../../image/uploadz/";

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $uploadDir . $user_image)) {
            } else {
                echo "Error uploading file.";
                exit();
            }
        } else {
            // ../../image/local_image/picture.jpg
            $user_image = "../../image/local_image/picture.jpg";
        }

        $default_password = "default1";
        $password = mysqli_real_escape_string($con, $default_password);
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $result = mysqli_prepare($con, "
            INSERT INTO user 
            (
                school_number, firstname, middlename, lastname, contact, gender, address, type, level, section, user_image, password, status, user_added
            )
            VALUES
            (
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Offline', NOW()
            )
        ");
        mysqli_stmt_bind_param($result, "ssssssssssss", $school_number, $firstname, $middlename, $lastname, $contact, $gender, $address, $type, $level, $section, $user_image, $hashed_password);
        mysqli_stmt_execute($result);
        mysqli_stmt_close($result);

        echo "<script>alert('User successfully added!'); window.location='students_add.php</script>";
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
    <link rel="stylesheet" href="../../assets/css/profile.css">

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
                <ol class="breadcrumb mb-1 text-white">
                    <li class="breadcrumb-item"><a href="#">RRTSNS</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ADD STUDENT</li>
                </ol>
            </div>
        </div>

        <!--------main-content------------->

        <div class="main-content">
            <a href="students.php"><span class="material-icons">arrow_back_ios</span></a>
            <div class="row">
                <div class="col-5">
                    <?php
                    $query = mysqli_query($con, "select * from user where user_id='$ID'") or die(mysqli_error());
                    $row = mysqli_fetch_array($query);
                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="col-12 " id="left">
                            <p class="fs-5 p-3">
                                <b>
                                    Personal Information
                                </b>
                            </p>
                            <div class="row p-3" id="left-profile">
                            
                                <!-- Type hidded -->
                                <input type="text" name="type" id="type" value="Student" hidden>

                                <div class="col-12" id="username">
                                    <label for="username">SCHOOL_ID: </label>
                                    <input type="number" name="school_number" id="username" value="" maxlength="12">
                                </div>

                                <div class="col-12" id="first-name">
                                    <label for="first-name">First Name: </label>
                                    <input type="text" name="firstname" id="first-name" value="">
                                </div>

                                <div class="col-12" id="middle-name">
                                    <label for="middle-name">Middle Name: </label>
                                    <input type="text" name="middlename" id="middle-name" value="">
                                </div>

                                <div class="col-12" id="last-name">
                                    <label for="last-name">Last Name: </label>
                                    <input type="text" name="lastname" id="last-name" value="">
                                </div>

                                <div class="col-12" id="last-name">
                                    <label for="last-name">Contact Number: </label>
                                    <input type="text" name="contact" id="last-name" value="">
                                </div>

                                <div class="col-12" id="address">
                                    <label for="address">Address: </label>
                                    <input type="text" name="address" id="address" value="">
                                </div>



                                <!-- geneer -->
                                <div class="col-12" id="studgrade" style="margin: 0; display: flex; justify-content: space-between;">
                                    <label for="grade_box">Gender: </label>
                                    <select name="gender" class="form-control"
                                        tabindex="-1" style="width: 189px;">
                                        <option value=""></option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>

                                <!-- grade level -->
                                <div class="col-12" id="studgrade" style="margin: 0; display: flex; justify-content: space-between;">
                                    <label for="grade_box">Grade: </label>
                                    <select name="level" class="form-control"
                                        tabindex="-1" style="width: 189px;">
                                        <?php
                                        for ($i = 7; $i <= 12; $i++) {
                                            ?>
                                                <option value="">
                                                </option>
                                                <option value="<?php echo $i; ?>">
                                                    <?php echo $i; ?>
                                                </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <!-- section -->
                                <div class="col-12" id="studsection" style="margin: 0; display: flex; justify-content: space-between;">
                                    <label for="section">Section: </label>
                                    <!-- <div class="col"> -->
                                        <select name="sections" class="form-control" tabindex="-1" style="width: 189px;">
                                            <?php foreach ($sections as $section): ?>
                                                <option value="">
                                                    
                                                </option>
                                                <option value="<?php echo $section['section_name']; ?>">
                                                    <?php echo $section['section_name']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    <!-- </div> -->
                                </div>

                                
                                <div class="col-12" id="studimage">
                                    <label for="image">Profile: </label>
                                    <input type="file" name="image" id="imageview">
                                </div>

                                <!-- for account setup -->
<!-- 
                                <p class="fs-5 p-3 mt-3" style="border-top: 1px solid #000; ">
                                    <b>
                                        Account Setup
                                    </b>
                                </p>

                                <div class="col-12" id="username">
                                    <label for="username">Passoword: </label>
                                    <input type="text" name="password" id="password" value="" maxlength="8">
                                </div> -->

                                <div class="col-12 mt-3" id="but">
                                    <button class="btn btn-primary container" type="submit" name="submit">
                                        Add
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- right side-->
                <div class="col-7">
                    <div class="image container" id="masterlists">
                        <p class="fs-6"><b>Lists of Students</b></p>

                        <!-- table here bro -->

                        <div class="table-responsive">
                            <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered"
                                id="example">

                                <thead>
                                    <tr>
                                        <th>LRN</th>
                                        <th>Full Name</th>
                                        <th>Grades</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $result = mysqli_query($con, "select * from user WHERE type='student' order by user_id ASC") or die(mysqli_error());
                                    while ($row = mysqli_fetch_array($result)) {
                                        $id = $row['user_id'];
                                        ?>
                                            <tr>
                                                <td class="fs-6" style="word-wrap: break-word; width: 10em;">
                                                    <?php echo $row['school_number']; ?>
                                                </td>
                                                <td style="word-wrap: break-word; width: 10em;">
                                                    <?php echo $row['firstname'] . " " . $row['middlename'] . " " . $row['lastname']; ?>
                                                </td>
                                                <td class="fs-6" styl   e="word-wrap: break-word; width: 10em;">
                                                    <?php echo $row['level'] . " " . "'" . $row['section'] . "'"; ?>
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



</body>

</html>