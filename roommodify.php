<?php
$conn = new mysqli("localhost", "user", "mijnkreft", "2018");
$id = $_GET['id'];
$name = $_GET['name'];
$setprivate = $_GET['setprivate'];
if ($setprivate == "on") {
	$sql = "UPDATE `rooms` SET `caption`='$name',`state`='password',`password`='hahahahahahah' WHERE (`id`='$id') LIMIT 1";
} else {
	$sql = "UPDATE `rooms` SET `caption`='$name',`state`='open',`password`='NULL' WHERE (`id`='$id') LIMIT 1";
}
$result = $conn->query($sql);
if ($result == "1") {
	header("Location: rooms.php?id=" . $id . "&back=success");
} else {
	echo $conn->error;
}