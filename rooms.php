<?php include_once("include.php"); 
$room = new room;
$user = new user;
?>
<div class="container-fluid">
<div class="row">
    <div class="col">
	<?php if (isset($_GET["back"])) {
			if ($_GET["back"] == "success") {?>
				<div class="alert alert-success" role="alert">
					Je hebt <?=$room->get('caption')?>'s data veranderd!
				</div>
	<?php } if ($_GET["back"] == "deleted") { ?>
				<div class="alert alert-success" role="alert">
					Je hebt <?=$room->get('id')?>verwijderd!
				</div>
	<?php }}
if (isset($_GET['id']) OR isset($_GET['name'])) {	
} else { ?>
		<table>
			<tr>
				<form action="rooms.php" method="GET">
					<td><label for="id">Type <b>ID</b> of an room:</label></td>
					<td><input type="text" name="id" id="id"></td>
					<td><button type="submit">gogogogo</button></td>
				</form>
			</tr>
			<br>
			<tr>
				<form action="rooms.php" method="GET">
					<td><label for="name">Typ <b>NAME</b> of an room:</label></td>
					<td><input type="text" name="name" id="name"></td>
					<td><button type="submit">gogogogo</button></td>
				</form>
			</tr>
		</table>
	</div>
</div>
<br>
	<div class="row">
		<div class="col">
		  <table style="width: 100%;" class="table table-bordered table-hover">
			<thead class="thead-dark">
				<tr>
					<td><b>NAME</b></td>
					<td><b>USER</b></td>
					<td><b>USERSONLINE</b></td>
					<td style="width: 70%;"><b>DESCRIPTION</b></td>
				</tr>
			</thead>
			<?php
			foreach(runassoc("SELECT id, owner, caption, users_now, description FROM `rooms` ORDER BY `id` DESC LIMIT 25") as $row) { 
				$owner = runarray("SELECT username FROM users WHERE id =" . $row['owner']);?>
				<tr>
					<td><a href="rooms.php?id=<?=$row["id"]?>"><?=$row["caption"]?></a></td>
					<td><a href="users.php?id=<?=$row["owner"]?>"><?=$owner["username"]?></a></td>
					<td><?=$row["users_now"]?></td>
					<td><?=$row["description"]?></td>
				</tr>
			<?php } ?>
		  </table>
		</div> 
<?php die(); } ?>
<br><br>
<div class="row">
    <div class="col-2">
		<h2>"<?=$room->get('caption')?>"</h2>
		<hr>
		Made by<a href="users.php?id=<?=$user->getspecific('username', $room->get('owner'))?>"><?=$user->getspecific('username', $room->get('owner'))?></a><br>
		<img style="width: 120px;" src="<?=$hotel["base"]?>/swf/c_images/newroom/<?=$room->get('model_name')?>.png">
	</div>
	<div class="col">
		<table class="table table-sm">
			<tr><td><b>DESCRIPTION:</b></td><td><?=$room->get('description')?></td></tr>
			<tr><td><b>USERS ONLINE:</b></td><td><?=$room->get('users_now')?></td></tr>
			<tr><td><b>MODEL:</b></td><td><?=$room->get('model_name')?></td></tr>
			<tr><td><b>STATUS:</b></td><td><?=$room->get('state')?></td></tr>
			<tr><td><b>GUILD:</b></td><td><a href="guilds.php?id=<?=$room->get('group_id')?>"><?=$room->get('group_id')?> (go)</a></td></tr>
		</table>
	</div>
	<div class="col">
		<h5>DELETE ROOM</h5>
		<form action="query.php" method="GET">
			<input hidden value="deleteroom" name="what">
			<button name="id"value="<?=$room->get('id')?>"type="submit">DELETE ROOM'<?=$room->get('caption')?>' (<?=$room->get('id')?>)</button>
		</form>
	</div>
	<div class="col">
		<h5>CHANGE ROOM NAME</h5>
		<form action="roommodify.php" method="GET">
			<input hidden name="id" value="<?=$room->get('id')?>">
			<input name="name" value="ongeaccepteerde kamer"> <button type="submit">gaan</button><br>
			<input type="checkbox" name="setprivate"> change room to private?<br>(users with rank 7 or higher will be able to enter. requires ingame room reload.)
		</form>
	</div>


</div>
<div class="row">
<div class="col">
		<h4>Last chatlogs.</h4>
		<table style="width: 100%;" class="table table-striped">
			<tr>
				<td><b>USER</b></td>
				<td><b>TIME</b></td>
				<td style="width: 80%;"><b>MESSAGE</b></td>
				
			</tr>
		<?php
		foreach(runassoc("SELECT * FROM chatlogs WHERE room_id = ".$room->get('id')." ORDER BY timestamp DESC LIMIT 50") as $chatlogrow) {
			$whatuserrow = runarray("SELECT id, username FROM users WHERE id = '" . $chatlogrow['user_id'] . "'");
		?>
			<tr>
				<td><a href="users.php?id=<?=$whatuserrow['id']?>"><?=$whatuserrow['username']?></a></td>
				<td><?=date("d/m/Y H:i:s", $chatlogrow['timestamp'])?></td>
				<td><?=$chatlogrow['message']?></td> 
			</tr>
		<?php } if (runassoc("SELECT * FROM chatlogs WHERE room_id = ".$room->get('id')." ORDER BY timestamp DESC LIMIT 50") == 0) { ?>
		<tr>
			<td>no chat!</td>
		</tr>
		<?php } ?>
		</table>
</div>
</div>
&copy; DynaHotel 2018 Made with &hearts; by <a href="https://dynafools.com">ItsMeRomian</a>
<br><br>
</div>