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

// aikavyöhyke
date_default_timezone_set ( 'Europe/Helsinki' );

class AvailableTimes {
	
	// to get times with any date, set the first parameter to "1"
	// to get times with no reservation, set the second paremeter to 0, to get times with any reservation, set second parameter to -1
	// to get times with any doctor, set 3rd paremeter to 0
	private static function getTimes(string $givenDate, $asiakasID, $doctorID) {
		global $hene;
		
		// datequery
		if ($givenDate == "1") {
			$datequery = "1=?";
		} else {
			$datequery = "kalenteri.pvm =?";
		}
		
		// doctorquery
		if ($doctorID == 0) {
			$doctorquery = "0=?";
		} else {
			$doctorquery = "kalenteri.laakariID = ?";
		}
		
		// customerquery
		if ($asiakasID >= 0) {
			$customerquery = 'kalenteri.asiakasID = ?';
		} else {
			$customerquery = '0>? AND kalenteri.asiakasID <> 0';
		}
		
		
		if (!$conn = $hene->prepare('SELECT laakari.etunimi, laakari.sukunimi, erikoisala.erikoisalaseloste, toimipiste.toimipistenimi, kalenteri.pvm, kalenteri.klo, kalenteri.varausID 
									FROM kalenteri 
										LEFT JOIN hene.laakari ON kalenteri.laakariID = laakari.laakariID 
										LEFT JOIN hene.erikoisala ON laakari.erikoisalaID = erikoisala.erikoisalaID 
										LEFT JOIN hene.toimipiste ON laakari.toimipisteID = toimipiste.toimipisteID 
									WHERE ('.$datequery.' AND '.$customerquery.' AND '.$doctorquery.')')) {
			trigger_error($hene->error);
			exit;
		}
		
		if (!$conn->bind_param('sii', $givenDate, $asiakasID, $doctorID)) {
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
			// format date
			$rowDate = new DateTime($row['pvm']);
			$row['pvm'] = $rowDate->format('d.m.Y');
			
			// format hours:minutes
			$rowDate = new DateTime($row['klo']);
			$row['klo'] = $rowDate->format('H:i');
			
			// combine first and last name
			$row['etunimi'] = $row['etunimi'] . ' ' . $row['sukunimi'];
			unset($row['sukunimi']);
			
			$times[] = $row;
		}        
		
		$conn->close();
		
		return $times;
	}
	
	// Check if given time is reserved. Returns true if available, false if reserved
	private static function checkTimeStatus (int $time) {
		global $hene;
		
		if (!$conn = $hene->prepare('SELECT asiakasID FROM kalenteri WHERE varausID =?')) {
			trigger_error($hene->error);
			exit;
		}
		
		if (!$conn->bind_param('i', $timeToReserve)) {
			echo "Binding paremeters failed while checking time status: (" . $conn->errno . ") " . $conn->error;
			exit;
		}
		
		if (!$conn->execute()) {
			echo "Execute failed while checking time status: (" . $conn->errno . ") " . $conn->error;
			exit;
		}
		
		$results = $conn->get_result();
		
		$row = $results->fetch_array(MYSQLI_ASSOC);
		
		return $row['asiakasID'] == 0;
		
		$conn->close();
	}
	
	// reserve time to given customer
	public static function reserveTime (int $timeToReserve, int $asiakas, string $message) {
		global $hene;
		
		// make sure the time is available
		if (!AvailableTimes::checkTimeStatus($timeToReserve)) {
			header('Location: /index.php?error=' . urlencode('Tapahtui virhe. Valitsemasi aika on jo varattu. Valitse toinen aika'));
        	exit;
		}
		
		if (!$conn = $hene->prepare('UPDATE kalenteri SET asiakasID=?, viesti=? WHERE varausID=?')) {
			echo "Prepare failed while reserving time: (" . $conn->errno . ") " . $conn->error;
			exit;			
		}
		
		if (!$conn->bind_param('isi', $asiakas, $message, $timeToReserve)) {
			echo "Binding parameters failed while reserving time: (" . $conn->errno . ") " . $conn->error;
			exit;
		}
		
		if (!$conn->execute()) {
			echo "Execute failed while reserving time: (" . $conn->errno . ") " . $conn->error;
			exit;
		}
		
		header('Location: /index.php?success=' . urlencode('Ajan varaaminen onnistui.'));
        $conn->close();
		
	}
	
	
	// for reserving times
	public static function printTimes (string $calendarDate) {
		// given date, no reservation, any doctor
		$times = AvailableTimes::getTimes($calendarDate, 0, 0);
		
		echo "<table class=\"availableTimes table table-hover table-striped\">";
		echo "<thead><tr><th>Nimi</th><th>Erikoisala</th><th>Toimipiste</th><th>Päivämäärä</th><th>Aika</th></tr></thead>";
		echo "<tbody>";
		
		foreach($times as $row) {
			echo "<tr class=\"timeRow\" onclick=\"addData(this, '#varausID')\" data-id=\"". $row['varausID'] . "\" data-toggle=\"modal\" data-target=\"#reserveModal\">";
			
			foreach($row as $key => $value) {
				if ($key != 'varausID') {
					echo "<td>$value</td>";
				}	
			}
			
			echo "</tr>";
		}
		
		echo "</tbody>";
		echo "</table>";
	}
	
	// for canceling reservations
	public static function printTimesCustomer (int $customer) {
		// any date, given customer, any doctor
		$times = AvailableTimes::getTimes("1", $customer, 0);
		
		if (isset($times[0])) {
			
			echo "<h2 class=\"freeTime customerTimes\">Varaamasi ajat</h2>";
			echo "<table class=\"freeTime table table-hover table-striped customerTimes\">";
			echo "<thead><tr><th>Nimi</th><th>Erikoisala</th><th>Toimipiste</th><th>Päivämäärä</th><th>Aika</th></tr></thead>";
			echo "<tbody>";
			
			foreach($times as $row) {
				echo "<tr class=\"timeRow\" data-id=\"". $row['varausID'] . "\" id=\"". $row['varausID'] . "\">";
				
				foreach($row as $key => $value) {
					if ($key != 'varausID') {
						echo "<td>$value</td>";
					}	
				}
				
				echo "<td id=\"removeReservation\" data-toggle=\"modal\" data-target=\"#confirmModal\" onclick=\"addData(this, '#confirmButton')\" data-id=\"". $row['varausID'] . "\"><span class=\"glyphicon glyphicon-remove\"></span> Poista</td></tr>";
			}
			
			echo "</tbody>";
			echo "</table>";
			
		} else {
			echo '<h1 class="freeTime customerTimes">Et ole varannut yhtään aikaa.</h1>';
		}
	}
	
	public static function printTimesDoctor (int $doctor) {
		global $hene;
		
		// any date, reserved to any customer, given doctor
		$times = AvailableTimes::getTimes("1", -1, $doctor);
		
		if (!$conn = $hene->prepare('SELECT asiakas.etunimi, asiakas.sukunimi, kalenteri.viesti
									FROM asiakas
										LEFT JOIN hene.kalenteri ON asiakas.asiakasID = kalenteri.asiakasID
									WHERE (kalenteri.laakariID = ?) AND kalenteri.asiakasID > 0')) {
			trigger_error($hene->error);
			exit;								
		}
		
		if (!$conn->bind_param('i', $doctor)) {
			echo "Binding parameters failed: (" . $conn->errno . ") " . $conn->error;
			exit;
		}
		
		if (!$conn->execute()) {
			echo "Execute failed: (" . $conn->errno . ") " . $conn->error;
			exit;
		}
		
		$results = $conn->get_result();
		$customerNames = array();
		
		while ($row = $results->fetch_array(MYSQLI_ASSOC)) {
			// combine first and last name
			$row['etunimi'] = $row['etunimi'] . ' ' . $row['sukunimi'];
			unset($row['sukunimi']);
			
			$customerNames[] = $row;
		}
		
		foreach($times as $key => $current) {
			$times[$key]['etunimi'] = $customerNames[$key]['etunimi'];
			
			unset($times[$key]['erikoisalaseloste']);
			unset($times[$key]['toimipistenimi']);
		}
		
		
		
		
		if (isset($times[0])) {
			
			echo "<h2 class=\"freeTime customerTimes\">Sinulle varatut ajat</h2>";
			echo "<table class=\"freeTime table table-hover table-striped customerTimes\">";
			echo "<thead><tr><th>Nimi</th><th>Päivämäärä</th><th>Aika</th></tr></thead>";
			echo "<tbody>";
			
			foreach($times as $row) {
				echo "<tr class=\"timeRow\" data-id=\"". $row['varausID'] . "\" id=\"". $row['varausID'] . "\">";
				
				foreach($row as $key => $value) {
					if ($key != 'varausID') {
						echo "<td>$value</td>";
					}	
				}
				
				echo "<td id=\"removeReservation\" data-toggle=\"modal\" data-target=\"#confirmModal\" onclick=\"addData(this, '#confirmButton')\" data-id=\"". $row['varausID'] . "\"><span class=\"glyphicon glyphicon-remove\"></span> Poista</td></tr>";
			}
			
			echo "</tbody>";
			echo "</table>";
			
		} else {
			echo '<h1 class="freeTime customerTimes">Yhtään varattua aikaa ei löytynyt.</h1>';
		}
		
		
	}
	
	public static function freeTime (int $timeID) {
		
		global $hene;
		
		if (!$conn = $hene->prepare('UPDATE kalenteri SET asiakasID=0, viesti=NULL WHERE varausID=?')) {
			trigger_error($hene->error);
			exit;
		}
		
		
		if (!$conn->bind_param('i', $timeID)) {
			echo "Binding paremeters failed while freeing time: (" . $conn->errno . ") " . $conn->error;
			exit;
		}
		
		if (!$conn->execute()) {
			echo "Execute failed while freeing time: (" . $conn->errno . ") " . $conn->error;
			exit;
		}
		
	//	header('Location: /index.php?success=' . urlencode('Varauksen poistaminen onnistui.'));
		$conn->close();
		
	}

}
?>