<?php
session_start();
if (isset($_SESSION['ADMINISTRADOR'])) 
{
	include 'conexion.php';
	$zonaverde=$_REQUEST["zovzonaverde"];
	$vegetal=$_REQUEST["zovvegetal"];
	$comp=("$zonaverde$vegetal");//Se guardan los dos valores para validarlon como llave compuesta
	date_default_timezone_set("America/Bogota");
	$fecha=date("d-m-Y / H:i:s",time());

	$regComp=pg_num_rows( pg_query('SELECT * FROM zonaverde_vegetal WHERE zovkidcodigo='.$comp));//Se consulta a la BD para veríficar que la llave cmpuesta No Exista   
	//Se revisa a la BD si el registro formado por las llaves Compuestas Ya Existe
	if ($regComp > 0)
	{
		echo "<script type='text/javascript'>alert('El Registro Ya Existe, no puede repetir el mismo VEGETAL a la misma ZONA VERDE');location='../frm_zonaverdevegetal.php'</script>";
	}
	else
	{
		pg_query("INSERT INTO zonaverde_vegetal (
			zovkidcodigo,
			zovzonaverde,
			zovvegetal,
			zovdescripci,
			zovfecha )
			VALUES (
			'$comp',
			'$_REQUEST[zovzonaverde]',
			'$_REQUEST[zovvegetal]',
			'$_REQUEST[zovdescripci]',
			'$fecha')")
		or die ("Problemas en el select ".mysql_error());
		echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_zonaverdevegetal.php'</script>";
		$usuario=($_SESSION['ADMINISTRADOR']);
		$actividad="REGISTRAR ZONAVERDE_VEGETAL";
		pg_query("INSERT INTO registro_actividad (racusuario,racactividad,racfecha) VALUES (
		'$usuario',
		'$actividad',
		'$fecha')") or die(pg_result_error());
	}
}
else
{
	echo "<script type='text/javascript'>alert('Parece que su Sesion ha finalizado, por favor Inicie Sesion');location='../../visitante/index.php?Acceso Denegado'</script>";
}
?>