<?php
include 'conexion.php';
/* Actualizar registros en la base de datos postgres */
$act_codigo=$_REQUEST['lotidcodigo'];
date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y / H:i:s",time());
	$CodAct=pg_num_rows( pg_query("SELECT * FROM lote WHERE lotidcodigo='".strtoupper($act_codigo)."'"));

	if ($act_codigo == " ")
	{
		echo "<script type='text/javascript'>alert('El Codigo del lote esta Vacio');
		location='../frm_lote.php'</script>";
	}
	else
	{
		pg_query("UPDATE lote SET 
			lotidcodigo='$_REQUEST[lotidcodigo]',
			lotsuelo='$_REQUEST[lotsuelo]',
			lotextension='$_REQUEST[lotextension]',
			lotunimedlot='$_REQUEST[lotunimedlot]',
			lotlatitud='$_REQUEST[coorlatitud]',
			lotorientlat='$_REQUEST[orilatitud]',
			lotlongitud='$_REQUEST[coorlongitud]',
			lotorientlon='$_REQUEST[orilongitud]',
			lotfecha='$fecha'
			WHERE lotid='$_REQUEST[lotid]'")
		or die ("Problemas en el select ".mysql_error());
		echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_lote.php'</script>";
	}
?>