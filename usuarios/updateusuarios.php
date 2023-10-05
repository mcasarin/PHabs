<?php
include '../include/function.php';
include '../include/connect.php';
sessao();
/*
*		Insere usuario do PHabs no BD
*		Versão 2.8.1 Data 04mai22
*/
//declarando variáveis
$formdirect = "";
$matricula = "";
$cartao = "";
$lote = "";
$hexcode = "";
$nome = "";
$rg = "";
$empresa = "";
$email = "";
$telefone = "";
$ramal = "";
$bloq = "";
$antpass = "";
$temp = "";
$obs = "";
$newid = "";
$ID = "";

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/jquery-1.12.4.js"></script>
<script src="../js/jquery-ui-1.12.1.js"></script>
<script src="../js/bootstrap.min.js"></script>
</head>
<?php
header("Content-type: text/html; charset=utf-8");

if($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$nome = $_POST['nome'];
	//echo $nome."<br>";
	$rg = $_POST['rg'];
	//echo $rg."<br>";
    $matricula = $_POST['matricula'];
	// echo $matricula."<br>";
		// coleta numero de cartao para drop de edição da matricula
		$sqlcoletacartao = "SELECT sequencia,cartao,FC,Codigo FROM cartoes WHERE sequencia = '$matricula';";
		$sqlcoletacartaoexe = $conn->query($sqlcoletacartao);
		while($rowcartao = $sqlcoletacartaoexe->fetch_array(MYSQLI_ASSOC)){
			$cartao = $rowcartao["cartao"];
			$lote = $rowcartao["FC"];
			$hexcode = $rowcartao["Codigo"];
		} //end while cartao
	// echo $cartao."<br>";
	// echo $lote."<br>";
	// echo $hexcode."<br>";
    $empresa = $_POST['empresa'];
    $email = $_POST['email'];
	$datavalidade_post = $_POST['datavalidade'];
	$datavalidade = explode("/",$datavalidade_post);
	list($dia,$mes,$ano) = $datavalidade;
	$datavalidade = "$ano-$mes-$dia";
    $telefone = $_POST['telefone'];
    $ramal = $_POST['ramal'];
    $bloq = $_POST['bloq'];
    $antpass = $_POST['antpass'];
    $temp = $_POST['temp'];
    $obs = $_POST['obs'];
	$ID = $_POST['idbd'];

}
//verifica direcionamento
if(isset($_GET["formdirect"])){
	$formdirect = $_GET["formdirect"];
} else {
	$formdirect = $_POST["formdirect"];
}

    switch ($formdirect){
        case update:
		
            $sqlupdateusuarios = "UPDATE usuarios SET cartao='$cartao', lote='$lote', hexcode='$hexcode', nome='$nome', rg='$rg', empresa='$empresa', EmailUsu='$email', telefone='$telefone', ramal='$ramal', Validade='$datavalidade', bloq='$bloq', antpass='$antpass', temp='$temp', obs='$obs' WHERE matricula='$matricula';";
			// echo $sqlupdateusuarios."<br>";
            $sqlupdateusuariosexe = $conn->query($sqlupdateusuarios);

            if($sqlupdateusuariosexe){ //msg de sucesso na atualização
                echo "<div class=\"alert alert-success fade in\" role=\"alert\" style=\"width:250px\">
                <p><strong>Usuário atualizado com sucesso!</strong></p>
                </div>";
				// Garatia de cadastro único
				$deleteRede = "DELETE FROM rede1 WHERE Matricula='$matricula';";
				// echo $deleteRede."<br>";
				$deleteRedeExe = $conn->query($deleteRede);
				/*if($deleteRedeExe){
					echo "DEL ok!";
				} else {
					echo "DEL error";
				}*/
				$insertRede = "INSERT INTO rede1(Cartao,Matricula,id,remota1,remota2,remota3,remota4,remota5,remota6,remota7,remota8,remota9,remota10,remota11,remota12,remota13,remota14,remota15,remota16,remota17,remota18,remota19,remota20,remota21,remota22,remota23,remota24,remota25,remota26,remota27,remota28,remota29,remota30,remota31) values ('$cartao','$matricula','$ID','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN')";
				//echo $insertRede;
				$insertRedeexe = $conn->query($insertRede);
				if($insertRedeexe){
					echo "<div class=\"alert alert-success fade in\" role=\"alert\" style=\"width:250px\">
					<p><strong>Cartão inserido na Rede com sucesso!</strong></p>
					</div>";
					// LOG OPERADOR
					$terminalbr = $_SERVER["REMOTE_ADDR"];
					$terminalarr = explode(".", $terminalbr);
					$terminal = $terminalarr[3];
					$sqllog = "insert into logoper(Operador,Operacao,Data,Hora,Terminal) values ('".$_SESSION["nome"]."','Alterada matricula $matricula','".date("Y-m-d")."','".date("H:i:s")."','$terminal')";
					$log = $conn->query($sqllog);
					// END LOG OPERADOR
				}
            } else { //msg de falha na atualização
                echo "<div class=\"alert alert-warning fade in\" role=\"alert\" style=\"width:250px\">
                <p><strong>Algo deu errado na atualização!</strong><br>Tente novamente...<br>Code(U001)</p>
                </div>";
            }
			$conn->close();
        break;

        case insert:
			
			$newid = "select max(ID) as newid from usuarios";
			$newidexe = $conn->query($newid);
			$resultId = mysqli_fetch_array($newidexe);
			$newidResult = $resultId["newid"];
			$newidResult += 1;
            $dataincl = date('Y-m-d');
            $sqlinsertusuarios = "INSERT INTO usuarios(Matricula,Cartao,Lote,Hexcode,Nome,RG,Empresa,Departamento,EmailUsu,Telefone,Ramal,DataIncl,Validade,TipoUser,Seg,Ter,Qua,Qui,Sex,Sab,Dom,Fer,ForaTurno,TurnoSeg,TurnoTer,TurnoQua,TurnoQui,TurnoSex,TurnoSab,TurnoDom,TurnoFer,TipoVaga,AntPass,Temp,Bloq,OBS,ID) VALUES ('$matricula','$cartao','$lote','$hexcode','$nome','$rg','$empresa','ADM','$email','$telefone','$ramal','$dataincl','$datavalidade','Funcionário','1','1','1','1','1','1','1','1','0','1','1','1','1','1','1','1','1','F','$antpass','$temp','$bloq','$obs','$newidResult');";
			// echo $sqlinsertusuarios;
        
			$sqlinsertusuariosexe = $conn->query($sqlinsertusuarios);
            if($sqlinsertusuariosexe){ //msg de sucesso na inserção
                echo "<div class=\"alert alert-success fade in\" role=\"alert\" style=\"width:250px\">
                <p><strong>Usuário inserido com sucesso!</strong></p>
                </div>";
				$updateCartao = "UPDATE cartoes set Uso='SIM' WHERE sequencia = $matricula";
				//echo $updateCartao;
				$updateCartaoexe = $conn->query($updateCartao);
				if($updateCartaoexe){
					echo "<div class=\"alert alert-success fade in\" role=\"alert\" style=\"width:250px\">
					<p><strong>Cartão atualizado com sucesso!</strong></p>
					</div>";
				}
				$insertRede = "INSERT INTO rede1(Cartao,Matricula,id,remota1,remota2,remota3,remota4,remota5,remota6,remota7,remota8,remota9,remota10,remota11,remota12,remota13,remota14,remota15,remota16,remota17,remota18,remota19,remota20,remota21,remota22,remota23,remota24,remota25,remota26,remota27,remota28,remota29,remota30,remota31) values ('$cartao','$matricula','$newidResult','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN')";
				//echo $insertRede;
				$insertRedeexe = $conn->query($insertRede);
				if($insertRedeexe){
					echo "<div class=\"alert alert-success fade in\" role=\"alert\" style=\"width:250px\">
					<p><strong>Cartão inserido na Rede com sucesso!</strong></p>
					</div>";
					// LOG OPERADOR
					$terminalbr = $_SERVER["REMOTE_ADDR"];
					$terminalarr = explode(".", $terminalbr);
					$terminal = $terminalarr[3];
					$sqllog = "insert into logoper(Operador,Operacao,Data,Hora,Terminal) values ('".$_SESSION["nome"]."','Inserida matricula $matricula','".date("Y-m-d")."','".date("H:i:s")."','$terminal')";
					$log = $conn->query($sqllog);
					// END LOG OPERADOR
				}
            } else { //msg de falha na inserção
                echo "<div class=\"alert alert-warning fade in\" role=\"alert\" style=\"width:250px\">
                <p><strong>Algo deu errado na inserção!</strong><br>Tente novamente...<br>Code(In001)</p>
                </div>";
            }
			$conn->close;
        break;

        case apaga:
            /*sqlapaga usuarios
             if ok
              sqlupdate cartoes
               if ok
                sqlupdate rede1*/

        break;
    }

?>
</html>