<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<script src="js/jquery-3.6.4.min.js"></script>
	<title> PHabs </title>
	<style>
        /* Custom CSS to adjust left sidebar position */
        .custom-left-sidebar {
            margin-left: 0; /* Remove default margin */
            padding-left: 0; /* Add padding to create space between sidebar and content */
        }

        .custom-left-sidebar .d-flex {
            margin-left: -380px; /* Compensate for container padding */
            margin-right: -380px; /* Compensate for container padding */
        }

        
		/* Adjust iframe size */
        .iframe-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 aspect ratio */
            height: 0;
            overflow: hidden;
        }

        .iframe-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<?php
include 'include/function.php';
sessao();
if (isLoginSessionExpired() == true) {
	header('location: logout.php');
}
$nomeoperador = $_SESSION["nome"];
if(isset($serverType)){
	echo $serverType;
}
?>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #f2f2f2;">
		<div class="container">
			<div class="col-2">
			<a class="navbar-brand" href="http://www.edificiochurchill.com.br" target="_blank">
				<img src="img/churchill-minor.png" class="d-inline-block align-text-top" alt="Winston Churchill" width="60" height="60"></a>
			</div>
			<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a href="phabs.php" class="nav-link btn-outline-primary" style="border-radius:10px;margin-right:15px;"> Início </a>
					</li>
					<li class="nav-item">
						<a class="nav-link btn-outline-primary" href="visitantes/index.php" target="local" style="border-radius:10px;margin-right:15px;">Visitantes</a>
					</li>
					<li class="nav-item">
						<a href="empresas/consultaempresa.php" class="nav-link btn-outline-primary" target="local" style="border-radius:10px;margin-right:15px;"> Localizza </a>
					</li>
					<?php
					if ($_SESSION["tipo"] == '0') { // operadores administrativos
						?>
						<li class="nav-item"> 
							<a href="empresas/index.php" class="nav-link btn-outline-primary" target="local" style="border-radius:10px;margin-right:15px;">
								Empresas </a>
						</li>
					
						<li class="nav-item"> 
							<a class="nav-link btn-outline-primary" href="usuarios/index.php" target="local" style="border-radius:10px;margin-right:15px;">
								Usuários </a>
						<?php
					} //end if operadores administrativos
					?>
				</ul>
				
				<ul class="navbar-nav ms-auto">
				<a href="include/logout.php" class="btn btn-outline-info" style="margin: 10px;">
					<b>Operador: <mark>
							<?php echo ucfirst($nomeoperador); ?>
						</mark></b>
				</a>
				</ul>
			</div>
		</div>
	</nav>


	<div class="container mt-4">
		<div class="row">
			<div class="col-md-2 custom-left-sidebar"> <!-- MENU lateral -->
				<a href="cadastrovisitantes.php" target="local" class="btn btn-outline-primary" style="width:80%; margin:5px;padding:5px;"> Cadastro </a><br>
				<a href="consultavisitantes.php?formdirect=consulta" target="local" class="btn btn-outline-primary" style="width:80%; margin:5px;padding:5px;"> Consulta </a><br>
				<a href="baixavisitantes.php" target="local" class="btn btn-outline-primary" style="width:80%; margin:5px;padding: 5px;"> Baixa </a><br>
				<a href="empresas/consultaempresa.php" target="local" class="btn btn-outline-primary"
					style="width: 80%; margin:5px;padding: 5px;"> Localizza </a><br>
				<a href="visitantes/index.php" target="local" class="btn btn-outline-primary"
					style="width:80%; margin:5px;padding: 5px;"> Visitantes </a><br>
				<a href="garagem/garagem.php" target="local" class="btn btn-outline-primary"
					style="width:80%; margin:5px;padding: 5px;"> Garagem </a><br>
				<?php
				if ($_SESSION["tipo"] == '0' || $_SESSION["tipo"] == '2') { // adm e portaria
					?>
				<a href="correio/index.php" target="local" class="btn btn-outline-primary"
					style="width:80%; margin:5px;padding: 5px;"> Entregas </a><br>
				<?php
				} // end if adm e portaria
				if ($_SESSION["tipo"] == '0') { // adm
					?>
					<a href="empresas/index.php" target="local" class="btn btn-outline-primary"
						style="width:80%; margin:5px;padding: 5px;"> Empresas </a><br>
					<a href="usuarios/index.php" target="local" class="btn btn-outline-primary"
						style="width:80%; margin:5px;padding: 5px;"> Usuários </a><br>
					<a href="relatorios/index.php" target="local" class="btn btn-outline-primary"
						style="width:80%; margin:5px;padding: 5px;"> Relatórios </a><br>
					<a href="operadores/index.php" target="local" class="btn btn-outline-primary"
						style="width:80%; margin:5px;padding: 5px;"> Operadores </a><br>
					<a href="reader/cartoes.php" target="local" class="btn btn-outline-primary"
						style="width:80%; margin:5px;padding: 5px;"> Cartões </a><br>
					<?php
				} // end if adm
				?>
			</div>

			<div class="col-md-10">
				<div class="iframe-container">
					<iframe name="local" src="index2.php"></iframe>
				</div>
			</div>
		</div> <!-- end row -->
	</div> <!-- end row -->
	<!-- <footer>
			<p class="pull-right"><i> Desenvolvido por </i><strong> Márcio Casarin. Etwas Informática</strong></p>
</footer>  -->
<script src="js/bootstrap.js"></script>
</body>
</html>
