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
    </style>
    <!-- Custom styles for this template -->
    <link href="../assets/dashboard.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

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
                        <!-- <li class="nav-item">
                            <a class="nav-link active" href="/admin/noticias">
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
                    <h1 class="h2">Notícias</h1>
                    <button type="button" class="btn btn-primary" data-toggle="modal" onclick="modalCad()">
                        Cadastrar noticia
                    </button>
                </div>


                <div class="table-responsive">
                    <table class="table table-striped table-bordered" style="width: 100%" id="tableNoticias">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>titulo</th>
                                <th style="width: 20%">ações</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <br /><br />
            </main>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form" method="post">
                        <input type="hidden" id="id" name="id">
                        <input type="text" class="form-control" name="titulo" id="titulo" placeholder="titulo">
                        <textarea class=" form-control" name="conteudo" id="conteudo" placeholder="conteudo"></textarea>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btn">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#conteudo').summernote();
        });
    </script>

    <script src="../assets/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
    <script src="../assets/dashboard.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-html5-1.6.2/b-print-1.6.2/cr-1.5.2/r-2.2.5/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script>
        var table;
        $(document).ready(function() {
            table = $('#tableNoticias').DataTable({
                "ajax": "../Ajax/Noticias/getDados",
                "processing": true,
                columns: [{
                        data: "id",
                        visible: false
                    },
                    {
                        data: "titulo"
                    },
                    {
                        "mData": null,
                        "mRender": function(data, type, row) {
                            return '<div class="btn-group" role="group" aria-label="Basic example"><a href="" class="btn btn btn-outline-dark" onClick="editar(\'' + row.id + '\' , \'' + row.titulo + '\' , \'' + escape(row.conteudo) + '\');return false;">Editar</a>' +
                                ' <a href="" class="btn btn-outline-danger" onClick="deletar(' + row.id + ');return false;">Excluir</a></div>';
                        },
                    }
                ],
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'print',
                        title: 'Painel Covid 19 - Relatório de Notícias - emitido em ' + dataAtualFormatada(),
                        text: '<i class="print"></i> impressão',
                        exportOptions: {
                            columns: [1, 2]
                        }
                    },
                    {
                        extend: 'pdf',
                        title: 'Painel Covid 19 - Relatório de Casos - emitido em ' + dataAtualFormatada(),
                        text: '<i class=""></i> pdf',
                        exportOptions: {
                            columns: [1, 2]
                        }
                    },
                    {
                        extend: 'excel',
                        title: 'Painel Covid 19 - Relatório de Casos - emitido em ' + dataAtualFormatada(),
                        text: '<i class=""></i> excel',
                        exportOptions: {
                            columns: [1, 2]
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
    </script>
    <script>
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

        //cadastro e edição
        $(document).ready(function() {
            $('#btn').click(function() {
                var dados = $('#form').serializeArray();
                $.ajax({
                    type: "POST",
                    url: "/noticias/storeDt",
                    data: dados,
                    success: function(result) {
                        $('#form').trigger("reset");
                        table.ajax.reload();
                        $('#id').val("");
                        $('#exampleModal').modal('hide')
                    }
                });
                return false;
            });
        });

        //modal de edição
        function editar(id, titulo, conteudo) {
            modalEd();
            $('#id').val(id);
            $('#titulo').val(titulo);
            // alert(decodeURI(conteudo));
            $("#conteudo").summernote("code", unescape(conteudo));

        }

        //deleção
        function deletar(id) {
            $.ajax({
                type: "DELETE",
                url: "../noticias/deleteDt/" + id,
                success: function(result) {
                    table.ajax.reload();
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

        function modalEd() {
            $('#exampleModalLabel').text('Editar notícia');
            $('#exampleModal').modal('show')
        }

        function modalCad() {
            $("#conteudo").summernote("code", "Digite o conteúdo da notícia aqui");
            $('#exampleModalLabel').text('Cadastrar notícia');
            $('#exampleModal').modal('show')
        }
    </script>
</body>

</html>