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
	
	private static function getTimes(string $givenDate) {
		global $hene;
		
		if (!$conn = $hene->prepare('SELECT laakari.etunimi, laakari.sukunimi, erikoisala.erikoisalaseloste, toimipiste.toimipistenimi, kalenteri.pvm, kalenteri.klo, kalenteri.varausID 
									FROM kalenteri
										LEFT JOIN hene.laakari ON kalenteri.laakariID = laakari.laakariID 
										LEFT JOIN hene.erikoisala ON laakari.erikoisalaID = erikoisala.erikoisalaID
										LEFT JOIN hene.toimipiste ON laakari.toimipisteID = toimipiste.toimipisteID
									WHERE (kalenteri.pvm =? AND kalenteri.asiakasID=?)')) {
			echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
			exit;
		}
		
		$asiakasID = 0;
		
		if (!$conn->bind_param('si', $givenDate, $asiakasID)) {
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
			// pvm oikeaan muotoon
			$rowDate = new DateTime($row['pvm']);
			$row['pvm'] = $rowDate->format('d.m.Y');
			
			// sekunnit pois ajoista
			$rowDate = new DateTime($row['klo']);
			$row['klo'] = $rowDate->format('H:i');
			
			// yhdistä etu -ja sukunimi
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
		
		// check if anyone has reserved given time
		if (!$conn = $hene->prepare('SELECT asiakasID FROM kalenteri WHERE varausID =?')) {
			echo "Prepare failed while checking time status: (" . $conn->errno . ") " . $conn->error;
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
        $conn->close;
		
	}
	
	public static function printTimes (string $calendarDate) {
		$times = AvailableTimes::getTimes($calendarDate);
		
		echo "<table class=\"availableTimes table table-hover table-striped\">";
		echo "<thead><tr><th>Nimi</th><th>Erikoisala</th><th>Toimipiste</th><th>Päivämäärä</th><th>Aika</th></tr></thead>";
		echo "<tbody>";
		
		foreach($times as $row) {
			echo "<tr class=\"timeRow\" onclick=\"addData(this)\" data-id=\"". $row['varausID'] . "\" data-toggle=\"modal\" data-target=\"#reserveModal\">";
			
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

}
?>