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
                            <a class="nav-link" href="/admin/casos">
                                <span data-feather="bar-chart-2"></span>
                                Casos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/admin/leitos">
                                <span data-feather="inbox"></span>
                                Leitos
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
                    <h1 class="h2" style="margin-right: 20px">Leitos</h1>
                    <!-- <div class="col-sm-3 text-right">
                        Selecione o municipio
                    </div> -->
                    <div class="col-md-5 float-right" style="margin:0px; padding:0px">
                        <select class="form-control" id="municipio"></select>
                    </div>
                    <div class="col-md-6 float-left">
                        <button type="button" class="btn btn-primary" data-toggle="modal" onclick="modalCadLeito()">
                            <span data-feather="plus"></span>
                            Leito
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" style="width: 100%" id="tableLeitos">
                        <thead>
                            <tr>
                                <th>ID Leito</th>
                                <th>ID Munícipio</th>
                                <th>Leitos Disponiveis</th>
                                <th>Leitos Ocupados</th>
                                <th style="width: 20%">Ações</th>
                            </tr>
                        </thead>
                    </table>
                </div>
        </div>
        <br /><br />
        </main>
    </div>

    <!-- Modal leitos -->
    <div class="modal fade" id="modalLeitosAE" tabindex="-1" data-backdrop="true" role="dialog" aria-labelledby="modalLeitosAELabel" aria-hidden="true">
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
                        <div class="form-group row">
                            <input type="hidden" id="idLeito" name="idLeito">
                            <input type="hidden" id="idMunicipio" name="idMunicipio">
                            <div class="col-sm-6">
                                <label>Disponível </label>
                                <input type="number" oninput="this.value = Math.abs(this.value)" min="0" class="form-control" name="qntLeitosDisponiveis" id="qntLeitosDisponiveis" placeholder="Quantidade de leitos disponíveis">
                            </div>
                            <div class="col-sm-6">
                                <label>Ocupado </label>
                                <input type="number" oninput="this.value = Math.abs(this.value)" min="0" class="form-control" name="qntLeitosOcupados" id="qntLeitosOcupados" placeholder="Quantidade de leitos ocupados">
                            </div>
                        </div>
                        <div class="modal-title text-center" id="modalLeitosAELabelInfo" style="color:red"></div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnSalvarLeito">Salvar</button>
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

        var tableLeitos;
        $(document).ready(function() {
            tableLeitos = $('#tableLeitos').DataTable({
                "ajax": "../Ajax/Leitos/getDados",
                "processing": true,
                "order": [
                    [1, "desc"]
                ],
                columns: [{
                        data: "idLeito"
                    },
                    {
                        data: "idMunicipio"
                    },
                    {
                        data: "qntLeitosDisponiveis"
                    },
                    {
                        data: "qntLeitosOcupados"
                    },
                    {
                        "mData": null,
                        "mRender": function(data, type, row) {
                            return '<div class="btn-group" role="group" aria-label="Basic example"><a href="" class="btn btn btn-outline-dark" onClick="editarLeito(\'' + encodeURIComponent(row.idLeito) + '\' , \'' + encodeURIComponent(row.qntLeitosDisponiveis) + '\' , \'' + encodeURIComponent(row.qntLeitosOcupados) + '\', \'' + row.idMunicipio + '\');return false;">Editar</a>' +
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

        //evitar edições incompletas, reseta todos os campos
        $('#modalLeitosAE').on('hidden.bs.modal', function(e) {
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
                tableLeitos.column(3).search("").draw();
            } else {
                tableLeitos.column(3).search($('#municipio option:selected').text()).draw();
            }
        });

        //cadastro e edição de leitos
        $(document).ready(function() {
            $('#btnSalvarLeito').click(function() {
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
                        $('#idLeito').val("");
                        $body.removeClass("loading");
                        toast("Relatório de leitos salvo com sucesso", "success");
                    },
                    error: function() {
                        $body.removeClass("loading");
                        toast("Erro ao salvar relatório de leitos", "error");
                    }
                });

            });
        });

        //modal de edição
        function editarLeito(id, qntLeitosDisponiveis, qntLeitosOcupados, idMunicipio) {
            $('#idLeito').val(decodeURIComponent(id));
            $('#idMunicipio').val(decodeURIComponent(idMunicipio));
            $('#qntLeitosDisponiveis').val(decodeURIComponent(qntLeitosDisponiveis));
            $('#qntLeitosOcupados').val(decodeURIComponent(qntLeitosOcupados));
            modalEdLeito(decodeURIComponent(municipio));
        }

        //deleção de caso
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
                            toast("Relatório de leitos excluído com sucesso", "success");
                        },
                        error: function() {
                            $body.removeClass("loading");
                            toast("Erro ao excluir relatório de leitos", "error");
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
                icon: icon,
                title: message
            });
        }

        function formatDate(input) {
            var datePart = input.match(/\d+/g),
                year = datePart[0],
                month = datePart[1],
                day = datePart[2];

            return day + '/' + month + '/' + year;
        }

        function modalEdLeito(municipio) {
            $('#modalLeitosAELabel').text('Editar relatório de leitos');
            $('#modalLeitosAE').modal('show');
        }

        function modalCadLeito() {
            if ($('#municipio option:selected').val() == "") {
                alert("Por favor, antes de cadastrar um relatório de leitos, selecione um município.");
            } else {
                var dados;
                $.ajax({
                    url: '../ajax/leitos/getLastDados/' + $('#municipio option:selected').val(),
                    success: function(data) {
                        dados = JSON.parse(data);
                        $('#qntLeitosDisponiveis').val(dados[0].qntLeitosDisponiveis);
                        $('#qntLeitosOcupados').val(dados[0].qntLeitosOcupados);
                        $('#modalLeitosAELabel').text('Cadastro de relatorio de leitos ' + $('#municipio option:selected').text());
                        $('#modalLeitosAELabelInfo').text('Todos os campos foram automaticamente preenchidos com os últimos dados. Faça as devidas alterações e atualize.');
                    }
                });

                $('#idMunicipio').val($('#municipio option:selected').val());
                $('#modalLeitosAE').modal('show')
            }
        }
    </script>
</body>

</html>