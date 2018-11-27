<?php

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<title>PHabs</title>
</head>
<body>
<div class="jumbotron jumbotron-fluid">
<nav class="navbar navbar-default" role="navigation">
<div class="container">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> 
<span class="sr-only">Toggle navigation</span> 
</button> <!--  class="navbar-brand"-->
<br>
<a class="pull-left" href="http://www.edificiochurchill.com.br" target="_blank"> <img src="img/churchill-minor.png" class="img-rounded" alt="Winston Churchill" width=""> </a>
</div>
<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
</div><!-- /.navbar-collapse -->
	<div class="row">
		<div id="conteudo" class="col-md-4">
			</div>
		<div id="conteudo" class="col-md-4">
			<form class="form-signin" method="post" action="include/login.php">
			<h2 class="form-signin-heading">Informe usuário e senha</h2>
			<br>
			  <label for="inputEmail" class="sr-only">Usuário</label>
			  <input id="inputUser" type="text" class="form-control" name="login" placeholder="Digite o seu usuário..." required autofocus>
			  <br>
			  <label for="inputPassword" class="sr-only">Senha</label>
			  <input id="inputPassword" type="password" class="form-control" name="senha" placeholder="Digite a sua senha..." required>
			  <br>
			  <button class="btn btn-lg btn-primary btn-block" type="submit" name="acesso">Acessar</button>
			</form>
			<br>
		</div> <!-- /conteudo login -->
		<div id="conteudo" class="col-md-4">
			</div>
	</div> <!-- /row login-->
</div> <!-- /container -->
</nav>
<footer>
	<div class="container">
		<div class="row">
			<div id="linksImportantes" class="col-md-3">
			<br>
			<br>
			<br>
			</div> <!-- Aqui e a area dos links importantes -->
		</div>
	</div>
</footer>
</div> <!-- /jumbotron -->
</body>
</html>
<?php
?>
