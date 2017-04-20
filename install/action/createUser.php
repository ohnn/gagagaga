<?php
// generoi salt
$salt = bin2hex(random_bytes(128));
$rolenumber = 3;

//lisää tiedot tietokantaan
$query = $mysqli->prepare('INSERT INTO members (username, password, salt, role) VALUES (?,?,?,?)');
if ($query) {
    $hashed_passwd = hash_pbkdf2('sha512', $_POST['registerPassword'], $salt, 45000, 256);
    $query->bind_param('sssi', $_POST['inputName1'], $hashed_passwd, $salt, $rolenumber);
    if ($query->execute()) { 
        header('Location: /index.php?success=' . urlencode('Asennus onnistui!'));
    } else {
        exit;
    }
} else {
    exit;
}
?>