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


$salt = bin2hex(random_bytes(128));

//tallenna lomakkeen tiedot tietokantoihin  erikoisalaID,, toimipisteID
/**switch (intval($_POST['role'])) {
    case 2:
        $rolenumber = 2;
        $query = $hene->prepare('INSERT INTO laakari (etunimi, sukunimi, puhelin,
                                sahkoposti) VALUES (?,?,?,?)');
        if ($query) {
            $query->bind_param('ssss', $_POST['firstName'], $_POST['lastName'], $_POST['phoneNumber'], $_POST['email']);
            if ($query->execute()) {
                $lastUsed = $query->insert_id;
                $query = $mysqli->prepare('INSERT INTO members (username, password, salt, role, userID) VALUES (?,?,?,?,?)');
                if ($query) {
                    $hashed_passwd = hash_pbkdf2('sha512', $_POST['registerPassword'], $salt, 45000, 256);
                    $query->bind_param('sssii', $_POST['inputName1'], $hashed_passwd, $salt, $rolenumber, $lastUsed);
                    if ($query->execute()) { 
                        header('Location: /index.php?success=' . urlencode('Käyttäjän luonti onnistui. Voit nyt kirjautua sisään.'));
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
        break;
        
    case 3:
        $rolenumber = 3;
        $query = $mysqli->prepare('INSERT INTO members (username, password, salt, role) VALUES (?,?,?,?)');
        if ($query) {
            $hashed_passwd = hash_pbkdf2('sha512', $_POST['registerPassword'], $salt, 45000, 256);
            $query->bind_param('ssii', $_POST['inputName1'], $hashed_passwd, $salt, $rolenumber);
            if ($query->execute()) { 
                header('Location: /index.php?success=' . urlencode('Käyttäjän luonti onnistui. Voit nyt kirjautua sisään.'));
            } else {
                header('Location: /index.php?error=' . urlencode('case 3: execute epäonnistui'));
                exit;
            }
        } else {
            header('Location: /index.php?error=' . urlencode('case 3: prepare epäonnistui.'));
            exit;
        }
        break;
    
    default: **/
$rolenumber = 1;
$query = $hene->prepare('INSERT INTO asiakas (etunimi, sukunimi, sposti, lahiosoite, postinumero,
                postitoimipaikka, puhelinnumero) VALUES (?,?,?,?,?,?,?)');
if ($query) {
    $query->bind_param('sssssss', $_POST['firstName'], $_POST['lastName'], $_POST['email'],
                        $_POST['address'], $_POST['postalCode'], $_POST['postOffice'], $_POST['phoneNumber']);
    if ($query->execute()) {
        $lastUsed = $query->insert_id;
        $query = $mysqli->prepare('INSERT INTO members (username, password, salt, role, userID) VALUES (?,?,?,?,?)');
        if ($query) {
            $hashed_passwd = hash_pbkdf2('sha512', $_POST['registerPassword'], $salt, 45000, 256);
            $query->bind_param('sssii', $_POST['inputName1'], $hashed_passwd, $salt, $rolenumber, $lastUsed);
            if ($query->execute()) { 
                header('Location: /index.php?success=' . urlencode('Käyttäjän luonti onnistui. Voit nyt kirjautua sisään.'));
            } else {
                header('Location: /index.php?error=' . urlencode('default: members/execute epäonnistui'));
                exit;
            }
        } else {
            header('Location: /index.php?error=' . urlencode('default: members/prepare epäonnistui.'));
            exit;
        }
    } else {
        header('location: /index.php?error=' . urlencode('default: execute epäonnistui'));
        exit;
    }
} else {
    header('location: /index.php?error=' . urlencode('default: prepare epäonnistui.'));
    exit;
}

/**    break; 
}
**/
?>