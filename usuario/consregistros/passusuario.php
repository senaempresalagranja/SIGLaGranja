<?php
sleep(1);
include 'conexion.php';
if($_REQUEST)
{
	$password=$_REQUEST['usupassword'];

	if (strlen($password) < 7) 
	{
		echo '<div id="Error"><input type="hidden" value="0" id="Verificarpasswor"><center>La Contraseña debe Tener mas de 6 Carácteres</center></div>';
	}
	elseif (strlen($password) >= 14) {
		echo '<div id="Error"><input type="hidden" value="0" id="Verificarpasswor"><center>La Contraseña debe Tener menos de 14 Carácteres</center></div>';
	}
	else
	{
		echo '<div id="Success"><input type="hidden" value="1" id="Verificarpasswor"></div>';
	}

}
?>