<?php
include_once('modtoolsconfig.php');
session_start();
session_destroy();
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="mods.css">
<title>Bye bye</title>
  <body class="text-center">
    <form style="margin-top: 200px;"class="form-signin" action="login.php" method="POST">
      <img class="" src="<?=$hotel['base']?>/templates/martin/styling/images/logo.gif" alt="" ><br>
	  <span class="mb-4"><b>MODTOOLS</b></span>
      <br>Je bent uitgelogd.<br>
	  <a href="<?=$hotel['base']?>/me">me</a> | <a href="<?=$hotel['base']?>/client">client</a> | <a href="/">login</a>
    </form>
  </body>