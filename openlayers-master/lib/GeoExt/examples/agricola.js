var map = new OpenLayers.Map();
var bluemarble = new OpenLayers.Layer.WMS(
    "Global Imagery",
    "http://maps.opengeo.org/geowebcache/service/wms",
    {layers: "bluemarble"}
);
var sundials = new OpenLayers.Layer.Vector("Sundials");
map.addLayer(bluemarble);
map.addLayer(sundials);

var store = new GeoExt.data.FeatureStore({
    layer: sundials,
    proxy: new GeoExt.data.ProtocolProxy({
        protocol: new OpenLayers.Protocol.HTTP({
            url: "sundials.kml",
            format: new OpenLayers.Format.KML()
        })
    }),
    fields: [
        {name: 'title', type: 'string'},
        {name: 'description', type: 'string'}
    ],
    autoLoad: true
});

var mapPanel = new GeoExt.MapPanel({
    title: "Sundials",
    map: map,
    renderTo: 'mapPanel',
    height: 400,
    width: 600
});