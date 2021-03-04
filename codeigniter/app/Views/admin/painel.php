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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
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
                Relatórios
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
                  <th>id</th>
                  <th>u.a non-formated</th>
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

    <div class="modal fade" id="sumarioMunicipios" tabindex="-1" role="dialog" aria-labelledby="sumarioMunicipiosLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="sumarioMunicipiosLabel">Sumário de atualizações</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          </div>
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
    var tablePainel;
    $(document).ready(function() {

      tablePainel = $('#tablePainel').DataTable({
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
          {
            data: "id",
            visible: false
          },
          {
            data: "ultimaAtualizacaoNonFormatted",
            visible: false
          }
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
        },
        "fnInitComplete": function() {
          var dadosTabela = tablePainel.rows().data();
          var listaResponsavel = [];
          //faço uma requisicao que retorna os ids das cidades que ele é responsável
          $.ajax({
            type: "GET",
            url: "../Ajax/municipios/getDadosMunicipioResponsavel",
            success: function(data) {
              var dados = JSON.parse(data);
              jQuery.each(dados, function(i, val) {
                listaResponsavel.push(val.idMunicipio);
              });
              var content = "";
              dadosTabela.each(function(value, index) {
                if (listaResponsavel.includes(value.id)) {
                  var dataAtual = new Date();
                  var dataAttISO = value.ultimaAtualizacaoNonFormatted.split("-");
                  var dataAttOBJ = new Date(dataAttISO[0], dataAttISO[1] - 1, dataAttISO[2]); //fazer cast
                  var Difference_In_Time = dataAtual.getTime() - dataAttOBJ.getTime();
                  var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
                  var roundDifferenceDays = Math.floor(Difference_In_Days);
                  console.log(roundDifferenceDays);
                  //se inclui, verifico a ultimaDataAtualização e monto uma string pra ser mostrada no final
                  if (roundDifferenceDays == 0) { //tudo ok
                    content += "<h6>" + value.nome + " - <span style='color: green'>atualizado hoje <i class='fa fa-check' aria-hidden='true'></i></span></h6>";
                  } else if (roundDifferenceDays == 1) { //atualizado ontem, faça sua atualização diária
                    content += "<h6>" + value.nome + " - <span style='color: orange'>atualizado ontem <i class='fa fa-exclamation-triangle' aria-hidden='true'></i></span></h6>";
                  } else { //atualizado há dois dias, atualize os dados
                    content += "<h6>" + value.nome + " - <span style='color: red'>sem atualizações há dois dias ou mais <i class='fa fa-times-circle' aria-hidden='true'></i></span></h6>";
                  }
                  $('#sumarioMunicipios').find('.modal-body').html(content);
                  $('#sumarioMunicipios').modal('show');
                }
              });
            },
            error: function() {

            }
          });
        }
      });

      function getDataAtual() {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        return Date(yyyy, mm, dd);
      }
    });
  </script>
</body>

</html>