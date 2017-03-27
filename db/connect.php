<?php 

require "config.php";

$mysqli = new mysqli($host, $username, $password, $dbname);
$hene = new mysqli($host, $username_hene, $password_hene, $dbname_hene);
$array = array($mysqli, $hene);

for ($i = 0; $i > sizeof($array); $i++) {

    if ($array[$i]->connect_error) {
        die('Connect Error (' . $array[$i]->connect_errno . ') '
                . $array[$i]->connect_error);
    }
    
    if (!$array[$i]->set_charset('utf-8')) {
        die('Connect Error (' . $array[$i]->connect_errno . ') '
                . $array[$i]->connect_error);
    }
    
}

?>