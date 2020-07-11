<?php
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
            } else{
                echo "<div class=\"bg-warning\">Cartão não encontrado ou inválido.</div>";
            }
        } else{
            echo "ERROR: Não foi possível executar a consulta $sql. " . mysqli_error($conn);
        }
    }
     
    // Close statement
    $stmt->close();
}
 
// Close connection
$conn->close();
?>