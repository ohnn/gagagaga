<?php
    
    
require 'jeccu/calendar_class.php';
    
if (isset($_POST['month'])) {
    $var = new Calendar($_POST['month']);
} else {
    $var = new Calendar();
}

$var->outputCalendar();
        

?>