<!DOCTYPE html>
<html>
  <head>
  <?php include '../.././visitante/include/header.php';?>
   <!--esta etiqueta me facilita el idioma español -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <!--me varia las escalas de la Pagina -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!--Compatibilidad con los Dispositivos Móviles apple -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <title>
      Agricola
    </title>
  <!-- Llamo Todas Las Librerias para que mi Mapping se visualice Correctamente  -->
  <!--Aquí llamo La librería de Openlayers que me carga el Mapa Base del mundo -->
    <script src="../lib/OpenLayers.js"></script>
  <!--Aquí llamo una Librería que desarrollé para Configurar los Popups que salen al dar click en el marcador -->
    <script src="../lib/FeaturePopups.js"></script>
  <!--Aquí llamo una Librería que desarrollé para  Traer la Consulta en un Popup a Través de Funciones          Javascript -->
    <script type="text/javascript" src="Consultas/Js/PopupConsulta.js"></script>
  <!--Esta librería es Opcional por si queremos Cargar los estilos Propios de Open layers al Mapa Base -->
    <link rel="stylesheet" href="../theme/default/style.css" type="text/css">
  <!--En Esta Librería llamo todos los Estilos Desarrollados Para la interfaz gráfica del Aplicativo "SIGLaGranja Como Por ejemplo La ubicación del Banner,  Menú, Cuerpo y Pie de Página" -->
    <!--<link rel="stylesheet" href="style.css" type="text/css">-->
  <!--En Esta Librería llamo todos Los Estilos que va a poseer El Popup cuando se abra -->
    <link rel="stylesheet" type="text/css" href="Consultas/Css/StyleConsulta.css">
  <!--Aquí llamo Los Estilos propios del Visor -->
   <style type="text/css">
            p {
                width: 500px;
            }
            div.olControlMousePosition {
                font-family: Verdana;
                font-size: 1em;
                color: blue;
            }
             div.olControlNavToolbar{
                left: 20px;
                margin-top: auto

            .olControlLoadingPanel {
            background-image:url(../theme/default/img/loading.gif);
            position: relative;
            width: 195px;
            height: 11px;
            background-position:center;
            background-repeat:no-repeat;
            display: none;
        }
            }
        </style>
    <style type="text/css">
    .smallmap
    {
      width: 1000px;
      height: 500px;

    }
    


    </style>
     <style>
            #panel {
                right: 0px;
                height: 30px;
                width: 200px;
            }
            #panel div {
                float: left;
                margin: 5px;
            }
        </style>
    <script>
    //Este Método me Permite Utilizar una Seguridad cuando el Usuario Navegue en el Applicativo
    OpenLayers.ProxyHost = "proxy.cgi?url=";
    //Declaramos Dos Variables
    var map;


    //--Funcion Para Cargar El Mapa Con todos Sus Atributos
    function load() {
        //---Colocar el Mapa en el html bajo la etiqueta "MAPDIV"--//
        map = new OpenLayers.Map("mapdiv");

        //---Agregar el mapa de Open Street Map que es el Encargado de dibujar el mapa---//
        map.addLayer(new OpenLayers.Layer.OSM());

        //---Proyectamos el mapa Con las Coordenadas Mas utilizadas "WGS84"---//
        epsg4326 =  new OpenLayers.Projection("EPSG:4326");

        //---Mediante la Clase getProjectionObject le decimos que los marcadores y atributos del mapa se regiran bajo la proyeccion WGS84---//
        projectTo = map.getProjectionObject(); //The map projection (Spherical Mercator)
        map.setCenter(new OpenLayers.LonLat(-74.929449, 4.167448).transform(epsg4326, projectTo), 16);




        //---Creamos una variable que nos permita utilizar estilos para los marcadores por defecto---//


        //---Cargarmos Las Capas   en kml---//

        var La_Granja = new OpenLayers.Layer.Vector("Centro Agropecuario La Granja", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlAgricolas/lagranja.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true,
                    extractAttributes: true,
                    maxDepth: 2
                })
            })

        });
        map.addLayers([La_Granja]);


        var PolAdmin = new OpenLayers.Layer.Vector("Mapa Administrativo", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlAgricolas/AGRICOLA.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true,
                    extractAttributes: true,
                    maxDepth: 2
                })
            })

        });
        map.addLayers([PolAdmin]);


        var PolAdminCo = new OpenLayers.Layer.Vector("Construcciones", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlConstrucciones/Construcciones agricolas.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true,
                    extractAttributes: true,
                    maxDepth: 2
                })
            })

        });



         var PolAdminPo = new OpenLayers.Layer.Vector("Postes", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/kmlPostes/PostesAgricolas.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true,
                    extractAttributes: true,
                    maxDepth: 2
                })
            })

        });
        map.addLayers([PolAdminPo]);

         
          var PoligonoCa= new OpenLayers.Layer.Vector("Canales", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlCanales/CANALES DE RIEGO AGRICOLAS.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })

        });
           var PoligonoCr= new OpenLayers.Layer.Vector("Carreteables", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlCarreteables/CARRETEABLE AGRICOLA.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })

        });


           map.addLayers([PolAdminCo, PoligonoCa, PoligonoCr]);
        // PolAdmin.setVisibility(false);
        // PolAdminCo.setVisibility(false);
        // PolAdminPo.setVisibility(false);
        // PoligonoCa.setVisibility(false);
        // PoligonoCr.setVisibility(false);

        <?php


include 'Consultas/Agricola/conexion.php';
$area="AGRICOLA";
        $lote = pg_query($con, "SELECT  unidad.uniarea, unidad.uninombre, unidad.uniid, unidad.kml FROM unidad 
inner join area on area.areid = unidad.uniarea
WHERE  arenombre = '$area' ");

while ($reg = pg_fetch_array($lote)) {


    $cultivo = pg_query($con, "SELECT cultivo.culid , unidad.uninombre, cultivo.culnomcomun , cultivo.kml FROM unidad_cultivo 
    inner join cultivo on cultivo.culid = unidad_cultivo.lcucultivo 
    inner join unidad on unidad.uniid = unidad_cultivo.lcuunidad where unidad.uninombre = '" . $reg[1] . "'");

    while ($reg1 = pg_fetch_array($cultivo)) {
        
        echo "
                    var ".str_replace(" ", "", $reg1[2])." = new OpenLayers.Layer.Vector('$reg1[2]', {
                    strategies: [new OpenLayers.Strategy.Fixed()],
                    protocol: new OpenLayers.Protocol.HTTP({
                        url: 'kml/KmlAgricolas/multipoligono/$reg1[3]',
                        format: new OpenLayers.Format.KML({
                            extractStyles: true,
                            // extractAttributes: true,
                            maxDepth: 3

                        })
                    })

                    });

                  ".str_replace(" ", "", $reg1[2]).".setVisibility(false);".                 
                  "";
    }



    
    echo "

       var " . str_replace('-', '', $reg[1]) . " = new OpenLayers.Layer.Vector('Area Total', {
        strategies: [new OpenLayers.Strategy.Fixed()],
        protocol: new OpenLayers.Protocol.HTTP({
            url: 'kml/KmlAgricolas/multipoligono/$reg[3]',
            format: new OpenLayers.Format.KML({
                extractStyles: true,
                extractAttributes: true,
                maxDepth: 3
            })
        })

        });

        ".str_replace("-", "", $reg[1]).".setVisibility(false);".

       "";




    ?>

   

    var group = [ <?php echo str_replace('-', '', $reg[1]);
    

   $cultivo = pg_query($con, "SELECT cultivo.culid , unidad.uninombre, cultivo.culnomcomun , cultivo.kml FROM unidad_cultivo 
    inner join cultivo on cultivo.culid = unidad_cultivo.lcucultivo 
    inner join unidad on unidad.uniid = unidad_cultivo.lcuunidad where unidad.uninombre = '" . $reg[1] . "'");

    while ($reg1 = pg_fetch_array($cultivo)) {

        echo ", " . str_replace(" ", "", $reg1[2]);
    }
    ?>
];
    for (var i=0; i < group.length; i++) { group[i].group = '<?php echo $reg[1]; ?>'; }
    map.addLayers([<?php echo str_replace('-', '', $reg[1]);

   $cultivo = pg_query($con, "SELECT cultivo.culid , unidad.uninombre, cultivo.culnomcomun , cultivo.kml FROM unidad_cultivo 
    inner join cultivo on cultivo.culid = unidad_cultivo.lcucultivo 
    inner join unidad on unidad.uniid = unidad_cultivo.lcuunidad where unidad.uninombre = '" . $reg[1] . "'");

    while ($reg1 = pg_fetch_array($cultivo)) {

        echo "," . str_replace(" ", "", $reg1[2]);
    }
    ?>


]);



    
    
 

<?php
}

?>


var fpControl = new OpenLayers.Control.FeaturePopups({
    selectionBox: true,

    layers: [
    <?php
        $area="AGRICOLA";
        $lote = pg_query($con, "SELECT  unidad.uniarea, unidad.uninombre, unidad.uniid, unidad.kml FROM unidad 
inner join area on area.areid = unidad.uniarea
WHERE  arenombre = '$area'");

while ($reg = pg_fetch_array($lote)) {


    $cultivo = pg_query($con, "SELECT cultivo.culid , unidad.uninombre, cultivo.culnomcomun , cultivo.kml FROM unidad_cultivo 
    inner join cultivo on cultivo.culid = unidad_cultivo.lcucultivo 
    inner join unidad on unidad.uniid = unidad_cultivo.lcuunidad where unidad.uninombre = '" . $reg[1] . "'");
       while ($reg1 = pg_fetch_array($cultivo)) {
           
       
           
        
    ?>
    [   

    <?php echo str_replace('-', '', $reg1[2]);?> , {templates: {
    single: "<table border='0'><tr><td width='200px'><center><h5><?php echo $reg1[2] ;?></h5></td></tr><tr><td width='200px'><img src='img/lot_8.png' class='LotesCultivos'></td></tr><tr><td><center><input type='submit' value='Ver m&aacute;s informaci&oacute;n' onclick='Cultivo(`<?php echo $reg1[2] ;?>`)'></center></td></tr></table>",


}}
],
<?php

}?>
    [   

        <?php echo str_replace('-', '', $reg[1]);?> , {templates: {
            single: "<table border='0'><tr><td width='200px'><center><h5><?php echo $reg[1] ;?></h5></td></tr><tr><td width='200px'><img src='img/lot_8.png' class='LotesCultivos'></td></tr><tr><td><center><input type='submit' value='Ver m&aacute;s informaci&oacute;n' onclick='Lote(`<?php echo $reg[1] ;?>`)'></center></td></tr></table>",


        }}
    ],
    <?php
        }
        
    ?>
]
});
               


map.addControl(fpControl);
map.addControl(new OpenLayers.Control.LayerSwitcherGroups());
// map.addControl(new OpenLayers.Control.LayerSwitcherRadioReg());

// Coloco latitud  longitud
map.addControl(new OpenLayers.Control.MousePosition());
map.addControl(new OpenLayers.Control.ScaleLine());
map.addControl(new OpenLayers.Control.OverviewMap());



        }

  </script>
  </head>
  <body onload="load()">
       <!-- Descripcion para el contenedor principal, campo de trabajo-->
    <div id="section">

      <!-- Descripcion para el Banner-->
        <div id="banner">
            <?php include '../include/banner.php';?>
        </div>
        <!-- Descripcion para el Menu-->
        <div id="nav">
           <?php include '../include/menu.php';?>
        </div>
        <!-- Descripcion para el cuerpo de la pagina-->
        <div class="flotante">
  <UL>
   <ul>
      <button class="INICIO">
        <li> <a href="LaGranja.php" class="menu" ><font color="black">Centro Agropecuario La Granja</a></li>
    </button>
</ul>
<ul>
  <button class="AGRICOLA">
    <li> <a href="Agricola2.php" class="menu" ><font color="black">Agricola</a></li>
</button>
</ul>
<ul>
  <button class="AGROINDUSTRIA">
    <li> <a href="Agroindustria.php"  class="menu" ><font color="black">Agroindustria</a></li>
</button>
</ul>
<ul>
  <button class="MECANIZACION">
     <li><a href="Mecanizacion.php" class="menu" ><font color="black">Mecanizacion</a></li> 
 </button>
</ul>
<ul>
    <button class="PECUARIA">
      <li> <a href="Pecuaria2.php" class="menu" ><font color="black">Pecuaria</a></li> 
  </button>
</ul>
<ul>
    <button class="AMBIENTAL">
      <li> <a href="Ambiental.php" class="menu" ><font color="black">Ambiental</a></li> 
  </button>
</ul>
<ul>
    <button class="ZONASCOMUNES">
      <li> <a href="Zonas_Comunes3.php" class="menu" ><font color="black">Gestion de Centro</a></li> 
  </button>
</ul>
</UL>
</div>
 <div id="mapdiv" class="smallmap" style="position: relative;" onload="load()"></div>
 </table>





        <!-- Descripcion para el pie de pagina-->
        <div id="foot">
         <?php include '../include/piepagina.php'?>
        </div>
    </div>
  </body>
</html>