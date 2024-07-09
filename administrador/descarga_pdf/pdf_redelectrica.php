<?php
include "pdf/pdf.php";
include "../conexion.php";

class  MiPDF extends FPDF 
{

	public function Header()
	{
		$this -> Image("../img/logo.jpg" , 25 , 25 , 20 , 20);
		$this -> SetFont ( 'Arial' , 'B' , 16 );
		$this -> Cell( 180, 20 , "BD: siglagranja / Red Electrica  ", 0 , 0 , 'C' );					
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
$mipdf->SetMargins(20, 25, 15, 5);
$mipdf->SetAutoPageBreak(true,25);
$eleid = array("CODIGO");
$eleconstrucc = array("CONSTRUCCION");
$elenumlampar = array("LAMPARAS");
$tomar = array("TOMA REGULADO");
$tomanr = array("TOMA NO REGULADO");
$elenumtomaco = array("TOMA TRIFASICO");
$elenuminterr = array("INTERRUPTORES");
$eletipventil = array("TIPO VENTILACION");
$elecantidad = array("CANTIDAD");
$mipdf -> addPage('A5' , 'Letter',20,39);

for ($i = 0; $i < count( $eleid) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 17, 10 , $eleid[ $i ] , 1 , 0 , 'C' , true );
}
for ($q = 0; $q < count( $eleconstrucc) ; $q++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 6.8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 49, 10 , $eleconstrucc[ $q ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $elenumlampar) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 6.8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 19, 10 , $elenumlampar[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $elenumtomaco) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 6.8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 25, 10 , $elenumtomaco[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $tomar) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 6.8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 25, 10 , $tomar[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $tomanr) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 6.8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 25, 10 , $tomanr[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $elenuminterr) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 6.8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 25, 10 , $elenuminterr[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $eletipventil) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 6.8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 40, 10 , $eletipventil[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $elecantidad) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 6.8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 17, 10 , $elecantidad[ $i ] , 1 , 0 , 'C' , true );
}
$mipdf -> Ln(10);

$res=pg_query($con, "SELECT * FROM redelectrica ORDER BY eleid ASC");
while($reg=pg_fetch_array($res))
{
	$eleconstrucc= utf8_decode($reg [1]);		
	$res1=pg_query($con, "SELECT * FROM construccion WHERE conid='$eleconstrucc' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre=$reg1[3];
	}
		$eleid=$reg[0];
		$elenumlampar=$reg[2];
		$elenumtomaco=$reg[3];					
		$elenuminterr=$reg[4];
		$eletipventil=$reg[5];
		$elecantidad=$reg[6];
		$tomar=$reg[8];
		$tomanr=$reg[9];

	$mipdf -> SetFont( 'arial' , 'B' , 8);
	$mipdf -> SetTextColor(0,0,0);
	$mipdf -> SetFillColor(255,255,255);
	$mipdf -> Cell( 17, 10 , $eleid , 1, 0, 'C' , true );
	$mipdf -> Cell( 49, 10 , $nombre , 1, 0, 'L' , true );
	$mipdf -> Cell( 19, 10 , $elenumlampar , 1, 0, 'R' , true );
	$mipdf -> Cell( 25, 10 , $elenumtomaco, 1, 0, 'R' , true );
	$mipdf -> Cell( 25, 10 , $tomar, 1, 0, 'R' , true );
	$mipdf -> Cell( 25, 10 , $tomanr, 1, 0, 'R' , true );
	$mipdf -> Cell( 25, 10 , $elenuminterr , 1, 0, 'R' , true );
	$mipdf -> Cell( 40, 10 , $eletipventil, 1, 0, 'L' , true );
	$mipdf -> Cell( 17, 10 , $elecantidad, 1, 0, 'R' , true );
	$mipdf -> Ln(10);
}
$mipdf -> Output('Pdf_RedElectrica.pdf','I');
?>