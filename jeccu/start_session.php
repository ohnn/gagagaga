<?php 
session_start();
if (isset($_SESSION['username'])) {
    $logged = true;
} else {
    $logged = false;
}

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
} else {
    $role = 0;
}
?>