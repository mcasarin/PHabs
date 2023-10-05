<?php
include '../include/function.php';
include '../include/connect.php';
sessao();
/*
*		Edita, insere e atualização cadastro usuário do PHabs no BD
*		Versão 2.9 Data 30nov21
*
* # Nova tabela com informações adicionais
*  empresas_info
*
*/
//declarar variaveis
$razaosocial = '';
$administradora = '';
$telemerg1 = '';
$nome1 = '';
$telemerg2 = '';
$nome2 = '';
$telemerg3 = '';
$nome3 = '';
$conjagregados = '';
$cnpj = '';
$ie = '';
$contato = '';
$telefone = '';
$email = '';
$obs = '';
$conjunto = '';
$andar = '';
$bloco = '';
$controlvaga = '';
$bloqestac = '';
$vgcond = '';
$qtdcond = '';
$vgvis = '';
$qtdvis = '';
$ID = '';
$vaga = '';

if (isset($_GET["ID"])) {
	$ID = $_GET["ID"];
	// echo $ID;
	// echo $formdirect;
	$sqledicao = "select * from empresas as emp left join empresas_info as info on emp.ID = info.id_ei where emp.id = '".$ID."'";
	$sqledicaoexe = $conn->query($sqledicao);

	//echo $empresa."<br>";
	//echo $sqledicao."<br>";

	while ($row = $sqledicaoexe->fetch_array(MYSQLI_ASSOC)) {
		$empresa = $row["Empresa"];
		$cnpj = $row["CNPJ"];
		$ie = $row["IE"];
		$contato = $row["contato"];
		$telefone = $row["Telefone"];
		$email = $row["email"];
		$obs =  $row["obs"];
		$conjunto = $row["Conjunto"];
		$andar = $row["Andar"];
		$bloco = $row["Bloco"];
		$controlvaga = $row["ControlVaga"];
		$bloqestac = $row["BloqEstac"];
		$vgcond = $row["VagaCond"];
		$qtdcond = $row["QTDCond"];
		$vgvis = $row["VagaVis"];
		$qtdvis = $row["QTDVis"];
		$ID = $row["ID"];
		$id_ei = $row["id_ei"];
		$razaosocial = $row["razaosocial"];
		$administradora = $row["administradora"];
		$telemerg1 = $row["telemerg1"];
		$nome1 = $row["nome1"];
		$telemerg2 = $row["telemerg2"];
		$nome2 = $row["nome2"];
		$telemerg3 = $row["telemerg3"];
		$nome3 = $row["nome3"];
		$conjagregados = $row["conjagregados"];
	} //end while
}

if (isset($_GET["formdirect"])) {
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
	<script src="../js/jquery-3.6.4.min.js"></script>
	<script src="../js/bootstrap.js"></script>

	<title>Editar Empresas</title>
	<style>
	.css-table {
	display: table;
	width: 550px;
	margin: auto;
	}
	
	.css-table-header {
	display: table-header-group;
	font-weight: bold;
	background-color: rgb(191, 191, 191);
	}
	
	.css-table-body {
	display: table-row-group;
	width: 550px;
	margin: auto;
	font-size: 12px;
	}
	
	.css-table-row {
	display: table-row;
	}
	
	.css-table-header div,
	.css-table-row div {
	display: table-cell;
	padding: 0 6px;
	}
	
	.css-table-header div {
	text-align: center;
	border: 1px solid rgb(255, 255, 255);
	}
	.menor {
		font-size: 12px;
	}
	</style>
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead class="thead-dark">
						<tr>
							<form action="updateempresa.php" method="post">
								<?php
								if ($formdirect == 'update') {
									echo "<th colspan=\"8\"><h4>Editar Empresa/Conjunto</h4></th>";
									echo "<input type=\"hidden\" name=\"ID\" id=\"ID\" value='$ID'>";
									echo "<input type=\"hidden\" name=\"formdirect\" id=\"formdirect\" value=\"update\">";
								} elseif ($formdirect == 'insert') {
									echo "<th colspan=\"8\"><h4>Insere Empresa/Conjunto</h4></th>";
									echo "<input type=\"hidden\" name=\"formdirect\" id=\"formdirect\" value=\"insert\">";
								} elseif ($formdirect == 'apaga') {
									echo "<th colspan=\"8\"><h4>Exclusão Empresa/Conjunto</h4></th>";
									echo "<input type=\"hidden\" name=\"formdirect\" id=\"formdirect\" value=\"delete\">";
								}
								?>
						</tr>
					</thead>

					<tr>
						<td colspan="3">Conjunto - Empresa: <input type="text" name="empresaedit" id="empresaedit" size="50" value="<?php echo $empresa; ?>" />
						<input type="hidden" name="empresa" id="empresa" value="<?php echo $empresa; ?>"></td>
					</tr>
					<tr>
						<td colspan="3">Razão Social: <input type="text" name="razaosocial" id="razaosocial" size="50" value="<?php echo $razaosocial; ?>" /></td>
					</tr>
					<tr>
						<td colspan="3">Administradora: <input type="text" name="administradora" id="administradora" size="50" value="<?php echo $administradora; ?>" /></td>
					</tr>
					<tr>
						<td class="menor">CNPJ: <input type="text" name="cnpj" id="cnpj" size="20" value="<?php echo $cnpj; ?>"></td>
						<td colspan="2" class="menor">Ramo de atividade: <select name="ramoatividade" id="ramoatividade">
								<?php
								if (isset($ie)) {
									$sqlramoat = "SELECT valor,opcao from ramoatividade where valor='$ie'";
									$sqlramoatexe = $conn->query($sqlramoat);
									while ($rowramoat = $sqlramoatexe->fetch_array()) {
										echo "<option value='$rowramoat[valor]'>$rowramoat[opcao]</option>";
									}
								}
								$sqlramo = "SELECT valor,opcao from ramoatividade ORDER BY opcao ASC";
								$sqlramoexe = $conn->query($sqlramo);
								while ($rowramo = $sqlramoexe->fetch_array()) {
									echo "<option value='$rowramo[valor]'>$rowramo[opcao]</option>";
								} //fim while
								?>
							</select>
						</td>
					</tr>
					<tr class="menor">
						<td>Contato (Nome): <input type="text" name="contato" id="contato" value="<?php echo $contato; ?>"></td>
						<td>Telefone: <input type="text" name="telefone" id="telefone" size="15" maxlength="13" value="<?php echo $telefone; ?>"></td>
						<td>
							<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#ModalCenterTelEmerg">
								Telefones Emergenciais
							</button>
						</td>
					</tr>
					<!-- Modal Telefones Emergenciais-->
					<div class="modal fade" id="ModalCenterTelEmerg" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="ModalLongTitle">Telefones Emergenciais</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							
							</button>
						</div>
						<div class="modal-body">
							<div class="css-table">
								<div class="table-body">
									<div class="css-table-row"><div class="cell">Nome: <input type="text" name="telemergnome1" id="telemergnome1" size="10" value="<?php echo $nome1; ?>"></div>
									<div class="cell">Telefone: <input type="text" name="telemerg1" id="telemerg1" maxlength="13" value="<?php echo $telemerg1; ?>"></div></div>
									<div class="css-table-row"><div class="cell">Nome: <input type="text" name="telemergnome2" id="telemergnome2" size="10" value="<?php echo $nome2; ?>"></div>
									<div class="cell">Telefone: <input type="text" name="telemerg2" id="telemerg2" maxlength="13" value="<?php echo $telemerg2; ?>"></div></div>
									<div class="css-table-row"><div class="cell">Nome: <input type="text" name="telemergnome3" id="telemergnome3" size="10" value="<?php echo $nome3; ?>"></div>
									<div class="cell">Telefone: <input type="text" name="telemerg3" id="telemerg3" maxlength="13" value="<?php echo $telemerg3; ?>"></div></div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fechar</button>
						</div>
						</div>
					</div>
					</div>
					<!-- FIM Modal Telefones Emergenciais-->
					<tr>
						<td colspan="3">E-mail: <input type="text" name="email" id="email" size="40" value="<?php echo $email; ?>"></td>
					</tr>
					<tr>
						<td colspan="3" class="align-text-middle">OBS: <textarea rows="4" cols="60" name="obs" id="obs"><?php echo $obs; ?></textarea></td>
					</tr>
					<tr>
						<td>Conjunto (principal): <input type="text" name="conjunto" id="conjunto" size="3" value="<?php echo $conjunto; ?>"></td>
						<td>Andar: <input type="text" name="andar" id="andar" size="2" value="<?php echo $andar; ?>"></td>
						<td>&nbsp</td>
					</tr>
					<tr>
						<td colspan="3">Conjuntos (agregados): <input type="text" name="conjagregados" id="conjagregados" size="30" value="<?php echo $conjagregados; ?>"></td>
					</tr>
					<tr>
						<td colspan="2">Atualiza no site (churchill.com.br): <?php
						if ($bloco == 'naoSite') {
							echo " <b>NÃO</b> <input type=\"radio\" name=\"atualizasite\" id=\"atualizasite\" value=\"naoSite\" checked>  |  SIM <input type=\"radio\" name=\"atualizasite\" id=\"atualizasite\" value=\"sim\"></td><td>&nbsp</td>";
						} else {
							echo " <b>NÃO</b> <input type=\"radio\" name=\"atualizasite\" id=\"atualizasite\" value=\"naoSite\">  |  SIM <input type=\"radio\" name=\"atualizasite\" id=\"atualizasite\" value=\"sim\" checked></td><td>";
								if($formdirect == 'update'){
									echo "<a class=\"btn btn-info btn-sm\" href=\"checkusersite.php?ID=$ID\" target=\"_self\"> Verifica usuário no site </a>";
								} else {
									echo "&nbsp;";
								}
								echo "</td>";
						}
						?>
					</tr>
				<?php
				if ($formdirect == 'update') {
				?>
					<tr>
						<td colspan="3" style="text-align:center;"><a class="btn btn-info" href="../usuarios/checkusuarios.php?empresa=<?php echo $empresa; ?>"> Lista de usuários da empresa - Total </a></td>
					</tr>
				<?php
				}
				?>
					<tr class="menor">
						<td colspan="2">Diferencia Vagas (Condômino/Visitantes): <?php
							if ($controlvaga == 'SIM') {
								echo "<input type=\"checkbox\" name=\"controlvaga\" id=\"controlvaga\" value=\"1\" checked></td>";
							} elseif ($controlvaga == 'NÃO') {
								echo "<input type=\"checkbox\" name=\"controlvaga\" id=\"controlvaga\" value=\"1\" ></td>";
							} else {
								echo "<input type=\"checkbox\" name=\"controlvaga\" id=\"controlvaga\" value=\"1\" ></td>";
							} ?>
						<td>Bloqueio Estacionamento (Acesso/Cadastro): <?php
							if ($bloqestac == 'SIM') {
								echo "<input type=\"checkbox\" name=\"bloqestac\" id=\"bloqestac\" value=\"1\" checked></td></tr>";
							} elseif ($bloqestac == 'NÃO') {
								echo "<input type=\"checkbox\" name=\"bloqestac\" id=\"bloqestac\" value=\"1\"></td></tr>";
							} else {
								echo "<input type=\"checkbox\" name=\"bloqestac\" id=\"bloqestac\" value=\"1\"></td></tr>";
							}
							if ($formdirect == 'update') {
								// Atualização
								?>
								<tr class="menor">
									<td>Vagas Condômino: <input type="text" name="vgcond" id="vgcond" size="3" value="<?php echo $vgcond; ?>"> </td>
									<td>Vagas Visitante: <input type="text" name="vgvis" id="vgvis" size="3" value="<?php echo $vgvis; ?>"> </td>
								</tr>
								<tr>
									<td>
										<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalCenterVagas">
											Visualização das Vagas
										</button>
									</td>
								</tr>
									<!-- Modal Vagas Estacionamento -->
									<div class="modal fade" id="ModalCenterVagas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content" style="width:580px">
										<div class="modal-header">
											<h5 class="modal-title" id="ModalLongTitle">Vagas utilizadas pelo conjunto</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											<div class="css-table">
												<div class='css-table-header'><div><strong>Vaga</strong></div>
													<div><strong>Proprietário</strong></div>
													<div><strong>Conjunto</strong></div>
													<div><strong>Utilização</strong></div>
													<div><strong>Anotação</strong></div>
												</div>
												<div class="css-table-body">
												<?php
													
													$sqlvagas = "SELECT * FROM garagem WHERE utiliza='$ID' ORDER by vaga";
													$sqlvagasexe = $conn->query($sqlvagas);
													if($sqlvagasexe){
														while($rowvagas = $sqlvagasexe->fetch_array()){
															$prop = $rowvagas['proprietario'];
															$conjuntov = $rowvagas['conjunto'];
															$utilizvaga = $rowvagas['utiliza'];
															echo "<div class='css-table-row'><div class='css-table-row'><strong>".$rowvagas['vaga']."</strong></div>
															<div class='css-table-row'>";
															$sql_prop = "SELECT proprietario FROM proprietarios WHERE id_prop=$prop LIMIT 1";
															$result_prop = $conn->query($sql_prop);
															if($result_prop){
																while($ver_prop = $result_prop->fetch_array(MYSQLI_ASSOC)){
																	$nome_prop = $ver_prop['proprietario'];
																	echo $nome_prop;
																}
															}
															echo "</div>
															<div class='css-table-row'>";
															$sql_conjunto = "SELECT Empresa FROM empresas WHERE ID='$conjuntov' LIMIT 1;";
															$sql_conjuntoexe = $conn->query($sql_conjunto);
															if($sql_conjuntoexe){
																while($ver_conjunto = $sql_conjuntoexe->fetch_array(MYSQLI_ASSOC)){
																	$nome_conjunto = $ver_conjunto['Empresa'];
																	echo $nome_conjunto;
																} 
															}
															echo "</div>
															<div class='css-table-row'>";
															$sql_utiliza = "SELECT Empresa FROM empresas WHERE ID='$utilizvaga' LIMIT 1;";
															$sql_utilizaexe = $conn->query($sql_utiliza);
															if($sql_utilizaexe){
																while($ver_utiliza = $sql_utilizaexe->fetch_array(MYSQLI_ASSOC)){
																	$nome_utiliza = $ver_utiliza['Empresa'];
																		if($nome_utiliza > 0){
																			// echo "<a href='../garagem/validavagatag.php?empresa=$nome_utiliza&vaga=$vaga&conjunto=$conjunto' target='_blank'>";
																			echo $nome_utiliza;
																			// echo "</a>";
																		} elseif($nome_utiliza == 0 || $nome_utiliza == '' || !$nome_utiliza) {
																			echo "Não Utilizada/Cadastrada";
																		}
																}
															}
															echo "</div>
															<div class='css-table-row'>".$rowvagas['anotacao']."</div></div>";
														}
													}
												?>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fechar</button>
										</div>
										</div>
									</div>
									</div>
								<?php
								// fim Atualização
							} elseif ($formdirect == 'insert') {
								// Insere nova
								echo "<tr><td>Vagas Condômino: <input type='text' name='vgcond' id='vgcond' size='5' value='0'> </td>
								<td colspan='2'>Vagas Visitante: <input type='text' name='vgvis' id='vgvis' size='5' value='0'> </td></tr>";
								// fim Insere nova
							}
							?>
					<tr>
						<td colspan="2" style="text-align:center;">
							<?php
							if ($formdirect == 'delete') {
							?>
								<input class="btn btn-success btn-lg" type="submit" name="enviar" id="enviar" value="! EXCLUIR !" />
							<?php
							} else {
							?>
								<input class="btn btn-success btn-lg" type="submit" name="enviar" id="enviar" value=" Enviar " />
							<?php
							} //end if
							?>
						</td>
						<td><a href="index.php" style="text-align:right;" class="btn btn-warning btn-lg" type="submit" name="cancel" id="cancel"> Cancelar </a></td>
					</tr>
					</form>
				</table>
			</div> <!-- fim div table -->
		</div> <!-- fim row2 -->
	</div> <!-- fim container -->
</body>
<?php
$conn->close();
//fim do arquivo
?>