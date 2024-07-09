<?php
sleep(1);
include 'conexion.php';
if($_REQUEST)
{
	$nombre=$_REQUEST['usuusuario'];
	$query="SELECT * FROM usuario where usuusuario='".strtoupper($nombre)."'";
	$results=pg_query($query)or die('ok');

	if ($nombre == "") {
		echo '<div id="Error"><input type="hidden" value="" id="verusuusuario">No Valido</div>';
	}
	elseif ($nombre == " "){
			echo '<div id="Error"><input type="hidden" value="" id="verusuusuario">No Valido</div>';
		}
	else{
		if(pg_num_rows(@$results) > 0) 
		{
			echo '<div id="Error"><input type="hidden" value="" id="verusuusuario">Ya Existe</div>';
		}
		else
		{
			echo '<div id="Success"><input type="hidden" value="1" id="verusuusuario">Disponible</div>';
		}
	}
}
?>