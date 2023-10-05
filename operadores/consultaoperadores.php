<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL);
include '../include/function.php';
include '../include/connect.php';
sessao();

if($_SERVER['REQUEST_METHOD'] == "POST") {
	$formdirect = $_POST["formdirect"];
    
} else {
	$formdirect = $_GET["formdirect"];
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.css" rel="stylesheet">
</head>
<body>

	<div class="container">
		<h3 style="text-align: center;"> Consulta de Operadores </h3>
		<div class="row">
            <div class="col">
			<form action="" name="busca" id="busca" method="POST" class="form-horizontal">
		<label style="padding:10px;">Nome ou login: </label><input type="text" id="valor" name="valor" placeholder="escreva todos para lista completa; bloqueados lista somente nesse status" autofocus required size="60">
			<button type="submit" name="send" id="send" class="btn btn-info" style="padding:10px;"> Pesquisar </button>

			<input type="hidden" name="formdirect" id="formdirect" value="<?php echo $formdirect; ?>">
			</form>
            </div>
        </div>
	</div><!-- div container -->
    <div>
        <?php
        if(isset($_POST["send"])){
            $valor = $_POST["valor"];
            if($valor == 'todos'){
                $sql = "select nome,login,data,senhaBloq from operadores where 1 order by Nome,Login";
            } elseif($valor == 'bloqueados'){
                $sql = "select nome,login,data,senhaBloq from operadores where senhaBloq='1' order by Nome,Login";
            } else {
                $sql = "select nome,login,data,senhaBloq from operadores where Nome like '%".$valor."%' or Login like '%".$valor."%'";
            }
            $exec = $conn->query($sql);
            if($exec->num_rows > 0){
                ?>
                <div>
                <table class="table table-responsive table-striped">
                    <thead>
                    <th>Login</th><th>Nome</th><th>Cadastro</th><th>Bloqueio</th>
                    </thead>
                    <tbody>
                        <?php
                        while($row = $exec->fetch_array(MYSQLI_ASSOC)){
                            echo "<tr><td><a href='editaroperadores.php?formdirect=edit&login=".$row['nome']."'>".$row['nome']."</a></td>";
                            echo "<td>".$row['login']."</td>";
                            echo "<td>".ordenaData($row['data'])."</td>";
                            echo "<td";
                            if($row['senhaBloq'] == '1'){
                                echo " style='color:red;'>Bloqueado</red>";
                            } else {
                                echo ">Normal";
                            }
                            echo "</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <?php
            }
        }
        ?>

    </div>

</body>
</html>
<?php

?>