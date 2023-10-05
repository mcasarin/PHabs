<?php
include '../include/function.php';
sessao();
/*
#   
#   Entrada de menu Relatorios
#   data: 11fev20
#	---
#	4jul23 - Alterado para responsividade e inclusão de itens
*/
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap 523 -->
	<link href="../css/bootstrap.css" rel="stylesheet">
<title>PHabs</title>
</head>
<body>
<div class="container">
        <div class="row">
            <h3 style="text-align:center;background-color:#FEE39A;">Relatórios</h3>
    		<div class="col-4">
    
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
			
<hr>
		
		<h4>Consulta visitantes</h4>
		
			<form action="../consultavisitantes.php" target="local" method="get">
				<input type="hidden" name="formdirect" id="formdirect" value="relvisunit">
				<button class="btn btn-outline-primary btn-md">Visitante unitário</button>
			</form>
			<form action="select_empresa_v.php" target="local" method="post">
				<input type="hidden" name="optempresa" id="optempresa" value="relatorio">
				<button class="btn btn-outline-primary btn-md">Visitantes por empresa</button>
			</form>
			
		</div>
		<!-- quebra coluna -->
		<div class="col-4">
		<h4>Consulta estacionamento</h4>
		
			<form action="select_date_estac.php" target="local" method="get">
				<input type="hidden" name="formdirect" id="formdirect" value="reldateestac">
				<button class="btn btn-outline-primary btn-md">Acessos por data</button>
			</form>
			<form action="select_empresa.php" target="local" method="post">
				<input type="hidden" name="optempresa" id="optempresa" value="relempresaestac">
				<button class="btn btn-outline-primary btn-md">Acessos por empresa</button>
			</form>
<hr>
		
		<h4>Estatísticas</h4>
			<form action="../estatisticas/index.php" target="local" method="get">
				<!--<input type="hidden" name="formdirect" id="formdirect" value="reldateestac">-->
				<button class="btn btn-outline-primary btn-md">Menu</button>
			</form>		
		<?php
			}//end if administrativo
		?>
        </div>
    </div> <!-- end row -->
		</div> <!-- end container -->
</body>
</html>
<?php
//end file
?>