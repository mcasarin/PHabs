<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
include '../include/function.php';
include_once '../include/connect.php';
sessao();

/*
#   
#   Registro recebimento de Correio
#   data: 28set23
#
*/

// Verificar se o usuário está logado
if (!isset($_SESSION['nome'])) {
    die("Você não está logado. Faça login para acessar esta página.");
}

// Verificar se o ID foi passado via GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    die("ID do registro não especificado.");
}

// Consultar o registro a ser atualizado
$query = "SELECT id, nome, conjunto, datainfo, registroar, tipoar, obs, disc, imgpath FROM corr_entrada WHERE id = $id";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("Registro não encontrado.");
}

// Processar o formulário quando enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeEntregador = $_POST["nomeEntregador"];
    $dataTimestamp = strtotime($_POST["data"]);

    // Realizar a atualização no banco de dados
    $updateQuery = "UPDATE corr_entrada SET nomeEntregador = '$nomeEntregador', data = '$dataTimestamp' WHERE id = $id";

    if ($conn->query($updateQuery) === TRUE) {
        echo "Registro atualizado com sucesso!";
    } else {
        echo "Erro na atualização do registro: " . $conn->error;
    }
}

// Fechar a conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <title>Lista Entradas</title>
    <style>
        .wrapper {
            position: relative;
            width: 367px;
            height: 206px;
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        
        .imgcanva {
            position: absolute;
            left: 0;
            top: 0;
        }

        .signature-pad {
            left: 0;
            top: 0;
            width:367px;
            height:206px;
            border: 1px solid #000;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
    <div class="row">
        <h5 style="text-align:center;background-color:#ccffff;">Registro de recebimento</h5>
    </div>
        <form method="POST" enctype="multipart/form-data" name="formrecebe">
            <div class="row">
                <div class="col form-group">
                    <label for="nomeEntregador">Nome do recebedor:</label>
                    <input type="text" class="form-control" name="nomeEntregador" required>
                    
                    <label for="datarecebe">Data:</label>
                    <input type="date" class="form-control" name="datarecebe" id="datarecebe" required>
                </div>
                <div class="col form-group">
                    Assinatura ou foto:
                    <canvas id="signature-pad" class="signature-pad" width="367" height="206"></canvas>
                    <img src="" width="80" height="70" id="imageCheck">
                    <div>
                        <button class="btn btn-outline-success" id="save">Grava</button>
                        <button class="btn btn-outline-danger" id="clear">Limpa</button>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col form-group">
                    <p>ID:
                        <?php echo $row["id"]; ?>
                    </p>
                </div>
                <div class="col form-group">
                    <p>Nome:
                        <?php echo $row["nome"]; ?>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col form-group">
                    <p>Conjunto:
                        <?php echo $row["conjunto"]; ?>
                    </p>
                </div>
                <div class="col form-group">
                    <p>Data:
                        <?php
                        $date1 = date_create($row['datainfo']);
                        echo date_format($date1,"d/m/Y"); ?>
                    </p>
                </div>
                <div class="row">
                    <div class="col form-group">
                        <p>Identificação AR:
                            <?php echo $row["registroar"]; ?>
                        </p>
                    </div>
                    <div class="col form-group">
                        <p>Tipo:
                            <?php echo $row["tipoar"]; ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col form-group">
                        <p>Observação:
                            <?php echo $row["obs"]; ?>
                        </p>
                    </div>
                    <div class="col form-group">
                        <p>Discriminação:
                            <?php echo $row["disc"]; ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col form-group">
                        <p>Imagem: <img src="<?php echo $row["imgpath"]; ?>" width='150' height='60'></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col form-group">
                        <button type="submit" class="btn btn-primary">Registrar recebimento</button>
                    </div>
                    <div class="col form-group">
                        <a href="listaEntrada.php" class="btn btn-warning">Voltar para lista</a>
                    </div>
                </div>
        </form>
    </div>
</body>
<script src="../js/signature_pad-400.min.js"></script>
<script src="../js/jquery-3.6.4.min.js"></script>
<script>
    // https://gist.github.com/omadijaya/37ca44175db5cf647de10745286661ef
        $(function() {
            // init signaturepad
            var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
                    backgroundColor: 'rgba(255, 255, 255, 0)',
            penColor: 'rgb(0, 0, 0)'
            });

            // get image data and put to hidden input field
            function getSignaturePad() {
                var imageData = signaturePad.toDataURL('image/png');
                $('#signature-result').val(imageData)
                $('#imageCheck').attr('src',"data:"+imageData);
            }

            // form action
            $('#formrecebe').submit(function() {
                return true; // set true to submits the form.
            });

            // action on click button clea
            $('#save').click(function(e) {
                e.preventDefault();
                getSignaturePad();
            })

            // action on click button clea
            $('#clear').click(function(e) {
                e.preventDefault();
                signaturePad.clear();
            })
        });
        </script>
</html>