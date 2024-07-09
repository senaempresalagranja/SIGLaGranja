<?php
session_start();
if (isset($_SESSION['ADMINISTRADOR'])) 
{
	include 'conexion.php';
	$especie=$_REQUEST["pesespecie"];
	$plaga=$_REQUEST["pesplaga"];
	$comp=("$especie$plaga");//Se guardan los dos valores para validarlon como llave compuesta
	date_default_timezone_set("America/Bogota");
	$fecha=date("d-m-Y / H:i:s",time());

	$regComp=pg_num_rows( pg_query('SELECT * FROM plaga_especie WHERE peskidcodigo='.$comp));//Se consulta a la BD para veríficar que la llave cmpuesta No Exista   
	//Se revisa a la BD si el registro formado por las llaves Compuestas Ya Existe
	if ($regComp > 0)
	{
		echo "<script type='text/javascript'>alert('El Registro Ya Existe, no puede repetir la misma ESPECIE con la misma PLAGA');location='../frm_plagaespecie.php'</script>";
	}
	else
	{
		pg_query("INSERT INTO plaga_especie (
			peskidcodigo,
			pesespecie,
			pesplaga,
			pesdescripci,
			pesfecha )
			VALUES (
			'$comp',
			'$_REQUEST[pesespecie]',
			'$_REQUEST[pesplaga]',
			'$_REQUEST[pesdescripci]',
			'$fecha')")
		or die ("Problemas en el select ".mysql_error());
		echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_plagaespecie.php'</script>";
		$usuario=($_SESSION['ADMINISTRADOR']);
		$actividad="REGISTRAR PLAGA_ESPECIE";
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