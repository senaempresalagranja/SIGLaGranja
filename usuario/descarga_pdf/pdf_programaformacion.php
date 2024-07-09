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
		$this -> Cell( 180, 20 , "BD: siglagranja / Programa Formacion   ", 0 , 0 , 'C' );						
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
$mipdf->SetMargins(12, 25, 25 , 15); //Margenes de: Izquierda,Arriba,Abajo,Derecha
$mipdf->SetAutoPageBreak(true,25);//Activa o desactiva el modo de salto de página automático. Recibe 2 parametros, el primero es un valor booleano(act, desact);  el segundo es la distancia desde la parte inferior de la página.
$pfoid = array("CODIGO");
$pfoarea = array("AREA");
$pfonombre = array("NOMBRE");
$pfotipformac = array("TIPO FORMACION");
$pfotieelecti = array("ETAPA LECTIVA");
$pfotieproduc = array("ETAPA PRODUCTIVA");
//$pfoimagen = array("IMAGEN");
$mipdf -> addPage('A5' , 'letter',20,39);////Orientación de la pagina (Horizontalmente)
//Ciclo para generar los registros, si son demaciados
for ($i = 0; $i < count( $pfoid ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 10);//Tipo y tamaño de fuente
	$mipdf -> SetTextColor( 255, 255 ,255);//Color texto
	$mipdf -> SetFillColor(  0 , 0 ,255);//Clor de la cabecera
	$mipdf -> Cell ( 17, 10 , $pfoid[ $i ] , 1 , 0 , 'C' , true );//Tamaño y ajuste de texto de los campos
}
for ($i = 0; $i < count( $pfoarea ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 9);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 50, 10 , $pfoarea[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $pfonombre ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 9);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 77, 10 , $pfonombre[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $pfotipformac ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 9);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 40, 10 , $pfotipformac[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $pfotieelecti ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 9);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 35, 10 , $pfotieelecti[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $pfotieproduc ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 9);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 35, 10 , $pfotieproduc[ $i ] , 1 , 0 , 'C' , true );	
}
/*for ($i = 0; $i < count( $pfoimagen ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 9);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 20, 10 , $pfoimagen[ $i ] , 1 , 0 , 'C' , true );	
}*/
$mipdf -> Ln( 10);//Tamaño vertical de cada campo, registro tras registro

$res=pg_query($con, "SELECT * FROM programaformacion ORDER BY pfoarea ASC");
			while($reg=pg_fetch_array($res))
			{
				$Area= utf8_decode($reg [1]);
  				$res1=pg_query($con, "SELECT * FROM area WHERE areid='$Area' ");
  				while($reg1=pg_fetch_array($res1))
  				{
  				  $nombre=$reg1[2];
  				}
  				$UniMed1= $reg [5];
  				$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$UniMed1' ");
  				while($reg1=pg_fetch_array($res1))
  				{
  				  $nombre1=utf8_decode($reg1[2]);
  				}
  				$UniMed2= $reg [7];
  				$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$UniMed2' ");
  				while($reg1=pg_fetch_array($res1))
  				{
  				  $nombre2=utf8_decode($reg1[2]);
  				}

				$pfoid=$reg[0];
				$pfonombre=$reg[2];
				$pfotipformac=$reg[3];
				$pfotieelecti=$reg[4];
				$pfotieproduc=$reg[6];
				$pfodescripci=$reg[8];
				//$pfoimagen=$reg[9];
	
	
	$mipdf -> SetFont( 'Arial' , 'B' , 7);
	$mipdf -> SetTextColor(0,0,0);
	$mipdf -> SetFillColor( 255,255,255);		
	$mipdf -> Cell( 17, 10 , $pfoid, 1, 0, 'C' , true );
	$mipdf -> Cell( 50, 10 , $nombre, 1, 0, 'L' , true );
	$mipdf -> Cell( 77, 10 , $pfonombre, 1, 0, 'L' , true );
	$mipdf -> Cell( 40, 10 , $pfotipformac, 1, 0, 'L' , true );
	$mipdf -> Cell( 17.5, 10 , $pfotieelecti, 1, 0, 'R' , true );
	$mipdf -> Cell( 17.5, 10 , $nombre1, 1, 0, 'L' , true );
	$mipdf -> Cell( 17.5, 10 , $pfotieproduc, 1, 0, 'R' , true );
	$mipdf -> Cell( 17.5, 10 , $nombre2, 1, 0, 'L' , true );
	//$mipdf -> Image("../img/logo.jpg" , 25 , 25 , 20 , 20);//Margenes de: Izquierda,Arriba,Abajo,Derecha
	$mipdf -> Ln( 10);	
}   
$mipdf -> Output('Pdf_ProgramaFormacion.pdf','I');//Nombre de descarga y Tipo de Visualización
?>


