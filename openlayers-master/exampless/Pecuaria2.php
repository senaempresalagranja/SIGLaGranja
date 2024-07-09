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
      Agricola
    </title>
  <!-- Llamo Todas Las Librerias para que mi Mapping se visualice Correctamente  -->
  <!--Aquí llamo La librería de Openlayers que me carga el Mapa Base del mundo -->
    <script src="../lib/OpenLayers.js"></script>
  <!--Aquí llamo una Librería que desarrollé para Configurar los Popups que salen al dar click en el marcador -->
    <script src="../lib/FeaturePopups.js"></script>
  <!--Aquí llamo una Librería que desarrollé para  Traer la Consulta en un Popup a Través de Funciones          Javascript -->
    <script type="text/javascript" src="Consultas/Js/PopupConsultaPec.js"></script>
  <!--Esta librería es Opcional por si queremos Cargar los estilos Propios de Open layers al Mapa Base -->
    <link rel="stylesheet" href="../theme/default/style.css" type="text/css">
  <!--En Esta Librería llamo todos los Estilos Desarrollados Para la interfaz gráfica del Aplicativo "SIGLaGranja Como Por ejemplo La ubicación del Banner,  Menú, Cuerpo y Pie de Página" -->
    <link rel="stylesheet" href="style.css" type="text/css">
  <!--En Esta Librería llamo todos Los Estilos que va a poseer El Popup cuando se abra -->
    <link rel="stylesheet" type="text/css" href="Consultas/Css/StyleConsulta_Pecuaria.css">
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
                url: "kml/KmlAgricolas/LaGranja.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        map.addLayers([La_Granja]);

        var U_Porcicultura = new OpenLayers.Layer.Vector("POLIGONO", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlPecuaria/Unidad_Porcicultura.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var Porcicultura = new OpenLayers.Layer.Vector("PUNTO", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlPecuaria/PuntoPorcicultura.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });

        var U_Piscicultura = new OpenLayers.Layer.Vector("POLIGONO", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlPecuaria/Unidad_Piscicultura.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var Piscicultura = new OpenLayers.Layer.Vector("PUNTO", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlPecuaria/PuntoPiscicultura.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
         var U_Ovinos = new OpenLayers.Layer.Vector("POLIGONO", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlPecuaria/Unidad_Ovinos.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
         var Ovinos = new OpenLayers.Layer.Vector("PUNTO", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlPecuaria/PuntoOvinos.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var U_Ganaderia = new OpenLayers.Layer.Vector("POLIGONO", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlPecuaria/Unidad_Ganaderia.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var Ganaderia = new OpenLayers.Layer.Vector("PUNTO", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlPecuaria/PuntoGanaderia.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var U_EspeciesMenores = new OpenLayers.Layer.Vector("POLIGONO", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlPecuaria/Unidad_EspeciesMenores.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var EspeciesMenores = new OpenLayers.Layer.Vector("Punto", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlPecuaria/PuntoEspeciesMenores.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var U_Caprinos = new OpenLayers.Layer.Vector("POLIGONO", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlPecuaria/Unidad_Caprinos.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var Caprinos = new OpenLayers.Layer.Vector("PUNTO", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlPecuaria/PuntoCaprinos.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var U_Apicultura = new OpenLayers.Layer.Vector("POLIGONO", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlPecuaria/Unidad_Apicultura.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var Apicultura = new OpenLayers.Layer.Vector("PUNTO", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlPecuaria/PuntoApicultura.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var Plant_Con = new OpenLayers.Layer.Vector("POLIGONO", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlPecuaria/Planta_Concentrados.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PlantCon = new OpenLayers.Layer.Vector("PUNTO", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlPecuaria/PuntoPlantaConcentrados.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var Rep_Bovina = new OpenLayers.Layer.Vector("POLIGONO", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlPecuaria/Laboratorio_Reproduccion_Bovina.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var Bovina = new OpenLayers.Layer.Vector("POLIGONO", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlPecuaria/PuntoReproduccion_Bovina.kml",
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
                url: "kml/KmlPecuaria/Total_Pecuaria.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        map.addLayers([PolAdmin]);
        var group = [U_Porcicultura,Porcicultura];
        for (var i=0; i < group.length; i++) { group[i].group = 'Unidad Porcicultura'; }
        map.addLayers([U_Porcicultura,Porcicultura]);

        var group = [U_Piscicultura,Piscicultura];
        for (var i=0; i < group.length; i++) { group[i].group = 'Unidad Piscicultura'; }
        map.addLayers([U_Piscicultura,Piscicultura]);

        var group = [U_Ovinos,Ovinos];
        for (var i=0; i < group.length; i++) { group[i].group = 'Unidad Ovinos'; }
        map.addLayers([U_Ovinos,Ovinos]);

        var group = [U_Ganaderia,Ganaderia];
        for (var i=0; i < group.length; i++) { group[i].group = 'Unidad Ganaderia'; }
        map.addLayers([U_Ganaderia,Ganaderia]);

        var group = [U_EspeciesMenores,EspeciesMenores];
        for (var i=0; i < group.length; i++) { group[i].group = 'Unidad Especies Menores'; }
        map.addLayers([U_EspeciesMenores,EspeciesMenores]);

        var group = [U_Caprinos,Caprinos];
        for (var i=0; i < group.length; i++) { group[i].group = 'Unidad Caprinos'; }
        map.addLayers([U_Caprinos,Caprinos]);

        var group = [U_Apicultura,Apicultura];
        for (var i=0; i < group.length; i++) { group[i].group = 'Unidad Apicultura'; }
        map.addLayers([U_Apicultura,Apicultura]);

        var group = [Plant_Con,PlantCon];
        for (var i=0; i < group.length; i++) { group[i].group = 'Planta Concentrados'; }
        map.addLayers([Plant_Con,PlantCon]);

        var group = [Rep_Bovina,Bovina];
        for (var i=0; i < group.length; i++) { group[i].group = 'Lab Reproduccion Bovina'; }
        map.addLayers([Rep_Bovina,Bovina]);

        U_Porcicultura.setVisibility(false);
        Porcicultura.setVisibility(false);
        U_Piscicultura.setVisibility(false);
        Piscicultura.setVisibility(false);
        U_Ovinos.setVisibility(false);
        Ovinos.setVisibility(false);
        U_Ganaderia.setVisibility(false);
        Ganaderia.setVisibility(false);
        U_EspeciesMenores.setVisibility(false);
        EspeciesMenores.setVisibility(false);
        U_Caprinos.setVisibility(false);
        Caprinos.setVisibility(false);
        Plant_Con.setVisibility(false);
        PlantCon.setVisibility(false);
        Rep_Bovina.setVisibility(false);
        Bovina.setVisibility(false);
        U_Apicultura.setVisibility(false);
        Apicultura.setVisibility(false);
    
        var fpControl = new OpenLayers.Control.FeaturePopups({
                selectionBox: true,
                layers: [
               [
                    Porcicultura , {templates: {
                        single: "<table border='0'><tr><td width='200px'><center><h5>Unidad Porcinos </h5></td></tr><tr><td width='200px'><img src='img/Pecuaria/U_Porcinos.png' class='LotesCultivos'></td></tr><tr><td><center><input type='submit' value='Ver m&aacute;s informaci&oacute;n' onclick='Porcino()'></center></td></tr></table>",
                       

                    }}
                ],
                 [
                    Piscicultura , {templates: {
                        single: "<table border='0'><tr><td width='200px'><center><h5>Unidad Piscicultura </h5></td></tr><tr><td width='200px'><img src='img/Pecuaria/U_Piscicultura.png' class='LotesCultivos'></td></tr><tr><td><center><input type='submit' value='Ver m&aacute;s informaci&oacute;n' onclick='Piscicultura()'></center></td></tr></table>",
                       

                    }}
                ],
                
                 [
                    Ovinos, {templates: {
                        single: "<table border='0'><tr><td width='200px'><center><h5>Unidad Ovinos </h5></td></tr><tr><td width='200px'><img src='img/Pecuaria/U_Ovinos.png' class='LotesCultivos'></td></tr><tr><td><center><input type='submit' value='Ver m&aacute;s informaci&oacute;n' onclick='Ovinos()'></center></td></tr></table>",
                       

                    }}
                ],
                 [
                    Ganaderia, {templates: {
                        single: "<table border='0'><tr><td width='200px'><center><h5>Unidad Ganaderia </h5></td></tr><tr><td width='200px'><img src='img/Pecuaria/U_Ganaderia.png' class='LotesCultivos'></td></tr><tr><td><center><input type='submit' value='Ver m&aacute;s informaci&oacute;n' onclick='Ganaderia()'></center></td></tr></table>",
                       

                    }}
                ],
                 [
                    EspeciesMenores, {templates: {
                        single: "<table border='0'><tr><td width='200px'><center><h5>Unidad Especies Menores </h5></td></tr><tr><td width='200px'><img src='img/Pecuaria/U_Ganaderia.png' class='LotesCultivos'></td></tr><tr><td><center><input type='submit' value='Ver m&aacute;s informaci&oacute;n' onclick='Esp_Menores()'></center></td></tr></table>",
                       

                    }}
                ],
                [
                    Caprinos, {templates: {
                        single: "<table border='0'><tr><td width='200px'><center><h5>Unidad Caprinos</h5></td></tr><tr><td width='200px'><img src='img/Pecuaria/U_Ovinos.png' class='LotesCultivos'></td></tr><tr><td><center><input type='submit' value='Ver m&aacute;s informaci&oacute;n' onclick='Caprinos()'></center></td></tr></table>",
                       

                    }}
                ],
                [
                    PlantCon, {templates: {
                        single: "<table border='0'><tr><td width='200px'><center><h5>Unidad Planta Concentrado</h5></td></tr><tr><td width='200px'><img src='img/Pecuaria/U_Ovinos.png' class='LotesCultivos'></td></tr><tr><td><center><input type='submit' value='Ver m&aacute;s informaci&oacute;n' onclick='Planta_Concentrado()'></center></td></tr></table>",
                       
                    }}
                ],
                 [
                    Bovina, {templates: {
                        single: "<table border='0'><tr><td width='200px'><center><h5>Laboratorio Reproduccion Bovina</h5></td></tr><tr><td width='200px'><img src='img/Pecuaria/U_Ovinos.png' class='LotesCultivos'></td></tr><tr><td><center><input type='submit' value='Ver m&aacute;s informaci&oacute;n' onclick='Labbovinos()'></center></td></tr></table>",
                       

                    }}
                ],
                [
                  Apicultura, {templates: {
                        single: "<table border='0'><tr><td width='200px'><center><h5>Unidad Apicultura</h5></td></tr><tr><td width='200px'><img src='img/Pecuaria/U_Ovinos.png' class='LotesCultivos'></td></tr><tr><td><center><input type='submit' value='Ver m&aacute;s informaci&oacute;n' onclick='Apicultura()'></center></td></tr></table>",
                       

                    }}
                ]

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