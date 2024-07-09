<?php
include "pdf/pdf.php";
include "../conexion.php";

class  MiPDF extends FPDF 
{

	public function Header()
	{
		$this -> Image("../img/logo.jpg" , 25 , 25 , 20 , 20);
		$this -> SetFont ( 'Arial' , 'B' , 16 );
		$this -> Cell( 200, 20 , "BD: siglagranja / Canal  ", 0 , 0 , 'C' );					
		$this -> Cell( 0, 20 , " Fecha: ".date("d/m/Y",time()-25200), 0 , 0 ,'R');
		$this -> Ln( 30 );
	}

	public function Footer()
	{
		$this->SetY(-15); 
		$this->AliasNbPages();
		$this->SetFont('Arial','I',10); 
		$this->SetTextColor(0);
		$this->Cell(0,10,'Pagina '.$this->PageNo().' de {nb}',0,0,'C'); 
	}
}
$mipdf = new MiPDF('P','mm','A3');
$mipdf->SetMargins(19, 25, 15, 5);
$mipdf->SetAutoPageBreak(true,15);
$cabeceraT = array("PROFUNDIDAD","ANCHO","PENDIENTE","DISTANCIA",
		"LAT INICIAL","LONG INICIAL","LAT FINAL","LONG FINAL");//se define los nombre de la cabesera d ela tabla a mostrar
$cabecera = array("CODIGO");
$cabeceraN = array("NOMBRE");
$cabeceraC = array("CLASE");
$cabeceraTP = array("TIPO");
$cabeceraU = array("USO");
$mipdf -> addPage('A5' , 'legal',20,39);

for ($q = 0; $q < count( $cabecera) ; $q++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 7.2);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 18, 10 , $cabecera[ $q ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $cabeceraN) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 7.2);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 30, 10 , $cabeceraN[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $cabeceraC) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 7.2);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 23, 10 , $cabeceraC[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $cabeceraTP) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 7.2);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 18, 10 , $cabeceraTP[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $cabeceraU) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 7.2);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 26, 10 , $cabeceraU[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $cabeceraT) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 7.2);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 25, 10 , $cabeceraT[ $i ] , 1 , 0 , 'C' , true );
}
$mipdf -> Ln(10);

$res=pg_query($con, "SELECT * FROM canal order by canidcodigo ASC");
while($reg=pg_fetch_array($res))
{
	$canunimedpro= utf8_decode($reg [7]);		
	$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$canunimedpro' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre=$reg1[1];
	}
	$UnidadAncho=utf8_decode($reg[9]);	
	$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$UnidadAncho' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre1=$reg1[1];
	}
	$UnidadPendiente=utf8_decode($reg[11]);
	$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$UnidadPendiente' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre2=$reg1[1];
	}
	$UnidadDistancia=utf8_decode($reg[13]);
	$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$UnidadDistancia' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre3=$reg1[1];
	}
	
	$CodigoCanal=$reg[1];
	$Nombre=$reg[2];
	$Clase=$reg[3];
	$Tipo=$reg[4];
	$Uso=$reg[5];
	$Profundidad=$reg[6];
	$Ancho=$reg[8];
	$Pendiente=$reg[10];
	$Distancia=$reg[12];
	$LatitudInicial=$reg[14];
	$canorienlati=$reg[15];
	$LongitudInicial=$reg[16];
	$canorienloni=$reg[17];
	$LatitudFinal =$reg[18];
	$canorienlatf=$reg[19];
	$LongitudFinal=$reg[20];
	$canorienlonf=$reg[21];




	$mipdf -> SetFont( 'arial' , 'B' , 6.5);
	$mipdf -> SetTextColor(0,0,0);
	$mipdf -> SetFillColor(255,255,255);
	$mipdf -> Cell( 18, 10 , $CodigoCanal , 1, 0, 'L' , true );
	$mipdf -> Cell( 30, 10 , $Nombre , 1, 0, 'L' , true );
	$mipdf -> Cell( 23, 10 , $Clase , 1, 0, 'L' , true );
	$mipdf -> Cell( 18, 10 , $Tipo, 1, 0, 'L' , true );
	$mipdf -> Cell( 26, 10 , $Uso , 1, 0, 'L' , true );
	$mipdf -> Cell( 16, 10 , $Profundidad, 1, 0, 'R' , true );
	$mipdf -> Cell( 9, 10 , $nombre, 1, 0, 'L' , true );
	$mipdf -> Cell( 16, 10 , $Ancho, 1, 0, 'R' , true );
	$mipdf -> Cell( 9, 10 , $nombre1, 1, 0, 'L' , true );
	$mipdf -> Cell( 16, 10 , $Pendiente, 1, 0, 'R' , true );
	$mipdf -> Cell( 9, 10 , $nombre2, 1, 0, 'L' , true );
	$mipdf -> Cell( 16, 10 , $Distancia, 1, 0, 'R' , true );
	$mipdf -> Cell( 9, 10 , $nombre3, 1, 0, 'L' , true );
	$mipdf -> Cell( 14, 10 , $LatitudInicial, 1, 0, 'R' , true );
	$mipdf -> Cell( 11, 10 , $canorienlati, 1, 0, 'L' , true );
	$mipdf -> Cell( 14, 10 , $LongitudInicial, 1, 0, 'R' , true );
	$mipdf -> Cell( 11, 10 , $canorienloni, 1, 0, 'L' , true );
	$mipdf -> Cell( 14, 10 , $LatitudFinal, 1, 0, 'R' , true );
	$mipdf -> Cell( 11, 10 , $canorienlatf, 1, 0, 'L' , true );
	$mipdf -> Cell( 14, 10 , $LongitudFinal, 1, 0, 'R' , true );
	$mipdf -> Cell( 11, 10 , $canorienlonf, 1, 0, 'L' , true );
	$mipdf -> Ln(10);
}
$mipdf -> Output('Pdf_Canal.pdf','I');
?>