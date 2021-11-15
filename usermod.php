<?php
session_start();
include_once('modtoolsconfig.php');
$id = $_POST['id'];
if ($_POST['motto'] !== "") {
	$key = "motto";
	$value = $_POST['motto'];
}
if ($_POST['mail'] !== "") {
	$key = "mail";
	$value = $_POST['mail'];
}
if ($_POST['rank'] !== "") {
	$key = "rank";
	$value = $_POST['rank'];
}
if ($_POST['credits'] !== "") {
	$key = "credits";
	$value = $_POST['credits'];
}
if ($_POST['pixels'] !== "") {
	$key = "pixels";
	$value = $_POST['pixels'];
}

$key = $conn->real_escape_string($key);
$value = $conn->real_escape_string($value);

$sql = "UPDATE `users` SET `$key`='$value' WHERE (`id`='$id')";
$result = $conn->query($sql);
if ($result == "1") {
	createLog('userMod', $_SESSION['id'], $id, "alter $key with value $value");
	header("Location: users.php?id=$id&back=success");
} else {
	echo $conn->error;
}
