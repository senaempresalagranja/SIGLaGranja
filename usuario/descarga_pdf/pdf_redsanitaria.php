<?php
include "pdf/pdf.php";
include "../conexion.php";

class  MiPDF extends FPDF 
{

	public function Header()
	{
		$this -> Image("../img/logo.jpg" , 25 , 25 , 20 , 20);
		$this -> SetFont ( 'Arial' , 'B' , 16 );
		$this -> Cell( 180, 20 , "BD: siglagranja / Red Sanitaria  ", 0 , 0 , 'C' );					
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
$mipdf->SetMargins(48, 25, 15, 5);
$mipdf->SetAutoPageBreak(true,25);
$rsaid = array("CODIGO");//se define los nombre de la cabesera d ela tabla a mostrar
$rsaconstrucc = array("CONSTRUCCION");
$rsannumbater = array("BATERIAS SANITARIAS");
$NumObjetosSani = array("DUCHAS","LAVAMANOS","GRIFOS","SIFONES");
$mipdf -> addPage('A5' , 'Letter',20,39);

for ($i = 0; $i < count( $rsaid) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 17, 10 , $rsaid[ $i ] , 1 , 0 , 'C' , true );
}
for ($q = 0; $q < count( $rsaconstrucc) ; $q++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 6.8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 50, 10 , $rsaconstrucc[ $q ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $rsannumbater) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 6.8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 32, 10 , $rsannumbater[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $NumObjetosSani) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 6.8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 20, 10 , $NumObjetosSani[ $i ] , 1 , 0 , 'C' , true );
}
$mipdf -> Ln(10);

$res=pg_query($con, "SELECT * FROM redsanitaria ORDER BY rsaid ASC");
while($reg=pg_fetch_array($res))
{
	$rsaconstrucc= utf8_decode($reg [1]);		
	$res1=pg_query($con, "SELECT * FROM construccion WHERE conid='$rsaconstrucc' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre=$reg1[3];
	}
		$rsaid=$reg[0];
		$rsannumbater=$reg[2];
		$rsanumducha=$reg[3];					
		$rsanumlavama=$reg[4];
		$sannumgrifos=$reg[5];
		$sannumsifon=$reg[6];

	$mipdf -> SetFont( 'arial' , 'B' , 8);
	$mipdf -> SetTextColor(0,0,0);
	$mipdf -> SetFillColor(255,255,255);
	$mipdf -> Cell( 17, 10 , $rsaid , 1, 0, 'C' , true );
	$mipdf -> Cell( 50, 10 , $nombre , 1, 0, 'L' , true );
	$mipdf -> Cell( 32, 10 , $rsannumbater , 1, 0, 'R' , true );
	$mipdf -> Cell( 20, 10 , $rsanumducha, 1, 0, 'R' , true );
	$mipdf -> Cell( 20, 10 , $rsanumlavama , 1, 0, 'R' , true );
	$mipdf -> Cell( 20, 10 , $sannumgrifos, 1, 0, 'R' , true );
	$mipdf -> Cell( 20, 10 , $sannumsifon, 1, 0, 'R' , true );
	$mipdf -> Ln(10);
}
$mipdf -> Output('Pdf_RedSanitaria.pdf','I');
?>