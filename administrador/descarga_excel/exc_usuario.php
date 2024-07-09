<?php
//insertamos los headers que van a generar el archivo excel
header('Content-type: application/vnd.ms-excel');
//en filename vamos a colocar el nombre con el que el archivo xls sera generado
header("Content-Disposition: attachment; filename=Excel_Usuario.xls");
//extenciones
header("Pragma: no-cache");
//nose parar que es
header("Expires: 0");
//Definir la conexion a la base de dato//
include "../conexion.php";
//nos conectamos a la tabla a mostrar
$res=pg_query($con, "SELECT * FROM usuario");
?>
<!--capturamos la fecha del sistema -->
<?php
	$fecha=date("d/m/y",time()-25200);
?>
<!--Diseño del excel-->
<!DOCTYPE html">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--llamado al head-->
	<?php
		include '../include/headerform.php';
	?>
	<body>
<!--creamos la tabla a mostrar en excel-->
		<center>
			<table width="1000" border="0">
				<tr>
					<th width="1000" colspan="8">
						<div style="color:#0000ff; text-shadow:#666;"><font size="+2">SISTEMA DE INFORMACION GEOREFERENCIADO "SIGLaGranja" | TABLA: USUARIOS </font></div></th>
					<th colspan="2">
						<div style="color:#0000ff; text-shadow:#666;"><font size="+2">FECHA: <?php echo $fecha ?> </font></div>
					</th>
				</tr>
			</table>
<!-- cabesera de los campos-->
			<table width="650" border="1"> 
				<tr>
					<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CODIGO</strong></th>
					<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>NOMBRE</strong></th>
					<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>APELLIDOS</strong></th>
					<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>SEXO</strong></th>
					<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CORREO</strong></th>
					<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>TELEFONO</strong></th>
					<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>ROL</strong></th>
					<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>USUARIO</strong></th>
					<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>CONTRASEÑA</strong></th>
					<th width="50%" style="background-color:#0000ff; text-align:center; color:#FFF"><strong>FECHA REGISTRO</strong></th>
				</tr>
<!--crear los campos con el metodo while para imprimir los registros-->
				<?php
					while($reg=pg_fetch_array($res))
					{
//se captura los registros a mostrar
						$id=$reg[0];
						$nombre=$reg[1];
						$apellidos=$reg[2];
						$sexo=$reg[3];
						$correo=$reg[4];
						$telefono=$reg[5];
						$rol=$reg[8];
						$usuario=$reg[6];
						$contraseña=$reg[7];
						$fecha=$reg[9];
						echo "
							<tr>
								<td bgcolor=\"#fff\" align=\"center\">$id</td>
								<td bgcolor=\"#fff\" align=\"left\">$nombre</td>
								<td bgcolor=\"#fff\" align=\"left\">$apellidos</td>
								<td bgcolor=\"#fff\" align=\"left\">$sexo</td>
								<td bgcolor=\"#fff\" align=\"left\">$correo</td>
								<td bgcolor=\"#fff\" align=\"left\">$telefono</td>
								<td bgcolor=\"#fff\" align=\"left\">$rol</td>
								<td bgcolor=\"#fff\" align=\"left\">$usuario</td>
								<td bgcolor=\"#fff\" align=\"center\">$contraseña</td>
								<td bgcolor=\"#fff\" align=\"left\">$fecha</td>
							</tr>
						";
					}
				?>
			</table>
		</center>
	</body>
</html>