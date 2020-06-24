<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="expires" content="Mon, 26 Jul 1997 05:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <link rel="stylesheet" href="/assets/css/bootstrap.css"> <!-- framework base de estilo -->
    <link rel="stylesheet" href="/assets/css/main.css"> <!-- estilização do tema -->
    <link rel="stylesheet" href="/assets/css/animate.css"> <!-- dependencia do framework de estilo -->
    <link rel="stylesheet" href="/assets/css/leaflet.css" /> <!-- estilização própria do mapa -->
    <link rel="icon" href="/assets/images/virus.png"> <!-- favicon da página -->
    <link rel="stylesheet" href="/assets/css/dados.css"> <!-- estilo específico da página -->
    <script src="/assets/dist/jquery-3.5.1.js"></script> <!-- plugin base -->


    <!-- nova-nova pesquisa -->
    <link rel="stylesheet" href="/assets/css/jquery.typeahead.min.css">
    <script src="/assets/dist/jquery.typeahead.min.js"></script>

    <style>
        @media (max-width: 767.98px) {
            button.typeahead__filter-button {
                font-family: sans-serif;
                font-size: 10px;
                padding: 2px;
                height: 100%;
                margin: 0px;
            }
        }

        button.typeahead__filter-button {
            border-radius: 2px;
        }

        #pesquisar {
            border-radius: 2px;
        }

        #type-list .typeahead__list {
            max-height: 200px;
            overflow-y: auto;
            overflow-x: hidden;
            border-radius: 5px;
        }
    </style>
    <script>
        $(document).ready(function() {
            $("#pesquisar").click(function() {
                $("html, body").animate({
                    scrollTop: $("#back-scroll").offset().top
                }, 100);
                return true;
            });
        });
    </script>
    <!-- nova-nova pesquisa -->

    <title>Painel COVID-MG</title>
</head>


    <body>
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v7.0&appId=204305290231388&autoLogAppEvents=1"></script>

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
                    <div class="container">
                        <img src="/assets/images/logo.png" style="width: 192px; height: 56px">
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>

        <main role="main">
            <div class="container">
                <section class="jumbotron text-center">

                    <!-- pesquisa -->
                    <div class="card" style="width: 100%">
                        <div class="card-body">
                            <h5 class="card-title">Pesquise dados de sua cidade</h5>
                            <p class="card-text" id="back-scroll">Acompanhe a evolução de casos dos munícipios das <br /> Microrregiões de Ubá, Juiz de Fora e cidades dos entornos!</p>
                            <div class="container" id="type-list" style="margin: 0px; padding: 0px">
                                <div class="typeahead__container form-group">
                                    <div class="typeahead__field">
                                        <div class="typeahead__query">
                                            <input class="js-typeahead" placeholder="pesquise aqui..." id="pesquisar" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </section>

                <h2 class="jumbotron-heading"><i class="fas fa-map"></i> <?= esc($casos['nomeMunicipio']) ?></h2>
                <p class="lead text-muted small"><i class="fas fa-stopwatch"></i> Atualizado em <b><?= date("d/m/Y", strtotime(esc($casos['dataCaso']))) ?></b></p>
                <p class="subtext small"><b>FONTE:</b> <a style="word-break: break-all" target="_blank" href="<?= $casos['fonteCaso'] ?>"><?= $casos['fonteCaso'] ?></a></p>

                <div class="row" style="margin-top:20px;">
                    <div class="col-md-4">
                        <div class="card card-borda-azul animated bounceInUp slow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col text-left">
                                        <h3 class="cor1">
                                            <?php
                                            if (isset($casos['confirmadosCaso'])) {
                                                if ($casos['confirmadosCaso'] != "") {
                                                    echo $casos['confirmadosCaso'];
                                                } else {
                                                    echo '<div style="font-size: 19px;">Não informado</div>';
                                                }
                                            } else {
                                                echo '<div style="font-size: 19px;">Não cadastrado</div>';
                                            }
                                            ?></h3>
                                        <p class="subtext">Confirmados</p>
                                    </div>
                                    <div class="col text-right">
                                        <img class="img" src="/assets/images/pesquisa.png" width="70" height="70 text-right" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-borda-amarelo animated bounceInUp slow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col text-left">
                                        <h3 class="cor2">
                                            <?php
                                            if (isset($casos['suspeitosCaso'])) {
                                                if ($casos['suspeitosCaso'] != "") {
                                                    echo $casos['suspeitosCaso'];
                                                } else {
                                                    echo '<div style="font-size: 19px;">Não informado</div>';
                                                }
                                            } else {
                                                echo '<div style="font-size: 19px;">Não cadastrado</div>';
                                            }
                                            ?></h3>
                                        <p class="subtext">Suspeitos</p>
                                    </div>
                                    <div class="col text-right">
                                        <img class="img" src="/assets/images/resultado.png" width="70" height="70 text-right" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-borda-verde animated bounceInUp slow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col text-left">
                                        <h3 class="cor3">
                                            <?php
                                            if (isset($casos['descartadosCaso'])) {
                                                if ($casos['descartadosCaso'] != "") {
                                                    echo $casos['descartadosCaso'];
                                                } else {
                                                    echo '<div style="font-size: 19px;">Não informado</div>';
                                                }
                                            } else {
                                                echo '<div style="font-size: 19px;">Não informado</div>';
                                            }
                                            ?></h3>
                                        <p class="subtext">Descartados</p>
                                    </div>
                                    <div class="col text-right">
                                        <img class="img" src="/assets/images/cancelar.png" width="70" height="70 text-right" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-borda-vermelho animated bounceInUp slow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col text-left">
                                        <h3 class="cor4">
                                            <?php
                                            if (isset($casos['obitosCaso'])) {
                                                if ($casos['obitosCaso'] != "") {
                                                    echo $casos['obitosCaso'];
                                                } else {
                                                    echo '<div style="font-size: 19px;">Não informado</div>';
                                                }
                                            } else {
                                                echo '<div style="font-size: 19px;">Não cadastrado</div>';
                                            }
                                            ?></h3>
                                        <p class="subtext">Óbitos</p>
                                    </div>
                                    <div class="col text-right">
                                        <img class="img" src="/assets/images/certidao-de-obito.png" width="70" height="70 text-right" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-borda-rosa animated bounceInUp slow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col text-left">
                                        <h3 class="cor5">
                                            <?php
                                            if (isset($casos['recuperadosCaso'])) {
                                                if ($casos['recuperadosCaso'] != "") {
                                                    echo $casos['recuperadosCaso'];
                                                } else {
                                                    echo '<div style="font-size: 19px;">Não informado</div>';
                                                }
                                            } else {
                                                echo '<div style="font-size: 19px;">Não cadastrado</div>';
                                            }
                                            ?></h3>
                                        <p class="subtext">Recuperados</p>
                                    </div>
                                    <div class="col text-right">
                                        <img class="img" src="https://image.flaticon.com/icons/svg/2947/2947764.svg" width="70" height="70 text-right" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card  animated bounceInUp slow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col text-left">
                                        <p class="subtext">Seja alertado</p>
                                        <!--<a href="/alerta/municipio/<?= esc($casos['idMunicipio']) ?>" type="button" class="btn btn-warning"><i class="fas fa-bell"></i> Alerta</a>-->
                                        <a href="" type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-bell"></i> Alerta</a>
                                    </div>
                                    <div class="col text-right">
                                        <img class="img" src="https://image.flaticon.com/icons/svg/1157/1157000.svg" width="70" height="70 text-right" alt="">
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
                                <h5 class="modal-title" id="exampleModalLabel">Ops! Página em construção!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img src="/assets/images/paginaEmConstrucao.png" width="100%" height="100%">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card animated bounceInUp slow delay-1s">
                            <div class="card-body">
                                <h5 class="subtext">Mapa</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Visualize diversas informações sobre seu município no mapa interativo</h6>
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card animated bounceInUp slow delay-1s">
                            <div class="card-body" style="height: auto;">
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
                                        <canvas id="chartConfirmados" height="323vh"></canvas>
                                    </div>
                                    <div class="tab-pane fade" id="suspeitos" role="tabpanel" aria-labelledby="suspeitos-tab">
                                        <canvas id="chartSuspeitos" height="323vh"></canvas>
                                    </div>
                                    <div class="tab-pane fade" id="descartados" role="tabpanel" aria-labelledby="descartados-tab">
                                        <canvas id="chartDescartados" height="323vh"></canvas>
                                    </div>
                                    <div class="tab-pane fade" id="recuperados" role="tabpanel" aria-labelledby="recuperados-tab">
                                        <canvas id="chartRecuperados" height="323vh"></canvas>
                                    </div>
                                    <div class="tab-pane fade" id="obitos" role="tabpanel" aria-labelledby="obitos-tab">
                                        <canvas id="chartObitos" height="323vh"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-6">
                        <div class="card animated bounceInUp slow delay-1s">
                            <div class="card-body">
                                <h5 class="subtext">Notícias</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Atualize-se com informações oficiais</h6>
                                <!-- alterar as referencias da div pro campo da tabela municipio que contem o identificador da pagina -->
                                <div class="fb-page" data-href="https://www.facebook.com/<?= $casos['facebookMunicipio'] ?>" data-tabs="timeline" data-width="500" data-height="450" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false">
                                    <blockquote cite="https://www.facebook.com/<?= $casos['facebookMunicipio'] ?>" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/<?= $casos['facebookMunicipio'] ?>">Município de Rio Pomba - Prefeitura</a></blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card animated bounceInUp slow delay-1s">
                            <div class="card animated bounceInUp fast" style="margin:15px">
                                <div class="card-body text-center">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img src="/assets/images/business%20(1).png" width="70" height="70">
                                            <h5 class="subtext mt-2">Projetos</h5>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card-subtitle mb-4 text-muted">Projetos desenvolvidos pelo IF Sudeste</div>
                                            <a href="/home/projetos" type="button" class="btn btn-outline-dark btn-block">Ver mais</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card animated bounceInUp fast" style="margin:15px">
                                <div class="card-body text-center">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img src="/assets/images/dicas.png" width="70" height="70">
                                            <h5 class="subtext mt-2">Dicas</h5>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card-subtitle mb-4 text-muted">O que você precisa saber e fazer para evitar o contágio</div>
                                            <a href="/home/dicas" type="button" class="btn btn-outline-dark btn-block">Ver mais</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card animated bounceInUp fast" style="margin:15px">
                                <div class="card-body text-center">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img src="/assets/images/caixa.png" width="70" height="70">
                                            <h5 class="subtext mt-2">Doação</h5>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card-subtitle mb-4 text-muted">Saiba como ajudar quem realmente precisa</div>
                                            <a href="" type="button" class="btn btn-outline-dark btn-block" data-toggle="modal" data-target="#exampleModal">Ver mais</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Em construção</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="/assets/images/paginaEmConstrucao.png" width="100%" height="100%">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="/assets/dist/bootstrap.js"></script> <!-- script css base -->
        <script src="/assets/dist/fonte-awesome-all.js"></script> <!-- icones e fontes -->
        <script src="/assets/dist/leaflet.js"></script> <!-- plugin base do mapa -->
        <script src="/assets/data/mg-geojson.js"></script> <!-- layout do corte do mapa -->
        <script src="/assets/dist/BoundaryCanvas.js"></script> <!-- plugin para corte do mapa -->
        <script src="/assets/dist/lodash.js"></script> <!-- dependencia da pesquisa -->
        <script src="/assets/dist/list.js"></script> <!-- plugin de auxilio nos filtros da pesquisa -->
        <script src="/assets/dist/Chart.js"></script> <!-- graficos -->

        <script>
            function formatarData(datax) {
                var data = new Date(datax),
                    dia = (data.getDate()).toString().padStart(2, '0'),
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
                            dataE = (data[key].datax).split("-")
                            datex = dataE[2] + "/" + dataE[1] + "/" + dataE[0];
                            dataCaso.push(datex);
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
                                data: [...confirmados],
                                borderColor: 'rgb(255, 0, 0)',
                            }]
                        };
                        let ctc = $("#chartConfirmados");
                        let chartConfirmados = new Chart(ctc, {
                            type: 'line',
                            data: confirmadosData,
                        });

                        // grafico suspeitos
                        let suspeitosData = {
                            labels: [...dataCaso],
                            datasets: [{
                                label: 'Casos suspeitos',
                                data: [...suspeitos],
                                borderColor: 'rgb(255, 115, 0)'

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
                                data: [...descartados],
                                borderColor: 'rgb(0, 0, 255)'
                            }]
                        };
                        let ctd = $("#chartDescartados");
                        let chartDescartados = new Chart(ctd, {
                            type: 'line',
                            data: descartadosData,
                        });

                        // grafico obitos
                        let obitosData = {
                            labels: [...dataCaso],
                            datasets: [{
                                label: 'Casos óbitos',
                                data: [...obitos],
                                borderColor: 'rgb(0, 0, 0)',
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
                                data: [...recuperados],
                                borderColor: 'rgb(0, 255, 0)'
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
            $(document).ready(function() {

                var data;
                //http://localhost/ajax/municipios/getdados
                $.ajax({
                    url: "/Ajax/Pesquisa/getDados/", //filtrar por municipio selecionado
                    method: "GET",
                    success: function(retorno) {
                        data = JSON.parse(retorno);
                        // console.log(data);
                        typeof $.typeahead === 'function' && $.typeahead({
                            input: ".js-typeahead",
                            minLength: 0,
                            maxItem: false,
                            searchOnFocus: true,
                            accent: true,
                            order: "asc",
                            offset: true,
                            hint: true,
                            group: true,
                            backdrop: {
                                "background-color": "#000000",
                                "opacity": "0.3",
                                "filter": "alpha(opacity=10)"
                            },
                            // maxItemPerGroup: 10,
                            // cache: true,
                            groupOrder: function(node, query, result, resultCount, resultCountPerGroup) {
                                var scope = this,
                                    sortGroup = [];

                                for (var i in result) {
                                    sortGroup.push({
                                        group: i,
                                        length: result[i].length
                                    });
                                }
                                sortGroup.sort(
                                    scope.helper.sort(
                                        ["length"],
                                        true, // false = desc, the most results on top
                                        function(a) {
                                            return a.toString().toUpperCase()
                                        }
                                    )
                                );
                                return $.map(sortGroup, function(val, i) {
                                    return val.group
                                });
                            },
                            dropdownFilter: "Minas Gerais",
                            href: "{{display}}",
                            template: "{{display}}, <small><em>{{group}}</em></small>",
                            emptyTemplate: "sem resultados para {{query}}",
                            source: {
                                "Microrregião de Ubá": {
                                    data: data.uba
                                },
                                "Microrregião de Juiz de Fora": {
                                    data: data.jf
                                },
                                "Entornos": {
                                    data: data.entornos
                                },

                            },
                            callback: {
                                onClickAfter: function(node, a, item, event) {
                                    event.preventDefault();
                                    // var r = confirm("You will be redirected to:\n" + item.href + "\n\nContinue?");
                                    window.location.href = "https://covidmg.com/home/pesquisa/" + slugify(item.href);
                                    $('.js-result-container').text('');

                                },
                                onResult: function(node, query, obj, objCount) {
                                    // console.log(objCount)
                                    var text = "";
                                    if (query !== "") {
                                        text = objCount + ' localidades encontrada com "' + query + '"';
                                    }
                                    $('.js-result-container').text(text);

                                }
                            },
                            debug: false
                        });
                    },
                    error: function(retorno) {
                        console.log("Error");
                    }
                });



                function slugify(text) {
                    text = text.toString().toLowerCase().trim();

                    const sets = [{
                            to: 'a',
                            from: '[ÀÁÂÃÄÅÆĀĂĄẠẢẤẦẨẪẬẮẰẲẴẶἀ]'
                        },
                        {
                            to: 'c',
                            from: '[ÇĆĈČ]'
                        },
                        {
                            to: 'd',
                            from: '[ÐĎĐÞ]'
                        },
                        {
                            to: 'e',
                            from: '[ÈÉÊËĒĔĖĘĚẸẺẼẾỀỂỄỆ]'
                        },
                        {
                            to: 'g',
                            from: '[ĜĞĢǴ]'
                        },
                        {
                            to: 'h',
                            from: '[ĤḦ]'
                        },
                        {
                            to: 'i',
                            from: '[ÌÍÎÏĨĪĮİỈỊ]'
                        },
                        {
                            to: 'j',
                            from: '[Ĵ]'
                        },
                        {
                            to: 'ij',
                            from: '[Ĳ]'
                        },
                        {
                            to: 'k',
                            from: '[Ķ]'
                        },
                        {
                            to: 'l',
                            from: '[ĹĻĽŁ]'
                        },
                        {
                            to: 'm',
                            from: '[Ḿ]'
                        },
                        {
                            to: 'n',
                            from: '[ÑŃŅŇ]'
                        },
                        {
                            to: 'o',
                            from: '[ÒÓÔÕÖØŌŎŐỌỎỐỒỔỖỘỚỜỞỠỢǪǬƠ]'
                        },
                        {
                            to: 'oe',
                            from: '[Œ]'
                        },
                        {
                            to: 'p',
                            from: '[ṕ]'
                        },
                        {
                            to: 'r',
                            from: '[ŔŖŘ]'
                        },
                        {
                            to: 's',
                            from: '[ßŚŜŞŠȘ]'
                        },
                        {
                            to: 't',
                            from: '[ŢŤ]'
                        },
                        {
                            to: 'u',
                            from: '[ÙÚÛÜŨŪŬŮŰŲỤỦỨỪỬỮỰƯ]'
                        },
                        {
                            to: 'w',
                            from: '[ẂŴẀẄ]'
                        },
                        {
                            to: 'x',
                            from: '[ẍ]'
                        },
                        {
                            to: 'y',
                            from: '[ÝŶŸỲỴỶỸ]'
                        },
                        {
                            to: 'z',
                            from: '[ŹŻŽ]'
                        },
                        {
                            to: '-',
                            from: '[·/_,:;\']'
                        }
                    ];

                    sets.forEach(set => {
                        text = text.replace(new RegExp(set.from, 'gi'), set.to)
                    });

                    return text
                        .replace(/\s+/g, '-') // Replace spaces with -
                        .replace(/[^-a-zа-я\u0370-\u03ff\u1f00-\u1fff]+/g, '') // Remove all non-word chars
                        .replace(/--+/g, '-') // Replace multiple - with single -
                        .replace(/^-+/, '') // Trim - from start of text
                        .replace(/-+$/, '') // Trim - from end of text
                }
            });
        </script>

        <script>
            $(document).ready(function() {
                var geojson;
                //valores exemplos definidos em mg-geojson.js
                $(document).ready(function() {
                    nome = '<?= $casos['nomeMunicipio'] ?>';
                    slug = '<?= $casos['slugMunicipio'] ?>';
                    nome = nome.normalize("NFD").replace(/[\u0300-\u036f]/g, "")
                    nome = nome.toLowerCase();
                    nome = nome.replace(/ /g, '-')
                    if (slug != 'minas-gerais') {
                        $.getJSON(
                            'https://servicodados.ibge.gov.br/api/v1/localidades/municipios/' + nome,
                            function(data) {
                                id = data['id'];

                                link = "https://servicodados.ibge.gov.br/api/v2/malhas/" + id + "?formato=application/vnd.geo+json";
                                $.getJSON(link,
                                    function(data) {
                                        // console.log(data);
                                        geojson = data['features']['0']['geometry'];
                                        coordinate = geojson['coordinates'][0][0];

                                        test(parseFloat(coordinate[1]), parseFloat(coordinate[0]), 10, 0.03);
                                        // console.log(parseFloat(coordinate[0]), parseFloat(coordinate[1]));
                                    })
                            }
                        );
                    } else {
                        link = "https://servicodados.ibge.gov.br/api/v2/malhas/31?formato=application/vnd.geo+json";
                        $.getJSON(link,
                            function(data) {
                                // console.log(data);
                                geojson = data['features']['0']['geometry'];
                                coordinate = geojson['coordinates'][0][0];

                                test(parseFloat(coordinate[1]), parseFloat(coordinate[0]), 5, 3);
                                // console.log(parseFloat(coordinate[0]), parseFloat(coordinate[1]));
                            })
                    }
                    // setTimeout(function(){ alert("Hello"); }, 3000);
                });


                function test(latitude, longitude, zoom, correcao) {
                    var data = geojson;
                    // console.log(data + "datae")

                    var map = L.map('map').setView([latitude, longitude - correcao], zoom),
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
            });
        </script>

        <script type="text/javascript" src="/assets/dist/labs-common.js"></script>
    </body>

</html>
