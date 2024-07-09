<?php
session_start();
if (isset($_SESSION['ADMINISTRADOR'])) 
{
	include 'conexion.php';
	error_reporting(E_ALL ^ E_NOTICE);
	/* Guardar registros en la base de datos postgres */
	$codigo=$_REQUEST['posidcodigo'];
	$posalumbrado=$_REQUEST['posalumbrado']; 
	$posestalumbr=$_REQUEST['posestalumbr']; 
	$postransform=$_REQUEST['postransform']; 
	$posesttransf=$_REQUEST['posesttransf']; 
	date_default_timezone_set("America/Bogota");
	$fecha=date("d-m-Y / H:i:s",time());

	$CodReg=pg_num_rows( pg_query("SELECT * FROM poste WHERE posidcodigo='".strtoupper($codigo)."'"));
	if ($CodReg > 0)
	{
		echo "<script type='text/javascript'>alert('El Codigo del Poste Ya Existe'); location='../frm_poste.php'</script>";
	}
	elseif ($codigo == " ") 
	{
		echo "<script type='text/javascript'>alert('El Codigo del Poste está vacio'); location='../frm_poste.php'</script>";
	}
	elseif ($posalumbrado == "") 
	{
		echo "<script type='text/javascript'>alert('Verifique la Iluminacion, ¡Seleccione una opcion!'); location='../frm_poste.php'</script>";
	}
	elseif ($posestalumbr == "") 
	{
		echo "<script type='text/javascript'>alert('Verifique el Estado de la Iluminacion, ¡Seleccione una opcion Válida!'); location='../frm_poste.php'</script>";
	}
	elseif ($postransform == "")
	{
		echo "<script type='text/javascript'>alert('Verifique el Trasformador, ¡Seleccione una opcion!'); location='../frm_poste.php'</script>";
	}
	elseif ($posesttransf == "") 
	{
		echo "<script type='text/javascript'>alert('Verifique el Estado del Trasformador, ¡Seleccione una opcion Válida!'); location='../frm_poste.php'</script>";
	}
	else
	{
	pg_query("INSERT INTO poste (posidcodigo,posunidad,postipmateri,posestado,posaltura,posunimedi,postiptensio,posalumbrado,posestalumbr,postransform,posesttransf,posruta,poslatitud,posorientlat,poslongitud,posorientlon,posfecha )
		VALUES (
		'$_REQUEST[posidcodigo]',
		'$_REQUEST[posunidad]',
		'$_REQUEST[postipmateri]',
		'$_REQUEST[posestado]',
		'$_REQUEST[posaltura]',
		'$_REQUEST[posunimedi]',
		'$_REQUEST[postiptensio]',
		'$_REQUEST[posalumbrado]',
		'$_REQUEST[posestalumbr]',
		'$_REQUEST[postransform]',
		'$_REQUEST[posesttransf]',
		'$_REQUEST[posruta]',
		'$_REQUEST[coorlatitud]',
		'$_REQUEST[orilatitud]',
		'$_REQUEST[coorlongitud]',
		'$_REQUEST[orilongitud]',
		'$fecha')")
		or die ("Problemas en el select ".mysql_error());
		echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_poste.php'</script>";
		$usuario=($_SESSION['ADMINISTRADOR']);
		$actividad="REGISTRAR POSTE";
		pg_query("INSERT INTO registro_actividad (racusuario,racactividad,racfecha) VALUES ('$usuario','$actividad','$fecha')") 
		or die(pg_result_error());	
	}
}
else
{
  echo "<script type='text/javascript'>alert('Parece que su Sesion ha finalizado, por favor Inicie Sesion');location='../../visitante/index.php?Acceso Denegado'</script>";
}
?>