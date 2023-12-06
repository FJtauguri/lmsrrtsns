<!-- baka -->
<?php
include('../../../database/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['accept'])) {
        $bookId = $_POST['book_id'];
        $updateQuery = "UPDATE borrow_book SET borrowed_status = 'Pending Request' WHERE book_id = $bookId";
        $con->query($updateQuery);
    } elseif (isset($_POST['delete'])) {
        $bookId = $_POST['book_id'];
        $deleteQuery = "DELETE FROM borrow_book WHERE book_id = ?";
        $stmt = $con->prepare($deleteQuery);
        $stmt->bind_param("i", $bookId);
        if ($stmt->execute()) {
            echo "<script>alert('Book deleted successfully');</script>";
        } else {
            echo "Error deleting record: " . $stmt->error;
        }
        $stmt->close();
    }

}


// for tab
$current_page = basename($_SERVER['PHP_SELF']);

// to fetch the data from table "borrow_book" where book_status iis "Pending Request"
$sql = "SELECT bb.cn, bb.rname, bb.borrow_book_id, bb.book_id, bb.date_borrowed, bb.due_date, bb.number_of_days, b.book_title 
            FROM borrow_book bb 
            JOIN book b ON bb.book_id = b.book_id 
            WHERE bb.borrowed_status = 'Pending Request'";

$result = $con->query($sql);
if ($result->num_rows > 0) {
    $borrowedBooks = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $borrowedBooks = array();
}

$con->close();
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
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

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
                    <li class="breadcrumb-item active" aria-current="page">BOOK BORROWED</li>
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
                                                    <button class="btn btn-rounded btn-secondary"
                                                        onclick="printTable()">
                                                        <span class="material-icons">print</span>
                                                    </button>
                                                </li>
                                            </div>

                                            <ul class="nav navbar-right panel_toolbox">
                                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                                <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                                            </ul>
                                            <div class="clearfix"></div>
                                            <ul class="nav nav-pills mb-3 pt-3 pb-3" id="navpillsZ"
                                                style="border: 1px solid #000; align-items: center;">
                                                <li id="navpills" role="presentation"
                                                    class="<?php echo ($current_page == 'book_borrowed.php') ? 'active' : ''; ?>">
                                                    <a href="book_borrowed.php">All</a>
                                                </li>
                                                <li id="navpills" role="presentation"
                                                    class="<?php echo ($current_page == 'book_borrowed_REQUEST.php') ? 'active' : ''; ?>">
                                                    <a href="book_borrowed_REQUEST.php">Request</a>
                                                </li>
                                                <li id="navpills" role="presentation"
                                                    class="<?php echo ($current_page == 'book_borrowed_BORROWED.php') ? 'active' : ''; ?>">
                                                    <a href="book_borrowed_BORROWED.php">Borrowed</a>
                                                </li>
                                                <li id="navpills" role="presentation"
                                                    class="<?php echo ($current_page == 'book_borrowed_RETURNED.php') ? 'active' : ''; ?>">
                                                    <a href="book_borrowed_RETURNED.php">Returned</a>
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
                                                                <th>CN</th>
                                                                <th>Requester Name</th>
                                                                <th>Title</th>
                                                                <th>Date Borrowed</th>
                                                                <th>Due Date</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                                <?php
                                                                foreach ($borrowedBooks as $book) {
                                                                    echo '<tr>';
                                                                    echo '<td>' . $book['cn'] . '</td>';
                                                                    echo '<td>' . $book['rname'] . '</td>';
                                                                    echo '<td>' . $book['book_title'] . '</td>';
                                                                    echo '<td>' . $book['date_borrowed'] . '</td>';
                                                                    echo '<td>' . $book['due_date'] . '</td>';
                                                                    echo '<td>
                                                                                <div class="container p-0">
                                                                                    <div class="p-0 col-12">
                                                                                        <a href="#accept" class="btn btn-primary" data-toggle="modal" data-target="#acceptModal">
                                                                                            <span class="material-symbols-outlined"> check_circle </span>
                                                                                        </a>
                                                                                        <a href="#delete" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-bookid="' . $book['borrow_book_id'] . '">
                                                                                            <span class="material-symbols-outlined"> delete_forever </span>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </td>';
                                                                    echo '</tr>';
                                                                }
                                                                ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            
                                            <!-- MODAL for ACCEPT -->
                                            <div class="modal fade" id="acceptModal" tabindex="-1" role="dialog"
                                                aria-labelledby="acceptModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="acceptModalLabel">Accept Request
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post">
                                                                <div class="mb-3">
                                                                    <p class="fs-6">
                                                                        <?php
                                                                        echo $book['rname'] . ' ' . ' wants to borrow ' . $book['book_title'] . ' ' . ' and will return it on ' . $book['number_of_days'];
                                                                        ?>
                                                                    </p>
                                                                </div>
                                                                <input type="hidden" name="book_id"
                                                                    value="<?php echo $book['book_id']; ?>">
                                                                <button name="accept" type="submit"
                                                                    class="btn btn-primary"
                                                                    onclick="startTimer()">Accept</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- MODAL for DELETE -->
                                            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModal">Delete Request</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post">
                                                                <div class="mb-3">
                                                                    <p class="fs-6">
                                                                        Are you sure, you want to delete it?
                                                                    </p>
                                                                </div>
                                                                <input type="hidden" id="deleteBookId" name="book_id" value="">
                                                                <button name="delete" type="submit" class="btn btn-danger">Delete</button>
                                                            </form>
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

    <!-- script for borrow timer -->
    <script>
        function startTimer() {
            var dueDate = new Date('<?php echo $book['due_date']; ?>').getTime();

            var x = setInterval(function () {
                var now = new Date().getTime();

                var distance = dueDate - now;

                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);


                console.log(days + "d " + hours + "h " + minutes + "m " + seconds + "s");

                if (distance < 0) {
                    clearInterval(x);
                    console.log("Expired");

                    var bookId = <?php echo $book['book_id']; ?>;
                    updateBorrowedStatus(bookId);
                }
            }, 1000);

            function updateBorrowedStatus(bookId) {
                $.ajax({
                    type: 'POST',

                    data: {
                        book_id: bookId,
                        borrowed_status: 'Lost'
                    },
                    success: function (response) {
                        console.log("Borrowed status updated to Lost");
                    },
                    error: function (xhr, status, error) {
                        console.error("Error updating borrowed status: " + error);
                    }
                });
            }
        }
    </script>


    <script>
        $(document).ready(function () {
            // Accept modal
            $('#acceptModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var bookId = button.data('bookid');
                var modal = $(this);
                modal.find('input[name="book_id"]').val(bookId);
            });

            // Delete modal
            $('#deleteModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var bookId = button.data('bookid');
                var modal = $(this);
                modal.find('#deleteBookId').val(bookId);
            });
        });
    </script>


</body>

</html>

</body>

</html>