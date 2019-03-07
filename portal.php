<?php
include_once('modtoolsconfig.php');

$ticket = $_GET['ticket'];
$id = $_GET['user'];

$result = $conn->query("SELECT username, rank, admticket, id FROM users WHERE id = '$id' AND admticket = '$ticket'");
$row = $result->fetch_array();

$rankresult = $conn->query("SELECT name FROM ranks WHERE id = '". $row['rank']."'");
$rankrow = $rankresult->fetch_array();

if($result->num_rows) {
	session_start();
		$_SESSION["logged"] = 1;
		$_SESSION["username"] = $row['username'];
		$_SESSION["id"] = $row['id'];
		$_SESSION["rank"] = $row['rank'];
		$_SESSION["rankname"] = $rankrow['name'];
		header("Location: home.php");
} else {
	?>
	
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<link rel="icon" href="<?=$hotel['theme']?>/images/icons/senha.gif" type="image/x-icon" />
</head>
<center>
<h1>oof</h1>
<p>Je auth ticket ( <?=$ticket?> ), hoort niet bij je user id ( <?=$id?> ). <br><br>
Das best slecht vgm idk. ahah probeer opneuw in te loggen <a href="<?=$hotel['base']?>/logout">klik hier</a><br><br>
<img src="<?=$hotel['theme']?>/images/staff/frank_02.gif">
</center>
	
	<?php
}