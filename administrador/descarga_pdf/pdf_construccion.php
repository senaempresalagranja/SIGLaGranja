<?php
//llamado a la pagina del formato pdf
include "pdf/pdf.php";
//Definir la conexion a la base de dato
include "../conexion.php";
//crea la clase a descargar definir el formato a pdf

class  MiPDF extends FPDF 
{
//Es el encabezado de la página, la imagen, el titulo, y la fecha del reporte
	public function Header()
	{

		$this -> Image("../img/logo.jpg" , 25 , 25 , 20 , 20);//Margenes de: Izquierda,Arriba,Abajo,Derecha
		$this -> SetFont ( 'Arial' , 'B' , 16 );			
		$this -> Cell( 180, 20 , "BD: siglagranja / Construccion   ", 0 , 0 , 'C' );						
		$this -> Cell( 0, 20 , "   Fecha: ".date("d/m/Y",time()-25200), 0 , 0 ,'R');
		$this -> Ln( 30 );			
	}
//Se define el pie de página, donde se define la paginacion
	public function Footer()
	{
		$this->SetY(-15);//Definicion
		$this->AliasNbPages();//Identificador de la página
		$this->SetFont('Arial','I',10);//Define tamaño y tipo de fuente 
		$this->SetTextColor(0);//Define color de texto
	$this->Cell(0,10,'Pagina '.$this->PageNo().' de {nb}',0,0,'C'); //Muestra la página, el parametro {nb} es generado por una funcion llamada AliasNbPages 
	}	
}
//Cuerpo del reporte
$mipdf = new MiPDF('P','mm','A4');//Tipo de papel
$mipdf->SetMargins(22, 25, 25 , 15); //Margenes de: Izquierda,Arriba,Abajo,Derecha
$mipdf->SetAutoPageBreak(true,25);//Activa o desactiva el modo de salto de página automático. Recibe 2 parametros, el primero es un valor booleano(act, desact);  el segundo es la distancia desde la parte inferior de la página.
$conidcodigo = array("CODIGO");
$conunidad = array("UNIDAD");
$connombre = array("NOMBRE");
$conextension = array("EXTENSION");
$contipambien = array("T.AMBIENTE");
$contipconstr = array("T.CONSTRUCCION");
$conestado = array("ESTADO");
$contipcubiert = array("T.CUBIERTA");
$contippiso = array("T.PISO");
$contipmuro = array("T.MURO");
$confecconstr = array("F.CONSTRUCCION");
$confecremode = array("F.REMODELACION");
$coordenadas = array("LATITUD","LONGITUD");
$mipdf -> addPage('A5' , 'legal',20,39);////Orientación de la pagina (Horizontalmente)
//Ciclo para generar los registros, si son demaciados
for ($i = 0; $i < count( $conidcodigo ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 6);//Tipo y tamaño de fuente
	$mipdf -> SetTextColor( 255, 255 ,255);//Color texto
	$mipdf -> SetFillColor(  0 , 0 ,255);//Clor de la cabecera
	$mipdf -> Cell ( 17, 10 , $conidcodigo[ $i ] , 1 , 0 , 'C' , true );//Tamaño y ajuste de texto de los campos
}
for ($i = 0; $i < count( $conunidad ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 6);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 22, 10 , $conunidad[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $connombre ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 6);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 38, 10 , $connombre[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $conextension ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 6);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 20, 10 , $conextension[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $contipambien ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 6);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 28, 10 , $contipambien[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $contipconstr ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 6);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 28, 10 , $contipconstr[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $conestado ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 6);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 15, 10 , $conestado[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $contipcubiert ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 6);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 24, 10 , $contipcubiert[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $contippiso ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 6);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 17, 10 , $contippiso[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $contipmuro ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 6);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 19, 10 , $contipmuro[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $confecconstr ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 5);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 19, 10 , $confecconstr[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $confecremode ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 5);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 19, 10 , $confecremode[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $coordenadas ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 6);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 22, 10 , $coordenadas[ $i ] , 1 , 0 , 'C' , true );	
}
$mipdf -> Ln( 10);//Tamaño vertical de cada campo, registro tras registro

$res=pg_query($con, "SELECT * FROM construccion ORDER BY conidcodigo ASC");
			while($reg=pg_fetch_array($res))
			{
				$unidadmedida= $reg [5];
  				$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$unidadmedida' ");
  				while($reg1=pg_fetch_array($res1))
  				{
  				  $nombre= utf8_decode($reg1[1]);
  				}
			
  				$unidad=$reg[2];
  				$con2=pg_query($con, "SELECT * FROM unidad WHERE uniid='$unidad' ");
  				while($reg1=pg_fetch_array($con2))
  				{
  				  $NomUnidad=$reg1[2];
  				}

	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$conidcodigo = $reg [1];
	$connombre= $reg [3];	
	$conextension= $reg [4];
	$contipambien= $reg [6];
	$contipconstr= $reg [7];
	$conestado= $reg [8];
	$contipcubiert= $reg [9];
	$contippiso= $reg [10];
	$contipmuro= $reg [11];
	$confecconstr= $reg [12];
	$confecremode= $reg [13];
	$conlatitud= $reg [14];
	$conorientlat= $reg [15];
	$conlongitud= $reg [16];
	$conorientlon= $reg [17];
	
	$mipdf -> SetFont( 'Arial' , 'B' , 6);
	$mipdf -> SetTextColor(0,0,0);
	$mipdf -> SetFillColor( 255,255,255);		
	$mipdf -> Cell( 17, 10 , $conidcodigo, 1, 0, 'L' , true );
	$mipdf -> Cell( 22, 10 , $NomUnidad, 1, 0, 'L' , true );
	$mipdf -> Cell( 38, 10 , $connombre, 1, 0, 'L' , true );
	$mipdf -> Cell( 10, 10 , $conextension, 1, 0, 'R' , true );
	$mipdf -> Cell( 10, 10 , $nombre, 1, 0, 'L' , true );
	$mipdf -> Cell( 28, 10 , $contipambien, 1, 0, 'L' , true );
	$mipdf -> Cell( 28, 10 , $contipconstr, 1, 0, 'L' , true );
	$mipdf -> Cell( 15, 10 , $conestado, 1, 0, 'L' , true );
	$mipdf -> Cell( 24, 10 , $contipcubiert, 1, 0, 'L' , true );
	$mipdf -> Cell( 17, 10 , $contippiso, 1, 0, 'L' , true );
	$mipdf -> Cell( 19, 10 , $contipmuro, 1, 0, 'L' , true );
	$mipdf -> Cell( 19, 10 , $confecconstr, 1, 0, 'R' , true );
	$mipdf -> Cell( 19, 10 , $confecremode, 1, 0, 'R' , true );
	$mipdf -> Cell( 13, 10 , $conlatitud, 1, 0, 'R' , true );
	$mipdf -> Cell( 9, 10 , $conorientlat, 1, 0, 'L' , true );
	$mipdf -> Cell( 13, 10 , $conlongitud, 1, 0, 'R' , true );
	$mipdf -> Cell( 9, 10 , $conorientlon, 1, 0, 'L' , true );
	$mipdf -> Ln( 10);	
}   
$mipdf -> Output('Pdf_Construccion.pdf','I');//Nombre de descarga y Tipo de Visualización
?>


