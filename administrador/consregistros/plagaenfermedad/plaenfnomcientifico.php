<?php
sleep(1);
include 'conexion.php';
if($_REQUEST)
{
	$nomcienti=$_REQUEST['pennomcienti'];
	$query="SELECT * FROM plagaenfermedad where pennomcienti='".strtoupper($nomcienti)."'";
	$results=pg_query($query)or die('ok');

	if ($nomcienti == "") {
		echo '<div id="Error"><input type="hidden" value="0" id="VerPlaEnfNomCientifico">No Valido</div>';
	}
	elseif ($nomcienti == " "){
			echo '<div id="Error"><input type="hidden" value="0" id="VerPlaEnfNomCientifico">No Valido</div>';
		}
	else{
		if(pg_num_rows(@$results) > 0) 
		{
			echo '<div id="Error"><input type="hidden" value="0" id="VerPlaEnfNomCientifico">Ya Existe</div>';
		}
		else
		{
			echo '<div id="Success"><input type="hidden" value="1" id="VerPlaEnfNomCientifico">Disponible</div>';
		}
	}
}?>