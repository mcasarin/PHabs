<?php
include '../include/function.php';
include '../include/connect.php';
sessao();
/*
#   
#   Entrada de menu Correio
#   data: 15jun23
#
*/
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../css/bootstrap.css" rel="stylesheet">

<title>Entregas e Correios</title>
</head>
<body>

	<div class="container">
        <div class="row">
            <h3 style="text-align:center;background-color:#FEE39A;">Entregas e Correios</h3>
            <h5 style="text-align:center;background-color:#F8B707;">Entradas</h5>
            <br>
            <div class="col-4">
                <div class="row">
                    <a class="btn btn-outline-primary btn-block" href='entrada.php' style="width:80%; margin:5px;padding: 5px;">Cadastro Entrada</a>
                </div>
                <hr>
                <div class="row">
                    <a class="btn btn-outline-primary btn-block" href='listaEntrada.php' style="width:80%; margin:5px;padding: 5px;">Lista Entradas</a>
                </div>
                <hr>
                <div class="row">
                    <a class="btn btn-outline-primary btn-block" href='buscaEntrada.php' style="width:80%; margin:5px;padding: 5px;">Busca Entradas</a>
                </div>
                <br>
                <div class="row">
                    <a class="btn btn-outline-info btn-block" href='index.php' style="width:80%; margin:5px;padding: 5px;">Volta para o menu</a>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>
