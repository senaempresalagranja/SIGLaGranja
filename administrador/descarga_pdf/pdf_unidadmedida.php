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
		$this -> Cell( 150, 20 , "BD: siglagranja / Unidad de Medida   ", 0 , 0 , 'C' );						
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
$mipdf->SetMargins(43, 25, 25, 10); //Margenes de: Izquierda,Arriba,Abajo,Derecha
$mipdf->SetAutoPageBreak(true,25);
$cabecera3 = array("MAGNITUD");
$cabecera = array("CODIGO");
$cabecera1 = array("NOMBRE");
$cabecera2 = array("SIMBOLO");
$mipdf -> addPage('A5' , 'letter',20,39);////Orientación de la pagina (Horizontalmente)

for ($i = 0; $i < count( $cabecera3 ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 10);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 60, 10 , $cabecera3[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $cabecera ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 10);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 25, 10 , $cabecera[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $cabecera1 ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 10);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 70, 10 , $cabecera1[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $cabecera2 ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 10);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 35, 10 , $cabecera2[ $i ] , 1 , 0 , 'C' , true );	
}
$mipdf -> Ln( 10);

$res=pg_query($con, "SELECT * FROM unidad_medida order by umetipunimed");
while($reg=pg_fetch_array($res))
{
	$umeid=$reg[0];
	$umerepreset= utf8_decode($reg[1]);
	$umenombre= utf8_decode($reg[2]);
	$umetipunimed=$reg[4];
	
	$mipdf -> SetFont( 'Arial' , 'B' , 10);
	$mipdf -> SetTextColor(0,0,0);
	$mipdf -> SetFillColor( 255,255,255);		
	$mipdf -> Cell( 60, 10 , $umetipunimed, 1, 0, 'L' , true );
	$mipdf -> Cell( 25, 10 , $umeid, 1, 0, 'C' , true );	
	$mipdf -> Cell( 70, 10 , $umenombre, 1, 0, 'L' , true );
	$mipdf -> Cell( 35, 10 , $umerepreset, 1, 0, 'L' , true );	
	$mipdf -> Ln( 10);	
}   
$mipdf -> Output('Pdf_UnidadMedida.pdf','I');//Nombre de descarga y Tipo de Visualización
?>


