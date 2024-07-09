<?php
$origen=$_REQUEST['codraza'];
if ($origen==1)
{
  $lugarorigenraza=array('AMAZONAS','ANDINA','ATLANTICA','ORINOQUIA','PACIFICA');
}
if ($origen==2)
{
  $lugarorigenraza=array('AFRICA','AMERICA','ASIA','EUROPA','OCEANIA');
}

$xml="<?xml version=\"1.0\"?>\n";
$xml.="<lugarorigenraza>\n";
for($f=0;$f<count($lugarorigenraza);$f++)
{
  $xml.="<lugarorigenraza>".$lugarorigenraza[$f]."</lugarorigenraza>\n";
}
$xml.="</lugarorigenraza>\n";
header('Content-Type: text/xml');
echo $xml;
?>