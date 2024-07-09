<?php
session_start();
include 'conexion.php';
/* Guardar registros en la base de datos postgres */
$nombre=$_REQUEST['pfonombre']; 
$imasin=$_REQUEST['pfoimagen'];
date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y / H:i:s",time());

if ($nombre == " ") 
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
					$actualizar=pg_query($con, "UPDATE programaformacion SET 
					pfoarea='$_REQUEST[pfoarea]', 
					pfonombre='$_REQUEST[pfonombre]', 
					pfotipformac='$_REQUEST[pfotipformac]', 
					pfotieelecti='$_REQUEST[pfotieelecti]', 
					pfounimedel='$_REQUEST[pfounimedel]', 
					pfotieproduc='$_REQUEST[pfotieproduc]', 
					pfounimedep='$_REQUEST[pfounimedep]', 
					pfodescripci='$_REQUEST[pfodescripci]', 
					profecha='$fecha', 
					pfoimagen='$imagen' WHERE pfoid='$_REQUEST[pfoid]'");

					echo "<script type='text/javascript'>alert('Registro Actualizado');
					location='../frm_programaformacion.php'</script>";
				}
			}
		}
		else
		{
			$actualizar=pg_query($con, "UPDATE programaformacion SET 
			pfoarea='$_REQUEST[pfoarea]', 
			pfonombre='$_REQUEST[pfonombre]', 
			pfotipformac='$_REQUEST[pfotipformac]', 
			pfotieelecti='$_REQUEST[pfotieelecti]', 
			pfounimedel='$_REQUEST[pfounimedel]', 
			pfotieproduc='$_REQUEST[pfotieproduc]', 
			pfounimedep='$_REQUEST[pfounimedep]', 
			pfodescripci='$_REQUEST[pfodescripci]', 
			profecha='$fecha', 
			pfoimagen='$imasin' WHERE pfoid='$_REQUEST[pfoid]'");

			echo "<script type='text/javascript'>alert('Registro Actualizado');
			location='../frm_programaformacion.php'</script>";
		}
	}
}
?>