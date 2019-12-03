<?php

require_once("class.relatoriovisitantes.php");

?>
<html>
<head>
</head>
<body>
    <p>Relatórios</p>
    <div>
        <?php
        $mostraRel = new relatoriovisitantes;
        $mostraRelExec = $mostraRel->porData();
        echo $mostraRelExec;
        ?>
    </div>
</body>    
</html>