<?php
session_start();
if (isset($_SESSION['USUARIO ADMIN'])) 
{
	include 'conexion.php';
	$enfermedad=$_REQUEST["eesenfermeda"];
	$especie=$_REQUEST["eesespecie"];
	$comp=("$enfermedad$especie");//Se guardan los dos valores para validarlon como llave compuesta
	date_default_timezone_set("America/Bogota");
	$fecha=date("d-m-Y / H:i:s",time());

	$regComp=pg_num_rows( pg_query('SELECT * FROM enfermedad_especie WHERE eeskidcodigo='.$comp));//Se consulta a la BD para veríficar que la llave cmpuesta No Exista   
	//Se revisa a la BD si el registro formado por las llaves Compuestas Ya Existe
	if ($regComp > 0)
	{
		echo "<script type='text/javascript'>alert('El Registro Ya Existe, no puede repetir la misma ENFERMEDAD con la misma ESPECIE');location='../frm_enfermedadespecie.php'</script>";
	}
	else
	{
		pg_query("INSERT INTO enfermedad_especie (
			eeskidcodigo,
			eesenfermeda,
			eesespecie,
			eesdescripci,
			eesfecha )
			VALUES (
			'$comp',
			'$_REQUEST[eesenfermeda]',
			'$_REQUEST[eesespecie]',
			'$_REQUEST[eesdescripci]',
			'$fecha')")
		or die ("Problemas en el select ".mysql_error());
		echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_enfermedadespecie.php'</script>";
		$usuario=($_SESSION['USUARIO ADMIN']);
		$actividad="REGISTRAR ENFERMEDAD_ESPECIE";
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