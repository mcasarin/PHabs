<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
include '../include/function.php';
include '../include/connect.php';
sessao();
if (isset($_GET["ID"])) {
	$ID = $_GET["ID"];
} else {
	$ID = $_POST["ID"];
}
$empresa = $_POST["empresa"];
$empresaedit = $_POST["empresaedit"];
$cnpj = $_POST["cnpj"];
$ramoatividade = $_POST["ramoatividade"];
$contato = $_POST["contato"];
$telefone = $_POST["telefone"];
$email = $_POST["email"];
$obs =  $_POST["obs"];
$conjunto = $_POST["conjunto"];
$andar = $_POST["andar"];
$atualizasite = $_POST["atualizasite"];
if(isset($_POST["controlvaga"])){
    $controlvaga = $_POST["controlvaga"];
    if($controlvaga == '1'){
        $controlvaga = 'SIM';
    } else {
        $controlvaga = 'NÃO';
    }
} else {
    $controlvaga = 'NÃO';
}
if(isset($_POST["bloqestac"])){
    $bloqestac = $_POST["bloqestac"];
    if ($bloqestac == '1'){
        $bloqestac = 'SIM';
    } else {
        $bloqestac = 'NÃO';
    }
} else {
    $bloqestac = 'NÃO';
}
$vgcond = $_POST["vgcond"];
if(isset($_POST["qtdcond"])){
    $qtdcond = $_POST["qtdcond"];
}

$vgvis = $_POST["vgvis"];

if(isset($_POST["qtdvis"])){
    $qtdvis = $_POST["qtdvis"];
}
if(isset($_GET["formdirect"])){
    $formdirect = $_GET["formdirect"];
} else {
    $formdirect = $_POST["formdirect"];
}

$IDnew = "";
$razaosocial = $_POST["razaosocial"];
$administradora = $_POST["administradora"];
$telemergnome1 = $_POST["telemergnome1"];
$telemergnome2 = $_POST["telemergnome2"];
$telemergnome3 = $_POST["telemergnome3"];
$conjagregados = $_POST["conjagregados"];
$telemerg1 = $_POST["telemerg1"];
$telemerg2 = $_POST["telemerg2"];
$telemerg3 = $_POST["telemerg3"];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/churchill.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../js/jquery-3.6.4.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.js"></script>
	<title> PHabs </title>
</head>
<body>
<?php
switch ($formdirect) {
    case 'update':
        $sqlupdateempresa = "UPDATE empresas SET Empresa='$empresaedit',CNPJ='$cnpj',IE='$ramoatividade',contato='$contato',Telefone='$telefone',email='$email',obs='$obs',Conjunto='$conjunto',Andar='$andar',Bloco='$atualizasite',ControlVaga='$controlvaga',VagaCond='$vgcond',VagaVis='$vgvis',BloqEstac='$bloqestac' WHERE ID = '$ID'";
        $sqlupdateempresaexe = $conn->query($sqlupdateempresa);
        
        if($sqlupdateempresaexe){
            echo "<div class=\"alert alert-success\" role=\"alert\" style=\"width:250px\">
            <p><strong>Empresa atualizada com sucesso!</strong></p>
            </div>";
            // checa se a empresa já possui registro na empresas_info
            $sqlConsultaEmpresaInfo = "select id_ei as ver from empresas_info where id_ei='$ID'";
            $sqlConsultaEmpresaInfoExe = $conn->query($sqlConsultaEmpresaInfo);
            if($sqlConsultaEmpresaInfoExe->num_rows > 0){
                $sqlupdatedados = "UPDATE empresas_info SET razaosocial='$razaosocial',administradora='$administradora',telemerg1='$telemerg1',nome1='$telemergnome1',telemerg2='$telemerg2',nome2='$telemergnome2',telemerg3='$telemerg3',nome3='$telemergnome3',conjagregados='$conjagregados' WHERE id_ei='$ID'";
            } else {
                $sqlupdatedados = "INSERT INTO empresas_info(id_ei,razaosocial,administradora,telemerg1,nome1,telemerg2,nome2,telemerg3,nome3,conjagregados) VALUES ('$ID','$razaosocial','$administradora','$telemerg1','$telemergnome1','$telemerg2','$telemergnome2','$telemerg3','$telemergnome3','$conjagregados')";
            }
            
            $sqlupdatedadosexe = $conn->query($sqlupdatedados);
            
            if($sqlupdatedadosexe){
                echo "<div class=\"alert alert-success\" role=\"alert\" style=\"width:250px\">
                <p><strong>Dados adicionais da empresa atualizados com sucesso!</strong></p>
                </div>";
                $sqlupdateusuarios = "UPDATE usuarios SET Empresa='$empresaedit' WHERE Empresa='$empresa'";
                $sqlupdateusuariosexe = $conn->query($sqlupdateusuarios);
                if($sqlupdateusuariosexe){
                    echo "<div class=\"alert alert-success\" role=\"alert\" style=\"width:250px\">
                    <p><strong>Usuários atualizados com sucesso!</strong></p>
                    </div>";
                    //atualiza site
                    $sqlupdatesite = "INSERT INTO empresas_updatesite(id_empresas_updatesite,empresa,atual,IE,Bloco,acao,ID) VALUES (NULL,'$empresa','$empresaedit','$ramoatividade','$atualizasite','atualiza','$ID')";
                    $sqlupdatesiteexe = $conn->query($sqlupdatesite);
                    if($sqlupdatesiteexe){
                        echo "<div class=\"alert alert-success\" role=\"alert\" style=\"width:250px\">
                        <p><strong>Enviado para atualização do site!</strong></p>
                        </div>";
                    } else {
                        echo "<div class=\"alert alert-danger\" role=\"alert\" style=\"width:250px\">
                        <p><strong>Falha para envio de dados para o site!</strong><br>Tente novamente...<br>Code(U004)</p>
                        <p>Error description: ".$conn->error."</p>
                        </div>";
                    }
                } else {
                    echo "<div class=\"alert alert-danger\" role=\"alert\" style=\"width:250px\">
                    <p><strong>Falha para atualizar os usuário da empresa!</strong><br>Tente novamente...<br>Code(U003)</p>
                    <p>Error description: ".$conn->error."</p>
                    </div>";
                }
            } else {
                echo "<div class=\"alert alert-danger\" role=\"alert\" style=\"width:250px\">
                <p><strong>Falha para atualizar os dados adicionais da empresa!</strong><br>Tente novamente...<br>Code(U002)</p>
                <p>Error description: ".$conn->error."</p>
                </div>";
            }
        } else {
            echo "<div class=\"alert alert-danger\" role=\"alert\" style=\"width:250px\">
            <p><strong>Algo deu errado na atualização da empresa!</strong><br>Tente novamente...<br>Code(U001)</p>
            <p>Error description: ".$conn->error."</p>
            </div>";
        }

        $conn->close();
        break;
    case 'insert':
        $sqlinsertempresa = "INSERT INTO empresas(Empresa, CNPJ, IE, contato, Telefone, email, obs, Conjunto, Andar, Bloco, ControlVaga, VagaCond, QTDCond, VagaVis, QTDVis, BloqEstac) VALUES ('$empresaedit', '$cnpj', '$ramoatividade', '$contato', '$telefone', '$email', '$obs', '$conjunto', '$andar', '$atualizasite', '$controlvaga', '$vgcond', '0', '$vgvis', '0', '$bloqestac')";
        $sqlinsertempresaexe = $conn->query($sqlinsertempresa);
        if($sqlinsertempresaexe){
            echo "<div class=\"alert alert-success\" role=\"alert\" style=\"width:250px\">
            <p><strong>Empresa inserida com sucesso!</strong></p>
            </div>";
            $recuperaid = "select max(ID) as ID from empresas";
            $recuperaid = $conn->query($recuperaid);
            $row = $recuperaid->fetch_assoc();
            $IDnew = $row['ID'];
            $sqlinsertdadosempr = "INSERT INTO empresas_info(id_ei,razaosocial,administradora,telemerg1,nome1,telemerg2,nome2,telemerg3,nome3,conjagregados) VALUES ('$IDnew','$razaosocial','$administradora','$telemerg1','$telemergnome1','$telemerg2','$telemergnome2','$telemerg3','$telemergnome3','$conjagregados')";
            $sqlinsertdadosemprexe = $conn->query($sqlinsertdadosempr);
			if($sqlinsertdadosemprexe){
                // atualiza site
                if($atualizasite == 'sim'){
                    $sqlupdatesite = "INSERT INTO empresas_updatesite(id_empresas_updatesite,empresa,atual,IE,Bloco,acao,ID) VALUES (NULL,'$empresaedit','$empresaedit','$ramoatividade','$atualizasite','insere','$IDnew')";
                    $sqlupdatesiteexe = $conn->query($sqlupdatesite);
                    if($sqlupdatesiteexe){
                        echo "<div class=\"alert alert-success\" role=\"alert\" style=\"width:250px\">
                        <p><strong>Empresa será atualizada no site!</strong></p>
                        </div>";
                    }
                }
            } else {
                echo "<div class=\"alert alert-danger\" role=\"alert\" style=\"width:250px\">
                <p><strong>Algo deu errado na inserção de dados complementares!</strong><br>Tente novamente...<br>Code(I002)</p>
                <p>Error description: ".$conn->error."</p>
                </div>";
            }
        } else {
            echo "<div class=\"alert alert-danger\" role=\"alert\" style=\"width:250px\">
            <p><strong>Algo deu errado na inserção!</strong><br>Tente novamente...<br>Code(I001)</p>
            <p>Error description: ".$conn->error."</p>
            </div>";
        }
        
        $conn->close();
        break;
    case 'delete':
        $sqldeleteempresa = "DELETE FROM empresas WHERE ID = '$ID'";
        $sqldeleteempresaexe = $conn->query($sqldeleteempresa);
        if($sqldeleteempresaexe){
            echo "<div class=\"alert alert-warning\" role=\"alert\" style=\"width:250px\">
            <p><strong>Empresa APAGADA com sucesso!</strong></p>
            </div>";
            //atualiza site
            $sqlupdatesite = "INSERT INTO empresas_updatesite(id_empresas_updatesite,empresa,atual,IE,Bloco,acao) VALUES (NULL,'$empresaedit','$empresaedit','$ramoatividade','$atualizasite','apaga','$ID')";
            $sqlupdatesiteexe = $conn->query($sqlupdatesite);
        } else {
            echo "<div class=\"alert alert-danger\" role=\"alert\" style=\"width:250px\">
            <p><strong>Algo deu errado na exclusão!</strong><br>Tente novamente...<br>Code(D001)</p>
            </div>";
        }
        $conn->close();
        break;
    default:
        echo "<div class=\"alert alert-danger\" role=\"alert\" style=\"width:250px\">
            <p><strong>Algo deu errado!</strong><br>Informe ao mantenedor do sistema<br>Code(Def001)</p>
            </div>";
        break;
}
    
?>
</body>
</html>
<?php
//fim do arquivo
?>