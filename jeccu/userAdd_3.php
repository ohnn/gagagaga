<?php
require '../db/connect.php';

// tarkista, onko käyttäjänimi jo käytössä
$query = $mysqli->prepare('SELECT username FROM members WHERE username=?');

if ($query) {
    $query->bind_param('s', $_POST['inputName1']);
    if ($query->execute()) {
        $query->store_result();
        if ($query->num_rows != 0) {
            header('Location: /index.php?error=' . urlencode('Valitsemasi käyttäjänimi on jo käytössä'));
            exit;
        }
        $query->close();
    }
}

// generoi salt
$salt = bin2hex(random_bytes(128));
$rolenumber = 3;

//lisää tiedot tietokantaan
$query = $mysqli->prepare('INSERT INTO members (username, password, salt, role) VALUES (?,?,?,?)');
if ($query) {
    $hashed_passwd = hash_pbkdf2('sha512', $_POST['registerPassword'], $salt, 45000, 256);
    $query->bind_param('sssi', $_POST['inputName1'], $hashed_passwd, $salt, $rolenumber);
    if ($query->execute()) { 
        header('Location: /index.php?success=' . urlencode('Adminkäyttäjän luonti onnistui.'));
    } else {
        header('Location: /index.php?error=' . urlencode('case 3: execute epäonnistui'));
        exit;
    }
} else {
    header('Location: /index.php?error=' . urlencode('case 3: prepare epäonnistui.'));
    exit;
}

?>