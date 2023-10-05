<?php
error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);
include "/var/www/html/PHabs/include/connect.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require "PHPMailer/src/Exception.php";
require "PHPMailer/src/PHPMailer.php";
require "PHPMailer/src/SMTP.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="Keywords" content="Condomínio Edifício Winston Churchill Mailing Etwas Informática">
    <meta name="Description" content="Você está recebendo este e-mail por estar cadastrado no site do Condomínio Edifício Sir Winston Churchill. Etwas Informática">
</head>
    <body>
    <?php
    // Collect mails
    $users = array();
    $count = "0";
    $id_add = "0";
    $sqlusers = "SELECT id,email from mailing where send='0'";
    $sqlusersexe = $conn->query($sqlusers);
	if($sqlusersexe->num_rows == 0){
        $emptyjob = "TRUNCATE table ybd53_mailing;";
        $emptyjobexe = $conn->query($emptyjob);
    }
    while($usermail = $sqlusersexe->fetch_array(MYSQLI_ASSOC)){
    // echo "while coletou remetentes";
    // Collect body
    $sql = "select id,html from mailing_add where status='0'";
    $sqle = $conn->query($sql);
    if($sqle->num_rows > 0){
        // echo "coletou body";
        $view = $sqle->fetch_assoc();
        $id_add = $view["id"];
        // PHPMailer
        $base_url = "edificiochurchill.com.br";
        $mail_body ="
        <table role=\"presentation\" style=\"width:700px;text-align: center;\">
        <tr>
            <td align=\"center\" style=\"padding:40px 0 30px 0;background:#f9fafa;\">
                <img src=\"https://edificiochurchill.com.br/images/churchill-melhor-recort-180.png\" alt=\"logo edificio churchill\" width=\"150\" style=\"height:auto;display:block;\">
            </td>
        </tr>
        <tr><td>";
        $mail_body .= $view["html"];
        $mail_body .="</td>
        </tr>
        <tr>
            <td style=\"padding:30px;background:#ee4c50;\">
                <table role=\"presentation\" style=\"width:100%;border-collapse:collapse;border:0;border-spacing:0;\">
                    <tr>
                        <td style=\"padding:0;width:50%;\" align=\"right\">
                            <p>&copy; Condomínio Edifício Sir Winston Churchill 2022<br/><a href=\"http://www.edificiochurchill.com.br\">edificiochurchill.com.br</a></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        </table>";
        // echo $mail_body."<br>";
        $mail = new PHPMailer;
        $mail->setLanguage('pt-br','PHPMailer/language/');
        $mail->IsSMTP(); //Sets Mailer to send message using SMTP
        $mail->Host = 'mail.edificiochurchill.com.br';  //Sets the SMTP hosts of your Email hosting, this for Godaddy
        $mail->Port = '465';        //Sets the default SMTP server port
        $mail->SMTPAuth = true;       //Sets SMTP authentication. Utilizes the Username and Password variables
        $mail->Username = 'naoresponder@edificiochurchill.com.br';     //Sets SMTP username
        $mail->Password = 'N@pol3ao01';     //Sets SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->setFrom('naoresponder@edificiochurchill.com.br','Cond Ed Sir Winston Churchill');   //Sets the From email address for the message
        $mail->AddAddress($usermail['email']);  //Adds a "To" address   
        $mail->IsHTML(true);       //Sets message type to HTML    
        $mail->Subject = 'Cond. Ed. Sir Winston Churchill';   //Sets the Subject of the message
        $mail->Body = $mail_body;       //An HTML or plain text message body
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        if($mail->send()){
          // send ok, update sender
          $sqlupdate = "update mailing set send='1' where id=".$usermail['id'].";";
          $sqlupdateexe = $conn->query($sqlupdate);
          
        } else {
          echo "Não foi enviado e-mail para: ".$usermail['email'];
        }
        // PHPMailer*/
        $count++;

        if($count == "10"){
            echo "break<br>";
            $sqlsaldo = "select count(id) as saldo from mailing where send='0'";
            $sqlsaldoexe = $conn->query($sqlsaldo);
            $saldo = $sqlsaldoexe->fetch_assoc();
            echo "Saldo: ".$saldo["saldo"];
            if($saldo["saldo"] == '0'){
                $sqlupdateadd = "update mailing_add set status='1' where id='".$id_add."';";
                $sqlupdateaddexe = $conn->query($sqlupdateadd);
                $emptyjob = "TRUNCATE table mailing;";
                $emptyjobexe = $conn->query($emptyjob);
            }
            break;
        }
    } // end if status
    } // end while email
    ?>
    </body>
    </html>