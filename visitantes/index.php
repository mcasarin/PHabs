<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 523 -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <title> PHabs </title>
</head>
<?php
include '../include/function.php';
include '../include/connect.php';
sessao();
?>

<body>

    <div class="container">
        
        <div class="row">
        <h3 style="text-align:center;background-color:#FEE39A;">Visitantes</h3>
        <br>
            <div class="col-4">
                <div class="row">
                    <a class="btn btn-outline-primary btn-block" href='../cadastrovisitantes.php' style="width:80%; margin:5px;padding: 5px;">Cadastro</a>
                </div>
                <div class="row">
                    <a class="btn btn-outline-primary btn-block" href='../baixavisitantes.php' style="width:80%; margin:5px;padding: 5px;">Baixa</a>
                </div>
                <div class="row">
                    <a class="btn btn-outline-primary btn-block" href='check.php' style="width:80%; margin:5px;padding: 5px;">Checar Autorizados</a>
                </div>
                <div class="row">
                    <a class="btn btn-outline-primary btn-block" href='formautoriza.php' style="width:80%; margin:5px;padding: 5px;">Cadastro Autorizações</a>
                </div>
                <div class="row">
                    <a class="btn btn-outline-primary btn-block" href='relautoriza.php' style="width:80%; margin:5px;padding: 5px;">Lista Autorizados</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>