<?php include_once("include.php"); 
$guild = new guild;
$user = new user;
$room = new room;
?>
<div class="container-fluid">
<div class="row">
    <div class="col">
	<?php if (isset($_GET["back"])) {
			if ($_GET["back"] == "success") {?>
				<div class="alert alert-success" role="alert">
					you've changed guild <?=$guild->get('name')?>'s data!
				</div>
	<?php 	} if ($_GET["back"] == "deleted") {?>
				<div class="alert alert-success" role="alert">
					you've deleted guild <?=$guild->get('id')?>!
				</div>
	<?php }}  ?>
		<table>
			<tr>
				<form action="guilds.php" method="GET">
					<td><label for="id">Type <b>ID</b> of guild:</label></td>
					<td><input type="text" name="id" id="id"></td>
					<td><button type="submit">gogogogo</button></td>
				</form>
			</tr>
			<br>
		</table>
	</div>
</div>
<?php if (isset($_GET['id'])) { } else { die(); } ?>
<div class="row">
	<div class="col-2">
		<h2>"<?=$guild->get('name')?>"</h2>
		gemaakt door <a href="users.php?id=<?=$guild->get('owner_id');?>"><?=$user->getspecific('username', $guild->get('owner_id'));?></a><br>
		<img style="width: 110px;" src="<?=$hotel['guildbadges'] . $guild->get('badge')?>.png">
	</div>
	<div class="col">
		<h5>INFO</h5>
		<table class="table table-sm">
			<tr>
				<td style="width: 15%;"><b>DESCRIPTION: </b></td><td><?=$guild->get('desc')?></td>
			</tr>
			<tr>
				<td><b>ROOM: </b></td><td><a href="rooms.php?id=<?=$guild->get('room_id')?>"><?=$room->getspecific('caption', $guild->get('room_id'))?></a></td>
			</tr>
			<tr>
				<td><b>STATE: </b></td><td><?=$guild->get('state')?></td>
			</tr>
			<tr>
				<td><b>GEMAAKT OP: </b></td><td><?=date("d/m/Y H:i:s", $guild->get('created'))?></td>
			</tr>
		</table>
	</div>
	<div class="col">
		<h5>DELETE GUILD</h5>
		<form action="query.php" method="POST">
			<input hidden value="deleteguild" name="what">
			<button name="id" value="<?=$guild->get('id')?>" type="submit">DELETE GUILD <?=$guild->get('id')?></button>
		</form>
	</div>
</div>
<br>
<div class="row">
	<div class="col"> 
		<h5>USERS IN GUILD</h5>
			<table style="width: 100%;" class="table table-striped table-hover">
			<tr>
				<td><b>USER</b></td>
				
				<td style="width: 80%;"><b>GUILD RANK</b></td>
			</tr>
			<?php 
			$guildusersresultid = $conn->real_escape_string($_GET['id']);
			$guildusersresult = runassoc("SELECT * FROM group_memberships WHERE group_id = '" . $guildusersresultid . "'");
			foreach($guildusersresult as $user) {
				$id = $user['user_id'];
				$sql = "SELECT username FROM users WHERE id = '$id'";
				$result = $conn->query($sql);
				$username = $result->fetch_array(); ?>
			<tr>
				<td><?=$username['username']?></td> 
				<td><?=$user['rank']?></td>
			</tr>
			<?php } ?>
			</table>
	</div>
</div>
&copy; DynaHotel 2018 Made with &hearts; by <a href="https://dynafools.com">ItsMeRomian</a>
<br><br>
</div>