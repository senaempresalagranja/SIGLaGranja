<?php
include "pdf/pdf.php";
include "../conexion.php";

class  MiPDF extends FPDF 
{

	public function Header()
	{
		$this -> Image("../img/logo.jpg" , 25 , 25 , 20 , 20);
		$this -> SetFont ( 'Arial' , 'B' , 16 );
		$this -> Cell( 180, 20 , "BD: siglagranja / Estanque  ", 0 , 0 , 'C' );					
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
$mipdf->SetMargins(55, 25, 15, 55);
$mipdf->SetAutoPageBreak(true,25);
$estid = array("CODIGO");//se define los nombre de la cabesera d ela tabla a mostrar
$estnombre = array("NOMBRE");
$esttipestanq = array("TIPO");
$estprofundid = array("PROFUNDIDAD");
$estespejagua = array("ESPEJO AGUA");
$estvolumagua = array("VOLUMEN AGUA");
$mipdf -> addPage('A5' , 'Letter',20,39);

for ($i = 0; $i < count( $estid) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 20, 10 , $estid[ $i ] , 1 , 0 , 'C' , true );
}
for ($q = 0; $q < count( $estnombre) ; $q++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 30, 10 , $estnombre[ $q ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $esttipestanq) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 25, 10 , $esttipestanq[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $estprofundid) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 30, 10 , $estprofundid[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $estespejagua) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 30, 10 , $estespejagua[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $estvolumagua) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 30, 10 , $estvolumagua[ $i ] , 1 , 0 , 'C' , true );
}
$mipdf -> Ln(10);

$res=pg_query($con, "SELECT * FROM estanque ORDER BY estnombre ASC");
while($reg=pg_fetch_array($res))
{
	$estunimedpro= utf8_decode($reg [4]);		
	$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$estunimedpro' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre=utf8_decode($reg1[1]);
	}
	$estunimedesp=utf8_decode($reg[6]);	
	$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$estunimedesp' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre1=utf8_decode($reg1[1]);
	}
	$estunimedvol=utf8_decode($reg[8]);
	$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$estunimedvol' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre2=utf8_decode($reg1[1]);
	}
	
	$estid=$reg[0];
	$estnombre=$reg[1];
	$esttipestanq=$reg[2];
	$estprofundid=$reg[3];
	$estespejagua=$reg[5];
	$estvolumagua=$reg[7];




	$mipdf -> SetFont( 'arial' , 'B' , 9);
	$mipdf -> SetTextColor(0,0,0);
	$mipdf -> SetFillColor(255,255,255);
	$mipdf -> Cell( 20, 10 , $estid , 1, 0, 'C' , true );
	$mipdf -> Cell( 30, 10 , $estnombre , 1, 0, 'L' , true );
	$mipdf -> Cell( 25, 10 , $esttipestanq , 1, 0, 'L' , true );
	$mipdf -> Cell( 15, 10 , $estprofundid, 1, 0, 'R' , true );
	$mipdf -> Cell( 15, 10 , $nombre, 1, 0, 'L' , true );
	$mipdf -> Cell( 15, 10 , $estespejagua , 1, 0, 'R' , true );
	$mipdf -> Cell( 15, 10 , $nombre1, 1, 0, 'L' , true );
	$mipdf -> Cell( 15, 10 , $estvolumagua, 1, 0, 'R' , true );
	$mipdf -> Cell( 15, 10 , $nombre2, 1, 0, 'L' , true );
	$mipdf -> Ln(10);
}
$mipdf -> Output('Pdf_Estanque.pdf','I');
?>