<?php

include "fpdf/fpdf.php";
include "conexion.php";


class  MiPDF extends FPDF {
		
		public function Header(){
			
			$this -> Image("../img/logo.png" , 2 , 25 , 20 , 20);
			$this -> SetFont ( 'Arial' , 'B' , 16 );			
			$this -> Cell( 170, 20 , "Base Datos.SIGLaGranja / Consulta  Lote_7   ", 0 , 0 , 'C' );						
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
$mipdf = new MiPDF('P','mm','A4');//
$mipdf->SetMargins(2, 25, 25 , 10); 
$mipdf->SetAutoPageBreak(true,25);
$cabecera = array("AREA","UNIDAD");
$cabecera1 = array("CODIGO");
$cabecera2 = array("CULTIVO");
$cabecera3 = array("CANAL");
$cabecera4 = array("EXTENSION");
$cabecera5 = array("U/M");
$cabecera6 = array("LATITUD");
$cabecera7 = array("HEMISFERIO");
$cabecera8 = array("LONGITUD");
$cabecera9 = array("HEMISFERIO");
$cabecera10 = array("HUMEDAD","TEXTURA","PH","POROSIDAD");

$mipdf -> addPage('A5' , 'legal',20,39);////Orientación de la pagina (Horizontalmente)

for ($i = 0; $i < count( $cabecera ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 9);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 23, 10 , $cabecera[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $cabecera1 ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 9);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 20, 10 , $cabecera1[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $cabecera2 ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 9);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 25, 10 , $cabecera2[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $cabecera3 ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 9);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 25, 10 , $cabecera3[ $i ] , 1 , 0 , 'C' , true );
}
for ($i = 0; $i < count( $cabecera4 ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 9);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 25, 10 , $cabecera4[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $cabecera5 ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 9);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 14, 10 , $cabecera5[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $cabecera6 ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 9);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 25, 10 , $cabecera6[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $cabecera7 ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 9);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 25, 10 , $cabecera7[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $cabecera8 ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 9);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 25, 10 , $cabecera8[ $i ] , 1 , 0 , 'C' , true );	
}
for ($i = 0; $i < count( $cabecera9) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 9);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 25, 10 , $cabecera9[ $i ] , 1 , 0 , 'C' , true );	
}

for ($i = 0; $i < count( $cabecera10 ) ; $i++)
{
	$mipdf -> SetFont( 'Arial' , 'B' , 9);
	$mipdf -> SetTextColor( 255, 255 ,255);
	$mipdf -> SetFillColor(  0 , 0 ,255);
	$mipdf -> Cell ( 23, 10 , $cabecera10[ $i ] , 1 , 0 , 'C' , true );	
}

$mipdf -> Ln( 10);
$consulta=pg_query($con,"SELECT area.arenombre,lote_cultivo.lcuunidad,lote_cultivo.lcucultivo,lote_cultivo.lcucanal,suelo.suefhumedad,suelo.sueftextura,suelo.sueqph,suelo.suefporocida,lote.lotidcodigo,lote.lotextension,lote.lotunimedlot,lote.lotlatitud,lote.lotorientlat,lote.lotlongitud,lote.lotorientlon 
                FROM lote_cultivo
                  inner join unidad on unidad.uniid = lote_cultivo.lcuunidad
                  inner join lote on lote.lotidcodigo = lote_cultivo.lculote
                  inner join area on area.areidcodigo = unidad.uniarea
                  inner join suelo on suelo.sueid = lote.lotsuelo WHERE lculote='LOTE 7'");


            while ($Reg_LotCul= pg_fetch_array($consulta)) 
            {
            	$lotunimedlot=($Reg_LotCul[10]);
                $res3=pg_query($con, "SELECT * FROM unidad_medida WHERE umeid='$lotunimedlot' ");
                 while($registro_um=pg_fetch_array($res3))
                {
        
                     $unimedlote=utf8_decode($registro_um[1]);
                 }
                 $loteunidad=($Reg_LotCul[1]);
                 $res4=pg_query($con,"SELECT * FROM unidad WHERE uniid='$loteunidad'");
                 while($registro_unidad=pg_fetch_array($res4))
                {
                	$unidadLote=utf8_decode($registro_unidad[2]);
                }
            	 $lotecultivo=($Reg_LotCul[2]);
                 $res5=pg_query($con,"SELECT * FROM cultivo WHERE culidcodigo='$lotecultivo'");
                 while($registro_cultivo=pg_fetch_array($res5))
                {
                	$cultivolot=utf8_decode($registro_cultivo[2]);
                }
                 $lotecanal=($Reg_LotCul[3]);
                 $res6=pg_query($con,"SELECT * FROM canal WHERE canidcodigo='$lotecanal'");
                 while($registro_canal=pg_fetch_array($res6))
                {
                	$canallot=utf8_decode($registro_canal[2]);
                }
               
              
            
 $mipdf -> SetFont( 'Arial' , 'B' , 7);
	$area = utf8_decode($Reg_LotCul[0]);	
	$codigo= utf8_decode($Reg_LotCul[8]);	
	$extension= utf8_decode($Reg_LotCul[9]);
	$latitud= utf8_decode($Reg_LotCul[11]);
	$hemisferio= utf8_decode($Reg_LotCul[12]);
	$longitud=utf8_decode($Reg_LotCul[13]);
	$hemisferio1=utf8_decode($Reg_LotCul[14]);
	$humedad= utf8_decode($Reg_LotCul[1]);
	$textura= utf8_decode($Reg_LotCul[2]);
	$ph= utf8_decode($Reg_LotCul[3]);
	$porosidad= utf8_decode($Reg_LotCul[4]);



 
//$mipdf -> SetFillColor( 255,255,255);	
	//$mipdf -> Cell( 38, 10 , $codigoinsumo , 1, 0, 'C' , true );
	$mipdf -> SetFont( 'Arial' , 'B' , 8);
	$mipdf -> SetTextColor(0,0,0);
	$mipdf -> SetFillColor( 255,255,255);		
	$mipdf -> Cell( 23, 10 , $area, 1, 0, 'C' , true );
    $mipdf -> SetFillColor( 255,255,255);
    $mipdf -> Cell( 23, 10 , $unidadLote, 1, 0, 'C' , true );
	$mipdf -> SetFillColor( 255,255,255);			
	$mipdf -> Cell( 20, 10 , $codigo, 1, 0, 'C' , true );
	$mipdf -> SetFillColor( 255,255,255);
	$mipdf -> Cell( 25, 10 , $cultivolot, 1, 0, 'C' , true );
	$mipdf -> SetFillColor( 255,255,255);
	$mipdf -> Cell( 25, 10 , $canallot, 1, 0, 'C' , true );
	$mipdf -> SetFillColor( 255,255,255);
	$mipdf -> Cell( 25, 10 , $extension, 1, 0, 'R' , true );
	$mipdf -> SetFillColor( 255,255,255);
	$mipdf -> Cell( 14, 10 , $unimedlote, 1, 0, 'R' , true );
	$mipdf -> SetFillColor( 255,255,255);			
	$mipdf -> Cell( 25, 10 , $latitud, 1, 0, 'C' , true );	
	$mipdf -> SetFillColor( 255,255,255);	
	$mipdf -> Cell( 25, 10 , $hemisferio, 1, 0, 'R' , true );
	$mipdf -> SetFillColor( 255,255,255);
	$mipdf -> Cell( 25, 10 , $longitud, 1, 0, 'C' , true );
	$mipdf -> SetFillColor( 255,255,255);
	$mipdf -> Cell( 25, 10 , $hemisferio1, 1, 0, 'R' , true );
	$mipdf -> SetFillColor( 255,255,255);	
	$mipdf -> Cell( 23, 10 , $humedad, 1, 0, 'C' , true );
	$mipdf -> SetFillColor( 255,255,255);	
	$mipdf -> Cell( 23, 10 , $textura, 1, 0, 'C' , true );
	$mipdf -> SetFillColor( 255,255,255);	
	$mipdf -> Cell( 23, 10 , $ph, 1, 0, 'C' , true );
	$mipdf -> SetFillColor( 255,255,255);	
	$mipdf -> Cell( 23, 10 , $porosidad, 1, 0, 'C' , true );
	$mipdf -> SetFillColor( 255,255,255);	


	$mipdf -> Ln( 10);

}
$mipdf -> Output();
?>

