<?php
include 'conexion.php';
/* Actualizar registros en la base de datos postgres */
$act_codigo=$_REQUEST['areidcodigo'];
$act_nombre=$_REQUEST['arenombre'];
date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y / H:i:s",time());
	//$act_codigo2=$_REQUEST['areidcodigoant'];	
	/*echo "$act_codigo codigoActual<br>";
	echo "$act_codigo2 codigoAnterior";*/
	$CodAct=pg_num_rows( pg_query("SELECT * FROM area WHERE areidcodigo='".strtoupper($act_codigo)."'"));
	$NomAct=pg_num_rows( pg_query("SELECT * FROM area WHERE arenombre='".strtoupper($act_nombre)."'"));

	if ($act_nombre == " ") 
	{
		echo "<script type='text/javascript'>alert('El Nombre del Area esta Vacio');
		location='../frm_area.php'</script>";
	}
	elseif ($act_codigo == " ")
	{
		echo "<script type='text/javascript'>alert('El Codigo del Area esta Vacio');
		location='../frm_area.php'</script>";
	}
	else
	{
		pg_query("UPDATE area SET 
			areidcodigo='$_REQUEST[areidcodigo]',
			arenombre='$_REQUEST[arenombre]',
			areextension='$_REQUEST[areextension]',
			areunimedida='$_REQUEST[areunimedida]',
			arecoordinad='$_REQUEST[arecoordinad]',
			arelatitud='$_REQUEST[coorlatitud]',
			areorientlat='$_REQUEST[orilatitud]',
			arelongitud='$_REQUEST[coorlongitud]',
			areorientlon='$_REQUEST[orilongitud]', 
			aredescripci='$_REQUEST[aredescripci]',
			arefecha='$fecha'
			WHERE areid='$_REQUEST[actarea]' ")
		or die ("Problemas en el select ".mysql_error());
		echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_area.php'</script>";
	}
?>