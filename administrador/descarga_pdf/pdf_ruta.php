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
		$this -> Cell( 180, 20 , "BD: siglagranja / Ruta   ", 0 , 0 , 'C' );						
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
$mipdf->SetMargins(13, 25, 25 , 15); //Margenes de: Izquierda,Arriba,Abajo,Derecha
$mipdf->SetAutoPageBreak(true,25);//Activa o desactiva el modo de salto de página automático. Recibe 2 parametros, el primero es un valor booleano(act, desact);  el segundo es la distancia desde la parte inferior de la página.
$rutidcodigo = array("CODIGO");
$rutnombre = array("NOMBRE");
$rutestado = array("ESTADO");
$rutdistancia = array("DISTANCIA");
$ruttierecorr = array("TIEMPO RECORRIDO");
$coordenadasIni = array("LATITUD INICIAL","LONGITUD INICIAL");
$coordenadasFin = array("LATITUD FINAL","LONGITUD FINAL");
$mipdf -> addPage('A5' , 'letter',20,39);////Orientación de la pagina (Horizontalmente)
//Ciclo para generar los registros, si son demaciados
for ($i = 0; $i < count( $rutidcodigo ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 6);//Tipo y tamaño de fuente
	$mipdf -> SetTextColor( 255, 255 ,255);//Color texto
	$mipdf -> SetFillColor(  0 , 0 ,255);//Clor de la cabecera
	$mipdf -> Cell ( 15, 10 , $rutidcodigo[ $i ] , 1 , 0 , 'C' , true );//Tamaño y ajuste de texto de los campos
}
for ($i = 0; $i < count( $rutnombre ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 6);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 60, 10 , $rutnombre[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $rutestado ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 6);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 15, 10 , $rutestado[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $rutdistancia ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 6);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 15, 10 , $rutdistancia[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $ruttierecorr ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 6);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 30, 10 , $ruttierecorr[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $coordenadasIni ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 6);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 30, 10 , $coordenadasIni[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $coordenadasFin ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 6);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 30, 10 , $coordenadasFin[ $i ] , 1 , 0 , 'C' , true );	
}
$mipdf -> Ln( 10);//Tamaño vertical de cada campo, registro tras registro

$res=pg_query($con, "SELECT * FROM ruta ORDER BY rutidcodigo ASC");
			while($reg=pg_fetch_array($res))
			{
				$rununimeddis= utf8_decode($reg [5]);
  				$res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$rununimeddis' ");
  				while($reg1=pg_fetch_array($res1))
  				{
  				  $nombre=$reg1[1];
  				}
			
  				$rununimedtie=$reg[7];
  				$con2=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$rununimedtie' ");
  				while($reg1=pg_fetch_array($con2))
  				{
  				  $nombre1=utf8_decode($reg1[2]);
  				}

				$rutidcodigo=utf8_decode($reg[1]);
				$rutnombre=utf8_decode($reg[2]);
				$rutestado=$reg[3];
				$rutdistancia=$reg[4];
				$ruttierecorr=$reg[6];
				$rutlatitudi=$reg[8];
				$rutorienlati=$reg[9];
				$rutlongitudi=$reg[10];
				$rutorienloni=$reg[11];
				$rutlatitudf=$reg[12];
				$rutorienlatf=$reg[13];
				$rutlongitudf=$reg[14];
				$rutorienlonf=$reg[15];
	
	$mipdf -> SetFont( 'Arial' , 'B' , 6);
	$mipdf -> SetTextColor(0,0,0);
	$mipdf -> SetFillColor( 255,255,255);		
	$mipdf -> CellFitSpace( 15, 10 , $rutidcodigo, 1, 0, 'C' , true );		
	$mipdf -> CellFitSpace( 60, 10 , $rutnombre, 1, 0, 'L' , true );		
	$mipdf -> CellFitSpace( 15, 10 , $rutestado, 1, 0, 'L' , true );		
	$mipdf -> CellFitSpace( 7.5, 10 , $rutdistancia, 1, 0, 'R' , true );		
	$mipdf -> CellFitSpace( 7.5, 10 , $nombre, 1, 0, 'L' , true );		
	$mipdf -> CellFitSpace( 15, 10 , $ruttierecorr, 1, 0, 'R' , true );		
	$mipdf -> CellFitSpace( 15, 10 , $nombre1, 1, 0, 'L' , true );		
	$mipdf -> CellFitSpace( 15, 10 , $rutlatitudi, 1, 0, 'R' , true );		
	$mipdf -> CellFitSpace( 15, 10 , $rutorienlati, 1, 0, 'L' , true );		
	$mipdf -> CellFitSpace( 15, 10 , $rutlongitudi, 1, 0, 'R' , true );	
	$mipdf -> CellFitSpace( 15, 10 , $rutorienloni, 1, 0, 'L' , true );		
	$mipdf -> CellFitSpace( 15, 10 , $rutlatitudf, 1, 0, 'R' , true );		
	$mipdf -> CellFitSpace( 15, 10 , $rutorienlatf, 1, 0, 'L' , true );		
	$mipdf -> CellFitSpace( 15, 10 , $rutlongitudf, 1, 0, 'R' , true );		
	$mipdf -> CellFitSpace( 15, 10 , $rutorienlonf, 1, 0, 'L' , true );
	$mipdf -> Ln( 10);	
}   
$mipdf -> Output('Pdf_Ruta.pdf','I');//Nombre de descarga y Tipo de Visualización
?>


