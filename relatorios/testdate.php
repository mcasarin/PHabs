<?php
include '../include/function.php';
include '../include/connect.php';
sessao();

//Declarando variaveis
$nome = '';
$empresa = '';
$matricula = '';
$cartao = '';
$coletor = '';
$descricaocol = '';
$data = '';
$hora = '';
$acesso = '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../include/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css">
<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../include/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
<script src="../include/bootstrap-datepicker/dist/locales/bootstrap-datepicker.pt-BR.min.js"></script>
<title>Relatório de Usuários</title>
</head>
<body>
<h2>Selecione a data de início e final</h2>
<!-- Fonte do calendário e Demo
    https://www.jqueryscript.net/time-clock/Configurable-Date-Picker-Plugin-For-Bootstrap.html
    https://www.jqueryscript.net/demo/Configurable-Date-Picker-Plugin-For-Bootstrap/
-->
<div class="input-daterange input-group datas" id="datepicker">
    <span class="input-group-addon"> Início </span><input type="text" class="input-sm form-control" name="dataInicio" />
    <span class="input-group-addon"> Final </span><input type="text" class="input-sm form-control" name="dataFinal" />
</div>
</div>
<script>
$('.datas').datepicker();
</script>
<?php
    // Função para looping nas datas selecionadas
    // fonte: https://www.if-not-true-then-false.com/2009/php-loop-through-dates-from-date-to-date-with-strtotime-function/
    $datainicio = '01-03-2018';
    $datafinal = '20-02-2019';
    date_default_timezone_set('UTC');
    echo "<div class=\"table-responsive\">
        <table class=\"table\">
        <thead align=\"center\">
            <th>Nome</th><th>Empresa</th><th>Matricula</th><th>Cartão</th><th>Coletor</th><th>Descrição</th><th>Data</th><th>Hora</th><th>Acesso</th>
            </thead>
			<tbody>";
	//while (strtotime($datainicio) <= strtotime($datafinal)) {
                //echo $datainicio."<br>";
                //$dataref = str_replace('-','',$datainicio);
                //echo $dataref."<br>";
                $sql  = 'SELECT Nome,Empresa,Matricula,Cartao,NColetor,Descricao,Data,Hora,Acesso FROM d01032018 WHERE Matricula=\'4104\'';
                //echo $sql."<br>";
                $sqlexe = $conn->query($sql);
                
                if($sqlexe->num_rows > 0){
                    while($linha = $sqlexe->fetch_assoc()){
                        $nome = $linha["Nome"];
                        $empresa = $linha["Empresa"];
                        $matricula = $linha["Matricula"];
                        $cartao = $linha["Cartao"];
                        $coletor = $linha["NColetor"];
                        $descricaocol = $linha["Descricao"];
                        $data = $linha["Data"];
                        $hora = $linha["Hora"];
                        $acesso = $linha["Acesso"];
                        
                    } // end while
                } /*else {
                echo "<div class=\"alert alert-warning fade in\" role=\"alert\" style=\"width:250px\">
                <p><strong>Algo deu errado na inserção!</strong><br>Tente novamente...</p>
                </div>";
                }*/
                echo "<tr><td>$nome</td><td>$empresa</td><td>$matricula</td><td>$cartao</td><td>$coletor</td><td>$descricaocol</td><td>$data</td><td>$hora</td><td>$acesso</td></tr>";
                $datainicio = date ("d-m-Y", strtotime("+1 day", strtotime($datainicio)));
	//}  
echo "</table>";
$conn->close();
?>
</body>
</html>