<?php
ob_start(); //resolvendo o problema do Header
?>

<body onLoad="document.getElementById('campo1').focus()"  bgcolor = "silver">
	<?php
		require ('testebanco.php');
		ob_start(); 						//resolvendo o problema do Header
		$matricula = $_POST["matricula"]; //sequencia no nitcabs
		$nw = $_POST["nw"];//fc no nitcabs
		$codigo = $_POST["codigo"];//codigo no nitcabs
		$uso = $_POST["uso"];//uso  no nitcabs
		$tipo = $_POST["tipo"];//tipo  no nitcabs
		$empresa = $_POST["empresa"];//empresa  no nitcabs
		$junta = "$nw$codigo";// cartao no nitcabs
		$nw = trim($nw);
		$matricula = trim($matricula);
		$junta = trim($junta);
		//echo "$matricula <br> $nw  <br> $codigo <br> $uso <br> $empresa <br> $junta <br> $tipo <br>";
		$verif = mysql_query ("SELECT * FROM cartoes WHERE sequencia = '$matricula' ");
		$verif1 = mysql_query ("SELECT * FROM cartoes WHERE cartao = '$junta' ");
		if ($empresa == "-- Selecione --")
		{
			echo "<h1 align = 'center'>Clique em voltar <br>E escolha uma empresa valida</h1><br>";
			echo "<br> <input type=\"submit\" class=\"submit\" name=\"Voltar\" value=\"Voltar\"  alt=\"Clique aqui ou aperte 'Enter' \" style=\"cursor:pointer;\" onClick=\"history.go(-1)\" />";
			break;
		}
		
		if (mysql_num_rows($verif) != 0)
		{
			echo "<br> Sequencia = $matricula ( Número da frente do cartão ) ja cadastrado <br>";
			echo "<br> <input type=\"submit\" class=\"submit\" name=\"Voltar\" value=\"Voltar\"  alt=\"Clique aqui ou aperte 'Enter' \" style=\"cursor:pointer;\" onClick=\"history.go(-1)\" />";
			break;
		}
		else

		if (mysql_num_rows($verif1)  != 0)
		{
			echo "<br> Cartão ja cadastrado = $junta (Sequência de 10 digitos atraz do cartão) <br>";
			echo "<br> <input type=\"submit\" class=\"submit\" name=\"Voltar\" value=\"Voltar\"  alt=\"Clique aqui ou aperte 'Enter' \" style=\"cursor:pointer;\" onClick=\"history.go(-1)\" />";
			break;	
		}
		else 
		{
			$sql = mysql_query("INSERT INTO cartoes (sequencia,FC,Codigo,Tipo,Uso,cartao,Empresa) VALUES('$matricula','$nw','$codigo','$tipo','$uso','$junta','$empresa')");
									
			echo "Matricula = $matricula <br> 
				  w1 = $nw <br>  
				  codigo = $codigo  <br> 
				  Matricula = $matricula <br>
				  Nw+codigo = $junta <br> 
				  empresa = $empresa <br> 
				  cartão em uso = $uso<br>
				  tipo = $tipo <br>";	
				  $verif3 = mysql_query ("SELECT * FROM cartoes WHERE sequencia = '$matricula' ");
				  if (mysql_num_rows($verif3) > 0)
					   {
						echo "<br>Cartão cadastrado com sucesso !!!!!!!! <br>";
					   }
				  else	
						echo "<br>Erro ao cadastrar !!!!!!!! <br>";
					
		}
			header("refresh: 3; index.php?matricula=$matricula"); // volta sozinho so retorna a matricula
			//header("refresh: 3; index.php?matricula=$matricula&nw=$nw"); // volta sozinho manda junto nw  
																		   // tem que descomentar no index
																	// e mudar para pular para o campo2 no body
		
	?>
</body>