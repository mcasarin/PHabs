 <meta http-equiv="refresh" content="2"> <!-- reload content define tempo em segundos -->
<?php
    require ("/var/www/html/PHabs/include/connect.php");
	$monitor = $conn->query("SELECT * FROM Monitor");
	while($l = $monitor->fetch_array())
	{
		$id = $l["Id"];
		$menssagem = $l["Menssagem"];
	}
	echo "<table border = '1' width = '100%'>
				<tr>
						<td width = '50%'  border = '1'>$id</td> <td width = '50%'  >$menssagem</td>
				</tr>
		  </table>
		 ";
?>