<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');

if ($_POST['_databasename'] == "hene" && $_POST['_databasename'] == "login") {
    echo 'kys noob';
    exit;
} 

// MySQL username
$_mysql_username = $_POST['_databaseuser'];
// MySQL password
$_mysql_password = $_POST['_databasepw'];
// Database name
$_mysql_database = $_POST['_databasename'];

$_mysqli = new mysqli("127.0.0.1", $_POST['_databaseuser'], $_POST['_databasepw'], $_POST['_databasename']);

if ($_mysqli->connect_error) {
    die('Connect Error (' . $_mysqli->connect_errno . ') '
            . $_mysqli->connect_error);
}

if (!$_mysqli->set_charset('utf8')) {
    echo 'charset ei toimi';
    exit;
}

$_sqlsource = file_get_contents('../sql/hene.sql');

if (!$_mysqli->multi_query($_sqlsource)) {
    echo 'paska';
    exit;
}

$mysqli = new mysqli("127.0.0.1", $_POST['databaseuser'], $_POST['databasepw'], $_POST['databasename']);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}

if (!$mysqli->set_charset('utf8')) {
    echo 'charset ei toimi';
    exit;
}

$sqlsource = file_get_contents('../sql/login.sql');

if (!$mysqli->multi_query($sqlsource)) {
    echo 'paska';
    exit;
}

require 'createUser.php';

?>