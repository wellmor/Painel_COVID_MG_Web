<?php

// $link = mysqli_connect("localhost", "root", "", "covid_db");
include './conexao.php';

$sql = 'SELECT dataAtualizacao FROM atualizacao ORDER BY idAtualizacao DESC LIMIT 1';
$stmt = $pdo->query($sql);
$data =  $stmt->fetch();
$data = $data[0];
$data = explode('-', $data);
$ano = $data[0];
$mes = $data[1];
$dia = $data[2];


if(isset($_REQUEST["cod"])){
    $sql = 'SELECT * FROM caso_sumario WHERE codMunicipio = '.$_REQUEST["cod"].' ';
    $stmt = $pdo->query($sql);
    while ($row = $stmt->fetch()) {
        $id_tipo = $row['idTipoCaso'];
        if($id_tipo == 1) $desconhecido = $row['total'];
        else if($id_tipo == 3) $obito = $row['total'];
        else if($id_tipo == 4) $confirmado = $row['total'];
        else if($id_tipo == 5) $suspeito = $row['total'];
        else if($id_tipo == 2) $descartado = $row['total'];
    }

}
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css"> 
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
       <link rel="stylesheet" href="./dist/leaflet-search.css" />

    <link rel="icon" href="images/virus.png">    
  <style>
      #map { min-height: 600px; max-height: 800px }
</style>
    <title>Covid-19</title>
  </head>
  <body>
    <header>
      <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
              <h4 class="text-white">About</h4>
              <p class="text-muted">Add some information about the album below, the author, or any other background context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off to some social networking sites or contact information.</p>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
              <h4 class="text-white">Menu</h4>
              <ul class="list-unstyled">
                <li><a href="#" class="text-white">Cidades</a></li>
                <li><a href="#" class="text-white">Doação</a></li>
                <li><a href="#" class="text-white">Mapa</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="#" class="navbar-brand d-flex align-items-center">
              <strong><h6>COVID-19/MINAS GERAIS</h6></strong>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </header>
      
    <main role="main">
        <div class="container">
            <section class="jumbotron text-center p-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="Index.php">Buscar</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $_REQUEST["nome"] ?></li>
                </ol>
                <h2 class="jumbotron-heading">Painel CoronaVírus</h2>
                <p class="lead text-muted">Última Atualização em </p>
                <p class="subtext"><strong><?php echo $dia.'/'.$mes.'/'.$ano ?></strong></p>
            </section>
            <div class="row">
            <div class="col-md-3">
                <div class="card card-borda-azul animated bounceInUp slow">
                    <div class="card-body">
                        <div class="row">
                        <div class="col">    
                            <h3 class="cor1"><?php if(isset($suspeito)) echo $suspeito; else echo '0';?></h3>
                            <p class="subtext">Casos Suspeitos</p>
                        </div>
                        <div class="col">
                            <img class="img" src="images/resultado.png" width="70" height="70"  align="right" alt="">   
                        </div>    
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card card-borda-amarelo animated bounceInUp slow">
                    <div class="card-body">
                        <div class="row">
                        <div class="col">    
                            <h3 class="cor2"><?php if(isset($confirmado)) echo $confirmado; else echo '0';?></h3>
                            <p class="subtext">Casos Confirmados</p>
                        </div>
                        <div class="col">
                            <img class="img" src="images/pesquisa.png" width="70" height="70"  align="right" alt="">   
                        </div>    
                        </div>
                    </div>
                </div>
            </div>
                
            <div class="col-md-3">
                <div class="card card-borda-verde animated bounceInUp slow">
                    <div class="card-body">
                        <div class="row">
                        <div class="col">    
                            <h3 class="cor3"><?php if(isset($descartado)) echo $descartado; else echo '0';?></h3>
                            <p class="subtext">Casos Descartados</p>
                        </div>
                        <div class="col">
                            <img class="img" src="images/cancelar.png" width="70" height="70"  align="right" alt="">   
                        </div>    
                        </div>
                    </div>
                </div>
            </div>
                
            <div class="col-md-3">
                <div class="card card-borda-vermelho animated bounceInUp slow">
                    <div class="card-body">
                        <div class="row">
                        <div class="col">    
                            <h3 class="cor4"><?php if(isset($obito)) echo $obito; else echo '0';?></h3>
                            <p class="subtext">Casos de Óbitos</p>
                        </div>
                        <div class="col">
                            <img class="img" src="images/certidao-de-obito.png" width="70" height="70"  align="right" alt="">   
                        </div>    
                        </div>
                    </div>
                </div>
            </div>    
            </div>
            
            <div class="row">
                <div class="col-md-7">
                    <div class="card animated bounceInUp slow delay-1s">
                        <div class="card-body">
                            <h5 class="subtext">Mapa</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Encontre as mais próximas de você</h6>
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card animated bounceInUp slow delay-1s">
                        <div class="card-body">
                            <h5 class="subtext">Noticias</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Atualize-se com infomações oficiais</h6>
                        </div>
                    </div>
                </div>
            </div>
            
           <!--<div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body" align="center">
                            <img class="img" src="images/hospital.png"width="70" height="70" alt="">          
                            <h5 class="subtext">Unidade Saúde</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Encontre as mais próximas de você</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body" align="center">
                            <img class="img" src="images/hospital.png"width="70" height="70" alt="">          
                            <h5 class="subtext">Unidade Saúde</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Encontre as mais próximas de você</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body" align="center">
                            <img class="img" src="images/hospital.png"width="70" height="70" alt="">          
                            <h5 class="subtext">Unidade Saúde</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Encontre as mais próximas de você</h6>
                        </div>
                    </div>
                </div> 
            </div> -->   
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>
   <script src="./dist/leaflet-search.js"></script>
    <script src="./data/mg-geojson.js"></script>
    <script src="./dist/BoundaryCanvas.js"></script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
    var geojson;
    //valores exemplos definidos em mg-geojson.js
    $(document).ready(function() {
        nome =  '<?php echo $_REQUEST["nome"] ?>';
        nome = nome.normalize("NFD").replace(/[\u0300-\u036f]/g, "")
        nome = nome.toLowerCase();
        nome = nome.replace(/ /g, '-')
    $.getJSON(
    'https://servicodados.ibge.gov.br/api/v1/localidades/municipios/' +nome, 
    function(data) { 
        id = data['id'];
        
        link = "https://servicodados.ibge.gov.br/api/v2/malhas/"+id+"?formato=application/vnd.geo+json";
    $.getJSON(link, 
    function(data) { 
        console.log(data);
        geojson = data['features']['0']['geometry'];
        coordinate = geojson['coordinates'][0][0];
        console.log(coordinate)
        
        test();
        console.log(geojson);
    })
    }
    );
    // setTimeout(function(){ alert("Hello"); }, 3000);
});
    function test(){
    var data = geojson;
    console.log(data + "datae")

	var map = L.map('map').setView([-22, -44], 5),
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
				marker.bindPopup('jf');
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
    }
</script>

<script type="text/javascript" src="./dist/labs-common.js"></script>
  </body>
</html>