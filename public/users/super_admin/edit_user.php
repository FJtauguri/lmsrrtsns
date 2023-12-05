<!-- baka -->
<?php
include('../../../database/connection.php');
$ID = isset($_GET['cn']) ? $_GET['cn'] : null;
// echo "ID: $ID";

// Fetch sections from the grade_section table
$query = mysqli_query($con, "SELECT * FROM grade_section");
$sections = mysqli_fetch_all($query, MYSQLI_ASSOC);

$id = $_GET['user_id'];
if (isset($_POST['update'])) {
    $school_number = $_POST['school_number'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $type = $_POST['type'];
    $level = $_POST['level'];
    $section = $_POST['section']; {

        mysqli_query($con, " UPDATE user SET 
            school_number='$school_number', 
            firstname='$firstname', 
            middlename='$middlename', 
            lastname='$lastname', 
            contact='$contact', 
            gender='$gender', 
            address='$address', 
            type='$type', 
            level='$level', 
            section='$section' 
            
            WHERE user_id = '$id' ") or die(mysqli_error());
        echo "<script>alert('Successfully Updated User Info!'); window.location='user.php'</script>";
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
                    <li class="breadcrumb-item active" aria-current="page">EDIT BOOKS</li>
                </ol>
            </div>
        </div>

        <!--------main-content------------->

        <div class="main-content">
            <a href="students.php"><span class="material-icons">arrow_back_ios</span></a>
            <div class="row">
                <div class="col-5">
                    <?php
                        $query = mysqli_query($con, "select * from user where user_id='$id'") or die(mysqli_error());
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
                                <div class="col-12" id="username">
                                    <label for="username">SCHOOL_ID: </label>
                                    <input type="text" name="school_number" id="username" value="<?php echo $row['school_number']?>">
                                </div>

                                <div class="col-12" id="first-name">
                                    <label for="first-name">First Name: </label>
                                    <input type="text" name="first-name" id="first-name" value="<?php echo $row['firstname']?>">
                                </div>

                                <div class="col-12" id="middle-name">
                                    <label for="middle-name">Middle Name: </label>
                                    <input type="text" name="middle-name" id="middle-name" value="<?php echo $row['middlename']?>">
                                </div>

                                <div class="col-12" id="last-name">
                                    <label for="last-name">Last Name: </label>
                                    <input type="text" name="last-name" id="last-name" value="<?php echo $row['lastname']?>">
                                </div>

                                <div class="col-12" id="last-name">
                                    <label for="last-name">Contact Number: </label>
                                    <input type="text" name="contact_number" id="last-name" value="<?php echo $row['contact']?>">
                                </div>

                                <!-- geneer -->
                                <div class="col-12" id="studgrade" style="margin: 0; display: flex; justify-content: space-between;">
                                    <label for="grade_box">Gender: </label>
                                    <select name="level" class="form-control"
                                        tabindex="-1" style="width: 189px;">
                                        <option value="<?php echo $row['gender']?>"><?php echo $row['gender']?></option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>

                                <!-- grade level -->
                                <div class="col-12" id="studgrade" style="margin: 0; display: flex; justify-content: space-between;">
                                    <label for="grade_box">Grade: </label>
                                    <select name="level" class="form-control"
                                        tabindex="-1" style="width: 189px;">
                                        <option value="<?php echo $row['level']; ?>">
                                            <?php echo $row['level']; ?>
                                        </option>
                                        <?php
                                        for ($i = 7; $i <= 12; $i++) {
                                            ?>
                                            <option value="<?php echo $i; ?>">
                                                <?php echo $i; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <!-- section -->
                                <div class="col-12" id="studsection" style="margin: 0; display: flex; justify-content: space-between;">
                                    <label for="section_box">Section: </label>
                                    <!-- <div class="col"> -->
                                        <select name="level" class="form-control"
                                            tabindex="-1" style="width: 189px;">

                                            <option value="<?php echo $row['section']; ?>">
                                                <?php echo $row['section']; ?>
                                            </option>

                                            <?php foreach ($sections as $section): ?>
                                                <option value="Grade 7" name="sections[]"
                                                    value="<?php echo $section['section_name']; ?>">
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
                                <div class="col-12" id="but">
                                <button class="btn btn-primary container" type="submit" name="submit">
                                    Add
                                </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- right -->
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
                                                <?php echo $row['school_number'];?>
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