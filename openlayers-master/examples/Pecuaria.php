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
    <link rel="stylesheet" href="" type="text/css">
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
    //Este Método me Permite Utilizar una Seguridad cuando el Usuario Navegue en el Applicativo ***liseth2406****
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



       
        //---Creamos una variable que nos permita utilizar estilos para los marcadores por defecto---//
        var style_mark = OpenLayers.Util.extend({}, OpenLayers.Feature.Vector.style['default']);                               
            style_mark.graphicHeight = 28;
            style_mark.graphicXOffset = -12;
            style_mark.graphicYOffset = -25;
            style_mark.strokeOpacity = 1;




            //llamamos la Imagen que se mostrará como marcador enel mapa---//
            style_mark.externalGraphic = "img/Cultivo.png";
            
            //---en caso de no verse el marcador en el mapa, nos aparece un mensaje quu habrá problemas con el navegador ya sea internet Explorer o mozilla---// 
            style_mark.title = "Cultivo";

            //---Repetimos El Proceso para el marcador de los lotes del área Agrícola---//
            var style_mark_lote = OpenLayers.Util.extend({}, OpenLayers.Feature.Vector.style['default']);
           
            
            style_mark_lote.graphicHeight = 28;
            style_mark_lote.graphicXOffset = -12;
            style_mark_lote.graphicYOffset = -25;
            style_mark_lote.externalGraphic = "img/Lote.png";
            
          
            style_mark_lote.title = "Lote";



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
         var Ejemplo = new OpenLayers.Layer.Vector("PUNTO", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlPecuaria/Ejemplo.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });

       var Nombre_Area="AREA PECUARIA";

        map.addLayers([La_Granja]);

          var vectorLayer = new OpenLayers.Layer.Vector("Unidad Porcicultura");
          var point =
             new OpenLayers.Geometry.Point(-74.927204,4.174577).transform(epsg4326, projectTo)
             {description:'This is the value of<br>the description attribute'};
          var feature =
             new OpenLayers.Feature.Vector(point,null,style_mark);
             // Crear una capa vectorial
         
       

        
      
  // Añadir las features a la capa vectorial
        vectorLayer.addFeatures(
                [feature]);
        var group = [U_Porcicultura,vectorLayer];
        for (var i=0; i < group.length; i++) { group[i].group = 'Unidad Porcicultura'; }

 map.addLayers([U_Porcicultura,vectorLayer]);


 var vectorLayerPPiscicultura = new OpenLayers.Layer.Vector("Unidad Piscicultura");
          var Piscicultura =
             new OpenLayers.Geometry.Point( -74.926628, 4.171291).transform(epsg4326, projectTo)
             {description:'This is the value of<br>the description attribute'};
          var featurePiscicultura =
             new OpenLayers.Feature.Vector(Piscicultura,null,style_mark);
             // Crear una capa vectorial
         
       

        
      
  // Añadir las features a la capa vectorial
        vectorLayerPPiscicultura.addFeatures(
                [featurePiscicultura]);
        var group = [U_Piscicultura,vectorLayerPPiscicultura];
        for (var i=0; i < group.length; i++) { group[i].group = 'Unidad Piscicultura'; }

 map.addLayers([U_Piscicultura,vectorLayerPPiscicultura]);


var vectorLayerPOvinos= new OpenLayers.Layer.Vector("Unidad Ovinos");
          var Ovinos =
             new OpenLayers.Geometry.Point( -74.929499,4.171799).transform(epsg4326, projectTo)
             {description:'This is the value of<br>the description attribute'};
          var featureOvinos =
             new OpenLayers.Feature.Vector(Ovinos,null,style_mark);
             // Crear una capa vectorial
         
       

        
      
  // Añadir las features a la capa vectorial
        vectorLayerPOvinos.addFeatures(
                [featureOvinos]);
        var group = [U_Ovinos,vectorLayerPOvinos];
        for (var i=0; i < group.length; i++) { group[i].group = 'Unidad Ovinos'; }

 map.addLayers([U_Ovinos,vectorLayerPOvinos]);


var vectorLayerPGanaderia= new OpenLayers.Layer.Vector("Unidad Ganaderia");
          var Ganaderia =
             new OpenLayers.Geometry.Point( -74.926845,4.173213).transform(epsg4326, projectTo)
             {description:'This is the value of<br>the description attribute'};
          var featureGanaderia =
             new OpenLayers.Feature.Vector(Ganaderia,null,style_mark);
             // Crear una capa vectorial
         
       

        
      
  // Añadir las features a la capa vectorial
        vectorLayerPGanaderia.addFeatures(
                [featureGanaderia]);
        var group = [U_Ganaderia,vectorLayerPGanaderia];
        for (var i=0; i < group.length; i++) { group[i].group = 'Unidad Ganaderia'; }

 map.addLayers([U_Ganaderia,vectorLayerPGanaderia]);



var vectorLayerPEspMenores= new OpenLayers.Layer.Vector("Unidad Especie Menores");
          var EspMenores =
             new OpenLayers.Geometry.Point( -74.927578, 4.174019).transform(epsg4326, projectTo)
             {description:'This is the value of<br>the description attribute'};
          var featureEspMenores =
             new OpenLayers.Feature.Vector(EspMenores,null,style_mark);
             // Crear una capa vectorial
         
       

        
      
  // Añadir las features a la capa vectorial
        vectorLayerPEspMenores.addFeatures(
                [featureEspMenores]);
        var group = [U_EspeciesMenores,vectorLayerPEspMenores];
        for (var i=0; i < group.length; i++) { group[i].group = 'Unidad Especie Menores'; }

 map.addLayers([U_EspeciesMenores,vectorLayerPEspMenores]);

var vectorLayerPCaprinos= new OpenLayers.Layer.Vector("Unidad Caprinos");
          var Caprinos =
             new OpenLayers.Geometry.Point( -74.927360,4.173832).transform(epsg4326, projectTo)
             {description:'This is the value of<br>the description attribute'};
          var featureCaprinos =
             new OpenLayers.Feature.Vector(Caprinos,null,style_mark);
             // Crear una capa vectorial
         
       

        
      
  // Añadir las features a la capa vectorial
        vectorLayerPCaprinos.addFeatures(
                [featureCaprinos]);
        var group = [U_Caprinos,vectorLayerPCaprinos];
        for (var i=0; i < group.length; i++) { group[i].group = 'Unidad Caprinos'; }

 map.addLayers([U_Caprinos,vectorLayerPCaprinos]);


var vectorLayerPApicultura= new OpenLayers.Layer.Vector("Unidad Apicultura");
          var Apicultura =
             new OpenLayers.Geometry.Point( -74.926026,4.172210).transform(epsg4326, projectTo)
             {description:'This is the value of<br>the description attribute'};
          var featureApicultura =
             new OpenLayers.Feature.Vector(Apicultura,null,style_mark);
             // Crear una capa vectoria     
      
  // Añadir las features a la capa vectorial
        vectorLayerPApicultura.addFeatures(
                [featureApicultura]);
        var group = [U_Apicultura,vectorLayerPApicultura];
        for (var i=0; i < group.length; i++) { group[i].group = 'Unidad Apicultura'; }

 map.addLayers([U_Apicultura,vectorLayerPApicultura]);

var vectorLayerPPlantCon = 
                        new OpenLayers.Layer.Vector("Planta Concentrados");
var Planta_Concentrados =
                        new OpenLayers.Geometry.Point(-74.926541,4.173773).transform(epsg4326,projectTo)
                        {description:'This is the value of<br>the description attribute'};
var featurePlant_Con =
                        new OpenLayers.Feature.Vector(Planta_Concentrados,null,style_mark);

//Crear una Capa Vectorial

                        vectorLayerPPlantCon.addFeatures([featurePlant_Con]);
                        var group = [Plant_Con,vectorLayerPPlantCon];
                        for (var i=0; i < group.length; i++)
                            {
                                group[i].group = 'Planta Concentrados';
                            }
                        map.addLayers([Plant_Con,vectorLayerPPlantCon]);

var vectorLayerPRepBovina = 
                        new OpenLayers.Layer.Vector("Laboratorio Reproduccion Bovina");
var Lab_Bovinos =
                        new OpenLayers.Geometry.Point( -74.929644, 4.173656).transform(epsg4326,projectTo)
                        {description:'This is the value of<br>the description attribute'};
var featureLab_Bovinos =
                        new OpenLayers.Feature.Vector(Lab_Bovinos,null,style_mark);

//Crear una Capa Vectorial

                        vectorLayerPRepBovina.addFeatures([featureLab_Bovinos]);
                        var group = [Rep_Bovina,vectorLayerPRepBovina];
                        for (var i=0; i < group.length; i++)
                            {
                                group[i].group = 'Lab. Reproduccion Bovina';
                            }
                        map.addLayers([Rep_Bovina,vectorLayerPRepBovina]);

                        var group = [Ejemplo];
                        for (var i=0; i < group.length; i++)
                            {
                                group[i].group = 'Ejemplo';
                            }
                        map.addLayers([Ejemplo]);


var fpControl = new OpenLayers.Control.FeaturePopups({
                selectionBox: true,
                layers: [
                [
                    vectorLayer , {templates: {
                        single: "<table border='1'><tr><td width='200px'><center><h5>Unidad Porcinos </h5></td></tr><tr><td width='200px'><img src='img/Pecuaria/U_Porcinos.png' class='LotesCultivos'></td></tr><tr><td><center><input type='submit' value='Ver m&aacute;s informaci&oacute;n' onclick='Porcino()'></center></td></tr></table>",
                       

                    }}
                ],
                 [
                    vectorLayerPPiscicultura , {templates: {
                        single: "<table border='1'><tr><td width='200px'><center><h5>Unidad Piscicultura </h5></td></tr><tr><td width='200px'><img src='img/Pecuaria/U_Piscicultura.png' class='LotesCultivos'></td></tr><tr><td><center><input type='submit' value='Ver m&aacute;s informaci&oacute;n' onclick='Piscicultura()'></center></td></tr></table>",
                       

                    }}
                ],
                 [
                    Ejemplo , {templates: {
                        single: "<table border='1'><tr><td width='200px'><center><h5>Unidad Piscicultura </h5></td></tr><tr><td width='200px'><img src='img/Pecuaria/U_Piscicultura.png' class='LotesCultivos'></td></tr><tr><td><center><input type='submit' value='Ver m&aacute;s informaci&oacute;n' onclick='Piscicultura()'></center></td></tr></table>",
                       

                    }}
                ],
                 [
                    vectorLayerPOvinos, {templates: {
                        single: "<table border='1'><tr><td width='200px'><center><h5>Unidad Ovinos </h5></td></tr><tr><td width='200px'><img src='img/Pecuaria/U_Ovinos.png' class='LotesCultivos'></td></tr><tr><td><center><input type='submit' value='Ver m&aacute;s informaci&oacute;n' onclick='Ovinos()'></center></td></tr></table>",
                       

                    }}
                ],
                 [
                    vectorLayerPGanaderia, {templates: {
                        single: "<table border='1'><tr><td width='200px'><center><h5>Unidad Ganaderia </h5></td></tr><tr><td width='200px'><img src='img/Pecuaria/U_Ganaderia.png' class='LotesCultivos'></td></tr><tr><td><center><input type='submit' value='Ver m&aacute;s informaci&oacute;n' onclick='Ganaderia()'></center></td></tr></table>",
                       

                    }}
                ],
                 [
                    vectorLayerPEspMenores, {templates: {
                        single: "<table border='1'><tr><td width='200px'><center><h5>Unidad Especies Menores </h5></td></tr><tr><td width='200px'><img src='img/Pecuaria/U_Ganaderia.png' class='LotesCultivos'></td></tr><tr><td><center><input type='submit' value='Ver m&aacute;s informaci&oacute;n' onclick='Esp_Menores()'></center></td></tr></table>",
                       

                    }}
                ],
                [
                    vectorLayerPCaprinos, {templates: {
                        single: "<table border='1'><tr><td width='200px'><center><h5>Unidad Caprinos</h5></td></tr><tr><td width='200px'><img src='img/Pecuaria/U_Ovinos.png' class='LotesCultivos'></td></tr><tr><td><center><input type='submit' value='Ver m&aacute;s informaci&oacute;n' onclick='Caprinos()'></center></td></tr></table>",
                       

                    }}
                ],
                [
                    vectorLayerPPlantCon, {templates: {
                        single: "<table border='1'><tr><td width='200px'><center><h5>Unidad Planta Concentrado</h5></td></tr><tr><td width='200px'><img src='img/Pecuaria/U_Ovinos.png' class='LotesCultivos'></td></tr><tr><td><center><input type='submit' value='Ver m&aacute;s informaci&oacute;n' onclick='Planta_Concentrado()'></center></td></tr></table>",
                       
                    }}
                ],
                 [
                    vectorLayerPRepBovina, {templates: {
                        single: "<table border='1'><tr><td width='200px'><center><h5>Laboratorio Reproduccion Bovina</h5></td></tr><tr><td width='200px'><img src='img/Pecuaria/U_Ovinos.png' class='LotesCultivos'></td></tr><tr><td><center><input type='submit' value='Ver m&aacute;s informaci&oacute;n' onclick='Labbovinos()'></center></td></tr></table>",
                       

                    }}
                ],
                [
                  vectorLayerPApicultura, {templates: {
                        single: "<table border='1'><tr><td width='200px'><center><h5>Unidad Apicultura</h5></td></tr><tr><td width='200px'><img src='img/Pecuaria/U_Ovinos.png' class='LotesCultivos'></td></tr><tr><td><center><input type='submit' value='Ver m&aacute;s informaci&oacute;n' onclick='Apicultura()'></center></td></tr></table>",
                       

                    }}
                ]



                  
              ]
            });

         map.addControl(fpControl);





        map.addControl(new OpenLayers.Control.LayerSwitcherGroups());
        map.zoomToMaxExtent();

            map.setCenter(new OpenLayers.LonLat(-74.929449, 4.170463).transform(epsg4326, projectTo), 16);


          
        
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
        <li> <a href="Agricola2.php" class="menu" ><font color="black">IiNICIO</a></li>
      </button>
    </ul>
    <ul>
      <button class="GESTION">
        <li> <a href="Gestion.php" class="menu" ><font color="black">GESTION</a></li>
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
      <li> <a href="Pecuaria.php" class="menu" ><font color="black">PECUARIA</a></li> 
    </button>
  </ul>
  <ul>
    <button class="AMBIENTAL">
      <li> <a href="Ambiental.php" class="menu" ><font color="black">AMBIENTAL</font></a></li>

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
