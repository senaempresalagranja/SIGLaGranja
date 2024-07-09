<?php
$origen=$_REQUEST['codvegetal'];
if ($origen==1)
{
  $veglugorigen=array('AMAZONAS','ANDINA','ATLANTICA','ORINOQUIA','PACIFICA');
}
if ($origen==2)
{
  $veglugorigen=array('AFRICA','AMERICA','ASIA','EUROPA','OCEANIA');
}

$xml="<?xml version=\"1.0\"?>\n";
$xml.="<veglugorigen>\n";
for($f=0;$f<count($veglugorigen);$f++)
{
  $xml.="<veglugorigen>".$veglugorigen[$f]."</veglugorigen>\n";
}
$xml.="</veglugorigen>\n";
header('Content-Type: text/xml');
echo $xml;
?>