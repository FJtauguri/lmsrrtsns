<!-- baka -->
<?php
include("../../../../database/connection.php");
session_start();
$requesterId = $_SESSION['user_id'];

// Fetch  borrowed requests for the current user
$query = "SELECT bb.*, b.book_title
          FROM borrow_book bb
          JOIN book b ON bb.book_id = b.book_id
          WHERE bb.user_id = $requesterId";

$result = mysqli_query($con, $query);

// delete request
if (isset($_POST['delete_request'])) {
    $user_id = $_POST['user_id'];

    $delete_query = "DELETE FROM user WHERE user_id = $user_id";
    $result = mysqli_query($con, $delete_query);

    if ($result) {
        echo "<script>alert('User deleted successfully');</script>";
    } else {
        echo "<script>alert('Error deleting user');</script>";
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
    <link rel="stylesheet" href="../../../assets/css/users.css">

    <!-- CDN Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- LOCAL CDN Bootrap CSS -->
    <link rel="stylesheet" href="../../../assets/bootstrap/bootstrap.min.css">

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
    <?php include('../sidebar.php') ?>

    <!--------page-content---------------->

    <div id="content">
        <!-- NOTICE: topbar section -->
        <div class="top-navbar">
            <?php include('../topbar.php') ?>
            <div class="xp-breadcrumbbar text-center">
                <ol class="breadcrumb mb-1 text-white">
                    <li class="breadcrumb-item"><a href="#">Explore</a></li>
                    <li class="breadcrumb-item active" aria-current="page">BORROW</li>
                </ol>
            </div>
        </div>

        <!-- NOTICE: main content section -->
        <div class="main-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-wrapper">

                        <div class="table-responsive">
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered"
                                id="example">

                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Title</th>
                                        <th>Due Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                        while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                            <td style="width: 180px;"><?php echo $row['borrowed_status']; ?></td>
                                            <td><?php echo $row['book_title']; ?></td>
                                            <td style="width: 180px;" ><?php echo $row['due_date']; ?></td>
                                            <td style="word-wrap: break-word; width: 8em; display: inline-flex; justify-content: space-between; flex-direction: row;">
                                                <a class="btn btn-danger" for="DeleteAdmin" style="color: white; width: 80px;" href="#delete"
                                                    data-toggle="modal" data-target="#delete">
                                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                        <!-- delete modal user -->
                                        <div class="modal fade" id="delete" tabindex="-1" role="dialog"
                                            aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel"><i
                                                                class="glyphicon glyphicon-user"></i>Delete Request?:</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="alert alert-danger">
                                                            Are you sure you want to delete?
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-inverse" data-dismiss="modal"
                                                            aria-hidden="true">
                                                            <i class="glyphicon glyphicon-remove icon-white"></i>
                                                            No
                                                        </button>
                                                        <form method="post" action="">
                                                            <input type="hidden" name="user_id" value="<?php echo $id; ?>">
                                                            <button type="submit" name="delete_request"
                                                                style="margin-bottom:5px;" class="btn btn-primary">
                                                                <i class="glyphicon glyphicon-ok icon-white"></i> Yes
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php  }?>
                                </tbody>
                            </table>
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
    <script src="../../../assets/js/main_footer.js"></script>
    <script src="../../../assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="../../../assets/js/popper.min.js"></script>
    <script src="../../../assets/js/bootstrap.min.js"></script>
    <script src="../../../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../../../assets/js/ham.js"></script>
    <script src="../../../assets/js/author_limit.js"></script>
    <script src="../../../assets/js/search.js"></script>

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


    <!-- table print preview -->
    <script>
        function printTable() {
            var printWindow = window.open('', '_blank');
            printWindow.document.write('<html><head><title>Print Preview</title></head><body>');

            // Header content
            printWindow.document.write('<div style="text-align: center; margin-bottom: 20px;">');
            printWindow.document.write('<img src="../../image/local_image/OIP.jpg" alt="Logo" style="width: 100px; height: 100px;">');
            printWindow.document.write('<p style="">Republic of the Philippines</p>');
            printWindow.document.write('<h5>R. Tangson Sr. National High School\'s Library</h5>');
            printWindow.document.write('</div>');

            // Table content
            printWindow.document.write('<style>@media print { body { visibility: visible; } }</style>');
            printWindow.document.write(document.getElementById('example').outerHTML);

            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>

</body>

</html>