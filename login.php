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
}
