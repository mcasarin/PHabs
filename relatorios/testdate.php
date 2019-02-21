<?php
//inicio arquivo
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
    $datainicio = '20180119';
    $datafinal = '20190220';
	date_default_timezone_set('UTC');
	while (strtotime($datainicio) <= strtotime($datafinal)) {
                echo "$datainicio<br>";
                $datainicio = date ("Ymd", strtotime("+1 day", strtotime($datainicio)));
	}

?>
</body>
</html>