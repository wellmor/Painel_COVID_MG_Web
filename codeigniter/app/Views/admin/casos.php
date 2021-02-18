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
                                Casos
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
                    <h1 class="h2" style="margin-right: 10px">Casos</h1>
                    <!-- <div class="col-sm-3 text-right">
                    Selecione o municipio
                </div> -->
                    <div class="col-md-5 float-right" style="margin:0px; padding:0px">
                        <select class="form-control" id="municipio"></select>
                    </div>
                    <div class="col-md-6 float-left">
                        <button type="button" class="btn btn-primary" data-toggle="modal" onclick="modalCadCaso()">
                            <span data-feather="plus"></span>
                            Cadastrar caso
                        </button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span data-feather="info"></span> Legenda
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#" onclick="modalCadLegenda()"><span data-feather="plus"></span> Cadastrar</a>
                                <a class="dropdown-item" href="#" id="btnLegendasGer"><span data-feather="eye"></span> Ver
                                    todas</a>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success" data-toggle="modal" onclick="verificarRelatorio()">
                            <span data-feather="check"></span>
                            Verificar município
                        </button>
                        <button type="button" id="btnSumarizado" class="btn btn-success" data-toggle="modal" onclick="toggleSumarizados()">
                            <span id="iconSumarizado"></span>
                            <!--                            quando clica pra ver, ele mostra a coluna de sumarizado, tipo um toggle -->
                            Ver sumarizados
                        </button>
                    </div>


                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered" style="width: 100%" id="tableCasos">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>data</th>
                                <th>fonte</th>
                                <th>munícipio</th>
                                <th>confirmados</th>
                                <th>suspeitos</th>
                                <th>descartados</th>
                                <th>recuperados</th>
                                <th>obitos</th>
                                <th>id municipio</th>
                                <th>sumarizado</th>
                                <!-- <th>leitos disponiveis</th>
                                <th>leitos ocupados</th> -->
                                <th style="width: 20%">ações</th>
                            </tr>
                        </thead>
                    </table>
                </div>
        </div>
        <br /><br />
        </main>
    </div>


    <!-- Modal casos -->
    <div class="modal fade" id="modalCasosAE" tabindex="-1" data-backdrop="true" role="dialog" aria-labelledby="modalCasosAELabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCasosAELabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formCasos" method="post">
                        <div class="form-group row">
                            <input type="hidden" id="idCaso" name="idCaso">
                            <input type="hidden" id="idMunicipio" name="idMunicipio">
                            <div class="col-sm-6">
                                <label>Confirmados </label>
                                <input type="number" value="" oninput="this.value = Math.abs(this.value)" min="0" class="form-control" name="confirmados" id="confirmados" placeholder="confirmados">
                            </div>
                            <div class="col-sm-6">
                                <label>Suspeitos </label>
                                <input type="number" oninput="this.value = Math.abs(this.value)" min="0" class="form-control" name="suspeitos" id="suspeitos" placeholder="suspeitos">
                            </div>
                            <div class="col-sm-6">
                                <label>Descartados</label>
                                <input type="number" oninput="this.value = Math.abs(this.value)" min="0" class="form-control" name="descartados" id="descartados" placeholder="descartados">
                            </div>
                            <div class="col-sm-6">
                                <label>Recuperados</label>
                                <input type="number" oninput="this.value = Math.abs(this.value)" min="0" class="form-control" name="recuperados" id="recuperados" placeholder="recuperados">
                            </div>
                            <div class="col-sm-6">
                                <label>Obitos</label>
                                <input type="number" oninput="this.value = Math.abs(this.value)" min="0" class="form-control" name="obitos" id="obitos" placeholder="obitos">
                            </div>
                            <div class="col-sm-6">
                                <label>Data</label>
                                <input type="date" class="form-control" name="data-caso" id="data-caso" placeholder="data do relatorio">
                            </div>
                            <div class="col-sm-12">
                                <label>Fonte</label>
                                <input type="text" class="form-control" name="fonte" id="fonte" placeholder="link da fonte">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label>Quantidade de leitos disponíveis</label>
                                <input type="number" oninput="this.value = Math.abs(this.value)" min="0" class="form-control" name="qntLeitosDisponiveis" id="qntLeitosDisponiveis" style="background-color: green; color: white">
                            </div>
                            <div class="col-sm-6">
                                <label>Quantidade de leitos ocupados</label>
                                <input type="number" oninput="this.value = Math.abs(this.value)" min="0" class="form-control" name="qntLeitosOcupados" id="qntLeitosOcupados" style="background-color: red; color: white">
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
        //legenda cadastro e edição
        $(document).ready(function() {

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
        var tableLegendas
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
                    /* {
                        data: "qntLeitosDisponiveis",
                    },
                    {
                        data: "qntLeitosOcupados",
                    }, */
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
                        text: '<i class=""></i> imprimir',
                        exportOptions: {
                            columns: [1, 3, 4, 5, 6, 7, 8]
                        }
                    },
                    {
                        extend: 'pdf',
                        title: 'Painel Covid 19 - Relatório de Casos - emitido em ' + dataAtualFormatada(),
                        text: '<i class=""></i> pdf',
                        exportOptions: {
                            columns: [1, 3, 45, 6, 7, 8]
                        }
                    },
                    {
                        extend: 'excel',
                        title: 'Painel Covid 19 - Relatório de Casos - emitido em ' + dataAtualFormatada(),
                        text: '<i class=""></i> excel',
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
                .prop("checked", "")
                .end();
        });

        $('#modalLegendasAE').on('hidden.bs.modal', function(e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
        });

        //filter by selected value on second column(municipio)
        $("#municipio").on('change', function() {
            //filter by selected value on second column
            if ($('#municipio option:selected').text() == 'Selecione o município...') {
                tableCasos.column(3).search("").draw();
            } else {
                tableCasos.column(3).search($('#municipio option:selected').text()).draw();
            }
        });


        //cadastro e edição de casos
        $(document).ready(function() {
            $('#btnSalvarCaso').click(function() {
                var dados = $('#formCasos').serializeArray();
                console.log(dados[7].value)
                if (dados[7].value == "") {
                    alert("Por favor, preencha a data corretamente")
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
                            if (result.recipients > 0) alert(result.recipients + " pessoas foram notificadas com sucesso!");
                            else alert("Nenhuma pessoa está cadastrada para receber alerta dessa cidade ainda.");
                        },
                        error: function() {
                            console.log("Ocorreu um erro ao enviar alertas.");
                        }
                    });
                    return false;
                }
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
            modalEdCaso(decodeURIComponent(municipio), decodeURIComponent(datax));
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

            $('#modalCasosAELabel').text('Editar relatório de casos de ' + municipio + ' - ' + formatDate(data));
            $('#modalCasosAE').modal('show')
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
                        $('#qntLeitosOcupados').val(dados[0].qntLeitosOcupados);
                        $('#qntLeitosDisponiveis').val(dados[0].qntLeitosDisponiveis);
                        //$('#data').val(formatarData(dados[0].datax));
                        $('#modalCasosAELabel').text('Cadastro de relatorio de casos ' + $('#municipio option:selected').text());
                        $('#modalCasosAELabelInfo').text('Todos os campos foram automaticamente preenchidos com os últimos dados, que foram cadastrados em ' + dados[0].datax + '. Faça as devidas alterações e atualize.');
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