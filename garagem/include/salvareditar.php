<?php
include '../../include/function.php';
include '../../include/connect.php';
sessao();
if($_SERVER["REQUEST_METHOD"] == "POST") {
$id = $_POST["id"];
//echo $id."<br>";
$tag = $_POST["tag"];
//echo $tag."<br>";
$fc = $_POST["fc"];
//echo $fc."<br>";
$wie = $_POST["wie"];
//echo $wie."<br>";
$nomesolicita = $_POST["nomesolicita"];
//echo $nomesolicita."<br>";
$empresa = $_POST["empresa"];
//echo $empresa."<br>";
$carro = $_POST["carro"];
//echo $carro."<br>";
$placa = $_POST["placa"];
//echo $placa."<br>";
$datasolicita = $_POST["datasolicita"];
//echo $datasolicita."<br>";
$serialcartao = $fc.$wie;
//echo $serialcartao."<br>";

?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../../css/bootstrap.css">
<script src="../../js/jquery-1.11.3.js"></script>
<script src="../../js/bootstrap.js"></script>
<title>Salvar Solicita</title>
</head>
<body>
<?php
/*
$sqlupdatetag = "UPDATE solicita SET tag = '$tag' WHERE id_sol = $id";
$re = $conn->query($sqlupdatetag);
if($re) {
    echo "<div class='p-3 mb-2 bg-success text-white'>Registro atualizado na planilha.<br />
    TAG cadastrada no sistema.<br />
    Encaminhe a tag ao garagista.</div><br />";
    } else {
        printf("Errormessage: %s\n", $conn->error);       
        $conn->close();
    }
*/
$valida = $conn->query("SELECT sequencia FROM cartoes WHERE sequencia='$tag'");
if ($valida->num_rows > 0){
    echo "<div class='p-3 mb-2 bg-warning text-white'>TAG já consta no sistema.<br />
    Verifique o número digitado e tente novamente.</div><br />
    <div class=\"col-md-4 container col-centered\"><a class=\"btn btn-success btn-block\" role=\"button\" href=\"../checartag.php\"> <<< Voltar <<< </a></div>";
    $conn->close();
    exit;
}
$idratual = "";
$pegaid = $conn->query("SELECT MAX(Id) as Id FROM rede1");
    while($row = $pegaid->fetch_assoc()){
        $idratual = $row["Id"];
    }
$idratual++;


$iduatual = "";
$pegaidu = $conn->query("SELECT MAX(ID) as ID FROM usuarios");
    while($rowa = $pegaidu->fetch_assoc()){
        $iduatual = $rowa["ID"];
    }
$iduatual++;

$datah = date('Y-m-d');


    $sql = "UPDATE solicita SET tag = '$tag' WHERE id_sol = '$id';";
    $sql .= "INSERT INTO cartoes (sequencia,FC,Codigo,Tipo,Uso,cartao,Empresa) VALUES ('$tag','$fc','$wie','F','SIM','$serialcartao','$empresa');";
    $sql .= "INSERT INTO rede1 (cartao,matricula,Id,Remota1,Remota2,Remota3,Remota4,Remota5,Remota6,Remota7,Remota8,Remota9,Remota10,Remota11,Remota12,Remota13,Remota14,Remota15,Remota16,Remota17,Remota18,Remota19,Remota20,Remota21,Remota22,Remota23,Remota24,Remota25,Remota26,Remota27,Remota28,Remota29,Remota30,Remota31,Campo1,Campo2,Campo3,Campo4,Campo5,Campo6,Campo7,Campo8) VALUES ('$serialcartao','$tag','$idratual','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','SNN','','','','','','','','');";
    $sql .= "INSERT INTO usuarios (Matricula,Cartao,Lote,Hexcode,Nome,RG,Empresa,Andar,Conjunto,Bloco,Departamento,Funcao,EmailUsu,Senha,Telefone,Ramal,DataIncl,Validade,TipoUser,Seg,Ter,Qua,Qui,Sex,Sab,Dom,Fer,AntPass,Temp,Bloq,ForaTurno,TurnoSeg,TurnoTer,TurnoQua,TurnoQui,TurnoSex,TurnoSab,TurnoDom,TurnoFer,TipoVaga,Template1,template2,OBS,ID,Placa,Veiculo) VALUES ('$tag','$serialcartao','$fc','$wie','$carro','$placa','$empresa','','','','ADM','','','','','','$datah','2020-12-31','','1','1','1','1','1','1','1','1','1','1','0','0','1','1','1','1','1','1','1','1','F','','','Solicitada por $nomesolicita','$iduatual','$placa','$carro')";
    if($conn->multi_query($sql) === TRUE){
        echo "<div class='p-3 mb-2 bg-success text-white'>Registro atualizado na planilha.<br />
        TAG cadastrada no sistema.<br />
        Encaminhe a tag ao garagista.</div><br />";
    } else {
        echo "<div class='p-3 mb-2 bg-warning text-white'>Não foi possível inserir TAG no banco de dados.<br />
        Verifique o número digitado e tente novamente.</div><br />
        <div class=\"col-md-4 container col-centered\"><a class=\"btn btn-success btn-block\" role=\"button\" href=\"../checartag.php\"> <<< Voltar <<< </a></div>";
        $conn->close();
        exit;
    }

$conn->close();
}//end POST
?>
<div class="col-md-4 container col-centered"><a class="btn btn-success btn-block" role="button" href="../checartag.php"> <<< Voltar <<< </a></div>
</body>
</html>