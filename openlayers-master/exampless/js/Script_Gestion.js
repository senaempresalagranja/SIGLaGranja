map = new OpenLayers.Map("mapdiv");
        map.addLayer(new OpenLayers.Layer.OSM());
        var kmllayer = new OpenLayers.Layer.Vector("KML", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "data/kml/La_Granja.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
        });
      
    
    map.addLayer(kmllayer);

      var Agricola = new OpenLayers.Layer.Vector("KML", {
            strategies: [new OpenLayers.Strategy.Fixed()],
            protocol: new OpenLayers.Protocol.HTTP({
                url: "data/kml/PoligonosAgricolas.kml",
                format: new OpenLayers.Format.KML({
                    extractStyles: true, 
                    extractAttributes: true,
                    maxDepth: 2
                })
            })
        });     
    map.addLayer(Agricola);
        
        epsg4326 =  new OpenLayers.Projection("EPSG:4326"); //WGS 1984 projection
        projectTo = map.getProjectionObject(); //The map projection (Spherical Mercator)
       
        var lonLat = new OpenLayers.LonLat( -74.928419 , 4.169769 ).transform(epsg4326, projectTo);
              
        
        var zoom=16;
        map.setCenter (lonLat, zoom);
    
        var vectorLayer = new OpenLayers.Layer.Vector("Overlay");
        
        // Define markers as "features" of the vector layer:
        var feature = new OpenLayers.Feature.Vector(
                new OpenLayers.Geometry.Point( -0.1279688, 51.5077286 ).transform(epsg4326, projectTo),
                {description:'This is the value of<br>the description attribute'} ,
                {externalGraphic: 'img/marker_L.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25  }
            );    
        vectorLayer.addFeatures(feature);
        
        var feature = new OpenLayers.Feature.Vector(
                new OpenLayers.Geometry.Point( -0.1244324, 51.5006728  ).transform(epsg4326, projectTo),//Localizacion por defecto (CENTRO)
                {description:'Big Ben'} ,
                {externalGraphic: 'img/marker_L.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25  }
            );    
        vectorLayer.addFeatures(feature);
//    ************************   ********************************
//    Aquí empiezan las variables correspondiente a los *(LOTES)*
//    ************************   ********************************
        var feature = new OpenLayers.Feature.Vector(
                new OpenLayers.Geometry.Point( -74.930396, 4.163649 ).transform(epsg4326, projectTo),
                {description:'<table border="1"><tr><td><h5>Lote 5</h5></td></tr><tr><td width="200px"><img src="img/lot_1.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="LoteCinco()"></center></td></tr></table>'} ,
                {externalGraphic: 'img/marker_L.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25  }
            ); //Esta marca pertenece al Lote 5 del Area Agricola
        vectorLayer.addFeatures(feature);
    
        var feature = new OpenLayers.Feature.Vector(
                new OpenLayers.Geometry.Point( -74.933509, 4.166119 ).transform(epsg4326, projectTo),
                {description:'<table border="1"><tr><td><h5>Lote 4</h5></td></tr><tr><td width="200px"><img src="img/lot_2.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n"  onclick="LoteCuatro()"></center></td></tr></table>'} ,
                {externalGraphic: 'img/marker_L.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25  }
            ); //Esta marca pertenece al Lote 4 del Area Agricola
        vectorLayer.addFeatures(feature);
    
        var feature = new OpenLayers.Feature.Vector(
                new OpenLayers.Geometry.Point( -74.929034, 4.164705).transform(epsg4326, projectTo),
                {description:'<table border="1"><tr><td><h5>Lote 7</h5></td></tr><tr><td width="200px"><img src="img/lot_3.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="LoteSiete()"></center></td></tr></table>'} ,   
                {externalGraphic: 'img/marker_L.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25  }
            );  //Esta marca pertenece al Lote 7 del Area Agricola
        vectorLayer.addFeatures(feature);
    
        var feature = new OpenLayers.Feature.Vector(
                new OpenLayers.Geometry.Point( -74.930316, 4.165616).transform(epsg4326, projectTo),
                {description:'<table border="1"><tr><td><h5>Lote 6</h5></td></tr><tr><td width="200px"><img src="img/lot_4.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="LoteSeis()" ></center></td></tr></table>'} ,   
                {externalGraphic: 'img/marker_L.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25  }
            );  //Esta marca pertenece al Lote 6 del Area Agricola
        vectorLayer.addFeatures(feature);
    
        var feature = new OpenLayers.Feature.Vector(
                new OpenLayers.Geometry.Point( -74.932794, 4.167491).transform(epsg4326, projectTo),
                {description:'<table border="1"><tr><td><h5>Lote 3</h5></td></tr><tr><td width="200px"><img src="img/lot_5.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="LoteTres()" ></center></td></tr></table>'} ,   
                {externalGraphic: 'img/marker_L.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25  }
            );  //Esta marca pertenece al Lote 3 del Area Agricola
        vectorLayer.addFeatures(feature);
    
        var feature = new OpenLayers.Feature.Vector(
                new OpenLayers.Geometry.Point( -74.928610, 4.166633).transform(epsg4326, projectTo),
                {description:'<table border="1"><tr><td><h5>Lote 8</h5></td></tr><tr><td width="200px"><img src="img/lot_6.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="LoteOcho()"></center></td></tr></table>'} ,   
                {externalGraphic: 'img/marker_L.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25  }
            );  //Esta marca pertenece al Lote 8 del Area Agricola
        vectorLayer.addFeatures(feature);
    
        var feature = new OpenLayers.Feature.Vector(
                new OpenLayers.Geometry.Point( -74.927358, 4.168105).transform(epsg4326, projectTo),
                {description:'<table border="1"><tr><td><h5>Lote 9</h5></td></tr><tr><td width="200px"><img src="img/lot_7.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="LoteNueve()" ></center></td></tr></table>'} ,   
                {externalGraphic: 'img/marker_L.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25  }
            );  //Esta marca pertenece al Lote 9 del Area Agricola
        vectorLayer.addFeatures(feature);
    
        var feature = new OpenLayers.Feature.Vector(
                new OpenLayers.Geometry.Point( -74.931245, 4.169226).transform(epsg4326, projectTo),
                {description:'<table border="1"><tr><td><h5>Lote 2</h5></td></tr><tr><td width="200px"><img src="img/lot_8.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="LoteCinco()"></center></td></tr></table>'} ,   
                {externalGraphic: 'img/marker_L.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25  }
            );  //Esta marca pertenece al Lote 2 del Area Agricola
        vectorLayer.addFeatures(feature);
    
        var feature = new OpenLayers.Feature.Vector(
                new OpenLayers.Geometry.Point( -74.930087, 4.170273).transform(epsg4326, projectTo),
                {description:'<table border="1"><tr><td width="200px"><center><h5>Lote 1</h5></td></tr><tr><td width="200px"><img src="img/lot_9.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="LoteUno()"></center></td></tr></table>'} ,   
                {externalGraphic: 'img/marker_L.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25  }
            );  //Esta marca pertenece al Lote 1 del Area Agricola
        vectorLayer.addFeatures(feature);
//    ************************   ***********************************
//    Aquí empiezan las variables correspondiente a los *(CULTIVOS)*
//    ************************   ***********************************
    
        var feature = new OpenLayers.Feature.Vector(
                new OpenLayers.Geometry.Point( -74.930987, 4.166869).transform(epsg4326, projectTo),
                {description:'<table border="1"><tr><td width="200px"><center><h5>Cultivo de Platano</h5></td></tr><tr><td width="200px"><img src="img/lot_10.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="CultivoPlatanos()"></center></td></tr></table>'} ,   
                {externalGraphic: 'img/marker_C.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25  }
            );  //Esta marca pertenece al Cultivo de Platano del Area Agricola
        vectorLayer.addFeatures(feature);
    
        var feature = new OpenLayers.Feature.Vector(
                new OpenLayers.Geometry.Point( -74.930747, 4.167317).transform(epsg4326, projectTo),
                {description:'<table border="1"><tr><td width="200px"><center><h5>Cultivo de Sabila</h5></td></tr><tr><td width="200px"><img src="img/lot_11.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="CultivoYucas()"></center></td></tr></table>'} ,   
                {externalGraphic: 'img/marker_C.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25  }
            );  //Esta marca pertenece al Cultivo de Sabilas del Area Agricola
        vectorLayer.addFeatures(feature);
    
        var feature = new OpenLayers.Feature.Vector(
                new OpenLayers.Geometry.Point( -74.931262, 4.167464).transform(epsg4326, projectTo),
                {description:'<table border="1"><tr><td width="200px"><center><h5>Cultivo de Guayaba</h5></td></tr><tr><td width="200px"><img src="img/lot_12.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="CultivoGuayabas()"></center></td></tr></table>'} ,   
                {externalGraphic: 'img/marker_C.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25  }
            );  //Esta marca pertenece al Cultivo de Guayabas del Area Agricola
        vectorLayer.addFeatures(feature);
    
        var feature = new OpenLayers.Feature.Vector(
                new OpenLayers.Geometry.Point( -74.931915, 4.168201).transform(epsg4326, projectTo),
                {description:'<table border="1"><tr><td width="200px"><center><h5>Cultivo de Yuca</h5></td></tr><tr><td width="200px"><img src="img/lot_13.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="CultivoYucas()"></center></td></tr></table>'} ,   
                {externalGraphic: 'img/marker_C.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25  }
            );  //Esta marca pertenece al Cultivo de Yucas del Area Agricola
        vectorLayer.addFeatures(feature);
    
        var feature = new OpenLayers.Feature.Vector(
                new OpenLayers.Geometry.Point( -74.930485, 4.167994).transform(epsg4326, projectTo),
                {description:'<table border="1"><tr><td width="200px"><center><h5>Cultivo de Aromatica</h5></td></tr><tr><td width="200px"><img src="img/lot_1.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="CultivoAromaticas()"></center></td></tr></table>'} ,   
                {externalGraphic: 'img/marker_C.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25  }
            );  //Esta marca pertenece al Cultivo de Aromaticas del Area Agricola
        vectorLayer.addFeatures(feature);
    
        var feature = new OpenLayers.Feature.Vector(
                new OpenLayers.Geometry.Point(-74.931547, 4.168808).transform(epsg4326, projectTo),
                {description:'<table border="1"><tr><td width="200px"><center><h5>Cultivo de Passiflora</h5></td></tr><tr><td width="200px"><img src="img/lot_2.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="LoteCinco()"></center></td></tr></table>'} ,   
                {externalGraphic: 'img/marker_C.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25  }
            );  //Esta marca pertenece al Cultivo de Passifloras del Area Agricola
        vectorLayer.addFeatures(feature);
    
        var feature = new OpenLayers.Feature.Vector(
                new OpenLayers.Geometry.Point(-74.932176, 4.169235).transform(epsg4326, projectTo),
                {description:'<table border="1"><tr><td width="200px"><center><h5>Cultivo de Uva</h5></td></tr><tr><td width="200px"><img src="img/lot_3.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="CultivoUvas()"></center></td></tr></table>'} ,   
                {externalGraphic: 'img/marker_C.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25  }
            );  //Esta marca pertenece al Cultivo de Uva del Area Agricola
        vectorLayer.addFeatures(feature);
    
        var feature = new OpenLayers.Feature.Vector(
                new OpenLayers.Geometry.Point(-74.930631, 4.169213).transform(epsg4326, projectTo),
                {description:'<table border="1"><tr><td width="200px"><center><h5>Cultivo de Hortalizas</h5></td></tr><tr><td width="200px"><img src="img/lot_4.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="CultivoHortalizas()"></center></td></tr></table>'} ,   
                {externalGraphic: 'img/marker_C.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25  }
            );  //Esta marca pertenece al Cultivo de Hortalizas del Area Agricola
        vectorLayer.addFeatures(feature);
    
        var feature = new OpenLayers.Feature.Vector(
                new OpenLayers.Geometry.Point(-74.931930, 4.169944).transform(epsg4326, projectTo),
                {description:'<table border="1"><tr><td width="200px"><center><h5>Cultivo de Anonaceas</h5></td></tr><tr><td width="200px"><img src="img/lot_5.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="CultivoAnonaceas()"></center></td></tr></table>'} ,   
                {externalGraphic: 'img/marker_C.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25  }
            );  //Esta marca pertenece al Cultivo de Anonaceas del Area Agricola
        vectorLayer.addFeatures(feature);
    
        var feature = new OpenLayers.Feature.Vector(
                new OpenLayers.Geometry.Point(-74.929915, 4.169335).transform(epsg4326, projectTo),
                {description:'<table border="1"><tr><td width="200px"><center><h5>Cultivo de Pi&ntilde;a</h5></td></tr><tr><td width="200px"><img src="img/lot_6.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="CultivoPina()"></center></td></tr></table>'} ,   
                {externalGraphic: 'img/marker_C.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25  }
            );  //Esta marca pertenece al Cultivo de Piña del Area Agricola
        vectorLayer.addFeatures(feature);
    
        var feature = new OpenLayers.Feature.Vector(
                new OpenLayers.Geometry.Point(-74.930949, 4.169812).transform(epsg4326, projectTo),
                {description:'<table border="1"><tr><td width="200px"><center><h5>Cultivo de Cacao</h5></td></tr><tr><td width="200px"><img src="img/lot_7.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="CultivoCacao()"></center></td></tr></table>'} ,   
                {externalGraphic: 'img/marker_C.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25  }
            );  //Esta marca pertenece al Cultivo de Cacao del Area Agricola
        vectorLayer.addFeatures(feature);
    
        var feature = new OpenLayers.Feature.Vector(
                new OpenLayers.Geometry.Point(-74.929449, 4.170466).transform(epsg4326, projectTo),
                {description:'<table border="1"><tr><td width="200px"><center><h5>Cultivo de Citricos</h5></td></tr><tr><td width="200px"><img src="img/lot_8.png" class="LotesCultivos"></td></tr><tr><td><center><input type="submit" value="Ver m&aacute;s informaci&oacute;n" onclick="LoteCinco()"></center></td></tr></table>'} ,   
                {externalGraphic: 'img/marker_C.png', graphicHeight: 25, graphicWidth: 21, graphicXOffset:-12, graphicYOffset:-25  }
            );  //Esta marca pertenece al Cultivo de Citricos del Area Agricola
        vectorLayer.addFeatures(feature);
    
       
        map.addLayer(vectorLayer);
    