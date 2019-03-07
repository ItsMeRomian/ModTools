<?php
include_once('modtoolsconfig.php');

$id = $_GET['id'];
if ($_GET['motto'] !== "") {
	$key = "motto";
	$value = $_GET['motto'];
}
if ($_GET['mail'] !== "") {
	$key = "mail";
	$value = $_GET['mail'];
}
if ($_GET['rank'] !== "") {
	$key = "rank";
	$value = $_GET['rank'];
}
if ($_GET['credits'] !== "") {
	$key = "credits";
	$value = $_GET['credits'];
}
if ($_GET['pixels'] !== "") {
	$key = "pixels";
	$value = $_GET['pixels'];
}
$sql = "UPDATE `users` SET `$key`='$value' WHERE (`id`='$id')";
$result = $conn->query($sql);
echo $result;
if ($result == "1") {
	header("Location: users.php?id=$id&back=success");
} else {
	echo $conn->error;
}