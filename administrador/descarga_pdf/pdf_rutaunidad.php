<?php

include "pdf/pdf.php";
include "../conexion.php";


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
	public function Header()
	{

		$this -> Image("../img/logo.jpg" , 25 , 25 , 20 , 20);//Margenes de: Izquierda,Arriba,Abajo,Derecha
		$this -> SetFont ( 'Arial' , 'B' , 16 );			
		$this -> Cell( 180, 20 , "BD: siglagranja / Ruta-Unidad   ", 0 , 0 , 'C' );						
		$this -> Cell( 0, 20 , "   Fecha: ".date("d/m/Y",time()-25200), 0 , 0 ,'R');
		$this -> Ln( 30 );			
	}
	public function Footer()
	{
    //Footer de la pagina
		$this->SetY(-15); 
		$this->AliasNbPages();
		$this->SetFont('Arial','I',10); 
		$this->SetTextColor(0); 
	$this->Cell(0,10,'Pagina '.$this->PageNo().' de {nb}',0,0,'C'); // el parametro {nb} es generado por una funcion llamada AliasNbPages 
	}	
}
$mipdf = new MiPDF('P','mm','A4');
$mipdf->SetMargins(18, 25, 25, 10); //Margenes de: Izquierda,Arriba,Abajo,Derecha
$mipdf->SetAutoPageBreak(true,25);
$runkidcodigo = array("CODIGO");
$runruta = array("RUTA");
$rununidad = array("UNIDAD");
$rundistancia = array("DISTANCIA");
$runtierecorr = array("TIEMPO RECORRIDO");
$runtipruta = array("TIPO RUTA");
$mipdf -> addPage('A5' , 'letter',20,39);////Orientación de la pagina (Horizontalmente)

for ($i = 0; $i < count( $runkidcodigo ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 20, 10 , $runkidcodigo[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $runruta ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 90, 10 , $runruta[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $rununidad ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 50, 10 , $rununidad[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $rundistancia ) ; $i++)
{
    $mipdf -> SetFont( 'Arial' , 'B' , 8);
    $mipdf -> SetTextColor( 255, 255 ,255);
    $mipdf -> SetFillColor(  0 , 0 ,255);
    $mipdf -> Cell ( 20, 10 , $rundistancia[ $i ] , 1 , 0 , 'C' , true ); 
}
for ($i = 0; $i < count( $runtierecorr ) ; $i++)
{
    $mipdf -> SetFont( 'Arial' , 'B' , 8);
    $mipdf -> SetTextColor( 255, 255 ,255);
    $mipdf -> SetFillColor(  0 , 0 ,255);
    $mipdf -> Cell ( 34, 10 , $runtierecorr[ $i ] , 1 , 0 , 'C' , true ); 
}
for ($i = 0; $i < count( $runtipruta ) ; $i++)
{
    $mipdf -> SetFont( 'Arial' , 'B' , 8);
    $mipdf -> SetTextColor( 255, 255 ,255);
    $mipdf -> SetFillColor(  0 , 0 ,255);
    $mipdf -> Cell ( 28, 10 , $runtipruta[ $i ] , 1 , 0 , 'C' , true ); 
}
$mipdf -> Ln( 10);

$res=pg_query($con, "SELECT * FROM ruta_unidad ORDER BY runkidcodigo ASC");
    while($reg=pg_fetch_array($res))
    {
      $runruta= utf8_decode($reg [3]);
      $res1=pg_query($con, "SELECT * FROM ruta WHERE rutid='$runruta' ");
      while($reg1=pg_fetch_array($res1))
      {
        $nombre=$reg1[2];
      }
      $unidad= utf8_decode($reg [2]);
      $res1=pg_query($con, "SELECT * FROM unidad WHERE uniid='$unidad' ");
      while($reg1=pg_fetch_array($res1))
      {
        $nombre1=$reg1[2];
      }

      $unidad_medida= utf8_decode($reg [5]);
      $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$unidad_medida' ");
      while($reg1=pg_fetch_array($res1))
      {
        $nombre2=$reg1[1];
      }

      $unidad_medida1= utf8_decode($reg [7]);
      $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$unidad_medida1' ");
      while($reg1=pg_fetch_array($res1))
      {
        $nombre3=$reg1[2];
      }
      $runkidcodigo=$reg[1];
      $rundistancia=$reg[4];
      $runtierecorr=$reg[6];
      $runtipruta=$reg[8];
	
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor(0,0,0);
	$mipdf -> SetFillColor( 255,255,255);		
	$mipdf -> Cell( 20, 10 , $runkidcodigo, 1, 0, 'C' , true );
	$mipdf -> Cell( 90, 10 , $nombre, 1, 0, 'L' , true );
	$mipdf -> Cell( 50, 10 , $nombre1, 1, 0, 'L' , true );
    $mipdf -> Cell( 10, 10 , $rundistancia, 1, 0, 'R' , true );
    $mipdf -> Cell( 10, 10 , $nombre2, 1, 0, 'L' , true );
    $mipdf -> Cell( 14, 10 , $runtierecorr, 1, 0, 'R' , true );
    $mipdf -> Cell( 20, 10 , $nombre3, 1, 0, 'L' , true );
    $mipdf -> Cell( 28, 10 , $runtipruta, 1, 0, 'L' , true );
	$mipdf -> Ln( 10);	
}   
$mipdf -> Output('Pdf_EspecieRaza.pdf','I');//Nombre de descarga y Tipo de Visualización
?>


