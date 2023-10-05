<?php
include '../include/function.php';
include '../include/connect.php';
sessao();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" >
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.css">
<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/bootstrap.js"></script>
<title>Leitura de cartão</title>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-3">
			<form action="" method="post">
			<h3><span class="label label-success"> Leitura </span></h3>
				<input type="text" name="input" id="input" autocomplete="off" autofocus />
			</form>

<?php
/*
* BD nitcabs, tabela leitor, campos: id,codfc,coddec,wiegand
*/
if($_SERVER['REQUEST_METHOD'] == "POST") {
	$input = "";
	$wiegand = "";
	$input = $_POST['input'];
	
	$input = dechex($input);
	
	$count = strlen($input); //conta qtd de caracteres para diferenciar padrão
	
	if($count == '6') {
	$fchex = substr($input, 0, 2);
	
	$codigohex = substr($input, 2);
	
	$fcdec = hexdec($fchex);
	$fcdec = str_pad($fcdec,5,"0",STR_PAD_LEFT); //insere zeros a esquerda
	$codigodec = hexdec($codigohex);
	$codigodec = str_pad($codigodec,5,"0",STR_PAD_LEFT); //insere zeros a esquerda
	} else {
		$fchex = substr($input, 0, 1);
	
		$codigohex = substr($input, 1);
	
		$fcdec = hexdec($fchex);
		$fcdec = str_pad($fcdec,5,"0",STR_PAD_LEFT); //insere zeros a esquerda
		$codigodec = hexdec($codigohex);
		$codigodec = str_pad($codigodec,5,"0",STR_PAD_LEFT); //insere zeros a esquerda
	}
	echo "<br>";
	
	$wiegand = $fcdec.$codigodec;
	echo "Cartão coletado: ".$wiegand."<br>";
	$sqlinsertcartao = "INSERT INTO leitor (codfc,coddec,wiegand) VALUES ('$fcdec','$codigodec','$wiegand')";
	$sqlinsertcartaoexe = $conn->query($sqlinsertcartao);
	if($sqlinsertcartaoexe) {
	} else {
		echo "Falha no insert cartão.<br>";	
	}

}
?>
		</div><!-- end col-3 -->
		<div class="col-1">&nbsp;</div>
		<div class="col-4">
			<div class="table-responsive">
				<h3>Lista de cartões coletados</h3>		
				<table class="table table-striped">
				<thead><tr><th>Código FC</th><th>Código DEC</th><th>Código Wiegand</th>
				</tr></thead>
				<?php
				$sqllscartoes = "SELECT codfc,coddec,wiegand FROM leitor";
				$sqllscartoesexe = $conn->query($sqllscartoes);
				if($sqllscartoesexe->num_rows > 0) {
					while($row = $sqllscartoesexe->fetch_array(MYSQLI_ASSOC)) {				
						$listfc = $row['codfc'];
						//$listfc = str_pad($listfc,5,"0",STR_PAD_LEFT);
						$listdec = $row['coddec'];
						//$listdec = str_pad($listdec,5,"0",STR_PAD_LEFT);
						$listwiegand = $row['wiegand'];
						echo "<tr><td>$listfc</td>
						<td>$listdec</td>
						<td>$listwiegand</td></tr>";
					}//end while
				}//end if
				?>
				</table>
			</div><!-- end table-responsive -->
		</div><!-- end col-4 -->
	</div><!-- end row -->
	<br><br>
			<div class="row">
				<div class="col-4">
				<form action="functioncard.php" method="post">
					<input type="hidden" value="0" name="opt" id="opt" />
					<button class="btn btn-danger btn-lg" type="submit" style="margin-right: 5px;">Limpar dados</button>
				</form>
				</div>
				<div class="col-4">
				<form action="functioncard.php" method="post">
					<input type="hidden" value="1" name="opt" id="opt" />
					<button class="btn btn-success btn-lg" type="submit" style="margin-right: 5px;">Exportar dados</button>
				</form>
				</div>
			</div>
		
</div><!-- end container -->
</body>
</html>
<script>
	// foco no input de leitura
	$('#input').focus();
</script>
<?php
//end file
?>