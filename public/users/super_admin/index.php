<!-- baka -->
<?php
    session_start();

    include('../../../database/connection.php');
    function getRecordCount($con, $table)
    {
        $result = mysqli_query($con, "SELECT * FROM $table");
        return mysqli_num_rows($result);
    }

    $adminCount = getRecordCount($con, 'admin');
    $userCount = getRecordCount($con, 'user');
    $bookCount = getRecordCount($con, 'book');
    $borrowedCount = getRecordCount($con, 'borrow_book');
    $returnedCount = getRecordCount($con, 'return_book');
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

    <!-- CDN Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- CDN Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">

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
                    <li class="breadcrumb-item active" aria-current="page">DASHBOARD</li>
                </ol>
            </div>
        </div>

        <!--------main-content------------->

        <div class="main-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-wrapper">

                        <!-- lists of the books -->
                        <div class="container" id="booksContainer">
                            <div class="row">
                                <div
                                    class="col-lg-12 col-md-12 col-12 d-flex justify-content-center align-self-center align-items-center">
                                    <div class="col-lg-4 justify-content-center mb-3" style="display: grid;">
                                        <div class="col-lg-12 align-content-center"
                                            style="height: 100px; width: 300px; display: grid; border-radius: 10px; border: 1px solid #000;">
                                            <div class="col text-center">
                                                <?php echo $adminCount; ?>
                                            </div>
                                            <div class="col text-center">
                                                Total Admin
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 justify-content-center mb-3" style="display: grid;">
                                        <div class="col-lg-12 align-content-center"
                                            style="height: 100px; width: 300px; display: grid; border-radius: 10px; border: 1px solid #000;">
                                            <div class="col text-center">
                                                <?php echo $userCount; ?>
                                            </div>
                                            <div class="col text-center">
                                                Students
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 justify-content-center mb-3" style="display: grid;">
                                        <div class="col-lg-12 align-content-center"
                                            style="height: 100px; width: 300px; display: grid; border-radius: 10px; border: 1px solid #000;">
                                            <div class="col text-center">
                                                <?php echo $bookCount?>
                                            </div>
                                            <div class="col text-center">
                                                Books
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-12 d-flex justify-content-center align-self-center align-items-center"
                                    style="height: 100px;">
                                    <div class="col-lg-4 justify-content-center mb-3" style="display: grid;">
                                        <div class="col-lg-12 align-content-center"
                                            style="height: 100px; width: 300px; display: grid; border-radius: 10px; border: 1px solid #000;">
                                            <div class="col text-center">
                                                <?php echo $borrowedCount?>
                                            </div>
                                            <div class="col text-center">
                                                Books Borrowed
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 justify-content-center mb-3" style="display: grid;">
                                        <div class="col-lg-12 align-content-center"
                                            style="height: 100px; width: 300px; display: grid; border-radius: 10px; border: 1px solid #000;">
                                            <div class="col text-center">
                                                <?php echo $returnedCount?>
                                            </div>
                                            <div class="col text-center">
                                                Books Returned
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 justify-content-center mb-3" style="display: grid;">
                                        <div class="col-lg-12 ">
                                        </div>
                                    </div>
                                </div>
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


</body>

</html>