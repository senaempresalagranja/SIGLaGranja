<?php
session_start();
include 'conexion.php';
/* Guardar registros en la base de datos postgres */
$placodigo=$_REQUEST['plaidcodigo'];
$nomcomun=$_REQUEST['planomcomun'];
$nomcientifico=$_REQUEST['planomcienti']; 
date_default_timezone_set("America/Bogota");
$fecha=date("d-m-Y / H:i:s",time());

$PlaCod=pg_num_rows( pg_query("SELECT * FROM plaga WHERE plaidcodigo='".strtoupper($placodigo)."'"));
$NomComun=pg_num_rows( pg_query("SELECT * FROM plaga WHERE planomcomun='".strtoupper($nomcomun)."'"));
$NomCient=pg_num_rows( pg_query("SELECT * FROM plaga WHERE planomcienti='".strtoupper($nomcientifico)."'"));

if ($placodigo == " ") 
{
  echo "<script type='text/javascript'>alert('El Codigo de la plaga esta vacio');
  location='../frm_plaga.php'</script>";
}
elseif ($nomcomun==" ") 
{
  echo "<script type='text/javascript'>alert('El nombre comun de la plaga esta vacio');
  location='../frm_plaga.php'</script>";
}
else
{
  if ($nomcientifico==" ") 
  {
    echo "<script type='text/javascript'>alert('El nombre cientifico de la plaga esta vacio');
    location='../frm_plaga.php'</script>";
  }
  else
  {
    $pla=$_REQUEST['plaorigen'];
      $origen="EXOTICO";
        if ($pla==1) 
        {
          $origen="NATIVO";
        }
          pg_query($con, "UPDATE plaga SET
            plaidcodigo='$_REQUEST[plaidcodigo]',
            planomcomun='$_REQUEST[planomcomun]', 
            planomcienti='$_REQUEST[planomcienti]', 
            plaorigen='$origen', 
            plalugarorig='$_REQUEST[plalugarorig]', 
            platipagecau='$_REQUEST[platipagecau]', 
            platratamien='$_REQUEST[platratamien]',
            plafecha='$fecha'
            WHERE plaid='$_REQUEST[plaid]' ")
          or die ("Problemas en el select ".mysql_error());
          echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_plaga.php'</script>";
  }
} 	
?>