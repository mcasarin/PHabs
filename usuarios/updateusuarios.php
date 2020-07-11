<?php
include 'function.php';
include 'connect.php';
sessao();
/*
*		Insere visita do PHabs no BD
*		Versão 2.6 Data 17nov18
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

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/jquery-1.11.3.min.js"></script>
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
    $cartao = $_POST['cartao'];
    $lote = $_POST['lote'];
    $hexcode = $_POST['hexcode'];
    $empresa = $_POST['empresa'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $ramal = $_POST['ramal'];
    $bloq = $_POST['bloq'];
    $antpass = $_POST['antpass'];
    $temp = $_POST['temp'];
    $obs = $_POST['obs'];

}
//verifica direcionamento
if(isset($_GET["formdirect"])){
	$formdirect = $_GET["formdirect"];
} else {
	$formdirect = $_POST["formdirect"];
}

    switch ($formdirect){
        case update:
            $sqlupdateusuarios = "UPDATE usuarios SET nome='$nome', rg='$rg', empresa='$empresa', email='$email', telefone='$telefone', ramal='$ramal', bloq='$bloq', antpass='$antpass', temp='$temp', obs='$obs' WHERE matricula='$matricula';";
            $sqlupdateusuariosexe = $conn->query($sqlupdateusuarios);

            if($sqlupdateusuariosexe){ //msg de sucesso na atualização
                echo "<div class=\"alert alert-success fade in\" role=\"alert\" style=\"width:250px\">
                <p><strong>Usuário atualizado com sucesso!</strong></p>
                </div>";
            } else { //msg de falha na atualização
                echo "<div class=\"alert alert-warning fade in\" role=\"alert\" style=\"width:250px\">
                <p><strong>Algo deu errado na atualização!</strong><br>Tente novamente...<br>Code(U001)</p>
                </div>";
            }

        break;

        case insert:
            $dataincl = date('Y-m-d');
            $datavalidade = date('Y-m-d',strtotime('+5 year'));
            $sqlinsertusuarios = "INSERT INTO usuarios(Matricula,Cartao,Lote,Hexcode,Nome,RG,Empresa,Departamento,EmailUsu,Telefone,Ramal,DataIncl,Validade,TipoUser,Seg,Ter,Qua,Qui,Sex,Sab,Dom,Fer,ForaTurno,TurnoSeg,TurnoTer,TurnoQua,TurnoQui,TurnoSex,TurnoSab,TurnoDom,TurnoFer,TipoVaga,AntPass,Temp,Bloq,OBS,ID) VALUES ($matricula,$cartao,$lote,$hexcode,$nome,$rg,$empresa,'ADM',$email,$telefone,$ramal,$dataincl,$datavalidade,'Funcionário','1','1','1','1','1','1','1','1','0','1','1','1','1','1','1','1','1','F',$antpass,$temp,$bloq,$obs,null);";
            $sqlinsertusuariosexe = $conn->query($sqlinsertusuarios);
                /*if($sqlinsertusuariosexe){
                    sqlinsert cartoes
                        if ok
                            sqlinsert rede1
                }*/
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