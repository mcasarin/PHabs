<?php
//Including Database configuration file.
include "connect.php";
//Getting value of "search" variable from "script.js".
if (isset($_POST['search'])) {
//Search box value assigning to $Name variable.
   $search = $_POST['search'];
//Search query.
   $Query = "SELECT Doc,Nome,Matricula,Campo1 FROM visopen WHERE Doc like '%".$search."%' OR Matricula like '%".$search."%' OR Nome like '%".$search."%' limit 3;";
//Query execution
   $ExecQuery = MySQLi_query($conn, $Query);
//Creating unordered list to display result.
   echo '
<ul>
   ';
   //Fetching result from database.
   while ($Result = MySQLi_fetch_array($ExecQuery)) {
       ?>
   <!-- Creating unordered list items.
        Calling javascript function named as "fill" found in "script.js" file.
        By passing fetched result as parameter. -->
   <li onclick='fill("<?php echo $Result['Matricula']; ?>")'>
   <a>
   <!-- Assigning searched result in "Search box" in "search.php" file. -->
       <?php echo $Result['Matricula']; ?>
   </a> - <?php echo $Result['Doc']."; ".$Result['Nome']; ?> </li>
   <!-- Below php code is just for closing parenthesis. Don't be confused. -->
   <?php
  }
}
?>
</ul>