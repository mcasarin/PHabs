<?php
include '../include/connect.php';
sessao();
if($_SERVER['REQUEST_METHOD'] == "GET") {
$empresa = $_get['empresa'];

	isset($empresa){
		$sql = "SELECT nome,id FROM usuarios WHERE empresa='".$empresa."';";
		$resultsql = $conn->query($sql);
		echo "<select name=\"usuario\" id=\"usuario\" required>";
		echo "<option value=\"todos\"> Todos </option>";
		if($resultsql->num_rows > 0) {
			while ($row = $resultsql->fetch_array(MYSQLI_ASSOC)){
				echo "<option value=\"$row[nome]\"> $row[nome] </option>";
			}//end while
			echo "</select>";
		} //end if resultsql
	} //fim isset
} //fim GET

?>