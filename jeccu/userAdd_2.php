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

//salt & rolenumber
$salt = bin2hex(random_bytes(128));
$rolenumber = 2;

$query = $hene->prepare('INSERT INTO laakari (etunimi, sukunimi, puhelin, erikoisalaID,
                        sahkoposti, toimipisteID) VALUES (?,?,?,?,?,?)');
if ($query) {
    $query->bind_param('sssisi', $_POST['firstName'], $_POST['lastName'], $_POST['phoneNumber'],
                        intval($_POST['erikoisalaID']), $_POST['email'], intval($_POST['toimipisteID']));
    if ($query->execute()) {
        $lastUsed = $query->insert_id;
        $query = $mysqli->prepare('INSERT INTO members (username, password, salt, role, doctorID) VALUES (?,?,?,?,?)');
        if ($query) {
            $hashed_passwd = hash_pbkdf2('sha512', $_POST['registerPassword'], $salt, 45000, 256);
            $query->bind_param('sssii', $_POST['inputName1'], $hashed_passwd, $salt, $rolenumber, $lastUsed);
            if ($query->execute()) { 
                header('Location: /index.php?success=' . urlencode('Lääkärikäyttäjän luonti onnistui.'));
            } else {
                header('Location: /index.php?error=' . urlencode('case 2: members/execute epäonnistui.'));
                exit;
            }
        } else {
            header('Location: /index.php?error=' . urlencode('case 2: members/prepare epäonnistui.'));
            exit;
        }
    } else {
        print_r( $query );
        exit;
    }
} else {
    header('location: /index.php?error=' . urlencode('prepare epäonnistui.'));
    exit;
}

?>