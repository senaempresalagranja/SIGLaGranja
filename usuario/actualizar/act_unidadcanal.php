<?php
session_start();
include 'conexion.php';
$unidad=$_REQUEST["cununidad"];
$canal=$_REQUEST["cuncanal"];
$comp=("$unidad$canal");//Se guardan los dos valores para validarlon como llave compuesta
date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y / H:i:s",time());

$regComp=pg_num_rows( pg_query('SELECT * FROM unidad_canal WHERE cunkidcodigo='.$comp));

if ($regComp > 0)
{
    echo "<script type='text/javascript'>alert('El Registro Ya Existe, no puede asignar la misma CANAL a la misma UNIDAD');location='../frm_unidadcanal.php'</script>";
}
else
{
    pg_query("  UPDATE unidad_canal SET 
                    cunkidcodigo='$comp',
                    cununidad='$_REQUEST[cununidad]',
                    cuncanal='$_REQUEST[cuncanal]',
                    cundistancia='$_REQUEST[cundistancia]',
                    cununimedist='$_REQUEST[cununimedist]',
                    cundescripci='$_REQUEST[cundescripci]',
                    cunfecha='$fecha'
                WHERE cunid= '$_REQUEST[cunid]' ")
                or die ("Problemas en el select ".mysql_error());
                echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_unidadcanal.php'</script>";
}
?>
<!-- 	$keya=$_REQUEST['cunkidcodigo'];
 	$cununidad=$_REQUEST["cununidad"];
    $cuncanal=$_REQUEST["cuncanal"];
 	$keyn=("$cununidad$cuncanal");

 	if ($keya<>$keyn) {
    	$comp=$keyn;
    }
    else{
    	$comp=$keya;
    }
    pg_query("UPDATE unidad_canal SET 	cunkidcodigo='$comp', 
    									cununidad='$_REQUEST[cununidad]', 
    									cuncanal='$_REQUEST[cuncanal]',
    									cundistancia='$_REQUEST[cundistancia]',
    									cununimedist='$_REQUEST[cununimedist]', 
    									cundescripci='$_REQUEST[cundescripci]', 
    									cunfecha='$fecha' 
    								WHERE cunid='$_REQUEST[cunkidcodigo]' ")  or die ("Problemas en el select ".mysql_error());
	echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_unidadcanal.php'</script>";
 ?>-->