<?php include_once("modtoolsconfig.php"); ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<title>ModTools - Login</title>
<link rel="stylesheet" href="mods.css">

  <body class="text-center">
    <form class="form-signin" action="login.php" method="POST">
      <img class="" src="<?=$hotel['theme']?>/images/logo2.webp" alt="" ><br>
	  <span class="mb-4"><b>MODTOOLS</b></span>
      <label for="inputEmail" class="sr-only"></label>
      <input type="username" id="username" name="username" class="form-control" placeholder="Login met je dynahotel account"  autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" name="password" id="password" class="form-control" placeholder="Je Dyna wachtwoord" >

      <button class="btn btn-lg btn-primary btn-block" type="submit">DevTools »</button>
      <p class="mt-5 mb-3 text-muted">&copy; <?=$hotel['name']?> 2018</p>
    </form>
  </body>