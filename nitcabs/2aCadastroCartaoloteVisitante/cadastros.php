<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header("Content-type: text/html; charset=utf-8");
// inclui a conexão
include '../../include/function.php';
include '../../include/connect.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <title>Upload de Cadastros de cartão de usuários em Lote</title>
</head>
<body>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$fileName = $_FILES['fileCadCartaoVisitanteLote']['name'];
	$fileTmpName = $_FILES['fileCadCartaoVisitanteLote']['tmp_name'];
	$fileSize = $_FILES['fileCadCartaoVisitanteLote']['size'];
	//$fileError = $_FILES['fileCadCartaoVisitanteLote']['error'];
	$fileType = $_FILES['fileCadCartaoVisitanteLote']['type'];
	$fileNameWithoutExt = pathinfo($fileName, PATHINFO_FILENAME);
	$fileExt = mb_strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
	$superpath = dirname(__DIR__);
	$path = $superpath . '/uploads/' . basename($fileName);
	$allowedExt = array('csv');
	// Valida extensão do arquivo
	if (in_array($fileExt, $allowedExt)) {
		
		if(move_uploaded_file($fileTmpName,$path)){
        
		// Abre o Arquvio no Modo r (para leitura)
		$arquivo = fopen($path, 'r');
		// Lê o conteudo do arquivo
		$linhap = 1;
		$cadastro =0; 
		$cor=0;
	echo "<table border = \"1\" bordercolor = 'black' cellspacing=\"0\" cellpadding=\"2\">
			<tr align = \"center\" bgcolor = '#A9C9C9'>
				<td> Linha Excel </td>
				<td> NW </td>
				<td> FC </td>
				<td> Sequencia </td>
				<td> Tipo </td>
				<td> Uso </td>
				<td> cartão </td>
				<td> Empresa </td>
				<td> Status </td>
			</tr>";
	while(!feof($arquivo)){
		// Pega os dados da linha
		$linha = fgets($arquivo, 1024);
		// Divide as Informações das celulas para poder salvar
		$dados = explode(';', $linha);
		$tipo = "V";
		$uso = 'NÃO';
		if($dados[0] != 'nw' && $dados[0] != 'fim' && !empty($linha) && $dados[0] != ''){ 
			//-------------------------------------------------------------------------------------------------------
			// colocado pois csv NÃO aceita muito bem numeros transformado em texto.
			if (strlen($dados[0]) <= 5 && $dados[0]){
				if (strlen($dados[0]) <= 0){
					$linhap++; // inserido para saber em qual linha do excel deu erro no cartão
					echo "coluna NW sem dados<br>Na linha $linhap<br>";
					break;
				}
				if (strlen($dados[0]) == 1){
					$dados[0] = "0000$dados[0]";
				}
				if (strlen($dados[0]) == 2){
					$dados[0] = "000$dados[0]";
				}
				if (strlen($dados[0]) == 3){
					$dados[0] = "00$dados[0]";
				}
				if (strlen($dados[0]) == 4){
					$dados[0] = "0$dados[0]";
				}
			} else {	
				$linhap++; // inserido para saber em qual linha do excel deu erro no cartão
				echo "coluna NW composta com mais de 5 números<br>Na linha $linhap<br>";
				break;
			}
			//*/
			//-------------------------------------------------------------------------------------------------------
			//-------------------------------------------------------------------------------------------------------
			// colocado zeros pois csv não aceita muito bem numeros transformado em texto.
			if (strlen($dados[1]) <= 5){
				if (strlen($dados[1]) <= 0){
					$linhap++; // inserido para saber em qual linha do excel deu erro no cartão
					echo "coluna codigo sem dados<br>Na linha $linhap<br>";
					break;
				}
				if (strlen($dados[1]) == 1){
					$dados[1] = "0000$dados[1]";
				}
				if (strlen($dados[1]) == 2){
					$dados[1] = "000$dados[1]";
				}
				if (strlen($dados[1]) == 3){
					$dados[1] = "00$dados[1]";
				}
				if (strlen($dados[1]) == 4){
					$dados[1] = "0$dados[1]";
				}
			} else {
				$linhap++; // inserido para saber em qual linha do excel deu erro no cartão
				echo "coluna codigo composta com mais de 5 n�meros<br>Na linha $linhap<br>";
				break;
			}
			//*/
			//-------------------------------------------------------------------------------------------------------
		  $linhap ++;
		  $junta = "$dados[0]$dados[1]";
		  if (is_numeric($dados[3]) ) 
		  {
			$sql=("select empresa from empresas where empresa LIKE '".$dados[3]." -%' ");
			$sqle = $conn->query($sql);
			if($sqle->num_rows > 0)
			{
				while($l = $sqle->fetch_array(MYSQLI_ASSOC)){
					$emp = $l["empresa"];
					
					$verifcard =  $conn->query("select * from cartoes where sequencia LIKE '".$dados[2]."' or cartao = '".$junta."'  ");
					if($verifcard->num_rows == 0){
						$sqlif = $conn->query('INSERT INTO cartoes (sequencia, FC, Codigo, Tipo, Uso, cartao, Empresa) VALUES ("'.$dados[2].'","'.$dados[0].'","'.$dados[1].'","'.$tipo.'","'.$uso.'","'.$junta.'","'.$emp.'")') or die ("erro inserir if <br>");
						$cadastro++;
						$status = "<font color = \"#000000\"> CARTÃO CADASTRADO </font>";
					} else {
						$status = "<font color = \"#000000\"> CARTÃO JA CADASTRADO </font>";
						break;
					}
				}
			} else {
				$emp = "<font color = \"#000000\"> EMPRESA COM </font> ".$dados[3]." <font color = \"#000000\">  NO COME�O NÃO LOCALIZADA </font>  ";
				$status = "<font color = \"#000000\"> cartão NÃO FOI CADASTRADO </font>";
			}
		  } else {	
				$verifemp = $conn->query("select empresa from empresas where empresa LIKE '".$dados[3]."%' ");
				if($verifemp->num_rows > 0){
					$sqlb = $conn->query("select empresa from empresas where empresa LIKE '".$dados[3]."%' ");
					while($l = $sqlb->fetch_array(MYSQLI_ASSOC)){
						$emp = $l["empresa"];
						$verifcardel =  $conn->query("select * from cartoes where sequencia LIKE '".$dados[2]."' or cartao = '".$junta."'  ");
						if($verifcardel->num_rows == 0){
							$sqlelse = $conn->query('INSERT INTO cartoes (sequencia, FC, Codigo, Tipo, Uso, cartao, Empresa) VALUES ("'.$dados[2].'","'.$dados[0].'","'.$dados[1].'","'.$tipo.'","'.$uso.'","'.$junta.'","'.$emp.'")')or die ("erro inserir else <br>");
							$cadastro++;
							$status = "<font color = \"#000000\"> cartão CADASTRADO </font>";
						} else {
							$status = "<font color = \"#000000\"> cartão JA CADASTRADO </font>";
							break;
						}
					}//fecha while que pega a empresa que começa com letras
				} else {
					$emp = "<font color = \"#000000\"> EMPRESA COM </font> ".$dados[3]." <font color = \"#000000\">  NO COME�O NÃO LOCALIZADA </font>  ";
					$status = "<font color = \"#000000\"> cartão NÃO FOI CADASTRADO </font>";
				}
		  }//fecando else que verifica se empresa começa com numero ou letras	
		  //---------------------------------------------------------------------
			if( ($cor%2) == 0){
				echo "<tr bgcolor = '#999999'>";
				echo "<td  align = \"center\">$linhap</td>";
				echo "<td>$dados[0]</td>";
				echo "<td>$dados[1]</td>";
				echo "<td align = \"center\">$dados[2]</td>";
				echo "<td>$tipo</td>";
				echo "<td>$uso</td>";
				echo "<td>$junta</td>";
				echo "<td>$emp</td><td>$status</td> </tr>";
			} else {
				echo "<tr bgcolor = '#CAC8C8'>";
				echo "<td  align = \"center\">$linhap</td>";
				echo "<td>$dados[0]</td>";
				echo "<td>$dados[1]</td>";
				echo "<td align = \"center\">$dados[2]</td>";
				echo "<td>$tipo</td>";
				echo "<td>$uso</td>";
				echo "<td>$junta</td>";
				echo "<td>$emp</td><td>$status</td> </tr>";
			}
			$cor++;
		  //---------------------------------------------------------------------  
		}// fechando if que tira o nome e linha em branco
	}//fechando while
} else {
	echo "Arquivo não encontrado!";
	exit();
} // if arquivo existe $fileNameNew


 fclose($arquivo); // Fecha arquivo aberto
	echo"</table>";
	if ($cadastro <= 1){
		if ($cadastro == 0){	 
			echo "<br><br><font size = \"6\">NÃO foi cadastrado nenhum cartão</font><br>";
		} else {
			echo "<br><br><font size = \"6\">$cadastro cartão cadastrado</font><br>";
		}
	} else {
		echo "<br><br><font size = \"6\">$cadastro cartões cadastrados</font><br>";
	}
} // if extensão
	echo "<form method=\"POST\" action=\"../index.php\" >
	<input type='submit' class='btn btn-outline-warning' value='Voltar'>
	</form>";
}
?>
</body>
</html>