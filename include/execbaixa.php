<?php
include 'function.php';
include 'connect.php';
sessao();
/*
*	Executa baixa
*/
if($_SERVER['REQUEST_METHOD'] == "POST") {
$rg = $_POST['rg'];
$cartao = $_POST['cartao'];
$hora = date('H:i:s');
//echo $hora."<br>";
$terminalbr = $_SERVER["REMOTE_ADDR"];
//echo $terminal."<br>";
$terminalarr = explode(".", $terminalbr);
$terminal = $terminalarr[3];
$dataatual = date('Y-m-d');
//echo $cadastro."<br>";
$horaatual = date('H:i:s');
//echo $hora."<br>";
$login = $_SESSION["usuario"];
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
echo "esse é o RG enviado: ".$rg."<br>";

//delete visopen
$sqldeletevisopen = "DELETE FROM visopen WHERE Doc='$rg'";
$sqldeletevisopenexec = $conn->query($sqldeletevisopen);
if($sqldeletevisopenexec) {
	echo "excluído VISOPEN<br>";
	//insert movvis (baixa)
	$sqlbuscacadastro = "SELECT Visitante,Usuario,Empresa,Matricula,RG,EmpresaVis,DepUsuario FROM movvis WHERE RG = '$rg' AND Acesso='Cadastro' ORDER BY DataAcesso DESC LIMIT 1";
	$sqlbuscacadastroexec = $conn->query($sqlbuscacadastro);
	if($sqlbuscacadastroexec->num_rows > 0) {
		echo "Busca em MOVVIS ok<br>";
		$buscavis = "";
		$buscausu = "";
		$buscaempr = "";
		$buscamatr = "";
		$buscarg = "";
		$buscaemprevis = "";
		$buscadepusu = "";
		while($busca = $sqlbuscacadastroexec->fetch_array(MYSQLI_ASSOC)) {
			$buscavis = $busca['Visitante'];
			$buscausu = $busca['Usuario'];
			$buscaempr = $busca['Empresa'];
			$buscamatr = $busca['Matricula'];
			$buscarg = $busca['RG'];
			$buscaemprevis = $busca['EmpresaVis'];
			$buscadepusu = $busca['DepUsuario'];
		} //end while
	$sqlinsertbaixamovvis = "INSERT INTO movvis (Visitante,Usuario,Empresa,Matricula,RG,Terminal,Login,EmpresaVis,Acesso,Coletor,DepUsuario,DataAcesso,HoraAcesso,DColetor,Autorizado,Leitor) VALUES ('$buscavis','$buscausu','$buscaempr','$buscamatr','$buscarg','$terminal','$login','$buscaemprevis','Baixa','','$buscadepusu','$dataatual','$horaatual','','','')";
	$sqlinsertbaixamovvisexec = $conn->query($sqlinsertbaixamovvis);
	if($sqlinsertbaixamovvisexec) {
		echo "Inserida baixa em MOVVIS<br>";
		//update cartoes
		$sqlupdatecartao = "UPDATE cartoes SET Uso='NAO' WHERE sequencia = '$cartao'";
		$sqlupdatecartaoexe = $conn->query($sqlupdatecartao);
		if ($sqlupdatecartaoexe){
			echo "Efetuado update cartões: USO Não<br>";
			//delete rede1
			$sqldeleterede = "DELETE FROM rede1 WHERE Matricula = '$cartao'";
			$sqldeleteredeexec = $conn->query($sqldeleterede);
			if($sqldeleteredeexec) {
				echo "Excluído rede1<br>";
				header("Location: ../baixavisitantes.php");
			} else {
				echo "Falha na exclusão rede1<br>";
			}
		} else {
			echo "Falha no update cartões USO Não<br>";
		}
	} else {
		echo "Falha em inserir baixa em MOVVIS<br>";
		}
	} else {
		echo "Falha na busca de resgistro MOVVIS<br>";	
	}
} else {
	echo "Falha exclusão VISOPEN<br>";
	}

?>
</body>
</html>
<?php
} // end post
//end file
?>