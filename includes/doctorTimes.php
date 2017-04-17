<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../jeccu/AvailableTimes.php';
include 'confirmModal.php';

AvailableTimes::printTimesDoctor($_SESSION['doctorID']);

?>