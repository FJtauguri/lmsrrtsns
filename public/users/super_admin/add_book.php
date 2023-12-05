<!-- baka -->
<?php
include('../../../database/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES['image']['tmp_name'])) {
        $file = $_FILES['image']['tmp_name'];
        $image = $_FILES["image"]["name"];
        $image_name = addslashes($_FILES['image']['name']);
        $size = $_FILES["image"]["size"];
        $error = $_FILES["image"]["error"];
        if ($size > 10000000) {
            die("Format is not allowed or file size is too big!");
        } else {
            move_uploaded_file($_FILES["image"]["tmp_name"], "../../image/uploadz/" . $_FILES["image"]["name"]);
            $book_image = $_FILES["image"]["name"];
            $book_title = $_POST['book_title'];
            $category_id = $_POST['category_id'];
            $author = $_POST['author'];
            $author_2 = $_POST['author_2'];
            $author_3 = $_POST['author_3'];
            $author_4 = $_POST['author_4'];
            $author_5 = $_POST['author_5'];
            $book_copies = $_POST['book_copies'];
            $book_pub = $_POST['book_pub'];
            $publisher_name = $_POST['publisher_name'];
            $isbn = $_POST['isbn'];
            $copyright_year = $_POST['copyright_year'];
            $status = $_POST['status'];

            $book_cn = $_POST['book_cn'];
            $check_query = "SELECT * FROM book WHERE cn = '$book_cn'";
            $result = mysqli_query($con, $check_query);
            if (mysqli_num_rows($result) > 0) {
                // echo "<script>alert('Control number '$book_cn' already exists. Please use a different control number.'); window.location='add_book.php'<script>";
                die("Control number '$book_cn' already exists. Please use a different control number.");
            }

            $remark = ($status == 'Lost' || $status == 'Damaged') ? 'Not Available' : 'Available';

            $stmt = $con->prepare("INSERT INTO book (cn, book_title, category_id, author, author_2, author_3, author_4, author_5, book_copies, book_pub, publisher_name, isbn, copyright_year, status, book_image, date_added, remarks) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)");
            $stmt->bind_param("ssissssiisssssss", $book_cn, $book_title, $category_id, $author, $author_2, $author_3, $author_4, $author_5, $book_copies, $book_pub, $publisher_name, $isbn, $copyright_year, $status, $book_image, $remark);
            $stmt->execute();
            $stmt->close();

            header("Location: book_lists.php");
            exit();
        }
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
                    <li class="breadcrumb-item"><a href="#">BOOKS</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ADD BOOKS</li>
                </ol>
            </div>
        </div>

        <!--------main-content------------->

        <div class="main-content">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title d-flex align-items-center">
                            <a href="book_lists.php"><span class="material-icons">arrow_back_ios</span></a>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <!-- content starts here -->

                            <form method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">

                                <div class="form-group">
                                    <label class="control-label col-md-4" for="first-name">Control Number <span class="required"
                                            style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="number" name="book_cn"
                                            value="" id="cn" max-length="4"
                                            required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="first-name">Title <span class="required"
                                            style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" name="book_title"
                                            value="" id="first-name2"
                                            required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-6" for="first-name">Author 1 <span
                                            class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" name="author"
                                            value=""
                                            id="first-name2" required="required"
                                            class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-6" for="first-name">Author 2
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" name="author_2" id="first-name2"
                                            class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-6" for="first-name">Author 3
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" name="author_3" id="first-name2"
                                            class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-6" for="first-name">Author 4
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" name="author_4" id="first-name2"
                                            class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-6" for="first-name">Author 5
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" name="author_5" id="first-name2"
                                            class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-6" for="last-name">Publication
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text"
                                            value=""
                                            name="book_pub" id="last-name2" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-6" for="last-name">Publisher
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text"
                                            value=""
                                            name="publisher_name" id="last-name2"
                                            class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-6" for="last-name">ISBN <span class="required"
                                            style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" name="isbn" id="last-name2"
                                            class="form-control col-md-7 col-xs-12" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-6" for="last-name">Copyright
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text"
                                            value=""
                                            name="copyright_year" id="last-name2"
                                            class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-6" for="last-name">Copies <span class="required"
                                            style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="number"
                                            value=""
                                            name="book_copies" step="1" min="0" max="1000" required="required"
                                            class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Status <span class="required"
                                            style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <select name="status"
                                            value=""
                                            class="col-md-7 select2_single form-control" tabindex="-1"
                                            required="required">
                                            <option value="New">New</option>
                                            <option value="Old">Old</option>
                                            <option value="Lost">Lost</option>
                                            <option value="Damaged">Damaged</option>
                                            <option value="Replacement">Replacement</option>
                                            <option value="Hardbound">Hardbound</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-6" for="last-name">Category <span
                                            class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <select value=""
                                            name="category_id" class="col-md-7 select2_single form-control"
                                            tabindex="-1" required="required">
                                            <?php
                                            $result = mysqli_query($con, "select * from category") or die(mysqli_error());
                                            while ($row = mysqli_fetch_array($result)) {
                                                $id = $row['category_id'];
                                                ?>
                                                <option value="<?php echo $row['category_id']; ?>">
                                                    <?php echo $row['classname']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Book Image
                                    </label>
                                    <div class="col-md-6">
                                        <input type="file" style="height:44px;" name="image" id="last-name2"
                                            class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                        <a href="book.php"><button type="button" class="btn btn-primary"><i
                                                    class="fa fa-times-circle-o"></i> Cancel</button></a>
                                        <button type="submit" name="submit" class="btn btn-success"><i
                                                class="fa fa-plus-square"></i> Submit</button>
                                    </div>
                                </div>
                            </form>


                            <!-- content ends here -->
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
                    'pdf',
                    'excel'
                ]
            });
        });
    </script>

</body>

</html>