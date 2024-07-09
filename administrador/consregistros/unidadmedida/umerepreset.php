<?php
sleep(1);
include 'conexion.php';
if($_REQUEST)
{
	$UniMedRepresent=$_REQUEST['umerepreset'];
	$query="SELECT * FROM unidad_medida where umerepreset='".$UniMedRepresent."'";
	$results=pg_query($query)or die('ok');

	if ($UniMedRepresent == "") 
	{
		echo '<div id="Error"><input type="hidden" value="0" id="VerRepreUniMed">No Valido</div>';
	}
	elseif ($UniMedRepresent == " ")
	{
			echo '<div id="Error"><input type="hidden" value="0" id="VerRepreUniMed">No Valido</div>';
		}
	else{
		if(pg_num_rows(@$results) > 0) 
		{
			echo '<div id="Error"><input type="hidden" value="0" id="VerRepreUniMed">Ya Existe</div>';
		}
		else
		{
			echo '<div id="Success"><input type="hidden" value="1" id="VerRepreUniMed">Disponible</div>';
		}
	}
}
?>