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
		$this -> Cell( 180, 20 , "BD: siglagranja / Cultivo   ", 0 , 0 , 'C' );						
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
$mipdf->SetMargins(16, 25, 25 , 15); //Margenes de: Izquierda,Arriba,Abajo,Derecha
$mipdf->SetAutoPageBreak(true,25);//Activa o desactiva el modo de salto de página automático. Recibe 2 parametros, el primero es un valor booleano(act, desact);  el segundo es la distancia desde la parte inferior de la página.
$cabecera = array("CODIGO");
$cabecera1 = array("NOM-COMUN");
$cabecera2 = array("NOM-CIENTIFICO");
$cabecera3 = array("ORIGEN");
$cabecera4 = array("LUG-ORIGEN");
$cabecera5 = array("DIST-SIEMBRA");
$cabecera6 = array("CLI-FAVORABLE");
$cabecera7 = array("VIDA UTIL");
$cabecera8 = array("EXTENSION");
$cabecera9 = array("LATITUD");
$cabecera10 = array("LONGITUD");
$mipdf -> addPage('A5' , 'legal',20,39);////Orientación de la pagina (Horizontalmente)
//Ciclo para generar los registros, si son demaciados
for ($i = 0; $i < count( $cabecera ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 8);//Tipo y tamaño de fuente
	$mipdf -> SetTextColor( 255, 255 ,255);//Color texto
	$mipdf -> SetFillColor(  0 , 0 ,255);//Clor de la cabecera
	$mipdf -> Cell ( 20, 10 , $cabecera[ $i ] , 1 , 0 , 'C' , true );//Tamaño y ajuste de texto de los campos
}
for ($i = 0; $i < count( $cabecera1 ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 50, 10 , $cabecera1[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $cabecera2 ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 50, 10 , $cabecera2[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $cabecera3 ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 15, 10 , $cabecera3[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $cabecera4 ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 25, 10 , $cabecera4[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $cabecera5 ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 25, 10 , $cabecera5[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $cabecera6 ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 25, 10 , $cabecera6[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $cabecera7 ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 25, 10 , $cabecera7[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $cabecera8 ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 25, 10 , $cabecera8[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $cabecera9 ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 32, 10 , $cabecera9[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $cabecera10 ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 32, 10 , $cabecera10[ $i ] , 1 , 0 , 'C' , true );	
}
$mipdf -> Ln( 10);//Tamaño vertical de cada campo, registro tras registro

$res=pg_query($con, "SELECT * FROM cultivo ORDER BY culidcodigo ASC");
while($reg=pg_fetch_array($res))
{
	$umeid= utf8_decode($reg [8]);
	$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$umeid' ");
	while($reg1=pg_fetch_array($res1))
	{
		$nomunidad=utf8_decode($reg1[1]);
	}

	$umeid1= utf8_decode($reg [12]);
	$res2=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$umeid1' ");
	while($reg2=pg_fetch_array($res2))
	{
		$nomunidad1=utf8_decode($reg2[1]);
	}

	$mipdf -> SetFont( 'Arial' , 'B' , 7);
	$culidcodigo=utf8_decode($reg [1]);
	$culnomcomun=utf8_decode($reg [2]);
	$culnomcienti=utf8_decode($reg [3]);
	$culorigen=utf8_decode($reg [4]);
	$cullugarorig=utf8_decode($reg [5]);
	$culclimafavo=utf8_decode($reg [6]);
	$culdistsiemb=utf8_decode($reg [7]);
	$culvidautil=utf8_decode($reg [9]);
	$cultiempvida=utf8_decode($reg [10]);
	$culextension=utf8_decode($reg [11]);
	$cullatitud=utf8_decode($reg [13]);
	$culorientlat=utf8_decode($reg [14]);
	$cullongitud=utf8_decode($reg [15]);
	$culorientlon=utf8_decode($reg [16]);
	
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor(0,0,0);
	$mipdf -> SetFillColor( 255,255,255);		
	$mipdf -> Cell( 20, 10 , $culidcodigo, 1, 0, 'L' , true );
	$mipdf -> Cell( 50, 10 , $culnomcomun, 1, 0, 'L' , true );
	$mipdf -> Cell( 50, 10 , $culnomcienti, 1, 0, 'L' , true );
	$mipdf -> Cell( 15, 10 , $culorigen, 1, 0, 'L' , true );
	$mipdf -> Cell( 25, 10 , $cullugarorig, 1, 0, 'L' , true );
	$mipdf -> Cell( 12.5, 10 , $culdistsiemb, 1, 0, 'R' , true );
	$mipdf -> Cell( 12.5, 10 , $nomunidad, 1, 0, 'L' , true );
	$mipdf -> Cell( 25, 10 , $culclimafavo, 1, 0, 'L' , true );
	$mipdf -> Cell( 10, 10 , $culvidautil, 1, 0, 'R' , true );
	$mipdf -> Cell( 15, 10 , $cultiempvida, 1, 0, 'L' , true );
	$mipdf -> Cell( 12.5, 10 , $culextension, 1, 0, 'R' , true );
	$mipdf -> Cell( 12.5, 10 , $nomunidad1, 1, 0, 'L' , true );
	$mipdf -> Cell( 19, 10 , $cullatitud, 1, 0, 'R' , true );
	$mipdf -> Cell( 13, 10 , $culorientlat, 1, 0, 'L' , true );
	$mipdf -> Cell( 19, 10 , $cullongitud, 1, 0, 'R' , true );
	$mipdf -> Cell( 13, 10 , $culorientlon, 1, 0, 'L' , true );	
	$mipdf -> Ln( 10);	
}   
$mipdf -> Output('Pdf_Cultivo.pdf','I');//Nombre de descarga y Tipo de Visualización
?>


