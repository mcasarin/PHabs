<?php
include '../include/function.php';
include '../include/connect.php';
sessao();
?>
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
<title>Selecionar usuário por empresa</title>
</head>
<html>
<body>
<div class="container">
<div class="row">
<div class="table-responsive">
<table class="table table-hover table-md">
	<thead class="thead-dark">Selecione a empresa para depois selecionar usuário(s)</thead>
	<tr><td>Empresa: <?php
			// inicio da combo empresa
		        echo "<select name=\"empresa\" id=\"empresa\" onchange="$('#dropdown_usuario').load('sql_user.php?empresa='+this.value);" required>";
		        echo "<option value=\"off\">Selecionar</option>";	
                    // montagem da combobox empresa
                    // populando o combobox
                    $sql_empresa = "SELECT DISTINCT empresa FROM empresas WHERE empresa ORDER BY empresa;"; //+0 para ordenar campo
                    
                    // confirmando sucesso
                    $result_empresa = $conn->query($sql_empresa);
                    
                    // agrupando resultados
                    if($result_empresa->num_rows > 0) {
                    // combobox

                        while ($row1 = $result_empresa->fetch_array(MYSQLI_ASSOC))
                            // while para agrupar todos os itens
                            echo "<option value=\"$row1[empresa]\">$row1[empresa]</option>";
                    }
                    echo "</select>";
			// fim da combo empresa
			//inicio da combo usuario pos select
				echo "<div id=\"dropdown2_container\" style=\"display:none\"> 
				
				</div>";
			// fim da combo usuario pos select
		$conn->close;
		?>
		</td></tr>
</table>
</div><!-- table-responsive -->
</div><!-- row -->
</div><!-- container -->

</body>
</html>
<?php
//end file
?>