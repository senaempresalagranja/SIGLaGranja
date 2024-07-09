<?php
include "pdf/pdf.php";
include "../conexion.php";

class  MiPDF extends FPDF 
{

	public function Header()
	{
		$this -> Image("../img/logo.jpg" , 25 , 25 , 20 , 20);
		$this -> SetFont ( 'Arial' , 'B' , 16 );
		$this -> Cell( 180, 20 , "BD: siglagranja / Clima   ", 0 , 0 , 'C' );					
		$this -> Cell( 0, 20 , " Fecha: ".date("d/m/Y",time()-25200), 0 , 0 ,'R');
		$this -> Ln( 30 );
	}

	public function Footer()
	{
		$this->SetY(-15); 
		$this->AliasNbPages();
		$this->SetFont('Arial','I',10);// tipo de letra y tamaños
		$this->SetTextColor(0);//color del texto
		$this->Cell(0,10,'Pagina '.$this->PageNo().' de {nb}',0,0,'C'); 
	}
}
$mipdf = new MiPDF('P','mm','A4');
$mipdf->SetMargins(35, 25, 25, 15);//Margenes de: Izquierda,Arriba,Abajo,Derecha
$mipdf->SetAutoPageBreak(true,15);
//se define los nombre de la cabecera de la tabla a mostrar

$cabecera = array("CODIGO");
$cabecera1 = array("HORA");
$cabecera2 = array("FECHA");
$cabecera3 = array("RAD_SOLAR");
$cabecera4 = array("TEMP_AIRE");
$cabecera5 = array("HUM_RELATIVA");
$cabecera6 = array("PRECIPITACION");
$cabecera7 = array("VEL_VIENTO");
$cabeceraD = array("DIRECCION");
$mipdf -> addPage('A5' , 'Letter',10,39);
for ($q = 0; $q < count( $cabecera) ; $q++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 15, 10 , $cabecera[ $q ] , 1 , 0 , 'C' , true );
}
for ($q = 0; $q < count( $cabecera1) ; $q++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 17, 10 , $cabecera1[ $q ] , 1 , 0 , 'C' , true );
}
for ($q = 0; $q < count( $cabecera2) ; $q++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 22, 10 , $cabecera2[ $q ] , 1 , 0 , 'C' , true );
}
for ($q = 0; $q < count( $cabecera3) ; $q++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 26, 10 , $cabecera3[ $q ] , 1 , 0 , 'C' , true );
}
for ($q = 0; $q < count( $cabecera4) ; $q++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 26, 10 , $cabecera4[ $q ] , 1 , 0 , 'C' , true );
}
for ($q = 0; $q < count( $cabecera5) ; $q++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 26, 10 , $cabecera5[ $q ] , 1 , 0 , 'C' , true );
}
for ($q = 0; $q < count( $cabecera6) ; $q++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 26, 10 , $cabecera6[ $q ] , 1 , 0 , 'C' , true );
}
for ($q = 0; $q < count( $cabecera7) ; $q++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 26, 10 , $cabecera7[ $q ] , 1 , 0 , 'C' , true );
}
for ($q = 0; $q < count( $cabeceraD) ; $q++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> Cell ( 22, 10 , $cabeceraD[ $q ] , 1 , 0 , 'C' , true );
}

$mipdf -> Ln( 10);//Separacion del la Cabecera al Contenido

$res=pg_query($con, "SELECT * FROM clima order by cliid ASC");
while($reg=pg_fetch_array($res))
{
	$cliunimedrad= $reg [4];		
	$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$cliunimedrad' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre=$reg1[1];
	}
	$cliunimedtem=$reg[6];	
	$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$cliunimedtem' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre1= utf8_decode($reg1[1]);
	}
	$cliunimedvel=$reg[8];
	$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$cliunimedvel' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre2=$reg1[1];
	}
	$cliunimedhum=$reg[10];
	$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$cliunimedhum' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre3=$reg1[1];
	}
	$cliunimedpre= $reg [12];		
	$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$cliunimedpre' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre4=$reg1[1];
	}
	
	$cliid=$reg[0];
	$clihora=$reg[1];
	$clifecha=$reg[2];
	$cliradisolar=$reg[3];
	$clitempeaire=$reg[5];
	$clihumeralat=$reg[7];
	$cliprecipita=$reg[9];
	$clivelovient=$reg[11];
	$clidireccion=$reg[13];




	$mipdf -> SetFont( 'arial' , 'B' , 10);
	$mipdf -> SetTextColor(0,0,0);
	$mipdf -> SetFillColor(255,255,255);
	$mipdf -> Cell( 15, 10 , $cliid , 1, 0, 'C' , true );
	$mipdf -> Cell( 17, 10 , $clihora , 1, 0, 'R' , true );
	$mipdf -> Cell( 22, 10 , $clifecha , 1, 0, 'R' , true );
	$mipdf -> Cell( 14, 10 , $cliradisolar , 1, 0, 'R' , true );
	$mipdf -> Cell( 12, 10 , $nombre , 1, 0, 'L' , true );
	$mipdf -> Cell( 14, 10 , $clitempeaire , 1, 0, 'R' , true );
	$mipdf -> Cell( 12, 10 , $nombre1, 1, 0, 'L' , true );
	$mipdf -> Cell( 14, 10 , $clihumeralat, 1, 0, 'R' , true );
	$mipdf -> Cell( 12, 10 , $nombre3, 1, 0, 'L' , true );
	$mipdf -> Cell( 14, 10 , $cliprecipita, 1, 0, 'R' , true );
	$mipdf -> Cell( 12, 10 , $nombre4, 1, 0, 'L' , true );
	$mipdf -> Cell( 14, 10 , $clivelovient, 1, 0, 'R' , true );
	$mipdf -> Cell( 12, 10 , $nombre2, 1, 0, 'L' , true );
	$mipdf -> Cell( 22, 10 , $clidireccion, 1, 0, 'C' , true );
	$mipdf -> Ln( 10);
}
$mipdf -> Output('Pdf_Clima.pdf','I');
?>