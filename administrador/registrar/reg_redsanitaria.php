<?php
session_start();
if (isset($_SESSION['ADMINISTRADOR'])) 
{
  include 'conexion.php';
  error_reporting(E_ALL ^ E_NOTICE);
  /* Guardar registros en la base de datos postgres */
  $ConstRedSanita=$_REQUEST['rsaconstrucc'];;
  date_default_timezone_set("America/Bogota");
  $fecha=date("d-m-Y / H:i:s",time());

  $ConstRedSanita=pg_num_rows( pg_query("SELECT * FROM redsanitaria WHERE rsaconstrucc='".strtoupper($ConstRedSanita)."'"));

  if ($ConstRedSanita > 0) 
  {
    echo "<script type='text/javascript'>alert('La Construccion de la Red Sanitaria Ya Existe'); 
    location='../frm_redsanitaria.php'</script>";
  }
  else
  {
  	pg_query("INSERT INTO redsanitaria (rsaconstrucc,rsannumbater,rsanumducha,rsanumlavama,sannumgrifos,sannumsifon,sanfecha)
  				VALUES (
          '$_REQUEST[rsaconstrucc]',
          '$_REQUEST[rsannumbater]',
          '$_REQUEST[rsanumducha]',
          '$_REQUEST[rsanumlavama]',
          '$_REQUEST[sannumgrifos]',
          '$_REQUEST[sannumsifon]',
          '$fecha')")

    or die ("Problemas en el INSERT ".pg_last_error());
  	echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_redsanitaria.php'</script>";

    $usuario=($_SESSION['ADMINISTRADOR']);
    $actividad="REGISTRAR RED SANITARIA";
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