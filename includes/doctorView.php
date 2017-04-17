<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['logged']) || !$_SESSION['logged']) {
    echo '<h3>asdf</h3>';
    exit;
}

include 'doctor_addtimesform.php';

?>