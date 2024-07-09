<?php
session_start();
if (isset($_SESSION['USUARIO ADMIN'])) 
{
	include 'conexion.php';
	/* Guardar registros en la base de datos postgres */
	$nombre=$_REQUEST['pfonombre']; 
	date_default_timezone_set("America/Bogota");
	$fecha=date("d-m-Y / H:i:s",time());

	$NomReg=pg_num_rows( pg_query("SELECT * FROM programaformacion WHERE pfonombre='".strtoupper($nombre)."'"));

	if ($NomReg > 0)
	{
		echo "<script type='text/javascript'>alert('El Nombre del Programa de Formación Ya Existe');location='../frm_programaformacion.php'</script>";
	}
	elseif ($nombre == " ") 
	{
		echo "<script type='text/javascript'>alert('El Nombre del Programa de Formación está vacio');location='../frm_programaformacion.php'</script>";
	}
	else
	{
		if(!isset($_REQUEST['pfoarea']) &&  !isset($_REQUEST['pfonombre']) && !isset($_REQUEST['pfotipformac']) 
			&& !isset($_REQUEST['pfotieelecti']) && !isset($_REQUEST['pfounimedel']) && !isset($_REQUEST['pfotieproduc']) && !isset($_REQUEST['pfounimedep']) && !isset($_REQUEST['pfodescripci']) )
		{
			echo "<script type='text/javascript'>alert('¡¡Error al enviar los datos!!, Por Favor verifique los campos y asegúrese que estan completos');location='../frm_programaformacion.php'</script>";
		}
		else
		{
			$allowedExts = array("gif", "jpeg", "jpg", "png");
			$temp = explode(".", $_FILES["file"]["name"]);
			$extension = end($temp);
			$imagen="";
			$random=rand(1,999);
			if ((($_FILES["file"]["type"] == "image/gif")
				|| ($_FILES["file"]["type"] == "image/jpeg")
				|| ($_FILES["file"]["type"] == "image/jpg")
				|| ($_FILES["file"]["type"] == "image/pjpeg")
				|| ($_FILES["file"]["type"] == "image/x-png")
				|| ($_FILES["file"]["type"] == "image/png")))
			{
					//Verificamos que sea una imagen
				if ($_FILES["file"]["error"] > 0)
				{
				  		//verificamos que venga algo en el input file
					echo "Error numero: ".$_FILES["file"]["error"] . "<br>";
				}
				else
				{
			    	//subimos la imagen
					$imagen= $random.'_'.$_FILES["file"]["name"];
					if(file_exists("../galeria/".$random.'_'.$_FILES["file"]["name"]))
					{
						echo "<script type='text/javascript'>alert('La imagen Ya Existe, por favor verifique la imagen');location='../frm_programaformacion.php'</script>";
					}
					else
					{
						move_uploaded_file($_FILES["file"]["tmp_name"],
							"../galeria/repeat/".$random.'_'.$_FILES["file"]["name"]);

						pg_query($con, "INSERT INTO programaformacion (profecha, pfounimedep, pfotieproduc, pfounimedel, pfoarea, pfotipformac, pfonombre, pfoimagen, pfodescripci, pfotieelecti) 
							VALUES (
							'$fecha', 
							'$_REQUEST[pfounimedep]', 
							'$_REQUEST[pfotieproduc]', 
							'$_REQUEST[pfounimedel]', 
							'$_REQUEST[pfoarea]',
							'$_REQUEST[pfotipformac]',
							'$_REQUEST[pfonombre]',
							'$imagen',
							'$_REQUEST[pfodescripci]',
							'$_REQUEST[pfotieelecti]')") 

						or die ("problemas en el insert".pg_last_error());
						echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_programaformacion.php'</script>";

						$usuario=($_SESSION['USUARIO ADMIN']);
						$actividad="REGISTRAR PROGRAMA FORMACION";
						pg_query("INSERT INTO registro_actividad (racusuario,racactividad,racfecha) VALUES (
						'$usuario',
						'$actividad',
						'$fecha')") or die(pg_result_error());	
					}
				}
			}
			else
			{
				echo "<script type='text/javascript'>alert('Error debe Seleccionar una Imagen');location='../frm_programaformacion.php'</script>";
			}
		}
	}
}
else
{
	echo "<script type='text/javascript'>alert('Parece que su Sesion ha finalizado, por favor Inicie Sesion');location='../../visitante/index.php?Acceso Denegado'</script>";
}
?>
