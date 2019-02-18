<?php
class user {
	//Returns current user info info
	public function get($what) {
		$row = runarray("SELECT * FROM users WHERE id = '" . $_GET['id'] . "'");
		return $row[$what];
	}
	//Returns specific users info
	public function getspecific($what, $who) {
		$row = runarray("SELECT * FROM users WHERE id = '" . $who . "'");
		return $row[$what];
	}
	//Runs at start of page
	public function start() {
		if (isset($_GET['name'])) {
            $row = runarray("SELECT id FROM users WHERE username = '" . $_GET['name'] . "'");
			header("Location: users.php?id=" . $row['id']);
		}
	}
	//Returns ban information
	public function banned() {
		$checkban = runarray("SELECT * FROM bans WHERE bantype = 'user' AND value = '". $this->get('id') . "'");
		if ($checkban) {
			$bannedbyrow = runarray("SELECT username FROM users WHERE id = '" . $checkban['added_by'] . "'");
			return $checkban;
		} else {
			return 0;
		}
	}
}