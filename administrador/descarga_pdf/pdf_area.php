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
		$this -> Cell( 180, 20 , "BD: siglagranja / Area   ", 0 , 0 , 'C' );						
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
$mipdf->SetMargins(5, 25, 25 , 15); //Margenes de: Izquierda,Arriba,Abajo,Derecha
$mipdf->SetAutoPageBreak(true,25);//Activa o desactiva el modo de salto de página automático. Recibe 2 parametros, el primero es un valor booleano(act, desact);  el segundo es la distancia desde la parte inferior de la página.
$cabecera = array("CODIGO");
$cabecera1 = array("NOMBRE","EXTENSION");
$cabecera2 = array("RESPONSABLE");
$cabecera3 = array("LATITUD","LONGITUD");
$mipdf -> addPage('A5' , 'Letter',20,39);////Orientación de la pagina (Horizontalmente)
//Ciclo para generar los registros, si son demaciados
for ($i = 0; $i < count( $cabecera ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 11);//Tipo y tamaño de fuente
	$mipdf -> SetTextColor( 255, 255 ,255);//Color texto
	$mipdf -> SetFillColor(  0 , 0 ,255);//Clor de la cabecera
	$mipdf -> Cell ( 25, 10 , $cabecera[ $i ] , 1 , 0 , 'C' , true );//Tamaño y ajuste de texto de los campos
}
for ($i = 0; $i < count( $cabecera1 ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 11);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 35, 10 , $cabecera1[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $cabecera2 ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 11);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 75, 10 , $cabecera2[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $cabecera3 ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 11);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 50, 10 , $cabecera3[ $i ] , 1 , 0 , 'C' , true );	
}
$mipdf -> Ln( 10);//Tamaño vertical de cada campo, registro tras registro

$res=pg_query($con, "SELECT * FROM area ORDER BY areidcodigo ASC");
while($reg=pg_fetch_array($res))
{
	$uniid= utf8_decode($reg [4]);
	$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$uniid' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nombre=utf8_decode($reg1[1]);
	}

	$mipdf -> SetFont( 'Arial' , 'B' , 7);
	$areidcodigo = utf8_decode($reg [1]);	
	$arenombre= utf8_decode($reg [2]);
	$areextension= utf8_decode($reg [3]);	
	$arecoordinad= utf8_decode($reg [5]);
	$arelatitud= utf8_decode($reg [6]);
	$areorientlat= utf8_decode($reg [7]);
	$arelongitud= utf8_decode($reg [8]);
	$areorientlon= utf8_decode($reg [9]);
	
	$mipdf -> SetFont( 'Arial' , 'B' , 10);
	$mipdf -> SetTextColor(0,0,0);
	$mipdf -> SetFillColor( 255,255,255);		
	$mipdf -> Cell( 25, 10 , $areidcodigo, 1, 0, 'C' , true );
	$mipdf -> Cell( 35, 10 , $arenombre, 1, 0, 'L' , true );
	$mipdf -> Cell( 23, 10 , $areextension, 1, 0, 'R' , true );
	$mipdf -> Cell( 12, 10 , $nombre, 1, 0, 'L' , true );
	$mipdf -> Cell( 75, 10 , $arecoordinad , 1, 0, 'L' , true );
	$mipdf -> Cell( 30, 10 , $arelatitud, 1, 0, 'R' , true );
	$mipdf -> Cell( 20, 10 , $areorientlat, 1, 0, 'L' , true );
	$mipdf -> Cell( 30, 10 , $arelongitud, 1, 0, 'R' , true );
	$mipdf -> Cell( 20, 10 , $areorientlon, 1, 0, 'L' , true );
	$mipdf -> Ln( 10);	
}   
$mipdf -> Output('Pdf_Area.pdf','I');//Nombre de descarga y Tipo de Visualización
?>


