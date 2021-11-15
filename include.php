<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once('modtoolsconfig.php');

session_start();

//Send back if not logged
if (!$_SESSION['logged']) {
	header("Location: index.php");
}

//Load classes
foreach (glob('classes/*.php') as $classes) {
	include_once($classes);
}

//Strip .php from url (normal urls still work.)
if (strpos($_SERVER["REQUEST_URI"], ".php") !== false) {
	$stripped = str_replace('.php', '', $_SERVER["REQUEST_URI"]);
	header("Location: http://" . $_SERVER["SERVER_NAME"] . "" . $stripped);
}

//Fuctions to return sql's faster and easier. 
// runarray() returns a single array once, runassoc() returns multible arrays in a while loop
function runarray($sql)
{
	global $conn;
	$result = $conn->query($sql);
	if (!$result) {
		echo ("died while executing sql: <b>" . $sql);
		echo $result;
	} else {
		return $result->fetch_array();
	}
}
function runassoc($sql)
{
	global $conn;
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
		$return[] = $row;
	}
	if (isset($return)) {
		return $return;
	} else {
		return 0;
	}
}
?>
<html>
<!DOCTYPE html>

<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<link rel="icon" href="<?= $hotel['theme'] ?>/images/icons/senha.gif" type="image/x-icon" />
	<title>ModTools - <?= $_SESSION['username'] ?> (<?= $_SESSION['id'] ?>)</title>
	<script>
		function show(ye) {
			var x = document.getElementById(ye);
			if (x.style.display === "none") {
				x.style.display = "block";
			} else {
				x.style.display = "none";
			}
		}
	</script>

</head>

<body style="">

	<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
		<a class="navbar-brand" href="home.php"><img style="width: 100px;" src="logo2.png"> MODTOOLS</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav">
				<a class="nav-item nav-link " href="home.php">Home </a>
				<a class="nav-item nav-link" href="users.php">Users</a>
				<a class="nav-item nav-link" href="rooms.php">Rooms</a>
				<a class="nav-item nav-link " href="guilds.php">Guilds</a>
				<a class="nav-item nav-link " href="news.php">News (beta)</a>
				<a class="nav-item nav-link " href="sollies.php">Sollies</a>
			</div>
			<div class="navbar-nav ml-auto" style="color: white;">
				<a class="nav-item nav-link btn btn-success" style="color: white; margin-right: 5px;" target="_BLANK" href="<?= $hotel['base'] ?>/client">CLIENT (new tab) »</a>
				<a class="nav-item nav-link btn btn-danger" style="color: white;" href="logout.php">Logout »</a>
			</div>
		</div>
	</nav>