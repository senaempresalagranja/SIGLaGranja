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
      Pecuaria
    </title>
  <!-- Llamo Todas Las Librerias para que mi Mapping se visualice Correctamente  -->
  <!--Aquí llamo La librería de Openlayers que me carga el Mapa Base del mundo -->
    <script src="../lib/OpenLayers.js"></script>
  <!--Aquí llamo una Librería que desarrollé para Configurar los Popups que salen al dar click en el marcador -->
    <script src="../lib/FeaturePopups.js"></script>
  <!--Aquí llamo una Librería que desarrollé para  Traer la Consulta en un Popup a Través de Funciones          Javascript -->
    <script type="text/javascript" src="Consultas/Js/PopupConsultaMec.js"></script>
  <!--Esta librería es Opcional por si queremos Cargar los estilos Propios de Open layers al Mapa Base -->
    <link rel="stylesheet" href="../theme/default/style.css" type="text/css">
  <!--En Esta Librería llamo todos los Estilos Desarrollados Para la interfaz gráfica del Aplicativo "SIGLaGranja Como Por ejemplo La ubicación del Banner,  Menú, Cuerpo y Pie de Página" -->
    <link rel="stylesheet" href="style.css" type="text/css">
  <!--En Esta Librería llamo todos Los Estilos que va a poseer El Popup cuando se abra -->
    <link rel="stylesheet" type="text/css" href="Consultas/Css/StyleConsultaMecanizacion.css">
  <!--Aquí llamo Los Estilos propios del Visor -->
    <style type="text/css">
    .smallmap
    {
      width: 1000px;
      height: 500px;

    }

    </style>
    <script>
    //Este Método me Permite Utilizar una Seguridad cuando el Usuario Navegue en el Applicativo 
    OpenLayers.ProxyHost = "proxy.cgi?url=";
    //Declaramos Dos Variables   
    var map;


    //--Funcion Para Cargar El Mapa Con todos Sus Atributos
    function load()
     {
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
                url: "kml/KmlAgricolas/LaGranja.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
         map.addLayers([La_Granja]);

        var Mantenimiento = new OpenLayers.Layer.Vector("Poligono", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlMecanizacion/PolUnidadTransporte.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunMantenimiento = new OpenLayers.Layer.Vector("Punto", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlMecanizacion/PunUnidad_TranpsMant.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var Invernadero = new OpenLayers.Layer.Vector("Poligono", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlMecanizacion/PolInvernadero.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunInvernadero = new OpenLayers.Layer.Vector("Punto", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlMecanizacion/PunInvernadero.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var Pista_Tractores = new OpenLayers.Layer.Vector("Poligono", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlMecanizacion/PolPista_Tractores.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunPista_Tractores = new OpenLayers.Layer.Vector("Punto", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlMecanizacion/PunPista_Tractores.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var Talleres = new OpenLayers.Layer.Vector("Poligono", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlMecanizacion/PolTalleres.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunTalleres = new OpenLayers.Layer.Vector("Punto", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlMecanizacion/PunTalleres.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PolAdmin = new OpenLayers.Layer.Vector("Mapa Administrativo", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlMecanizacion/Total_Mecanizacion.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        map.addLayers([PolAdmin]);

         var group = [Mantenimiento,PunMantenimiento];
        for (var i=0; i < group.length; i++) { group[i].group = 'Unidad Mantenimiento'; }
        map.addLayers([Mantenimiento,PunMantenimiento]);

        var group = [Invernadero,PunInvernadero];
        for (var i=0; i < group.length; i++) { group[i].group = 'Unidad Invernadero'; }
        map.addLayers([Invernadero,PunInvernadero]);

        var group = [Pista_Tractores,PunPista_Tractores];
        for (var i=0; i < group.length; i++) { group[i].group = 'Unidad Entrenamiento'; }
        map.addLayers([Pista_Tractores,PunPista_Tractores]);

        var group = [Talleres,PunTalleres];
        for (var i=0; i < group.length; i++) { group[i].group = 'Unidad Talleres'; }
        map.addLayers([Talleres,PunTalleres]);

        Mantenimiento.setVisibility (false);
        PunMantenimiento.setVisibility(false);
        Invernadero.setVisibility(false);
        PunInvernadero.setVisibility(false);
        Pista_Tractores.setVisibility(false);
        PunPista_Tractores.setVisibility(false);
        Talleres.setVisibility(false);
        PunTalleres.setVisibility(false);

         var fpControl = new OpenLayers.Control.FeaturePopups({
                selectionBox: true,
                layers: 
                 [
                   
                     [
                      PunMantenimiento , {templates: {
                          single: "<table border='0'><tr><td width='200px'><center><h5>Unidad Mantenimiento</h5></td></tr><tr><td width='200px'><img src='img/Pecuaria/U_Porcinos.png' class='LotesCultivos'></td></tr><tr><td><center><input type='submit' value='Ver m&aacute;s informaci&oacute;n' onclick='Mantenimiento()'></center></td></tr></table>",
                       

                      }}
                    ],
                    [
                      PunInvernadero , {templates: {
                          single: "<table border='0'><tr><td width='200px'><center><h5>Unidad Invernadero</h5></td></tr><tr><td width='200px'><img src='img/Pecuaria/U_Porcinos.png' class='LotesCultivos'></td></tr><tr><td><center><input type='submit' value='Ver m&aacute;s informaci&oacute;n' onclick='Invernadero()'></center></td></tr></table>",
                       

                      }}
                    ],
                     [
                      PunPista_Tractores , {templates: {
                          single: "<table border='0'><tr><td width='200px'><center><h5>Pista Tractores</h5></td></tr><tr><td width='200px'><img src='img/Pecuaria/U_Porcinos.png' class='LotesCultivos'></td></tr><tr><td><center><input type='submit' value='Ver m&aacute;s informaci&oacute;n' onclick='Tractores()'></center></td></tr></table>",
                       

                      }}
                    ],
                    
                     [
                      PunTalleres , {templates: {
                          single: "<table border='0'><tr><td width='200px'><center><h5>Soldadura y Construccion</h5></td></tr><tr><td width='200px'><img src='img/Pecuaria/U_Porcinos.png' class='LotesCultivos'></td></tr><tr><td><center><input type='submit' value='Ver m&aacute;s informaci&oacute;n' onclick='Talleres()'></center></td></tr></table>",
                       

                      }}
                    ],
                  ]
 });
map.addControl(fpControl);
map.addControl(new OpenLayers.Control.LayerSwitcherGroups());


      }
    </script>
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
        <li> <a href="LaGranja.php" class="menu" ><font color="black">CENTRO AGROPECUARIO "LA GRANJA"</a></li>
    </button>
</ul>
<ul>
  <button class="AGRICOLA">
    <li> <a href="Agricola2.php" class="menu" ><font color="black">AGRICOLA</a></li>
</button>
</ul>
<ul>
  <button class="AGROINDUSTRIA">
    <li> <a href="Agroindustria.php"  class="menu" ><font color="black">AGROINDUSTRIA</a></li>
</button>
</ul>
<ul>
  <button class="MECANIZACION">
     <li><a href="Mecanizacion.php" class="menu" ><font color="black">MECANIZACION</a></li> 
 </button>
</ul>
<ul>
    <button class="PECUARIA">
      <li> <a href="Pecuaria2.php" class="menu" ><font color="black">PECUARIA</a></li> 
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
    