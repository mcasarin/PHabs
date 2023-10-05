<?php
include '../../include/function.php';
include '../../include/connect.php';
sessao();
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../../css/bootstrap.css">
<script src="../../js/jquery-1.11.3.js"></script>
<script src="../../js/bootstrap.js"></script>
<title>Solicita TAG</title>
</head>
<?php
$id = $_GET["id"];
$sqlbuscatag = "select * from solicita where id_sol = $id";
$re = $conn->query($sqlbuscatag);


while($l = $re->fetch_array(MYSQLI_ASSOC)) {
	$id = $l["id_sol"];
	$nomesolicita = $l["nomesolicita"];
	$empresa = $l["empresa"];
	$carro = $l["carro"];
	$placa = $l["placa"];
	$tag = $l["tag"];
	$datasolicita = $l["datasolicita"];
?>
<body>
<div class="col-md-4 container col-centered"><a class="btn btn-success btn-block" role="button" href="../checartag.php"> <<< Voltar <<< </a></div>
<div class="container">
<div class="table-responsive">
<form id="form1" name="salvareditar" method="post" action="salvareditar.php" enctype="multipart/form-data">
<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
    <table class="table table-sm">
        <thead class="thead-dark">
          <th colspan="3" style="align:center;">Edição para inserção de tag</th>
        </thead>
          <tr><td>TAG: <input size="6" maxlength="7" type="text" id="tag" name="tag" value="<?php echo $tag; ?>" autofocus required /></td>
          <td>FC: <input size="6" maxlength="5" type="text" id="fc" name="fc" required /></td>
          <td>Código: <input size="6" maxlength="5" type="text" id="wie" name="wie" required /></td></tr>
          <tr><td colspan="3">Nome do solicitante: <input size="50" type="text" id="nomesolicita" name="nomesolicita" value="<?php echo $nomesolicita; ?>" readonly /></td></tr>
          <tr><td colspan="3">Conjunto: <input size="60" type="text" id="empresa" name="empresa" value="<?php echo $empresa; ?>" readonly /></td></tr>
          <tr><td colspan="3">Carro: <input size="40" type="text" id="carro" name="carro" value="<?php echo $carro; ?>" readonly /></td></tr>
          <tr><td colspan="2">Placa: <input size="15" type="text" id="placa" name="placa" maxlength="60" value="<?php echo $placa; ?>" readonly /></td>
          <td>Data solicitação: <input size="15" type="text" id="datasolicita" name="datasolicita" maxlength="30" value="<?php 
          $data = date_create($datasolicita);
          echo date_format($data,"d/m/Y"); ?>" readonly /></td></tr>
		  <tr><td colspan="3" style="align:center;"><input type="submit" value="Reenviar"  alt="Clique aqui ou aperte 'Enter'" /></td></tr>
    </table>
</form>
</div><!--end table -->
</div><!--end container -->
<?php
}//end while
$conn->close();
?>
</body>
</html>