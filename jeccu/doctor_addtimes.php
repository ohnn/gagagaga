<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 'on');

require_once '../db/connect.php';

$startDate = new DateTime($_POST['startDate']);
$endDate = new DateTime($_POST['endDate']);
$startTime = new DateTime($_POST['startTime']);
$endTime = new DateTime($_POST['endTime']);

if (!empty($startDate) && !empty($endDate) && !empty($startTime) && !empty($endTime)) {

    $endDate->add(new DateInterval('P01D'));
    $dateInterval = DateInterval::createFromDateString('1 day');
    $datePeriod = new DatePeriod($startDate, $dateInterval, $endDate);
    
    $endTime->add(new DateInterval('PT30M'));
    $timeInterval = DateInterval::createFromDateString('30 minutes');
    $timePeriod = new DatePeriod($startTime, $timeInterval, $endTime);
    
    foreach ($datePeriod as $currentDate) {
        foreach($timePeriod as $currentTime) {
            $date = $currentDate->format('Y-m-d');
            $time = $currentTime->format('H:i:s');
            $doctorID = intval($_SESSION['doctorID']);
            if ($query = $hene->prepare('SELECT * FROM kalenteri WHERE (laakariID=? AND pvm=? AND klo=?)')) {
                $query->bind_param('sss', $doctorID, $date, $time);
                if ($query->execute()) {
                    $query->store_result();
                    if ($query->num_rows == 0) {
                        if ($query = $hene->prepare('INSERT INTO kalenteri (laakariID,pvm,klo) VALUES (?,?,?)')) {
                            $query->bind_param('iss', $doctorID, $date, $time);
                            if ($query->execute()) {
                                $query->close();
                                header('Location: /index.php?success=' . urlencode('Työaikojen lisääminen onnistui'));
                            } else {
                                $query->close();
                                header('Location: /index.php?error=' . urlencode('execute epäonnistui'));
                                exit;
                            }
                        } else {
                            $query->close();
                            header('Location: /index.php?error=' . urlencode('prepare epäonnistui'));
                            exit;
                        }
                    } else {
                        $query->close();
                        header('Location: /index.php?error=' . urlencode('Kaikki lisäämistäsi ajoista on jo lisätty tietokantaan'));
                    }    
                } else {
                    $query->close();
                    header('Location: /index.php?error=' . urlencode('testi execute epäonnistui'));
                    exit;
                }        
            } else {
                header('Location: /index.php?error=' . urlencode('testi prepare epäonnistui'));
                exit;
            }    
        }
    }
} else {
    $query->close();
    header('Location: /index.php?error=' . urlencode('KAIKKI MENI PIELEEN'));
    exit;
}

?>