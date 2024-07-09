<?php
session_start();
if (isset($_SESSION['ADMINISTRADOR'])) 
{
	/* Guardar registros en la base de datos postgres */
	include 'conexion.php';
	$dano=$_REQUEST['pentipdano'];
	$Nomcomun=$_REQUEST['pennomcomun'];
	$NomCientifico=$_REQUEST['pennomcienti'];
	$Radio_Boton=$_REQUEST['pentipmanejo'];
	$Tip_Afec_Fru=$_REQUEST['pentipzaffru'];
	$Tip_Afec_Tal=$_REQUEST['pentipzaftal'];
	$Tip_Afec_Flo=$_REQUEST['pentipzafflo'];
	$Tip_Afec_Rai=$_REQUEST['pentipzafrai'];
	$Tip_Afec_Hoj=$_REQUEST['pentipzafhoj'];
	//$fecha=date("d-m-Y/H:i:s",time()-25200);
	date_default_timezone_set("America/Bogota");
	$fecha=date("d-m-Y / H:i:s",time());

	$NomComun=pg_num_rows( pg_query("SELECT * FROM plagaenfermedad WHERE pennomcomun='".strtoupper($Nomcomun)."'"));
	$NomCient=pg_num_rows( pg_query("SELECT * FROM plagaenfermedad WHERE pennomcienti='".strtoupper($NomCientifico)."'"));

	if ($dano == 1) 
	{
		$tipo='ENFERMEDAD';
	} 
	elseif ($dano == 2) 
	{
		$tipo='PLAGA';
	}

	if ($NomComun > 0) 
	{
		echo "<script type='text/javascript'>alert('El Nombre Comun Ya Existe');
				location='../frm_plagaenfermedad.php'</script>";
	}
	elseif ($NomCient > 0) 
	{
		echo "<script type='text/javascript'>alert('El Nombre Cientifico Ya Existe');
				location='../frm_plagaenfermedad.php'</script>";
	}
	elseif ($Nomcomun == " ") 
	{
		echo "<script type='text/javascript'>alert('El Nombre Comun esta vacio');
				location='../frm_plagaenfermedad.php'</script>";
	}
	elseif ($NomCientifico == " ") 
	{
		echo "<script type='text/javascript'>alert('El Nombre Cientifico esta vacio');
				location='../frm_plagaenfermedad.php'</script>";
	}
	elseif ($Radio_Boton == "") 
	{
		echo "<script type='text/javascript'>alert('Verifique el Tipo de Manejo, ¡Seleccione una opcion!');location='../frm_plagaenfermedad.php'</script>";
	}
	elseif ($Tip_Afec_Fru && $Tip_Afec_Tal && $Tip_Afec_Flo && $Tip_Afec_Rai && $Tip_Afec_Hoj == "") 
	{
		echo "<script type='text/javascript'>alert('Verifique la Zona Afectada, seleccione por lo menos una casilla de verificacion');location='../frm_plagaenfermedad.php'</script>";
	}
	else
	{ 	
		pg_query("INSERT INTO plagaenfermedad
			(
			pentipdano,
			pennomcomun,
			pennomcienti,
			pentipagecau,
			pentipmanejo,
			pentipzaffru,
			pentipzaftal,
			pentipzafflo,
			pentipzafrai,
			pentipzafhoj,
			pendescripci,
			penfecha
			)
			VALUES 
			(
			'$tipo',
			'$_REQUEST[pennomcomun]',
			'$_REQUEST[pennomcienti]',
			'$_REQUEST[pentipagecau]',
			'$_REQUEST[pentipmanejo]',
			'$_REQUEST[pentipzaffru]',
			'$_REQUEST[pentipzaftal]',
			'$_REQUEST[pentipzafflo]',
			'$_REQUEST[pentipzafrai]',
			'$_REQUEST[pentipzafhoj]',
			'$_REQUEST[pendescripci]',
			'$fecha'
			)
			")or die ("Problemas en el select ".pg_last_error());
		echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_plagaenfermedad.php'</script>";
		$usuario=($_SESSION['ADMINISTRADOR']);
		$actividad="REGISTRAR PLAGA_ENFERMEDAD";
		pg_query("INSERT INTO registro_actividad (racusuario,racactividad,racfecha) VALUES ('$usuario','$actividad','$fecha')") or die(pg_result_error());
	}
}
else
{
  echo "<script type='text/javascript'>alert('Parece que su Sesion ha finalizado, por favor Inicie Sesion');location='../../visitante/index.php?Acceso Denegado'</script>";
}
?>