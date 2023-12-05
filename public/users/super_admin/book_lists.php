    <!-- baka -->
<?php
include('../../../database/connection.php');
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
        li>a {
            list-style: none;
            color: #000;
        }

        #navpills.active a {
            color: red;
        }
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
                    <li class="breadcrumb-item active" aria-current="page">BOOK LISTS</li>
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

                                <!-- TABLE START-->
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <div class="container d-flex pb-3"
                                                style="list-style: none; justify-content: end;">
                                                <li>
                                                    <a href="add_book.php" style="background:none;" id="buttons_add">
                                                        <button class="btn btn-rounded btn-primary">
                                                            <span class="material-icons">add</span>
                                                        </button>
                                                    </a>
                                                    <button class="btn btn-rounded btn-secondary" onclick="printTable()">
                                                        <span class="material-icons">print</span>
                                                    </button>
                                                </li>
                                            </div>

                                            <ul class="nav navbar-right panel_toolbox">
                                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                                <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                                            </ul>
                                            <div class="clearfix"></div>
                                            <ul class="nav nav-pills mb-3 pt-3 pb-3" id="navpillsZ" style="border: 1px solid #000; align-items: center;">
                                                <li id="navpills" role="presentation" class="active"><a
                                                        href="book_lists.php">All</a></li>
                                                <li id="navpills" role="presentation"><a href="new_books.php">New
                                                        Books</a></li>
                                                <li id="navpills" role="presentation"><a href="old_books.php">Old
                                                        Books</a></li>
                                                <li id="navpills" role="presentation"><a href="lost_books.php">Lost
                                                        Books</a></li>
                                                <li id="navpills" role="presentation"><a href="damage_books.php">Damaged
                                                        Books</a>
                                                </li>
                                                <li role="presentation"><a href="sub_rep.php">Subject for Replacement
                                                        Books</a></li>
                                                <li role="presentation"><a href="hard_bound.php">Hardbound Books</a>
                                                </li>
                                            </ul>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">

                                            <!-- content starts here -->

                                            <div class="table-responsive">
                                                <table cellpadding="0" cellspacing="0" border="0"
                                                    class="table table-striped table-bordered" id="example">

                                                    <thead>
                                                        <tr>
                                                            <th style="width:100px;">Book Image</th>
                                                            <th>CN</th>
                                                            <th>Title</th>
                                                            <th>ISBN</th>
                                                            <th>Author/s</th>
                                                            <th>Copies</th>
                                                            <th>Category</th>
                                                            <th>Status</th>
                                                            <th>Remarks</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php
                                                        $result = mysqli_query($con, "select * from book order by book_id DESC ") or die(mysqli_error());
                                                        while ($row = mysqli_fetch_array($result)) {
                                                            $id = $row['book_id'];
                                                            $category_id = $row['category_id'];

                                                            $cat_query = mysqli_query($con, "select * from category where category_id = '$category_id'") or die(mysqli_error());
                                                            $cat_row = mysqli_fetch_array($cat_query);
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <?php if ($row['book_image'] != ""): ?>
                                                                        <img src="../../image/uploadz/<?php echo $row['book_image']; ?>"
                                                                            class="img-thumbnail" width="75px" height="50px">
                                                                    <?php else: ?>
                                                                        <img src="images/book_image.jpg" class="img-thumbnail"
                                                                            width="75px" height="50px">
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td style="word-wrap: break-word; width: 10em;">
                                                                    <?php echo $row['cn']; ?>
                                                                </td>
                                                                <td style="word-wrap: break-word; width: 10em;">
                                                                    <?php echo $row['book_title']; ?>
                                                                </td>
                                                                <td style="word-wrap: break-word; width: 10em;">
                                                                    <?php echo $row['isbn']; ?>
                                                                </td>
                                                                <td style="word-wrap: break-word; width: 10em;">
                                                                    <?php echo $row['author'] . "<br />" . $row['author_2'] . "<br />" . $row['author_3'] . "<br />" . $row['author_4'] . "<br />" . $row['author_5']; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $row['book_copies']; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $cat_row['classname']; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $row['status']; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $row['remarks']; ?>
                                                                </td>
                                                                <td>
                                                                    <a class="btn btn-primary" for="ViewAdmin"
                                                                        href="view_book.php<?php echo '?book_id=' . $id; ?>">
                                                                        <span class="material-icons">visibility</span>

                                                                    </a>
                                                                    <a class="btn btn-warning" for="ViewAdmin"
                                                                        href="edit_book.php<?php echo '?book_id=' . $id; ?>">
                                                                        <span class="material-icons">edit</span>

                                                                    </a>

                                                                    <!-- delete modal user -->
                                                                    <div class="modal fade" id="delete<?php echo $id; ?>"
                                                                        tabindex="-1" role="dialog"
                                                                        aria-labelledby="myModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title"
                                                                                        id="myModalLabel"><i
                                                                                            class="glyphicon glyphicon-user"></i>
                                                                                        User</h4>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="alert alert-danger">
                                                                                        Are you sure you want to delete?
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button class="btn btn-inverse"
                                                                                            data-dismiss="modal"
                                                                                            aria-hidden="true"><i
                                                                                                class="glyphicon glyphicon-remove icon-white"></i>
                                                                                            No</button>
                                                                                        <a href="delete_user.php<?php echo '?book_id=' . $id; ?>"
                                                                                            style="margin-bottom:5px;"
                                                                                            class="btn btn-primary"><i
                                                                                                class="glyphicon glyphicon-ok icon-white"></i>
                                                                                            Yes</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>

                                                </table>
                                            </div>

                                            <!-- content ends here -->
                                        </div>
                                    </div>
                                </div>
                                <!-- TABLE END -->

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

</body>

</html>