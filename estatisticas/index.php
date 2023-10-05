<?php
include '../include/function.php';
include '../include/connect.php';
sessao();
/*
#   
#   Entrada de menu Estatistica
#   data: 29jun23
#
*/
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap 523 -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">

<title>Estatísticas</title>
</head>
<body>

	<div class="container">
    <h3 style="text-align:center;background-color:#FEE39A;">Estatísticas</h3>
        <br>
        <div class="d-grid gap-2 col-6 mx-auto">
            <div class="row">
                <a class="btn btn-outline-primary btn-block" href='dashboard.php'>Dashboard</a>
            </div>
            <div class="row">
                <a class="btn btn-outline-primary btn-block" href='#'>Usuários</a>
            </div>
            <div class="row">
                <a class="btn btn-outline-primary btn-block" href='#'>Visitantes</a>
            </div>
            <div class="row">
                <!--<a class="btn btn-primary btn-block" href='listaDevolucao.php'>Lista Devoluções</a>-->
            </div>
        </div>
    </div>
    
</body>
</html>
