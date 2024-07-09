 
 
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
    <script type="text/javascript" src="Consultas/Js/PopupConsulta.js"></script>
  <!--Esta librería es Opcional por si queremos Cargar los estilos Propios de Open layers al Mapa Base -->
    <link rel="stylesheet" href="../theme/default/style.css" type="text/css">
  <!--En Esta Librería llamo todos los Estilos Desarrollados Para la interfaz gráfica del Aplicativo "SIGLaGranja Como Por ejemplo La ubicación del Banner,  Menú, Cuerpo y Pie de Página" -->
    <link rel="stylesheet" href="style.css" type="text/css">
  <!--En Esta Librería llamo todos Los Estilos que va a poseer El Popup cuando se abra -->
    <link rel="stylesheet" type="text/css" href="Consultas/Css/StyleConsulta.css">
  <!--Aquí llamo Los Estilos propios del Visor -->
    <style type="text/css">
    .smallmap
    {
      width: 1000px;
      height: 610px;

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
        map.setCenter(new OpenLayers.LonLat(-74.929449, 4.171338).transform(epsg4326, projectTo), 18);


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
        var PolAdmin = new OpenLayers.Layer.Vector("Poligono", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PolAdmin.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunAdmin = new OpenLayers.Layer.Vector("Punto", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunAdmin.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PolAdmin_Finca = new OpenLayers.Layer.Vector("Poligono", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PolAdmin_Finca.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunAdmin_Finca = new OpenLayers.Layer.Vector("Punto", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunAdmin_Finca.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PolAmb_Abierto = new OpenLayers.Layer.Vector("Poligono", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PolAmb_Abierto.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunAmb_Abierto = new OpenLayers.Layer.Vector("Punto", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunAmb_Abierto.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PolAmb_Nav = new OpenLayers.Layer.Vector("Poligono", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PolAmb_Nav.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunAmb_Nav = new OpenLayers.Layer.Vector("Punto", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunAmb_Nav.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PolApoyo_Admin = new OpenLayers.Layer.Vector("Poligono", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PolApoyo_Admin.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
         var PunApoyo_Admin = new OpenLayers.Layer.Vector("Punto", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunApoyo_Admin.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PolBanos_Hombres= new OpenLayers.Layer.Vector("Area 1", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PolBanos_Hombres.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunBanos_Hombres = new OpenLayers.Layer.Vector("Punto 1", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunBanos_Hombres.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PolBath_Instruct= new OpenLayers.Layer.Vector(" AreaInstructores", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PolBath_Instruct.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunBath_Instruct= new OpenLayers.Layer.Vector("Instructores", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunBath_Instruct.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PolBath_Men= new OpenLayers.Layer.Vector("Area 2", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PolBath_Men.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunBath_Men= new OpenLayers.Layer.Vector("Punto 2", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunBath_Men.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PolBath_Woman= new OpenLayers.Layer.Vector("Area Mujeres", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PolBath_Woman.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunBath_Woman= new OpenLayers.Layer.Vector("Punto Mujeres", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunBath_Woman.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PolBiblioteca= new OpenLayers.Layer.Vector("Poligono", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PolBiblioteca.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunBiblioteca= new OpenLayers.Layer.Vector("Punto", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunBiblioteca.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
         var PolBiblioteca= new OpenLayers.Layer.Vector("Poligono", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PolBiblioteca.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunBiblioteca= new OpenLayers.Layer.Vector("Punto", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunBiblioteca.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PolBienestar= new OpenLayers.Layer.Vector("Poligono", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PolBienestar.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunBienestar= new OpenLayers.Layer.Vector("Punto", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunBienestar.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PolCaf_instruct= new OpenLayers.Layer.Vector("Area Instructores", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PolCaf_instruct.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunCaf_instruct= new OpenLayers.Layer.Vector("Punto Instructores", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunCaf_instruct.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PolCafeteria= new OpenLayers.Layer.Vector("Area Publica", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PolCafeteria.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunCafeteria= new OpenLayers.Layer.Vector("Punto Publico", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunCafeteria.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PolCanch_Boleivol= new OpenLayers.Layer.Vector("Area Boleivol", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PolCanch_Boleivol.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunCanch_Boleivol= new OpenLayers.Layer.Vector("Punto Boleivol", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunCanch_Boleivol.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
         var PolCanch_Fut= new OpenLayers.Layer.Vector("Area Futbol", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PolCanch_Fut.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunCanch_Fut= new OpenLayers.Layer.Vector("Punto Futbol", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunCanch_Fut.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PolCanch_Micro= new OpenLayers.Layer.Vector("Area Microfutbol", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PolCanch_Micro.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunCanch_Micro= new OpenLayers.Layer.Vector("Area Microfutbol", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunCanch_Micro.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PolCapilla= new OpenLayers.Layer.Vector("Poligono", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PolCapilla.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunCapilla= new OpenLayers.Layer.Vector("Punto", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunCapilla.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PolCasino= new OpenLayers.Layer.Vector("Poligono", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PolCasino.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunCasino = new OpenLayers.Layer.Vector("Punto", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunCasino.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PolEnfermeria= new OpenLayers.Layer.Vector("Poligono", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PolEnfermeria.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunEnfermeria = new OpenLayers.Layer.Vector("Punto", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunEnfermeria.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PolGimnasio= new OpenLayers.Layer.Vector("Poligono", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PolGimnasio.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunGimnasio = new OpenLayers.Layer.Vector("Punto", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunGimnasio.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var Polhost= new OpenLayers.Layer.Vector("Area Mixta", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/Polhost.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var Punhost = new OpenLayers.Layer.Vector("Punto Mixto", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/Punhost.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var Polhost_Hombres= new OpenLayers.Layer.Vector("Area Hombres", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/Polhost_Hombres.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var Punhost_Hombres = new OpenLayers.Layer.Vector("Punto Hombres", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/Punhost_Hombres.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var Polhost_Mujeres= new OpenLayers.Layer.Vector("Area Mujeres", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/Polhost_Mujeres.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var Punhost_Mujeres = new OpenLayers.Layer.Vector("Punto Mujeres", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/Punhost_Mujeres.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PolIntendencia= new OpenLayers.Layer.Vector("Poligono", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PolIntendencia.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunIntendencia = new OpenLayers.Layer.Vector("Punto", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunIntendencia.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PolInvestigacion= new OpenLayers.Layer.Vector("Poligono", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PolInvestigacion.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunInvestigacion = new OpenLayers.Layer.Vector("Punto", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunInvestigacion.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PolParq_Inst= new OpenLayers.Layer.Vector("Area Institucional", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PolParq_Inst.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunParq_Ins = new OpenLayers.Layer.Vector("Punto Institucional", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PolParq_Ins.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PolParq_Pub= new OpenLayers.Layer.Vector("Area Publica", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PolParq_Pub.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunParq_Pub = new OpenLayers.Layer.Vector("Punto Publico", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunParq_Pub.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var  PolPlaza_Roja= new OpenLayers.Layer.Vector("Area1", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/ PolPlaza_Roja.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunPlaza_Roja = new OpenLayers.Layer.Vector("Punto1", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunPlaza_Roja.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var  PolPorteria= new OpenLayers.Layer.Vector("Poligono", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PolPorteria.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunPorteria = new OpenLayers.Layer.Vector("Punto", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunPorteria.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var  PolSala_Instruct= new OpenLayers.Layer.Vector("Poligono", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PolSala_Instruct.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunSala_Instruct = new OpenLayers.Layer.Vector("Punto", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunSala_Instruct.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var  PolSalon_Esmeralda= new OpenLayers.Layer.Vector("Poligono", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PolSalon_Esmeralda.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunSalon_Esmeralda = new OpenLayers.Layer.Vector("Punto", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunSalon_Esmeralda.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PolSalon_Herramientas= new OpenLayers.Layer.Vector("Poligono", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PolSalon_Herramientas.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunSalon_Herramientas= new OpenLayers.Layer.Vector("Punto", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunSalon_Herramientas.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PolSeg_Lab= new OpenLayers.Layer.Vector("Poligono", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PolSeg_Lab.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunSeg_Lab= new OpenLayers.Layer.Vector("Punto", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunSeg_Lab.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PolSombrillas= new OpenLayers.Layer.Vector("Poligono", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PolSombrillas.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunSombrillas= new OpenLayers.Layer.Vector("Punto", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunSombrillas.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PolTecnoParque= new OpenLayers.Layer.Vector("Poligono", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PolTecnoParque.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunTecnoParque= new OpenLayers.Layer.Vector("Punto", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunTecnoParque.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunZona_Agroindustria= new OpenLayers.Layer.Vector("Agroindustria", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunZona_Agroindustria.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunZona_Enfermeria= new OpenLayers.Layer.Vector("Enfermeria", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunZona_Enfermeria.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PunZona_Mec= new OpenLayers.Layer.Vector("Punto", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlZonas_Comunes/PunZona_Mec.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
         
        
                     
     map.addLayers([La_Granja,]);

      var Administracion= new OpenLayers.Layer.Vector("Administracion");
        var group = [PolAdmin,PunAdmin];
        for (var i=0; i < group.length; i++) { group[i].group = 'Administracion'; }
        map.addLayers([PolAdmin,PunAdmin]);
    //////////////////////////////////////////////////////////////////////////////////
      var AdminFinca= new OpenLayers.Layer.Vector("Administracion Finca");
        var group = [PolAdmin_Finca,PunAdmin_Finca];
        for (var i=0; i < group.length; i++) { group[i].group = 'Administracion Finca'; }
        map.addLayers([PolAdmin_Finca,PunAdmin_Finca]);
    //////////////////////////////////////////////////////////////////////////////////
      var Ambiente_Abierto= new OpenLayers.Layer.Vector("Ambiente Abierto");
        var group = [PolAmb_Abierto,PunAmb_Abierto];
        for (var i=0; i < group.length; i++) { group[i].group = 'Ambiene Abierto'; }
        map.addLayers([PolAmb_Abierto,PunAmb_Abierto]);
    //////////////////////////////////////////////////////////////////////////////////
      var Ambiente_Navegacion= new OpenLayers.Layer.Vector("Ambiente Navegacion");
        var group = [PolAmb_Nav,PunAmb_Nav];
        for (var i=0; i < group.length; i++) { group[i].group = 'Ambiene Navegacion'; }
        map.addLayers([PolAmb_Nav,PunAmb_Nav]);
    ////////////////////////////////////////////////////////////////////////////////// 
    var Apoyo_Administrativo= new OpenLayers.Layer.Vector("Apoyo Administrativo");
        var group = [PolApoyo_Admin,PunApoyo_Admin];
        for (var i=0; i < group.length; i++) { group[i].group = 'Apoyo Administrativo'; }
        map.addLayers([PolApoyo_Admin,PunApoyo_Admin]);
    //////////////////////////////////////////////////////////////////////////////////
    var Banos_Hombres= new OpenLayers.Layer.Vector("Baños");
        var group = [PolBanos_Hombres,PunBanos_Hombres,PolBath_Instruct,PunBath_Instruct,PolBath_Men,PunBath_Men,PolBath_Woman,PunBath_Woman];
        for (var i=0; i < group.length; i++) { group[i].group = 'Baños'; }
        map.addLayers([PolBanos_Hombres,PunBanos_Hombres,PolBath_Instruct,PunBath_Instruct,PolBath_Men,PunBath_Men,PolBath_Woman,PunBath_Woman]);
    ////////////////////////////////////////////////////////////////////////////////// 
    var Biblioteca= new OpenLayers.Layer.Vector("Biblioteca");
        var group = [PolBiblioteca,PunBiblioteca];
        for (var i=0; i < group.length; i++) { group[i].group = 'Biblioteca'; }
        map.addLayers([PolBiblioteca,PunBiblioteca]);
      ////////////////////////////////////////////////////////////////////////////////// 
    var Bienestar= new OpenLayers.Layer.Vector("Bienestar");
        var group = [PolBienestar,PunBienestar];
        for (var i=0; i < group.length; i++) { group[i].group = 'Bienestar'; }
        map.addLayers([PolBienestar,PunBienestar]);
       ////////////////////////////////////////////////////////////////////////////////// 
    var Caf_Instrucotres= new OpenLayers.Layer.Vector("Cafeteria");
        var group = [PolCaf_instruct,PunCaf_instruct,PolCafeteria,PunCafeteria];
        for (var i=0; i < group.length; i++) { group[i].group = 'Cafeteria'; }
        map.addLayers([PolCaf_instruct,PunCaf_instruct,PolCafeteria,PunCafeteria]);
      ////////////////////////////////////////////////////////////////////////////////// 
    var Canchas= new OpenLayers.Layer.Vector("Canchas");
        var group = [PolCanch_Boleivol,PunCanch_Boleivol,PolCanch_Fut,PunCanch_Fut,PolCanch_Micro,PunCanch_Micro];
        for (var i=0; i < group.length; i++) { group[i].group = 'Canchas'; }
        map.addLayers([PolCanch_Boleivol,PunCanch_Boleivol,PolCanch_Fut,PunCanch_Fut,PolCanch_Micro,PunCanch_Micro]);
     ////////////////////////////////////////////////////////////////////////////////// 
    var Capilla= new OpenLayers.Layer.Vector("Capilla");
        var group = [PolCapilla,PunCapilla];
        for (var i=0; i < group.length; i++) { group[i].group = 'Capilla'; }
        map.addLayers([PolCapilla,PunCapilla]);
     ////////////////////////////////////////////////////////////////////////////////// 
    var Casino= new OpenLayers.Layer.Vector("Casino");
        var group = [PolCasino,PunCasino];
        for (var i=0; i < group.length; i++) { group[i].group = 'Casino'; }
        map.addLayers([PolCasino,PunCasino]);
       ////////////////////////////////////////////////////////////////////////////////// 
    var Enfermeria= new OpenLayers.Layer.Vector("Enfermeria");
        var group = [PolEnfermeria,PunEnfermeria];
        for (var i=0; i < group.length; i++) { group[i].group = 'Enfermeria'; }
        map.addLayers([PolEnfermeria,PunEnfermeria]);
      ////////////////////////////////////////////////////////////////////////////////// 
    var Gimnasio= new OpenLayers.Layer.Vector("Gimnasio");
        var group = [PolGimnasio,PunGimnasio];
        for (var i=0; i < group.length; i++) { group[i].group = 'Gimnasio'; }
        map.addLayers([PolGimnasio,PunGimnasio]);
     ////////////////////////////////////////////////////////////////////////////////// 
    var Alojamientos= new OpenLayers.Layer.Vector("Alojamientos");
        var group = [Polhost,Punhost,Polhost_Hombres,Punhost_Hombres,Polhost_Mujeres,Punhost_Mujeres];
        for (var i=0; i < group.length; i++) { group[i].group = 'Alojamientos'; }
        map.addLayers([Polhost,Punhost,Polhost_Hombres,Punhost_Hombres,Punhost_Mujeres,Polhost_Mujeres]);
     ////////////////////////////////////////////////////////////////////////////////// 
    var Intendencia= new OpenLayers.Layer.Vector("Intendencia");
        var group = [PolIntendencia,PunIntendencia];
        for (var i=0; i < group.length; i++) { group[i].group = 'Intendencia'; }
        map.addLayers([PolIntendencia,PunIntendencia]);
    ////////////////////////////////////////////////////////////////////////////////// 
    var Investigacion= new OpenLayers.Layer.Vector("Investigacion");
        var group = [PolInvestigacion,PunInvestigacion];
        for (var i=0; i < group.length; i++) { group[i].group = 'Investigacion'; }
        map.addLayers([PolInvestigacion,PunInvestigacion]);
    ////////////////////////////////////////////////////////////////////////////////// 
    var Parqueaderos= new OpenLayers.Layer.Vector("Parqueaderos");
        var group = [PolParq_Inst,PunParq_Ins,PolParq_Pub,PunParq_Pub];
        for (var i=0; i < group.length; i++) { group[i].group = 'Parqueaderos'; }
        map.addLayers([PolParq_Inst,PunParq_Ins,PolParq_Pub,PunParq_Pub]);
    ////////////////////////////////////////////////////////////////////////////////// 
    var PlazaRoja= new OpenLayers.Layer.Vector("PlazaRoja");
        var group = [PolPlaza_Roja,PunPlaza_Roja];
        for (var i=0; i < group.length; i++) { group[i].group = 'PlazaRoja'; }
        map.addLayers([PolPlaza_Roja,PunPlaza_Roja]);
       ////////////////////////////////////////////////////////////////////////////////// 
    var Porteria= new OpenLayers.Layer.Vector("Porteria");
        var group = [PolPorteria,PunPorteria];
        for (var i=0; i < group.length; i++) { group[i].group = 'Porteria'; }
        map.addLayers([PolPorteria,PunPorteria]);
    ////////////////////////////////////////////////////////////////////////////////// 
    var Sala_Instructores= new OpenLayers.Layer.Vector("Sala Instructores");
        var group = [PolSala_Instruct,PunSala_Instruct];
        for (var i=0; i < group.length; i++) { group[i].group = 'Sala Instructores'; }
        map.addLayers([PolSala_Instruct,PunSala_Instruct]);
    ////////////////////////////////////////////////////////////////////////////////// 
    var Salon_Esmeralda= new OpenLayers.Layer.Vector("Salon Esmeralda");
        var group = [PolSalon_Esmeralda,PunSalon_Esmeralda];
        for (var i=0; i < group.length; i++) { group[i].group = 'Salon Esmeralda'; }
        map.addLayers([PolSalon_Esmeralda,PunSalon_Esmeralda]);
     ////////////////////////////////////////////////////////////////////////////////// 
    var PunSalon_Herramientas= new OpenLayers.Layer.Vector("Cuarto Herramientas");
        var group = [PolSalon_Herramientas,PunSalon_Herramientas];
        for (var i=0; i < group.length; i++) { group[i].group = 'Cuarto Herramientas'; }
        map.addLayers([PolSalon_Herramientas,PunSalon_Herramientas]);
    ////////////////////////////////////////////////////////////////////////////////// 
    var Seguridad_Laboral= new OpenLayers.Layer.Vector("Seguridad Laboral");
        var group = [PolSeg_Lab,PunSeg_Lab];
        for (var i=0; i < group.length; i++) { group[i].group = 'Seguridad Laboral'; }
        map.addLayers([PolSeg_Lab,PunSeg_Lab]);
     ////////////////////////////////////////////////////////////////////////////////// 
    var Sombrillas= new OpenLayers.Layer.Vector("Sombrillas");
        var group = [PolSombrillas,PunSombrillas];
        for (var i=0; i < group.length; i++) { group[i].group = 'Sombrillas'; }
        map.addLayers([PolSombrillas,PunSombrillas]);
     ////////////////////////////////////////////////////////////////////////////////// 
    var Tecnoparque= new OpenLayers.Layer.Vector("Tecnoparque");
        var group = [PolTecnoParque,PunTecnoParque];
        for (var i=0; i < group.length; i++) { group[i].group = 'Tecnoparque'; }
        map.addLayers([PolTecnoParque,PunTecnoParque]);
    ////////////////////////////////////////////////////////////////////////////////// 
    var Zonas_Hidra= new OpenLayers.Layer.Vector("Zonas Hidratacion");
        var group = [PunZona_Agroindustria,PunZona_Enfermeria,PunZona_Mec];
        for (var i=0; i < group.length; i++) { group[i].group = 'Zonas Hidratacion'; }
        map.addLayers([PunZona_Agroindustria,PunZona_Enfermeria,PunZona_Mec]);
      //////////////////////////////////////////////////////////////////////////////////

       PolAdmin.setVisibility (false);
      PunAdmin.setVisibility (false);
      PolAdmin_Finca.setVisibility (false);
      PunAdmin_Finca.setVisibility (false);
      PolAmb_Abierto.setVisibility (false);
      PunAmb_Abierto.setVisibility (false);
      PolAmb_Nav.setVisibility (false);
      PunAmb_Nav.setVisibility (false);
      PolApoyo_Admin.setVisibility (false);
      PunApoyo_Admin.setVisibility (false);
      PolBanos_Hombres.setVisibility (false);
      PunBanos_Hombres.setVisibility (false);
      PolBath_Instruct.setVisibility (false);
      PunBath_Instruct.setVisibility (false);
      PolBath_Men.setVisibility (false);
      PunBath_Men.setVisibility (false);
      PolBath_Woman.setVisibility (false);
      PunBath_Woman.setVisibility (false);
      PolBiblioteca.setVisibility (false);
      PunBiblioteca.setVisibility (false);
      PolBiblioteca.setVisibility (false);
      PunBiblioteca.setVisibility (false);
      PolBienestar.setVisibility (false);
      PunBienestar.setVisibility (false);
      PolCaf_instruct.setVisibility (false);
      PunCaf_instruct.setVisibility (false);
      PolCafeteria.setVisibility (false);
      PunCafeteria.setVisibility (false);
      PolCanch_Boleivol.setVisibility (false);
      PunCanch_Boleivol.setVisibility (false);
      PolCanch_Fut.setVisibility (false);
      PunCanch_Fut.setVisibility (false);
      PolCanch_Micro.setVisibility (false);
      PunCanch_Micro.setVisibility (false);
      PolCapilla.setVisibility (false);
      PunCapilla.setVisibility (false);
      PolCasino.setVisibility (false);
      PunCasino.setVisibility (false);
      PolEnfermeria.setVisibility (false);
      PunEnfermeria.setVisibility (false);
      PolGimnasio.setVisibility (false);
      PunGimnasio.setVisibility (false);
      Polhost.setVisibility (false);
      Punhost.setVisibility (false);
      Polhost_Hombres.setVisibility (false);
      Punhost_Hombres.setVisibility (false);
      Polhost_Mujeres.setVisibility (false);
      Punhost_Mujeres.setVisibility (false);
      PolIntendencia.setVisibility (false);
      PunIntendencia.setVisibility (false);
      PolInvestigacion.setVisibility (false);
      PunInvestigacion.setVisibility (false);
      PolParq_Inst.setVisibility (false);
      PunParq_Ins.setVisibility (false);
      PolParq_Pub.setVisibility (false);
      PunParq_Pub.setVisibility (false);
      PolPlaza_Roja.setVisibility (false);
      PunPlaza_Roja.setVisibility (false);
      PolPorteria.setVisibility (false);
      PunPorteria.setVisibility (false);
      PolSala_Instruct.setVisibility (false);
      PunSala_Instruct.setVisibility (false);
      PolSalon_Esmeralda.setVisibility (false);
      PunSalon_Esmeralda.setVisibility (false);
      PolSalon_Herramientas.setVisibility (false);
      PunSalon_Herramientas.setVisibility (false);
      PolSeg_Lab.setVisibility (false);
      PunSeg_Lab.setVisibility (false);
      PolSombrillas.setVisibility (false);
      PunSombrillas.setVisibility (false);
      PolTecnoParque.setVisibility (false);
      PunTecnoParque.setVisibility (false);
      PunZona_Agroindustria.setVisibility (false);
      PunZona_Enfermeria.setVisibility (false);
      PunZona_Mec.setVisibility (false);

     
      map.addControl(new OpenLayers.Control.LayerSwitcherGroups()); 
  
     
     
          
        
    }

    



map.addControl(fpControl);  
       



  </script>
  </head>
  <body onload="load()">
       <!-- Descripcion para el contenedor principal, campo de trabajo-->
    <div id="section">
      <div id="login">
        <?php include '../include/ingresar.php'; ?>
      </div>
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
        <li> <a href="Agricola2.php" class="menu" ><font color="black">INICIO</a></li>
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
