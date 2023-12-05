<?php
include('../../../database/connection.php');

if (isset($_POST['backup'])) {
    $backupFolder = 'C:/backup/';
    $backupFile = 'rrtsnss_' . date("Y-m-d") . '_' . uniqid() . '.sql';
    $backupPath = $backupFolder . $backupFile;

    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "lms";

    $tables = array();
    $sql = "SHOW TABLES";
    $result = $con->query($sql);

    while ($row = $result->fetch_row()) {
        $tables[] = $row[0];
    }

    $tables = array_merge(array_diff($tables, array("tbl_backup")));
    $sqlScript = "";

    foreach ($tables as $table) {
        $query = "SHOW CREATE TABLE $table";
        $result = $con->query($query);
        $row = $result->fetch_row();
        $sqlScript .= "\n\n" . $row[1] . ";\n\n";
        $query = "SELECT * FROM $table";
        $result = $con->query($query);
        $columnCount = $result->field_count;

        for ($i = 0; $i < $columnCount; $i++) {
            while ($row = $result->fetch_row()) {
                $sqlScript .= "INSERT INTO $table VALUES(";
                for ($j = 0; $j < $columnCount; $j++) {
                    $row[$j] = $row[$j];
                    if (isset($row[$j])) {
                        $sqlScript .= '"' . $con->real_escape_string($row[$j]) . '"';
                    } else {
                        $sqlScript .= '""';
                    }

                    if ($j < ($columnCount - 1)) {
                        $sqlScript .= ',';
                    }
                }
                $sqlScript .= ");\n";
            }
        }
        $sqlScript .= "\n";
    }

    if (!empty($sqlScript)) {
        $fileHandler = fopen($backupPath, 'w+');
        $number_of_lines = fwrite($fileHandler, $sqlScript);
        fclose($fileHandler);

        $curDateTime = date('Y-m-d H:i:s');
        // $try = $con->query("INSERT INTO `tbl_backup` VALUES (NULL, '$backupFile', '$curDateTime');");
        $try = $con->query("INSERT INTO `tbl_backup` (id, bakupname, date) VALUES (NULL, '$backupFile', '$curDateTime')");

        if ($try) {
            echo ('<script>alert("Backup Created Successfully");</script>');
        } else {
            die("Error!");
        }
    }
}

// RESTORE
if (isset($_POST['restore'])) {
    $backupFolder = 'C:/backup/';
    $files = glob($backupFolder . 'rrtsnss_*.sql');
    $latestBackup = end($files);

    if (!$latestBackup) {
        echo 'No backup files found in ' . $backupFolder;
    } else {
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'lms';

        $command = "mysql --host={$host} --user={$username} --password={$password} {$database} < {$latestBackup}";

        $output = shell_exec($command);

        if (!empty($output)) {
            echo 'Restore failed: ' . $output;
        } else {
            // echo 'Restore completed using ' . $latestBackup;
            echo ('<script>alert("DATABASE SUCCESSFULLY RESTORED");</script>');
        }
    }
}

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

    <!-- for backup and restore -->
    <link rel="stylesheet" href="../../assets/css/recover.css">

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
                    <li class="breadcrumb-item"><a href="#">RRTSNS</a></li>
                    <li class="breadcrumb-item active" aria-current="page">BACKUP AND RESTORE</li>
                </ol>
            </div>
        </div>

        <!--------main-content------------->

        <div class="main-content">
            <div class="row">
                <!-- backup and restore -->
                <div class="col-md-12 d-flex">
                    <div class="col-md-6">
                        <div class="col-lg-12 h-20 br-just-center d-block">
                            <form method="post">
                                <button type="submit" name="backup" class="btn-outline-success-oval">Backup</button>
                                <p class="text-center text-sm">Click here to generate a Backup for database</p>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-lg-12 h-20 br-just-center d-block restore">
                            <form method="post">
                                <button type="submit" name="restore" class="btn-outline-danger-oval">Restore</button>
                                <input class="backupfn" type="file" name="filename" accept=".sql">
                            </form>
                        </div>
                    </div>
                </div>
                <!-- backup and restore -->
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

</body>

</html>