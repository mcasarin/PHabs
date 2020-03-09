<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/jquery-1.12.4.js"></script>
<script src="../js/jquery-ui-1.12.1.js"></script>
<script src="../js/bootstrap.min.js"></script>
</head>
<html>
<body>
<?php
include '../include/function.php';
include '../include/connect.php';
sessao();

//Declaração de variaveis
$nome = "";
$empresa = "";
$matricula = "";
$cartao = "";
$coletor = "";
$id = "";
$data = "";
$hora = "";
$acesso = "";
$datainicio = "";
$datafim = "";

//botao voltar
$voltar = "<form action=\"index.php\" method=\"post\">
<button class=\"btn btn-sm btn-warning btn-block\" type=\"submit\" name=\"reload\" role=\"button\"> Voltar ao início </button>
</form>";
//botao tentar novamente
$tentarnovamente = "<form action=\"select_user.php\" method=\"get\">
<input type=\"hidden\" value=\"$matricula\" name=\"matricula\" id=\"matricula\">
<button class=\"btn btn-sm btn-success btn-block\" type=\"submit\" name=\"reload\" role=\"button\"> Tentar novamente? </button>
</form>";


if($_SERVER['REQUEST_METHOD'] == "POST") {
    $matricula = $_POST['matricula'];
    $datainicio = $_POST['datainicio'];
    $datafim = $_POST['datafim'];
    $horainicio = $_POST['horainicio'];
    $horafim = $_POST['horafim'];
    
    date_default_timezone_set('UTC');
    echo "<div class=\"table-responsive\">
        <table class=\"table w-auto\">
        <tr><td colspan=\"2\"><form action=\"exportarpdf.php\" method=\"post\" target=\"_blank\">
        <button type=\"submit\" name=\"btnexportpdf\" id=\"btnexportpdf\">Exportar PDF</button>
        </form></td>
        <td colspan=\"2\"><form action=\"exportarpdf.php\" method=\"post\">
        <button type=\"submit\" name=\"btnexportxls\" id=\"btnexportxls\">Exportar XLS</button>
        </form></td>
        <td colspan=\"2\">$voltar</td><tr>
        </table>";
            $datatrini = date('Y-m-d',strtotime(str_replace("/","-",$datainicio)));
            $datatrfim = date('Y-m-d',strtotime(str_replace("/","-",$datafim)));
            
            while (strtotime($datatrini) <= strtotime($datatrfim)){
                $datalocal = date('dmY',strtotime($datatrini));
                $datalocal = "d".$datalocal;
            
                $sql  = "insert into relusuario(Nome,Empresa,Matricula,Cartao,ID,Coletor,Data,Hora,Acesso) SELECT Nome,Empresa,Matricula,Cartao,ID,Descricao,Data,Hora,Acesso FROM $datalocal WHERE Matricula='$matricula' and Hora BETWEEN '$horainicio' and '$horafim'";
                
                $sqlexe = $conn->query($sql);
                
                $datatrini = date ("Y-m-d", strtotime("+1 days", strtotime($datatrini)));
                
            } // end while data
            $sqltempfinal = "select Nome,Empresa,Matricula,Cartao,ID,Coletor,Data,Hora,Acesso from relusuario";
            
            $sqltempfinalexe = $conn->query($sqltempfinal);
            if($sqltempfinalexe->num_rows > 0){
                echo "<table class=\"table w-auto small\">
                    <thead>
                        <th>Nome</th><th>Empresa</th><th>Matricula</th><th>Cartão</th><th>ID</th><th>Coletor</th><th>Data</th><th>Hora</th><th>Acesso</th>
                    </thead>
                    <tbody>";
                while($linhatemp = $sqltempfinalexe->fetch_array(MYSQLI_ASSOC)){
                    $nome = $linhatemp["Nome"];
                    $empresa = $linhatemp["Empresa"];
                    $matricula = $linhatemp["Matricula"];
                    $cartao = $linhatemp["Cartao"];
                    $id = $linhatemp["ID"];
                    $coletor = $linhatemp["Coletor"];
                    $data = $linhatemp["Data"];
                    $hora = $linhatemp["Hora"];
                    $acesso = $linhatemp["Acesso"];  
                echo "<tr><td>$nome</td><td>$empresa</td><td>$matricula</td><td>$cartao</td><td>$id</td><td>$coletor</td><td>$data</td><td>$hora</td><td>$acesso</td></tr>";
                } // end while temp
                $sqltempfinal->close(); //free result set
            } else {// end if temp
                echo "Não foi encontrado nenhum dado no período informado.<br />";
                echo $tentarnovamente."<br />";
            }
    echo "</tbody>";
echo "</table>";

$conn->close(); // close connection bd
} // end if POST
?>
</body>
</html>
<?php
//end file
?>