<?php
include '../include/function.php';
include '../include/connect.php';
sessao();
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../js/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker3.css">
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.js"></script>
<script src="../js/bootstrap-datepicker-1.9.0-dist/locales/bootstrap-datepicker.pt-BR.min.js"></script>
<title>Cadastro carona</title>
</head>
<body>
<div class="row">
<div class="col-lg-8 table-responsive">
<table class="table table-hover">
    <tr><td colspan="4" align="center"><h3><b>Cadastro de Carona</b></h3></td></tr>
        <form method="POST" action="salvarcarona.php" name="cadastrocarona" id="cadastrocarona">
		
		<tr><td>Selecione a data:</td>
                <td>
                <div class="input-group" id="datepicker">
                    <input type="text" class="form-control" id="dataregistro" name="dataregistro" autocomplete="off" required />
                </div>
                <!-- jQuery Script -->
                <script type="text/javascript">
                    // Calendário
                    $('input').datepicker({
                        format: "dd/mm/yyyy",
                        endDate: "today",
                        clearBtn: true,
                        language: "pt-BR"
                    });
					
                </script><!-- end calendario -->
				
            </td><td>Hora: </td><td>
			<div class="input-group" id="timepicker">
                    <input type="time" id="horaregistro" name="horaregistro" autocomplete="off" required />
                </div>
				</td></tr>
		<tr><td>Selecione a catraca: </td><td colspan="3">
			<select name="catraca" name="catraca" size="6" required />
				<option value="CATRACA 1 - TR">Catraca 1 - RCP</option>
				<option value="CATRACA 2 - TR">Catraca 2 - RCP</option>
				<option value="CATRACA 3 - TR">Catraca 3 - RCP</option>
				<option value="CATRACA 4 - TR">Catraca 4 - RCP</option>
				<option value="CATRACA 5 - TR">Catraca 5 - PRT</option>
				<option value="CATRACA 6 - TR">Catraca 6 - PRT</option>
				<option value="CATRACA 7 - 1SS">Catraca 7 - 1SS</option>
				<option value="CATRACA 8 - 2SS">Catraca 8 - 2SS</option>
			</select>
			</td></tr>
        <tr><td>Sabe o nome do usuário? </td><td colspan="3"><input size="60" type="text" id="nome" name="nome" maxlength="80" style = "text-transform: uppercase" /></td></tr>
        <tr><td>Sabe o conjunto? </td><td colspan="3"><?php
        // montagem da combobox empresa
            echo "<select name='empresa' id='empresa'>";
            echo "<option value=''>-- Selecione somente se tiver certeza! --</option>";
            // populando o combobox
            $sql3 = "SELECT DISTINCT empresa FROM empresas WHERE empresa BETWEEN '00' AND '9999' ORDER BY empresa + 0 ASC;"; // +0 para ordenar campo
        
           // confirmando sucesso
            $result3 = $conn->query($sql3);
        
           // agrupando resultados
            if($result3->num_rows > 0) {
            // combobox
            
            while ($row = $result3->fetch_array(MYSQLI_ASSOC))
                // while para agrupar todos os itens
                echo "<option value='$row[empresa]'>$row[empresa]</option>";
            }
            echo "</select>";
                // fim da combo<br>
                $conn->close;
        ?>
        </td></tr>
        <tr align="center"><td colspan="4"><button class="btn btn-primary btn-lg" name="submit" alt="Clique aqui ou aperte 'Enter'" style="cursor:pointer;">Cadastrar</button></td></tr>
        </form>
</table>
</div><!--end table responsive-->
</div><!--end row-->
</body>
</html>