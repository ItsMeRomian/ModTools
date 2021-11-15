<?php
include_once('modtoolsconfig.php');
$username = $conn->real_escape_string($_POST['username']);
$password = password_hash($_POST["password"], PASSWORD_BCRYPT);

$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);

$row = $result->fetch_array();
$rank = "SELECT name FROM ranks WHERE id = '" . $row['rank'] . "'";

$rankresult = $conn->query($rank);
$rankrow = $rankresult->fetch_array();

$id = $row['id'];

// Haal alle logs op
$logs = $conn->query("SELECT * FROM `logs` WHERE user_id = $id AND log_type = 'failedlogin'")->fetch_all(MYSQLI_ASSOC);
if (!$logs) throw new Error("No logs found");

//Set vars
$hourBack = strtotime('now - 1 hour');
$firstInHourBack = null;
$end = null;

//Loop over elke verkeerde inlog. Als een verkeerde inlog in het vorige uur valt, setten we de 1e poging als $fisrtInHourBack.
// We pakken ook de allerlaatste poging. Als de hoeveelheid van deze pogingen > is dan 5. Dus 5x in het afgelopen uur, dan blokeren we de volgende inlogpoging.
for ($i = 0; $i < count($logs); $i++) {
	if (strtotime($logs[$i]['timestamp']) > $hourBack) {
		$firstInHourBack = $i;
	}
	$end = $i;
}
if (($end - $firstInHourBack) >= 5) {
	die("Je hebt te vaak verkeerd ingelogd in 1 uur (5x). Probeer het later nog eens.");
}
if (password_verify($_POST["password"], $row["password"])) {
	if ($row['rank'] >= 6) {
		createLog('login', $row['id'], null);
		session_start();
		$_SESSION["logged"] = 1;
		$_SESSION["username"] = $row['username'];
		$_SESSION["id"] = $row['id'];
		$_SESSION["rank"] = $row['rank'];
		$_SESSION["rankname"] = $rankrow['name'];
		header("Location: home.php");
	} elseif ($row['rank'] <= 5) {
		createLog('failedLogin', $row['id'], null, "rank: " . $row['rank']);
		if ($row['rank'] > 3) {
			die("Je hebt rank <b>" . $row['rank'] . "</b>. Je moet minimaal rank <b>6</b> hebben om in te loggen.");
		}
	}
} else {
	createLog('failedLogin', $row['id'], null, "Wrong pass");
	die("Wrong password");
}
