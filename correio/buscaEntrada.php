<?php
include '../include/function.php';
include_once '../include/connect.php';
sessao();

/*
#   
#   Busca de devoluções Correio
#   data: 22jun23
#
*/
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../css/bootstrap.min.css" rel="stylesheet">

<title>Busca entradas</title>
</head>
<body>
    <div class="container">
        <h2 style="text-align:center;">Tipos de busca - Entradas</h2>
        <br>
        <div class="d-grid gap-2 col-6 mx-auto">
            <div class="row">
                <a class="btn btn-success btn-block" href='buscaEntradaAR.php'>Busca por AR/Identificador</a>
            </div>
            <div class="row">
                <a class="btn btn-success btn-block" href='buscaEntradaData.php'>Busca por Data</a>
            </div>
            <div class="row">
                <a class="btn btn-success btn-block" href='buscaEntradaConjunto.php'>Busca por Conjunto</a>
            </div>
            <div class="row">
                <a class="btn btn-success btn-block" href='buscaEntradaNome.php'>Busca por Nome</a>
            </div>
            <br><br>
            <div class="row">
                <a class="btn btn-warning btn-sm" href='menuEntradas.php'>Voltar</a>
            </div>
        </div>
    </div>
</body>
</html>