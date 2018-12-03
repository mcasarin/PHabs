<?php
include '../include/function.php';
include '../include/connect.php';
sessao();

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
$controlvaga = $_POST["controlvaga"];
if($controlvaga == '1'){
    $controlvaga = 'SIM';
} else {
    $controlvaga = 'NÃO';
}
$bloqestac = $_POST["bloqestac"];
if ($bloqestac == '1'){
    $bloqestac = 'SIM';
} else {
    $bloqestac = 'NÃO';
}
$vgcond = $_POST["vgcond"];
$qtdcond = $_POST["qtdcond"];
$vgvis = $_POST["vgvis"];
$qtdvis = $_POST["qtdvis"];
$formdirect = $_GET["formdirect"];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.css">
<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/bootstrap.js"></script>

<title>Editar Empresas</title>
</head>
<body>
<?php
switch ($formdirect) {
    case 'update':
        $sqlupdateempresa = "UPDATE empresas SET Empresa='$empresaedit',CNPJ='$cnpj',IE='$ramoatividade',contato='$contato',Telefone='$telefone',email='$email',obs='$obs',Conjunto='$conjunto',Andar='$andar',Bloco='$atualizasite',ControlVaga='$controlvaga',VagaCond='$vgcond',QTDCond='$qtdcond',VagaVis='$vgvis',QTDVis='$qtdvis',BloqEstac='$bloqestac' WHERE empresa = '$empresa'";
        $sqlupdateempresaexe = $conn->query($sqlupdateempresa);
        if($sqlupdateempresaexe){
            echo "<div class=\"alert alert-success fade in\" role=\"alert\" style=\"width:250px\">
            <p><strong>Empresa atualizada com sucesso!</strong></p>
            </div>";
            $sqlupdateusuarios = "UPDATE usuarios SET Empresa='$empresaedit' WHERE Empresa='$empresa'";
            $sqlupdateusuariosexe = $conn->query($sqlupdateusuarios);
            if($sqlupdateusuariosexe){
                echo "<div class=\"alert alert-success fade in\" role=\"alert\" style=\"width:250px\">
                <p><strong>Usuários atualizados com sucesso!</strong></p>
                </div>";
            } else {
                echo "<div class=\"alert alert-warning fade in\" role=\"alert\" style=\"width:250px\">
                <p><strong>Falha para atualizar os usuário da empresa!</strong><br>Tente novamente...</p>
                </div>";
            }
            //atualiza site
            $sqlupdatesite = "INSERT INTO empresa_updatesite(id_empresas_updatesite,empresa,atual,IE,Bloco,acao) VALUES (NULL,'$empresa','$empresaedit','$ramoatividade','$atualizasite','atualiza')";
            $sqlupdatesiteexe = $conn->query($sqlupdatesite);

        } else {
            echo "<div class=\"alert alert-warning fade in\" role=\"alert\" style=\"width:250px\">
            <p><strong>Algo deu errado na atualização!</strong><br>Tente novamente...</p>
            </div>";
        }

        $conn->close;
        break;
    case 'insert':
        $sqlinsertempresa = "INSERT INTO empresas(Empresa, CNPJ, IE, contato, Telefone, email, obs, Conjunto, Andar, Bloco, ControlVaga, VagaCond, QTDCond, VagaVis, QTDVis, BloqEstac) VALUES ('$empresaedit', '$cnpj', '$ramoatividade', '$contato', '$telefone', '$email', '$obs', '$conjunto', '$andar', '$atualizasite', '$controlvaga', '$vgcond', '$qtdcond', '$vgvis', '$qtdvis', '$bloqestac')";
        $sqlinsertempresaexe = $conn->query($sqlinsertempresa);
        if($sqlinsertempresaexe){
            echo "<div class=\"alert alert-success fade in\" role=\"alert\" style=\"width:250px\">
            <p><strong>Empresa inserida com sucesso!</strong></p>
            </div>";
            //atualiza site
            $sqlupdatesite = "INSERT INTO empresa_updatesite(id_empresas_updatesite,empresa,atual,IE,Bloco,acao) VALUES (NULL,'$empresaedit','$empresaedit','$ramoatividade','$atualizasite','insere')";
            $sqlupdatesiteexe = $conn->query($sqlupdatesite);
        } else {
            echo "<div class=\"alert alert-success fade in\" role=\"alert\" style=\"width:250px\">
            <p><strong>Algo deu errado na inserção!</strong><br>Tente novamente...</p>
            </div>";
        }
        
        $conn->close;
        break;
    case 'delete':
        $sqldeleteempresa = "DELETE FROM empresas WHERE Empresa = '$empresaedit'";
        $sqldeleteempresaexe = $conn->query($sqldeleteempresa);
        if($sqldeleteempresaexe){
            echo "<div class=\"alert alert-warning fade in\" role=\"alert\" style=\"width:250px\">
            <p><strong>Empresa APAGADA com sucesso!</strong></p>
            </div>";
            //atualiza site
            $sqlupdatesite = "INSERT INTO empresa_updatesite(id_empresas_updatesite,empresa,atual,IE,Bloco,acao) VALUES (NULL,'$empresaedit','$empresaedit','$ramoatividade','$atualizasite','apaga')";
            $sqlupdatesiteexe = $conn->query($sqlupdatesite);
        } else {
            echo "<div class=\"alert alert-success fade in\" role=\"alert\" style=\"width:250px\">
            <p><strong>Algo deu errado na exclusão!</strong><br>Tente novamente...</p>
            </div>";
        }
        $conn->close;
        break;
    default:
        echo "<div class=\"alert alert-success fade in\" role=\"alert\" style=\"width:250px\">
            <p><strong>Algo deu errado!</strong><br>Informe ao mantenedor do sistema</p>
            </div>";
        break;
}
    
?>
</body>
</html>
<?php
//fim do arquivo
?>