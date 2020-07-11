<?php
<<<<<<< HEAD
include "connect.php";

// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . $conn->connect_error);
}

if(isset($_REQUEST["term"])){
    // Prepare a select statement 
    $sql = "SELECT sequencia FROM cartoes WHERE Uso='NAO' AND Tipo='V' AND sequencia = ?";
    
    if($stmt = $conn->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("s", $param_term);
        
        // Set parameters
        $param_term = $_REQUEST["term"] . '%';
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            $result = $stmt->get_result();
            
            // Check number of rows in the result set
            if($result->num_rows > 0){
                // Fetch result rows as an associative array
                while($row = $result->fetch_array(MYSQLI_ASSOC)){
                    echo "<input type=\"submit\" value=\" Cadastrar \" name=\"submit\" id=\"submit\" class=\"btn btn-success btn-block\" size=\"40\" onclick=\"envio();\" tabindex=\"7\">";
                }
            } else {
                echo "<div class=\"bg-warning\">Cartão não encontrado ou inválido.</div>";
            }
        } else {
            echo "ERROR: Não foi possível executar a consulta $sql. " . mysqli_error($conn);
        }
    }
     
    // Close statement
    $stmt->close();
}
 
// Close connection
$conn->close();
=======
//fonte: https://www.webslesson.info/2016/03/ajax-live-data-search-using-jquery-php-mysql.html
include "function.php";
include "connect.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</head>
<?php
//header('Content-Type: text/html; charset=iso-8859-1');
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["query"]);

 $query = "SELECT sequencia FROM cartoes WHERE Uso='NAO' AND Tipo='V' AND sequencia = '".$search."'";
}
/*else
{
 $query = "
  SELECT * FROM tbl_customer ORDER BY CustomerID
 ";
}*/
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) == 1) {
 $output .= '<input type="submit" value=" Cadastrar " name="submit" id="submit" class="btn btn-success btn-block" size="40" onclick="envio();" tabindex="7">';
 /*while($row = mysqli_fetch_array($result))
 {
  $output .= '
   <tr>
    <td>'.$row["sequencia"].'</td>
   </tr>
  ';
 }*/
 echo $output;
} else {
 echo $output .= '<div class="bg-warning">Cartão não encontrado ou inválido.</div>';
}
>>>>>>> daf2cd98c9680322351e26e75b575be1ae1b475f
?>