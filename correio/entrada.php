<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
include '../include/function.php';
include_once '../include/connect.php';
sessao();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <script src="../js/fabric.min.js"></script>
    <title>Entrada de encomendas</title>
</head>
<body>
  <?php
  // Declarando variáveis para uso universal
  $dataInfo = "";
  $nome = "";
  $conjunto = "";
  $registroar = "";
  $tipoar = "";
  $obs = "";
  $disc = "";
  $imgentrVoltar = "";

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $dataInfo = $_POST['dataInfo'];
    $nome = $_POST['nome'];
    $conjunto = $_POST['conjunto'];
    $registroar = $_POST['registroar'];
    $tipoar = $_POST['tipoar'];
    $obs = $_POST['obs'];
    $disc = $_POST['disc'];
    $imgentrVoltar = $_POST['imgentrVoltar'];
  }
  ?>
<div class="container-fluid">
  <div class="row">
    <h5 style="text-align:center;background-color:#ccff99;">Cadastro entrada de correspondência</h5>
  </div>
        <form action="saveEntrada.php" method="post" enctype="multipart/form-data">
          <!-- formdirect 1 = entrada -->
          <input type="hidden" name="formdirect" id="formdirect" value="1">
        <div class="row md-3">
            <label for="data" class="col-sm-2 col-form-label col-form-label-sm">Data:</label>
            <div class="col-sm-2 col-md-2">
                <input class="form-control form-control-sm" type="date" name="dataInfo" id="dataInfo" value="<?php if(isset($dataInfo)){ echo $dataInfo;}?>">
            </div>
        </div>
        <div class="row md-3">
            <label for="nome" class="col-sm-2 col-form-label col-form-label-sm">Nome:</label>
            <div class="col-sm-8 col-md-6">
                <input class="form-control form-control-sm" type="text" name="nome" id="nome" value="<?php if(isset($nome)){ echo $nome;}?>">
            </div>
        </div>
        <div class="row md-3">
            <label for="registroar" class="col-sm-2 col-form-label col-form-label-sm">AR:</label>
            <div class="col-sm-6 col-md-4">
                <input class="form-control form-control-sm" type="text" name="registroar" id="registroar" value="<?php if(isset($registroar)){ echo $registroar;}?>">
            </div>
        </div>
        <div class="row md-3">
            <label for="tipoar" class="col-sm-2 col-form-label col-form-label-sm">Tipo:</label>
            <div class="col-sm-6 col-md-4">
              <select class="form-select form-select-sm" name="tipoar" id="tipoar">
                  <option value="<?php if(isset($tipoar)){ echo $tipoar;}?>"><?php if(isset($tipoar)){ echo $tipoar;}?></option>
                  <option value="caixa">Caixa</option>
                  <option value="cartas">Cartas</option>
                  <option value="motoboy">Motoboy</option>
                  <option value="sedex10">Sedex 10</option>
                  <option value="sedex12">Sedex 12</option>
                  <option value="sedexhoje">Sedex Hoje</option>
                  <option value="telegrama">Telegrama</option>
                  <option value="tranportadora">Transportadora</option>
              </select>
            </div>
        </div>
        <div class="row md-3">
            <label for="conjunto" class="col-sm-2 col-form-label col-form-label-sm">Conjunto:</label>
            <div class="col-sm-8 col-md-6">
                <select class="form-select form-select-sm" name="conjunto" id="conjunto">
                  <option value="<?php if(isset($conjunto)){ echo $conjunto;}?>"><?php if(isset($conjunto)){ if($conjunto == 'ni'){echo "Não identificado";}else{echo $conjunto;}}?></option>
                  <option value="ni">Não identificado</option>
                <?php
                // Busca empresas e ordena com números antes de letras
                  $sqlempresas = "select empresa from empresas 
                  where empresa between '00%' and '9999%' 
                  or empresa like 'ausente%' 
                  order by 
                  case 
                    when empresa regexp '^[0-9]' then 1
                    when empresa regexp '^[A-Z]' then 2
                  end
                  , empresa * 1
                  , empresa;";
                  $sqlempresasexe = $conn->query($sqlempresas);
                  if($sqlempresasexe){
                    while($row = $sqlempresasexe->fetch_array(MYSQLI_ASSOC)) {
                      echo "<option value='".$row["empresa"]."'>".$row["empresa"]."</option>";
                    }
                  }
                ?>
                </select>
            </div>
        </div> 
                
        <div class="row md-3">
            <label for="obs" class="col-sm-2 col-form-label col-form-label-sm">Obs:</label>
            <div class="col-sm-8 col-md-6">
                <input class="form-control form-control-sm" type="text" name="obs" id="obs" value="<?php if(isset($obs)){ echo $obs;}?>">
            </div>
        </div>
        <div class="row md-3">
            <label for="disc" class="col-sm-2 col-form-label col-form-label-sm">Discriminação:</label>
            <div class="col-sm-8 col-md-6">
                <textarea class="form-control form-control-sm" type="text" name="disc" id="disc"> <?php if(isset($disc)){ echo $disc;}?> </textarea>
            </div>
        </div>
        <br>
        <div class="d-grid gap-2 d-md-block">
        <div class="row md-3">
            <label for="imgentr" class="col-sm-2 col-form-label col-form-label-sm">Imagem (se houver):</label>
            <div class="col-sm-6 col-md-4">
              <input class="form-control form-control-sm" type="file" name="imgentr" id="imgentr">
                <input type="hidden" name="imagem_data" id="imagem_data" value="">
            </div>
        </div>
        
          <?php
                if(isset($imgentrVoltar) AND $imgentrVoltar != ""){
                  echo "<div class='row md-3'>
                    <div class='col-sm-8'>";
                  echo "<p class='alert alert-info'>Nome do arquivo enviado: ".$imgentrVoltar."</p>";
                  echo "</div>
                  </div>";
                }
                ?>
                <br>
            <button class="btn btn-info btn-sm" type="submit" name="submit"> Cadastrar </button>
            
            <a class="btn btn-warning btn-sm" href="menuEntradas.php">Cancelar</a>
        </div>
    </form>
    <br>
    <div class="row md-3">
        <canvas id="canvas" width="1200" height="800"></canvas>
    </div>
</div>
  
<!-- Script para upload de imagem com zoom e movimentação na tela -->
  <script>
    

    var canvas = new fabric.Canvas('canvas');

    var imgInput = document.getElementById('imgentr');
    
    document.getElementById("imgentr").onchange = function(e) {
      /* ## Script que coleta o nome da imagem inserida no input img
      var url = "https://"+(window.location.hostname)+"/HML/correio/uploads/"+(this.files.item(0).name);
      console.log(url);
      fileExists(url);
      function fileExists(url){
        var request = new XMLHttpRequest;
        request.open('GET', url, true);
        request.send();
        
            if(request.status==200){
              console.log(request.status+" encontrado!");
            } else {
              console.log(request.status+" Não encontrado!");
            }
        
      }*/
   

    var reader = new FileReader();
    reader.onload = function(e) {
    var image = new Image();
    image.src = e.target.result;
      image.onload = function() {
        var img = new fabric.Image(image);
        img.set({
          left: 100,
          top: 100
        });
        img.scaleToWidth(200);
        canvas.add(img).setActiveObject(img).renderAll();
      }
    }
  reader.readAsDataURL(e.target.files[0]);
  }

    canvas.on('mouse:wheel', function(opt) {
      var delta = opt.e.deltaY;
      var zoom = canvas.getZoom();
      zoom *= 0.999 ** delta;
      if (zoom > 20) zoom = 20;
      if (zoom < 0.01) zoom = 0.01;
      canvas.zoomToPoint({ x: opt.e.offsetX, y: opt.e.offsetY }, zoom);
      opt.e.preventDefault();
      opt.e.stopPropagation();
    });

    canvas.on('object:moving', function(opt) {
      var obj = opt.target;
      obj.setCoords();
      var minX = obj.getScaledWidth() / 2;
      var minY = obj.getScaledHeight() / 2;
      var maxX = canvas.width - minX;
      var maxY = canvas.height - minY;
      if (obj.getLeft() < minX) {
        obj.setLeft(minX);
      }
      if (obj.getTop() < minY) {
        obj.setTop(minY);
      }
      if (obj.getLeft() > maxX) {
        obj.setLeft(maxX);
      }
      if (obj.getTop() > maxY) {
        obj.setTop(maxY);
      }
    });

    document.addEventListener('keydown', function(e) {
      var activeObject = canvas.getActiveObject();
      if (activeObject) {
        // seta esquerda
        if (e.key === 'ArrowLeft') {
          activeObject.rotate(activeObject.angle + 90);
          canvas.renderAll();
        // seta direita
        } else if (e.key === 'ArrowRight') {
          activeObject.rotate(activeObject.angle - 90);
          canvas.renderAll();
        }
      }
    });

    var imagemData = canvas.toDataURL();
    document.getElementById('imagem_data').value = imagemData;
      
    </script>
   
</body>
</html>