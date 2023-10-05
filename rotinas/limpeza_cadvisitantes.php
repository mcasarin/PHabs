<?php
# Mudança para rodar a rotina pelo Crontab - aspas duplas, caminho absoluto e sessão
include "/var/www/html/PHabs/include/connect.php";

// Checa se rotina chegou ao fim
if( strpos(file_get_contents("/var/log/rotinas/log-rotina_limpaVisitante.log"),"2020encerrada") !== false) {
	echo "=========\n";
    exit;
} else {

	$sqlvis = "select rg,nome,cadastro from visitantes where cadastro like '2020-%' and Telefone != '1' limit 10;";
	$sqlvisexe = $conn->query($sqlvis);
	if($sqlvisexe->num_rows > 0){
		while($rowvis = $sqlvisexe->fetch_array(MYSQLI_ASSOC)){
			$sqlmov = "SELECT rg from movvis where rg='".$rowvis["rg"]."';";
			$sqlmovexe = $conn->query($sqlmov);
			if($sqlmovexe->num_rows > 0){
				echo "!!! Cadastro possui visitas recentes. Não excluído > ".$rowvis["rg"]." - ".$rowvis["nome"]." - ".$rowvis["cadastro"]."\n";
				$sqlupVisita = "UPDATE visitantes set Telefone='1' where rg='".$rowvis["rg"]."';";
				$sqlupVisitaexe = $conn->query($sqlupVisita);
			} else {
				echo ">>> Excluído = ".$rowvis["rg"]." - ".$rowvis["nome"]." - ".$rowvis["cadastro"]."\n";
				$sqlcleanVisitante = "DELETE from visitantes where rg='".$rowvis["rg"]."';";
				$sqlcleanVisitanteexe = $conn->query($sqlcleanVisitante);
			}
		}
		$conn->close();
	} else {
		echo "Rotina no ano 2020encerrada\n";
	}
}