<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title> PHabs </title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/sing.css">
<script src="js/jquery-3.6.4.js"></script>
<script src="js/bootstrap.min.js"></script>
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
</head>
<body class="text-center">
<div class="container">
  <div class="row" id="pwd-container">
    <div class="col-md-4"></div>
    <div class="col-md-4">
      <section class="login-form">
        <form method="post" action="include/login.php" role="login">
			<div><a href="http://www.edificiochurchill.com.br" target="_blank"><img src="img/churchill-minor.png" class="img-responsive" alt="" /></a></div>
          <input type="text" name="login" placeholder="usuário" required autofocus class="form-control input-lg" />
          <input type="password" name="senha" id="password" placeholder="senha" required="" class="form-control input-lg" />
          <div class="pwstrength_viewport_progress"></div>
          <button type="submit" name="go" class="btn btn-lg btn-primary btn-block"> Acessar </button>
        </form>
      </section>  
      </div>
      <div class="col-md-4"></div>
  </div>
    <div class="row">
      <footer class="page-footer font-small blue pt-4">
      <!-- Copyright -->
        <br>
        <div class="footer-copyright text-center py-3">&copy; 2018-<?php echo date('Y');?>
          <a href="https://etwas.com.br/"> Etwas Informática </a>
        </div>
      <!-- Copyright -->
      </footer>
    </div>
</div>
<body>
</html>
