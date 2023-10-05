<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include '../include/function.php';
include '../include/connect.php';
sessao();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.css" rel="stylesheet">
<?php

// Declara variaveis
$bloq = "";
$tipo = "";
$perm = "";
$sql = "";
$senha = "";
$confirma = "";
$tipo = "";

if($_SERVER['REQUEST_METHOD'] == "POST") {

    $formdirect = $_POST["formdirect"];
    $nome = $_POST["nome"];
    $login = $_POST["login"];
    if(isset($_POST["senha"])){
        $senha = $_POST["senha"];
        $senha = md5($senha);
    }
    if(isset($_POST["confirma"])){
        $confirma = $_POST["confirma"];
        $confirma = md5($confirma);
    }

    if(isset($_POST["bloq"])){
        $bloq = $_POST["bloq"];
    }
    $tipo = $_POST["tipo"];
    if($tipo == '0'){
        $perm = "'S','SSNS','SNS','S','SSSS','SSSS','SSSS','SSSS','NNNN','NNNN','SSSS','SSSS','S','S','S','S','S','NNNNN','N','N','N','N','N','N','N'";
    } else {
        $perm = "'S','SSNN','SNN','N','NNNN','NNNN','NNNN','NNNN','NNNN','NNNN','NNNN','NNNN','N','N','N','N','N','NNNNN','N','S','S','S','N','N','N'";
    }
    if(isset($_POST["trocasenha"]) && $_POST["trocasenha"] == '1'){
        if($senha !== $confirma){
            echo "Falha: senhas não conferem";
            exit;
        }
        // convert senha
        $sql = "update operadores set Login='$nome',senha='$senha',tipo='$tipo',senhaBloq='$bloq' where Nome='$login'";
    } else {
        $sql = "update operadores set Login='$nome',tipo='$tipo',senhaBloq='$bloq' where Nome='$login'";
    }

    

    switch ($formdirect){
        case 'edit':
            $exec = $conn->query($sql);
            if($exec){
                echo "<div class=\"alert alert-success\" role=\"alert\" style=\"width:250px\">
                <p><strong>Operador atualizado com sucesso!</strong></p>
                </div>";
            } else {
                echo "<div class=\"alert alert-danger\" role=\"alert\" style=\"width:250px\">
                <p><strong>Falha na atualização do operador!</strong><br>Tente novamente...<br>Code(U001)</p>
                <p>Error description: ".$conn->error."</p>
                </div>";
            }
        break;

        case 'insert':
            $newdate = date("Y-m-d");
            $senha = md5($senha);
            $sqlinsert = "insert into operadores (Nome,Login,Senha,SenhaBloq,Data,NTentativas,Tipo,Perm1,Perm2,Perm3,Perm4,Perm5,Perm6,Perm7,Perm8,Perm9,Perm10,Perm11,Perm12,Perm13,Perm14,Perm15,Perm16,Perm17,Perm18,Perm19,Perm20,Perm21,Perm22,Perm23,Perm24,Perm25) values ('$nome','$login','$senha','0','$newdate','0','$tipo',$perm);";
            $exec = $conn->query($sqlinsert);
            if($exec){
                echo "<div class=\"alert alert-success\" role=\"alert\" style=\"width:250px\">
                <p><strong>Operador inserido com sucesso!</strong></p>
                </div>";
            } else {
                echo "<div class=\"alert alert-danger\" role=\"alert\" style=\"width:250px\">
                <p><strong>Falha na inserção do operador!</strong><br>Tente novamente...<br>Code(I001)</p>
                <p>Error description: ".$conn->error."</p>
                </div>";
            }
        break;
    }
}
