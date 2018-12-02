<?php
include 'include/function.php';
sessao();
$nomeoperador = $_SESSION["nome"];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.css">
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.js"></script>
<title>PHabs</title>
</head>
<body>
<div class="container">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="http://www.edificiochurchill.com.br" target="_blank"> <img src="img/churchill-minor.png" class="img-rounded" alt="Winston Churchill" width="60" height="60" hspace="10"> </a>
    	<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a href="phabs.php" class="nav-link"> Início </a>
				</li>
				<li class="nav-item dropdown"> <!-- Dropdown Visitantes -->
					<a href="visitantes/index.php" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Visitantes </a>
					<div class="dropdown-menu" arial-labelledby="navbarDropdown">
						<a href="cadastrovisitantes.php" target="local" class="dropdown-item"> Cadastro </a>
						<a href="baixavisitantes.php" target="local" class="dropdown-item"> Baixa </a>
						<a href="consultavisitantes.php" target="local" class="dropdown-item"> Consulta </a>
					</div>
				</li> <!-- END Dropdown Visitantes -->
				<li class="nav-item">
					<a href="empresas/consultacadastro.php" target="local" class="nav-link"> Localizza </a>
				</li>
			<?php
			if($_SESSION["tipo"] == '0'){//operadores administrativos
			?>
			<li class="nav-item dropdown"> <!-- Dropdown Empresas -->
				<li class="nav-item">
					<a href="empresas/index.php" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Empresas </a>
					<div class="dropdown-menu" arial-labelledby="navbarDropdown">
						<a href="empresas/consultacadastro.php" target="local" class="dropdown-item"> Consulta </a>
						<a href="empresas/updateempresas.php" target="local" class="dropdown-item"> Adiciona </a>
					</div>
				</li>
			</li> <!-- END Dropdown Empresas-->
				<li class="nav-item">
					<a href="reader/cartoes.php" target="local" class="nav-link"> Cartões de usuários </a>
				</li>
			<?php
			}//end if operadores administrativo
			?>
			</ul>
    	</div>
        <div style="display: inline-block; text-align: right; width: 20%">
        	<a href="include/logout.php" class="btn btn-outline-info" style="margin-left: 20px;margin-right: 10px;">
          	<b>Operador: <mark><?php echo ucfirst($nomeoperador); ?></mark></b>
		</a>
        </div>
    </nav>
</div>
<section class="container-fluid" style="margin-top:10px;margin-bottom:100px;">
<div class="row">
<div class="btn col-2" style="width:100%;float:left;margin-left:5px;margin-right:5px;"> <!-- MENU lateral -->
		<a href="cadastrovisitantes.php" target="local" class="btn btn-outline-primary btn-lg" style="width: 100%; margin-bottom: 5px;margin-left:5px;margin-right:5px;"> Cadastro </a><br>
		<a href="consultavisitantes.php" target="local" class="btn btn-outline-primary btn-lg" style="width: 100%; margin-bottom: 5px;margin-left:5px;margin-right:5px;"> Consulta </a><br>
		<a href="baixavisitantes.php" target="local" class="btn btn-outline-primary btn-lg" style="width: 100%; margin-bottom: 5px;margin-left:5px;margin-right:5px;"> Baixa </a><br>
		<a href="empresas/consultacadastro.php" target="local" class="btn btn-outline-primary btn-lg" style="width: 100%; margin-bottom: 5px;margin-left:5px;margin-right:5px;"> Localizza </a><br>
		<a href="garagem/garagem.php" target="local" class="btn btn-outline-primary btn-lg" style="width: 100%; margin-bottom: 5px;margin-left:5px;margin-right:5px;"> Garagem </a><br>
		<?php
			if($_SESSION["tipo"] == '0'){//administrativo
		?>
			<a href="empresas/index.php" target="local" class="btn btn-outline-primary btn-lg" style="width: 100%; margin-bottom: 5px;margin-left:5px;margin-right:5px;"> Empresas </a><br>
			<a href="reader/cartoes.php" target="local" class="btn btn-outline-primary btn-lg" style="width: 100%; margin-bottom: 5px;margin-left:5px;margin-right:5px;"> Cartões de usuários </a><br>
		<?php
			}//end if administrativo
		?>
</div>
<div class="col-1">
&nbsp;
</div>
		<div class="col-6">
			<iframe class="iframe" name="local" width="800" height="600" style="dysplay:none;border:0;position:absolute;overflow:hidden">
			
			</iframe>
		</div>
		</div> <!-- end row -->
</section>
<!-- <footer>
	<div class="container">
		<div class="row">
			<div id="linksImportantes" class="col-md-12">
			<p class="pull-right"><i> Desenvolvido por </i><strong> Márcio Casarin </strong></p>
			</div> <!-- Aqui e a area dos links importantes 
		</div>
	</div>
</footer>  -->
</body>
</html>
<?php
?>
