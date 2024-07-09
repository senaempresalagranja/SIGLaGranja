
<?php
session_start();
include 'conexion.php';
/* Guardar registros en la base de datos postgres */
$codigoAct=$_REQUEST['culidcodigo'];
$nombreAct=$_REQUEST['culnomcomun']; 
date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y / H:i:s",time());

$CodReg=pg_num_rows( pg_query("SELECT * FROM cultivo WHERE culidcodigo='".strtoupper($codigoAct)."'"));
$NomReg=pg_num_rows( pg_query("SELECT * FROM cultivo WHERE culnomcomun='".strtoupper($nombreAct)."'"));
//Transformamos el value numérico por un dato a string
$cult=$_REQUEST['culorigen'];
$origen="EXOTICO";
if ($cult==1) 
{
	$origen="NATIVO";
}

if ($codigoAct == " ") 
{
	echo "<script type='text/javascript'>alert('El Codigo del Cultivo esta vacio'); 
	location='../frm_cultivo.php'</script>";
}
else
{
	if ($nombreAct == " ") 
	{
		echo "<script type='text/javascript'>alert('El Nombre del Cultivo esta vacio'); 
		location='../frm_cultivo.php'</script>";
	}
	else
	{
		pg_query($con, "UPDATE cultivo SET
			culidcodigo='$_REQUEST[culidcodigo]',
			culnomcomun='$_REQUEST[culnomcomun]',
			culnomcienti='$_REQUEST[culnomcienti]', 
			culorigen='$origen',
			cullugarorig='$_REQUEST[cullugarorig]',
			culclimafavo='$_REQUEST[culclimafavo]',
			culdistsiemb='$_REQUEST[culdistsiemb]',
			culunimedsie='$_REQUEST[culunimedsie]',
			culvidautil='$_REQUEST[culvidautil]',
			cultiempvida='$_REQUEST[cultiempvida]',
			culextension='$_REQUEST[culextension]',
			culunimedida='$_REQUEST[culunimedida]',
			cullatitud='$_REQUEST[coorlatitud]',
			culorientlat='$_REQUEST[orilatitud]',
			cullongitud='$_REQUEST[coorlongitud]',
			culorientlon='$_REQUEST[orilongitud]',
			culfecha='$fecha'
			WHERE culid='$_REQUEST[culid]' ");
		echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_cultivo.php'</script>";
	}
}
?>