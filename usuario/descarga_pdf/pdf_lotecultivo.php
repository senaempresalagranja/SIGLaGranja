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
		$this -> Cell( 180, 20 , "BD: siglagranja / Lote-Cultivo   ", 0 , 0 , 'C' );						
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
$mipdf->SetMargins(17, 25, 25 , 15); //Margenes de: Izquierda,Arriba,Abajo,Derecha
$mipdf->SetAutoPageBreak(true,25);
$codigo = array("COD");
$lote = array("LOTE");
$cultivo = array("CULTIVO");
$unidad = array("UNIDAD");
$canal = array("CANAL");
$plagaenfermedad = array("PLAGA-ENFERMEDAD");
$fechasiembra = array("F.SIEM");
$fechacosecha = array("F.COSE");
$prodestimada = array("PRO.EST");
$prodreal = array("PRO.REAL");
$cosproestimada = array("CP.EST");
$cosproreal = array("CP.REAL");
$responsable = array("RESPONSABLE");
$mipdf -> addPage('A5' , 'legal',20,39);////Orientación de la pagina (Horizontalmente)

for ($i = 0; $i < count( $codigo ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 12, 10 , $codigo[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $lote ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 13, 10 , $lote[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $cultivo ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 25, 10 , $cultivo[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $unidad ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 25, 10 , $unidad[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $canal ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 25, 10 , $canal[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $plagaenfermedad ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 40, 10 , $plagaenfermedad[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $fechasiembra ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 18, 10 , $fechasiembra[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $fechacosecha ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 18, 10 , $fechacosecha[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $prodestimada ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 24, 10 , $prodestimada[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $prodreal ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 24, 10 , $prodreal[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $cosproestimada ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 36, 10 , $cosproestimada[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $cosproreal ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 36, 10 , $cosproreal[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $responsable ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 28, 10 , $responsable[ $i ] , 1 , 0 , 'C' , true );	
}
$mipdf -> Ln( 10);

$res=pg_query($con, "SELECT * FROM lote_cultivo ORDER BY lcuid ASC");
			while($reg=pg_fetch_array($res))
			{
				$codigo=$reg[0];
				$lote=$reg[1];
				$conlot=pg_query($con, "SELECT * FROM lote WHERE lotid='$lote' ");
				while($reg1=pg_fetch_array($conlot))
				{
					$CodLote=utf8_decode($reg1[1]);
				}

				$cultivo=$reg[2];
				$con1=pg_query($con, "SELECT * FROM cultivo WHERE culid='$cultivo' ");
				while($reg1=pg_fetch_array($con1))
				{
					$NomComun=utf8_decode($reg1[2]);
				}

				$unidad=$reg[3];
				$con2=pg_query($con, "SELECT * FROM unidad WHERE uniid='$unidad' ");
				while($reg1=pg_fetch_array($con2))
				{
					$NomUnidad=utf8_decode($reg1[2]);
				}

				$fechasiembra=$reg[4];
				$fechacosecha=$reg[5];
				$prodestimada=$reg[6];

				$undmedida=$reg[7];
				$con3=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$undmedida' ");
				while($reg1=pg_fetch_array($con3))
				{
					$NomUniMed=utf8_decode($reg1[1]);
				}

				$prodreal=$reg[8];

				$undmedida1=$reg[9];
				$con4=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$undmedida1' ");
				while($reg1=pg_fetch_array($con4))
				{
					$NomUniMed1=utf8_decode($reg1[1]);
				}

				$cosproestimada=$reg[10];

				$undmedida2=$reg[11];
				$con5=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$undmedida2' ");
				while($reg1=pg_fetch_array($con5))
				{
					$NomUniMed2=utf8_decode($reg1[1]);
				}

				$cosproreal=$reg[12];

				$undmedida3=$reg[13];
				$con6=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$undmedida3' ");
				while($reg1=pg_fetch_array($con6))
				{
					$NomUniMed3=utf8_decode($reg1[1]);
				}

				$responsable=$reg[14];				
				$fecha=$reg[15];

				$canal=$reg[16];
				$con7=pg_query($con, "SELECT * FROM canal WHERE canid='$canal' ");
				while($reg1=pg_fetch_array($con7))
				{
					$NomCanal=utf8_decode($reg1[2]);
				}

				$plagaenfermedad=$reg[17];
				$con8=pg_query($con, "SELECT * FROM plagaenfermedad WHERE penid='$plagaenfermedad' ");
				while($reg1=pg_fetch_array($con8))
				{
					$NomComunPlaEnf=utf8_decode($reg1[2]);
				}
	
	$mipdf -> SetFont( 'Arial' , 'B' , 6);
	$mipdf -> SetTextColor(0,0,0);
	$mipdf -> SetFillColor( 255,255,255);		
	$mipdf -> Cell( 12, 10 , $codigo, 1, 0, 'C' , true );
	$mipdf -> Cell( 13, 10 , $CodLote, 1, 0, 'L' , true );
	$mipdf -> Cell( 25, 10 , $NomComun, 1, 0, 'L' , true );
	$mipdf -> Cell( 25, 10 , $NomUnidad, 1, 0, 'L' , true );
	$mipdf -> Cell( 25, 10 , $NomCanal, 1, 0, 'L' , true );
	$mipdf -> CellFitSpace( 40, 10 , $NomComunPlaEnf, 1, 0, 'L' , true );
	$mipdf -> Cell( 18, 10 , $fechasiembra, 1, 0, 'R' , true );
	$mipdf -> Cell( 18, 10 , $fechacosecha, 1, 0, 'R' , true );
	$mipdf -> Cell( 17, 10 , $prodestimada, 1, 0, 'R' , true );
	$mipdf -> Cell( 7, 10 , $NomUniMed, 1, 0, 'L' , true );
	$mipdf -> Cell( 17, 10 , $prodreal, 1, 0, 'R' , true );
	$mipdf -> Cell( 7, 10 , $NomUniMed1, 1, 0, 'L' , true );
	$mipdf -> Cell( 29, 10 , $cosproestimada, 1, 0, 'R' , true );
	$mipdf -> Cell( 7, 10 , $NomUniMed2, 1, 0, 'L' , true );
	$mipdf -> Cell( 29, 10 , $cosproreal, 1, 0, 'R' , true );
	$mipdf -> Cell( 7, 10 , $NomUniMed3, 1, 0, 'L' , true );
	$mipdf -> Cell( 28, 10 , $responsable, 1, 0, 'L' , true );
	$mipdf -> Ln( 10);	
}   
$mipdf -> Output('Pdf_LoteCultivo.pdf','I');//Nombre de descarga y Tipo de Visualización
?>