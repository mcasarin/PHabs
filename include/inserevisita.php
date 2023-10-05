<?php
include 'function.php';
include 'connect.php';
sessao();
/*
*		Insere visita do PHabs no BD
*		Versão 2.6
*		Data criação 17Nov18
* 		Data atualização 15dez21
*/
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/jquery-1.12.4.js"></script>
<script src="../js/jquery-ui-1.12.1.js"></script>
<script src="../js/bootstrap.min.js"></script>
</head>
<?php
header("Content-type: text/html; charset=utf-8");

if($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$visita = $_POST['visita'];
	//echo $visita."<br>";
	if(isset($_POST['foto'])){
		$foto = $_POST['foto'];
		changeImagetoBase64($foto);
	}
	//echo $foto."<br>";
	$rg = $_POST['rg'];
	$rg = ltrim($rg);
	$rg = preg_replace('/[^A-Za-z0-9\. -]/', '', $rg);
	//echo $rg."<br>";
	$nome = $_POST['nome'];
	$nome = ltrim($nome);
	$nome = preg_replace('/[^A-Za-z0-9\. -]/', '', $nome);
	//echo $nome."<br>";
	$empresa = $_POST['empresa'];
	//echo $empresa."<br>";
	$autoriza = $_POST['autoriza'];
	//echo $autoriza."<br>";
	$obs = $_POST['obs'];
	//echo $obs."<br>";
	$cartao = $_POST['cartao'];
	//echo $cartao."<br>";
	$cadastro = date('Y-m-d');
	//echo $cadastro."<br>";
	$hora = date('H:i:s');
	//echo $hora."<br>";
	$terminalbr = $_SERVER["REMOTE_ADDR"];
	//echo $terminal."<br>";
	$terminalarr = explode(".", $terminalbr);
	$terminal = $terminalarr[3];
	$login = $_SESSION["usuario"];
	//echo $login."<br>";
	
	//valida rg com visita aberta
	$sqlvisopen = "SELECT Doc FROM visopen WHERE Doc='$rg'";
	$sqlvisopenexe = $conn->query($sqlvisopen);
	if($sqlvisopenexe->num_rows > 0){
	echo "Visitante com cadastro ativo para visita!<br>";
		?>
		<form action="../cadastrovisitantes.php" method="post">
		<button class="btn btn-sm btn-warning btn-block" type="submit" name="reload" role="button"> Tentar outro? </button>
		</form>
		<?php
		exit();
	}
	// $conn->close();
	
	// coleta numero serial do cartao
	$serialcartao = "";
	$sqlserial = "SELECT cartao FROM cartoes WHERE sequencia = '$cartao' AND Uso = 'NAO' AND Tipo = 'V'"; // numero serial do cartao
	$serial = $conn->query($sqlserial);
	if ($serial->num_rows > 0){
		while ($row1 = $serial->fetch_array(MYSQLI_ASSOC))
			$serialcartao = $row1['cartao'];
	} else {
		echo "Cartão inválido ou ocupado!<br>";
		?>
		<form action="../cadastrovisitantes.php" method="post">
		<button class="btn btn-sm btn-warning btn-block" type="submit" name="reload" role="button"> Tentar novamente? Erro card</button>
		</form>
		<?php
		exit();
	}
	// $conn->close();
	
	// coleta usuario visitado
	$usuario = "";
	$empresasonum = explode(" - ",$empresa);
	$empresasonum = $empresasonum[0];
	// echo $empresasonum."<br>";
	$sqlusuario = "SELECT DISTINCT Nome FROM usuarios WHERE empresa LIKE '".$empresasonum." -%' ORDER BY Nome ASC LIMIT 1"; // usuario da empresa visitada alterado para pegar o primeiro em ordem alfabetica
	// echo $sqlusuario."<br>";
	$sqlusuarioexe = $conn->query($sqlusuario);
	if ($sqlusuarioexe->num_rows > 0){
		while ($row2 = $sqlusuarioexe->fetch_array(MYSQLI_ASSOC))
			$usuario = $row2['Nome'];
	} else {
		$usuario = "Empresa sem usuario cadastrado";
	}
	// $conn->close();
	
	// coleta departamento do usuario visitado
	$dpto = "";
		if($usuario = "Empresa sem usuario cadastrado"){
			$dpto = 'ADM';
		} else {
			$sqldpto = "SELECT DISTINCT Departamento FROM usuarios WHERE empresa like '".$empresasonum."%' LIMIT 1"; // departamento do usuario visitado
			$sqldptoexe = $conn->query($sqldpto);
				if($sqldptoexe->num_rows > 0){
					while ($row3 = $sqldptoexe->fetch_array(MYSQLI_ASSOC))
						$dpto = $row3['Departamento'];
				} else {
					echo "Departamento invalido <br>";
		?>
		<form action="../cadastrovisitantes.php" method="post">
		<button class="btn btn-sm btn-warning btn-block" type="submit" name="reload" role="button"> Tentar novamente? </button>
		</form>
		<?php
		exit();
		}
	} // dpto
	// $conn->close();
	
	//atualiza empresa em caso de alteração recente
	$sqlempresaatual = "SELECT empresa FROM empresas WHERE empresa like '".$empresasonum." -%'";
	$sqlempresaatualexe = $conn->query($sqlempresaatual);
	if($sqlempresaatualexe->num_rows > 0){
		while ($rowempresa = $sqlempresaatualexe->fetch_array(MYSQLI_ASSOC))
			$empresa = $rowempresa['empresa'];
	}
	// $conn->close();
	
	//coleta id do último cadastro em VISOPEN e cria sequencia
	$idatual = "";
	$sqlidatual = "SELECT ID FROM visopen ORDER BY ID DESC LIMIT 1"; // id atualizado da planilha
	$sqlidatualexe = $conn->query($sqlidatual);
	if($sqlidatualexe->num_rows > 0){
		while ($row4 = $sqlidatualexe->fetch_array(MYSQLI_ASSOC))
			$idatual =$row4['ID'];
			++$idatual;
	} else {
		echo "Falha na coleta do ID<br>";
		?>
		<form action="../cadastrovisitantes.php" method="post">
		<button class="btn btn-sm btn-warning btn-block" type="submit" name="reload" role="button"> Tentar novamente? </button>
		</form>
		<?php
		exit();
	}
	// $conn->close;
	
	//coleta id do último cadastro em REDE1 e cria sequencia
	$idratual = "";
	$sqlidratual = "SELECT Id FROM rede1 ORDER BY Id DESC LIMIT 1"; // id atualizado da planilha
	$sqlidratualexe = $conn->query($sqlidratual);
	if($sqlidratualexe->num_rows > 0){
		while ($row4 = $sqlidratualexe->fetch_array(MYSQLI_ASSOC))
			$idratual =$row4['Id'];
			++$idratual;
	} else {
		echo "Falha na coleta do ID<br>";
		?>
		<form action="../cadastrovisitantes.php" method="post">
		<button class="btn btn-sm btn-warning btn-block" type="submit" name="reload" role="button"> Tentar novamente? </button>
		</form>
		<?php
		exit();
	}
	// $conn->close;
	
	// Checa se houve visita anterior
	switch($visita) {
	case 0:
		//cadastra VISOPEN
		$sqlinsertvisopen = "INSERT INTO visopen (Doc,Matricula,Cartao,Status,Nome,Usuario,Empresausuario,Empresavis,Depusuario,Template1,Template2,Campo1,Campo2,Autorizado,ID) VALUES ('$rg','$cartao','$serialcartao','',UPPER('$nome'),'$usuario','$empresa',UPPER('$obs'),UPPER('$dpto'),'','','Cadastro','','$autoriza','$idatual')";
		$sqlinsertvisopenexe = $conn->query($sqlinsertvisopen);
		if ($sqlinsertvisopenexe){
			// echo "Inserido em VISOPEN<br>";
			// cadastra MOVVIS
			$sqlinsertmovvis = "INSERT INTO movvis (Visitante,Usuario,Empresa,Matricula,RG,Terminal,Login,EmpresaVis,Acesso,Coletor,DepUsuario,DataAcesso,HoraAcesso,DColetor,Autorizado,Leitor) VALUES (UPPER('$nome'),'$usuario','$empresa','$cartao','$rg','$terminal','$login',UPPER('$obs'),'Cadastro','',UPPER('$dpto'),'$cadastro','$hora','','$autoriza','')";
			$sqlinsertmovvisexe = $conn->query($sqlinsertmovvis);
			if ($sqlinsertmovvisexe){
				// echo "Inserido em MOVVIS<br>";
				// cadastra VISITANTES
				$sqlinsertvis = "INSERT INTO visitantes (RG,Nome,Empresa,Telefone,Veiculo,Placa_Veiculo,Cor_Veiculo,ListaNegra,Motivo,Cadastro,Visitas,Template1,Template2,Foto1,Foto2,Foto3,VisEmpresa,VisUsuario) VALUES ('$rg',UPPER('$nome'),UPPER('$obs'),'','','','','NÃO','','$cadastro','1','','','".addslashes(file_get_contents($foto))."','','','$empresa','$usuario')";
				$sqlinsertvisexe = $conn->query($sqlinsertvis);
				if ($sqlinsertvisexe){
					//echo "Inserido em VISITANTES<br>";
					//funcao para apagar fotos remotas registradas pela session_id
					session_start();
					$mask = session_id();
					$files = glob('../webcamImage/'.$mask.'*.jpg'); //get all file names
					foreach($files as $file){
						if(is_file($file))
							unlink($file); //delete file
					}
					// Atualiza cartões
					$sqlupdatecartao = "UPDATE cartoes SET Uso='SIM' WHERE sequencia = '$cartao'";
					$sqlupdatecartaoexe = $conn->query($sqlupdatecartao);
					if ($sqlupdatecartaoexe){
						// Cadastra cartão rede1
						$sqlinsertrede = "INSERT INTO rede1 (cartao, matricula, ID, Remota1, Remota2, Remota3, Remota4, Remota5, Remota6, Remota7, Remota8, Remota9, Remota10, Remota11, Remota12, Remota13, Remota14, Remota15, Remota16, Remota17, Remota18, Remota19, Remota20, Remota21, Remota22, Remota23, Remota24, Remota25, Remota26, Remota27, Remota28, Remota29, Remota30, Remota31, Campo1, Campo2, Campo3, Campo4, Campo5, Campo6, Campo7, Campo8) VALUES ('$serialcartao', '$cartao', '$idratual', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', '', '', '', '', '', '', '', '')";
						$sqlinsertredeexe = $conn->query($sqlinsertrede);
						if($sqlinsertredeexe){
						//echo "Insert rede1 com sucesso.<br>";
						/*?> //Caso positivo para todas as atualizações sugere retorno por botão
						<form action="../cadastrovisitantes.php" method="post">
						<button class="btn btn-sm btn-success btn-block" type="submit" name="reload" role="button"> Visitante Cadastrado !</button>
						</form>
						<?php*/
							header("Location: ../cadastrovisitantes.php");
						} else {
							echo "Falha insert rede1.<br>";
							printf("Error message: %s\n", $conn->error);
							?>
							<form action="../cadastrovisitantes.php" method="post">
							<button class="btn btn-sm btn-warning btn-block" type="submit" name="reload" role="button"> Tentar novamente? </button>
							</form>
							<?php
							exit();
						}// fim cadastra cartão rede1
					} else {
						echo "Falha update cartões para visitante novo.<br>";
						printf("Error message: %s\n", $conn->error);
						?>
						<form action="../cadastrovisitantes.php" method="post">
						<button class="btn btn-sm btn-warning btn-block" type="submit" name="reload" role="button"> Tentar novamente? </button>
						</form>
						<?php
						exit();
					} //fim atualiza cartões
					// $conn->close;
				} else {
					echo "Falha insert VISITANTES<br>";
					printf("Error message: %s\n", $conn->error);
					?>
					<form action="../cadastrovisitantes.php" method="post">
					<button class="btn btn-sm btn-warning btn-block" type="submit" name="reload" role="button"> Tentar novamente? </button>
					</form>
					<?php
					exit();
				}
				// $conn->close;
			} else {
				echo "Falha insert MOVVIS<br>";
				printf("Error message: %s\n", $conn->error);
				?>
				<form action="../cadastrovisitantes.php" method="post">
				<button class="btn btn-sm btn-warning btn-block" type="submit" name="reload" role="button"> Tentar novamente? </button>
				</form>
				<?php
				exit();
			}
			// $conn->close;
		} else {
			echo "Falha insert VISOPEN<br>";
			printf("Errormessage: %s\n", $conn->error);
			?>
			<form action="../cadastrovisitantes.php" method="post">
			<button class="btn btn-sm btn-warning btn-block" type="submit" name="reload" role="button"> Tentar novamente? </button>
			</form>
			<?php
			exit();
		}
		// $conn->close;
		break;
	// Se houve visita anterior, cadastra com atualização
	case 1:
		echo "Documento: ".$rg."<br>";
		// echo $foto." = FOTO<br>";
		// coleta numero de visitas do rg
		$numvisita = "";
		$sqlnumvisita = "SELECT Visitas FROM visitantes WHERE RG='$rg'";
		$sqlnumvisitaexe = $conn->query($sqlnumvisita);
		if ($sqlnumvisitaexe->num_rows > 0){
			while ($row5 = $sqlnumvisitaexe->fetch_array(MYSQLI_ASSOC))
				$numvisita = $row5['Visitas'];
		}
		++$numvisita;
		// $conn->close;
		
		//cadastra VISOPEN
		$sqlinsertvisopen = "INSERT INTO visopen (Doc,Matricula,Cartao,Status,Nome,Usuario,Empresausuario,Empresavis,Depusuario,Template1,Template2,Campo1,Campo2,Autorizado,ID) VALUES ('$rg','$cartao','$serialcartao','',UPPER('$nome'),'$usuario','$empresa',UPPER('$obs'),'$dpto','','','Cadastro','',UPPER('$autoriza'),'$idatual')";
		$sqlinsertvisopenexe = $conn->query($sqlinsertvisopen);
		if ($sqlinsertvisopenexe){
			//echo "Inserido no VISOPEN<br>";
				if (isset($foto)){
					$sqlupdatevis = "UPDATE visitantes SET Nome=UPPER('$nome'),Visitas='$numvisita',Foto1='".addslashes(file_get_contents($foto))."',VisEmpresa='$empresa',VisUsuario='$dpto' WHERE RG='$rg'";
					$sqlupdatevisexe = $conn->query($sqlupdatevis);
					if ($sqlupdatevisexe){
						//echo "UPDATE com foto executado com sucesso<br>";
						//funcao para apagar fotos remotas registradas pela session_id
						session_start();
						$mask = session_id();
						$files = glob('../webcamImage/'.$mask.'*.jpg'); //get all file names
						foreach($files as $file){
							if(is_file($file))
								unlink($file); //delete file
						}
					} else {
						echo "Falha no update de visitante com atualização de foto";
						printf("Errormessage: %s\n", $conn->error);
						?>
						<form action="../cadastrovisitantes.php" method="post">
						<button class="btn btn-sm btn-warning btn-block" type="submit" name="reload" role="button"> Tentar novamente? </button>
						</form>
						<?php
						exit();
					}
				} else {
					$sqlupdatevis = "UPDATE visitantes SET Nome=UPPER('$nome'),Empresa=UPPER('$obs'),Visitas='$numvisita',VisEmpresa='$empresa',VisUsuario='$dpto' WHERE RG='$rg'";
					$sqlupdatevisexe = $conn->query($sqlupdatevis);
						if ($sqlupdatevisexe){
							//echo "UPDATE sem foto executado com sucesso<br>";
						} else {
							echo "Falha de update visitante sem atualização de foto";
							printf("Errormessage: %s\n", $conn->error);
							?>
							<form action="../cadastrovisitantes.php" method="post">
							<button class="btn btn-sm btn-warning btn-block" type="submit" name="reload" role="button"> Tentar novamente? </button>
							</form>
							<?php
							exit();
						}
				}
				// $conn->close;
				//cadastra MOVVIS
				$sqlinsertmovvis = "INSERT INTO movvis (Visitante,Usuario,Empresa,Matricula,RG,Terminal,Login,EmpresaVis,Acesso,Coletor,DepUsuario,DataAcesso,HoraAcesso,DColetor,Autorizado,Leitor) VALUES (UPPER('$nome'),'$usuario','$empresa','$cartao','$rg','$terminal','$login',UPPER('$obs'),'Cadastro','',UPPER('$dpto'),'$cadastro','$hora','','$autoriza','')";
				$sqlinsertmovvisexe = $conn->query($sqlinsertmovvis);
				if ($sqlinsertmovvisexe){
					//echo "Inserido MOVVIS visitante reincidente.<br>";
					// Atualiza cartões
					$sqlupdatecartao = "UPDATE cartoes SET Uso='SIM' WHERE sequencia = '$cartao'";
					$sqlupdatecartaoexe = $conn->query($sqlupdatecartao);
					if ($sqlupdatecartaoexe){
						//echo "Update cartões para visitante reincidente.<br>";
							// Cadastra cartão rede1
							$sqlinsertrede = "INSERT INTO rede1 (cartao, matricula, ID, Remota1, Remota2, Remota3, Remota4, Remota5, Remota6, Remota7, Remota8, Remota9, Remota10, Remota11, Remota12, Remota13, Remota14, Remota15, Remota16, Remota17, Remota18, Remota19, Remota20, Remota21, Remota22, Remota23, Remota24, Remota25, Remota26, Remota27, Remota28, Remota29, Remota30, Remota31, Campo1, Campo2, Campo3, Campo4, Campo5, Campo6, Campo7, Campo8) VALUES ('$serialcartao', '$cartao', '$idratual', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', 'SNN', '', '', '', '', '', '', '', '')";
							$sqlinsertredeexe = $conn->query($sqlinsertrede);
							if($sqlinsertredeexe){
								//echo "Insert rede1 com sucesso.<br>";
								/*?> //Caso positivo para todas as atualizações sugere retorno por botão
									<form action="../cadastrovisitantes.php" method="post">
									<button class="btn btn-sm btn-success btn-block" type="submit" name="reload" role="button"> Visitante Cadastrado !</button>
									</form>
								<?php*/
								header("Location: ../cadastrovisitantes.php");
							} else {
								echo "Falha insert rede1.<br>";
								printf("Errormessage: %s\n", $conn->error);
								?>
								<form action="../cadastrovisitantes.php" method="post">
								<button class="btn btn-sm btn-warning btn-block" type="submit" name="reload" role="button"> Tentar novamente? </button>
								</form>
								<?php
							}// fim cadastra cartão rede1
							// $conn->close;
					} else {
						echo "Falha update cartões para visitante novo.<br>";
						printf("Errormessage: %s\n", $conn->error);
						?>
						<form action="../cadastrovisitantes.php" method="post">
						<button class="btn btn-sm btn-warning btn-block" type="submit" name="reload" role="button"> Tentar novamente? </button>
						</form>
						<?php
						exit();
					} //fim atualiza cartões
					// $conn->close;
				} else {
					echo "Falha insert MOVVIS visitante reincidente.<br>";
					printf("Errormessage: %s\n", $conn->error);
					?>
					<form action="../cadastrovisitantes.php" method="post">
					<button class="btn btn-sm btn-warning btn-block" type="submit" name="reload" role="button"> Tentar novamente? </button>
					</form>
					<?php
					exit();
				}
				// $conn->close;
		} else {
			echo "Falha insert VISOPEN visitante reincidente.<br>";
			printf("Errormessage: %s\n", $conn->error);
			?>
			<form action="../cadastrovisitantes.php" method="post">
			<button class="btn btn-sm btn-warning btn-block" type="submit" name="reload" role="button"> Tentar novamente? </button>
			</form>
			<?php
			exit();
		}
		// $conn->close;
		break;
		default:
			echo "Falha geral na inserção de visitante, verifique. ERR swdefault";
	} //end switch*/
} //fim POST
$conn->close();
?>
</html>
<?php 
// EOF
?>