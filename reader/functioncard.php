<?php
include '../include/function.php';
include '../include/connect.php';
sessao();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.css">
<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/bootstrap.js"></script>
<title>Leitura de cartão</title>
</head>
<body>
<?php
if($_SERVER['REQUEST_METHOD'] == "POST") {
	$opt = $_POST['opt'];
	switch($opt) {
		case 0:
			//limpa tabela
			$sqldelleitor = "TRUNCATE leitor";
			$sqldelleitorexe = $conn->query($sqldelleitor);
			if($sqldelleitorexe) {
				header("location: index.php");
			} else {
				echo "Falha na limpeza da tabela.<br>";
			}
			exit();
		case 1:
			//exporta conteudo
			$sqlselectleitor = "SELECT codfc,coddec,wiegand FROM leitor";
			$result = $conn->query($sqlselectleitor);
			ob_end_clean(); //para limpar cabeçalhos e imprimir somente select
			if($result->num_rows > 0) {
			$fp = fopen('php://output', 'w') or die("Can't open php://output");
			// output headers so that the file is downloaded rather than displayed
			header('Content-type: text/csv');
			header('Content-Disposition: attachment; filename="export.csv"');
			fputcsv($fp,array('Código FC','Código Dec','Código Wiegand'));
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
    			fputcsv($fp, $row);
			}
			fclose($fp);
			} else {
				echo "Falha na exportação.<br>";
			}
			exit();
	}//end switch
	}//end post
?>