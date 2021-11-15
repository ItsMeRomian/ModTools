<?php
if (!$_SESSION['logged']) {
	header("Location: index.php");
}

$conn = new mysqli("localhost", "debian-sys-maint", "s1fKB8eU4k6tODH4", "modtools");


$what = $conn->real_escape_string($_GET['what']);
$id = $conn->real_escape_string($_GET['id']);

switch ($what) {
	case "deletegroup":
		$sql = "DELETE FROM `groups` WHERE (`id`='" . $id . "')";
		$back = "guilds.php?id=" . $id . "&back=deleted";
		break;
	case "deleteban":
		$sql = "DELETE FROM `bans` WHERE (`value`=" . $id . ")";
		$back = "users.php?id=" . $id . "&back=unban";
		break;
	case "deleteroom":
		$sql = "DELETE FROM `rooms` WHERE (`id`='" . $id . "')";
		$back = "rooms.php?id=" . $id . "&back=deleted";
		break;
	case "deleteuotw":
		$sql = "DELETE FROM uotw";
		$back = "users.php?id=" . $id . "&back=success";
		break;
	case "deletenews":
		$sql = "DELETE FROM `cms_news` WHERE (`id`='" . $id . "')";
		$back = "news.php?back=deleted";
		break;
	case "makenews":
		$title = $conn->real_escape_string($_GET['title']);
		$image = $conn->real_escape_string($_GET['image']);
		$author = $conn->real_escape_string($_GET['author']);
		$date = $conn->real_escape_string($_GET['date']);
		$short = $conn->real_escape_string($_GET['short']);
		$long = $conn->real_escape_string($_GET['long']);
		$sql = "INSERT INTO cms_news (title, image, shortstory, longstory, author, date) VALUES ('$title', '$image', '$short', '$long', '$author', '$date')";
		$back = "news.php?id=" . $id . "&back=success";
		break;
	case "makeuotw":
		$conn->query("DELETE FROM uotw");
		$text = $conn->real_escape_string($_GET['text']);

		$sql = "INSERT INTO uotw (userid, text) VALUES ('" . $id . "', '" . $text . "')";
		$back = "users.php?id=" . $id . "&back=success";
		break;
	case "makeban":
		$timestamp = strtotime('now');
		$ban_reason = $conn->real_escape_string($_GET['ban_reason']);
		$ban_expire = $conn->real_escape_string($_GET['ban_expire']);
		$user_staff_id = $conn->real_escape_string($_GET['user_staff_id']);
		$sql = "INSERT INTO bans (bantype, value, reason, expire, added_by, added_date) VALUES ('user', '" . $id . "', '" . $ban_reason . "', '" . $ban_expire . "', '" . $user_staff_id . "', '$timestamp')";
		$back = "users.php?id=" . $id . "&back=success";
		break;
}
$result = $conn->query($sql);
if ($result == "1") {
	header("Location: $back");
} else {
	echo $conn->error;
}
