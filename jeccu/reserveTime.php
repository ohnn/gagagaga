<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['logged']) || !$_SESSION['logged']) {
    echo '<h3>Lopeta häksäily</h3>';
    exit;
}

require 'AvailableTimes.php';


// make sure varausID was set properly
if (!isset($_POST['varausID'])) {
    echo 'varausID ei asetettu';
    exit;
}

$varausID = $_POST['varausID'];

// alustetaan viestimuuttuja
if (!isset($_POST['viesti']) || $_POST['viesti'] == '') {
    $message = ' ';
} else {
    $message = $_POST['viesti'];
}

// alustetaan asiakasmuuttuja
$asiakas = $_SESSION['userID'];

// reserve time using static method AvailableTimes::reserveTime
AvailableTimes::reserveTime($varausID, $asiakas, $message);
?>
