<?php
session_start();
if (isset($_SESSION['ADMINISTRADOR'])) 
{
	include 'conexion.php';
	/* Guardar registros en la base de datos postgres */
	$codigo=$_REQUEST['canidcodigo'];
	$nombre=$_REQUEST['cannombre'];
	date_default_timezone_set("America/Bogota");
	$fecha=date("d-m-Y / H:i:s",time());

	$CodReg=pg_num_rows( pg_query("SELECT * FROM canal WHERE canidcodigo='".strtoupper($codigo)."'"));
	$NomReg=pg_num_rows( pg_query("SELECT * FROM canal WHERE cannombre='".strtoupper($nombre)."'"));

	if ($CodReg > 0) 
	{
		echo "<script type='text/javascript'>alert('El Codigo de la canal Ya Existe'); 
		location='../frm_canal.php'</script>";
	}
	else
	{
		if ($NomReg > 0) 
		{
			echo "<script type='text/javascript'>alert('El Nombre de la canal Ya Existe'); 
			location='../frm_canal.php'</script>";
		}
		else
		{
			if ($nombre == " ") 
			{
				echo "<script type='text/javascript'>alert('El Nombre de canal esta vacio'); 
				location='../frm_canal.php'</script>";
			}
			else
			{
				pg_query("INSERT INTO canal (canidcodigo,cannombre,canclase,canuso,cantipo,canprofundid,canunimedpro,canancho,canunimedanc,canpendiente,canunimedpen,candistancia,canunimedist,canlatitudi,canorienlati,canlongitudi,canorienloni,canlatitudf,canorienlatf,canlongitudf,canorienlonf,canfecha) 

					VALUES (
					'$_REQUEST[canidcodigo]',
					'$_REQUEST[cannombre]',
					'$_REQUEST[canclase]',
					'$_REQUEST[canuso]',
					'$_REQUEST[cantipo]',
					'$_REQUEST[canprofundid]',
					'$_REQUEST[canunimedpro]',
					'$_REQUEST[canancho]',
					'$_REQUEST[canunimedanc]',
					'$_REQUEST[canpendiente]',
					'$_REQUEST[canunimedpen]',
					'$_REQUEST[candistancia]',
					'$_REQUEST[canunimedist]',					
					'$_REQUEST[coorlatitud]',
					'$_REQUEST[orilatitud]',
					'$_REQUEST[coorlongitud]',
					'$_REQUEST[orilongitud]',
					'$_REQUEST[coorlatitudf]',
					'$_REQUEST[orilatitudf]',
					'$_REQUEST[coorlongitudf]',
					'$_REQUEST[orilongitudf]',
					'$fecha')")
				or die ("Problemas en el select ".pg_last_error());
				echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_canal.php'</script>";
				$usuario=($_SESSION['ADMINISTRADOR']);
				$actividad="REGISTRAR CANAL";
				pg_query("INSERT INTO registro_actividad (racusuario,racactividad,racfecha) VALUES (
					'$usuario',
					'$actividad',
					'$fecha')") or die(pg_result_error());
			}
		}
	}
}
else
{
	echo "<script type='text/javascript'>alert('Parece que su Sesion ha finalizado, por favor Inicie Sesion');location='../../visitante/index.php?Acceso Denegado'</script>";
}			
?>