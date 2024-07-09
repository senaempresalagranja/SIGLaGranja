
<?php
$obtenga = $_POST['valor_plaga'];
include 'conexion.php';


$pg= "SELECT   
	 plagaenfermedad.pentipagecau,
       plagaenfermedad.pentipmanejo,
       plagaenfermedad.pentipzaffru,
       plagaenfermedad.pentipzaftal,
       plagaenfermedad.pennomcienti,
       plagaenfermedad.pentipzafflo,
       plagaenfermedad.pentipzafrai,
       plagaenfermedad.pentipzafhoj,
       plagaenfermedad.pentipdano,
       plagaenfermedad.pennomcomun,
       plagaenferme_cultivo.pcudescripci 
        FROM plagaenferme_cultivo
		INNER JOIN cultivo ON cultivo.culid=plagaenferme_cultivo.pcucultivo 
		INNER JOIN plagaenfermedad on plagaenfermedad.penid=plagaenferme_cultivo.pcuplagaenfe 
		WHERE plagaenfermedad.pennomcomun= '$obtenga' limit 1";

 $result = pg_query($con, $pg);

 echo "
 			<table>
 			<tr>		<th>Nombre Daño</th>
 						<th>Tipo de Daño</th> 					 			
 			 			<th>Nombre Cientifico</th>		
 			 			<th> Tipo Agente Casual</th> 	
 			 			<th>Tipo Manejo</th>			
			 			<th>Zona Afectada Fruta</th> 	
 			 			<th>Zona Afectada Tallo</th> 	
 			 			<th>Zona Afectada Flor</th>		
 						<th>Zona Afectada Raiz</th>		
 						<th>Zona Afectada Hoja</th>
 			</tr>";

 				while ($row = pg_fetch_array($result)) {
 					echo "<tr>";
 					echo "<td>" . $row['pennomcomun'] . "</td>";
 					echo "<td>" . $row['pentipdano'] . "</td>";
 					echo "<td>" . $row['pennomcienti'] . "</td>";
 					echo "<td>" . $row['pentipagecau'] . "</td>";
 					echo "<td>" . $row['pentipmanejo'] . "</td>";
 					echo "<td>" . $row['pentipzaffru'] . "</td>";
 					echo "<td>" . $row['pentipzaftal'] . "</td>";
 					echo "<td>" . $row['pentipzafflo'] . "</td>";
 					echo "<td>" . $row['pentipzafrai'] . "</td>";
 					echo "<td>" . $row['pentipzafhoj'] . "</td>";
 					
 					echo "</tr>";

 				}

 				echo "</table>";
 				pg_close($con);

 			

?>

</div>