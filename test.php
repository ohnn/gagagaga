<?php
    
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['logged']) || !$_SESSION['logged']) {
    echo '<h3>asdf</h3>';
    exit;
}    
    
require 'jeccu/calendar_class.php';
    
if (isset($_POST['month'])) {
    $var = new Calendar($_POST['month']);
} else {
    $var = new Calendar();
}

$var->outputCalendar();
        

?>