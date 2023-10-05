<?php
include '../include/connect.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // echo $_POST["formmailingh"];
    if($_POST["formmailingh"] == "valid"){
        $message = $_POST["message"];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Mailing</title>
</head>
    <body>
        <?php
        
        // insere carta no banco
        $sqlinsertadd = "insert into mailing_add (html,status) values ('".$message."','0');";
        // echo $sqlinsertadd."<br>";
        $sqlinsertaddexe = $conn->query($sqlinsertadd);
		
		if($sqlinsertaddexe){
			echo "Trabalho inserido na fila de envios.<br>Abaixo uma amostra do que será enviado.<br><br><a href='index.php'> <<< Voltar para ver status <<< </a><br><br><br><hr>";
			// coleta emails
			$users = array();
			$sqlusers = "select email from empresas where empresa not like '%vago' and empresa not like 'AUSENTE %' and email != '';";
			$returnSql = $conn->query($sqlusers);
			$total = 0;
			// coleta email
			if($returnSql->num_rows > 0){
				while($user = $returnSql->fetch_array(MYSQLI_ASSOC)){
					$users[$total] = $user["email"];
					$total++;
				} // end while users
				for($x = 0; $x < $total; $x++){
					// echo $x." - ".$users[$x]."<br>";
					$sqlcoleta = "insert into mailing (email) values ('".$users[$x]."');";
					// echo $sqlcoleta."<br>";
					$sqlcoletaexe = $conn->query($sqlcoleta);
				}
			}
		} else {
			echo "Problema na gravação da carta no banco de dados!";
			
		}
        ?>
        <!-- Cabeçalho email -->
        <table role="presentation" style="width:700px;text-align: center;">
        <tr>
            <td align="center" style="padding:40px 0 30px 0;background:#f9fafa;">
                <img src="https://edificiochurchill.com.br/images/churchill-melhor-recort-180.png" alt="logo edificio churchill" width="150" style="height:auto;display:block;" />
            </td>
        </tr>
        <tr><td>
        <!-- end Cabeçalho email -->

        <?php echo $message;?>

        <!-- Rodapé email -->
        </td>
        </tr>
        <tr>
            <td style="padding:30px;background:#ee4c50;">
                <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                    <tr>
                        <td style="padding:0;width:50%;" align="right">
                            <p>&copy; Condomínio Edifício Sir Winston Churchill 2022<br/><a href="http://www.edificiochurchill.com.br">edificiochurchill.com.br</a></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!-- end Rodapé email -->
    <hr>
    <p><a href='index.php'><<< Voltar para ver status</a></p>
    </body>
</html>
<?php
    } // end if formmailing
} else { // end if post
echo "Algo deu errado...<br><a href='index.php'><<< Voltar</a>";
}