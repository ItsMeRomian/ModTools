<?php
class room {
	//Returns current room info info
	public function get($what){
		$row = runarray("SELECT * FROM rooms WHERE id = '" . $_GET['id'] . "'");
		return $row[$what];
	}
	//Returns specific room info
	public function getspecific($what, $who){
		$row = runarray("SELECT * FROM rooms WHERE id = '" . $who . "'");
		return $row[$what];
	}
	//Runs at start of page
	public function start(){
		if (isset($_GET['name'])) {
			header("Location: rooms.php?id=" . $this->get('id'));
		}
	}
}