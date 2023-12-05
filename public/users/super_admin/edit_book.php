<!-- baka -->
<?php
include('../../../database/connection.php');
$ID = isset($_GET['cn']) ? $_GET['cn'] : null;
// echo "ID: $ID";

if (isset($_POST['update'])) {
    $bookId = $_POST['book_id'];
    $cn = $_POST['cn'];
    $bookTitle = $_POST['book_title'];
    $author = $_POST['author'];
    $author2 = $_POST['author_2'];
    $author3 = $_POST['author_3'];
    $author4 = $_POST['author_4'];
    $author5 = $_POST['author_5'];
    $bookPub = $_POST['book_pub'];
    $publisherName = $_POST['publisher_name'];
    $isbn = $_POST['isbn'];
    $copyrightYear = $_POST['copyright_year'];
    $bookCopies = $_POST['book_copies'];
    $status = $_POST['status'];
    $categoryId = $_POST['category_id'];

    // Handle image upload
    if ($_FILES['image']['name'] != "") {
        $imageName = $_FILES['image']['name'];
        $imageTmp = $_FILES['image']['tmp_name'];
        $imagePath = "../../image/uploadz/" . $imageName;
        move_uploaded_file($imageTmp, $imagePath);
    } else {
        $imagePath = $row['book_image'];
    }

    $updateQuery = "UPDATE book SET 
                    cn = ?,
                    book_title = ?,
                    author = ?,
                    author_2 = ?,
                    author_3 = ?,
                    author_4 = ?,
                    author_5 = ?,
                    book_pub = ?,
                    publisher_name = ?,
                    isbn = ?,
                    copyright_year = ?,
                    book_copies = ?,
                    status = ?,
                    category_id = ?,
                    book_image = ?
                    WHERE book_id = ?";

    $stmt = mysqli_prepare($con, $updateQuery);
    mysqli_stmt_bind_param($stmt, "ssssssssssssssss", $cn, $bookTitle, $author, $author2, $author3, $author4, $author5, $bookPub, $publisherName, $isbn, $copyrightYear, $bookCopies, $status, $categoryId, $imagePath, $bookId);
    mysqli_stmt_execute($stmt);

    // Redirect to book list page after update
    header("Location: book_lists.php");
    exit();
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
                <ol class="breadcrumb mb-1 text-white">
                    <li class="breadcrumb-item"><a href="#">RRTSNS</a></li>
                    <li class="breadcrumb-item active" aria-current="page">EDIT BOOKS</li>
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
                        <div class="x_content" id="edit_form">
                            <!-- content starts here -->
                            <?php

                            $bookId = isset($_GET['book_id']) ? $_GET['book_id'] : null;

                            if ($bookId) {
                                $result = mysqli_query($con, "SELECT book.*, category.classname 
                                    FROM book
                                    LEFT JOIN category ON book.category_id = category.category_id
                                    WHERE book.book_id = $bookId") or die(mysqli_error());

                                if ($row = mysqli_fetch_array($result)) {
                                    $id = $row['book_id'];
                                    $category_id = $row['category_id'];
                                    $classname = $row['classname'];
                                } else {
                                    
                                    echo "Book not found";
                                }

                            ?>

                            <form method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">

                                <input type="text" name="book_id" value="<?php echo $row['book_id']; ?>" hidden>
                                <!-- <input value="<php echo $row['book_id']; ?>" type="text" hidden> -->

                                <!-- book image -->
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Book Image
                                    </label>
                                    <div class="col-md-12" style="width: 500px;">
                                        <a href="">
                                            <?php if (isset($row['book_image']) && $row['book_image'] != ""): ?>
                                                <img src="../../image/uploadz/<?php echo $row['book_image']; ?>"
                                                    width="100px" height="100px"
                                                    style="border:4px groove #CCCCCC; border-radius:5px;">
                                            <?php else: ?>
                                                <img src="images/book_image.jpg" width="100px" height="100px"
                                                    style="border:4px groove #CCCCCC; border-radius:5px;">
                                            <?php endif; ?>
                                        </a>
                                        <input type="file" style="height:44px; margin-top:10px;" name="image"
                                            id="last-name2" class="form-control col-md-7 col-xs-12" />
                                    </div>
                                </div>

                                <!-- control Number -->
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="cn">Control Number
                                    </label>
                                    <div class="col-md-12" style="width: 500px;">
                                        <input type="text" name="cn" value="<?php echo $row['cn']; ?>"
                                            id="cn" required="required"
                                            class="form-control col-md-7 col-xs-12" maxlength="4">
                                    </div>
                                </div>

                                <!-- title -->
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="first-name">Title
                                    </label>
                                    <div class="col-md-12" style="width: 500px;">
                                        <input type="text" name="book_title" value="<?php echo $row['book_title']; ?>"
                                            id="first-name2" required="required"
                                            class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <!-- authors -->
                                    <div class="form-group">
                                        <label class="control-label col-md-4" for="first-name">Author 1
                                        </label>
                                        <div class="col-md-12" style="width: 500px;">
                                            <input type="text" name="author" id="first-name2"
                                                value="<?php echo $row['author']; ?>" required="required"
                                                class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4" for="first-name">Author 2
                                        </label>
                                        <div class="col-md-12" style="width: 500px;">
                                            <input type="text" name="author_2" id="first-name2"
                                                value="<?php echo $row['author_2']; ?>"
                                                class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4" for="first-name">Author 3
                                        </label>
                                        <div class="col-md-12" style="width: 500px;">
                                            <input type="text" name="author_3" id="first-name2"
                                                value="<?php echo $row['author_3']; ?>"
                                                class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4" for="first-name">Author 4
                                        </label>
                                        <div class="col-md-12" style="width: 500px;">
                                            <input type="text" name="author_4" id="first-name2"
                                                value="<?php echo $row['author_4']; ?>"
                                                class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4" for="first-name">Author 5
                                        </label>
                                        <div class="col-md-12" style="width: 500px;">
                                            <input type="text" name="author_5" id="first-name2"
                                                value="<?php echo $row['author_5']; ?>"
                                                class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                
                                <!-- publication -->
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Publication
                                    </label>
                                    <div class="col-md-12" style="width: 500px;">
                                        <input type="text" name="book_pub" value="<?php echo $row['book_pub']; ?>"
                                            id="last-name2" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <!-- publisher -->
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Publisher
                                    </label>
                                    <div class="col-md-12" style="width: 500px;">
                                        <input type="text" name="publisher_name"
                                            value="<?php echo $row['publisher_name']; ?>" id="last-name2"
                                            class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <!-- isbn -->
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">ISBN
                                    </label>
                                    <div class="col-md-12" style="width: 500px;">
                                        <input type="text" name="isbn" id="last-name2"
                                            value="<?php echo $row['isbn']; ?>" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <!-- copyright -->
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Copyright
                                    </label>
                                    <div class="col-md-12" style="width: 500px;">
                                        <input type="text" name="copyright_year"
                                            value="<?php echo $row['copyright_year']; ?>" id="last-name2"
                                            class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <!-- copies -->
                                <div class="form-group" style="max-width: 500px; width: 300px;">
                                    <label class="control-label col-md-12" for="last-name">Copies
                                    </label>
                                    <div class="col-md-12" style="width: 500px;">
                                        <input type="number" name="book_copies"
                                            value="<?php echo $row['book_copies']; ?>" step="1" min="0" max="1000">
                                    </div>
                                </div>

                                <!-- status -->
                                <div class="form-group" style="max-width: 500px; width: 300px;">
                                    <label class="control-label col-md-4" for="last-name">Status
                                    </label>
                                    <div class="col-md-12" style="width: 500px;">
                                        <select name="status" class="select2_single form-control" tabindex="-1">
                                            <option value="<?php echo $row['status']; ?>" style="width: 500px; background-color: grey;">
                                                <?php echo $row['status']; ?>
                                            </option>
                                            <option value="New">New</option>
                                            <option value="Old">Old</option>
                                            <option value="Lost">Lost</option>
                                            <option value="Damaged">Damaged</option>
                                            <option value="Replacement">Replacement</option>
                                            <option value="Hardbound">Hardbound</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- category -->
                                <div class="form-group" style="max-width: 500px; width: 300px;">
                                    <label class="control-label col-md-4" for="last-name">Category
                                    </label>
                                    <div class="col-md-12" style="width: 500px;">
                                        <select name="category_id" class="select2_single form-control" tabindex="-1">
                                            <option value="<?php echo $row['category_id']; ?>">
                                                <?php echo $row['classname']; ?>
                                            </option>
                                            <?php
                                                // $result = mysqli_query($con, "select * from category") or die(mysqli_error());
                                                // while ($row = mysqli_fetch_array($result)) {
                                                // $id = $row['category_id'];
                                                ?>
                                                <option value="<?php echo $row['category_id']; ?>">
                                                    <?php echo $row['classname']; ?>
                                                </option>
                                            <?php  ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group" style="max-width: 500px; width: 300px;">
                                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                        <a href="book_lists.php"><button type="button" class="btn btn-primary"><i
                                                    class="fa fa-times-circle-o"></i> Cancel</button></a>
                                        <button type="submit" name="update" class="btn btn-success"><i
                                                class="glyphicon glyphicon-save"></i> Update</button>
                                    </div>
                                </div>
                            </form>
                            <?php } else {
    // Handle the case when book_id is not provided in the URL
    echo "Book ID not provided";
} ?>
                            <!-- content ends here -->
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



</body>

</html>