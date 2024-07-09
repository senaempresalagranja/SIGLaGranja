<?php
include "pdf/pdf.php";
include "../conexion.php";

class  MiPDF extends FPDF 
{

	public function Header()
	{
		$this -> Image("../img/logo.jpg" , 25 , 25 , 20 , 20);
		$this -> SetFont ( 'Arial' , 'B' , 16 );
		$this -> Cell( 180, 20 , "BD: siglagranja / Red Gas  ", 0 , 0 , 'C' );					
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
$mipdf->SetMargins(49, 25, 15, 5);
$mipdf->SetAutoPageBreak(true,25);
$rgaid = array("CODIGO");//se define los nombre de la cabesera d ela tabla a mostrar
$rgaconstrucc = array("CONSTRUCCION");
$rgatipmateri = array("TIPO MATERIAL");
$NumeroOpciones = array("CONEXIONES","CONTADORES","VALVULAS","SOPORTES");
$mipdf -> addPage('A5' , 'Letter',20,39);

for ($i = 0; $i < count( $rgaid) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 17, 10 , $rgaid[ $i ] , 1 , 0 , 'C' , true );
}
for ($q = 0; $q < count( $rgaconstrucc) ; $q++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 6.8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 50, 10 , $rgaconstrucc[ $q ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $rgatipmateri) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 6.8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 25, 10 , $rgatipmateri[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $NumeroOpciones) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 6.8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 20, 10 , $NumeroOpciones[ $i ] , 1 , 0 , 'C' , true );
}
$mipdf -> Ln(10);

$res=pg_query($con, "SELECT * FROM redgas ORDER BY rgaid ASC");
while($reg=pg_fetch_array($res))
{
	$rgaconstrucc= utf8_decode($reg [1]);		
	$res1=pg_query($con, "SELECT * FROM construccion WHERE conid='$rgaconstrucc' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre=$reg1[3];
	}
		$rgaid=$reg[0];
		$rgatipmateri=$reg[2];
		$rganumvalvul=$reg[3];					
		$rganumconexi=$reg[4];
		$rganumcontad=$reg[5];
		$rganumsoport=$reg[6];

	$mipdf -> SetFont( 'arial' , 'B' , 8);
	$mipdf -> SetTextColor(0,0,0);
	$mipdf -> SetFillColor(255,255,255);
	$mipdf -> Cell( 17, 10 , $rgaid , 1, 0, 'C' , true );
	$mipdf -> Cell( 50, 10 , $nombre , 1, 0, 'L' , true );
	$mipdf -> Cell( 25, 10 , $rgatipmateri , 1, 0, 'L' , true );	
	$mipdf -> Cell( 20, 10 , $rganumconexi , 1, 0, 'R' , true );
	$mipdf -> Cell( 20, 10 , $rganumcontad, 1, 0, 'R' , true );
	$mipdf -> Cell( 20, 10 , $rganumvalvul, 1, 0, 'R' , true );
	$mipdf -> Cell( 20, 10 , $rganumsoport, 1, 0, 'R' , true );
	$mipdf -> Ln(10);
}
$mipdf -> Output('Pdf_RedGas.pdf','I');
?>