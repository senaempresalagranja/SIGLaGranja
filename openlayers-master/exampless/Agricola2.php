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
                url: "kml/KmlAgricolas/LaGranja.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        map.addLayers([La_Granja]);

         var lote1 = new OpenLayers.Layer.Vector("Area Total", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlAgricolas/multipoligono/lote1.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
         var PC_Pina = new OpenLayers.Layer.Vector("Producto Piña", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlAgricolas/multipoligono/Pina.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var PC_Naranja = new OpenLayers.Layer.Vector("Producto Naranja", {
            description:'hola',
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlAgricolas/multipoligono/Naranja.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var lote2= new OpenLayers.Layer.Vector("Area Total", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlAgricolas/multipoligono/Lote2.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
         
         var Pera= new OpenLayers.Layer.Vector("Producto Pera", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlAgricolas/multipoligono/Pera.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
         var Cacao = new OpenLayers.Layer.Vector("Producto Cacao", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlAgricolas/multipoligono/Cacao.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
         var Hortalizas= new OpenLayers.Layer.Vector("Producto Hortiga", {

            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlAgricolas/multipoligono/Hortalizas.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var Uva = new OpenLayers.Layer.Vector("Producto Uva", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlAgricolas/multipoligono/Uva.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var Passifloras = new OpenLayers.Layer.Vector("Producto Passifloras", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlAgricolas/multipoligono/Passifloras.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var Guayaba= new OpenLayers.Layer.Vector("Producto Guayaba", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlAgricolas/multipoligono/Guayaba.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var Yuca= new OpenLayers.Layer.Vector("Producto Yuca", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlAgricolas/multipoligono/Yuca.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var Aromatica = new OpenLayers.Layer.Vector("Producto Aromatica", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlAgricolas/multipoligono/Aromaticas.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var Sabila = new OpenLayers.Layer.Vector("Producto Sabila", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlAgricolas/multipoligono/Sabila.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var Platano= new OpenLayers.Layer.Vector("Producto Platano", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlAgricolas/multipoligono/Platano.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var lotetres = new OpenLayers.Layer.Vector("Area Total", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlAgricolas/multipoligono/Lote3.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var lotecuatro = new OpenLayers.Layer.Vector("Area Total", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlAgricolas/multipoligono/Lote4.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var lotecinco = new OpenLayers.Layer.Vector("Area Total", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlAgricolas/multipoligono/Lote5.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var loteseis = new OpenLayers.Layer.Vector("Area Total", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlAgricolas/multipoligono/Lote6.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var lotesiete = new OpenLayers.Layer.Vector("Area Total", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlAgricolas/multipoligono/Lote7.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var loteocho = new OpenLayers.Layer.Vector("Area Total", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlAgricolas/multipoligono/Lote8.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        var lotenueve = new OpenLayers.Layer.Vector("Area Total", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "kml/KmlAgricolas/multipoligono/Lote9.kml",
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
                url: "kml/KmlAgricolas/PolAdmin.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
                
        });
        map.addLayers([PolAdmin]);

        var group = [lote1,PC_Pina,PC_Naranja];
        for (var i=0; i < group.length; i++) { group[i].group = 'Lote 1';
        for (var i=0; i < group.length; i++) { group[i].group = 'Lote 2'; } }
        map.addLayers([lote1,PC_Pina,PC_Naranja]);

        var group = [lote2,Pera,Cacao,Hortalizas,Uva,Passifloras,Guayaba,Yuca,Aromatica,Sabila,Platano];
        for (var i=0; i < group.length; i++) { group[i].group = 'Lote 2'; }
        map.addLayers([lote2,Pera,Cacao,Hortalizas,Uva,Passifloras,Guayaba,Yuca,Aromatica,Sabila,Platano]);

        var group = [lotetres];
        for (var i=0; i < group.length; i++) { group[i].group = 'Lote 3'; }
        map.addLayers([lotetres]);
        

        var group = [lotecuatro];
        for (var i=0; i < group.length; i++) { group[i].group = 'Lote 4'; }
        map.addLayers([lotecuatro]);
       

        var group = [lotecinco];
        for (var i=0; i < group.length; i++) { group[i].group = 'Lote 5'; }
        map.addLayers([lotecinco]);

        var group = [loteseis];
        for (var i=0; i < group.length; i++) { group[i].group = 'Lote 6'; }
        map.addLayers([loteseis]);

        var group = [lotesiete];
        for (var i=0; i < group.length; i++) { group[i].group = 'Lote 7'; }
        map.addLayers([lotesiete]);

        var group = [loteocho];
        for (var i=0; i < group.length; i++) { group[i].group = 'Lote 8'; }
        map.addLayers([loteocho]);

        var group = [lotenueve];
        for (var i=0; i < group.length; i++) { group[i].group = 'Lote 9'; }
        map.addLayers([lotenueve]);                  
         
          
            lote1.setVisibility(false),PC_Pina.setVisibility(false);
            
            PC_Naranja.setVisibility(false);
            lote2.setVisibility(false);
            Pera.setVisibility(false);
            Cacao.setVisibility(false);
            Hortalizas.setVisibility(false);
            Uva.setVisibility(false);
            Passifloras.setVisibility(false);
            Guayaba.setVisibility(false);
            Yuca.setVisibility(false);
            Aromatica.setVisibility(false);
            Sabila.setVisibility(false);
            Platano.setVisibility(false);
            lotetres.setVisibility(false);
            lotecuatro.setVisibility(false);
            lotecinco.setVisibility(false);
            loteseis.setVisibility(false);
            lotesiete.setVisibility(false);
            loteocho.setVisibility(false);
            lotenueve.setVisibility(false);
            PolAdmin.setVisibility(false);
var fpControl = new OpenLayers.Control.FeaturePopups({
                selectionBox: true,
                layers: [
                [
                    lote1 , {templates: {
                        single: "<table border='0'><tr><td width='200px'><center><h5>Lote 1 </h5></td></tr><tr><td width='200px'><img src='img/lot_8.png' class='LotesCultivos'></td></tr><tr><td><center><input type='submit' value='Ver m&aacute;s informaci&oacute;n' onclick='LoteUno()'></center></td></tr></table>",
                       

                    }}
                ],
                [
                    PC_Pina , {templates: {
                        single: "<table border='0'><tr><td width='200px'><center><h5>Cultivo Piña </h5></td></tr><tr><td width='200px'><img src='img/lot_8.png' class='LotesCultivos'></td></tr><tr><td><center><input type='submit' value='Ver m&aacute;s informaci&oacute;n' onclick='CultivoPina()'></center></td></tr></table>",
                       

                    }}
                ],
                [
                    PC_Naranja , {templates: {
                        single: "<table border='0'><tr><td width='200px'><center><h5>Cultivo Naranja </h5></td></tr><tr><td width='200px'><img src='img/lot_8.png' class='LotesCultivos'></td></tr><tr><td><center><input type='submit' value='Ver m&aacute;s informaci&oacute;n' onclick='CultivoNaranja()'></center></td></tr></table>",
                       

                    }}
                ],
                [
                    lote2 , {templates: {
                        single: '<table border="0"><tr><td><h5>Lote 2</h5></td></tr><tr><td width="200px"><img src="img/lot_8.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="LoteDos()"></center></td></tr></table>',
                    }}
                ],
                [
                    Pera , {templates: {
                        single: '<table border="0"><tr><td width="200px"><center><h5>Cultivo de Pera</h5></td></tr><tr><td width="200px"><img src="img/lot_5.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="CultivoAnonaceas()"></center></td></tr></table>',
                    }}
                ],
                [
                    Cacao , {templates: {
                        single: '<table border="0"><tr><td width="200px"><center><h5>Cultivo de Cacao</h5></td></tr><tr><td width="200px"><img src="img/lot_7.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="CultivoCacao()"></center></td></tr></table>',
                    }}
                ],
                [
                    Hortalizas , {templates: {
                        single: '<table border="0"><tr><td width="200px"><center><h5>Cultivo de Hortalizas</h5></td></tr><tr><td width="200px"><img src="img/lot_4.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="CultivoHortalizas()"></center></td></tr></table>',
                    }} 
                ],
                [
                    Uva , {templates: {
                        single: '<table border="0"><tr><td width="200px"><center><h5>Cultivo de Uva</h5></td></tr><tr><td width="200px"><img src="img/lot_3.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="CultivoUvas()"></center></td></tr></table>',
                    }}
                ],
                [
                    Passifloras , {templates: {
                        single: '<table border="0"><tr><td width="200px"><center><h5>Cultivo de Passiflora</h5></td></tr><tr><td width="200px"><img src="img/lot_2.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="CultivoPassifloras()"></center></td></tr></table>',
                    }}
                ],
                [
                    Guayaba , {templates: {
                        single: '<table border="0"><tr><td width="200px"><center><h5>Cultivo de Guayaba</h5></td></tr><tr><td width="200px"><img src="img/lot_12.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="CultivoGuayabas()"></center></td></tr></table>',
                    }}
                ],
                [
                    Yuca , {templates: {
                        single: '<table border="0"><tr><td width="200px"><center><h5>Cultivo de Yuca</h5></td></tr><tr><td width="200px"><img src="img/lot_13.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="CultivoYucas()"></center></td></tr></table>',
                    }} 
                ],
                [
                    Aromatica , {templates: {
                        single: '<table border="0"><tr><td width="200px"><center><h5>Cultivo de Aromatica</h5></td></tr><tr><td width="200px"><img src="img/lot_1.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="CultivoAromaticas()"></center></td></tr></table>',
                    }}
                ],
                [
                    Sabila , {templates: {
                        single: '<table border="0"><tr><td width="200px"><center><h5>Cultivo de Sabila</h5></td></tr><tr><td width="200px"><img src="img/lot_11.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="CultivoSabilas()"></center></td></tr></table>',
                    }}
                ],
                [
                    Platano , {templates: {
                        single: '<table border="0"><tr><td width="200px"><center><h5>Cultivo de Platano</h5></td></tr><tr><td width="200px"><img src="img/lot_10.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="CultivoPlatanos()"></center></td></tr></table>',
                    }}
                ],
                [
                    lotetres , {templates: {
                        single: '<table border="0"><tr><td><h5>Lote 3</h5></td></tr><tr><td width="200px"><img src="img/lot_5.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="LoteTres()" ></center></td></tr></table>',
                    }}
                ],
                [
                    lotecuatro , {templates: {
                        single: '<table border="0"><tr><td><h5>Lote 4</h5></td></tr><tr><td width="200px"><img src="img/lot_2.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n"  onclick="LoteCuatro()"></center></td></tr></table>',
                    }}

                ],
                [
                    lotecinco , {templates: {
                        single: '<table border="0"><tr><td><h5>Lote 5</h5></td></tr><tr><td width="200px"><img src="img/lot_1.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="LoteCinco()"></center></td></tr></table>',
                    }}
                ],
                [
                    loteseis , {templates: {
                        single: '<table border="0"><tr><td><h5>Lote 6</h5></td></tr><tr><td width="200px"><img src="img/lot_4.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="LoteSeis()" ></center></td></tr></table>',
                    }}
                ],
                [   
                    lotesiete , {templates: {
                        single: '<table border="0"><tr><td><h5>Lote 7</h5></td></tr><tr><td width="200px"><img src="img/lot_3.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="LoteSiete()"></center></td></tr></table>',
                    }}
                ],
                [
                    loteocho , {templates: {
                        single: '<table border="0"><tr><td><h5>Lote 8</h5></td></tr><tr><td width="200px"><img src="img/lot_6.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="LoteOcho()"></center></td></tr></table>',
                    }}
                ],
                [
                    lotenueve , {templates: {
                        single: '<table border="0"><tr><td><h5>Lote 9</h5></td></tr><tr><td width="200px"><img src="img/lot_7.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="LoteNueve()" ></center></td></tr></table>',
                    }}
                ]
                
                    

                
                    

            ]
          });

map.addControl(fpControl);
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
 </table>

 
       
    
     
        <!-- Descripcion para el pie de pagina-->
        <div id="foot">
         <?php include '../include/piepagina.php' ?>
        </div>      
    </div>        
  </body>
</html>
