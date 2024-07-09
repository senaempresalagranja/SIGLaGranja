<?php
session_start();
if (isset($_SESSION['ADMINISTRADOR'])) 
{
	/*Llmado a la conexion de la BD.*/
	 include 'conexion.php';

	 	$fecha=date("d-m-Y / H:i:s",time()-25200);/*fecha del sistema*/

	 	$contraseña=md5($_REQUEST["usupassword"]);
	 	$password=md5($contraseña);

	 	pg_query("INSERT INTO usuario (usunombre, usuapellidos, ususexo, usuemail, usutelefono, usuusuario, usupassword, usurol, usufecha)
					    	VALUES ( 	'$_REQUEST[usunombre]',
					    				'$_REQUEST[usuapellidos]',
					    				'$_REQUEST[ususexo]',
					    				'$_REQUEST[usucorreo]',
					    				'$_REQUEST[usutelefono]',
					    				'$_REQUEST[usuusuario]',
					    				'$password',
					    				'$_REQUEST[usurol]',
					    				'$fecha')")
	              or die ("Problemas en el select ".pg_last_error());
		        echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_usuario.php'</script>";
		        $usuario=($_SESSION['ADMINISTRADOR']);
				$actividad="REGISTRAR USUARIO";
				pg_query("INSERT INTO registro_actividad (racusuario,racactividad,racfecha) VALUES ('$usuario','$actividad','$fecha')") or die(pg_result_error());
}
else
{
	echo "<script type='text/javascript'>alert('Parece que su Sesion ha finalizado, por favor Inicie Sesion');location='../../visitante/index.php?Acceso Denegado'</script>";
}
?>