<body onLoad="document.getElementById('campo1').focus()"  bgcolor = "silver">
	<?php
		require ("testebanco.php");
		$nome = $_POST ["nome"];
		$rg =  $_POST ["rg"];
		$matricula = $_POST ["matricula"];
		$tipo = $_POST ["tipo"];	
		$nome = strtoupper ($nome);//colocando nomes de usuarios em letras maiusculas.	
		$seg=1; $ter=1; $qua=1; $qui=1; $sex=1; $sab=1; $dom=1; $fer=1;
		$turnoseg=1; $turnoter=1; $turnoqua=1; $turnoqui=1; $turnosex=1; $turnosab=1; $turnodom=1; $turnofer=1;  
		$datacad = date("Y-m-d");//pega a data atual
		$dataval = "2020-12-31"; // marca até a data que vai valer o cartão
		$dep = "ADM"; // colocando o departamente padrão.
		$antpass = "1";// colocando antpassback
		$temp = "1"; // colocando tempo 5 segundos no cartão
		$bloq = "0"; // não bloqueadno cartão
		$foraturno = 0; // não deixado usar fora do turno
		$ausente = 0; // colocando que usuarios esta frequentando o predio.
		$nome = trim ($nome); //tirando espaço no começo e no fim
		$rg = trim ($rg); //tirando espaço no começo e no fim
		$matricula = trim ($matricula); //tirando espaço no começo e no fim
		
		
		//variaveis das  remotas
		
		$Remota1 = 'SNN';	$Remota2 = 'SNN';	$Remota3 = 'SNN';	$Remota4 = 'SNN';	$Remota5 = 'SNN';	$Remota6 = 'SNN';	$Remota7 = 'SNN';	$Remota8 = 'SNN';	$Remota9 = 'SNN';	$Remota10 = 'SNN';	$Remota11 = 'NNN';	$Remota12 = 'NNN';	$Remota13 = 'NNN';	$Remota14 = 'NNN';	$Remota15 = 'NNN';	$Remota16 = 'NNN';	$Remota17 = 'NNN';	$Remota18 = 'NNN';	$Remota19 = 'NNN';	$Remota20 = 'NNN';	$Remota21 = 'NNN';	$Remota22 = 'NNN';	$Remota23 = 'NNN';	$Remota24 = 'NNN';	$Remota25 = 'NNN';	$Remota26 = 'NNN';	$Remota27 = 'NNN';	$Remota28 = 'NNN';	$Remota29 = 'NNN';	$Remota30 = 'NNN';	$Remota31 = 'NNN';	$Campo1 = '';	$Campo2 = '';	$Campo3 = '';	$Campo4 = '';	$Campo5 = '';	$Campo6 = '';	$Campo7 = '';	$Campo8 = '';
		
		echo "<br>RG = $rg<br>";
		// Pegando Ultimo ID
		$idc = mysql_query("SELECT max(ID) as id FROM usuarios");
		while($l = mysql_fetch_array($idc))
		{
			$id = $l["id"];
		}
		echo "<br>&nbsp;&nbsp;&nbsp;Ultimo id = $id <br> ";
		$id+=1;
		echo "Proximo id = $id <br> ";
		//pegando numero do cartão onde junta os 10 numeros
		$cartaoo = mysql_query("SELECT * FROM cartoes where sequencia = \"$matricula\" ");

		while($l = mysql_fetch_array($cartaoo))
		{
			$cartao = $l["cartao"];
			$lote = $l["FC"];
			$hexacode = $l ["Codigo"];
			$uso = $l ["Uso"];
			$empresa =$l ["Empresa"];
		}
		$card = $cartao;
		
		//pegando andar e conjunto da empresa
		$empresac = mysql_query("SELECT * FROM empresas where empresa = '$empresa' ");
		while($l = mysql_fetch_array($empresac))
		{
			$bloco = $l["Bloco"];
			$andar = $l["Andar"];
		}
		// tirando antipassback temporiza para funcionarios do predio
		if ($empresa == "95 - WINSTON CHURCHILL" or $empresa == "ETWAS INF PROJ E PESQ LTDA" or $empresa == "98 - APTEC SERV E MANUT")
		{
			$antpass = "0";
			$temp = "0";
		}
		
		//vendo se é tag ou cartão usuario
		If ($lote == '00000')
		{
			$tipovaga= '0';
			$antpass = "1"; // se for tag mesmo que seja do churchill tem que ter temporiza
			$temp = "1";    // e antpass para não dar entrada e saida ao mesmo tempo
			$veiculo = $nome;//definido que nome e veiculo é a mesma coisa 
			$placa = $rg;// atribuindo o valor de rg para placa
			$placa= strtoupper($placa);// transformando tudo em letra maiuscula
			$placa = trim ($placa); //tirando espaço no começo e no fim
			$nome = "$nome - $placa";//juntando valor de nome com a placa
			$rg = substr($rg, -4, 4);//função para pegar somente os quatro ultimos digitos 
			$rg = "$rg$rg";//duplicando o valor para formar novo rg
			//inserindo a matricula na tabela solicita     confirmo a placa e vejo se o campo tag esta vazio
			$vplaca = mysql_query("SELECT * FROM solicita where placa = '$placa' and tag = 'N/D' ");
			if (mysql_num_rows($vplaca)  == 1)
			{
				$inserir = mysql_query ("update solicita  set tag = '$matricula'   where placa = '$placa' and tag = 'N/D' ");
			}
			else 
			{
				echo "NÃO TEM ESSA PLACA COM TAG N/D NA TABELA SOLICITA, MAS O CADASTRO NO CABS FOI EFETUADO <br>";
			}
			
		}
		else 
		{
			$tipovaga= '0';
		}
		//Verificando se cartão não esta em uso 
		if ($uso == 'SIM') 
		{
			echo "Esta cartão ja foi cadastrado para outro usuário <br> Uso = $uso e matricula em uso $matricula ";
			echo "<br> <input type=\"submit\" class=\"submit\" name=\"Voltar\" value=\"Voltar\"  alt=\"Clique aqui ou aperte 'Enter' \" style=\"cursor:pointer;\" onClick=\"history.go(-1)\" />";
			break;
		}
		//verificando se existe na tabela cartões existe.
		$verif8 = mysql_query ("SELECT * FROM cartoes WHERE sequencia = '$matricula' ");
		if (mysql_num_rows($verif8)  == 0)
		{
			echo "<br>MATRICULA INEXISTENTE, VERIFIQUE SE EXISTE MESMO ESTA MATRICULA<br>";
			echo "<br> <input type=\"submit\" class=\"submit\" name=\"Voltar\" value=\"Voltar\"  alt=\"Clique aqui ou aperte 'Enter' \" style=\"cursor:pointer;\" onClick=\"history.go(-1)\" />";
			break;
		}
			
				//Inserindo na tabela de usuarios 
				$inserir = mysql_query ("INSERT INTO usuarios (Matricula,Cartao,Lote,Hexcode,Nome,RG,Empresa,Andar,Bloco,Departamento,DataIncl,Validade,TipoUser,Seg,Ter,Qua,Qui,Sex,Sab,Dom,Fer,AntPass,Temp,Bloq,ForaTurno,TurnoSeg,TurnoTer,TurnoQua,TurnoQui,TurnoSex,TurnoSab,TurnoDom,TurnoFer,TipoVaga,ID,Ausente,InicAusente,FimAusente,Placa,Veiculo) VALUES ('$matricula','$cartao','$lote','$hexacode','$nome','$rg','$empresa','$andar','$bloco','$dep','$datacad','$dataval','$tipo','$seg','$ter','$qua','$qui','$sex','$sab','$dom','$fer','$antpass','$temp','$bloq','$foraturno','$turnoseg','$turnoter','$turnoqua','$turnoqui','$turnosex','$turnosab','$turnodom','$turnofer','$tipovaga','$id','$ausente','$datacad','$datacad','$placa','$veiculo')");	
				//Inserindo na tabela na tabela rede1
				$rede1 = mysql_query ("INSERT INTO rede1 (cartao,matricula,Id,Remota1,Remota2,Remota3,Remota4,Remota5,Remota6,Remota7,Remota8,Remota9,Remota10,Remota11,Remota12,Remota13,Remota14,Remota15,Remota16,Remota17,Remota18,Remota19,Remota20,Remota21,Remota22,Remota23,Remota24,Remota25,Remota26,Remota27,Remota28,Remota29,Remota30,Remota31,Campo1,Campo2,Campo3,Campo4,Campo5,Campo6,Campo7,Campo8) values ('$cartao','$matricula','$id','$Remota1','$Remota2','$Remota3','$Remota4','$Remota5','$Remota6','$Remota7','$Remota8','$Remota9','$Remota10','$Remota11','$Remota12','$Remota13','$Remota14','$Remota15','$Remota16','$Remota17','$Remota18','$Remota19','$Remota20','$Remota21','$Remota22','$Remota23','$Remota24','$Remota25','$Remota26','$Remota27','$Remota28','$Remota29','$Remota30','$Remota31','$Campo1','$Campo2','$Campo3','$Campo4','$Campo5','$Campo6','$Campo7','$Campo8') ");
				//Colocando  cartão em uso = SIM
				$cartao = mysql_query ("UPDATE cartoes SET Uso = 'SIM' where sequencia = $matricula");
			
				echo "<br> remota1 = $Remota1<br>";
				echo "Nome = $nome <br>RG = $rg<br>Empresa = $empresa <br>andar = $andar<br>bloco = $bloco";
				echo "<br>Tipouser = $tipo <br> matricula = $matricula";
				echo "<br>Cartão os 10 digitos = $card <br> lote = $lote <br>  hexacode = $hexacode <br> $seg $ter $qua $qui $sex $sab $dom $fer <br> $turnoseg $turnoter $turnoqua $turnoqui $turnosex $turnosab $turnodom $turnofer ";
				echo "<br>Data do cadastro = $datacad Data validade = $dataval departamento = $dep tipovaga = $tipovaga";
				echo "<br> placa = $placa <br> carro = $veiculo <br>";
				echo "antpass = $antpass, temporiza = $temp";
				echo "<br><a href = \"index.php\" style=\"text-decoration:none\"> <input type = \"button\" value = \"voltar\"  id=\"campo1\"  > </a>";
	?>
</body>