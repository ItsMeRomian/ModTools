<?php include_once("include.php"); 

//Updates sollie to current state.
if (isset($_GET['id'])) {
	if ($result = $conn->query("UPDATE staffapplication SET state='" . $_GET['state'] . "', answered_by='" . $_SESSION['username'] . "' WHERE id='" . $_GET['id'] . "'")) { ?>
<div class="alert alert-success" role="alert">
	Solicitatie Nr <?=$_GET['id']?> is veranderd naar <b><?=$_GET['state']?></b>
</div>
<?php } else {}} ?>
<div class="container-fluid">
	<div class="row">
		<div class="col">
			<h2>Laatste  sollies</h2>
			<table  class="table table-striped table-hover">
				<tr>
					<td><b>SollieNr</b></td>
					<td><b>Status</b></td>
					<td><b>Solicitant</b></td>
					<td><b>Voor</b></td>
					<td><b>Hours</b></td>
					<td><b>Kent</b></td>
					<td><b>Gesolisiteerd op</b></td>
					<td><b>Beantwoord</b></td>
					<td><b></b></td>
				</tr>
			<?php
			foreach (runassoc("SELECT * FROM staffapplication ") as $row) { ?>
				<tr class="<?php if ($row['state'] == "accepted") { echo "table-success";} elseif ($row['state'] == "denied") { echo "table-danger";}?>">
					<td><?=$row['id']?></td>
					<td><?=$row['state']?></td>
					<td><a href="users.php?name=<?=$row['username']?>"><?=$row['username']?></a></td>
					<td><?=$row['function']?></td>
					<td><?=$row['online']?></td>
					<td><a href="users.php?name=<?=$row['whoyouknow']?>"><?=$row['whoyouknow']?></a></td>
					<td><?=date("d/m/Y H:i",$row['date'])?></td>
					<td><?php if ($row['state'] == "pending") { ?><a href='#' onclick="show('<?=$row['id']?>')">Answer now</a> <?php } else { echo "beantwoord door <a href=users.php?name=" . $row['answered_by'] . ">" . $row['answered_by'] . "</a>"; }?></td>
					<div style="display: none;" class="col" id=<?=$row['id']?>>
						<form action="sollies.php" method="GET">
							<h3>Antwoord op <?=$row['username']?></h3>
							<input hidden name="id" value="<?=$row['id']?>">
							<select name='state'>
								<option value='accepted'>accepted</option>
								<option value='denied'>denied</option>
								<option value='pending'>pending</option>
							</select>
							<button type="submit">gogogogo</button>
						</form>
					</div>
				</tr>
			<?php } ?>
			</table>
		</div>
	</div>
</div>