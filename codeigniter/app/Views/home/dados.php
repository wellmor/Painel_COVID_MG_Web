<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="expires" content="Mon, 26 Jul 1997 05:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />
    <link rel="icon" href="/assets/images/virus.png">

    <!-- graficos -->
    <style>
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 360px;
            max-width: 800px;
            margin: 1em auto;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #EBEBEB;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }
    </style>
    <title>Painel COVID-MG</title>

    <style>
        #map {
            min-height: 600px;
            max-height: 800px
        }

        a.disable-links {
            pointer-events: none;
        }
    </style>
</head>

<?php if (isset($casos)) { ?>

    <body>
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v7.0&appId=204305290231388&autoLogAppEvents=1"></script>

        <header>
            <div class="collapse bg-dark" id="navbarHeader">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-md-7 py-4">
                            <h4 class="text-white">Sobre o projeto</h4>
                            <p class="text-muted"> Painel de Informações e Emissão de Alertas no Enfrentamento ao COVID-19 nas Microrregiões de Ubá e Juiz de Fora</p>
                        </div>
                        <div class="col-sm-4 offset-md-1 py-4">
                            <h4 class="text-white">Menu</h4>
                            <ul class="list-unstyled">
                                <li><a href="/home/projetos" class="text-white">Projetos</a></li>
                                <li><a href="/home/dicas" class="text-white">Dicas</a></li>
                                <li><a href="#" class="text-white">Doação</a></li>
                                <li><a href="/admin" class="text-white">Login</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navbar navbar-dark bg-dark box-shadow">
                <div class="container d-flex justify-content-between">
                    <a href="/home" class="navbar-brand d-flex align-items-center">
                        <strong>
                            <h6>COVID-19/MINAS GERAIS</h6>
                        </strong>
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
                        <li class="breadcrumb-item"><a href="/home">Buscar</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= esc($casos['nomeMunicipio']) ?></li>
                    </ol>
                    <h2 class="jumbotron-heading">Painel CoronaVírus</h2>
                    <p class="lead text-muted">Última Atualização em </p>
                    <p class="subtext"><strong><?php echo date("d/m/Y", strtotime($casos['dataCaso'])) ?></strong></p>
                    <p class="subtext"><small>fonte: <?php echo $casos['fonteCaso'] ?></small></p>
                </section>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-borda-azul animated bounceInUp slow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h3 class="cor1"><?php if (isset($casos['suspeitosCaso'])) echo $casos['suspeitosCaso'];
                                                                else echo '0'; ?></h3>
                                        <p class="subtext">Casos Suspeitos</p>
                                    </div>
                                    <div class="col">
                                        <img class="img" src="/assets/images/resultado.png" width="70" height="70" align="right" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-borda-amarelo animated bounceInUp slow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h3 class="cor2"><?php if (isset($casos['confirmadosCaso'])) echo $casos['confirmadosCaso'];
                                                                else echo '0'; ?></h3>
                                        <p class="subtext">Confirmados</p>
                                    </div>
                                    <div class="col">
                                        <img class="img" src="/assets/images/pesquisa.png" width="70" height="70" align="right" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-borda-verde animated bounceInUp slow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h3 class="cor3"><?php if (isset($casos['descartadosCaso'])) echo $casos['descartadosCaso'];
                                                                else echo '0'; ?></h3>
                                        <p class="subtext">Casos Descartados</p>
                                    </div>
                                    <div class="col">
                                        <img class="img" src="/assets/images/cancelar.png" width="70" height="70" align="right" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-borda-vermelho animated bounceInUp slow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h3 class="cor4"><?php if (isset($casos['obitosCaso'])) echo $casos['obitosCaso'];
                                                                else echo '0'; ?></h3>
                                        <p class="subtext">Casos de Óbitos</p>
                                    </div>
                                    <div class="col">
                                        <img class="img" src="/assets/images/certidao-de-obito.png" width="70" height="70" align="right" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-borda-rosa animated bounceInUp slow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h3 class="cor5"><?php if (isset($casos['recuperadosCaso'])) echo $casos['recuperadosCaso'];
                                                                else echo '0'; ?></h3>
                                        <p class="subtext">Casos Recuperados</p>
                                    </div>
                                    <div class="col">
                                        <img class="img" src="https://image.flaticon.com/icons/svg/2947/2947764.svg" width="70" height="70" align="right" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card  animated bounceInUp slow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <p class="subtext">Seja alertado</p>
                                        <!-- <button type="button" class="btn btn-warning"><i class="fas fa-bell"></i> Alerta</button> -->
                                        <a href="" type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-bell"></i> Alerta</a>

                                    </div>
                                    <div class="col">
                                        <img class="img" src="https://image.flaticon.com/icons/svg/1157/1157000.svg" width="70" height="70" align="right" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Em Construção</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img src="https://www.portugal-didactico.com/wp-content/uploads/2020/01/paginaEmConstrucao.png" width="100%" height="100%">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-7">
                        <div class="card animated bounceInUp slow delay-1s">
                            <div class="card-body">
                                <h5 class="subtext">Mapa</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Visualize diversas informações sobre seu município no mapa interativo</h6>
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card animated bounceInUp slow delay-1s">
                            <div class="card-body">
                                <h5 class="subtext">Noticias</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Atualize-se com infomações oficias</h6>
                                <!-- alterar as referencias da div pro campo da tabela municipio que contem o identificador da pagina -->
                                <div class="fb-page" data-href="https://www.facebook.com/<?= $casos['facebookMunicipio'] ?>" data-tabs="timeline" data-width="500" data-height="" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false">
                                    <blockquote cite="https://www.facebook.com/<?= $casos['facebookMunicipio'] ?>" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/<?= $casos['facebookMunicipio'] ?>">Município de Rio Pomba - Prefeitura</a></blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card animated bounceInUp slow delay-1s">
                            <div class="card-body">
                                <h5 class="subtext">Gráficos</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Acompanhe a evolução de casos em seu munícipio</h6>

                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="confirmados-tab" data-toggle="tab" href="#confirmados" role="tab" aria-controls="confirmados" aria-selected="true">Confirmados</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="suspeitos-tab" data-toggle="tab" href="#suspeitos" role="tab" aria-controls="suspeitos" aria-selected="false">Suspeitos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="descartados-tab" data-toggle="tab" href="#descartados" role="tab" aria-controls="descartados" aria-selected="false">Descartados</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="recuperados-tab" data-toggle="tab" href="#recuperados" role="tab" aria-controls="recuperados" aria-selected="false">Recuperados</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="obitos-tab" data-toggle="tab" href="#obitos" role="tab" aria-controls="obitos" aria-selected="false">Óbitos</a>
                                    </li>
                                </ul>

                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active chart-container" style="position: relative;" id="confirmados" role="tabpanel" aria-labelledby="confirmados-tab">
                                        <canvas id="chartConfirmados" width="400" height="400"></canvas>
                                    </div>
                                    <div class="tab-pane fade" id="suspeitos" role="tabpanel" aria-labelledby="suspeitos-tab">
                                        <canvas id="chartSuspeitos" width="400" height="400"></canvas>

                                    </div>
                                    <div class="tab-pane fade" id="descartados" role="tabpanel" aria-labelledby="descartados-tab">
                                        <canvas id="chartDescartados" width="400" height="400"></canvas>
                                    </div>
                                    <div class="tab-pane fade" id="recuperados" role="tabpanel" aria-labelledby="recuperados-tab">
                                        <canvas id="chartRecuperados" width="400" height="400"></canvas>
                                    </div>
                                    <div class="tab-pane fade" id="obitos" role="tabpanel" aria-labelledby="obitos-tab">
                                        <canvas id="chartObitos" width="400" height="400"></canvas>
                                    </div>

                                </div>
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
        <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
        <script src="/assets/dist/leaflet-search.js"></script>
        <script src="/assets/data/mg-geojson.js"></script>
        <script src="/assets/dist/BoundaryCanvas.js"></script>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>


        <!-- graficos -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
        <script>

        </script>
        <!-- graficos -->
        <script>
            function formatarData(datax) {
                var data = new Date(datax),
                    dia = data.getDate().toString().padStart(2, '0'),
                    mes = (data.getMonth() + 1).toString().padStart(2, '0'), //+1 pois no getMonth Janeiro começa com zero.
                    ano = data.getFullYear();
                return " " + dia + "/" + mes + "/" + ano + " ";
            }
            $(document).ready(function() {
                let dataCaso = [];
                let confirmados = [];
                let suspeitos = [];
                let descartados = [];
                let recuperados = [];
                let obitos = [];

                let id = <?php echo $casos['idMunicipio']; ?>;
                // alert('o id e ' + id);
                $.ajax({
                    url: "/Ajax/Graficos/getDados/" + id, //filtrar por municipio selecionado
                    method: "GET",
                    dataType: 'JSON',
                    success: function(data) {
                        for (var key in data) {
                            dataCaso.push(formatarData(data[key].datax))
                            confirmados.push(data[key].confirmados)
                            suspeitos.push(data[key].suspeitos)
                            descartados.push(data[key].descartados)
                            recuperados.push(data[key].recuperados)
                            obitos.push(data[key].obitos)
                        }

                        // grafico confirmados
                        let confirmadosData = {
                            labels: [...dataCaso],
                            datasets: [{
                                label: 'Casos confirmados',
                                data: [...confirmados]
                            }]
                        };
                        let ctc = $("#chartConfirmados");
                        let chartConfirmados = new Chart(ctc, {
                            type: 'line',
                            data: confirmadosData,
                            backgroundColor: '#FF0000'
                        });

                        // grafico suspeitos
                        let suspeitosData = {
                            labels: [...dataCaso],
                            datasets: [{
                                label: 'Casos suspeitos',
                                data: [...suspeitos]
                            }]
                        };
                        let cts = $("#chartSuspeitos");
                        let chartSuspeitos = new Chart(cts, {
                            type: 'line',
                            data: suspeitosData
                        });

                        // grafico descartados
                        let descartadosData = {
                            labels: [...dataCaso],
                            datasets: [{
                                label: 'Casos descartados',
                                data: [...descartados]
                            }]
                        };
                        let ctd = $("#chartDescartados");
                        let chartDescartados = new Chart(ctd, {
                            type: 'line',
                            data: descartadosData
                        });

                        // grafico obitos
                        let obitosData = {
                            labels: [...dataCaso],
                            datasets: [{
                                label: 'Casos óbitos',
                                data: [...obitos]
                            }]
                        };
                        let cto = $("#chartObitos");
                        let chartObitos = new Chart(cto, {
                            type: 'line',
                            data: obitosData
                        });

                        // grafico recuperados
                        let recuperadosData = {
                            labels: [...dataCaso],
                            datasets: [{
                                label: 'Casos recuperados',
                                data: [...recuperados]
                            }]
                        };
                        let ctr = $("#chartRecuperados");
                        let chartRecuperados = new Chart(ctr, {
                            type: 'line',
                            data: recuperadosData
                        });
                    }
                });
            });
        </script>

        <script>
            var geojson;
            //valores exemplos definidos em mg-geojson.js
            $(document).ready(function() {
                nome = '<?= $casos['nomeMunicipio'] ?>';
                nome = nome.normalize("NFD").replace(/[\u0300-\u036f]/g, "")
                nome = nome.toLowerCase();
                nome = nome.replace(/ /g, '-')
                $.getJSON(
                    'https://servicodados.ibge.gov.br/api/v1/localidades/municipios/' + nome,
                    function(data) {
                        id = data['id'];

                        link = "https://servicodados.ibge.gov.br/api/v2/malhas/" + id + "?formato=application/vnd.geo+json";
                        $.getJSON(link,
                            function(data) {
                                console.log(data);
                                geojson = data['features']['0']['geometry'];
                                coordinate = geojson['coordinates'][0][0];

                                test(parseFloat(coordinate[1]), parseFloat(coordinate[0]));
                                console.log(parseFloat(coordinate[0]), parseFloat(coordinate[1]));
                            })
                    }
                );
                // setTimeout(function(){ alert("Hello"); }, 3000);
            });

            function test(latitude, longitude) {
                var data = geojson;
                // console.log(data + "datae")

                var map = L.map('map').setView([latitude, longitude], 9),
                    osmUrl = 'https://{s}.tile.osm.org/{z}/{x}/{y}.png',
                    osmAttribution = '';

                var osm = L.TileLayer.boundaryCanvas(osmUrl, {
                    boundary: geom,
                    attribution: osmAttribution,
                    trackAttribution: true
                }).addTo(map);



                var featuresLayer = new L.GeoJSON(data, {
                    style: function(feature) {
                        return {
                            color: '#FF0000'
                        };
                    },
                    onEachFeature: function(feature, marker) {
                        marker.bindPopup('<p>Confirmados: <?= $casos['confirmadosCaso'] ?></p>' +
                            '<p>Suspeitos: <?= $casos['suspeitosCaso'] ?></p>' +
                            '<p>Descartados: <?= $casos['descartadosCaso'] ?></p>' +
                            '<p>Obitos: <?= $casos['obitosCaso'] ?></p>' +
                            '<p>Recuperados: <?= $casos['recuperadosCaso'] ?></p>');
                    }
                });

                map.addLayer(featuresLayer);
            }
        </script>

        <script type="text/javascript" src="/assets/dist/labs-common.js"></script>
    </body>

</html>
<?php } else echo ("<script LANGUAGE='JavaScript'>
    window.alert('Ainda não foram encontrados dados para a cidade selecionada');
    window.location.href='/home';
    </script>"); ?>