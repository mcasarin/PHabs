<?php 
/*<!DOCTYPE html>
<html>
<!-- Fonte: https://www.cloudways.com/blog/live-search-php-mysql-ajax/ -->
<head>
   <title>Live Search using AJAX</title>
 
   <!-- Including jQuery is required. -->
 
   <script src="../js/jquery-1.11.3.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
 
   <!-- Including our scripting file. -->
 
   <script type="text/javascript" src="script.js"></script>
 
   <!-- Including CSS file. -->
 
   <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
 
<!-- Search box. -->
 <form action="get">
   <input type="text" id="search" placeholder="Busca cartão... " autocomplete="off">
 
   <br>
   <br>
 
   <!-- Suggestions will be displayed in below div. -->
 
   <div id="display"></div>
 <input type="submit" value="submit">
 </form>
</body>
</html>*/
?>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Webslesson Tutorial</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../js/jquery-1.11.3.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
 </head>
 <body>
  <div class="container">
   <br />
   <div class="form-group">
    <div class="input-group">
     <span class="input-group-addon">Cartão </span>
     <input type="text" name="search_text" id="search_text" placeholder="Busca cartão para cadastro" class="form-control" />
    </div>
   </div>
   <br />
   <div id="result"></div>
  </div>
 </body>
</html>


<script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"ajax.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }
 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});
</script>