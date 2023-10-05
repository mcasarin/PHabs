<?php
include '../include/function.php';
include '../include/connect.php';
sessao();

/*
* Documento de referência: https://www.w3schools.com/php/php_ajax_database.asp
* Arquivo de select dos usuarios: sql_user.php
*
*/

//Declarando variaveis
$empresa = "";
$empresasonum = "";

if($_SERVER['REQUEST_METHOD'] == "POST") {
	$optempresa = $_POST["optempresa"];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../js/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker3.css">
<script src="../js/jquery-3.6.4.min.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.js"></script>
<script src="../js/bootstrap-datepicker-1.9.0-dist/locales/bootstrap-datepicker.pt-BR.min.js"></script>
<title>Selecionar usuário por empresa</title>
</head>
<html>
<body>
<div class="container">
<div class="row">
<div class="table-responsive">
<table class="table table-hover table-md">
	<thead class="thead-dark"><b>Selecione a empresa</b></thead>
		<form action="sql_user.php" id="rel_empresa" method="get">
		<input type="hidden" name="optempresa" value="<?php echo $optempresa; ?>">
	<tr><td>Empresa: 
		        <select name="empresa" id="empresa" class="form-control" required>";
		        <option value="off">Selecionar a empresa</option>";	
				<?php
				    // montagem da combobox empresa
                    // populando o combobox
                    $sql_empresa = "SELECT DISTINCT empresa FROM empresas WHERE empresa ORDER BY empresa +0 ASC;"; //+0 para ordenar campo
                    
                    // confirmando sucesso
                    $result_empresa = $conn->query($sql_empresa);
                    
                    // agrupando resultados
                    if($result_empresa->num_rows > 0) {
					// combobox
                        while ($row1 = $result_empresa->fetch_array(MYSQLI_ASSOC)){
							$empresa = $row1['empresa'];
							$empresasonum = explode(" - ",$empresa);
							$empresasonum = $empresasonum[0];
							// while para agrupar todos os itens
                            echo "<option value=\"$empresasonum\">$empresa</option>";
						}//end while
                    }
                    echo "</select></td></tr>";
			// fim da combo empresa
			//inicio da combo usuario pos select
				echo "<tr><td><div class=\"td\">
				<div> 
				<button type=\"submit\" class=\"btn btn-primary btn-lg\" id=\"loading\" autocomplete=\"off\"> Selecionar empresa </button>
				</div></div>";
			// fim da combo usuario pos select
		$conn->close();
		?>
		</td></tr>
</table>
</div><!-- table-responsive -->
</div><!-- row -->
</div><!-- container -->

</body>
</html>
<?php
} // POST
//end file
?>