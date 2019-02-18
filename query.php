<?php
$conn = new mysqli("localhost", "user", "mijnkreft", "2018");
$what = $_GET['what'];
switch($what) {
	case "deletegroup":
		$sql = "DELETE FROM `groups` WHERE (`id`='" . $_GET['id'] ."')";
		$back = "guilds.php?id=" . $_GET['id'] ."&back=deleted";
		break;
	case "deleteban":
		$sql = "DELETE FROM `bans` WHERE (`value`=" . $_GET['id'] .")";
		$back = "users.php?id=" . $_GET['id'] ."&back=unban";
		break;
	case "deleteroom":
		$sql = "DELETE FROM `rooms` WHERE (`id`='" . $_GET['id'] ."')";
		$back = "rooms.php?id=" . $_GET['id'] ."&back=deleted";
		break;
	case "deleteuotw":
		$sql = "DELETE FROM uotw";
		$back = "users.php?id=" . $_GET['id'] ."&back=success";
		break;
	case "deletenews":
		$sql = "DELETE FROM `cms_news` WHERE (`id`='" . $_GET['id'] ."')";
		$back = "news.php?back=deleted";
		break;
	case "makenews":
		$sql = "INSERT INTO cms_news (title, image, shortstory, longstory, author, date) VALUES ('" . $_GET['title'] ."', '" . $_GET['image'] ."', '" . $_GET['author'] ."', '" . $_GET['date'] ."', '" . $_GET['short'] ."', '" . $_GET['long'] ."')";
		$back = "news.php?id=" . $_GET['id'] ."&back=success";
		break;
	case "makeuotw":
		$conn->query("DELETE FROM uotw");
		$sql = "INSERT INTO uotw (userid, text) VALUES ('" . $_GET['id'] ."', '" . $_GET['text'] ."')";
		$back = "users.php?id=" . $_GET['id'] ."&back=success";
		break;
	case "makeban":
		$timestamp = strtotime('now');
		$sql = "INSERT INTO bans (bantype, value, reason, expire, added_by, added_date) VALUES ('user', '" . $_GET['id'] ."', '" . $_GET['ban_reason'] ."', '" . $_GET['ban_expire'] ."', '" . $_GET['user_staff_id'] ."', '$timestamp')";
		$back = "users.php?id=" . $_GET['id'] ."&back=success";
		break;
}
$result = $conn->query($sql);
if ($result == "1") {
	header("Location: $back");
} else {
	echo $conn->error;
}