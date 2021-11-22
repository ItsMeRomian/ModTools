<?php
class guild {
	//Returns current guild info info
	public function get($what){
		$row = runarray("SELECT * FROM `groups` WHERE id = '" . $_GET['id'] . "'");
		return $row[$what];
	}
	//Returns specific guild info
	public function getspecific($what, $who){
		$row = runarray("SELECT * FROM `groups` WHERE id = '" . $who . "'");
		return $row[$what];
	}
	//Runs at start of page
	public function start(){
		if (isset($_GET['name'])) {
			header("Location: guilds.php?id=" . $this->get('id'));
		}
	}
}