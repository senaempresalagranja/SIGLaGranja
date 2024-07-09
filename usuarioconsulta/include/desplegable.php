<?php
$tipdano=$_REQUEST['codplaenf'];
if ($tipdano==1)
{
  $tipagentecausal=array('HONGO','BACTERIA','VIRUS');
}
if ($tipdano==2)
{
  $tipagentecausal=array('GUSANO','MOSCA BLANCA','HORMIGA','POLILLA');
}

$xml="<?xml version=\"1.0\"?>\n";
$xml.="<tipagentecausal>\n";
for($f=0;$f<count($tipagentecausal);$f++)
{
  $xml.="<tipagentecausal>".$tipagentecausal[$f]."</tipagentecausal>\n";
}
$xml.="</tipagentecausal>\n";
header('Content-Type: text/xml');
echo $xml;
?>