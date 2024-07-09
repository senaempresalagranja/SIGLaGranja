<?php
function Conectarse(){

$con=pg_connect("host=localhost user=postgres password='(()()())' dbname=siglagranja  port=5432");
pg_query ("SET NAMES 'utf8'");
return $con;}
?>