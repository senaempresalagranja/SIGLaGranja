<?php
session_start();
include 'conexion.php';
if (session_start('USUARIO')) 
{
	header("Location: ../index.php");
	unset($_SESSION['USUARIO']);
}
?>