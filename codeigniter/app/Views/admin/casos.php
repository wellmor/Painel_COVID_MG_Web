<!doctype html>
<html lang="pt_BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>Painel COVID</title>
    <link rel="icon" href="/assets/images/virus.png">

    <!-- Bootstrap core CSS -->
    <link href="../assets/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-html5-1.6.2/b-print-1.6.2/cr-1.5.2/r-2.2.5/datatables.min.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

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


        .fuck {
            display: none;
            position: fixed;
            z-index: 1000;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background: rgba(255, 255, 255, .8) url('../assets/loading.gif') 50% 50% no-repeat;
        }

        /* When the body has the loading class, we turn
   the scrollbar off with overflow:hidden */
        body.loading .fuck {
            overflow: hidden;
        }

        /* Anytime the body has the loading class, our
   modal element will be visible */
        body.loading .fuck {
            display: block;
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="../assets/dashboard.css" rel="stylesheet">
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
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="/admin/noticias">
                                <span data-feather="book-open"></span>
                                Notícias
                            </a>
                        </li> -->
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
                    <h1 class="h2">Casos</h1>
                    <div class="col-sm-3 text-right">
                        Selecione o municipio
                    </div>
                    <div class="col-sm-4 text-right">
                        <select class="form-control" id="municipio"></select>
                    </div>
                    <div class="col-sm-2 text-right">
                        em seguida clique para cadastrar
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-primary" data-toggle="modal" onclick="modalCad()">
                            Cadastrar caso
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
                                <th style="width: 20%">ações</th>
                            </tr>
                        </thead>
                    </table>
                </div>
        </div>
        <br /><br />
        </main>
    </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form" method="post">
                        <div class="form-group row">
                            <input type="hidden" id="id" name="id">
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
                                <input type="text" class="form-control" name="fonte" id="fonte" placeholder="fonte">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btn">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="fuck">
        <!-- Place at bottom of page -->
    </div>
    <script src="../assets/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
    <script src="../assets/dashboard.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-html5-1.6.2/b-print-1.6.2/cr-1.5.2/r-2.2.5/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script>
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
                selectbox.append('<option value="" selected>Clique aqui para selecionar</option>');
            }
        });
        var table;
        $(document).ready(function() {
            table = $('#tableCasos').DataTable({
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
                        "mData": null,
                        "mRender": function(data, type, row) {
                            return '<div class="btn-group" role="group" aria-label="Basic example"><a href="" class="btn btn btn-outline-dark" onClick="editar(\'' + encodeURIComponent(row.id) + '\' , \'' + encodeURIComponent(row.confirmados) + '\' , \'' + encodeURIComponent(row.suspeitos) + '\', \'' + encodeURIComponent(row.descartados) + '\' , \'' + encodeURIComponent(row.obitos) + '\' , \'' + encodeURIComponent(row.recuperados) + '\' , \'' + encodeURIComponent(row.municipio) + '\', \'' + encodeURIComponent(row.datax) + '\', \'' + row.idMunicipio + '\', \'' + encodeURIComponent(row.fonte) + '\');return false;">Editar</a>' +
                                ' <a href="" class="btn btn-outline-danger" onClick="deletar(' + encodeURIComponent(row.id) + ');return false;">Excluir</a></div>';
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
        });
        //evitar edições incompletas, reseta todos os campos
        $('#exampleModal').on('hidden.bs.modal', function(e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
        })

        //filter by selected value on second column(municipio)
        $("#municipio").on('change', function() {
            //filter by selected value on second column
            if ($('#municipio option:selected').text() == 'Clique aqui para selecionar') {
                table.column(3).search("").draw();
            } else {
                table.column(3).search($('#municipio option:selected').text()).draw();
            }
        });

        //cadastro e edição
        $(document).ready(function() {
            $('#btn').click(function() {
                var dados = $('#form').serializeArray();
                $('#exampleModal').modal('hide');
                $body = $("body");
                $body.addClass("loading");
                $.ajax({
                    type: "POST",
                    url: "/casos/storeDt",
                    data: dados,
                    success: function(result) {
                        $('#form').trigger("reset");
                        table.ajax.reload();
                        $('#id').val("");
                        $body.removeClass("loading");
                        toast("Relatório de casos salvo com sucesso", "success");
                    },
                    error: function() {
                        $body.removeClass("loading");
                        toast("Erro ao salvar relatório de casos", "error");
                    }
                });
                return false;
            });
        });



        //modal de edição
        function editar(id, confirmados, suspeitos, descartados, obitos, recuperados, municipio, datax, idMunicipio, fonte) {
            modalEd(decodeURIComponent(municipio), decodeURIComponent(datax));
            $('#id').val(decodeURIComponent(id));
            $('#idMunicipio').val(decodeURIComponent(idMunicipio));
            $('#confirmados').val(decodeURIComponent(confirmados));
            $('#suspeitos').val(decodeURIComponent(suspeitos));
            $('#obitos').val(decodeURIComponent(obitos));
            $('#recuperados').val(decodeURIComponent(recuperados));
            $('#descartados').val(decodeURIComponent(descartados));
            $('#data-caso').val(decodeURIComponent(datax));
            $('#fonte').val(decodeURIComponent(fonte));

        }

        //deleção
        function deletar(id) {
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
                    $.ajax({
                        type: "DELETE",
                        url: "../casos/deleteDt/" + decodeURIComponent(id),
                        success: function(result) {
                            table.ajax.reload();
                            // alert("Relatório de casos excluído com sucesso");
                            toast("Relatório de casos excluído com sucesso", "success");
                        },
                        error: function() {
                            toast("Erro ao excluir relatório de casos", "error");
                        }
                    });
                }
            })
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

        function formatarData(datax) {
            var data = new Date(datax),
                dia = (data.getDate() + 1).toString().padStart(2, '0'),
                mes = (data.getMonth() + 1).toString().padStart(2, '0'), //+1 pois no getMonth Janeiro começa com zero.
                ano = data.getFullYear();
            return " " + dia + "/" + mes + "/" + ano + " ";
        }

        function modalEd(municipio, data) {
            $('#exampleModalLabel').text('Editar relatório de casos de ' + municipio + ' - ' + formatarData(data));
            $('#exampleModal').modal('show')
        }

        function modalCad(municipio) {
            if ($('#municipio option:selected').val() == "") {
                alert("Por favor, antes de cadastrar selecione um município para cadastro de relatório de casos");
            } else {
                $('#exampleModalLabel').text('Cadastro de relatorio de casos: ' + $('#municipio option:selected').text());
                //$('#idMunicipio').val($('#municipio option:selected').val());
                $('#idMunicipio').val($('#municipio option:selected').val());
                $('#exampleModal').modal('show')
            }

        }
    </script>
</body>

</html>