<?php
$origen=$_REQUEST['cod'];
if ($origen==1)
{
  $lugarorigen=array('PACIFICA','ATLANTICA','ANDINA','ORINOQUIA','AMAZONAS');
}
if ($origen==2)
{
  $lugarorigen=array('AMERICA','ASIA','AFRICA','EUROPA','OCEANIA');
}

$xml="<?xml version=\"1.0\"?>\n";
$xml.="<lugarorigen>\n";
for($f=0;$f<count($lugarorigen);$f++)
{
  $xml.="<lugarorigen>".$lugarorigen[$f]."</lugarorigen>\n";
}
$xml.="</lugarorigen>\n";
header('Content-Type: text/xml');
echo $xml;
?>