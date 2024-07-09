<?php
sleep(1);
include 'conexion.php';
if($_REQUEST)
{
	$apeusuario=$_REQUEST['usuapellidos'];

	if (strlen($apeusuario) <= 3) 
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VerApeUsu"><center>Los Apellido debe Tener mas de 3 Carácteres</center></div>';
	}
	else
	{
		echo '<div id="Success"><input type="hidden" value="1" id="VerApeUsu"></div>';
	}

}
?>