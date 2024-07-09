<?php
include "pdf/pdf.php";
include "../conexion.php";

class  MiPDF extends FPDF 
{

	public function Header()
	{
		$this -> Image("../img/logo.jpg" , 25 , 25 , 20 , 20);
		$this -> SetFont ( 'Arial' , 'B' , 16 );
		$this -> Cell( 200, 20 , "BD: siglagranja / Puntos Especiales  ", 0 , 0 , 'C' );					
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
$mipdf->SetMargins(26, 25, 15, 5);
$mipdf->SetAutoPageBreak(true,15);
$pesid = array("CODIGO");
$pesnombre = array("NOMBRE");
$pesunidad = array("UNIDAD");
$pestippunto = array("TIPO PUNTO");
$coordenadas = array("LATITUD","LONGITUD");
$mipdf -> addPage('A5' , 'Letter',20,39);

for ($q = 0; $q < count( $pesid) ; $q++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 8.5);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 17, 10 , $pesid[ $q ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $pesnombre) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 8.5);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 45, 10 , $pesnombre[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $pesunidad) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 8.5);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 45, 10 , $pesunidad[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $pestippunto) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 8.5);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 50, 10 , $pestippunto[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $coordenadas) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 8.5);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 34, 10 , $coordenadas[ $i ] , 1 , 0 , 'C' , true );
}
$mipdf -> Ln(10);

$res=pg_query($con, "SELECT * FROM puntoespecial ORDER BY pesid ASC");
while($reg=pg_fetch_array($res))
{
	$pesunidad= utf8_decode($reg [1]);		
	$res1=pg_query($con, "SELECT * FROM unidad WHERE uniid='$pesunidad' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre=$reg1[2];
	}
	
						$pesid=utf8_decode($reg[0]);
						$pesnombre=utf8_decode($reg[2]);
						$pestippunto=utf8_decode($reg[3]);
						$peslatitud=utf8_decode($reg[4]);
						$pesorientlat=utf8_decode($reg[5]);						
						$peslongitud=utf8_decode($reg[6]);
						$pesorientlog=utf8_decode($reg[7]);

	$mipdf -> SetFont( 'arial' , 'B' , 8);
	$mipdf -> SetTextColor(0,0,0);
	$mipdf -> SetFillColor(255,255,255);
	$mipdf -> Cell( 17, 10 , $pesid , 1, 0, 'C' , true );
	$mipdf -> Cell( 45, 10 , $pesnombre , 1, 0, 'L' , true );
	$mipdf -> Cell( 45, 10 , $nombre , 1, 0, 'L' , true );
	$mipdf -> Cell( 50, 10 , $pestippunto, 1, 0, 'L' , true );
	$mipdf -> Cell( 20, 10 , $peslatitud , 1, 0, 'R' , true );
	$mipdf -> Cell( 14, 10 , $pesorientlat, 1, 0, 'L' , true );
	$mipdf -> Cell( 20, 10 , $peslongitud, 1, 0, 'R' , true );
	$mipdf -> Cell( 14, 10 , $pesorientlog, 1, 0, 'L' , true );
	$mipdf -> Ln(10);
}
$mipdf -> Output('Pdf_PuntosEspeciales.pdf','I');
?>