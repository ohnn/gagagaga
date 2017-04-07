<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');

require_once 'db/connect.php';

// aikavyöhyke
date_default_timezone_set ( 'Europe/Helsinki' );

class AvailableTimes {
	
	private function getTimes(string $givenDate) {
		global $hene;
		if (!$conn = $hene->prepare('SELECT laakari.etunimi, kalenteri.pvm, kalenteri.klo
									FROM kalenteri
										LEFT JOIN hene.laakari ON kalenteri.laakariID = laakari.laakariID 
									WHERE (kalenteri.pvm =?)')) {
			echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
			exit;
		}
		
		if (!$conn->bind_param('s', $givenDate)) {
			echo "Binding parameters failed: (" . $conn->errno . ") " . $conn->error;
			exit;
		}
		
		if (!$conn->execute()) {
			echo "Execute failed: (" . $conn->errno . ") " . $conn->error;
			exit;
		}
	
		$results = $conn->get_result();
		$times = array();
		
		while ($row = $results->fetch_array(MYSQLI_ASSOC)) {
			$times[] = $row;
		}
		
		$conn->close();
		
		return $times;
	}
	
	public function printTimes (string $calendarDate) {
		$times = $this->getTimes($calendarDate);
		
		echo "<table class=\"availableTimes table table-hover table-striped table-bordered\">";
		echo "<thead><tr><th>Etunimi</th><th>Päivämäärä</th><th>Aika</th></tr></thead>";
		echo "<tbody>";
		
		foreach($times as $current) {
			echo "<tr>";
			
			foreach($current as $value) {
				echo "<td>$value</td>";
			}
			
			echo "</tr>";
		}
		
		echo "</tbody>";
		echo "</table>";
	}

}
?>