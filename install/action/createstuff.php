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

$host = strval($_POST['hostname']);

$_mysqli = new mysqli($host, $_POST['_databaseuser'], $_POST['_databasepw'], $_POST['_databasename']);

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

$mysqli = new mysqli($host, $_POST['databaseuser'], $_POST['databasepw'], $_POST['databasename']);

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

$config = '../../db/config.php';

$configText = '<?php 
$host = "'.$host.'";
$username = "'.$_POST['databaseuser'].'";
$username_hene = "'.$_mysql_username.'";
$password = "'.$_POST['databasepw'].'";
$password_hene = "'.$_mysql_password.'";
$dbname = "'.$_POST['databasename'].'";
$dbname_hene = "'.$_mysql_database.'";
?>';

file_put_contents($config, $configText);

/**
 * Yhdistä tietokantaan ja luo käyttäjä
 */
require '../../db/connect.php';

// generoi salt
$salt = bin2hex(random_bytes(128));
$rolenumber = 3;

//lisää tiedot tietokantaan
$query = $mysqli->prepare('INSERT INTO members (username, password, salt, role) VALUES (?,?,?,?)');
if ($query) {
    $hashed_passwd = hash_pbkdf2('sha512', $_POST['registerPassword'], $salt, 45000, 256);
    $query->bind_param('sssi', $_POST['inputName1'], $hashed_passwd, $salt, $rolenumber);
    if ($query->execute()) { 
        header('Location: /testinstall/index.php?success=' . urlencode('Asennus onnistui! Voit nyt luoda asiakaskäyttäjän tai kirjauta sisään adminina luodaksesi lääkäri -ja adminkäyttäjiä'));
    } else {
        exit;
    }
} else {
    exit;
}

// poista asennustiedosto
delete_files('../../install');

function delete_files($target) {
    if (is_dir($target)) {
        $files = glob($target . '*', GLOB_MARK);
        
        foreach ($files as $file) {
            delete_files ($file);
        }
      
        rmdir($target);
    } elseif(is_file($target)) {
        unlink($target);  
    }
}

?>