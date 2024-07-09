<?php
include "pdf/pdf.php";
include "../conexion.php";

class  MiPDF extends FPDF 
{

	public function Header()
	{
		$this -> Image("../img/logo.jpg" , 25 , 25 , 20 , 20);
		$this -> SetFont ( 'Arial' , 'B' , 16 );
		$this -> Cell( 180, 20 , "BD: siglagranja / Red Logica  ", 0 , 0 , 'C' );					
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
$mipdf->SetMargins(12, 25, 15, 3);
$mipdf->SetAutoPageBreak(true,25);
$rloid = array("CODIGO");
$rloconstrucc = array("CONSTRUCCION");
$rlozonawifi = array("ZONA WIFI");
$rlocantacces = array("ACCES POIT");
$rloredalambr = array("RED ALAMBRICA");
$rlocantanale = array("LONG. CANALETAS");
$rlocantrj = array("RJ-45");
$rlocantfibop = array("FIBRA OPTICA");
$rlocategoutp = array("CABLE UTP");
$rlotopologia = array("TIPOLOGIA");
$rlodistribuc = array("DISTRIBUCION");
$rlorack = array("RACK");
$rlocantswitc = array("SWITCH");
$rlocantregle = array("REGLETAS");
$rlocantups = array("UPS");
$mipdf -> addPage('A5' , 'legal',20,39);

for ($i = 0; $i < count( $rloid) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 17, 10 , $rloid[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $rloconstrucc) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 7.4);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 40, 10 , $rloconstrucc[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $rlozonawifi) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 7.4);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 17, 10 , $rlozonawifi[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $rlocantacces) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 7.4);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 20, 10 , $rlocantacces[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $rloredalambr) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 7.4);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 27, 10 , $rloredalambr[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $rlocantanale) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 7.4);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 29, 10 , $rlocantanale[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $rlocantrj) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 7.4);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 17, 10 , $rlocantrj[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $rlocantfibop) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 7.4);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 22, 10 , $rlocantfibop[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $rlocategoutp) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 7.4);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 20, 10 , $rlocategoutp[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $rlotopologia) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 7.4);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 20, 10 , $rlotopologia[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $rlodistribuc) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 7.4);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 22, 10 , $rlodistribuc[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $rlorack) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 7.4);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 20, 10 , $rlorack[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $rlocantswitc) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 7.4);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 20, 10 , $rlocantswitc[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $rlocantregle) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 7.4);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 20, 10 , $rlocantregle[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $rlocantups) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 7.4);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 20, 10 , $rlocantups[ $i ] , 1 , 0 , 'C' , true );
}
$mipdf -> Ln(10);

$res=pg_query($con, "SELECT * FROM redlogica ORDER BY rloid ASC");
    while($reg=pg_fetch_array($res))
    {
      $rsaconstrucc= utf8_decode($reg [1]);   
      $res1=pg_query($con, "SELECT * FROM construccion WHERE conid='$rsaconstrucc' ");
      while($reg1=pg_fetch_array($res1))
      {
        $nombre=$reg1[3];
      }

      $rlounimedcca= utf8_decode($reg [6]);   
      $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$rlounimedcca' ");
      while($reg1=pg_fetch_array($res1))
      {
        $nombre1=$reg1[2];
      }
                $rloid=$reg[0];
                $rlozonawifi=$reg[2];
                $rlocantacces=$reg[3];         
                $rloredalambr=$reg[4];
                $rlocantanale=$reg[5];
                $rlocantrj=$reg[7];
                $rlocantfibop=$reg[8];
                $rlocategoutp=$reg[9];
                $rlotopologia=$reg[10];
                $rlodistribuc=$reg[11];
                $rlorack=$reg[12];
                $rlocantswitc=$reg[13];
                $rlocantregle=$reg[14];
                $rlocantups=$reg[15];

	$mipdf -> SetFont( 'arial' , 'B' , 8);
	$mipdf -> SetTextColor(0,0,0);
	$mipdf -> SetFillColor(255,255,255);
	$mipdf -> Cell( 17, 10 , $rloid , 1, 0, 'C' , true );
	$mipdf -> Cell( 40, 10 , $nombre , 1, 0, 'L' , true );
	$mipdf -> Cell( 17, 10 , $rlozonawifi , 1, 0, 'L' , true );
	$mipdf -> Cell( 20, 10 , $rlocantacces, 1, 0, 'R' , true );
	$mipdf -> Cell( 27, 10 , $rloredalambr , 1, 0, 'L' , true );
	$mipdf -> Cell( 14, 10 , $rlocantanale, 1, 0, 'R' , true );
	$mipdf -> Cell( 15, 10 , $rlocantanale, 1, 0, 'L' , true );
	$mipdf -> Cell( 17, 10 , $rlocantrj, 1, 0, 'R' , true );
	$mipdf -> Cell( 22, 10 , $rlocantfibop, 1, 0, 'R' , true );
	$mipdf -> Cell( 20, 10 , $rlocategoutp, 1, 0, 'L' , true );
	$mipdf -> Cell( 20, 10 , $rlotopologia, 1, 0, 'L' , true );
	$mipdf -> Cell( 22, 10 , $rlodistribuc, 1, 0, 'L' , true );
	$mipdf -> Cell( 20, 10 , $rlorack, 1, 0, 'L' , true );
	$mipdf -> Cell( 20, 10 , $rlocantswitc, 1, 0, 'R' , true );
	$mipdf -> Cell( 20, 10 , $rlocantregle, 1, 0, 'R' , true );
	$mipdf -> Cell( 20, 10 , $rlocantups, 1, 0, 'R' , true );
	$mipdf -> Ln(10);
}
$mipdf -> Output('Pdf_RedLogica.pdf','I');
?>