<?php


require_once '../db/connect.php';

$query = $mysqli->prepare('SELECT username,password,salt,role,userID,doctorID FROM members WHERE username=?');

if ($query) {
    $query->bind_param('s', $_POST['inputName']);
    if ($query->execute()) {
        $result = $query->get_result();
        $row = $result->fetch_array(MYSQLI_NUM);
        if (!empty($row)) {
            $hashed_passwd = hash_pbkdf2('sha512', $_POST['inputPassword'], $row[2], 45000, 256);
            if ($row[1] == $hashed_passwd) {
                session_start();
                $_SESSION['username'] = $row[0];
                $_SESSION['role'] = $row[3];
                $_SESSION['logged'] = true;
                switch ($_SESSION['role']) {
                    case 2:
                        $_SESSION['doctorID'] = $row[5];
                        break;
                    case 1:
                        $_SESSION['userID'] = $row[4];
                        break;
                    default:
                        break;
                }
                header('Location: /');
            } else {
                header('Location: /index.php?error=' . urlencode('Salasana on väärä'));
                exit;
            }
        } else {
            header('Location: /index.php?error=' . urlencode('Käyttäjätunnusta ei löydy'));
            exit;
        }
        $query->close();
    }
}

?>