<?php
session_start();
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
	pg_query("	UPDATE plaga_especie SET 
					peskidcodigo='$comp', 
					pesespecie='$_REQUEST[pesespecie]', 
					pesplaga='$_REQUEST[pesplaga]',
					pesdescripci='$_REQUEST[pesdescripci]',
					pesfecha='$fecha'
				WHERE pesid=$_REQUEST[pesid] ")  
				or die ("Problemas en el select ".mysql_error());
				echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_plagaespecie.php'</script>";
}
?>