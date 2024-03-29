<?php
include '../include/function.php';
include '../include/connect.php';
sessao();
/*
*		Edita, insere e atualização cadastro usuário do PHabs no BD
*		Versão 2.8 Data 03jun20
*/
//declarar variaveis
$matricula = "";
$cartao = "";
$lote = "";
$hex = "";
$nome = "";
$rg = "";
$empresa = "";
$andar = "";
$conjunto = "";
$email = "";
$telefone = "";
$ramal = "";
$dataincl = "";
$validade = "";
$tipo = "";
$antpass = "";
$bloq = "";
$temp = "";
$obs = "";
$ID = "";
$statusc = "";


if(isset($_GET["matricula"])){
	$matricula = $_GET["matricula"];
		// coleta usuario pela matricula
		$sqledicao = "SELECT * FROM usuarios WHERE Matricula = '$matricula';";
		$sqledicaoexe = $conn->query($sqledicao);


		while($row = $sqledicaoexe->fetch_array(MYSQLI_ASSOC)){
			$matricula = $row["Matricula"];
			$cartao = $row["Cartao"];
            $nome = $row["Nome"];
            $rg = $row["RG"];
            $empresa = $row["Empresa"];
            $email = $row["EmailUsu"];
            $telefone = $row["Telefone"];
            $ramal = $row["Ramal"];
            $dataincl = $row["DataIncl"];
            $validade_bd = $row["Validade"];
			$validade = date_create($validade_bd);
			$validade = date_format($validade,"d/m/Y");
            $tipo = $row["TipoUser"];
            $antpass = $row["AntPass"];
			$bloq = $row["Bloq"];
			$temp = $row["Temp"];
            $obs = $row["OBS"];
            $ID = $row["ID"];
		} //end while matricula

		// coleta numero de cartao para drop de edição da matricula
		$sqlcoletacartao = "SELECT sequencia,cartao FROM cartoes WHERE sequencia = '$matricula';";
		$sqlcoletacartaoexe = $conn->query($sqlcoletacartao);

		while($rowcartao = $sqlcoletacartaoexe->fetch_array(MYSQLI_ASSOC)){
			$cartao = $rowcartao["cartao"];
		} //end while cartao
		
		// coleta status
		$status = "SELECT Campo1,Campo3,Campo5,Campo7 FROM rede1 where matricula = '$matricula' LIMIT 1";
		$statusexe = $conn->query($status);
		if($statusexe->num_rows > 0){
			while ($rowst = $statusexe->fetch_array(MYSQLI_ASSOC)){
				$campo1 = rowst["Campo1"];
				$campo3 = rowst["Campo3"];
				$campo5 = rowst["Campo5"];
				$campo7 = rowst["Campo7"];
				if($campo1 == "Aguardando" OR $campo3 == "Aguardando" OR $campo5 == "Aguardando" OR $campo7 == "Aguardando" ){
					$statusc = "<span class='btn btn-info'>Status do cartão atual: <br><span style='background-color:tomato;'>Aguardando</span></span></span>";
				} else {
					$statusc = "<span class='btn btn-info'>Status do cartão atual: <br>Normal</span>";
				}
			}
		} else {
			$statusc = "<span class='btn btn-warning'>Status do cartão atual: <br><span style='background-color:tomato;'>Não encontrado na rede</span></span></span>";
		}
}

if(isset($_GET["formdirect"])){
	$formdirect = $_GET["formdirect"];
} else {
	$formdirect = $_POST["formdirect"];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../js/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker3.css">
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.js"></script>
<script src="../js/bootstrap-datepicker-1.9.0-dist/locales/bootstrap-datepicker.pt-BR.min.js"></script>
<title>Editar Usuários</title>
</head>
<body>
<div class="container">
<div class="row">
<div class="table-responsive">
<table class="table table-hover table-sm">
	<thead class="thead-dark"><tr>
	<form action="updateusuarios.php" method="post">
	<?php
	if($formdirect == 'update'){
		echo "<th colspan=\"8\"><h3>Editar Usuário</h3></th>";
		echo "<input type=\"hidden\" name=\"matricula\" id=\"matricula\" value='$matricula'>";
		echo "<input type=\"hidden\" name=\"idbd\" id=\"idbd\" value='$ID'>";
		echo "<input type=\"hidden\" name=\"formdirect\" id=\"formdirect\" value=\"update\">";
	} elseif($formdirect == 'insert') {
		echo "<th colspan=\"8\"><h3>Insere Usuário</h3></th>";
		echo "<input type=\"hidden\" name=\"formdirect\" id=\"formdirect\" value=\"insert\">";
	} elseif($formdirect == 'apaga') {
		echo "<th colspan=\"8\"><h3>Exclusão Usuário</h3></th>";
		echo "<input type=\"hidden\" name=\"formdirect\" id=\"formdirect\" value=\"delete\">";
	}

	?>
    </tr></thead>
		<tr><td colspan="2">Nome: <input type="text" name="nome" id="nome" size="50" value="<?php echo $nome;?>"></td>
		<td>RG: <input type="text" name="rg" id="rg" size="15" value="<?php echo $rg;?>"></td></tr>
		<tr><td colspan="2">Matrícula - Cartão: <?php 
		echo "<select name=\"matricula\" id=\"matricula\" required>";
		echo "<option value=\"$matricula\">$matricula - $cartao</option>";	
			// montagem da combobox matricula/cartão
			// populando o combobox, caso o formulario seja de inserção/insert
			if($formdirect == 'insert'){
			$sql1 = "SELECT sequencia as sequencia,cartao as cartao,FC as fc,Codigo as codigo FROM cartoes WHERE Uso=\"NAO\" and tipo=\"F\" ORDER BY sequencia + 0 ASC;"; //+0 para ordenar campo
			
			// confirmando sucesso
			$result1 = $conn->query($sql1);
			
			// agrupando resultados
				if($result1->num_rows > 0) {
				// combobox

					while ($row0 = $result1->fetch_array(MYSQLI_ASSOC))
						// while para agrupar todos os itens
						echo "<option value=\"$row0[sequencia]\">$row0[sequencia] - $row0[cartao]</option>";
				}
			} // fim populando em caso de inserção/insert
			echo "</select>";
			// fim da combo matricula
			$conn->close;
			?></td><td colspan="1">Validade: <input type="text" name="datavalidade" id="datavalidade" size="15" autocomplete="off" value="<?php echo $validade;?>"/>
					</td></tr>
		<tr><td colspan="3">Empresa: <?php 
		        echo "<select name=\"empresa\" id=\"empresa\" required>";
		        echo "<option value=\"$empresa\">$empresa</option>";	
                    // montagem da combobox empresa
                    // populando o combobox
                    $sql2 = "SELECT DISTINCT empresa FROM empresas WHERE empresa BETWEEN '00' AND '9999' ORDER BY empresa + 0 ASC;"; //+0 para ordenar campo
                    
                    // confirmando sucesso
                    $result2 = $conn->query($sql2);
                    
                    // agrupando resultados
                    if($result2->num_rows > 0) {
                    // combobox

                        while ($row1 = $result2->fetch_array(MYSQLI_ASSOC))
                            // while para agrupar todos os itens
                            echo "<option value=\"$row1[empresa]\">$row1[empresa]</option>";
                    }
                    echo "</select>";
		// fim da combo
		$conn->close();
		?></td></tr>
        <tr><td colspan="3">E-mail: <input type="text" name="email" id="email" size="50" value="<?php echo $email;?>"></td></tr>
        <tr><td>Telefone: <input type="text" name="telefone" id="telefone" size="30" value="<?php echo $telefone;?>"></td><td>Ramal: <input type="text" name="ramal" id="ramal" size="30" value="<?php echo $ramal;?>"></td></tr>
        <tr><td>Bloqueado: 
            <?php
                if($bloq == '1'){
                    echo "SIM <input type=\"radio\" name=\"bloq\" id=\"bloq\" value=\"1\" checked> | NÃO <input type=\"radio\" name=\"bloq\" id=\"bloq\" value=\"0\">";
                } else {
                    echo "SIM <input type=\"radio\" name=\"bloq\" id=\"bloq\" value=\"1\"> | NÃO <input type=\"radio\" name=\"bloq\" id=\"bloq\" value=\"0\" checked>";
                }
            ?>
        </td><td>Antpassback: <?php
                if($antpass == '1'){
                    echo "SIM <input type=\"radio\" name=\"antpass\" id=\"antpass\" value=\"1\" checked> | NÃO <input type=\"radio\" name=\"antpass\" id=\"antpass\" value=\"0\">";
                } else {
                    echo "SIM <input type=\"radio\" name=\"antpass\" id=\"antpass\" value=\"1\"> | NÃO <input type=\"radio\" name=\"antpass\" id=\"antpass\" value=\"0\" checked>";
                }
			?></td>
			<td>Temporiza: <?php
                if($antpass == '1'){
                    echo "SIM <input type=\"radio\" name=\"temp\" id=\"temp\" value=\"1\" checked> | NÃO <input type=\"radio\" name=\"temp\" id=\"temp\" value=\"0\">";
                } else {
                    echo "SIM <input type=\"radio\" name=\"temp\" id=\"temp\" value=\"1\"> | NÃO <input type=\"radio\" name=\"temp\" id=\"temp\" value=\"0\" checked>";
                }
            ?></td></tr>
		<tr><td colspan="2" class="align-text-top">OBS: <textarea rows="4" cols="60" name="obs" id="obs"><?php echo $obs;?></textarea></td>
		<td><?php echo $statusc; ?></td></tr>
		<tr><td>
		<?php
		if($formdirect == 'delete'){
			?>
				<input class="btn btn-success btn-lg" type="submit" name="enviar" id="enviar" value="! EXCLUIR !" />
			<?php
		} else {
			?>
				<input class="btn btn-success btn-lg" type="submit" name="enviar" id="enviar" value=" Salvar " />
			<?php
		} //end if?>
		</td>
		<td><a href="index.php" style="text-align:right;" class="btn btn-warning btn-lg" type="submit" name="cancel" id="cancel"> Cancelar </a></td></tr>
	</form>
</table>
</div> <!-- fim div table -->
</div> <!-- fim row2 -->
</div> <!-- fim container -->
<!-- jQuery Script - Calendario -->
                <script type="text/javascript">
                    // Calendário
                    $('#datavalidade').datepicker({
						'setDefaultDate':true,
                        format: "dd/mm/yyyy",
                        clearBtn: true,
                        language: "pt-BR"
                    });
                
                </script><!-- end calendario -->
</body>
<?php
//fim do arquivo
?>
