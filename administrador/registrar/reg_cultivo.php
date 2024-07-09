<?php
session_start();
if (isset($_SESSION['ADMINISTRADOR'])) 
{
  include 'conexion.php';
  /* Guardar registros en la base de datos postgres */
  $codigo=$_REQUEST['culidcodigo'];
  $nombre=$_REQUEST['culnomcomun'];
  $culnomcienti=$_REQUEST['culnomcienti']; 
  date_default_timezone_set("America/Bogota");
  $fecha=date("d-m-Y / H:i:s",time());

  $CodReg=pg_num_rows( pg_query("SELECT * FROM cultivo WHERE culidcodigo='".strtoupper($codigo)."'"));
  $NomReg=pg_num_rows( pg_query("SELECT * FROM cultivo WHERE culnomcomun='".strtoupper($nombre)."'"));
  $NomCient=pg_num_rows( pg_query("SELECT * FROM cultivo WHERE culnomcienti='".strtoupper($culnomcienti)."'"));
  //Transformamos el value numérico por un dato a string
  $cult=$_REQUEST['culorigen'];
  $origen="EXOTICO";
  if ($cult==1) 
  {
  	$origen="NATIVO";
  }

  if ($CodReg > 0) 
  {
    echo "<script type='text/javascript'>alert('El Codigo del Cultivo Ya Existe'); 
    location='../frm_cultivo.php'</script>";
  }
  else
  {
    if ($NomReg > 0) 
    {
      echo "<script type='text/javascript'>alert('El Nombre del Cultivo Ya Existe'); 
      location='../frm_cultivo.php'</script>";
    }
    elseif ($NomCient > 0) 
    {
      echo "<script type='text/javascript'>alert('El Nombre Cientifico del Cultivo Ya Existe'); 
      location='../frm_cultivo.php'</script>";
    }
    else
    {
      if ($codigo == " ") 
      {
        echo "<script type='text/javascript'>alert('El Codigo del Cultivo esta vacio'); 
        location='../frm_cultivo.php'</script>";
      }
      elseif ($nombre == " ") 
      {
        echo "<script type='text/javascript'>alert('El Nombre del Cultivo esta vacio'); 
        location='../frm_cultivo.php'</script>";
      }
      else
      {
        pg_query("INSERT INTO cultivo (culidcodigo,culnomcomun,culnomcienti,culorigen,cullugarorig,culclimafavo,culdistsiemb,culunimedsie,culvidautil,cultiempvida,culextension,culunimedida,cullatitud,culorientlat,cullongitud,culorientlon,culfecha)
        VALUES (
        '$_REQUEST[culidcodigo]',
        '$_REQUEST[culnomcomun]',
        '$_REQUEST[culnomcienti]',
        '$origen',
        '$_REQUEST[cullugarorig]',
        '$_REQUEST[culclimafavo]',
        '$_REQUEST[culdistsiemb]',
        '$_REQUEST[culunimedsie]',
        '$_REQUEST[culvidautil]',
        '$_REQUEST[cultiempvida]',
        '$_REQUEST[culextension]',
        '$_REQUEST[culunimedida]',
        '$_REQUEST[coorlatitud]',
        '$_REQUEST[orilatitud]',
        '$_REQUEST[coorlongitud]',
        '$_REQUEST[orilongitud]',
        '$fecha')")
        or die ("Problemas en el select ".pg_last_error());
        echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_cultivo.php'</script>";
        $usuario=($_SESSION['ADMINISTRADOR']);
        $actividad="REGISTRAR CULTIVO";
        pg_query("INSERT INTO registro_actividad (racusuario,racactividad,racfecha) VALUES ('$usuario','$actividad','$fecha')") or die(pg_result_error());
      }
    }
  }
}
else
{
  echo "<script type='text/javascript'>alert('Parece que su Sesion ha finalizado, por favor Inicie Sesion');location='../../visitante/index.php?Acceso Denegado'</script>";
}

/*$codigo=$_REQUEST['culidcodigo'];
$res=pg_query($con, "SELECT * FROM cultivo WHERE culidcodigo='$codigo'");
while($reg=pg_fetch_array($res))
{
  $id=$reg[0];
}
if (isset($id)) 
{
  echo "<script type='text/javascript'>alert('Registro Existente');location='../frm_cultivo.php'</script>";
}*/
?>