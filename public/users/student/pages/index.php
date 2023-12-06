<!-- baka -->
<?php
include("../../../../database/connection.php");
session_start();
$requesterId = $_SESSION['user_id'];


// START: for pagination of book display
$booksPerPage = 9;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $booksPerPage;

$sql = "SELECT book_id, book_title, author, book_image, cn FROM book LIMIT $offset, $booksPerPage";
$result = $con->query($sql);

$totalRowsQuery = "SELECT COUNT(*) as total FROM book";
$totalRowsResult = $con->query($totalRowsQuery);
$totalRows = $totalRowsResult->fetch_assoc()['total'];

$booksArray = [];
while ($row = $result->fetch_assoc()) {
    $booksArray[] = $row;
}

$totalPages = ceil($totalRows / $booksPerPage);
// END: for pagination of book display

// $sql = "SELECT * FROM book LIMIT $offset, $booksPerPage";


if (isset($_POST['borrow'])) {
    $bookId = $_POST['book_id'];
    $borrowDays = filter_var($_POST['borrow_days'], FILTER_SANITIZE_NUMBER_INT);
    $borrowDaysDue = filter_var($_POST['borrow_days'], FILTER_SANITIZE_NUMBER_INT);

    $cnQuery = $con->prepare("SELECT cn FROM book WHERE book_id = ?");
    $cnQuery->bind_param("i", $bookId);
    $cnQuery->execute();
    $cnQuery->store_result();
    $cnQuery->bind_result($cn);
    $cnQuery->fetch();
    $cnQuery->close();

    $userQuery = "SELECT firstname, middlename, lastname FROM user WHERE user_id = ?";
    $userStatement = $con->prepare($userQuery);
    $userStatement->bind_param("i", $requesterId);
    $userStatement->execute();
    $userStatement->store_result();
    $userStatement->bind_result($firstname, $middlename, $lastname);
    $userStatement->fetch();
    $userStatement->close();

    // $status = 'Pending Request';

    $rname = $firstname . " " . $middlename . " " . $lastname;

    // $dueDate = date('Y-m-d H:i:s', strtotime("+$borrowDays days"));
    // $cn = $row['cn'];

    $insertQuery = $con->prepare("INSERT INTO borrow_book (rname, user_id, book_id, cn, number_of_days, date_borrowed, due_date, borrowed_status) VALUES (?, ?, ?, ?, ?, NOW(), ?, 'Pending Request')");
    // $insertQuery->bind_param("siisiss", $rname, $requesterId, $bookId, $cn, $borrowDays, $borrowDaysDue, $status);


    $insertQuery->bind_param("sisiss", $rname, $requesterId, $bookId, $cn, $borrowDays, $borrowDaysDue);

    if ($insertQuery->execute()) {
        $insertQuery->close();
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $con->error;
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
                    <li class="breadcrumb-item active" aria-current="page">HOME</li>
                </ol>
            </div>
        </div>

        <!-- NOTICE: main content section -->
        <div class="main-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-wrapper">

                        <!-- lists of the books -->
                        <div class="container" id="booksContainer">
                            <div class="row">
                                <?php
                                $booksPerRow = 3;
                                $counter = 0;

                                if (!empty($booksArray)) {
                                    foreach ($booksArray as $row) {
                                        // $cn = $row['cn'];
                                        if ($counter % $booksPerRow == 0) {
                                            if ($counter > 0) {
                                                echo '</div>';
                                            }
                                            echo '<div class="col-12 col-sm-12 d-flex">';
                                        }
                                        ?>
                                        <div class="col p-3" style="display: grid; justify-content: start; width: 500px;">

                                            <div style="width: 200px;">

                                                <div class="book-title">
                                                    <span class="">
                                                        <b>
                                                            <i id="book-title">
                                                                <?php echo $row["book_title"]; ?>
                                                            </i>
                                                        </b>
                                                    </span>
                                                    <span class="d-flex" style="font-size: .8rem;">
                                                        <b>By:_</b>
                                                        <i id="book-author">
                                                            <?php echo $row["author"]; ?>
                                                        </i>
                                                    </span>
                                                </div>
                                                <img src="../../../image/uploadz/<?php echo $row["book_image"]; ?>"
                                                    class="rounded mx-auto d-block" alt="..."
                                                    style="max-width: 200px; max-height: 300px;">

                                                <button class="btn btn-primary-none d-flex align-items-center"
                                                    data-toggle="modal"
                                                    data-target="#borrowModal<?php echo $row['cn']; ?>">
                                                    Borrow
                                                    <span class="material-icons">
                                                        arrow_circle_right
                                                    </span>
                                                </button>

                                                <!-- modal -->
                                                <form action="" method="post">
                                                    <div class="modal fade" id="borrowModal<?php echo $row['cn']; ?>"
                                                        tabindex="-1" role="dialog" aria-labelledby="borrowModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="borrowModalLabel">Borrow Book
                                                                    </h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <!-- Dito. HAHAHAAH -->
                                                                <div class="modal-body">
                                                                    <p>You are about to borrow the book: <b>
                                                                            <?php echo $row['book_title']; ?>
                                                                        </b> </p>
                                                                    <div class="">
                                                                        <p>How many days would you like to borrow the book?</p>

                                                                        <input type="hidden" name="cn" value="<?php echo $row['cn']?>">

                                                                        <input type="date" name="borrow_days">
                                                                    </div>
                                                                </div>
                                                                <!-- Nandito yung button -->
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary close"
                                                                        data-dismiss="modal" aria-label="Close">Close</button>

                                                                    <input type="hidden" name="book_id"
                                                                        value="<?php echo $row['book_id']; ?>">
                                                                    <button type="submit" class="btn btn-primary"
                                                                        name="borrow">Borrow</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                        <?php
                                        $counter++;
                                    }
                                    echo '</div>';
                                } else {
                                    echo "No books found.";
                                }
                                ?>
                            </div>
                        </div>

                        <!-- Pagination -->
                        <div class="clearfix">
                            <ul class="pagination">
                                <?php
                                for ($i = 1; $i <= $totalPages; $i++) {
                                    echo '<li class="page-item ' . ($i == $page ? 'active' : '') . '"><a href="?page=' . $i . '" class="page-link">' . $i . '</a></li>';
                                }
                                ?>
                            </ul>
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


</body>

</html>