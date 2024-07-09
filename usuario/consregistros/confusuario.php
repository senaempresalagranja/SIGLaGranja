<?php
sleep(1);
if($_GET)
{
	$usupassword=$_REQUEST['usupassword'];
	$usupassword1=$_REQUEST['usupassword1'];

	if ($usupassword == $usupassword1) 
	{
		echo '<div id="Success"><input type="hidden" value="1" id="Verpasswoord"></div>';
	}
	else
	{
		echo '<div id="Error"><input type="hidden" value="0" id="Verpasswoord">La Contraseña no son Iguales</div>';
	}
}
?>