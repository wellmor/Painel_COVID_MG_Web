<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" crossorigin="anonymous"></script>
  <script defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/regular.min.js" crossorigin="anonymous"></script>
  <script defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/solid.min.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <style>
    p {
      width: 100%;
    }
  </style>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/TypeWatch/3.0.1/jquery.typewatch.js"></script>
  <script type="text/javascript" charset="utf-8">
    function delay(callback, ms) {
      var timer = 0;
      return function() {
        var context = this,
          args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function() {
          callback.apply(context, args);
        }, ms || 0);
      };
    }


    $(document).ready(function() {
      $('.search-box input[type="text"]').on("keyup input", delay(function(e) {
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if (inputVal.length) {
          //alert(inputVal);
          $.ajax({
            type: "GET",
            url: encodeURI("../Ajax/Pesquisa/getDados/" + inputVal),
            success: function(result) {
              resultDropdown.html(result);
            },
          });
        } else {
          resultDropdown.empty();
        }
      }, 500));

      // Set search input value on click of result item
      $(document).on("click", ".result p", function() {
        var url = $(event.target).find("a").prop("href"); // getting the clicked element with event target.
        window.location = url;
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
      });
    });
  </script>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="/assets/css/main.css">
  <link rel="stylesheet" href="/assets/css/animate.css">
  <link rel="icon" href="/assets/images/virus.png">

  <style type="text/css">
    body {
      font-family: Arail, sans-serif;
    }

    .search-box {
      position: relative;
    }

    /* Formatting search box */
    .result {
      /* position: absolute; */
      z-index: 999;
      top: 100%;
      width: 80%;
      left: 0;
      background-color: white;
      border-radius: 5px;
    }

    .search-box input[type="text"],
    .result {
      width: 100%;
      box-sizing: border-box;
    }

    /* Formatting result items */
    .result p {
      margin: 0;
      padding: 7px 10px;
      border: 1px solid #CCCCCC;
      border-top: none;
      cursor: pointer;
    }

    .result p:hover {
      background: #f2f2f2;
    }

    a.disable-links {
      pointer-events: none;
    }
  </style>


  <title>Painel COVID-MG</title>
</head>

<body>
  <header>
    <div class="collapse bg-dark" id="navbarHeader">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 col-md-7 py-4">
            <h4 class="text-white">Sobre o projeto</h4>
            <p class="text-muted">Painel de Informações e Emissão de Alertas no Enfrentamento ao COVID-19 nas Microrregiões de Ubá e Juiz de Fora</p>
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
      <section class="jumbotron text-center ">
        <h2 class="jumbotron-heading">Painel CoronaVírus</h2>
        <p class="lead text-muted"><i class="fas fa-map"></i> Escolha sua cidade:</p>
        <div class="md-form mt-0 animated slow search-box">
          <input class="form-control" id="pesquisa" autocomplete="off" type="text" placeholder="Buscar">
          <div class="result"></div>
        </div>
      </section>
      <!--Substituir essa section abaixo pela de cima para filtrar por microregião também
        <section class="jumbotron text-center ">
                <h2 class="jumbotron-heading">Painel CoronaVírus</h2>
                <p class="lead text-muted"><i class="fas fa-map"></i> Escolha sua cidade:</p>
                <div class="input-group md-form mt-0 animated flash slow">
                    <input class="form-control" type="text" placeholder="Buscar" aria-label="Search">
                     <div class="input-group-append">
                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                            Microrregião
                          </button>
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Ubá</a>
                            <a class="dropdown-item" href="#">Juiz de Fora</a>
                          </div>
                     </div>
                </div>
            </section>-->
      <h2 class="jumbotron-heading"><i class="fas fa-map"></i> Minas Gerais</h2>
      <!-- <p class="lead text-muted"><i class="fas fa-stopwatch"></i> Última Atualização 08/04/2020</p> -->
      <div class="row">
        <div class="col-md-4">
          <div class="card animated bounceInUp fast">
            <div class="card-body" align="center">
              <img src="/assets/images/business%20(1).png" width="70" height="70" alt="">
              <h5 class="subtext mt-2">Projetos</h5>
              <h6 class="card-subtitle mb-2 text-muted">Projetos desenvolvido pelo IF Sudeste</h6>
              <a href="/home/projetos" type="button" class="btn btn-outline-dark btn-block">Ver Mais</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card animated bounceInUp fast">
            <div class="card-body" align="center">
              <img src="/assets/images/dicas.png" width="70" height="70" alt="">
              <h5 class="subtext mt-2">Dicas</h5>
              <h6 class="card-subtitle mb-2 text-muted">O que você precisa saber e fazer</h6>
              <a href="/home/dicas" type="button" class="btn btn-outline-dark btn-block">Ver Mais</a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card animated bounceInUp fast">
            <div class="card-body" align="center">
              <img src="/assets/images/caixa.png" width="70" height="70" alt="">
              <h5 class="subtext mt-2">Doação</h5>
              <h6 class="card-subtitle mb-2 text-muted">O que você precisa saber e fazer</h6>
              <a href="" type="button" class="btn btn-outline-dark btn-block" data-toggle="modal" data-target="#exampleModal">Ver Mais</a>
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
  </main>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>