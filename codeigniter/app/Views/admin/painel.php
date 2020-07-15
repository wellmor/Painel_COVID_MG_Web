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
  </style>
  <!-- Custom styles for this template -->
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
              <a class="nav-link active" href="/admin/painel">
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
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <h1 class="h2">Informações gerais dos municípios</h1>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">

          <div class="table-responsive">
            <table class="table table-striped table-bordered" style="width: 100%" id="tablePainel">
              <thead>
                <tr>
                  <th>município</th>
                  <th>último relatório de casos</th>
                  <th>última verificação de relatório</th>
                  <th>última atualização</th>
                  <!-- <th>confirmados</th>
                  <th>suspeitos</th>
                  <th>descartados</th>
                  <th>recuperados</th>
                  <th>óbitos</th> -->
                </tr>
              </thead>
            </table>
          </div>
        </div>

    </div>
  </div>

  <script src="/assets/dist/bootstrap.bundle.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
  <script src="/assets/dist/dashboard.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.21/b-1.6.2/b-html5-1.6.2/b-print-1.6.2/cr-1.5.2/r-2.2.5/datatables.min.js"></script>
  <script>
    $(document).ready(function() {
      tableLegendas = $('#tablePainel').DataTable({
        "ajax": "../Ajax/Painel/getDados",
        "processing": true,
        "order": [
          [1, "desc"]
        ],
        columns: [{
            data: "nome",
          },
          {
            data: "maxDataCaso"
          },
          {
            data: "maxDataVerificacao",
          },
          {
            data: "ultimaAtualizacao",
          },
          // {
          //   data: "suspeitos",
          // },
          // {
          //   data: "descartados",
          // },
          // {
          //   data: "recuperados",
          // },
          // {
          //   data: "obitos",
          // },
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
</body>

</html>