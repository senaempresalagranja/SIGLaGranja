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
		$this -> Cell( 180, 20 , "BD: siglagranja / Enfermedad   ", 0 , 0 , 'C' );						
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
$mipdf->SetMargins(25, 25, 25 , 15); //Margenes de: Izquierda,Arriba,Abajo,Derecha
$mipdf->SetAutoPageBreak(true,25);//Activa o desactiva el modo de salto de página automático. Recibe 2 parametros, el primero es un valor booleano(act, desact);  el segundo es la distancia desde la parte inferior de la página.
$enfid = array("CODIGO");
$enfnomcomun = array("NOM-COMUN");
$enfnomcinti = array("NOM-CIENTIFICO");
$enftipagecau = array("AGE-CAUSAL");
$enfmorvimort = array("MORTALIDAD");
$enfsintomas = array("SINTOMAS");
$enftratamien = array("TRATAMIENTO");
$mipdf -> addPage('A5' , 'legal',20,39);////Orientación de la pagina (Horizontalmente)
//Ciclo para generar los registros, si son demaciados
for ($i = 0; $i < count( $enfid ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 8);//Tipo y tamaño de fuente
	$mipdf -> SetTextColor( 255, 255 ,255);//Color texto
	$mipdf -> SetFillColor(  0 , 0 ,255);//Clor de la cabecera
	$mipdf -> Cell ( 17, 10 , $enfid[ $i ] , 1 , 0 , 'C' , true );//Tamaño y ajuste de texto de los campos
}
for ($i = 0; $i < count( $enfnomcomun ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 30, 10 , $enfnomcomun[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $enfnomcinti ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 35, 10 , $enfnomcinti[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $enftipagecau ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 23, 10 , $enftipagecau[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $enfmorvimort ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 25, 10 , $enfmorvimort[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $enfsintomas ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 90, 10 , $enfsintomas[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $enftratamien ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 90, 10 , $enftratamien[ $i ] , 1 , 0 , 'C' , true );	
}
$mipdf -> Ln( 10);//Tamaño vertical de cada campo, registro tras registro

$res=pg_query($con, "SELECT * FROM enfermedad ORDER BY enfid ASC");
			while($reg=pg_fetch_array($res))
			{

	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$enfid = utf8_decode($reg [0]);	
	$enfnomcomun= utf8_decode($reg [1]);
	$enfnomcinti= utf8_decode($reg [2]);	
	$enftipagecau= utf8_decode($reg [3]);
	$enfmorvimort= utf8_decode($reg [4]);
	$enfsintomas= utf8_decode($reg [5]);
	$enftratamien= utf8_decode($reg [6]);
	
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor(0,0,0);
	$mipdf -> SetFillColor( 255,255,255);		
	$mipdf -> CellFitSpace( 17, 20 , $enfid, 1, 0, 'C' , true );
	$mipdf -> CellFitSpace( 30, 20 , $enfnomcomun, 1, 0, 'L' , true );
	$mipdf -> CellFitSpace( 35, 20 , $enfnomcinti, 1, 0, 'L' , true );	
	$mipdf -> CellFitSpace( 23, 20 , $enftipagecau , 1, 0, 'L' , true );		
	$mipdf -> CellFitSpace( 25, 20 , $enfmorvimort, 1, 0, 'L' , true );
	$mipdf -> CellFitSpace( 90, 20 , $enfsintomas, 1, 0, 'L' , true );
	$mipdf -> CellFitSpace( 90, 20 , $enftratamien, 1, 0, 'L' , true );
	$mipdf -> Ln( 20);	
}   
$mipdf -> Output('Pdf_Enfermedad.pdf','I');//Nombre de descarga y Tipo de Visualización
?>


