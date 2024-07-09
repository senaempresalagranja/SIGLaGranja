<?php
session_start();
if (isset($_SESSION['USUARIO ADMIN'])) 
{
	include 'conexion.php';
	$estanque=$_REQUEST["eeaestanque"];
	$espacua=$_REQUEST["eeaespacua"];
	$comp=("$estanque$espacua");//Se guardan los dos valores para validarlon como llave compuesta
	date_default_timezone_set("America/Bogota");
	$fecha=date("d-m-Y / H:i:s",time());

	$regComp=pg_num_rows( pg_query('SELECT * FROM estanque_especieacuatica WHERE eeapkcodigo='.$comp));//Se consulta a la BD para veríficar que la llave cmpuesta No Exista   
	//Se revisa a la BD si el registro formado por las llaves Compuestas Ya Existe
	if ($regComp > 0)
	{
		echo "<script type='text/javascript'>alert('El Registro Ya Existe, no puede repetir el mismo ESTANQUE con la misma ESPECIE ACUATICA');location='../frm_estanqueespacua.php'</script>";
	}
	else
	{
		pg_query("INSERT INTO estanque_especieacuatica (
			eeapkcodigo,
			eeaestanque,
			eeaespacua,
			eearesponsab,
			eeafecsiembr,
			eeafeccosech,
			eeadescripci,
			eeafecha )
			VALUES (
			'$comp',
			'$_REQUEST[eeaestanque]',
			'$_REQUEST[eeaespacua]',
			'$_REQUEST[eearesponsab]',
			'$_REQUEST[eeafecsiembr]',
			'$_REQUEST[eeafeccosech]',
			'$_REQUEST[eeadescripci]',
			'$fecha')")
		or die ("Problemas en el select ".mysql_error());
		echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_estanqueespacua.php'</script>";
		$usuario=($_SESSION['USUARIO ADMIN']);
		$actividad="REGISTRAR ESTANQUE_ESPECIEACUATICA";
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