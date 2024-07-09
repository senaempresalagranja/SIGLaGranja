<?php
sleep(1);
include 'conexion.php';
if($_REQUEST)
{
	$nomusuario=$_REQUEST['usunombre'];

	if (strlen($nomusuario) <= 2) 
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VerNomUsu"><center>El Nombre debe Tener mas de 2 Carácteres</center></div>';
	}
	else
	{
		echo '<div id="Success"><input type="hidden" value="1" id="VerNomUsu"></div>';
	}

}
?>