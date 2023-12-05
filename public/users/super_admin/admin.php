<?php
include('../../../database/connection.php');
?>

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
                    <li class="breadcrumb-item"><a href="#">USERS</a></li>
                    <li class="breadcrumb-item active" aria-current="page">TEACHER</li>
                </ol>
            </div>
        </div>

        <!--------main-content------------->

        <div class="main-content">
            <div class="row">
                <!-- TABLE START-->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <div class="container d-flex pb-3"
                                style="list-style: none; justify-content: space-between;">
                                <li>
                                    <p class="fs-5">
                                        Teacher
                                    </p>
                                </li>
                                <li>
                                    <a href="admin_add.php" style="background:none;" id="buttons_add">
                                        <button class="btn btn-rounded btn-primary">
                                            <span class="material-icons">add</span>
                                        </button>
                                    </a>
                                    <button class="btn btn-rounded btn-secondary" onclick="printTable()">
                                        <span class="material-icons">print</span>
                                    </button>
                                </li>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <!-- content starts here -->

                            <div class="table-responsive">
                                <table cellpadding="0" cellspacing="0" border="0"
                                    class="table table-striped table-bordered" id="example">

                                    <thead>
                                        <tr>
                                            <th>Status</th>
                                            <th>Full Name</th>
                                            <th>Grade Cover</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $result = mysqli_query($con, "select * from admin WHERE admin_type='Adviser' order by admin_id ASC") or die(mysqli_error());
                                        while ($row = mysqli_fetch_array($result)) {
                                            $id = $row['admin_id'];
                                            ?>
                                            <tr>

                                                <td style="word-wrap: break-word; width: 10em;">
                                                    <?php if ($row['status'] == '1') {
                                                        echo "Active";
                                                    } else {
                                                        echo "Offline";
                                                    } ?>
                                                </td>
                                                <td style="word-wrap: break-word; ">
                                                    <?php echo $row['firstname'] . " " . $row['middlename'] . " " . $row['lastname']; ?>
                                                </td>
                                                <td style="word-wrap: break-word; ">
                                                    <?php echo $row['grade_lvl'] . " " . "'" . $row['section'] . "'"; ?>
                                                </td>
                                                <td
                                                    style="word-wrap: break-word; width: 8em; display: inline-flex; justify-content: space-between; flex-direction: row;">

                                                    <a class="btn btn-warning" for="EditUser" href="#editUserModal"
                                                        data-toggle="modal" data-target="#editUserModal"
                                                        style="color: white; width: 80px;"><i
                                                            class="glyphicon glyphicon-pencil icon-white"></i>Edit</a>

                                                    <a class="btn btn-danger" for="DeleteAdmin" href="#delete" 
                                                        data-toggle="modal" data-target="#deleteUserModal"
                                                        style="color: white; width: 80px;"><i 
                                                            class="glyphicon glyphicon-trash icon-white"></i>Delete

                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        
                                        <!-- Modal for Edit User -->
                                        <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog"
                                            aria-labelledby="editUserModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form>
                                                            <div class="mb-3">
                                                                <label for="editFullName" class="form-label">Full
                                                                    Name</label>
                                                                <input type="text" class="form-control"
                                                                    id="editFullName" placeholder="Enter Full Name">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="editStatus"
                                                                    class="form-label">Status</label>
                                                                <select class="form-select" id="editStatus">
                                                                    <option value="1">Active</option>
                                                                    <option value="0">Offline</option>
                                                                </select>
                                                            </div>

                                                            <button name="edit" type="submit" class="btn btn-primary">Save
                                                                Changes</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal for Delete User -->
                                        <div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog"
                                            aria-labelledby="deleteUserModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteUserModalLabel">Delete User</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="text-center">
                                                            <i class="fas fa-exclamation-circle text-danger" style="font-size: 500%"></i><br><b class="h3">Are you sure?</b><br><br>
                                                        You will not be able to recover this action!
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <form action="" method="post">
                                                            <input type="hidden" name="id" value="<?= $row['admin_id']; ?>"/>
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-danger" name="delete">Delete it!</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </tbody>

                                </table>
                            </div>

                            <!-- content ends here -->
                        </div>
                    </div>
                </div>
                <!-- TABLE END -->
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

    <!-- Password sync -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var password = document.getElementById('password');
            var repassword = document.getElementById('repassword');
            var passwordError = document.getElementById('password-error');

            repassword.addEventListener('input', function () {
                if (password.value !== repassword.value) {
                    passwordError.textContent = 'Passwords do not match';
                    passwordError.style.color = 'red'
                } else {
                    passwordError.textContent = 'Nice move!';
                    passwordError.style.color = 'blue';
                }
            });
        });
    </script>

    <!-- Password and Button handler -->
    <script>
        $(document).ready(function () {
            $("#repassword").on("input", function () {
                var password = $("#password").val();
                var confirmPassword = $("#repassword").val();
                var passwordError = $("#password-error");

                if (password !== confirmPassword) {
                    passwordError.text("Passwords do not match");
                    $("button[type='submit']").prop("disabled", true);
                    echo 'we';
                } else {
                    passwordError.text("Nice move!");
                    $("button[type='submit']").prop("disabled", false);
                }
            });
        });
    </script>


</body>

</html>

</body>

</html>