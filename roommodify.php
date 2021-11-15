<?php
session_start();
include_once("modtoolsconfig.php");
$id = $conn->real_escape_string($_POST['id']);
$name = $conn->real_escape_string($_POST['name']);
$setprivate = $conn->real_escape_string($_POST['setprivate']);

if ($setprivate == "on") {
	$sql = "UPDATE `rooms` SET `caption`='$name',`state`='password',`password`='hahahahahahah' WHERE (`id`='$id') LIMIT 1";
} else {
	$sql = "UPDATE `rooms` SET `caption`='$name',`state`='open',`password`='NULL' WHERE (`id`='$id') LIMIT 1";
}
$result = $conn->query($sql);
if ($result == "1") {
	createLog('roomMod', $_SESSION['id'], $id, "alter caption with value $name");
	header("Location: rooms.php?id=" . $id . "&back=success");
} else {
	echo $conn->error;
}
