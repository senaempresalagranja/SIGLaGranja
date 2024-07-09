<?php
session_start();
if (isset($_SESSION['ADMINISTRADOR'])) 
{
	include 'conexion.php';
	$plagaenfe=$_REQUEST["pcuplagaenfe"];
	$cultivo=$_REQUEST["pcucultivo"];
	$comp=("$plagaenfe$cultivo");//Se guardan los dos valores para validarlon como llave compuesta
	date_default_timezone_set("America/Bogota");
	$fecha=date("d-m-Y / H:i:s",time());

	$regComp=pg_num_rows( pg_query('SELECT * FROM plagaenferme_cultivo WHERE pcukidcodigo='.$comp));//Se consulta a la BD para veríficar que la llave cmpuesta No Exista   
	//Se revisa a la BD si el registro formado por las llaves Compuestas Ya Existe
	if ($regComp > 0)
	{
		echo "<script type='text/javascript'>alert('El Registro Ya Existe, no puede repetir la misma PLAGA-ENFERMEDAD en el mismo CULTIVO');location='../frm_plagaenfermecultivo.php'</script>";
	}
	else
	{
		pg_query ("INSERT INTO plagaenferme_cultivo (
			pcukidcodigo,
			pcuplagaenfe,
			pcucultivo,	
			pcudescripci,
			pcufecha )
			VALUES (
			'$comp',
			'$_REQUEST[pcuplagaenfe]',
			'$_REQUEST[pcucultivo]',
			'$_REQUEST[pcudescripci]',
			'$fecha')")
		or die ("Problemas en el  insert" .pg_last_error());
		echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_plagaenfermecultivo.php'</script>";
		$usuario=($_SESSION['ADMINISTRADOR']);
		$actividad="REGISTRAR PLAG_ENF_CULTIVO";
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