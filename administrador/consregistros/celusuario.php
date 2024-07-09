<?php
sleep(1);
include 'conexion.php';
if($_REQUEST)
{
	$Celeular=$_REQUEST['usutelefono'];

	if (strlen($Celeular) <> 10) 
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VerCelUsu">Numero de Celular Incorreto</div>';
	}
	else
	{
		echo '<div id="Success"><input type="hidden" value="1" id="VerCelUsu"></div>';
	}

}
?>