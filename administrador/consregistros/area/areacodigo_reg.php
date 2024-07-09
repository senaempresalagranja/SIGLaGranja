<?php
	sleep(1);
	include '../conexion.php';
	if($_REQUEST)
	{
		$codigo=$_REQUEST['areidcodigo'];
		$query="SELECT * FROM area where areidcodigo='".strtoupper($codigo)."'";
		$results=pg_query($query)or die('');
	
		if ($codigo == "") 
		{
			echo '<div id="Error"><input type="hidden" value="0" id="VercodArea">No Valido</div>';
		}
		elseif ($codigo == " ")
		{
			echo '<div id="Error"><input type="hidden" value="0" id="VercodArea">No Valido</div>';
		}
		else
		{
			if (pg_num_rows(@$results) > 0) 
			{
				echo '<div id="Error"><input type="hidden" value="0" id="VercodArea">Ya Existe</div>';
			}
			else
			{
				echo '<div id="Success"><input type="hidden" value="1" id="VercodArea">Disponible</div>';
			}
		}
	}
?>
