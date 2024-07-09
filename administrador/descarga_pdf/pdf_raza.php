<?php
include "pdf/pdf.php";
include "../conexion.php";

class  MiPDF extends FPDF 
{

	public function Header()
	{
		$this -> Image("../img/logo.jpg" , 25 , 25 , 20 , 20);
		$this -> SetFont ( 'Arial' , 'B' , 16 );
		$this -> Cell( 180, 20 , "BD: siglagranja / Raza  ", 0 , 0 , 'C' );					
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
$mipdf = new MiPDF('P','mm','A4');
$mipdf->SetMargins(57, 25, 15, 5);
$mipdf->SetAutoPageBreak(true,25);
$razid = array("CODIGO");//se define los nombre de la cabesera d ela tabla a mostrar
$raznombre = array("NOMBRE");
$razorigen = array("ORIGEN");
$razlugorigen = array("LUGAR ORIGEN");
$razproposito = array("PROPOSITO");
$razproducion = array("PRODUCCION");
$mipdf -> addPage('A5' , 'Letter',20,39);

for ($i = 0; $i < count( $razid) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 16, 10 , $razid[ $i ] , 1 , 0 , 'C' , true );
}
for ($q = 0; $q < count( $raznombre) ; $q++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 40, 10 , $raznombre[ $q ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $razorigen) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 20, 10 , $razorigen[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $razlugorigen) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 26, 10 , $razlugorigen[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $razproposito) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 35, 10 , $razproposito[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $razproducion) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 25, 10 , $razproducion[ $i ] , 1 , 0 , 'C' , true );
}
$mipdf -> Ln(10);

$res=pg_query($con, "SELECT * FROM raza ORDER BY raznombre ASC");
while($reg=pg_fetch_array($res))
{
	$razunimedpro= utf8_decode($reg [6]);		
	$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$razunimedpro' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre=$reg1[1];
	}
						$razid=$reg[0];
						$raznombre= utf8_decode($reg[1]);
						$razorigen=$reg[2];
						$razlugorigen=$reg[3];					
						$razproposito=$reg[4];
						$razproducion=$reg[5];


	$mipdf -> SetFont( 'arial' , 'B' , 8);
	$mipdf -> SetTextColor(0,0,0);
	$mipdf -> SetFillColor(255,255,255);
	$mipdf -> Cell( 16, 10 , $razid , 1, 0, 'C' , true );
	$mipdf -> Cell( 40, 10 , $raznombre , 1, 0, 'L' , true );
	$mipdf -> Cell( 20, 10 , $razorigen , 1, 0, 'L' , true );
	$mipdf -> Cell( 26, 10 , $razlugorigen, 1, 0, 'L' , true );
	$mipdf -> Cell( 35, 10 , $razproposito , 1, 0, 'L' , true );	
	$mipdf -> Cell( 14.5, 10 , $razproducion, 1, 0, 'R' , true );
	$mipdf -> Cell( 10.5, 10 , $nombre, 1, 0, 'L' , true );
	$mipdf -> Ln(10);
}
$mipdf -> Output('Pdf_Raza.pdf','I');
?>