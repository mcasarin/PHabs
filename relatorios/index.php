<?php
include '../include/function.php';
sessao();
/*
#   
#   Entrada de menu Relatorios
#   data: 15jan20
#
*/
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.css">
<script src="../js/jquery-1.12.4.js"></script>
<script src="../js/jquery-ui-1.12.1.js"></script>
<script src="../js/bootstrap.js"></script>
<title>Relatórios</title>
</head>
<body>
<section class="container-fluid" style="margin-top:10px;margin-bottom:100px;">
    <div class="row">
    <div class="btn col-4">
    <h3>Relatórios</h3>
    <?php
		if($_SESSION["tipo"] == '0'){//administrativo
	?>
		<div class="btn-group" role="group">
			<button id="btnGroupDrop1" type="button" class="btn btn-outline-primary btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">&nbsp;&nbsp;Usuários&nbsp;&nbsp;</button>
			<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
			<form action="../usuarios/consultausuarios.php" target="local" method="post">
            <input type="hidden" name="optuser" id="optuser" value="relatorio">
				<button class="btn-lg dropdown-item">Usuário unitário</button>
			</form>
			<form action="select_empresa.php" target="local" method="post">
            <input type="hidden" name="optempresa" id="optempresa" value="relatorio">
				<button class="btn-lg dropdown-item">Usuários por empresa</button>
			</form>
			</div>
		  </div>
		  <br /><br />
		<form action="consultausuarios.php" target="local">
			<input type="hidden" name="formdirect" id="formdirect" value="edit">
			<button class="btn btn-outline-primary btn-lg disabled" style="width: 100%; margin-bottom: 10px; margin-left:5px;margin-right:5px;"> Consulta visitantes </button>
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