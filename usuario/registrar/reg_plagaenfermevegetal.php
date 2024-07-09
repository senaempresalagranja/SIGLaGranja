<?php
session_start();
if (isset($_SESSION['USUARIO ADMIN'])) 
{
	include 'conexion.php';
	$plagaenfe=$_REQUEST["pveplagaenfe"];
	$vegetal=$_REQUEST["pvevegetal"];
	$comp=("$plagaenfe$vegetal");//Se guardan los dos valores para validarlon como llave compuesta
	date_default_timezone_set("America/Bogota");
	$fecha=date("d-m-Y / H:i:s",time());

	$regComp=pg_num_rows( pg_query('SELECT * FROM plagaenferme_vegetal WHERE pvekidcogigo='.$comp));//Se consulta a la BD para veríficar que la llave cmpuesta No Exista   
	//Se revisa a la BD si el registro formado por las llaves Compuestas Ya Existe
	if ($regComp > 0)
	{
		echo "<script type='text/javascript'>alert('El Registro Ya Existe, no puede repetir la misma PLAGA-ENFERMEDAD en el mismo VEGETAL');location='../frm_plagaenfermevegetal.php'</script>";
	}
	else
	{
		pg_query ("INSERT INTO plagaenferme_vegetal (
			pvekidcogigo,
			pveplagaenfe,
			pvevegetal,	
			pvedescripci,
			pvefecha )
			VALUES (
			'$comp',
			'$_REQUEST[pveplagaenfe]',
			'$_REQUEST[pvevegetal]',
			'$_REQUEST[pvedescripci]',
			'$fecha')")
		or die ("Problemas en el  insert" .pg_last_error());
		echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_plagaenfermevegetal.php'</script>";
		$usuario=($_SESSION['USUARIO ADMIN']);
		$actividad="REGISTRAR PLAG_ENF_VEGETAL";
		pg_query("INSERT INTO registro_actividad (racusuario,racactividad,racfecha) VALUES (
			'$usuario',
			'$actividad',
			'$fecha')") 
		or die(pg_result_error());
	}
}
else
{
  echo "<script type='text/javascript'>alert('Parece que su Sesion ha finalizado, por favor Inicie Sesion');location='../../visitante/index.php?Acceso Denegado'</script>";
}
?>