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
                                                <?php echo $bookCount ?>
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
                                                <?php echo $borrowedCount ?>
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
                                                <?php echo $returnedCount ?>
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
                            <div class="row container p-0 mx-0 d-block mt-5">
                                <!-- chart -->
                                <div class="col-12">
                                    <p class="fs-5">
                                        <b>
                                            User's Frequency of Borrowing Books
                                        </b>
                                    </p>
                                </div>
                                <!-- students most borrowed -->
                                <!-- <canvas id="myChart"></canvas> -->
                                <canvas id="borrowingChart" width="400" height="200"></canvas>
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

    <!-- custom js chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <!-- CANVAS -->
    <script>
        // var xyValues = [
        //     { x: 50, y: 7 },
        //     { x: 60, y: 8 },
        //     { x: 70, y: 8 },
        //     { x: 80, y: 9 },
        //     { x: 90, y: 9 },
        //     { x: 100, y: 9 },
        //     { x: 110, y: 10 },
        //     { x: 120, y: 11 },
        //     { x: 130, y: 14 },
        //     { x: 140, y: 14 },
        //     { x: 150, y: 15 }
        // ];

        // new Chart("myChart", {
        //     type: "bar",
        //     data: {
        //         datasets: [{
        //             pointRadius: 4,
        //             pointBackgroundColor: "rgb(0,0,255)",
        //             data: xyValues
        //         }]
        //     },
        //     options: {
        //         legend: { display: false },
        //         scales: {
        //             // Y - Users
        //             xAxes: [{ ticks: { min: 40, max: 160 } }],
        //             // X - Number of Borrowed
        //             yAxes: [{ ticks: { min: 6, max: 16 } }],
        //         }
        //     }
        // });
    </script>
    <script>
        // Extracted borrowing data for illustration
        const borrowingData = [
            { student: 'Student A', frequency: 10 },
            { student: 'Student B', frequency: 15 },
            { student: 'Student C', frequency: 8 },
            // Add more data as needed
        ];

        // Extract student names and borrowing frequencies
        const studentNames = borrowingData.map(data => data.student);
        const borrowingFrequencies = borrowingData.map(data => data.frequency);

        // Get the canvas element
        const ctx = document.getElementById('borrowingChart').getContext('2d');

        // Create a bar chart
        const borrowingChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: studentNames,
                datasets: [{
                    label: 'Borrowing Frequency',
                    data: borrowingFrequencies,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</body>

</html>