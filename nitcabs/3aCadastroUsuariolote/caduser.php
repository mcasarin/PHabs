<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header("Content-type: text/html; charset=utf-8");
// inclui a conexão
include '../../include/function.php';
include '../../include/connect.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <title>Upload de Cadastros de Usuários em Lote</title>
</head>
<body>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$cad = "";
	$fileName = $_FILES['fileCadUsuarioLote']['name'];
	$fileTmpName = $_FILES['fileCadUsuarioLote']['tmp_name'];
	$fileSize = $_FILES['fileCadUsuarioLote']['size'];
	//$fileError = $_FILES['fileCadUsuarioLote']['error'];
	$fileType = $_FILES['fileCadUsuarioLote']['type'];
	$fileNameWithoutExt = pathinfo($fileName, PATHINFO_FILENAME);
	$fileExt = mb_strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
	$superpath = dirname(__DIR__);
	$path = $superpath . '/uploads/' . basename($fileName);
	$allowedExt = array('csv');
	// Valida extensão do arquivo
	if (in_array($fileExt, $allowedExt)) {

		if(move_uploaded_file($fileTmpName,$path)){

		$arquivo = fopen($path, 'r');

	// Lê o conteúdo do arquivo
					
		echo"
		 <table border = \"1\" width = \"160%\" bordercolor = 'black' cellspacing=\"0\" cellpadding=\"2\">
			<tr bgcolor = '#A9C9C9'>
				<td width = \"1%\" > U. ID  </td> 
				<td width = \"1%\" > P. ID </td>
				<td width = \"1%\" > REMOTAS </td>
				<td width = \"20%\" > NOME </td>  
				<td width = \"5%\" > RG </td>  
				<td width = \"1%\" > MATRICULA </td> 
				<td width = \"20%\" > EMPRESA </td> 	
				<td width = \"1%\" > ANTPASS </td>  
				<td width = \"1%\" > TEMPORIZA </td> 				
				<td width = \"1%\" > ANDAR </td> 
				<td width = \"3%\" > BLOCO </td>  
				<td width = \"4%\" > CARTAO </td> 
				<td width = \"4%\" > LOTE </td> 
				<td width = \"5%\" > HEXACODE </td>
				<td width = \"1%\" > DIAS DA SEMANA </td> 
				<td width = \"1%\" > TURNOS </td>
				<td width = \"5%\" > D. CAD. </td> 
				<td width = \"5%\" > D. VALI. </td> 
				<td width = \"1%\" > DPTO </td> 
				<td width = \"1%\" > TIPOVAGA </td>
				<td width = \"2%\" > PLACA </td> 
				<td width = \"2%\" > CARRO </td>
			</tr>
		";
	$cor = 0;//trocar a cor da linhas na tabela
	$linhap=1;// ver em que linha deu o erro
	while(!feof($arquivo)){
		// Pega os dados da linha
		$linha = fgets($arquivo, 1024);
		// Divide as Informações das celulas para poder salvar
		$dados = explode(',', $linha);
		
		$tipo = "F";
		$uso = 'NÃO';
		If ( ( $dados[0] != 'NOME' && $dados[0] != 'fim' && !empty($linha) ) ){
		
			$nome = $dados[0];
			$rg = $dados[1];
			$matricula = $dados[2];
			//echo "<br><br> $nome , $rg, $matricula<br><br>";
			$matricula = trim($matricula);
		
			$tipo = "Funcionário";	//atribuindo o tipo de usuario
			$nome = strtoupper ($nome);//colocando nomes de usuarios em letras maiusculas.	
			$seg=1; $ter=1; $qua=1; $qui=1; $sex=1; $sab=1; $dom=1; $fer=1;
			$turnoseg=1; $turnoter=1; $turnoqua=1; $turnoqui=1; $turnosex=1; $turnosab=1; $turnodom=1; $turnofer=1;  
			$datacad = date("Y-m-d");//pega a data atual
			$dataval = "2025-12-31"; // marca at� a data que vai valer o cart�o
			$dep = "ADM"; // colocando o departamente padr�o.
			$antpass = "1";// colocando antpassback
			$temp = "1"; // colocando tempo 5 segundos no cart�o
			$bloq = "0"; // n�o bloqueadno cart�o
			$foraturno = 0; // n�o deixado usar fora do turno
			$ausente = 0; // colocando que usuarios esta frequentando o predio.
			$nome = trim ($nome); //tirando espa�o no come�o e no fim
			$rg = trim ($rg); //tirando espa�o no come�o e no fim
			$matricula = trim ($matricula); //tirando espa�o no come�o e no fim
			$dvisual = date ("d-m-Y"); // criada s� para ver melhor a data atual
			$df = "31-12-2025"; // criada s� para ver melhor a data de validade
			//-------------------------------------------------------------------------------------------
			$veiculo = ""; // aqui tem essas duas variaveis pois se tem uma tag no meio 
			$placa = "";   // cadastra o veiculo e placa para os demais usuarios
			$andar="";	// variavel que ficava pegando valor antigo
			$bloco="";	// variavel que ficava pegando valor antigo
			$idold = "";	// variavel que ficava pegando valor antigo
			$id = "";	// variavel que ficava pegando valor antigo
			$empresa = ""; // variavel que ficava pegando valor antigo
			//-------------------------------------------------------------------------------------------
			//variaveis das  remotas
			
			$Remota1 = 'SNN';	$Remota2 = 'SNN';	$Remota3 = 'SNN';	$Remota4 = 'SNN';	$Remota5 = 'SNN';	$Remota6 = 'SNN';	$Remota7 = 'SNN';	$Remota8 = 'SNN';	$Remota9 = 'SNN';	$Remota10 = 'SNN';	$Remota11 = 'NNN';	$Remota12 = 'NNN';	$Remota13 = 'NNN';	$Remota14 = 'NNN';	$Remota15 = 'NNN';	$Remota16 = 'NNN';	$Remota17 = 'NNN';	$Remota18 = 'NNN';	$Remota19 = 'NNN';	$Remota20 = 'NNN';	$Remota21 = 'NNN';	$Remota22 = 'NNN';	$Remota23 = 'NNN';	$Remota24 = 'NNN';	$Remota25 = 'NNN';	$Remota26 = 'NNN';	$Remota27 = 'NNN';	$Remota28 = 'NNN';	$Remota29 = 'NNN';	$Remota30 = 'NNN';	$Remota31 = 'NNN';	$Campo1 = '';	$Campo2 = '';	$Campo3 = '';	$Campo4 = '';	$Campo5 = '';	$Campo6 = '';	$Campo7 = '';	$Campo8 = '';
			
			//-------- PEGANDO ID ---------------------------------------------------------------------
			// Pegando Ultimo ID
			$idc = $conn->query("SELECT max(ID) as id FROM usuarios");
			while($l = $idc->fetch_array(MYSQLI_ASSOC)){
				$idold = $l["id"];
			}
			$id = $idold + 1 ; // acrescentando um numero para novo id
			//-------- PEGANDO ID ----------------------------------------------------------------------
			//pegando numero do cart�o onde junta os 10 numeros
			$cartaoo = $conn->query("SELECT * FROM cartoes where sequencia = \"$matricula\" ");
			while($l = $cartaoo->fetch_array(MYSQLI_ASSOC)){
				$cartao = $l["cartao"];
				$lote = $l["FC"];
				$hexacode = $l ["Codigo"];
				$uso = $l ["Uso"];
				$empresa =$l ["Empresa"];
			}
			$card = $cartao;
			
			//pegando andar e conjunto da empresa
			$empresac = $conn->query("SELECT * FROM empresas where empresa = '$empresa' ");
			while($l = $empresac->fetch_array(MYSQLI_ASSOC)){
				$bloco = $l["Conjunto"];
				$andar = $l["Andar"];
			}
			// tirando antipassback temporiza para funcionarios do predio
			if ($empresa == "95 - WINSTON CHURCHILL" or $empresa == "ETWAS INF PROJ E PESQ LTDA" or $empresa == "98 - APTEC SERV E MANUT"){
				$antpass = "0";
				$temp = "0";
			}
			
			//vendo se � tag ou cart�o usuario
			/*If ($lote == '00000')
			{
				$tipovaga= '0';
				$antpass = "1"; // se for tag mesmo que seja do churchill tem que ter temporiza
				$temp = "1";    // e antpass para n�o dar entrada e saida ao mesmo tempo
				$veiculo = $nome;//definido que nome e veiculo � a mesma coisa 
				$placa = $rg;// atribuindo o valor de rg para placa
				$placa= strtoupper($placa);// transformando tudo em letra maiuscula
				$placa = trim ($placa); //tirando espa�o no come�o e no fim
				$nome = "$nome - $placa";//juntando valor de nome com a placa
				$rg = substr($rg, -4, 4);//fun��o para pegar somente os quatro ultimos digitos 
				$rg = "$rg$rg";//duplicando o valor para formar novo rg
				//inserindo a matricula na tabela solicita     confirmo a placa e vejo se o campo tag esta vazio
				$vplaca = $conn->query("SELECT * FROM solicita where placa = '$placa' and tag = 'N/D' ");
				if ($vplaca->num_rows == 1)
				{
					$inserir = $conn->query ("update solicita  set tag = '$matricula' where placa = '$placa' and tag = 'N/D' ");
				}
				else 
				{
					echo "NÃO TEM ESSA PLACA <b>$placa</b> COM TAG N/D NO SISTEMA <b> $matricula </b>";
					//echo "<br> <input type=\"submit\" class=\"submit\" name=\"Voltar\" value=\"Voltar\"  alt=\"Clique aqui ou aperte 'Enter' \" style=\"cursor:pointer;\" onClick=\"history.go(-1)\" />";
					break;
				}
			}
			else 
			{*/
				$tipovaga= '0';
			//}
			//Verificando se cartão não esta em uso 
			if ($uso == 'NÃO'){				
				//verificando se existe na tabela cartões.
				$verif8 = $conn->query ("SELECT * FROM cartoes WHERE sequencia = '$matricula' ");
				if ($verif8->num_rows == 1){
					//echo "faz cad<br>";
					///*
					//Inserindo na tabela de usuarios 
					$inserir = $conn->query("INSERT INTO usuarios (Matricula,Cartao,Lote,Hexcode,Nome,RG,Empresa,Andar,Conjunto,Departamento,DataIncl,Validade,TipoUser,Seg,Ter,Qua,Qui,Sex,Sab,Dom,Fer,AntPass,Temp,Bloq,ForaTurno,TurnoSeg,TurnoTer,TurnoQua,TurnoQui,TurnoSex,TurnoSab,TurnoDom,TurnoFer,TipoVaga,ID,Ausente,InicAusente,FimAusente,Placa,Veiculo) VALUES ( $matricula,'$cartao','$lote','$hexacode','$nome','$rg','$empresa','$andar','$bloco','$dep','$datacad','$dataval','$tipo','$seg','$ter','$qua','$qui','$sex','$sab','$dom','$fer','$antpass','$temp','$bloq','$foraturno','$turnoseg','$turnoter','$turnoqua','$turnoqui','$turnosex','$turnosab','$turnodom','$turnofer','$tipovaga','$id','$ausente','$datacad','$datacad','$placa','$veiculo')");	
					//Inserindo na tabela na tabela rede1
					$rede1 = $conn->query("INSERT INTO rede1 (cartao,matricula,Id,Remota1,Remota2,Remota3,Remota4,Remota5,Remota6,Remota7,Remota8,Remota9,Remota10,Remota11,Remota12,Remota13,Remota14,Remota15,Remota16,Remota17,Remota18,Remota19,Remota20,Remota21,Remota22,Remota23,Remota24,Remota25,Remota26,Remota27,Remota28,Remota29,Remota30,Remota31,Campo1,Campo2,Campo3,Campo4,Campo5,Campo6,Campo7,Campo8) values ('$cartao',$matricula,'$id','$Remota1','$Remota2','$Remota3','$Remota4','$Remota5','$Remota6','$Remota7','$Remota8','$Remota9','$Remota10','$Remota11','$Remota12','$Remota13','$Remota14','$Remota15','$Remota16','$Remota17','$Remota18','$Remota19','$Remota20','$Remota21','$Remota22','$Remota23','$Remota24','$Remota25','$Remota26','$Remota27','$Remota28','$Remota29','$Remota30','$Remota31','$Campo1','$Campo2','$Campo3','$Campo4','$Campo5','$Campo6','$Campo7','$Campo8') ");
					//Colocando  cartão em uso = SIM
					$cartao = $conn->query ("UPDATE cartoes SET Uso = 'SIM' where sequencia = $matricula");
					//*/
					$cad++;
					if ( ($cor%2) == 0){
						echo"
							<tr bgcolor = '#999999'>
								<td align = 'center' > $idold </td> 
								<td align = 'center' > $id </td> 
								<td align = 'center' > $Remota1 </td>  
								<td > $nome </td>  
								<td > $rg </td> 
								<td align = 'center' > $matricula </td>
								<td > $empresa </td> 
								<td align = 'center' > $antpass </td> 
								<td align = 'center' > $temp </td> 
								<td align = 'center' > $andar </td>
								<td align = 'center' > $bloco </td>
								<td > $card </td> 
								<td > $lote </td>
								<td > $hexacode </td>  
								<td > $seg </td> 
								<td > $turnoseg </td> 
								<td > $dvisual </td>
								<td > $df </td> 
								<td > $dep </td> 
								<td > $tipovaga </td> 
								<td > $placa </td> 
								<td > $veiculo </td> 
							</tr>
							";
					} else {
						echo"
							<tr bgcolor = '#CAC8C8'>
								<td align = 'center' > $idold </td> 
								<td align = 'center' > $id </td> 
								<td align = 'center' > $Remota1 </td>  
								<td > $nome </td>  
								<td > $rg </td> 
								<td align = 'center' > $matricula </td>
								<td > $empresa </td>
								<td align = 'center' > $antpass </td> 
								<td align = 'center' > $temp </td>  
								<td align = 'center' > $andar </td>
								<td align = 'center' > $bloco </td>
								<td > $card </td> 
								<td > $lote </td>
								<td > $hexacode </td>  
								<td > $seg </td> 
								<td > $turnoseg </td> 
								<td > $dvisual </td>
								<td > $df </td> 
								<td > $dep </td> 
								<td > $tipovaga </td> 
								<td > $placa </td> 
								<td > $veiculo </td>
							</tr>
							";
					}
					$cor++;
				} else {
					//echo "Matricula n�o existe<br>";
					echo "MATRICULA INEXISTENTE, VERIFIQUE SE EXISTE MESMO ESTA MATRICULA <b> $matricula </b><br>";
					//echo "<br> <input type=\"submit\" class=\"submit\" name=\"Voltar\" value=\"Voltar\"  alt=\"Clique aqui ou aperte 'Enter' \" style=\"cursor:pointer;\" onClick=\"history.go(-1)\" />";					
				}
			} else {
				echo "Matricula $matricula ja cadastrada no sistema na linha $linhap do arquivo Excel, na tabela cartão uso = $uso<br>";
				//echo "Esta cart�o <b> $matricula </b> ja foi cadastrado para outro usu�rio <br> Uso = $uso";
				//echo "<br> <input type=\"submit\" class=\"submit\" name=\"Voltar\" value=\"Voltar\"  alt=\"Clique aqui ou aperte 'Enter' \" style=\"cursor:pointer;\" onClick=\"history.go(-1)\" />";
				//break;
			}
			
		} // fechando o if 
		$linhap++;
		
	} // fechando o while
} else {
	echo "Arquivo não encontrado!";
	exit();
} // if arquivo existe $fileNameNew
	
	fclose($arquivo); // Fecha arquivo aberto
	echo "</table>";
	if ($cad <=1){
		if ($cad < 1){
			echo "<br><font size = \"5\"> Nenhum cadastro Inserido no Sistema! </font>";
		}
		if ($cad == 1){
			echo "<br><font size = \"5\"> $cad Cadastro Inserido no Sistema! </font> <br>";
		}
		
	} else {
		echo "<br><font size = \"5\"> $cad Cadastros Inseridos no Sistema </font> <br>";		
	}
	unlink($path);
} // if extensão
echo "<form method=\"POST\" action=\"../index.php\">
<input type='submit' class='btn btn-outline-warning' value=' Voltar '>
</form>";
} // end if POST
	?>
</body>
</html>