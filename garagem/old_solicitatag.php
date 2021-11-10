<?php
include '../include/function.php';
include '../include/connect.php';
sessao();
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.css">
<script src="../js/jquery-1.11.3.js"></script>
<script src="../js/bootstrap.js"></script>
<title>Solicita TAG</title>
<style type="text/css">
            label { display: block; margin-top: 10px; }
            label.error { float: none; color: red; margin: 0 .5em 0 0; vertical-align: top; font-size: 14px }
            p { clear: both; }
            .submit { margin-top: 1em; }
            em { font-weight: bold; padding-right: 1em; vertical-align: top; }
        </style>
		<script type="text/javascript">
            $(document).ready( function() {
                $("#solicitatag").validate({
                    // Define as regras
                    rules:{
                        nomesolicita:{
                            // será obrigatorio (required) e terá tamanho minimo (minLength)
                            required: true, minlength: 4
                        },
                        carro:{
                            // carro será obrigatorio (required) e terá tamanho minimo (minLength)
                            required: true, minlength: 3
                        },
						placa:{
                            // placa será obrigatorio (required) e terá tamanho minimo (minLength)
                            required: true, minlength: 6
                        }
                    },
                    // Define as mensagens de erro para cada regra
                    messages:{
                        nomesolicita:{
                            required: "Digite o nome de quem está solicitando a tag",
                            minlength: "O nome deve conter, no mínimo, 4 caracteres"
                        },
                        carro:{
                            required: "Digite o nome do carro, de preferência marca e modelo",
                            minlength: "O nome deve conter, no mínimo, 3 caracteres"
                        },
						placa:{
                            required: "Digite o número da placa do carro",
                            minlength: "A placa deve conter, no mínimo, 6 caracteres"
                        }
                    }
                });
            });
        </script>
</head>

<body>
<div class="row">
<div class="col-lg-8 table-responsive">
<table class="table table-bordered table-hover">
    <tr><td colspan="2" align="center"><h3><b>Solicitação de TAGs</b></h3></td></tr>
        <form method="POST" action="include/salvarsolicita.php" name="solicitatag" id="solicitatag">
        <tr><td>Nome do solicitante: </td><td><input size="80" type="text" id="nomesolicita" name="nomesolicita" maxlength="80" style = "text-transform: uppercase" required /></td></tr>
        <tr><td>Conjunto: </td><td><?php
        // montagem da combobox empresa
            echo "<select name='empresa' id='empresa' required>";
            echo "<option value=''>-- Selecione --</option>";
            // populando o combobox
            $sql3 = "SELECT DISTINCT empresa FROM empresas WHERE empresa BETWEEN '00' AND '9999' ORDER BY empresa + 0 ASC;"; //+0 para ordenar campo
        
           // confirmando sucesso
            $result3 = $conn->query($sql3);
        
           // agrupando resultados
            if($result3->num_rows > 0) {
            // combobox
            
            while ($row = $result3->fetch_array(MYSQLI_ASSOC))
                // while para agrupar todos os itens
                echo "<option value='$row[empresa]'>$row[empresa]</option>";
            }
            echo "</select>";
                // fim da combo<br>
                $conn->close;
        ?>
        </td></tr>
        <tr><td>Carro: </td><td><input size="50" type="text" id="carro" name="carro" maxlength="60" style = "text-transform: uppercase" required /></td></tr>
        <tr><td>Placa: </td><td><input size="15" type="text" id="placa" name="placa" maxlength="7" style = "text-transform: uppercase" required /></td></tr>
		  <br>
        <tr align="center"><td colspan="2"><button class="btn btn-outline-primary btn-lg" name="submit" alt="Clique aqui ou aperte 'Enter'" style="cursor:pointer;">Solicitar</button></td></tr>
        </form>
</table>
</div><!--end table responsive-->
</div><!--end row-->
</body>
</html>