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
		$this -> Cell( 180, 20 , "BD: siglagranja / Zona Verde   ", 0 , 0 , 'C' );						
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
$mipdf->SetMargins(24, 25, 25 , 15); //Margenes de: Izquierda,Arriba,Abajo,Derecha
$mipdf->SetAutoPageBreak(true,25);//Activa o desactiva el modo de salto de página automático. Recibe 2 parametros, el primero es un valor booleano(act, desact);  el segundo es la distancia desde la parte inferior de la página.
$zveidcodigo = array("CODIGO");
$zveunidad = array("UNIDAD");
$zveextension = array("EXTENSION");
$zvetipriego = array("TIPO RIEGO");
$coordenadas = array("LATITUD","LONGITUD");
$mipdf -> addPage('A5' , 'letter',20,39);////Orientación de la pagina (Horizontalmente)
//Ciclo para generar los registros, si son demaciados
for ($i = 0; $i < count( $zveidcodigo ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 10);//Tipo y tamaño de fuente
	$mipdf -> SetTextColor( 255, 255 ,255);//Color texto
	$mipdf -> SetFillColor(  0 , 0 ,255);//Clor de la cabecera
	$mipdf -> Cell ( 35, 10 , $zveidcodigo[ $i ] , 1 , 0 , 'C' , true );//Tamaño y ajuste de texto de los campos
}
for ($i = 0; $i < count( $zveunidad ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 10);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 50, 10 , $zveunidad[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $zveextension ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 10);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 25, 10 , $zveextension[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $zvetipriego ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 10);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 30, 10 , $zvetipriego[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $coordenadas ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 10);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 46, 10 , $coordenadas[ $i ] , 1 , 0 , 'C' , true );	
}
$mipdf -> Ln( 10);//Tamaño vertical de cada campo, registro tras registro

$res=pg_query($con, "SELECT * FROM zonaverde ORDER BY zveidcodigo ASC");
			while($reg=pg_fetch_array($res))
			{
				$unidad=$reg[2];
  				$con2=pg_query($con, "SELECT * FROM unidad WHERE uniid='$unidad' ");
  				while($reg1=pg_fetch_array($con2))
  				{
  				  $NomUnidad=utf8_decode($reg1[2]);
  				}

  				$unidadmedida= utf8_decode($reg [5]);
  				$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$unidadmedida' ");
  				while($reg1=pg_fetch_array($res1))
  				{
  				  $nombre= utf8_decode($reg1[1]);
  				}

				$zveidcodigo=utf8_decode($reg[1]);
				$zvetipriego=utf8_decode($reg[3]);
				$zveextension=utf8_decode($reg[4]);
				$zvelatitud=utf8_decode($reg[6]);
				$zveorientlat=utf8_decode($reg[7]);
				$zvelongitud=utf8_decode($reg[8]);
				$zveorientlon=utf8_decode($reg[9]);
	
	$mipdf -> SetFont( 'Arial' , 'B' , 10);
	$mipdf -> SetTextColor(0,0,0);
	$mipdf -> SetFillColor( 255,255,255);
	$mipdf -> Cell( 35, 10 , $zveidcodigo, 1, 0, 'C' , true );
	$mipdf -> Cell( 50, 10 , $NomUnidad, 1, 0, 'L' , true );	
	$mipdf -> Cell( 12.5, 10 , $zveextension, 1, 0, 'R' , true );
	$mipdf -> Cell( 12.5, 10 , $nombre, 1, 0, 'L' , true );
	$mipdf -> Cell( 30, 10 , $zvetipriego, 1, 0, 'L' , true );
	$mipdf -> Cell( 25, 10 , $zvelatitud, 1, 0, 'R' , true );
	$mipdf -> Cell( 21, 10 , $zveorientlat, 1, 0, 'L' , true );
	$mipdf -> Cell( 25, 10 , $zvelongitud, 1, 0, 'R' , true );
	$mipdf -> Cell( 21, 10 , $zveorientlon, 1, 0, 'L' , true );
	$mipdf -> Ln( 10);	
}   
$mipdf -> Output('Pdf_ZonaVerde.pdf','I');//Nombre de descarga y Tipo de Visualización
?>


