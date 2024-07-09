<?php
include '../conexion.php';
/* Actualizar en Postgres*/
$act_codigo=$_REQUEST['conidcodigo'];
$act_nombre=$_REQUEST['connombre'];
date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y / H:i:s",time());

$CodAct=pg_num_rows( pg_query("SELECT * FROM construccion WHERE conidcodigo='".strtoupper($act_codigo)."'"));
$NomAct=pg_num_rows( pg_query("SELECT * FROM construccion WHERE connombre='".strtoupper($act_nombre)."'"));

if ($act_codigo == " ") 
{
	echo "<script type='text/javascript'>alert('El Codigo de la Construccion esta Vacio');
	location='../frm_construccion.php'</script>";
}
else
{
	if ($act_nombre == " ") 
	{
		echo "<script type='text/javascript'>alert('El Nombre de la Construccion esta Vacio');
		location='../frm_construccion.php'</script>";
	}
	else
	{
		pg_query(" UPDATE construccion SET 
			conidcodigo='$_REQUEST[conidcodigo]', 
			conunidad='$_REQUEST[conunidad]', 
			connombre='$_REQUEST[connombre]',	 
			conextension='$_REQUEST[conextension]', 
			conunimedcon='$_REQUEST[conunimedcon]', 
			contipambien='$_REQUEST[contipambien]', 	 
			contipconstr='$_REQUEST[contipconstr]',
			conestado ='$_REQUEST[conestado]', 
			contipcubiert='$_REQUEST[contipcubiert]', 	 
			contippiso='$_REQUEST[contippiso]', 
			contipmuro='$_REQUEST[contipmuro]',  
			confecconstr='$_REQUEST[confecconstr]', 
			confecremode='$_REQUEST[confecremode]',	  
			conlatitud='$_REQUEST[coorlatitud]', 
			conorientlat='$_REQUEST[orilatitud]', 
			conlongitud='$_REQUEST[coorlongitud]', 
			conorientlon='$_REQUEST[orilongitud]',
			confecha='$fecha'
			WHERE conid='$_REQUEST[conid]' ");
		echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_construccion.php'</script>";
	}
}


?> 