<?php
include '../include/function.php';
include '../include/connect.php';
sessao();
/*
#   
#   Entrada de menu Usuários
#   data: 29jul19
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
	<script src="../js/jquery-3.6.4.js"></script>
	<script src="../js/bootstrap.js"></script>
<title>Usuários</title>
</head>
<body>
<div class="container">
    <h3 style="text-align:center;background-color:#FEE39A;">Usuários</h3>
	<div class="row">
    	<div class="col-4">
    <?php
			if($_SESSION["tipo"] == '0'){//administrativo
		?>
		<form action="consultausuarios.php" target="local" method="post">
			<input type="hidden" name="formdirect" id="formdirect" value="consulta">
			<button class="btn btn-outline-primary btn-lg" style="width:90%;"> Consulta </button>
		</form>

		<form action="consultausuarios.php" target="local">
			<input type="hidden" name="formdirect" id="formdirect" value="edit">
			<button class="btn btn-outline-primary btn-lg" style="width:90%;"> Editar </button>
        </form>
        
        <form action="editarusuarios.php" target="local">
			<input type="hidden" name="formdirect" id="formdirect" value="insert">
			<button class="btn btn-outline-primary btn-lg" style="width:90%;"> Adicionar </button>
		</form>

		<form action="../reader/cartoes.php" target="local">
			<button class="btn btn-outline-primary btn-lg" style="width:90%;"> Cartões de usuários </button>
		</form>
		
		<form action="usuarios-site.php" target="local">
			<button class="btn btn-outline-primary btn-lg" style="width:90%;"> Usuários do Site<br>(Login para solicitação<br>de cartões) </button>
		</form>
        </div>
		<div class="col-4">
			<form action="solicitacracha.php" target="local" method="post">
				<input type="hidden" name="formdirect" id="formdirect" value="solcracha">
				<button class="btn btn-outline-primary btn-lg" style="width:90%;"> Solicitação de Crachá </button>
			</form>
		</div>
		<?php
			} // end if administrativo
		?>
    </div> <!-- end row -->
</div> <!-- end container -->
</body>
</html>