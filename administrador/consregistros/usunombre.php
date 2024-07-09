<?php
sleep(1);
include 'conexion.php';
if($_REQUEST)
{
	$usuario=$_REQUEST['nomusuario'];
	$query="SELECT * FROM usuario where usunombre='".strtoupper($usuario)."'";
	$results=pg_query($query)or die('ok');

	if ($usuario == "") {
		echo '<div id="Error"><input type="hidden" value="" id="veriusuario">No Valido</div>';
	}
	elseif ($usuario == " "){
			echo '<div id="Error"><input type="hidden" value="" id="veriusuario">No Valido</div>';
		}
	elseif ($usuario == "  "){
			echo '<div id="Error"><input type="hidden" value="" id="veriusuario">No Valido</div>';
		}
	else{
		if(pg_num_rows(@$results) > 0) 
		{
			echo '<div id="Error"><input type="hidden" value="" id="veriusuario">Ya Existe</div>';
		}
		else
		{
			echo '<div id="Success">Disponible</div>';
		}
	}
}?>