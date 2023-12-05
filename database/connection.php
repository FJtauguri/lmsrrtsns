<?php
require_once('config.php');

$con = new mysqli(db_host, db_user, db_password, db_name);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

?>