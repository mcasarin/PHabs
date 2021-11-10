<?php
include '../include/function.php';
include '../include/connect.php';
sessao();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.css">
<script src="../js/jquery-1.12.4.js"></script>
<script src="../js/jquery-ui-1.12.1.js"></script>
<script src="../js/bootstrap.js"></script>

<title>Listar Empresas</title>
</head>
<body>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
$opt = $_POST['opt'];
$local = $_POST['local'];
$ramoatividade = $_POST['ramoatividade'];
?>
<table class="table table-striped" style="font-size: 11px;">
		<tr style="background: lightgrey;">
			<?php if($_SESSION["tipo"] == '0'){
					echo "<td>Editar</td>";
					}
			?>
			<td>Empresa</td><td>CNPJ</td><td>IE</td><td>Contato</td><td>Telefone</td><td>E-mail</td><td>OBS</td></tr>
			<?php
			switch($opt) {
				case 'conj':
					$sqlempresa = "SELECT Empresa,CNPJ,IE,contato,Telefone,email,obs,ID FROM empresas WHERE empresa BETWEEN '00' AND '9999' ORDER BY Empresa + 0 ASC;";
					$sqlempresaexe = $conn->query($sqlempresa);
						while ($row = $sqlempresaexe->fetch_assoc()) {
						$empresa = $row["Empresa"];
						$cnpj = $row["CNPJ"];
						$ie = $row["IE"];
                        $contato = $row["contato"];
                        $telefone = $row["Telefone"];
                        $email = $row["email"];
						$obs = $row["obs"];
						$ID = $row["ID"];
						echo "<tr>";
							if($_SESSION["tipo"] == '0'){ //opção caso chamada seja edição
							echo "<td><a class='btn btn-outline-info btn-sm' href='editarempresa.php?ID=$ID&formdirect=update'> Editar </a></td>";
							}
							echo "<td>$empresa</td><td>$cnpj</td><td>$ie</td><td>$contato</td><td>$telefone</td><td>$email</td><td>$obs</td></tr>";
						}//while end
						$conn->close;
						exit();
				case 'nomeconj':
                    $sqlempresa = "SELECT Empresa,CNPJ,IE,contato,Telefone,email,obs,ID FROM empresas WHERE Empresa NOT IN (select Empresa from empresas where Empresa like 'AUSENTE%') ORDER BY Empresa + 0 ASC;";
                    $sqlempresaexe = $conn->query($sqlempresa);
                    if($sqlempresaexe->num_rows > 0){
                        while ($row = $sqlempresaexe->fetch_array(MYSQLI_ASSOC)){
                        $empresa = $row["Empresa"];
                        $cnpj = $row["CNPJ"];
                        $ie = $row["IE"];
                        $contato = $row["contato"];
                        $telefone = $row["Telefone"];
                        $email = $row["email"];
                        $obs = $row["obs"];
						$ID = $row["ID"];
						echo "<tr>";
							if($_SESSION["tipo"] == '0'){
								echo "<td><a class='btn btn-outline-info btn-sm' href='editarempresa.php?ID=$ID&formdirect=update'> Editar </a></td>";
							}
							echo "<td>$empresa</td><td>$cnpj</td><td>$ie</td><td>$contato</td><td>$telefone</td><td>$email</td><td>$obs</td></tr>";
                        }//while end
                        }//i colspan="2" colspan="2" colspan="2" colspan="2"f en colspan="2"d
                        $conn->close;
                        exit();
				case 'sonome':
				    $sqlempresa = "SELECT Empresa,CNPJ,IE,contato,Telefone,email,obs,ID FROM empresas WHERE empresa like 'AUSENTE -%' ORDER BY Empresa + 0 ASC;";
					$sqlempresaexe = $conn->query($sqlempresa);
					if($sqlempresaexe->num_rows > 0){
						while ($row = $sqlempresaexe->fetch_array(MYSQLI_ASSOC)){
						$empresa = $row["Empresa"];
						$cnpj = $row["CNPJ"];
						$ie = $row["IE"];
                        $contato = $row["contato"];
                        $telefone = $row["Telefone"];
                        $email = $row["email"];
                        $obs = $row["obs"];
						$ID = $row["ID"];
						echo "<tr>";
							if($_SESSION["tipo"] == '0'){
								echo "<td><a class='btn btn-outline-info btn-sm' href='editarempresa.php?ID=$ID&formdirect=update'> Editar </a></td>";
							}
							echo "<td>$empresa</td><td>$cnpj</td><td>$ie</td><td>$contato</td><td>$telefone</td><td>$email</td><td>$obs</td></tr>";
						}//while end
						}//if end
						$conn->close;
						exit();
				case 'ramo':
				    $sqlempresa = "SELECT Empresa,CNPJ,IE,contato,Telefone,email,obs,ID FROM empresas WHERE IE = '".$ramoatividade."' AND empresa BETWEEN '00' AND '9999' ORDER BY Empresa + 0 ASC;";
					$sqlempresaexe = $conn->query($sqlempresa);
					if($sqlempresaexe->num_rows > 0){
						while ($row = $sqlempresaexe->fetch_array(MYSQLI_ASSOC)){
						$empresa = $row["Empresa"];
						$cnpj = $row["CNPJ"];
						$ie = $row["IE"];
                        $contato = $row["contato"];
                        $telefone = $row["Telefone"];
                        $email = $row["email"];
                        $obs = $row["obs"];
						$ID = $row["ID"];
						echo "<tr>";
							if($_SESSION["tipo"] == '0'){
								echo "<td><a class='btn btn-outline-info btn-sm' href='editarempresa.php?ID=$ID&formdirect=update'> Editar </a></td>";
							}
							echo "<td>$empresa</td><td>$cnpj</td><td>$ie</td><td>$contato</td><td>$telefone</td><td>$email</td><td>$obs</td></tr>";
						}//while end
						}//if end
						$conn->close;
						exit();
				default:
					echo "<div class='alert alert-warning'>Houve algum erro!</div>";
					}//switch end
			?>
</table>
</body>
<?php
}//post end
//fim do arquivo
?>