<?php
session_start();
/*Lammado a la conexion de la BD*/
 include 'conexion.php';
 $fecha=date("d-m-Y / H:i:s",time()-25200);

 if (isset($_SESSION['ADMINISTRADOR']))
 {
 	$passwordactual=md5(md5($_REQUEST["usupasswordactual"]));
 	if ($passwordactual == "103aec1a3c64696774e9e972b298607e") 
 	{
 			$passwordnueva=md5(md5($_REQUEST["usupassword"]));
			$actualizar=pg_query($con, "UPDATE usuario SET 
 											usunombre='$_REQUEST[usunombre]',
 											usuapellidos='$_REQUEST[usuapellidos]',
 											ususexo='$_REQUEST[ususexo]',
 											usuemail='$_REQUEST[usucorreo]',
 											usutelefono='$_REQUEST[usutelefono]',
 											usuusuario='$_REQUEST[usuusuario]',
 											usupassword='$passwordnueva',
 											usurol='$_REQUEST[usurol]',
 											usufecha='$fecha' 
 											WHERE usuid='$_REQUEST[idusuario]' ");
			echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_usuario.php'</script>";
 	}
 	else
 	{
 		$idusuario=$_REQUEST["idusuario"];
	 	$passwordactual=md5(md5($_REQUEST["usupasswordactual"]));
	 	$consulta="SELECT * FROM usuario where usuid=$idusuario AND usupassword='$passwordactual' ";
		$results=pg_query($consulta)or die('ok');
		if(pg_num_rows(@$results) > 0) 
			{
				$passwordnueva=md5(md5($_REQUEST["usupassword"]));
				$actualizar=pg_query($con, "UPDATE usuario SET 
	 											usunombre='$_REQUEST[usunombre]',
	 											usuapellidos='$_REQUEST[usuapellidos]',
	 											ususexo='$_REQUEST[ususexo]',
	 											usuemail='$_REQUEST[usucorreo]',
	 											usutelefono='$_REQUEST[usutelefono]',
	 											usuusuario='$_REQUEST[usuusuario]',
	 											usupassword='$passwordnueva',
	 											usurol='$_REQUEST[usurol]',
	 											usufecha='$fecha' 
	 											WHERE usuid='$_REQUEST[idusuario]' ");
					echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_usuario.php'</script>";
			}
		else
		{
			echo "<script type='text/javascript'>alert('Error en las Contraseña');location='../frm_usuario.php'</script>";
		}
 	}
 }
 else
 {
 	$idusuario=$_REQUEST["idusuario"];
 	$passwordactual=md5(md5($_REQUEST["usupasswordactual"]));
 	$consulta="SELECT * FROM usuario where usuid=$idusuario AND usupassword='$passwordactual' ";
	$results=pg_query($consulta)or die('ok');
	if(pg_num_rows(@$results) > 0) 
		{
			$passwordnueva=md5(md5($_REQUEST["usupassword"]));
			$actualizar=pg_query($con, "UPDATE usuario SET 
 											usunombre='$_REQUEST[usunombre]',
 											usuapellidos='$_REQUEST[usuapellidos]',
 											ususexo='$_REQUEST[ususexo]',
 											usuemail='$_REQUEST[usucorreo]',
 											usutelefono='$_REQUEST[usutelefono]',
 											usuusuario='$_REQUEST[usuusuario]',
 											usupassword='$passwordnueva',
 											usurol='$_REQUEST[usurol]',
 											usufecha='$fecha' 
 											WHERE usuid='$_REQUEST[idusuario]' ");
			echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_usuario.php'</script>";
		}
	else
		{
			echo "<script type='text/javascript'>alert('Error en las Contraseña');location='../frm_usuario.php'</script>";
		}

 }
?>