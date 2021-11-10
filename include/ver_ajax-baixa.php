<?php
//fonte: https://www.cloudways.com/blog/live-search-php-mysql-ajax/
include "function.php";
include "connect.php";

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.css">
<script src="../js/bootstrap.js"></script>
</head>
<?php
//Getting value of "search" variable from "script.js".
if (isset($_POST['search'])) {
	//Search box value assigning to $Name variable.
		 $search = $_POST['search'];
	//Search query.
		 $Query = "SELECT Doc,Nome,Matricula,Campo1 FROM visopen WHERE Doc like '%".$search."%' OR Matricula like '%".$search."%' OR Nome like '%".$search."%' limit 3;";
	//Query execution
		 $ExecQuery = MySQLi_query($conn, $Query);
	//Creating unordered list to display result.
/*		 echo '
	<ul>
		 ';*/
		 //Fetching result from database.
		 while ($Result = MySQLi_fetch_array($ExecQuery)) {
			$matricula = $Result['Matricula'];
			$rg = $Result['Doc'];
				 ?>
		 <!-- Creating unordered list items.
					Calling javascript function named as "fill" found in "script.js" file.
					By passing fetched result as parameter. -->
		 <span onclick='fill("<?php echo $matricula; ?>")'>
		 <a class="badge badge-warning" href="include/execbaixa.php?matricula=<?php echo $matricula; ?>&rg=<?php echo $rg; ?>&opt=live">
		 <!-- Assigning searched result in "Search box" in "search.php" file. -->
				 <?php echo $matricula; ?>
		 </a> - <b>RG:</b> <?php echo $rg."; <b>Nome:</b> ".$Result['Nome']."; <b>Status:</b> ".$Result['Campo1']."<br />";

		 ?>
		 </span>
		 <!-- Below php code is just for closing parenthesis. Don't be confused. -->
		 <?php
		} // end while
	}
?>
<!--	</ul> -->
</body>
</html>