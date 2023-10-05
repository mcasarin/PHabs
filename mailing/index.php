<?php
// ini_set('error_reporting', E_ALL);
include '../include/function.php';
include '../include/connect.php';
sessao();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Mailing Empresas</title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.18.9/jodit.min.css"> -->
	<link
	rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.18.9/jodit.es2018.min.css" />
	<!-- <link rel="stylesheet" href="css/jodit.css"> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.18.9/jodit.min.js"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.18.9/jodit.es2018.min.js"></script>
	<!-- <script src="js/jodit.js"></script> -->
     <style>
        table, td, div, h1, p {font-family: Arial, sans-serif;}
        table, td {border:none;}
    </style>
</head>
    <body>
    <h1 align="center">Mailing Empresas</h1>
    <?php
    // declare variables
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
            // $sqlcoletaexe = $conn->query($sqlcoleta);
        }
        echo "<h3 align='center'>São ".$total." e-mails cadastrados de proprietários e condôminos.</h3>";
    } else {
        echo "<h3>Falha na coleta de endereços de e-mail.</h3>";
    }
    // verifica processo pendente
    $sqlprocess = "select email,send from mailing";
    $returnProcess = $conn->query($sqlprocess);
    if($returnProcess->num_rows > 0){
        echo "<h3 align='center'>Processo de envio em andamento...</h3>";
        $enviados = 0;
        $pendentes = 0;
        while($count = $returnProcess->fetch_array(MYSQLI_ASSOC)){
            if($count["send"] == '0'){
                $pendentes++;
            } elseif($count["send"] == '1'){
                $enviados++;
            }
        }
        echo "<h3 align='center'><strong>Foram enviados: ".$enviados." e-mails e ainda estão pendentes: ".$pendentes."</strong></h3>";
        
    } else {
        echo "<h3 align='center'>Pronto para novo envio.</h3>";
        ?>
        <form action="jobsend.php" method="POST" name="formmailing">
            <input type="hidden" name="formmailingh" value="valid"
        <p>Insira/Edite a mensagem em HTML na caixa abaixo. Cabeçalho e rodapé são fixos.</p>
        
                    

    <table role="presentation" style="width:700px;text-align: center;">
        <tr>
            <td align="center" style="padding:40px 0 30px 0;background:#f9fafa;">
                <img src="https://edificiochurchill.com.br/images/churchill-melhor-recort-180.png" alt="logo edificio churchill" width="150" style="height:auto;display:block;" />
            </td>
        </tr>
        <tr><td>
            <?php
                // Collect body
                $sql = "SELECT id,html FROM `mailing_add` where id > 0 order by id desc limit 1";
                $sqle = $conn->query($sql);
                if($sqle->num_rows > 0){
                // echo "coletou body";
                $view = $sqle->fetch_assoc();
            ?>
            <!-- TEXT HTML -->
            <textarea name="message" id="message" cols="100" rows="150">
            
            <?php echo $view["html"]; ?>
                    
            </textarea>
            <!-- TEXT HTML -->
            <?php
                } // if body
            ?>
            </td>
        </tr>
        <tr>
            <td style="padding:30px;background:#ee4c50;">
                <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                    <tr>
                        <td style="padding:0;width:50%;" align="right">
                            <p>&copy; Condomínio Edifício Sir Winston Churchill <?php echo date('Y'); ?><br/><a href="http://www.edificiochurchill.com.br">edificiochurchill.com.br</a></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

        
        <br>

        <?php
        echo "<h3 align='center'><input type='submit' name='btnsend' value=' [ Disparar mailing ] '></h3>";
    } // end else pronto para envio
    ?>
    
    </form>
    <script>
	    const editor = Jodit.make('#message');
    </script>
    </body>
</html>