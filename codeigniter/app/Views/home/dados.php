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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" crossorigin="anonymous"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/regular.min.js" crossorigin="anonymous"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/solid.min.js" crossorigin="anonymous"></script>

    <style>
        .scrollbar {
            float: left;
            /* height: 300px; */
            width: 65px;
            background: #F5F5F5;
            overflow-y: scroll;
        }

        .force-overflow {
            max-height: 200px;
        }

        #wrapper {
            text-align: center;
            margin: auto;
        }

        #scrollbarzera::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            background-color: #F5F5F5;
        }

        #scrollbarzera::-webkit-scrollbar {
            width: 6px;
            background-color: #F5F5F5;
        }

        #scrollbarzera::-webkit-scrollbar-thumb {
            background-color: rgba(60, 60, 60, 0.1);
            border-radius: 3px;
        }

        .form-control:focus {
            border-color: #cccccc;
            -webkit-box-shadow: none;
            box-shadow: none;
        }
    </style>
    <style>
        #municipios {
            display: none;
        }

        .list {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        #test {
            border-bottom: 1px solid #ccc;
            display: block;
            border-color: rgba(220, 220, 220, 0.9);
        }

        .list--list-item {
            /* padding-bottom: 20px; */
            border-bottom: 1px solid #ccc;
        }

        .list--list-item:last-child {
            border-bottom: 0;
            margin: 0;
        }

        .no-result {
            display: none;
        }

        li a {
            display: block;
        }

        p {
            width: 100%;
        }

        .jumbotron {
            background-color: #E0E0E0;
            padding: 1rem 0.5rem;
            margin-bottom: 1rem;
        }

        .form-control {
            border-radius: 5px;
            width: 100%;
            padding: 16px 20px;
            background-color: #FAFAFA;
        }

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

        #map {
            min-height: 600px;
            max-height: 800px
        }

        a.disable-links {
            pointer-events: none;
        }

        hr {
            margin-top: 0rem;
            margin-bottom: 0rem;
            border: 0;
            padding: 0;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }
    </style>
    <title>Painel COVID-MG</title>


</head>

<?php if (isset($casos)) { ?>

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
                    <p class="lead text-muted"><i class="fas fa-search"></i> Filtre por microrregião...</p>
                    <div id="municipio">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group form-check-inline">
                                    <div class="radio-inline" style="margin-right: 5px">
                                        <label>
                                            <input class="filter-all" type="radio" value="todas" name="microrregiao" id="microrregiao-all" checked /> Todas
                                        </label>
                                    </div>
                                    <div class="radio-inline" style="margin-right: 5px">
                                        <label>
                                            <input class="filter" type="radio" value="microrregiao-uba" name="microrregiao" id="microrregiao-uba" />
                                            Ubá
                                        </label>
                                    </div>
                                    <div class="radio-inline" style="margin-right: 5px">
                                        <label>
                                            <input class="filter" type="radio" value="microrregiao-jf" name="microrregiao" id="microrregiao-jf" />
                                            Juiz de Fora
                                        </label>
                                    </div>
                                    <div class="radio-inline">
                                        <label>
                                            <input class="filter" type="radio" value="microrregiao-outras" name="microrregiao" id="microrregiao-outras" />
                                            Outras
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row filter-group">
                            <div class="col-md-12">
                                <div class="form-group" style="padding-bottom:0px; margin-bottom: 0px">
                                    <div class="input-group">
                                        <input type="text" id="search" class="search form-control form-control-lg" placeholder="Digite o nome da cidade..." style="height: 50px" autocomplete="off" />
                                        <div class="input-group-append" style="display: none;" id="closeButton">
                                            <button class="btn btn-secondary" type="button">X</button>
                                        </div>
                                    </div>
                                </div>

                                </button>
                            </div>
                        </div>
                        <div id="municipios">

                            <div class="no-result">Woops! Não encontramos nada.</div>

                            <div class="scrollbar force-overflow" id="scrollbarzera" style="width: 100%; max-height: 200px; background-color: rgba(245, 245, 245, 0.75); border-radius: 3px; margin-bottom: 50px">
                                <ul class="list" id="fuck">
                                    <script>
                                        $(document).ready(function() {

                                            $("#fuck").load("/Ajax/Pesquisa/getDados");
                                        });
                                    </script>

                            

                                    <!-- <li class="btn dropdown-item" style="padding-left: 10px;" data-microrregiao="microrregiao-jf">
                                    <a href="/home/pesquisa/rio-pomba" style="text-decoration: none; color: black;">
                                        <h5 class="name text-center">Juiz de Fora</h5>
                                    </a>
                                </li>
                                <hr /> -->

                                </ul>
                            </div>
                        </div>
                    </div>
                </section>


                <h2 class="jumbotron-heading"><i class="fas fa-map"></i> <?= esc($casos['nomeMunicipio']) ?></h2>
                <p class="lead text-muted small"><i class="fas fa-stopwatch"></i> Atualizado em <b><?= date("d/m/Y", strtotime(esc($casos['dataCaso']))) ?></b></p>
                <p class="subtext small"><b>FONTE:</b> <a target="_blank" href="<?= $casos['fonteCaso'] ?>"><?= $casos['fonteCaso'] ?></a></p>
                <div class="row">
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
                                <h6 class="card-subtitle mb-2 text-muted">Atualize-se com infomações oficiais</h6>
                                <!-- alterar as referencias da div pro campo da tabela municipio que contem o identificador da pagina -->
                                <div class="fb-page" data-href="https://www.facebook.com/<?= $casos['facebookMunicipio'] ?>" data-tabs="timeline" data-width="500" data-height="600" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false">
                                    <blockquote cite="https://www.facebook.com/<?= $casos['facebookMunicipio'] ?>" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/<?= $casos['facebookMunicipio'] ?>">Município de Rio Pomba - Prefeitura</a></blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7">
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
                                        <canvas id="chartConfirmados" height="208vh"></canvas>
                                    </div>
                                    <div class="tab-pane fade" id="suspeitos" role="tabpanel" aria-labelledby="suspeitos-tab">
                                        <canvas id="chartSuspeitos" height="208vh"></canvas>
                                    </div>
                                    <div class="tab-pane fade" id="descartados" role="tabpanel" aria-labelledby="descartados-tab">
                                        <canvas id="chartDescartados" height="208vh"></canvas>
                                    </div>
                                    <div class="tab-pane fade" id="recuperados" role="tabpanel" aria-labelledby="recuperados-tab">
                                        <canvas id="chartRecuperados" height="208vh"></canvas>
                                    </div>
                                    <div class="tab-pane fade" id="obitos" role="tabpanel" aria-labelledby="obitos-tab">
                                        <canvas id="chartObitos" height="208vh"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card animated bounceInUp slow delay-1s ">
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
                                            <h6 class="card-subtitle mb-4 text-muted">O que você precisa saber e fazer</h6>
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
                                            <h6 class="card-subtitle mb-4 text-muted">Saiba como ajudar</h6>
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
                <!-- footer -->


            </div>
        </main>
        <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
        <script src="/assets/dist/leaflet-search.js"></script>
        <script src="/assets/data/mg-geojson.js"></script>
        <script src="/assets/dist/BoundaryCanvas.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/2.4.1/lodash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->

        <!-- graficos -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
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
            //search
            $('#municipios').hide();

            $('#microrregiao-uba, #microrregiao-jf, #microrregiao-outras, #microrregiao-all').on('click', function() {
                $('#municipios').fadeIn(300);
                $('#closeButton').fadeIn(300);

            });

            $('#closeButton').on('click', function() {
                $('#closeButton').hide();
                $('#municipios').hide();

            });

            $('#search').on('focus', function() {
                $('#municipios').fadeIn(300);
                $('#closeButton').fadeIn(300);
            });

            var options = {
                valueNames: [
                    'name',
                    {
                        data: ['microrregiao']
                    }
                ],
            };
            var municipiosList;
            $("#fuck").load("/Ajax/Pesquisa/getDados", function() {
                var municipiosList = new List('municipio', options);
                $(function() {
                    //updateList();
                    $("input[name=microrregiao]").change(updateList);

                    municipiosList.on('updated', function(list) {
                        if (list.matchingItems.length > 0) {
                            $('.no-result').hide();
                        } else {
                            $('.no-result').show();

                        }
                    });
                });

                // function resetList() {
                //     municipiosList.search();
                //     municipiosList.filter();
                //     municipiosList.update();
                //     $(".filter-all").prop('checked', true);
                //     $('.filter').prop('checked', false);
                //     $('.search').val('');
                //     $('#municipios').hide();
                //     //console.log('Reset Successfully!');
                // };

                function updateList() {
                    var val_microrregiao = $("input[name=microrregiao]:checked").val();
                    console.log(val_microrregiao);

                    municipiosList.filter(function(item) {
                        var microrregiaoFilter = false;

                        if (val_microrregiao == "todas") {
                            microrregiaoFilter = true;
                        } else {
                            microrregiaoFilter = item.values().microrregiao == val_microrregiao;

                        }

                        return microrregiaoFilter
                    });
                    municipiosList.update();
                }

                //
            });





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
        </script>

        <script type="text/javascript" src="/assets/dist/labs-common.js"></script>
    </body>

</html>
<?php } else echo ("<script LANGUAGE='JavaScript'>
    window.alert('Ainda não foram encontrados dados para a cidade selecionada');
    window.location.href='/home';
    </script>"); ?>

<!--<div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <img class="img" src="images/hospital.png"width="70" height="70" alt="">          
                            <h5 class="subtext">Unidade Saúde</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Encontre as mais próximas de você</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <img class="img" src="images/hospital.png"width="70" height="70" alt="">          
                            <h5 class="subtext">Unidade Saúde</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Encontre as mais próximas de você</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <img class="img" src="images/hospital.png"width="70" height="70" alt="">          
                            <h5 class="subtext">Unidade Saúde</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Encontre as mais próximas de você</h6>
                        </div>
                    </div>
                </div> 
            </div> -->