<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../db/connect.php';

class AvailableTimes {
    
    private $sqlCommand;
    
    function __construct() {
        $this->sqlCommand = 'SELECT kalenteri.laakariID, kalenteri.pvm, kalenteri.klo WHERE kalenteri.laakariID =?';
    }
    
    public function getAvailableTimes() {
        
        if ($query = $hene->prepare($this->sqlCommand)) {
            $laakariID = 5;
            $query->bind_param('i', $laakariID);
            if ($query->execute()) {
                $result = $query->get_results();
                $row = $result->fetch_array(MYSQLI_ASSOC);
                print_r($row);
            } else {
                header('location: /index.php?error=' . urlencode('getAvailableTimes execute epäonnistui'));
                exit;  
            }
        } else {
            header('location: /index.php?error=' . urlencode('getAvailableTimes prepare epäonnistui'));
            exit;
        }
        
    }
    
    
}

?>