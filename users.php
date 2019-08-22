<?php include_once("include.php"); 
$user = new user;
$user->start();
?>
<div class="container-fluid">
<div class="row">
    <div class="col">
	
	
	<?php 
//POPUP MESSEAGES
        if (isset($_GET["back"])) {
			if ($_GET["back"] == "success") {?>
		<div class="alert alert-success" role="alert">
		Je hebt <?=$user->get('username')?>'s data veranderd!
		</div>
	<?php } if ($_GET["back"] == "unban") { ?>
		<div class="alert alert-success" role="alert">
		Je hebt <?=$user->get('username')?> geunbanned!
		</div>
	<?php }} ?>
		<a href="users.php">unselect</a>
		
<!--SEARCH!-->	
		<table>
			<tr>
				<form action="users.php" method="GET">
					<td><label for="id">Typ hier de <b>ID</b> van een user die je wilt opzoeken:</label></td>
					<td><input type="text" name="id" id="id"></td>
					<td><button type="submit">gogogogo</button></td>
				</form>
			</tr>
			<br>
			<tr>
				<form action="users.php" method="GET">
					<td><label for="name">Typ hier de <b>NAAM</b> van een user die je wilt opzoeken:</label></td>
					<td><input type="text" name="name" id="name"></td>
					<td><button type="submit">gogogogo</button></td>
				</form>
			</tr>
		</table>
	</div>
</div>
<div class="row">
	<div class="col">
		<br>
<!--5 highest id users viewed when no one is selected!-->
		<?php if (!isset($_GET['id'])) { ?>
		<p>Nieuwste users in Dyna</p>
		<table style="width: 100%;" class="table table-bordered table-hover">
			<tr>
				<td style="width: 3%;"><b>ID</b></td>
				<td style="width: 10%;"><b>NAME</b></td>
				<td style="width: 23%;"><b>EMAIL</b></td>
				<td style="width: 93%;"><b>RANK</b></td>
			</tr>
			<?php
			foreach(runassoc("SELECT id, username, rank, mail FROM users ORDER BY `id` DESC LIMIT 5" ) as $row) {
				$rank = runassoc("SELECT name FROM ranks WHERE id = '". $row['rank']."'");
			?>
			<tr>
				<td><?=$row["id"]?></td>
				<td><a href="users.php?id=<?=$row["id"]?>"><?=$row["username"]?></a></td>
				<td><?=$row["mail"]?></td>
				<td><?=$row["rank"]?>, dat is "<b><?=$rank[0]["name"]?></b>"</td>
			</tr>
				<?php } ?>
		</table>
	</div>
</div>



<?php //From here its espected that a user is selected
} if (!isset($_GET["id"])) { die();} ?>
<br>
<h2>[<?=$user->get('id')?>] <?=$user->get('username')?></h2><hr>
<div class="row">
	<img style=" height: 230px; margin-top: -30px;" src="https://www.habbo.com.br/habbo-imaging/avatarimage?figure=<?=$user->get('look')?>">
	<div class="col">
		<h5>INFO</h5>
		<table class="table table-sm">
			<form method="GET" action="usermod.php">
				<input name="id" value="<?=$user->get('id')?>" hidden>
				<tr>
					<td><b>MOTTO: </b></td><td><?=$user->get('motto')?></td>
					<td><a href="#"onclick="show('ass');show('ass2');">SET</a></td>
					<td><input name="motto" placeholder="naar wat?" style="display: none;" id="ass"></td>
					<td><button style="display: none;" id="ass2" type="submit">gogogogo</button></td>
				</tr>
				<tr>
					<td><b>EMAIL: </b></td><td><?=$user->get('mail')?></td>
					<td><a href="#"onclick="show('poo');show('poo2');">SET</a></td>
					<td><input name="mail"placeholder="naar wat?" style="display: none;" id="poo"></td>
					<td><button style="display: none;" id="poo2" type="submit">gogogogo</button></td>
				</tr>
				<tr>
					<td><b>RANK: </b></td><td><?=$user->get('rank')?></td>
					<td><a href="#"onclick="show('doo');show('doo2');">SET</a></td>
					<td><input name="rank"placeholder="naar wat?" style="display: none;" id="doo"></td>
					<td><button style="display: none;" id="doo2" type="submit">gogogogo</button></td>
				</tr>
				<tr>
					<td><b>CREDITS: </b></td><td><?=$user->get('credits')?></td>
					<td><a href="#"onclick="show('da');show('da2');">SET</a></td>
					<td><input name="credits"placeholder="naar wat?" style="display: none;" id="da"></td>
					<td><button style="display: none;" id="da2" type="submit">gogogogo</button></td>
				</tr>
				<tr>
					<td><b>POINTS: </b></td><td><?=$user->get('activity_points')?></td>
					<td><a href="#"onclick="show('de');show('de2');">SET</a></td>
					<td><input name="pixels"placeholder="naar wat?" style="display: none;" id="de"></td>
					<td><button style="display: none;" id="de2" type="submit">gogogogo</button></td>
				</tr>
				<tr>
					<td><b>GEMAAKT OP: </b></td><td><?=date("d-m-Y H:i", $user->get('account_created'))?></td>
					
				</tr>
			</form>
		</table>
	</div>
	<div class="col">
		<h5>BANNED</h5>
		<?php
		if ($user->banned()) { ?>
				<table>
				<tr>
					<td>Ja, Tot </td>
					<td><?=date("d/m/Y H:i", $user->banned()['expire'])?></td>
				</tr>
				<tr>
					<td>Gebant door: </td>
					<td><?=$user->getspecific('username', $user->banned()['added_by'])?></td>
				</tr>
				<tr>
					<td>Reden: </td>
					<td><?=$user->banned()['reason']?></td>
				</tr>
				</table>
				<a href="query.php?id=<?=$user->get('id')?>&what=deleteban">Verwijder ban</a>
				<?php
			
		} else { ?>
			Nee, <a onclick="show('bandiv')" href="#">nu bannen?</a>
			<div style="display: none;"id="bandiv">
			<table>
			<form method="GET" action="query.php">
			<input hidden value="makeban" name="what">
			<tr>
				<td>USER:</td>
				<input hidden name="id" value="<?=$user->get('id')?>">
				<td><input disabled value="<?=$user->get('username');?>"></td>
			</tr>
			<tr>
				<td>GEBANT DOOR:</td>
				<input hidden value="<?=$_SESSION['id']?>" name="user_staff_id">
				<td><input disabled value="<?=$_SESSION['username']?>" name="user_staff_id"></td>
			</tr>
			<tr>
				<td>REDEN:</td>
				<td><input placeholder="minimaal 2 abn zinnen"type="text" name="ban_reason"></td>
			</tr>
			<tr>
				<td>EINDE BAN:<b></b></td>
				<td><input placeholder="IN UNIX TIMESTAMP!"type="text" name="ban_expire"></td><td><a target="_BLANK"href="https://www.unixtimestamp.com/index.php">Wie tf is unix</a></td>
			</tr>
			<tr><td><button type="submit">slaan met die hamer</button></td><tr>
			</form>
			</table>
			</div>
			<?php } ?>
	</div>
	<div class="col">
		<h5>UOTW</h5>
		<?php
		$uotwrow = runarray("SELECT * FROM uotw");
		if ($uotwrow['userid'] == $user->get('id')) { ?>
			<?=$user->get('username')?> is UOTW met de text: <br>
			"<?=$uotwrow['text']?>" <br> 
			<a href="query.php?what=deleteuotw&id=<?=$user->get('id')?>">nee stop</a>
		<?php } else { ?>
			<?=$user->get('username')?> is niet UOTW. <a href="#" onclick="show('uotw')">Nu maken?</a>
		<div style="display: none;"id="uotw">
			<form method="GET" action="query.php">
				<input hidden value="makeuotw" name="what">
				<table>
					<input hidden name="id" value="<?=$user->get('id')?>">
					<tr>
						<td><input placeholder="text" type="text" name="text"></td>
						<td><button type="submit">yeah letsgo</button></td>
				</table>
			</form>
		</div>
		<?php } ?>
	</div>
</div>
<hr>
<div class="row">
	<div class="col">
		<h5>KAMERS VAN <?=strtoupper($user->get('username'))?></h5>
		<table  class="table table-striped ">
		<tr><td><b>NAAM</b></td><td><b>ONLINE</b></td><td><b>GUILD</b></td><td><b>DESCRIPTION</b></td></tr>
		<?php
		if (runassoc("SELECT * FROM rooms WHERE owner = '".$user->get('id')."'") == 0) { 
			die($user->get('username') ." heeft geen kamers!"); 
		} else {
			foreach(runassoc("SELECT * FROM rooms WHERE owner = ".$user->get('id')) as $row) { 
			?>
			<tr>
				<td><a href="rooms.php?id=<?=$user->get('id')?>"><?=$row['caption']?></a></td>
				<td><?=$row['users_now']?></td>
				<td><?=$row['group_id']?></td>
				<td><?=$row['description']?></td>
		<?php }} ?>
		</table>
	</div>
</div>
</div>

<br><br>