<?php
session_start();
if (isset($_SESSION['USUARIO ADMIN'])) 
{
 include 'conexion.php';
  $fecha=date("d-m-Y / H:i:s",time()-21600);

  pg_query("INSERT INTO clima (clifecha,clihora,cliradisolar,cliunimedrad,clitempeaire,cliunimedtem,clivelovient,cliunimedvel,clidireccion,clihumeralat,cliunimedhum,cliprecipita,cliunimedpre)
				    VALUES (
              '$_REQUEST[clifecha]',
              '$_REQUEST[clihora]',
              '$_REQUEST[cliradisolar]',
              '$_REQUEST[cliunimedrad]',
              '$_REQUEST[clitempeaire]',
              '$_REQUEST[cliunimedtem]',
              '$_REQUEST[clivelovient]',
              '$_REQUEST[cliunimedvel]',
              '$_REQUEST[clidireccion]',
              '$_REQUEST[clihumeralat]',
              '$_REQUEST[cliunimedhum]',
              '$_REQUEST[cliprecipita]',
              '$_REQUEST[cliunimedpre]')")
              or die ("Problemas en el select ".pg_last_error());
	         echo "<script type='text/javascript'>alert('Registro Guardado');location='../frm_clima.php'</script>";
           $usuario=($_SESSION['USUARIO ADMIN']);
                $actividad="REGISTRAR CLIMA";
                pg_query("INSERT INTO registro_actividad (racusuario,racactividad,racfecha) VALUES ('$usuario','$actividad','$fecha')") or die(pg_result_error());  
}
else
{
  echo "<script type='text/javascript'>alert('Parece que su Sesion ha finalizado, por favor Inicie Sesion');location='../../visitante/index.php?Acceso Denegado'</script>";
}                
?>