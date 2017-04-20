<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// file paths lol saatana kys
if (file_exists('db/connect.php')) {
	require_once 'db/connect.php';
} else {
	set_include_path(dirname(__FILE__));
	require '../db/connect.php';
}

require_once 'AvailableTimes.php';

AvailableTimes::freeTime($_POST['freeTimeID']);

?>