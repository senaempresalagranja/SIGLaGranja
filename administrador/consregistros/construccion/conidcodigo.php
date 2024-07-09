<?php
	sleep(1);
	include '../conexion.php';
	if($_REQUEST)
	{
		$codigo=$_REQUEST['conidcodigo'];
		$query="SELECT * FROM construccion where conidcodigo='".strtoupper($codigo)."'";
		$results=pg_query($query)or die('');
	
		if ($codigo == "") 
		{
			echo '<div id="Error"><input type="hidden" value="0" id="VercodConstruccion">No Valido</div>';
		}
		elseif ($codigo == " ")
		{
			echo '<div id="Error"><input type="hidden" value="0" id="VercodConstruccion">No Valido</div>';
		}
		else
		{
			if (pg_num_rows(@$results) > 0) 
			{
				echo '<div id="Error"><input type="hidden" value="" id="VercodConstruccion">Ya Existe</div>';
			}
			else
			{
				echo '<div id="Success"><input type="hidden" value="1" id="VercodConstruccion">Disponible</div>';
			}
		}
	}
?>
