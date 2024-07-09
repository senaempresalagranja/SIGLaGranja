<?php
//llamado a la pagina del formato pdf
include "pdf/pdf.php";
//Definir la conexion a la base de dato
include "../conexion.php";
//crea la clase a descargar definir el formato a pdf

class  MiPDF extends FPDF 
{
	//***** Aquí comienza código para ajustar texto *************
    //***********************************************************
    function CellFit($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $scale=false, $force=true)
    {
        //Get string width
        $str_width=$this->GetStringWidth($txt);
 
        //Calculate ratio to fit cell
        if($w==0)
            $w = $this->w-$this->rMargin-$this->x;
        $ratio = ($w-$this->cMargin*2)/$str_width;
 
        $fit = ($ratio < 1 || ($ratio > 1 && $force));
        if ($fit)
        {
            if ($scale)
            {
                //Calculate horizontal scaling
                $horiz_scale=$ratio*100.0;
                //Set horizontal scaling
                $this->_out(sprintf('BT %.2F Tz ET',$horiz_scale));
            }
            else
            {
                //Calculate character spacing in points
                $char_space=($w-$this->cMargin*2-$str_width)/max($this->MBGetStringLength($txt)-1,1)*$this->k;
                //Set character spacing
                $this->_out(sprintf('BT %.2F Tc ET',$char_space));
            }
            //Override user alignment (since text will fill up cell)
            $align='';
        }
 
        //Pass on to Cell method
        $this->Cell($w,$h,$txt,$border,$ln,$align,$fill,$link);
 
        //Reset character spacing/horizontal scaling
        if ($fit)
            $this->_out('BT '.($scale ? '100 Tz' : '0 Tc').' ET');
    }
 
    function CellFitSpace($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,false,false);
    }
 
    //Patch to also work with CJK double-byte text
    function MBGetStringLength($s)
    {
        if($this->CurrentFont['type']=='Type0')
        {
            $len = 0;
            $nbbytes = strlen($s);
            for ($i = 0; $i < $nbbytes; $i++)
            {
                if (ord($s[$i])<128)
                    $len++;
                else
                {
                    $len++;
                    $i++;
                }
            }
            return $len;
        }
        else
            return strlen($s);
    }
	//************** Fin del código para ajustar texto *****************
	//******************************************************************
//Es el encabezado de la página, la imagen, el titulo, y la fecha del reporte
	public function Header()
	{

		$this -> Image("../img/logo.jpg" , 25 , 25 , 20 , 20);//Margenes de: Izquierda,Arriba,Abajo,Derecha
		$this -> SetFont ( 'Arial' , 'B' , 16 );			
		$this -> Cell( 180, 20 , "BD: siglagranja / Poste   ", 0 , 0 , 'C' );						
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
$mipdf->SetMargins(30, 25, 25 , 15); //Margenes de: Izquierda,Arriba,Abajo,Derecha
$mipdf->SetAutoPageBreak(true,25);//Activa o desactiva el modo de salto de página automático. Recibe 2 parametros, el primero es un valor booleano(act, desact);  el segundo es la distancia desde la parte inferior de la página.
$posidcodigo = array("CODIGO");
$posunidad = array("UNIDAD");
$postipmateri = array("MATERIAL");
$posestado = array("ESTADO MAT.");
$posaltura = array("ALTURA");
$postiptensio = array("TENSION");
$posalumbrado = array("ILUMINACION");
$posestalumbr = array("ESTADO ILU.");
$postransform = array("TRANSFORMADOR");
$posesttransf = array("ESTADO TRANSF.");
$posruta = array("RUTA");
$coordenadas = array("LATITUD","LONGITUD");
$mipdf -> addPage('A5' , 'legal',20,39);////Orientación de la pagina (Horizontalmente)
//Ciclo para generar los registros, si son demaciados
for ($i = 0; $i < count( $posidcodigo ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 6);//Tipo y tamaño de fuente
	$mipdf -> SetTextColor( 255, 255 ,255);//Color texto
	$mipdf -> SetFillColor(  0 , 0 ,255);//Clor de la cabecera
	$mipdf -> Cell ( 15, 10 , $posidcodigo[ $i ] , 1 , 0 , 'C' , true );//Tamaño y ajuste de texto de los campos
}
for ($i = 0; $i < count( $posunidad ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 6);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 35, 10 , $posunidad[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $postipmateri ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 6);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 15, 10 , $postipmateri[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $posestado ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 6);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 18, 10 , $posestado[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $posaltura ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 6);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 17, 10 , $posaltura[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $postiptensio ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 6);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 15, 10 , $postiptensio[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $posalumbrado ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 6);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 17, 10 , $posalumbrado[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $posestalumbr ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 6);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 17, 10 , $posestalumbr[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $postransform ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 6);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 22, 10 , $postransform[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $posesttransf ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 6);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 22, 10 , $posesttransf[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $posruta ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 6);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 40, 10 , $posruta[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $coordenadas ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 6);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 30, 10 , $coordenadas[ $i ] , 1 , 0 , 'C' , true );	
}
$mipdf -> Ln( 10);//Tamaño vertical de cada campo, registro tras registro

$res=pg_query($con, "SELECT * FROM poste ORDER BY posidcodigo ASC");
			while($reg=pg_fetch_array($res))
			{
				$unidadmedida= utf8_decode($reg [6]);
  				$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$unidadmedida' ");
  				while($reg1=pg_fetch_array($res1))
  				{
  				  $nombre=$reg1[1];
  				}
			
  				$unidad=$reg[2];
  				$con2=pg_query($con, "SELECT * FROM unidad WHERE uniid='$unidad' ");
  				while($reg1=pg_fetch_array($con2))
  				{
  				  $NomUnidad=utf8_decode($reg1[2]);
  				}

  				$ruta=$reg[12];
  				$con2=pg_query($con, "SELECT * FROM ruta WHERE rutid='$ruta' ");
  				while($reg1=pg_fetch_array($con2))
  				{
  				  $NomRuta=utf8_decode($reg1[2]);
  				}

				$mipdf -> SetFont( 'Arial' , 'B' , 8);
				$posidcodigo=utf8_decode($reg[1]);
				$postipmateri=$reg[3];
				$posestado=$reg[4];
				$posaltura=$reg[5];
				$postiptensio=$reg[7];
				$posalumbrado=$reg[8];
				$posestalumbr=$reg[9];
				$postransform=$reg[10];
				$posesttransf=$reg[11];
				$poslatitud=$reg[13];
				$posorientlat=$reg[14];
				$poslongitud=$reg[15];
				$posorientlon=$reg[16];
	
	$mipdf -> SetFont( 'Arial' , 'B' , 6);
	$mipdf -> SetTextColor(0,0,0);
	$mipdf -> SetFillColor( 255,255,255);		
	$mipdf -> CellFitSpace( 15, 10 , $posidcodigo, 1, 0, 'C' , true );		
	$mipdf -> CellFitSpace( 35, 10 , $NomUnidad, 1, 0, 'L' , true );		
	$mipdf -> CellFitSpace( 15, 10 , $postipmateri, 1, 0, 'L' , true );		
	$mipdf -> CellFitSpace( 18, 10 , $posestado, 1, 0, 'L' , true );		
	$mipdf -> CellFitSpace( 8.5, 10 , $posaltura, 1, 0, 'R' , true );		
	$mipdf -> CellFitSpace( 8.5, 10 , $nombre, 1, 0, 'L' , true );		
	$mipdf -> CellFitSpace( 15, 10 , $postiptensio, 1, 0, 'L' , true );		
	$mipdf -> CellFitSpace( 17, 10 , $posalumbrado, 1, 0, 'L' , true );		
	$mipdf -> CellFitSpace( 17, 10 , $posestalumbr, 1, 0, 'L' , true );		
	$mipdf -> CellFitSpace( 22, 10 , $postransform, 1, 0, 'L' , true );	
	$mipdf -> CellFitSpace( 22, 10 , $posesttransf, 1, 0, 'L' , true );		
	$mipdf -> CellFitSpace( 40, 10 , $NomRuta, 1, 0, 'L' , true );		
	$mipdf -> CellFitSpace( 15, 10 , $poslatitud, 1, 0, 'R' , true );		
	$mipdf -> CellFitSpace( 15, 10 , $posorientlat, 1, 0, 'L' , true );		
	$mipdf -> CellFitSpace( 15, 10 , $poslongitud, 1, 0, 'R' , true );		
	$mipdf -> CellFitSpace( 15, 10 , $posorientlon, 1, 0, 'L' , true );
	$mipdf -> Ln( 10);	
}   
$mipdf -> Output('Pdf_Poste.pdf','I');//Nombre de descarga y Tipo de Visualización
?>


