<?php include_once("include.php");
$user = new user;
?>
<div class="container-fluid">
	<div class="row">
		<div class="col">
		<br>
			<div class="alert alert-danger fade show" role="alert">
				<?php 
				$sollies = $conn->query("SELECT answered FROM staffapplication WHERE answered = '0'");
				$sollies = $sollies->num_rows;
				$server = runarray("SELECT * FROM server_status"); if ($server['users_online'] == 1) {?>
				Momenteel is er <b>1 Dyna online</b>,
				<?php } else { ?>
				Momenteel zijn er <b><?=$server['users_online']?> Dyna's</b> online,
				<?php } ?>
				 zijn er <b><?=$server['loaded_rooms']?> kamers</b> geladen en <b><?=$sollies?> onbeantwoordde sollies</b>.
			</div>
			<div class="alert alert-info fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h5>Welkom <?=$_SESSION['username']?> in ModTools. </h5>	<br>
				Alles wat jij hier doet of veranderd kan worden teruggevonden. bugs en errors graag doorgeven zodat Marvin of Romian het zsm kan veranderen.<br>
				Je bent ingelogd met account, <b><?=$_SESSION['username']?></b>, ip <b><?=$_SERVER['HTTP_X_FORWARDED_FOR']?></b>, en je hebt rank <b><?=$_SESSION['rank']?></b> (dat is <b><?=$_SESSION['rankname']?></b>)
            </div>
		</div>
	</div>
	<div class="row">
		<div class="col">
		  <h2>Laatste  gebruikers online:</h2>
		  <table style="width: 100%;" class="table table-bordered table-hover">
			<tr>
				<td><b>USER</b></td>
				<td><b>TIME</b></td>
				<td><b>IP</b></td>
			</tr>
			<?php 		
			foreach(runassoc("SELECT * FROM `user_session_log` ORDER BY `id` DESC LIMIT 5") as $row) {
				$userdata = runarray("SELECT id, username FROM users WHERE id = '" . $row['userid'] . "'");
			?>
				<tr>
					<td><a href="users.php?id=<?=$userdata["id"]?>"><?=$userdata["username"]?></a></td>
					<td><?=date("d/m/Y H:i", $row["date"])?></td>
					<td><?=$row["ip"]?></td>
				</tr>
				<?php } ?>
		  </table>
		</div>
		<div class="col">
		  <h2>laatst gemaakte kamers:</h2>
		  <table style="width: 100%;" class="table table-bordered table-hover">
			<tr>
				<td><b>NAAM</b></td>
				<td><b>DOOR</b></td>
				<td><b>MOMENTEEL ONLINE</b></td>
			</tr>
			<?php foreach(runassoc("SELECT * FROM `rooms` ORDER BY `id` DESC LIMIT 5") as $row) {?>
				<tr>
					<td><a href="rooms.php?id=<?=$row["id"]?>"><?=$row["caption"]?></a></td>
					<td><a href="users.php?id=<?=$row["owner_id"]?>"><?=$user->getspecific("username", $row['id'])?></a></td>
					<td><?=$row["users_now"]?></td>
				</tr>
			<?php } ?>
		  </table>
		</div>
		<div class="col">
			<h2>Laatste groep aangemaakt:</h2>
			<table style="width: 100%;" class="table table-bordered table-hover">
				<tr>
					<td><b>NAAM</b></td>
					<td><b>KAMER</b></td>
					<td><b>DESC</b></td>
				</tr>
				<?php 		
				
				foreach(runassoc("SELECT * FROM `groups`") as $row) {
					$room = runarray("SELECT caption from rooms WHERE id = '" . $row['room_id'] . "'");
					if (!$room) { $room["name"] = "VERWIJDERD"; }
					?>
					<tr>
						<td><a href="guilds.php?id=<?=$row["id"]?>"><?=$row["name"]?></a></td>
						<td><a href="room.php?id=<?=$row["id"]?>"><?=$room["caption"]?></a></td>
						<td><?=$row["desc"]?></td>
					</tr>
					<?php } ?>
			</table>	  
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col">
		<h2>Laatste Chatlogs:</h2>
		<table style="width: 100%;" class="table table-striped table-hover">
			<tr>
				<td><b>ROOM</b></td>
				<td><b>USER</b></td>
				<td><b>TIME</b></td>
				<td style="width: 70%;"><b>MESSAGE</b></td>
				
			</tr>
			<?php
			foreach(runassoc("SELECT * FROM chatlogs ORDER BY timestamp DESC LIMIT 20") as $chatlogrow) {
				$whatroomrow = runarray("SELECT id, caption FROM rooms WHERE id = '" . $chatlogrow['room_id'] . "'");
				$whatuserrow = runarray("SELECT id, username FROM users WHERE id = '" . $chatlogrow['user_id'] . "'")
			?>
			<tr>
				<td><a href="rooms.php?id=<?=$whatroomrow['id']?>"><?=$whatroomrow['caption']?></a></td>
				<td><a href="users.php?id=<?=$whatuserrow['id']?>"><?=$whatuserrow['username']?></a></td>
				<td><?=date("d/m/Y H:i:s", $chatlogrow['timestamp'])?></td>
				<td><?=$chatlogrow['message']?></td>
				
			</tr>
			<?php } ?>
			</table>
		</div>
	</div>

<hr>
&copy; DynaHotel 2018 Made with &hearts; by <a href="https://dynafools.com">ItsMeRomian</a>
<br><br>
</div>