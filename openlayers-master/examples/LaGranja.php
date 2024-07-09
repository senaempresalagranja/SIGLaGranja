<!DOCTYPE html>
<html>
  <head>
  <?php include '../.././visitante/include/header.php'; ?>
   <!--esta etiqueta me facilita el idioma español -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <!--me varia las escalas de la Pagina -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!--Compatibilidad con los Dispositivos Móviles apple -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <title>
      La Granja
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
    <link rel="stylesheet" href="css/style1.4.css" type="text/css">
  <!--En Esta Librería llamo todos Los Estilos que va a poseer El Popup cuando se abra -->
    <link rel="stylesheet" type="text/css" href="Consultas/Css/StyleConsultaInicio.css">
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
        var PolAdminAg = new OpenLayers.Layer.Vector("Mapa Administrativo", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlAgroindustria/Agroindustria.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });

        var PolAdminMe = new OpenLayers.Layer.Vector("Mapa Administrativo", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlMecanizacion/Mecanizacion.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PolAdminPe = new OpenLayers.Layer.Vector("Mapa Administrativo", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlPecuaria/PECUARIAA.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });

          var PolAdminAM = new OpenLayers.Layer.Vector("Mapa Administrativo", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlAmbiental/AMBIENTAL.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });


         var Poligono= new OpenLayers.Layer.Vector("Area Total", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlGestiondeCentro/ZonasComunes.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })

        });

         var PoligonoPo= new OpenLayers.Layer.Vector("Postes Total", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlPostes/Postes.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })

        });
          var PoligonoCa= new OpenLayers.Layer.Vector("Canales Total", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlAgricolas/Canales.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })

        });
           var PoligonoCr= new OpenLayers.Layer.Vector("Carreteables Total", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlAgricolas/Carreteables.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })

        });

         var group = [PolAdmin];
        for (var i=0; i < group.length; i++) { group[i].group = 'Agricola'; }
        map.addLayers([PolAdmin]);

        var group = [PolAdminAg];
        for (var i=0; i < group.length; i++) { group[i].group = 'Agroindustria'; }
        map.addLayers([PolAdminAg]);

        var group = [PolAdminMe];
        for (var i=0; i < group.length; i++) { group[i].group = 'Mecanizacion'; }
        map.addLayers([PolAdminMe]);

        var group = [PolAdminPe];
        for (var i=0; i < group.length; i++) { group[i].group = 'Pecuaria'; }
        map.addLayers([PolAdminPe]);

        var group = [PolAdminAM];
        for (var i=0; i < group.length; i++) { group[i].group = 'Ambiental'; }
        map.addLayers([PolAdminAM]);

        var group = [Poligono];  
        for (var i=0; i < group.length; i++) { group[i].group = 'Zonas Comunes'; }
        map.addLayers([Poligono]);

        var group = [PoligonoPo];  
        for (var i=0; i < group.length; i++) { group[i].group = 'Postes'; }
        map.addLayers([PoligonoPo]);

        var group = [PoligonoCa];  
        for (var i=0; i < group.length; i++) { group[i].group = 'Canales'; }
        map.addLayers([PoligonoCa]);

        var group = [PoligonoCr];  
        for (var i=0; i < group.length; i++) { group[i].group = 'Carreteables'; }
        map.addLayers([PoligonoCr]);


      map.addControl(new OpenLayers.Control.LayerSwitcherGroups());

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
            <?php include '../include/banner.php';  ?>
        </div>
        <!-- Descripcion para el Menu-->
        <div id="nav">
           <?php include '../include/menu.php'; ?>
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

 
       
    
     
        <!-- Descripcion para el pie de pagina-->
        <div id="foot">
         <?php include '../include/piepagina.php' ?>
        </div>      
    </div>        
  </body>
</html>