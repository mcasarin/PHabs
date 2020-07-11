<?php
require_once("class.conexao.php");

class relatoriovisitantes {

    public function porData(){
        $connect = new Conexao;
        $conectado = $connect->conectar();
        $resultData = $conectado->query("SELECT Visitante,RG,Empresa,DataAcesso FROM movvis WHERE DataAcesso='2018-08-03'");
            while($row = $resultData->fetch_array(MYSQLI_ASSOC)){
                printf ("%s (%s)\n", $row['Visitante'], $row['RG'], $row['Empresa'], $row['DataAcesso']);
            }
        //echo "função";
        $resultData->close();
            
    }

}