var data = lugares_mg;

var map = L.map(document.getElementById('map')).setView([-21.244818462189064, -43.17910194396973], 9),
    osmUrl = 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
    osmAttribution = '';

var osm = L.TileLayer.boundaryCanvas(osmUrl, {
    boundary: geom, 
    attribution: osmAttribution,
    trackAttribution: true
}).addTo(map);



var featuresLayer = new L.GeoJSON(data, {
        style: function(feature) {
            return {color: feature.properties.color };
        },
        onEachFeature: function(feature, marker) {
            marker.bindPopup('<h4 style="color:'+feature.properties.color+'">'+ feature.properties.name +'</h4><ul><li>confirmados :12</li><li>suspeitos: 34</li><li>óbitos: 2</li></ul>');
        }
    });


map.addLayer(featuresLayer);

var searchControl = new L.Control.Search({
    layer: featuresLayer,
    propertyName: 'name',
    marker: false,
    moveToLocation: function(latlng, title, map) {
        //map.fitBounds( latlng.layer.getBounds() );
        var zoom = map.getBoundsZoom(latlng.layer.getBounds());
          map.setView(latlng, zoom); // access the zoom
    }
});


searchControl.on('search:locationfound', function(e) {
    
    //console.log('search:locationfound', );

    //map.removeLayer(this._markerSearch)

    e.layer.setStyle({fillColor: '#3f0', color: '#0f0'});
    if(e.layer._popup)
        e.layer.openPopup();

}).on('search:collapsed', function(e) {

    featuresLayer.eachLayer(function(layer) {	//restore feature color
        featuresLayer.resetStyle(layer);
    });	
});

map.addControl( searchControl );  //inizialize search control
