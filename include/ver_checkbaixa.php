<?php
include 'function.php';
include 'connect.php';
sessao();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.css">
<script src="../js/jquery-1.12.4.js"></script>
<script src="../js/jquery-ui-1.12.1.js"></script>
<script src="../js/bootstrap.js"></script>

<title>Baixa de Visitantes </title>
</head>
<body>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
$opt = $_POST['opt'];
?>
<table class="table table-striped" style="font-size: 11px;">
		<tr style="background: lightgrey;"><td>Baixa</td><td>Documento</td><td>Nome</td><td>Cartão</td><td>Status</td></tr>
			<?php
			switch($opt) {
				case 'doc':
					$sqlvisopenbaixa = "SELECT Doc,Nome,Matricula,Campo1 FROM visopen ORDER by Doc;";
					$sqlvisopenbaixaexe = $conn->query($sqlvisopenbaixa);
					if($sqlvisopenbaixaexe->num_rows > 0){
						while ($rowopen = $sqlvisopenbaixaexe->fetch_array(MYSQLI_ASSOC)){
						$doc = $rowopen["Doc"];
						$nome = $rowopen["Nome"];
						$matricula = $rowopen["Matricula"];
						$status = $rowopen["Campo1"];
						
							echo "<tr><td><form action='execbaixa.php' method='get'>
  							<input type='hidden' name='rg' id='rg' value='".$doc."'>
  							<input type='hidden' name='matricula' id='matricula' value='".$matricula."'>
								<input type='hidden' name='opt' id='opt' value='doc'>
  							<button type='submit' name='submit' class='btn btn-outline-dark btn-sm'> Baixa </button></td>
							<td>$doc</td><td>$nome</td><td>$matricula</td><td>$status</td></tr>";
						}//while end
						}//if end
						$conn->close;
						exit();
				case 'cartao':
					$sqlvisopenbaixa = "SELECT Doc,Nome,Matricula,Campo1 FROM visopen ORDER by Matricula;";
					$sqlvisopenbaixaexe = $conn->query($sqlvisopenbaixa);
					if($sqlvisopenbaixaexe->num_rows > 0){
						while ($rowopen = $sqlvisopenbaixaexe->fetch_array(MYSQLI_ASSOC)){
						$doc = $rowopen["Doc"];
						$nome = $rowopen["Nome"];
						$matricula = $rowopen["Matricula"];
						$status = $rowopen["Campo1"];
						
							echo "<tr><td><form action='execbaixa.php' method='get'>
  							<input type='hidden' name='rg' id='rg' value='".$doc."'>
  							<input type='hidden' name='matricula' id='matricula' value='".$matricula."'>
								<input type='hidden' name='opt' id='opt' value='cartao'>
  							<button type='submit' name='submit' class='btn btn-outline-dark btn-sm'> Baixa </button></td>
							<td>$doc</td><td>$nome</td><td>$matricula</td><td>$status</td></tr>";
						}//while end
						}//if end
						$conn->close;
						exit();
				case 'nome':
				$sqlvisopenbaixa = "SELECT Doc,Nome,Matricula,Campo1 FROM visopen ORDER by Nome;";
					$sqlvisopenbaixaexe = $conn->query($sqlvisopenbaixa);
					if($sqlvisopenbaixaexe->num_rows > 0){
						while ($rowopen = $sqlvisopenbaixaexe->fetch_array(MYSQLI_ASSOC)){
						$doc = $rowopen["Doc"];
						$nome = $rowopen["Nome"];
						$matricula = $rowopen["Matricula"];
						$status = $rowopen["Campo1"];
						
							echo "<tr><td><form action='execbaixa.php' method='get'>
  							<input type='hidden' name='rg' id='rg' value='".$doc."'>
  							<input type='hidden' name='matricula' id='matricula' value='".$matricula."'>
								<input type='hidden' name='opt' id='opt' value='nome'>
  							<button type='submit' name='submit' class='btn btn-outline-dark btn-sm'> Baixa </button></td>
							<td>$doc</td><td>$nome</td><td>$matricula</td><td>$status</td></tr>";
						}//while end
						}//if end
						$conn->close;
						exit();
				
				default:
					echo "<div class='alert alert-warning'>Houve algum erro!</div>";
					}//switch end
			?>
</table>
</body>
<?php
}//post end
//fim do arquivo
?>