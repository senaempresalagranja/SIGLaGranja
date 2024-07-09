<?php

 include '../conexion.php';
error_reporting(E_ALL ^ E_NOTICE);
  /* Guardar registros en la base de datos postgres */
  $rloconstrucc=$_REQUEST['rloconstrucc'];

  $rlocantacces=$_REQUEST['rlocantacces'];
  $rlocantacces1=$_REQUEST['rlocantacces1'];

  $rlocantanale=$_REQUEST['rlocantanale'];
  $rlocantanale1=$_REQUEST['rlocantanale1'];

  $rlounimedcca=$_REQUEST['rlounimedcca'];
  $rlounimedcca1=$_REQUEST['rlounimedcca1'];

  $rlocantrj=$_REQUEST['rlocantrj'];
  $rlocantrj1=$_REQUEST['rlocantrj1'];

  $rlocantfibop=$_REQUEST['rlocantfibop'];
  $rlocantfibop1=$_REQUEST['rlocantfibop1'];

  $rlocategoutp=$_REQUEST['rlocategoutp'];
  $rlocategoutp1=$_REQUEST['rlocategoutp1'];

  $rlotopologia=$_REQUEST['rlotopologia'];
  $rlotopologia1=$_REQUEST['rlotopologia1'];

  $rlodistribuc=$_REQUEST['rlodistribuc'];
  $rlodistribuc1=$_REQUEST['rlodistribuc1'];

  $rlorack=$_REQUEST['rlorack'];
  $rlorack1=$_REQUEST['rlorack1'];

  $rlocantswitc=$_REQUEST['rlocantswitc'];
  $rlocantswitc1=$_REQUEST['rlocantswitc1'];

  $rlocantregle=$_REQUEST['rlocantregle'];
  $rlocantregle1=$_REQUEST['rlocantregle1'];

  $rlocantups=$_REQUEST['rlocantups'];
  $rlocantups1=$_REQUEST['rlocantups1'];

  date_default_timezone_set("America/Bogota");
  $fecha=date("d-m-Y / H:i:s",time());

  /*if ( strlen($rlocantacces) == 0 )
  {
    echo "Igual a: 0";
    $rlocantacces= $rlocantacces1;  
  }*/
  if (strlen($rlocantacces) == 0) 
  {
      $rlocantacces= $rlocantacces1;
  }

  if (strlen($rlocantanale) == 0 && strlen($rlocantrj) == 0 && strlen($rlocantfibop) == 0 && strlen($rlorack) == 0 && strlen($rlocantswitc) == 0 && strlen($rlocantregle) == 0 && strlen($rlocantups) == 0) 
  {
    $rlocantanale= $rlocantanale1;
    $rlocantrj= $rlocantrj1;
    $rlocantfibop= $rlocantfibop1;
    $rlorack= $rlorack1;
    $rlocantswitc= $rlocantswitc1;
    $rlocantregle= $rlocantregle1;
    $rlocantups= $rlocantups1;
  }
  
  if (strlen($rlounimedcca) == 0 && strlen($rlocategoutp) == 0 && strlen($rlotopologia) == 0 && strlen($rlodistribuc) == 0) 
  {
    $rlounimedcca= $rlounimedcca1;
    $rlocategoutp= $rlocategoutp1;
    $rlotopologia= $rlotopologia1;
    $rlodistribuc= $rlodistribuc1;
  }

      pg_query("UPDATE redlogica SET 
      	rloconstrucc='$_REQUEST[rloconstrucc]',
      	rlozonawifi='$_REQUEST[rlozonawifi]',
      	rlocantacces='$rlocantacces',
      	rloredalambr='$_REQUEST[rloredalambr]',
      	rlocantanale='$rlocantanale',
      	rlounimedcca='$rlounimedcca',
      	rlocantrj='$rlocantrj',
      	rlocantfibop='$rlocantfibop',
      	rlocategoutp='$rlocategoutp',
      	rlotopologia='$rlotopologia',
      	rlodistribuc='$rlodistribuc',
      	rlorack='$rlorack',
      	rlocantswitc='$rlocantswitc',
      	rlocantregle='$rlocantregle',
      	rlocantups='$rlocantups',
      	rlofecha='$fecha'
      	WHERE rloid='$_REQUEST[rloid]' ")
      
        or die ("Problemas en el select ".mysql_error());
        echo "<script type='text/javascript'>alert('Registro Actualizado');location='../frm_redlogica.php'</script>";
 ?>