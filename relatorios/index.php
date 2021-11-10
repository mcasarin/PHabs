<?php
include '../include/function.php';
sessao();
/*
#   
#   Entrada de menu Relatorios
#   data: 11fev20
#	---
#	Falha menu, remoção do include/header.php
*/
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/churchill.css">
	<script src="../js/jquery-1.12.4.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/bootstrap.js"></script>
<title>PHabs</title>
</head>
<body>
<section class="container-fluid" style="margin-top:10px;margin-bottom:100px;">
    <div class="row">
    <div class="btn col-4">
    <h3 id="TituloDestaque" class="alert-info" style="text-align:center;">Relatórios</h3>
    <?php
		if($_SESSION["tipo"] == '0'){//administrativo
	?>
		<h4>Consulta usuários</h4>
			
			<form action="../usuarios/consultausuarios.php" target="local" method="post">
            <input type="hidden" name="formdirect" id="formdirect" value="reluserunit">
				<button class="btn btn-outline-primary btn-md">Usuário unitário</button>
			</form>
			<form action="select_empresa.php" target="local" method="post">
            <input type="hidden" name="optempresa" id="optempresa" value="relatorio">
				<button class="btn btn-outline-primary btn-md">Usuários por empresa</button>
			</form>
			
<hr><br />
		
		<h4>Consulta visitantes </h4>
		
			<form action="../consultavisitantes.php" target="local" method="get">
				<input type="hidden" name="formdirect" id="formdirect" value="relvisunit">
				<button class="btn btn-outline-primary btn-md">Visitante unitário</button>
			</form>
			<form action="select_empresa_v.php" target="local" method="post">
				<input type="hidden" name="optempresa" id="optempresa" value="relatorio">
				<button class="btn btn-outline-primary btn-md">Visitantes por empresa</button>
			</form>

		
		<?php
			}//end if administrativo
		?>
        </div>
    </div> <!-- end row -->
</section>
</body>
</html>
<?php
//end file
?>