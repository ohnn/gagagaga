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
?>

<?php

/**
 * Gets called from function getTimes / ajax.js
 */


require 'jeccu/AvailableTimes.php';

if (isset($_POST['date'])):
?>
        <div class="availabletimesContainer reserveTimeElement"><button type="button" class="btn btn-link takaisin"><span class="glyphicon glyphicon-arrow-left"></span></button>
        
        <?php
        AvailableTimes::printTimes($_POST['date']);
        ?>
        
        <button type="button" class="btn btn-primary takaisin">Takaisin kalenteriin</button></div>
<?php endif; ?>


