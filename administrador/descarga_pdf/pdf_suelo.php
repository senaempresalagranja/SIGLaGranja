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
		$this -> Image("../img/logo.jpg" , 25 , 25 , 20 , 20);
		$this -> SetFont ( 'Arial' , 'B' , 16 );
		$this -> Cell( 200, 20 , "BD: siglagranja / Suelo  ", 0 , 0 , 'C' );					
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
$mipdf = new MiPDF('P','mm','A3');
$mipdf->SetMargins(24, 25, 15, 5);
$mipdf->SetAutoPageBreak(true,15);
$CODIGO = array("CODIGO");
$HUMEDAD = array("HUMEDAD");
$TEXTURA = array("TEXTURA");
$POROCIDAD = array("POROCIDAD");
$CONSISTENCIA = array("CONSISTENCIA");
$COLOR = array("COLOR");
$condelectr = array("CONDUCT. ELEC");
$NITROGENO = array("NITROGENO");
$FOSFORO = array("FOSFORO");
$POTACIO = array("POTACIO");
$elemmenores = array("ELEM. MENORES");
$elemintercambio = array("ELEM. INTERCAMBIO");
$ph = array("PH");
$ACTMICROB = array("ACT. MICROBIANA");
$MASAMICRO = array("MASA MICROBIANA");
$MATORGAAN = array("MATERIA ORGANICA");
$mipdf -> addPage('A5' , 'legal',20,39);

for ($q = 0; $q < count( $CODIGO) ; $q++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 6.8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> CellFitSpace ( 12, 10 , $CODIGO[ $q ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $HUMEDAD) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 6.8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> CellFitSpace ( 14, 10 , $HUMEDAD[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $TEXTURA) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 6.8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> CellFitSpace ( 34, 10 , $TEXTURA[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $POROCIDAD) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 6.8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> CellFitSpace ( 16, 10 , $POROCIDAD[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $CONSISTENCIA) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 6.8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> CellFitSpace ( 20, 10 , $CONSISTENCIA[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $COLOR) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 6.8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> CellFitSpace ( 14, 10 , $COLOR[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $condelectr) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 6.8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> CellFitSpace ( 20, 10 , $condelectr[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $NITROGENO) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 6.8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> CellFitSpace ( 16, 10 , $NITROGENO[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $FOSFORO) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 6.8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> CellFitSpace ( 14, 10 , $FOSFORO[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $POTACIO) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 6.8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> CellFitSpace ( 14, 10 , $POTACIO[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $elemmenores) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 6.8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> CellFitSpace ( 20, 10 , $elemmenores[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $elemintercambio) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 6.8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> CellFitSpace ( 27, 10 , $elemintercambio[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $ph) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 6.8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> CellFitSpace ( 11, 10 , $ph[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $ACTMICROB) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 6.8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> CellFitSpace ( 25, 10 , $ACTMICROB[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $MASAMICRO) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 6.8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> CellFitSpace ( 25, 10 , $MASAMICRO[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $MATORGAAN) ; $i++)
{
	$mipdf -> SetFont( 'arial' , 'B' , 6.8);
	$mipdf -> SetTextColor(255,255,255);
	$mipdf -> SetFillColor(0,0,255);
	$mipdf -> CellFitSpace ( 25, 10 , $MATORGAAN[ $i ] , 1 , 0 , 'C' , true );
}
$mipdf -> Ln(10);

$res=pg_query($con, "SELECT * FROM suelo ORDER BY sueid ASC");
while($reg=pg_fetch_array($res))
{
  $sueunimedhu= utf8_decode($reg [2]);    
  $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$sueunimedhu' ");
  while($reg1=pg_fetch_array($res1))
  {
    $nombre=$reg1[1];
  }
  $sueunimedpo=utf8_decode($reg[5]);  
  $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$sueunimedpo' ");
  while($reg1=pg_fetch_array($res1))
  {
    $nombre1=$reg1[1];
  }
  $sueunimedco=utf8_decode($reg[7]);
  $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$sueunimedco' ");
  while($reg1=pg_fetch_array($res1))
  {
    $nombre2=$reg1[1];
  }
  $sueunimedel=utf8_decode($reg[10]);
  $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$sueunimedel' ");
  while($reg1=pg_fetch_array($res1))
  {
    $nombre3=$reg1[1];
  }
  $sueunimedni=utf8_decode($reg[12]);
  $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$sueunimedni' ");
  while($reg1=pg_fetch_array($res1))
  {
    $nombre4=$reg1[1];
  }
  $sueunimedfo=utf8_decode($reg[14]);
  $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$sueunimedfo' ");
  while($reg1=pg_fetch_array($res1))
  {
    $nombre5=$reg1[1];
  }
  $sueunimedpt=utf8_decode($reg[16]);
  $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$sueunimedpt' ");
  while($reg1=pg_fetch_array($res1))
  {
    $nombre6=$reg1[1];
  }
  $sueunimedph=utf8_decode($reg[20]);
  $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$sueunimedph' ");
  while($reg1=pg_fetch_array($res1))
  {
    $nombre7=$reg1[1];
  }
  $sueunimedma=utf8_decode($reg[22]);
  $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$sueunimedma' ");
  while($reg1=pg_fetch_array($res1))
  {
    $nombre8=$reg1[1];
  }
  $sueunimedam=utf8_decode($reg[24]);
  $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$sueunimedam' ");
  while($reg1=pg_fetch_array($res1))
  {
    $nombre9=$reg1[1];
  }
  $sueunimedmm=utf8_decode($reg[26]);
  $res1=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$sueunimedmm' ");
  while($reg1=pg_fetch_array($res1))
  {
    $nombre10=$reg1[1];
  }

  $sueid= utf8_decode($reg[0]);
  $suefhumedad= utf8_decode($reg[1]);
  $sueftextura= utf8_decode($reg[3]);
  $suefporocida= utf8_decode($reg[4]);
  $suefconsiste= utf8_decode($reg[6]);
  $suefcolorter= utf8_decode($reg[8]);
  $suefcondelet= utf8_decode($reg[9]);
  $sueqnitrogen= utf8_decode($reg[11]);
  $sueqfosforo= utf8_decode($reg[13]);
  $sueqpotacio= utf8_decode($reg[15]);
  $sueqelemmeno= utf8_decode($reg[17]);
  $sueqeleminte= utf8_decode($reg[18]);
  $sueqph= utf8_decode($reg[19]);
  $suebmateorga= utf8_decode($reg[21]);
  $suebactimicr= utf8_decode($reg[23]);
  $suebmasmicro= utf8_decode($reg[25]);

	$mipdf -> SetFont( 'arial' , 'B' , 6);
	$mipdf -> SetTextColor(0,0,0);
	$mipdf -> SetFillColor(255,255,255);
	$mipdf -> CellFitSpace( 12, 10 , $sueid , 1, 0, 'C' , true );
	$mipdf -> CellFitSpace( 7, 10 , $suefhumedad , 1, 0, 'R' , true );
	$mipdf -> CellFitSpace( 7, 10 , $nombre , 1, 0, 'L' , true );
	$mipdf -> CellFitSpace( 34, 10 , $sueftextura, 1, 0, 'L' , true );
	$mipdf -> CellFitSpace( 8, 10 , $suefporocida , 1, 0, 'R' , true );
	$mipdf -> CellFitSpace( 8, 10 , $nombre1, 1, 0, 'L' , true );
	$mipdf -> CellFitSpace( 10, 10 , $suefconsiste, 1, 0, 'R' , true );
	$mipdf -> CellFitSpace( 10, 10 , $nombre2, 1, 0, 'L' , true );
	$mipdf -> CellFitSpace( 14, 10 , $suefcolorter, 1, 0, 'L' , true );
	$mipdf -> CellFitSpace( 10, 10 , $suefcondelet, 1, 0, 'R' , true );
	$mipdf -> CellFitSpace( 10, 10 , $nombre3, 1, 0, 'L' , true );
	$mipdf -> CellFitSpace( 10, 10 , $sueqnitrogen, 1, 0, 'R' , true );
	$mipdf -> CellFitSpace( 6, 10 , $nombre4, 1, 0, 'L' , true );
	$mipdf -> CellFitSpace( 7, 10 , $sueqfosforo, 1, 0, 'R' , true );
	$mipdf -> CellFitSpace( 7, 10 , $nombre5, 1, 0, 'L' , true );
	$mipdf -> CellFitSpace( 7, 10 , $sueqpotacio, 1, 0, 'R' , true );
	$mipdf -> CellFitSpace( 7, 10 , $nombre6, 1, 0, 'L' , true );
	$mipdf -> CellFitSpace( 20, 10 , $sueqelemmeno, 1, 0, 'L' , true );
	$mipdf -> CellFitSpace( 27, 10 , $sueqeleminte, 1, 0, 'L' , true );
	$mipdf -> CellFitSpace( 7, 10 , $sueqph, 1, 0, 'R' , true );
	$mipdf -> CellFitSpace( 4, 10 , $nombre7, 1, 0, 'L' , true );
	$mipdf -> CellFitSpace( 12.5, 10 , $suebactimicr, 1, 0, 'R' , true );
	$mipdf -> CellFitSpace( 12.5, 10 , $nombre9, 1, 0, 'L' , true );
	$mipdf -> CellFitSpace( 12.5, 10 , $suebmasmicro, 1, 0, 'R' , true );
	$mipdf -> CellFitSpace( 12.5, 10 , $nombre10, 1, 0, 'L' , true );
	$mipdf -> CellFitSpace( 12.5, 10 , $suebmateorga, 1, 0, 'R' , true );
	$mipdf -> CellFitSpace( 12.5, 10 , $nombre8, 1, 0, 'L' , true );
	$mipdf -> Ln(10);
}
$mipdf -> Output('Pdf_Suelo.pdf','I');
?>