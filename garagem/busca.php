<?php
	include_once('../include/connect.php');
    include '../include/function.php';
	
	//Recuperar o valor da palavra
	$placa = $_POST['palavra'];
	
	//Pesquisar no banco de dados nome do curso referente a palavra digitada pelo usuário
	$sqlb = "SELECT * FROM autoriza WHERE placa LIKE '%$placa%'";
	$resultado_placa = mysqli_query($conn, $sqlb);
	
	if(mysqli_num_rows($resultado_placa) <= 0){
		echo "Nenhum placa encontrado...";
	}else{
        echo "<table class=\"table table-sm table-striped table-bordered table-hover\">
                    <thead class=\"thead-light\">
                        <th>Edição</th><th>Início</th><th>Fim</th><th>Autorizador</th><th>Empresa</th><th>Nome</th><th>Placa</th><th>Login</th><th>Data registro</th>
                    </thead>
                    <tbody>";
		while($rows = mysqli_fetch_assoc($resultado_placa)){
			$id = $rows['id_aut'];
			$periodoini = $rows['periodoini'];
			$periodofim = $rows['periodofim'];
			$nomeautoriza = $rows['nomeautoriza'];
			$empresa = $rows['empresa'];
			$nomeutiliza = $rows['nomeutiliza'];
			$placa = $rows['placa'];
			$login = $rows['login'];
			$registro = $rows['registro'];
			echo "<td><a href='formautoriza.php?id=$id&formdirect=update' class='btn btn-warning btn-sm'>Editar</a></td><td>".ordenaData($periodoini)."</td><td>".ordenaData($periodofim)."</td><td>$nomeautoriza</td><td>$empresa</td><td>$nomeutiliza</td><td>$placa</td><td>$login</td><td>$registro</td></tr>";
		}
        echo "</tbody></table>";
	}
    
?>