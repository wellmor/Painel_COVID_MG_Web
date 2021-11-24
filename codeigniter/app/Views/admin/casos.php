<!doctype html>
<html lang="pt_BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>Painel COVID</title>
    <link rel="icon" href="/assets/images/virus.png">
    <link href="/assets/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/assets/css/datatables.min.css" />
    <script src="/assets/dist/jquery-3.5.1.js"></script>

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .loader {
            display: none;
            position: fixed;
            z-index: 1000;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background: rgba(255, 255, 255, .8) url('../assets/loading.gif') 50% 50% no-repeat;
        }

        body.loading .loader {
            overflow: hidden;
        }

        body.loading .loader {
            display: block;
        }
    </style>

    <link href="/assets/css/dashboard.css" rel="stylesheet">
</head>

<body>

    <!-- header -->
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Painel COVID</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <!-- sidebar -->
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="sidebar-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/painel">
                                <span data-feather="home"></span>
                                Início <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/admin/casos">
                                <span data-feather="bar-chart-2"></span>
                                Cadastro/Relatórios
                            </a>
                        </li>
                    </ul>
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Meus dados</span>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/perfil">
                                <span data-feather="user"></span>
                                Perfil (<?= session()->get('nomeUsuario') ?>)
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/logout">
                                <span data-feather="log-out"></span>
                                Sair
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- conteudo -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2" style="margin-right: 20px">Relatório</h1>
                    <!-- <div class="col-sm-3 text-right">
                    Selecione o municipio
                </div> -->


                    <div class="col-md-5 float-right" style="margin:0px; padding:0px">
                        <select class="form-control" id="municipio"></select>
                    </div>
                    <div class="col-md-6 float-left">
                        <button type="button" class="btn btn-primary" data-toggle="modal" onclick="modalCadCaso()" style="margin: 5px">
                            <span data-feather="plus"></span>
                            Cadastrar
                        </button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin: 5px">
                                <span data-feather="info"></span> Legenda
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#" onclick="modalCadLegenda()"><span data-feather="plus" style="margin: 5px"></span> Cadastrar</a>
                                <a class="dropdown-item" href="#" id="btnLegendasGer"><span data-feather="eye" style="margin: 5px"></span> Ver
                                    todas</a>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success" data-toggle="modal" onclick="verificarRelatorio()" style="margin: 5px">
                            <span data-feather="check"></span>
                            Verificar município
                        </button>
                        <button type="button" id="btnSumarizado" class="btn btn-success" data-toggle="modal" onclick="toggleSumarizados()" style="margin: 5px">
                            <span id="iconSumarizado"></span>
                            <!--quando clica pra ver, ele mostra a coluna de sumarizado, tipo um toggle -->
                            Ver sumarizados
                        </button>
                    </div>
                </div>


                <ul class="nav nav-tabs justify-content-end" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="casos-tab" data-toggle="tab" href="#casos" role="tab" aria-controls="home" aria-selected="true">Casos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#leitos" role="tab" aria-controls="profile" aria-selected="false">Leitos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#vacinas" role="tab" aria-controls="contact" aria-selected="false">Vacinas</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="casos" role="tabpanel" aria-labelledby="casos-tab">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" style="width: 100%" id="tableCasos">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Data</th>
                                        <th>Fonte</th>
                                        <th>Munícipio</th>
                                        <th>Confirmados</th>
                                        <th>Suspeitos</th>
                                        <th>Descartados</th>
                                        <th>Recuperados</th>
                                        <th>Óbitos</th>
                                        <th>Id Município</th>
                                        <th>Sumarizado</th>
                                        <th style="width: 20%">Ações</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="leitos" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" style="width: 100%" id="tableLeitos">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Data</th>
                                        <th>Munícipio</th>
                                        <th>Totais UTI</th>
                                        <th>Ocupados UTI</th>
                                        <th>Totais Clínico</th>
                                        <th>Ocupados Clínico</th>
                                        <th>Id Município</th>
                                        <th>Fonte</th>
                                        <th style="width: 20%">Ações</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="vacinas" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" style="width: 100%" id="tableVacinas">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Data</th>
                                        <th>Munícipio</th>
                                        <th>1 Dose</th>
                                        <th>2 Dose</th>
                                        <th>3 Dose</th>
                                        <th>Id Município</th>
                                        <th style="width: 20%">Ações</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>

            </main>
        </div>
    </div>

    <!-- Modal casos -->
    <div class="modal fade bd-example-modal-lg" id="modalCasosAE" tabindex="-1" data-backdrop="true" role="dialog" aria-labelledby="modalCasosAELabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCasosAELabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formCasos" method="post">
                        <div class="form-group row" style="background-color: #F2F2F2; border-radius:10px; margin: 5px; padding:5px;">
                            <input type="hidden" id="idCaso" name="idCaso">
                            <input type="hidden" id="idMunicipio" name="idMunicipio">
                            <div class="col-sm-12">
                                <h5>Casos</h5>
                            </div>
                            <div class="col-sm-10" id="divDesativarCasos">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="desativarCasos">
                                    <label class="form-check-label" for="desativarCasos">
                                        Não informar
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-3 formCasos">
                                <label>Confirmados</label>
                                <input type="number" min="0" class="form-control" name="confirmados" id="confirmados" placeholder="confirmados">
                            </div>
                            <div class="col-sm-3 formCasos">
                                <label>Suspeitos</label>
                                <input type="number" min="0" class="form-control" name="suspeitos" id="suspeitos" placeholder="suspeitos">
                            </div>
                            <div class="col-sm-3 formCasos">
                                <label>Descartados</label>
                                <input type="number" min="0" class="form-control" name="descartados" id="descartados" placeholder="descartados">
                            </div>
                            <div class="col-sm-3 formCasos">
                                <label>Recuperados</label>
                                <input type="number" min="0" class="form-control" name="recuperados" id="recuperados" placeholder="recuperados">
                            </div>
                            <div class="col-sm-2 formCasos">
                                <label>Obitos</label>
                                <input type="number" min="0" class="form-control" name="obitos" id="obitos" placeholder="obitos">
                            </div>
                            <div class="col-sm-6 formCasos">
                                <label>Data</label>
                                <input type="date" class="form-control" name="data-caso" id="data-caso" style="background-color:#ff6a6a; color: #000">
                            </div>
                            <div class="col-sm-6 formCasos">
                                <label>Fonte</label>
                                <input type="text" class="form-control" name="fonte" id="fonte" placeholder="https://www.google.com.br/">
                            </div>
                        </div>
                        <div class="form-group row" style="background-color: #F2F2F2; border-radius:10px; margin: 5px; padding:5px;" id="leitosEvacinometro">
                            <div class="col-sm-12">
                                <h5>Leitos</h5>
                            </div>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="desativarLeitos" checked>
                                    <label class="form-check-label" for="desativarLeitos">
                                        Não informar
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-3 formLeitos">
                                <label>Totais UTI</label>
                                <input type="number" min="0" class="form-control" name="qntLeitosDisponiveisUTI" id="qntLeitosDisponiveisUTI" style="color: green;">
                            </div>
                            <div class="col-sm-3 formLeitos">
                                <label>Ocupados UTI</label>
                                <input type="number" min="0" class="form-control" name="qntLeitosOcupadosUTI" id="qntLeitosOcupadosUTI" style="color: red;">
                            </div>
                            <div class="col-sm-3 formLeitos">
                                <label>Totais Clínico</label>
                                <input type="number" min="0" class="form-control" name="qntLeitosDisponiveisClinico" id="qntLeitosDisponiveisClinico" style="color: green;">
                            </div>
                            <div class="col-sm-3 formLeitos">
                                <label>Ocupados Clínico</label>
                                <input type="number" min="0" class="form-control" name="qntLeitosOcupadosClinico" id="qntLeitosOcupadosClinico" style="color: red;">
                            </div>

                            <div class="col-sm-6 formLeitos">
                                <label>Data</label>
                                <input type="date" class="form-control" name="dataLeitos" id="dataLeitos" style="background-color:#ff6a6a; color: #000">
                            </div>
                            <div class="col-sm-6 formLeitos">
                                <label>Fonte</label>
                                <input type="text" class="form-control" name="fonteLeitos" id="fonteLeitos" placeholder="https://www.google.com.br/">
                            </div>
                            <div class="col-sm-12" style="padding-top: 15px">
                                <h5>Vacinômetro</h5>
                            </div>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="desativarVacinometro" name="desativarVacinometro" checked>
                                    <label class="form-check-label" for="desativarVacinometro">
                                        Não informar
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6 formVacinometro">
                                <label>1ª Dose</label>
                                <input type="number" min="0" class="form-control" name="qnt1Dose" id="qnt1Dose">
                            </div>
                            <div class="col-sm-6 formVacinometro">
                                <label>2ª Dose</label>
                                <input type="number" min="0" class="form-control" name="qnt2Dose" id="qnt2Dose">
                            </div>
                            <div class="col-sm-6 formVacinometro">
                                <label>3ª Dose</label>
                                <input type="number" min="0" class="form-control" name="qnt3Dose" id="qnt3Dose">
                            </div>
                            <div class="col-sm-6 formVacinometro">
                                <label>Data</label>
                                <input type="date" class="form-control" name="dataVacinometro" id="dataVacinometro" style="background-color:#ff6a6a; color: #000">
                            </div>
                            <div class="col-sm-6 formVacinometro">
                                <label>Fonte</label>
                                <input type="text" class="form-control" name="fonteVacinometro" id="fonteVacinometro">
                            </div>
                        </div>
                        <div class="modal-title text-center" id="modalCasosAELabelInfo" style="color:red"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnSalvarCaso">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="modalLeitosAE" tabindex="-1" data-backdrop="true" role="dialog" aria-labelledby="modalLeitosAELabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLeitosAELabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="formLeitos" method="post">
                        <div class="form-group row" style="background-color: #F2F2F2; padding: 15px">
                            <input type="hidden" id="idLeito" name="idLeito">
                            <input type="hidden" id="idMunicipio2" name="idMunicipio2">
                            <div class="col-sm-12">
                                <h5>Leitos</h5>
                            </div>
                            <div class="col-sm-6">
                                <label>Totais UTI</label>
                                <input type="number" min="0" class="form-control" name="disponiveisUTI" id="disponiveisUTI" placeholder="Totais UTI">
                            </div>
                            <div class="col-sm-6">
                                <label>Ocupados UTI</label>
                                <input type="number" min="0" class="form-control" name="ocupadosUTI" id="ocupadosUTI" placeholder="Ocupados UTI">
                            </div>
                            <div class="col-sm-6">
                                <label>Totais Clínico</label>
                                <input type="number" min="0" class="form-control" name="disponiveisClinico" id="disponiveisClinico" placeholder="Disponiveis Clínico">
                            </div>
                            <div class="col-sm-6">
                                <label>Ocupados Clínico</label>
                                <input type="number" min="0" class="form-control" name="ocupadosClinico" id="ocupadosClinico" placeholder="Ocupados Clínico">
                            </div>
                            <div class="col-sm-12">
                                <label>Data</label>
                                <input type="date" class="form-control" name="dataLeitos2" id="dataLeitos2">
                            </div>
                            <div class="col-sm-12">
                                <label>Fonte</label>
                                <input type="text" class="form-control" name="fonteLeitos2" id="fonteLeitos2" placeholder="https://www.google.com.br/">
                            </div>
                            <div class="modal-title text-center" id="modalLeitosAELabelInfo" style="color:red"></div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnSalvarLeito">Salvar</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade bd-example-modal-lg" id="modalVacinasAE" tabindex="-1" data-backdrop="true" role="dialog" aria-labelledby="modalVacinasAELabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalVacinasAELabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="formVacinas" method="post">
                        <div class="form-group row" style="background-color: #F2F2F2; padding: 15px">
                            <input type="hidden" id="idVacina" name="idVacina">
                            <input type="hidden" id="idMunicipio3" name="idMunicipio3">
                            <div class="col-sm-12">
                                <h5>Vacinas</h5>
                            </div>
                            <div class="col-sm-6">
                                <label>1ª Dose</label>
                                <input type="number" min="0" class="form-control" name="1adose" id="1adose">
                            </div>
                            <div class="col-sm-6">
                                <label>2ª Dose</label>
                                <input type="number" min="0" class="form-control" name="2adose" id="2adose">
                            </div>
                            <div class="col-sm-6">
                                <label>3ª Dose</label>
                                <input type="number" min="0" class="form-control" name="3adose" id="3adose">
                            </div>
                            <div class="col-sm-12">
                                <label>Data</label>
                                <input type="date" class="form-control" name="dataVacinometro2" id="dataVacinometro2">
                            </div>
                            <div class="col-sm-12">
                                <label>Fonte</label>
                                <input type="text" class="form-control" name="fonteVacinometro2" id="fonteVacinometro2" placeholder="https://www.google.com.br/">
                            </div>
                            <div class="modal-title text-center" id="modalVacinasAELabelInfo" style="color:red"></div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnSalvarVacina">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal cadastro/edição de legendas -->
    <div class="modal fade" id="modalLegendasAE" tabindex="-1" role="dialog" aria-labelledby="modalLegendasAELabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLegendasAELabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formLegendas" method="post">
                        <div class="form-group">
                            <input type="hidden" id="idLegenda" name="idLegenda">
                            <input type="hidden" id="idMunicipioLeg" name="idMunicipioLeg">
                            <label for="conteudo" class="col-form-label">Conteúdo:</label>
                            <textarea class="form-control" id="conteudo" name="conteudo" placeholder="Detalhe como os relatórios de casos estão sendo tratados, se houveram mudanças nas contagens etc."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="btnSalvarLegenda">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal legenda datatable -->
    <div class="modal fade" id="modalLegendas" tabindex="-1" role="dialog" aria-labelledby="modalLegendasLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLegendasLabel" style="margin-right: 10px">Legendas</h5>
                    <!-- <button type="button" class="btn btn-outline-primary float-left" id="btnLegendasAdd">
                    <span data-feather="plus"></span>Nova Legenda
                </button> -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" style="width: 100%" id="tableLegendas">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>conteudo</th>
                                    <th>município</th>
                                    <th>id municipio</th>
                                    <th style="width: 10%">ações</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="loader"></div>
    <script src="/assets/dist/bootstrap.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
    <script src="/assets/dist/dashboard.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-html5-1.6.2/b-print-1.6.2/cr-1.5.2/r-2.2.5/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script>
        $(document).ready(function() {

            $(".formLeitos").hide();
            $(".formVacinometro").hide();

            $("#desativarCasos").on("click", function() {
                if ($("#desativarCasos").is(':checked')) {
                    $(".formCasos").hide();
                } else {
                    $(".formCasos").show();
                }
            });

            $("#desativarLeitos").on("click", function() {
                if ($("#desativarLeitos").is(':checked')) {
                    $(".formLeitos").hide();
                } else {
                    $(".formLeitos").show();
                }
            });

            $("#desativarVacinometro").on("click", function() {
                if ($("#desativarVacinometro").is(':checked')) {
                    $(".formVacinometro").hide();
                } else {
                    $(".formVacinometro").show();
                }
            });

            $('#modalLegendasAE').on('hidden.bs.modal', function(e) {
                $('#modalLegendas').modal('show');

            });
            $('#btnLegendasGer').click(function() {
                $('#modalLegendas').modal('show')
            });
        });

        //inicia os municípios (pode alterar pra ser feito no php, já que não precisa ser assíncrono)
        $.ajax({
            type: "get",
            url: "../Ajax/municipios/getDados",
            data: {},
            dataType: 'json',
            contentType: "application/json; charset=utf-8",
            success: function(data) {
                var selectbox = $('#municipio');
                $.each(data, function(i, d) {
                    selectbox.append('<option value="' + d.idMunicipio + '">' + d.nomeMunicipio + '</option>');
                });
                selectbox.append('<option value="" selected>Selecione o município...</option>');
            }
        });

        var tableCasos;
        var tableLegendas;
        var tableVacinas;
        var tableLeitos;
        var btnToggleSumarizados = false;

        $(document).ready(function() {
            tableCasos = $('#tableCasos').DataTable({
                "ajax": "../Ajax/Casos/getDados",
                "processing": true,
                "order": [
                    [1, "desc"]
                ],
                columns: [{
                        data: "id",
                        visible: false
                    },
                    {
                        data: "datax",
                    },
                    {
                        data: "fonte",
                        visible: false
                    },
                    {
                        data: "municipio"
                    },
                    {
                        data: "confirmados"
                    },
                    {
                        data: "suspeitos",
                    },
                    {
                        data: "descartados",
                    },
                    {
                        data: "recuperados",
                    },
                    {
                        data: "obitos",
                    },
                    {
                        data: "idMunicipio",
                        visible: false
                    },
                    {
                        data: "auto",
                        render: function(datum, type, row) {
                            let color = datum == 1 ? '#c91417' : '#299446';
                            let name = datum == 1 ? 'AUTOMÁTICO' : 'MANUAL';

                            return '<span style="color: white; border-radius: 20px; padding: 5px; background-color: ' + color + '; font-weight: bold" class="btn-group" role="group">' + datum + ' ' + name + '</span>';
                        }
                    },
                    {
                        "mData": null,
                        "mRender": function(data, type, row) {
                            return '<div class="btn-group" role="group" aria-label="Basic example"><a href="" class="btn btn btn-outline-dark" onClick="editarCaso(\'' + encodeURIComponent(row.id) + '\' , \'' + encodeURIComponent(row.confirmados) + '\' , \'' + encodeURIComponent(row.suspeitos) + '\', \'' + encodeURIComponent(row.descartados) + '\' , \'' + encodeURIComponent(row.obitos) + '\' , \'' + encodeURIComponent(row.recuperados) + '\' , \'' + encodeURIComponent(row.municipio) + '\', \'' + encodeURIComponent(row.datax) + '\', \'' + row.idMunicipio + '\', \'' + encodeURIComponent(row.fonte) + '\');return false;">Editar</a>' +
                                ' <a href="" class="btn btn-outline-danger" onClick="deletarCaso(' + encodeURIComponent(row.id) + ');return false;">Excluir</a></div>';
                        },
                    }
                ],
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],
                buttons: [{
                        extend: 'print',
                        title: 'Painel Covid 19 - Relatório de Casos - emitido em ' + dataAtualFormatada(),
                        text: '<i class=""></i> Imprimir',
                        exportOptions: {
                            columns: [1, 3, 4, 5, 6, 7, 8]
                        }
                    },
                    {
                        extend: 'pdf',
                        title: 'Painel Covid 19 - Relatório de Casos - emitido em ' + dataAtualFormatada(),
                        text: '<i class=""></i> PDF',
                        exportOptions: {
                            columns: [1, 3, 45, 6, 7, 8]
                        }
                    },
                    {
                        extend: 'excel',
                        title: 'Painel Covid 19 - Relatório de Casos - emitido em ' + dataAtualFormatada(),
                        text: '<i class=""></i> Excel',
                        exportOptions: {
                            columns: [1, 3, 4, 5, 6, 7, 8]
                        }
                    }
                ],
                responsive: true,
                "oLanguage": {
                    "sSearch": "Pesquisa"
                },
                "language": {
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Próxima"
                    },
                    "processing": "Carregando...",
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "Desculpe, nada encontrado",
                    "info": "Página _PAGE_ de _PAGES_",
                    "infoEmpty": "Sem registros disponíveis",
                    "infoFiltered": "(filtrado de _MAX_ total registros)"
                }


            });
            tableCasos.column(10).search("0").draw();
            tableCasos.column(10).visible(false);
        });

        $(document).ready(function() {
            tableLeitos = $('#tableLeitos').DataTable({
                "ajax": "../Ajax/Leitos/getDados",
                "processing": true,
                "order": [
                    [1, "desc"]
                ],
                columns: [{
                        data: "idLeito",
                        visible: false
                    },
                    {
                        data: "dataLeitos",
                    },
                    {
                        data: "municipio"
                    },
                    {
                        data: "qntLeitosDisponiveisUTI"
                    },
                    {
                        data: "qntLeitosOcupadosUTI",
                    },
                    {
                        data: "qntLeitosDisponiveisClinico"
                    },
                    {
                        data: "qntLeitosOcupadosClinico",
                    },
                    {
                        data: "fonteLeitos",
                        visible: false
                    },
                    {
                        data: "idMunicipio",
                        visible: false
                    },
                    {
                        "mData": null,
                        "mRender": function(data, type, row) {
                            return '<div class="btn-group" role="group" aria-label="Basic example"><a href="" class="btn btn btn-outline-dark" onClick="editarLeito(\'' + encodeURIComponent(row.idLeito) + '\', \'' + encodeURIComponent(row.qntLeitosDisponiveisUTI) + '\' , \'' + encodeURIComponent(row.qntLeitosOcupadosUTI) + '\', \'' + encodeURIComponent(row.qntLeitosDisponiveisClinico) + '\' , \'' + encodeURIComponent(row.qntLeitosOcupadosClinico) + '\', \'' + encodeURIComponent(row.municipio) + '\', \'' + encodeURIComponent(row.dataLeitos) + '\', \'' + encodeURIComponent(row.fonteLeitos) + '\', \'' + encodeURIComponent(row.idMunicipio) + '\');return false;">Editar</a>' +
                                ' <a href="" class="btn btn-outline-danger" onClick="deletarLeito(' + encodeURIComponent(row.idLeito) + ');return false;">Excluir</a></div>';
                        },
                    }
                ],

                responsive: true,
                "oLanguage": {
                    "sSearch": "Pesquisa"
                },
                "language": {
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Próxima"
                    },
                    "processing": "Carregando...",
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "Desculpe, nada encontrado",
                    "info": "Página _PAGE_ de _PAGES_",
                    "infoEmpty": "Sem registros disponíveis",
                    "infoFiltered": "(filtrado de _MAX_ total registros)"
                }


            });
        });

        $(document).ready(function() {
            tableVacinas = $('#tableVacinas').DataTable({
                "ajax": "../Ajax/Vacinas/getDados",
                "processing": true,
                "order": [
                    [1, "desc"]
                ],
                columns: [{
                        data: "idVacinometro",
                        visible: false
                    },
                    {
                        data: "dataVacinometro",
                    },
                    {
                        data: "municipio"
                    },
                    {
                        data: "qnt1Dose"
                    },
                    {
                        data: "qnt2Dose"
                    },
                    {
                        data: "qnt3Dose"
                    },
                    
                    {
                        data: "idMunicipio",
                        visible: false
                    },
                    {
                        "mData": null,
                        "mRender": function(data, type, row) {
                            return '<div class="btn-group" role="group" aria-label="Basic example"><a href="" class="btn btn btn-outline-dark" onClick="editarVacina(\'' + encodeURIComponent(row.idVacinometro) + '\', \'' + encodeURIComponent(row.qnt1Dose) + '\' , \'' + encodeURIComponent(row.qnt2Dose) + '\', \'' + encodeURIComponent(row.qnt3Dose) + '\', \'' + encodeURIComponent(row.municipio) + '\', \'' + encodeURIComponent(row.dataVacinometro) + '\', \'' + encodeURIComponent(row.idMunicipio) + '\', \'' + encodeURIComponent(row.fonteVacinometro) + '\');return false;">Editar</a>' +
                                ' <a href="" class="btn btn-outline-danger" onClick="deletarVacina(' + encodeURIComponent(row.idVacinometro) + ');return false;">Excluir</a></div>';
                        },
                    }
                ],
                responsive: true,
                "oLanguage": {
                    "sSearch": "Pesquisa"
                },
                "language": {
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Próxima"
                    },
                    "processing": "Carregando...",
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "Desculpe, nada encontrado",
                    "info": "Página _PAGE_ de _PAGES_",
                    "infoEmpty": "Sem registros disponíveis",
                    "infoFiltered": "(filtrado de _MAX_ total registros)"
                }


            });
        });


        $(document).ready(function() {
            tableLegendas = $('#tableLegendas').DataTable({
                "ajax": "../Ajax/Legendas/getDados",
                "processing": true,
                "order": [
                    [1, "desc"]
                ],
                columns: [{
                        data: "id",
                        visible: false
                    },
                    {
                        data: "conteudo",
                    },
                    {
                        data: "municipio"
                    },
                    {
                        data: "idMunicipio",
                        visible: false
                    },
                    {
                        "mData": null,
                        "mRender": function(data, type, row) {
                            return '<div class="btn-group" role="group" aria-label="Basic example"><a href="" class="btn btn btn-outline-dark" onClick="editarLegenda(\'' + encodeURIComponent(row.id) + '\' , \'' + encodeURIComponent(row.conteudo) + '\' , \'' + encodeURIComponent(row.municipio) + '\', \'' + encodeURIComponent(row.idMunicipio) + '\');return false;">Editar</a>' +
                                ' <a href="" class="btn btn-outline-danger" onClick="deletarLegenda(' + encodeURIComponent(row.id) + ');return false;">Excluir</a></div>';
                        },
                    }
                ],
                responsive: true,
                "oLanguage": {
                    "sSearch": "Pesquisa"
                },
                "language": {
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Próxima"
                    },
                    "processing": "Carregando...",
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "Desculpe, nada encontrado",
                    "info": "Página _PAGE_ de _PAGES_",
                    "infoEmpty": "Sem registros disponíveis",
                    "infoFiltered": "(filtrado de _MAX_ total registros)"
                }
            });
        });

        //evitar edições incompletas, reseta todos os campos
        $('#modalCasosAE').on('hidden.bs.modal', function(e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .end();
        });

        $('#modalLeitosAE').on('hidden.bs.modal', function(e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .end();
        });

        $('#modalVacinasAE').on('hidden.bs.modal', function(e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .end();
        });

        $('#modalLegendasAE').on('hidden.bs.modal', function(e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .end();
        });

        //filter by selected value on second column(municipio)
        $("#municipio").on('change', function() {
            //filter by selected value on second column
            if ($('#municipio option:selected').text() == 'Selecione o município...') {
                tableCasos.column(3).search("").draw();
                tableLeitos.column(2).search("").draw();
                tableVacinas.column(2).search("").draw();
            } else {
                tableCasos.column(3).search($('#municipio option:selected').text()).draw();
                tableLeitos.column(2).search($('#municipio option:selected').text()).draw();
                tableVacinas.column(2).search($('#municipio option:selected').text()).draw();

            }
        });

        //cadastro e edição de casos
        $(document).ready(function() {
            $('#btnSalvarCaso').click(function() {
                if ($("#desativarCasos").is(':checked')) {
                    $("#confirmados").val("");
                    $("#suspeitos").val("");
                    $("#descartados").val("");
                    $("#recuperados").val("");
                    $("#obitos").val("");
                }
                var dados = $('#formCasos').serializeArray();
                console.log(dados[7].value)
                if (dados[7].value == "" && !$("#desativarCasos").is(':checked')) {
                    alert("Por favor, preencha a data do caso corretamente")
                } else {
                    $('#modalCasosAE').modal('hide');
                    $body = $("body");
                    $body.addClass("loading");
                    $.ajax({
                        type: "POST",
                        url: "/casos/storeDt",
                        data: dados,
                        success: function(result) {
                            $('#formCasos').trigger("reset");
                            tableCasos.ajax.reload();
                            tableVacinas.ajax.reload();
                            tableLeitos.ajax.reload();
                            $('#id').val("");
                            $body.removeClass("loading");
                            toast("Relatório salvo com sucesso!", "success");
                        },
                        error: function() {
                            $body.removeClass("loading");
                            toast("Erro ao salvar relatório!", "error");
                        }
                    });

                    var idMunicipioAlerta = $('#formCasos').serializeArray();
                    $.ajax({
                        type: "POST",
                        url: "/alerta/enviar",
                        data: idMunicipioAlerta,
                        success: function(result) {
                            var result = JSON.parse(result);
                            if (result.recipients > 0) console.log(result.recipients + " pessoas foram notificadas com sucesso!");
                            else console.log("Nenhuma pessoa está cadastrada para receber alerta dessa cidade ainda.");
                        },
                        error: function() {
                            console.log("Ocorreu um erro ao enviar alertas.");
                        }
                    });
                    return false;
                }
            });
        });

        $(document).ready(function() {
            $('#btnSalvarLeito').click(function() {
                if ($("#desativarLeitos").is(':checked')) {
                    $("#qntLeitosDisponiveisUTI").val("");
                    $("#qntLeitosOcupadosUTI").val("");
                    $("#qntLeitosDisponiveisClinico").val("");
                    $("#qntLeitosOcupadosClinico").val("");
                }
                var dados = $('#formLeitos').serializeArray();
                $('#modalLeitosAE').modal('hide');
                $body = $("body");
                $body.addClass("loading");
                $.ajax({
                    type: "POST",
                    url: "/leitos/storeDt",
                    data: dados,
                    success: function(result) {
                        $('#formLeitos').trigger("reset");
                        tableLeitos.ajax.reload();
                        $('#id').val("");
                        $body.removeClass("loading");
                        toast("Informações de leitos salvas com sucesso!", "success");
                    },
                    error: function() {
                        $body.removeClass("loading");
                        toast("Erro ao salvar relatório!", "error");
                    }
                });
                return false;
            });
        });

        $(document).ready(function() {
            $('#btnSalvarVacina').click(function() {
                if ($("#desativarVacinometro").is(':checked')) {
                    $("#qnt1Dose").val("");
                    $("#qnt2Dose").val("");
                    $("#qnt3Dose").val("");
                    $("#fonteVacinoemtro").val("");
                }
                var dados = $('#formVacinas').serializeArray();
                $('#modalVacinasAE').modal('hide');
                $body = $("body");
                $body.addClass("loading");
                $.ajax({
                    type: "POST",
                    url: "/vacinas/storeDt",
                    data: dados,
                    success: function(result) {
                        $('#formVacinas').trigger("reset");
                        tableVacinas.ajax.reload();
                        $('#id').val("");
                        $body.removeClass("loading");
                        toast("Informações de vacinas salvas com sucesso!", "success");
                    },
                    error: function() {
                        $body.removeClass("loading");
                        toast("Erro ao salvar relatório!", "error");
                    }
                });
                return false;
            });
        });

        //modal de edição
        function editarCaso(id, confirmados, suspeitos, descartados, obitos, recuperados, municipio, datax, idMunicipio, fonte) {
            $('#idCaso').val(decodeURIComponent(id));
            $('#idMunicipio').val(decodeURIComponent(idMunicipio));
            $('#confirmados').val(decodeURIComponent(confirmados));
            $('#suspeitos').val(decodeURIComponent(suspeitos));
            $('#obitos').val(decodeURIComponent(obitos));
            $('#recuperados').val(decodeURIComponent(recuperados));
            $('#descartados').val(decodeURIComponent(descartados));
            $('#data-caso').val(decodeURIComponent(datax));
            $('#fonte').val(decodeURIComponent(fonte));
            $("#leitosEvacinometro").hide();
            $("#divDesativarCasos").show();
            modalEdCaso(decodeURIComponent(municipio), decodeURIComponent(datax));
        }

        function editarLeito(id, disponiveisUTI, ocupadosUTI, disponiveisClinico, ocupadosClinico, municipio, dataLeitos, fonteLeitos, idMunicipio) {
            $('#idLeito').val(decodeURIComponent(id));
            $('#idMunicipio2').val(decodeURIComponent(idMunicipio));
            $('#disponiveisClinico').val(decodeURIComponent(disponiveisClinico));
            $('#ocupadosClinico').val(decodeURIComponent(ocupadosClinico));
            $('#disponiveisUTI').val(decodeURIComponent(disponiveisUTI));
            $('#ocupadosUTI').val(decodeURIComponent(ocupadosUTI));
            $('#dataLeitos2').val(decodeURIComponent(dataLeitos));
            $('#fonteLeitos2').val(decodeURIComponent(fonteLeitos));
            modalEdLeito(decodeURIComponent(municipio), decodeURIComponent(dataLeitos));
        }

        function editarVacina(id, qnt1Dose, qnt2Dose, qnt3Dose, municipio, dataVacinometro, idMunicipio, fonteVacinometro) {
            $('#idVacina').val(decodeURIComponent(id));
            $('#idMunicipio3').val(decodeURIComponent(idMunicipio));
            $('#1adose').val(decodeURIComponent(qnt1Dose));
            $('#2adose').val(decodeURIComponent(qnt2Dose));
            $('#3adose').val(decodeURIComponent(qnt3Dose));
            $('#dataVacinometro2').val(decodeURIComponent(dataVacinometro));
            $('#fonteVacinometro2').val(decodeURIComponent(fonteVacinometro));
            modalEdVacina(decodeURIComponent(municipio), decodeURIComponent(dataVacinometro));
        }

        function editarLegenda(id, conteudo, municipio, idMunicipio) {
            $('#modalLegendas').modal('hide');
            $('#idLegenda').val(decodeURIComponent(id));
            $('#idMunicipioLeg').val(decodeURIComponent(idMunicipio));
            $('#conteudo').val(decodeURIComponent(conteudo));
            modalEdLegenda(decodeURIComponent(municipio));
        }

        //deleção de caso
        function deletarCaso(id) {
            Swal.fire({
                title: 'Tem certeza?',
                text: "Você não poderá desfazer isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!'
            }).then((result) => {
                if (result.value) {
                    $body = $("body");
                    $body.addClass("loading");
                    $.ajax({
                        type: "DELETE",
                        url: "../casos/deleteDt/" + decodeURIComponent(id),
                        success: function(result) {
                            tableCasos.ajax.reload();
                            // alert("Relatório de casos excluído com sucesso");
                            $body.removeClass("loading");
                            toast("Relatório de casos excluído com sucesso", "success");
                        },
                        error: function() {
                            $body.removeClass("loading");
                            toast("Erro ao excluir relatório de casos", "error");
                        }
                    });
                }
            });
        }

        //deleção de leito
        function deletarLeito(id) {
            Swal.fire({
                title: 'Tem certeza?',
                text: "Você não poderá desfazer isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!'
            }).then((result) => {
                if (result.value) {
                    $body = $("body");
                    $body.addClass("loading");
                    $.ajax({
                        type: "DELETE",
                        url: "../leitos/deleteDt/" + decodeURIComponent(id),
                        success: function(result) {
                            tableLeitos.ajax.reload();
                            $body.removeClass("loading");
                            toast("Relatório de casos excluído com sucesso", "success");
                        },
                        error: function() {
                            $body.removeClass("loading");
                            toast("Erro ao excluir relatório de casos", "error");
                        }
                    });
                }
            });
        }

        //deleção de vacina
        function deletarVacina(id) {
            Swal.fire({
                title: 'Tem certeza?',
                text: "Você não poderá desfazer isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!'
            }).then((result) => {
                if (result.value) {
                    $body = $("body");
                    $body.addClass("loading");
                    $.ajax({
                        type: "DELETE",
                        url: "../vacinas/deleteDt/" + decodeURIComponent(id),
                        success: function(result) {
                            tableVacinas.ajax.reload();
                            $body.removeClass("loading");
                            toast("Relatório de vacinas excluído com sucesso", "success");
                        },
                        error: function() {
                            $body.removeClass("loading");
                            toast("Erro ao excluir relatório de casos", "error");
                        }
                    });
                }
            });
        }

        //mostra coluna de sumarizados com marcador
        //mostra todos os dados ao invés de apenas com sumarizado 0
        //é um toggle
        function toggleSumarizados() {
            // $('#iconSumarizado')attr('data-feather="eye"')
            btnToggleSumarizados = !btnToggleSumarizados;
            $('#btnSumarizado').text(btnToggleSumarizados == false ? 'Ver sumarizados' : 'Esconder sumarizados');
            if (btnToggleSumarizados)
                tableCasos.column(10).search("").draw();
            else
                tableCasos.column(10).search("0").draw();

            tableCasos.column(10).visible(btnToggleSumarizados);

        }


        //verificação de relatorio de caso
        //tratar quando a dataCaso for maior que verificação (nao mostrar verificação)
        //dataverificacao > datacaso pra mostrar ela
        function verificarRelatorio() {
            if ($('#municipio option:selected').val() == "") {
                alert("Por favor, antes de verificar um relatório de casos, selecione um município.");
            } else {
                var idMunicipio = $('#municipio option:selected').val();
                var municipio = $('#municipio option:selected').text();
                //pegar o id do ultimo relatorio de casos cadastrado
                $.ajax({
                    type: "GET",
                    url: "../Casos/lastCasosId/" + decodeURIComponent(idMunicipio),
                    //enviar os dados aqui
                    success: function(result) {
                        var idLastCaso = result;
                        // alert(idLastCaso);
                        Swal.fire({
                            title: 'Tem certeza?',
                            text: "Ao confirmar, você constata que que até o atual dia, o último relatório de casos para o munícipio de " + municipio + " é o mais atualizado!",
                            footer: "* Caso o município tenha regularidade de boletins, não é necessária a verificação.",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            cancelButtonText: 'Cancelar',
                            confirmButtonText: 'Sim, confirmar!'
                        }).then((result) => {
                            if (result.value) {
                                $body = $("body");
                                $body.addClass("loading");
                                $.ajax({
                                    type: "POST",
                                    url: "../Verificacoes/storeDt",
                                    data: {
                                        idMunicipio: idMunicipio,
                                        idLastCaso: idLastCaso
                                    },
                                    //enviar os dados aqui
                                    success: function(result) {
                                        // alert("Relatório de casos excluído com sucesso");
                                        $body.removeClass("loading");
                                        toast("Verificação de relatório de casos cadastrado com sucesso", "success");
                                    },
                                    error: function() {
                                        $body.removeClass("loading");
                                        toast("Erro ao verificar relatório de casos", "error");
                                    }
                                });
                            }
                        });
                    },
                    error: function() {
                        $body.removeClass("loading");
                        toast("Erro ao resgatar ultimo do relatório de casos", "error");
                    }
                });

            }
        }


        //cadastro e edição de legendas
        $(document).ready(function() {
            $('#btnSalvarLegenda').click(function() {
                var dados = $('#formLegendas').serializeArray();
                $('#modalLegendasAE').modal('hide');
                $body = $("body");
                $body.addClass("loading");
                $.ajax({
                    type: "POST",
                    url: "/legendas/storeDt",
                    data: dados,
                    success: function(result) {
                        $('#formLegendas').trigger("reset");
                        tableLegendas.ajax.reload();
                        $('#id').val("");
                        $body.removeClass("loading");
                        toast("Legenda de relatório de casos salvo com sucesso", "success");
                    },
                    error: function() {
                        $body.removeClass("loading");
                        toast("Erro ao salvar legenda de relatório de casos", "error");
                    }
                });
                return false;
            });
        });

        function deletarLegenda(id) {
            Swal.fire({
                title: 'Tem certeza?',
                text: "Você não poderá desfazer isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!'
            }).then((result) => {
                if (result.value) {
                    $body = $("body");
                    $body.addClass("loading");
                    $.ajax({
                        type: "DELETE",
                        url: "../legendas/deleteDt/" + decodeURIComponent(id),
                        success: function(result) {
                            tableLegendas.ajax.reload();
                            // alert("Relatório de casos excluído com sucesso");
                            $body.removeClass("loading");
                            toast("Legenda de relatório de casos excluído com sucesso", "success");
                        },
                        error: function() {
                            $body.removeClass("loading");
                            toast("Erro ao excluir legenda de relatório de casos", "error");
                        }
                    });
                }
            });
        }

        function dataAtualFormatada() {
            var data = new Date(),
                dia = data.getDate().toString().padStart(2, '0'),
                mes = (data.getMonth() + 1).toString().padStart(2, '0'), //+1 pois no getMonth Janeiro começa com zero.
                ano = data.getFullYear();
            time = data.getHours() + "h" + data.getMinutes() + "min";
            return " " + dia + "-" + mes + "-" + ano + " " + time;
        }

        function toast(message, icon) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000
            });
            Toast.fire({
                icon: icon, //'success'
                title: message //'Signed in successfully'
            });
        }

        function formatDate(input) {
            var datePart = input.match(/\d+/g),
                year = datePart[0], // get only two digits
                month = datePart[1],
                day = datePart[2];

            return day + '/' + month + '/' + year;
        }

        function modalEdCaso(municipio, data) {
            $("#divDesativarCasos").hide();
            $('#modalCasosAELabel').text('Editar relatório de casos de ' + municipio + ' - ' + formatDate(data));
            $('#modalCasosAE').modal('show')
        }

        function modalEdLeito(municipio, data) {
            $('#modalLeitosAELabel').text('Editar relatório de leitos de ' + municipio + ' - ' + formatDate(data));
            $('#modalLeitosAE').modal('show')
        }

        function modalEdVacina(municipio, data) {
            $('#modalVacinasAELabel').text('Editar relatório de vacinas de ' + municipio + ' - ' + formatDate(data));
            $('#modalVacinasAE').modal('show')
        }

        function modalEdLegenda(municipio) {
            $('#modalLegendasAELabel').text('Editar legenda de relatório de casos de ' + municipio);
            $('#modalLegendasAE').modal('show')
        }

        function modalCadCaso() {
            if ($('#municipio option:selected').val() == "") {
                alert("Por favor, antes de cadastrar um relatório de casos, selecione um município.");
            } else { 
                var dados;
                $.ajax({
                    url: '../ajax/casos/getLastDados/' + $('#municipio option:selected').val(),
                    success: function(data) {
                        dados = JSON.parse(data);
                        $('#confirmados').val(dados[0].confirmados);
                        $('#suspeitos').val(dados[0].suspeitos);
                        $('#descartados').val(dados[0].descartados);
                        $('#recuperados').val(dados[0].recuperados);
                        $('#obitos').val(dados[0].obitos);
                        $('#fonte').val(dados[0].fonte);
                        $("input[id=desativarVacinometro]").prop('checked', true);
                        $("input[id=desativarLeitos]").prop('checked', true);

                        if ($("#desativarLeitos").is(':checked')) {
                            $(".formLeitos").hide();
                        } else {
                            $(".formLeitos").show();
                        }

                        $("#leitosEvacinometro").show();
                        $("#divDesativarCasos").show();
                        $(".formCasos").show();

                        $('#modalCasosAELabel').text('Cadastro do Relatório de ' + $('#municipio option:selected').text());
                        $('#modalCasosAELabelInfo').text('Todos os campos foram automaticamente preenchidos com os últimos dados, que foram cadastrados em ' + dados[0].datax + '. Faça as devidas alterações e atualize.');
                    }
                });

                $.ajax({
                    url: '../ajax/casos/getLastDadosVacinometro/' + $('#municipio option:selected').val(),
                    success: function(data) {
                        dados = JSON.parse(data);
                        $('#qnt1Dose').val(dados[0].qnt1Dose);
                        $('#qnt2Dose').val(dados[0].qnt2Dose);
                        $('#qnt3Dose').val(dados[0].qnt3Dose);
                        $('#fonteVacinometro').val(dados[0].fonteVacinometro);
                    }
                });

                $.ajax({
                    url: '../ajax/casos/getLastDadosLeitos/' + $('#municipio option:selected').val(),
                    success: function(data) {
                        dados = JSON.parse(data);
                        $('#qntLeitosDisponiveisUTI').val(dados[0].qntLeitosDisponiveisUTI);
                        $('#qntLeitosOcupadosUTI').val(dados[0].qntLeitosOcupadosUTI);
                        $('#qntLeitosDisponiveisClinico').val(dados[0].qntLeitosDisponiveisClinico);
                        $('#qntLeitosOcupadosClinico').val(dados[0].qntLeitosOcupadosClinico);
                        $('#dataLeitos').val(dados[0].dataLeitos);
                        $('#fonteLeitos').val(dados[0].fonteLeitos);
                    }
                });

                $('#idMunicipio').val($('#municipio option:selected').val());
                $('#modalCasosAE').modal('show')
            }
        }

        function modalCadLegenda() {
            if ($('#municipio option:selected').val() == "") {
                alert("Por favor, antes de cadastrar uma legenda, selecione um município.");
            } else {
                $('#modalLegendasAELabel').text('Cadastro de legenda de casos de ' + $('#municipio option:selected').text());
                $('#idMunicipio2').val($('#municipio option:selected').val());
                $('#idMunicipioLeg').val($('#municipio option:selected').val());
                $('.modal').modal('hide');
                $('#modalLegendasAE').modal('show')
            }
        }
    </script>
</body>

</html>