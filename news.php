<?php include_once("include.php"); ?>
<div class="container-fluid">
<div class="row">
	<div class="col">
		<table class="table table-bordered table-hover">
			<thead class="thead-dark">
				<tr>
					<td><b>EDIT</b></td>
					<td><b>ID</b></td>
					<td><b>TITLE</b></td>
					<td><b>IMAGE</b></td>
					<td><b>AUTHOR</b></td>
					<td><b>DATE</b></td>
					<td><b>SHORT</b></td>
					<td><b>LONG</b></td>
				</tr>
			</thead>
		<?php
		$news = "SELECT * FROM cms_news ORDER BY date DESC";
		$newsresult = $conn->query($news);
		while ($newsrow = $newsresult->fetch_assoc()) { ?>
			<tr>
				<td><a href="https://mods.dyna.host/news.php?title=<?=$newsrow['title']?>&image=<?=$newsrow['image']?>&author=<?=$newsrow['author']?>&date=<?=$newsrow['date']?>&short=<?=$newsrow['shortstory']?>&long=<?=$newsrow['longstory']?>">EDIT</a>
				<td><?=$newsrow['id']?></td>
				<td><?=$newsrow['title']?></td>
				<td><a href="<?=$newsrow['image']?>">LINK</a></td>
				<td><?=$newsrow['author']?></td>
				<td><?=$newsrow['date']?></td>
				<td><?=$newsrow['shortstory']?></td>
				<td><?=$newsrow['longstory']?></td>
			<tr>
		<?php } ?>
		</table>
	</div>
</div>
<div class="row">
	<div class="col-8">
	<h5>MAAK/EDIT EEN NIEUWSBERICHT</h5>
	let niet op dat undefined index shit
		<form action="newsnew.php" method="GET">
			<table>
				<input hidden name="id"value="<?=$_GET['id']?>">
				<tr><td style=" width: 100px;">TITEL</td><td width="600px;"><input value="<?=$_GET['title']?>"name="title"style="width: 100%;" type="text"></td></tr>
				<tr><td>IMAGE</td><td><input value="<?=$_GET['image']?>"name="image"style="width: 100%;" placeholder="DIRECTE LINK NAAR EEN PNG" type="text"></td><td><a target="_blank"href="https://hotel.dyna.host/swf/c_images/web_promos/">directory met fotos</a></tr>
				<tr><td>AUTHOR</td><td><input value="<?=$_SESSION['username']?>" disabled name="author"style="width: 100%;"type="text"></td></tr>
				<tr><td>DATUM</td><td><input value="<?=$_GET['date']?>"name="date"style="width: 100%;" placeholder="UNIX TIMESTAMP!" type="text"></td></tr>
				<tr><td>SHORT</td><td><textarea name="short"style="width: 100%;" rows="5"placeholder="2/3 ZINNEN"><?=$_GET['short']?></textarea></td></tr>
				<tr><td>LONG</td><td><textarea name="long"style="width: 100%;" rows="10"placeholder="HTML TOEGESTAAN"><?=$_GET['long']?></textarea></td></tr>
				<tr><td></td><td><button style="width: 100%;" type="submit" class="button">Gaan met die banaan</button></td></tr>
			</table>
		</form>
	</div>
	<div class="col">
		<h5>VERWIJDER NIEuWS</h5>
		<form action="newsdelete.php" method="GET">
			<input name="id"type="number">
			<button type="submit">verwijder :(</button>
		</form>
	</div>
</div>