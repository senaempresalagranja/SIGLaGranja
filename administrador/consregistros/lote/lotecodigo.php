<?php
	sleep(1);
	include 'conexion.php';
	if($_REQUEST)
	{
		$codigo=$_REQUEST['lotidcodigo'];
		$query="SELECT * FROM lote where lotidcodigo='".strtoupper($codigo)."'";
		$results=pg_query($query)or die('ok');
	
		if ($codigo == "") 
		{
			echo '<div id="Error"><input type="hidden" value="0" id="VercodLote">No Valido</div>';
		}
		elseif ($codigo == " ")
		{
			echo '<div id="Error"><input type="hidden" value="0" id="VercodLote">No Valido</div>';
		}
		else
		{
			if (pg_num_rows(@$results) > 0) 
			{
				echo '<div id="Error"><input type="hidden" value="0" id="VercodLote">Ya Existe</div>';
			}
			else
			{
				echo '<div id="Success"><input type="hidden" value="1" id="VercodLote">Disponible</div>';
			}
		}
	}
?>
