<?php
//llamado a la pagina del formato pdf//
include "pdf/pdf.php";
//Definir la conexion a la base de dato//
include "../conexion.php";
//crear la clase a descargar definir el formato a pdf//
	class  MiPDF extends FPDF 
	{
//crear la cabecera del pdf donde defino imagen, nombre de la base de datos, y la cactura de la fecha de impresion//		
		public function Header()
		{
			$this -> Image("../img/logo.jpg" , 25 , 25 , 20 , 20);//defino la imagen a utilizar, y el tamaño a mostrar
			$this -> SetFont ( 'arial' , 'B' , 16 );//el estilo de la letra y el tamaño	
			$this -> Cell( 180, 20 , "Base Datos.SIGLaGranja / Tabla.Usuario", 0 , 0 , 'C' );//el nombre que vamos a mostar de la tabla						
			$this -> Cell( 0, 20 , " Fecha: ".date("d/m/Y",time()-25200),  0, 0 ,'R');//declaramos la fecha
			$this -> Ln( 30 );
		}
//crear el pie de pagina del pdf, donde definimos la paginacion//
		public function Footer()
    	{
		    $this->SetY(-15); //la definicion
		    $this->AliasNbPages();//para que reconosque que pagina es.
			$this->SetFont('arial','I',12); //la definicon del tipo de letra y el tamaño
			$this->SetTextColor(0);//definir el color del texto
			$this->Cell(0,10,'Pagina '.$this->PageNo().' de {nb}',0,0,'C'); // mostrar la pagina, el parametro {nb} es generado por una funcion llamada AliasNbPages 
	     }
	 }
//contenido a mostrar en el pdf//
	$mipdf = new MiPDF('P','mm','A4');//tipo de papel
	$mipdf->SetMargins(25, 25, 25, 10);//margenes
	$mipdf->SetAutoPageBreak(true,25);//no se para que es.
	$cabeceraid= array("CODIGO");
	$cabeceraE= array("CORREO ELECTRONICO");
	$cabecera = array("NOMBRE","APELLIDOS");
	$cabeceraT = array("ROL","USUARIO","CONTRASENA");//se define los nombre de la cabesera d ela tabla a mostrar
	$mipdf -> addPage('A5' , 'legal',10,39);//tipo del pdf
//se crea un for de cabesera por si los registro derimas a mas de una pagina//
	for ($s = 0; $s < count( $cabeceraid) ; $s++)
		{
			$mipdf -> SetFont( 'arial' , 'B' , 11);//tipo de letra y tamaño
			$mipdf -> SetTextColor(255,255,255);//color del texto
			$mipdf -> SetFillColor(0, 0 ,255);//color de la cabecera
			$mipdf -> Cell ( 20, 10 , $cabeceraid[ $s ] , 1 , 0 , 'C' , true );//tamaño de cada campo
		}
	for ($q = 0; $q < count( $cabecera) ; $q++)
		{
			$mipdf -> SetFont( 'arial' , 'B' , 11);//tipo de letra y tamaño
			$mipdf -> SetTextColor(255,255,255);//color del texto
			$mipdf -> SetFillColor(0, 0 ,255);//color de la cabecera
			$mipdf -> Cell ( 45, 10 , $cabecera[ $q ] , 1 , 0 , 'C' , true );//tamaño de cada campo
		}
	for ($r = 0; $r < count( $cabeceraE) ; $r++)
		{
			$mipdf -> SetFont( 'arial' , 'B' , 11);//tipo de letra y tamaño
			$mipdf -> SetTextColor(255,255,255);//color del texto
			$mipdf -> SetFillColor(0, 0 ,255);//color de la cabecera
			$mipdf -> Cell ( 70, 10 , $cabeceraE[ $r ] , 1 , 0 , 'C' , true );//tamaño de cada campo
		}
	for ($i = 0; $i < count( $cabeceraT) ; $i++)
		{
			$mipdf -> SetFont( 'arial' , 'B' , 11);//tipo de letra y tamaño
			$mipdf -> SetTextColor(255,255,255);//color del texto
			$mipdf -> SetFillColor(0,0,255);//color de la cabecera
			$mipdf -> Cell ( 40, 10 , $cabeceraT[ $i ] , 1 , 0 , 'C' , true );//tamaño de cada campo
		}
	$mipdf -> Ln( 8);//tamaño de la linea
//se crea la conexion con la base de dato, selecionamos la tabla a mostrar y los campos con un siclo while para que traiga todos los registros//
	$res=pg_query($con, "SELECT * FROM usuario");
//se crea el siclo while
		while($reg=pg_fetch_array($res))
		{
//se captura los registros a mostrar
			$id= utf8_decode($reg [0]);
			$nombre= utf8_decode($reg [1]);
			$apellidos= utf8_decode($reg [2]);
			$correo= utf8_decode($reg [4]);
			$rol= utf8_decode($reg [8]);
			$usuario= utf8_decode($reg [6]);
			$contraseña= utf8_decode('113h186o092l953a835');
//se mestra los registros y en que posision 
			$mipdf -> SetFont( 'arial' , 'B' , 10);//tipo de letra y tamaño
			$mipdf -> SetTextColor(0,0,0);//color del texto
			$mipdf -> SetFillColor(255,255,255);//estilo del capo y tamaño
			$mipdf -> Cell( 20, 6 , $id , 1, 0, 'I' , true );
		    $mipdf -> SetFillColor(255,255,255);//color del capo
			$mipdf -> Cell( 45, 6 , $nombre , 1, 0, 'I' , true );
			$mipdf -> SetFillColor(255,255,255);//color del capo
			$mipdf -> Cell( 45, 6 , $apellidos , 1, 0, 'I' , true );
			$mipdf -> SetFillColor(255,255,255);//color del capo
			$mipdf -> Cell( 70, 6 , $correo , 1, 0, 'I' , true );
			$mipdf -> SetFillColor(255,255,255);//color del capo
			$mipdf -> Cell( 40, 6 , $rol , 1, 0, 'I' , true );
			$mipdf -> SetFillColor(255,255,255);
			$mipdf -> Cell( 40, 6 , $usuario, 1, 0, 'C' , true );
			$mipdf -> SetFillColor(255,255,255);
			$mipdf -> Cell( 40, 6 , $contraseña, 1, 0, 'I' , true );	
			$mipdf -> Ln( 6);//tamaño de la linea
		}
//se cierra el formato pdf
	$mipdf -> Output();
?>