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
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script> <!-- mascara numero wpp -->

  <!-- Push do OneSignal -->
  <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
  <script>
    window.OneSignal = window.OneSignal || [];
    OneSignal.push(function() {
      OneSignal.init({
        allowLocalhostAsSecureOrigin: true,
        appId: "5ea884de-aca8-4ffe-9325-83181ed98de1",
        notifyButton: {
          enable: false,
        },
      });
    });
  </script>

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


      $('.typeahead__list').on('click', 'li', function() {
        console.log('Hello');
      });


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
            <li><a href="/home/sobre" class="text-white">Sobre</a></li>
            <li><a href="/home/projetos" class="text-white">Projetos</a></li>
            <li><a href="/home/dicas" class="text-white">Dicas</a></li>
            <li><a href="/home/doacoes" class="text-white">Doação</a></li>
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
      <section class="jumbotron text-center animated">
        <!-- pesquisa -->
        <div class="card" style="width: 100%">
          <div class="card-body">
            <h5 class="card-title">Pesquise dados de sua cidade ou região</h5>
            <p class="card-text" id="back-scroll"></p>
            <div class="container" id="type-list" style="margin: 0px; padding: 0px">
              <div class="typeahead__container form-group">
                <div class="typeahead__field">
                  <div class="typeahead__query">
                    <input class="js-typeahead" placeholder="Pesquise aqui dados de seu município, região ou estado de MG..." id="pesquisar" autocomplete="off">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <h2 class="jumbotron-heading animated bounceInUp slow"><i class="fas fa-map"></i> <?= isset($nomeMicro) ? $nomeMicro : $casos['nomeMunicipio'] ?></h2>
      <?php
      $dataCaso = esc($casos['dataCaso']);
      $dataCasoListar  = date("d/m/Y", strtotime(esc($dataCaso)));
      if (isset($nomeMicro)) {
      } else if (isset($verificacao)) {
        $dataVerificacao = esc($verificacao['dataVerificacao']);
        $dataVerificacaoListar  = date("d/m/Y", strtotime(esc($dataVerificacao)));
        if ($dataVerificacao > $dataCaso) { ?>
          <p class="lead text-muted small animated bounceInUp slow"><i class="fas fa-stopwatch"></i> Atualizado em <b><?= $dataCasoListar ?></b> e verificado<a href="#informacao-caso">*</a> em <b><?= $dataVerificacaoListar ?></b> <a href="#informacao-caso"><img src="/assets/images/i.png" height="20px"></a></p>
        <?php } else { ?>
          <p class="lead text-muted small animated bounceInUp slow"><i class="fas fa-stopwatch"></i> Atualizado em <b><?= $dataCasoListar ?> </b> <a href="#informacao-caso"><img src="/assets/images/i.png" height="20px"></a></p>
        <?php }
      } else if (!isset($verificacao)) { ?>
        <p class="lead text-muted small animated bounceInUp slow"><i class="fas fa-stopwatch"></i> Atualizado em <b><?= $dataCasoListar ?></b> <a href="#informacao-caso"><img src="/assets/images/i.png" height="20px"></a></p>
      <?php } ?>
      <p class="subtext small animated bounceInUp slow"><b>FONTE:</b> <a style="word-break: break-all" target="_blank" href="<?= $casos['fonteCaso'] ?>"> <?= isset($idMicro) ? "Dados sumarizados automaticamente" :  $casos['fonteCaso'] ?> </a></p>

      <div class="row" style="margin-top:20px; margin-bottom:15px;">

        <div class="col-md-4">
          <div class="card animated bounceInUp slow">
            <div class="card-body">
              <div class="row">
                <div class="col text-left">
                  <h3 class="cor3">
                    <?php
                    if (isset($leitos['qntLeitosDisponiveis'])) {
                      if ($leitos['qntLeitosDisponiveis'] != "") {
                        echo $leitos['qntLeitosDisponiveis'];
                      } else {
                        echo '<div style="font-size: 19px; margin-bottom:10px; margin-top:10px;">Não informado</div>';
                      }
                    } else {
                      echo '<div style="font-size: 19px; margin-bottom:10px; margin-top:10px;">Não cadastrado</div>';
                    }
                    ?></h3>
                  <p class="subtext">Leitos Disponíveis</p>
                </div>
                <div class="col text-right">
                  <img class="img" src="https://images.vexels.com/media/users/3/199972/isolated/preview/c02d17a990229a2f705d5d7fa672273f-cama-de-hospital-texturizada-by-vexels.png" width="70px" height="70px">
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card animated bounceInUp slow">
            <div class="card-body">
              <div class="row">
                <div class="col text-left">
                  <h3 class="cor4">
                    <?php
                    if (isset($leitos['qntLeitosOcupados'])) {
                      if ($leitos['qntLeitosOcupados'] != "") {
                        echo $leitos['qntLeitosOcupados'];
                      } else {
                        echo '<div style="font-size: 19px; margin-bottom:10px; margin-top:10px;">Não informado</div>';
                      }
                    } else {
                      echo '<div style="font-size: 19px; margin-bottom:10px; margin-top:10px;">Não cadastrado</div>';
                    }
                    ?></h3>
                  <p class="subtext">Leitos Ocupados</p>
                </div>
                <div class="col text-right">
                  <img class="img" src="https://uploads-ssl.webflow.com/57810c374a3a560c48f027ca/5c0ee1811744313981c00b97_Reinterna.png" width="70px" height="70px">
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card animated bounceInUp slow">
            <div class="card-body">
              <div class="row">
                <div class="col text-left">
                  <h3 class="cor4">
                    <?php
                    if (isset($leitos['qntLeitosOcupados'])) {
                      if ($leitos['qntLeitosOcupados'] != "") {
                        echo ($leitos['qntLeitosOcupados'] / $leitos['qntLeitosDisponiveis']) * 100 . '';
                      } else {
                        echo '<div style="font-size: 19px; margin-bottom:10px; margin-top:10px;">Não informado</div>';
                      }
                    } else {
                      echo '<div style="font-size: 19px; margin-bottom:10px; margin-top:10px;">Não cadastrado</div>';
                    }
                    ?></h3>
                  <p class="subtext">Taxa de Ocupacão</p>
                </div>
                <div class="col text-right">
                  <img class="img" src="https://iconsplace.com/wp-content/uploads/_icons/ff0000/256/png/percentage-2-icon-14-256.png" width="70px" height="70px">
                </div>
              </div>
            </div>
          </div>
        </div>

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
                        echo '<div style="font-size: 19px; margin-bottom:10px; margin-top:10px;">Não informado</div>';
                      }
                    } else {
                      echo '<div style="font-size: 19px; margin-bottom:10px; margin-top:10px;">Não cadastrado</div>';
                    }
                    ?></h3>
                  <p class="subtext">Confirmados</p>
                </div>
                <div class="col text-right">
                  <img class="img" src="/assets/images/pesquisa.png" width="70px" height="70px">
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
                        echo '<div style="font-size: 19px; margin-bottom:10px; margin-top:10px;">Não informado</div>';
                      }
                    } else {
                      echo '<div style="font-size: 19px; margin-bottom:10px; margin-top:10px;">Não cadastrado</div>';
                    }
                    ?></h3>
                  <p class="subtext">Recuperados</p>
                </div>
                <div class="col text-right">
                  <img class="img" src="/assets/images/resultado.png" width="70px" height="70px">
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
                        echo '<div style="font-size: 19px; margin-bottom:10px; margin-top:10px;">Não informado</div>';
                      }
                    } else {
                      echo '<div style="font-size: 19px; margin-bottom:10px; margin-top:10px;">Não cadastrado</div>';
                    }
                    ?></h3>
                  <p class="subtext">Óbitos</p>
                </div>
                <div class="col text-right">
                  <img class="img" src="/assets/images/certidao-de-obito.png" width="70px" height="70px">
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
                        echo '<div style="font-size: 19px; margin-bottom:10px; margin-top:10px;">Não informado</div>';
                      }
                    } else {
                      echo '<div style="font-size: 19px; margin-bottom:10px; margin-top:10px;">Não cadastrado</div>';
                    }
                    ?></h3>
                  <p class="subtext">Suspeitos</p>
                </div>
                <div class="col text-right">
                  <img class="img" src="https://image.flaticon.com/icons/svg/2947/2947764.svg" width="70px" height="70px">
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
                        echo '<div style="font-size: 19px; margin-bottom:10px; margin-top:10px;">Não informado</div>';
                      }
                    } else {
                      echo '<div style="font-size: 19px; margin-bottom:10px; margin-top:10px;">Não informado</div>';
                    }
                    ?></h3>
                  <p class="subtext">Descartados</p>
                </div>
                <div class="col text-right">
                  <img class="img" src="/assets/images/cancelar.png" width="70px" height="70px">
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card animated bounceInUp slow">
            <div class="card-body" style="margin: 3px;">
              <div class="row">
                <div class="col-md-6 text-center">
                  <p class="subtext">Pelo <b>navegador</b></p>
                  <p class="subtext">Via <b>Whatsapp</b></p>
                </div>
                <div class="col-md-6 text-center">
                  <form id="formAlerta" method="post">
                    <input type="hidden" class="form-control" name="idMunicipio" id="idMunicipio" value="<?= esc($casos['idMunicipio']) ?>">
                    <button style="margin-bottom:10px" type="button" class="btn btn-warning" id="my-notification-button">Notificação</button>
                  </form>
                  <a href="#" data-target="#modalWpp" data-toggle="modal"><img src="/assets/images/wpp.png" height="33px"></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modalWpp" tabindex="-1" role="dialog" aria-labelledby="modalWppLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Receber alerta via Whatsapp</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                <div class="form-row center">
                  <div class="col-md-12 text-center">
                    <p>Receba informações semanais sobre os casos de Covid em <?= $casos['nomeMunicipio'] ?> diretamente no seu <b>WhatsApp</b>.</p>
                  </div>
                  <div class="col-md-12 text-center">
                    <input type="text" class="form-control numeroWpp text-center" placeholder="(99) 99999-9999" name="numeroWpp" id="numeroWpp">
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="salvarWpp()">Salvar</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
          </div>
        </div>
      </div>
      <div class="row" style="margin-bottom:15px;">
        <div class="col-md-6">
          <div class="card animated bounceInUp slow">
            <div class="card-body">
              <h5 class="subtext">Mapa</h5>
              <h6 class="card-subtitle mb-2 text-muted">Visualize informações sobre seu município no mapa interativo</h6>
              <div id="map" style="height: 440px;"></div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card animated bounceInUp slow">
            <div class="card-body" style="height: auto;">
              <h5 class="subtext">Gráficos</h5>
              <h6 class="card-subtitle mb-2 text-muted">Acompanhe a evolução de casos em seu munícipio</h6>
              <div id="container" style="height: 100%;"></div>
              <div class="float-right">
                <div class="btn-group" id="toggle_event_editing">
                  <button type="button" class="btn btn-primary btn-sm locked_active">escala linear</button>
                  <button type="button" class="btn btn-light btn-sm unlocked_inactive">escala logarítmica</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row" style="margin-bottom: 10px;">
        <div class="col-md-6">
          <div class="card animated bounceInUp slow">
            <div class="card-body">
              <h5 class="subtext">Notícias</h5>
              <?php
              if (empty($casos['fonteNoticia'])) {
                $casos['nomeMunicipio'] = "Minas Gerais";
                $casos['fonteNoticia'] = "newsapi";
              }
              echo '<h6 class="card-subtitle mb-2 text-muted">Todas as notícias de ' . $casos["nomeMunicipio"] . '</h6>';
              if ($casos['fonteNoticia'] == 'facebook') {
                echo '<div class="fb-page" data-href="https://www.facebook.com/' . $casos['facebookMunicipio'] . '" data-tabs="timeline" data-width="500" data-height="540" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false">
                    <blockquote cite="https://www.facebook.com/' . $casos['facebookMunicipio'] . '" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/' . $casos['facebookMunicipio'] . '">' . $casos['nomeMunicipio'] . '</a></blockquote></div>';
              } else {
                $url = file_get_contents('http://newsapi.org/v2/everything?q=' . str_replace(' ', '%20', $casos['nomeMunicipio']) . '%20mg&language=pt&sortBy=popularity&apiKey=ecc3c4f594974cfba75017225754f9e6');
                $jsonUrl = json_decode($url);
                if (count($jsonUrl->articles) != 0) {
                  echo '<div style="height: 540px; overflow-y: scroll;">';
                  for ($i = 0; $i < count($jsonUrl->articles); $i++) {
                    echo '<b>' . $jsonUrl->articles[$i]->title . '</b><br>';
                    echo '' . $jsonUrl->articles[$i]->description . '<br>';
                    echo '<center><a target="_blank" href="' . $jsonUrl->articles[$i]->url . '"><img src="' . $jsonUrl->articles[$i]->urlToImage . '" height="210px" style="border-radius:10px; margin:20px"></a></center>';
                    echo '<b>Fonte:</b> <a target="_blank" href="' . $jsonUrl->articles[$i]->url . '">' . $jsonUrl->articles[$i]->url . '</a><hr style="margin:20px;">';
                  }
                  echo '</div>';
                } else {
                  echo "Não encontramos nenhuma notícia para o município de <b>" . $casos['nomeMunicipio'] . "</b>.<br><img style='opacity:0.4' src='/assets/images/404.jpg'>";
                }
              }
              ?>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-12">
              <div class="card animated bounceInUp slow" style="margin:5px">
                <div class="card-body text-center">
                  <div class="row">
                    <div class="col-md-6">
                      <img src="/assets/images/dicas.png" width="70px" height="70">
                      <h5 class="subtext mt-2">Dicas</h5>
                    </div>
                    <div class="col-md-6">
                      <div class="card-subtitle mb-4 text-muted">Dicas de como se prevenir facilmente</div>
                      <a href="/home/dicas" type="button" class="btn btn-outline-dark btn-block">Ver mais</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="card animated bounceInUp slow" style="margin:5px">
                <div class="card-body text-center">
                  <div class="row">
                    <div class="col-md-6">
                      <img src="/assets/images/business.png" width="70px" height="70">
                      <h5 class="subtext mt-2">Projetos</h5>
                    </div>
                    <div class="col-md-6">
                      <div class="card-subtitle mb-4 text-muted">Projetos feitos pelo IF Sudeste Rio Pomba</div>
                      <a href="/home/projetos" type="button" class="btn btn-outline-dark btn-block">Ver mais</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card animated bounceInUp slow" style="margin:5px">
                <div class="card-body text-center">
                  <div class="row">
                    <div class="col-md-6">
                      <img src="/assets/images/sobre.png" width="70px" height="70">
                      <h5 class="subtext mt-2">Sobre</h5>
                    </div>
                    <div class="col-md-6">
                      <div class="card-subtitle mb-4 text-muted">Quem desenvolve o projeto CovidMG</div>
                      <a href="/home/sobre" type="button" class="btn btn-outline-dark btn-block">Ver mais</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="card animated bounceInUp slow" style="margin:5px">
                <div class="card-body text-center">
                  <div class="row">
                    <div class="col-md-6">
                      <img src="/assets/images/caixa.png" width="70px" height="70">
                      <h5 class="subtext mt-2">Doação</h5>
                    </div>
                    <div class="col-md-6">
                      <div class="card-subtitle mb-4 text-muted">Ajude quem realmente precisa doando</div>
                      <a href="/home/doacoes" type="button" class="btn btn-outline-dark btn-block">Ver mais</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card animated bounceInUp slow text-center" style="padding:30px; margin-bottom:15px;">
        <div class="row">
          <div class="col-sm-12 col-md-4">
            <a href="https://emcomp.com.br/"><img src="https://emcomp.com.br/cardapio/dashboard/Assets/logo.png" height="40"></a>
          </div>
          <div class="col-sm-12 col-md-4">
            <a href="https://universodiscreto.com/dacc/"><img src="/assets/images/dacc.jpg" height="38"></a>
          </div>
          <div class="col-sm-12 col-md-4">
            <a href="https://www.ifsudestemg.edu.br/riopomba"><img src="https://sistemas.riopomba.ifsudestemg.edu.br/dacg/atividades/professores/images/IF-10.png" height="38"></a>
          </div>
        </div>
      </div>
      <div class="animated bounceInUp slow" style="margin: 20px;" id="informacao-caso">
        <div class="text-muted text-justify" style="font-size: 14px;">
          <?php
          if (isset($legenda)) {
            echo "* " . $legenda['conteudoLegenda'];
          } else {
            echo "* Não há dados de legendas para o local selecionado";
          }
          ?>
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
  <script src="https://code.highcharts.com/stock/highstock.js"></script>
  <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/maps/modules/map.js"></script>
  <script type="text/javascript" src="https://www.highcharts.com/samples/data/three-series-1000-points.js"></script>

  <script>
    jQuery("input.numeroWpp")
      .mask("(99) 9999-9999?9")
      .focusout(function(event) {
        var target, phone, element;
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;
        phone = target.value.replace(/\D/g, '');
        element = $(target);
        element.unmask();
        if (phone.length > 10) {
          element.mask("(99) 99999-999?9");
        } else {
          element.mask("(99) 9999-9999?9");
        }
      });

    function salvarWpp() {
      if ($("#numeroWpp").val() == '') alert('Por favor, insira seu número do WhatsaApp para receber as mensagens!');
      else {
        $.ajax({
          type: "POST",
          url: "/alerta/salvarWpp/" + $("#idMunicipio").val() + "/" + $("#numeroWpp").val().replace(/\D/gim, ''),
          success: function(result) {
            $('#modalWpp').modal('hide');
            alert("Tudo certo!\nAgora você ficará por dentro de novas atualizações diretamente no seu WhatsApp!");
          }
        });
      }
    }

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
      let recuperados = [];
      let obitos = [];

      let id = <?php echo $casos['idMunicipio']; ?>;
      let idMicro = <?php echo isset($idMicro) ? $idMicro : "null" ?>;

      var rota = "";
      if (idMicro != null && idMicro == 58) {
        rota = "/Ajax/Graficos/getDadosSumarizacaoUba/";
      } else if (idMicro != null && idMicro == 59) {
        rota = "/Ajax/Graficos/getDadosSumarizacaoJf";
      } else {
        rota = "/Ajax/Graficos/getDados/" + id;
      }

      $.ajax({
        url: rota, //filtrar por municipio selecionado
        method: "GET",
        dataType: 'JSON',
        success: function(data) {
          for (var key in data) {
            var dataCaso = new Date(data[key].datax);
            var dataUNIX = dataCaso.getTime();
            if (!isNaN(dataUNIX)) {
              let confirmadosLocal = [dataUNIX, parseInt(data[key].confirmados)];
              confirmados.push(confirmadosLocal);

              let recuperadosLocal = [dataUNIX, parseInt(data[key].recuperados)];
              recuperados.push(recuperadosLocal);

              let obitosLocal = [dataUNIX, parseInt(data[key].obitos)];
              obitos.push(obitosLocal);

              confirmados.push(confirmadosLocal);
              recuperados.push(recuperadosLocal)
              obitos.push(obitosLocal)
            }
          }


          Highcharts.stockChart('container', {
              legend: {
                enabled: true,
                borderWidth: 2,
                itemCheckboxStyle: {
                  position: "absolute"
                },

                itemDistance: 2,
              },
              mapNavigation: {
                enableMouseWheelZoom: true
              },
              zoomType: 'x',
              scrollbar: {
                enabled: false
              },
              rangeSelector: {
                buttonTheme: {
                  width: 30
                },
                inputEditDateFormat: '%Y/%m/%d',
                inputDateFormat: '%d/%m/%Y',
                buttons: [{
                    type: 'day',
                    count: 7,
                    text: '7d',
                  },
                  {
                    type: 'day',
                    count: 15,
                    text: '15d'
                  }, {
                    type: 'month',
                    count: 1,
                    text: '1m'
                  }, {
                    type: 'month',
                    count: 3,
                    text: '3m'
                  }, {
                    type: 'all',
                    text: 'Tudo'
                  }
                ],
              },
              useHighStocks: false,
              navigator: {
                enabled: false,
              },
              plotOptions: {
                series: {
                  showCheckbox: true
                }
              },

              credits: {
                enabled: false
              },
              series: [{
                  name: 'Confirmados',
                  color: 'orange',
                  data: confirmados,
                  selected: true
                }, {
                  name: 'Recuperados',
                  color: 'green',
                  data: recuperados,
                  selected: true
                },
                {
                  name: 'Óbitos',
                  color: 'red',
                  data: obitos,
                  selected: true
                },
              ],
            },
            function(chart) {

              Highcharts.each(chart.legend.allItems, function(p, i) {
                $(p.checkbox).change(
                  function() {
                    if (this.checked) {
                      chart.legend.allItems[i].show();
                    } else {
                      chart.legend.allItems[i].hide();
                    }
                  });
              });
            });

        },

      });
    });

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
              "Região de Ubá": {
                data: data.uba,
                id: 12
              },
              "Região de Juiz de Fora": {
                data: data.jf,

              },
              "Entornos": {
                data: data.entornos
              },

            },
            callback: {
              onClickAfter: function(node, a, item, event) {
                event.preventDefault();
                // var r = confirm("You will be redirected to:\n" + item.href + "\n\nContinue?");
                window.location.href = "<?= base_url() ?>" + "/home/pesquisa/" + slugify(item.href);
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

        let idMicro = <?php echo isset($idMicro) ? $idMicro : "null" ?>;
        if (idMicro != null && idMicro == 58)
          slug = "microrregiao-de-uba";
        else if (idMicro != null && idMicro == 59)
          slug = "microrregiao-de-juiz-de-fora";

        console.log("slug atual", slug);
        nome = nome.normalize("NFD").replace(/[\u0300-\u036f]/g, "")
        nome = nome.toLowerCase();
        nome = nome.replace(/ /g, '-')
        if (slug == 'microrregiao-de-uba') {
          console.log("entrou em micro uba");
          link = "https://servicodados.ibge.gov.br/api/v2/malhas/31064?formato=application/vnd.geo+json";
          $.getJSON(link,
            function(data) {
              // console.log(data);
              geojson = data['features']['0']['geometry'];
              coordinate = geojson['coordinates'][0][0];
              generateMap(parseFloat(coordinate[1]), parseFloat(coordinate[0]), 8, 0.5);
            })
        } else if (slug == 'microrregiao-de-juiz-de-fora') {
          link = "https://servicodados.ibge.gov.br/api/v2/malhas/31065?formato=application/vnd.geo+json";
          $.getJSON(link,
            function(data) {
              // console.log(data);
              geojson = data['features']['0']['geometry'];
              coordinate = geojson['coordinates'][0][0];

              generateMap(parseFloat(coordinate[1]), parseFloat(coordinate[0]), 8, 0.5);
              // console.log(parseFloat(coordinate[0]), parseFloat(coordinate[1]));
            })
        } else if (slug == 'minas-gerais') {
          link = "https://servicodados.ibge.gov.br/api/v2/malhas/31?formato=application/vnd.geo+json";
          $.getJSON(link,
            function(data) {
              // console.log(data);
              geojson = data['features']['0']['geometry'];
              coordinate = geojson['coordinates'][0][0];

              generateMap(parseFloat(coordinate[1]), parseFloat(coordinate[0]), 5, 5);
              // console.log(parseFloat(coordinate[0]), parseFloat(coordinate[1]));
            })
        } else {
          $.getJSON(
            'https://servicodados.ibge.gov.br/api/v1/localidades/municipios/' + nome,
            function(data) {
              if (nome == 'vicosa')
                id = data[2]['id'];
              else
                id = data['id'];

              link = "https://servicodados.ibge.gov.br/api/v2/malhas/" + id + "?formato=application/vnd.geo+json";
              $.getJSON(link,
                function(data) {
                  // console.log(data);
                  geojson = data['features']['0']['geometry'];
                  coordinate = geojson['coordinates'][0][5];
                  qtdPontos = geojson['coordinates'][0].length;
                  //console.log(qtdPontos);
                  if (qtdPontos < 34)
                    generateMap(parseFloat(coordinate[1]), parseFloat(coordinate[0]), 10, 0);
                  else if (qtdPontos >= 34)
                    generateMap(parseFloat(coordinate[1]), parseFloat(coordinate[0]), 9, 0);
                })
            }
          );
        }

        // setTimeout(function(){ alert("Hello"); }, 3000);
      });

      function generateMap(latitude, longitude, zoom, correcao) {
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

    function onManageWebPushSubscriptionButtonClicked(event) {

      getSubscriptionState().then(function(state) {
        if (state.isPushEnabled) {
          var dados = [];
          OneSignal.getUserId(function(userId) {
            $.ajax({
              type: "POST",
              url: "/alerta/delete/" + userId + "/" + $("#idMunicipio").val(),
              data: dados,
              success: function(result) {
                alert("Você não será mais alertado para novas atualizações.");
              }
            });
          });
          OneSignal.setSubscription(false);

        } else {
          if (state.isOptedOut) {
            /* If the user's subscription state changes during the page's session, update the button text */
            var dados = [];
            OneSignal.getUserId(function(userId) {
              dados.push({
                name: "idOnesignal",
                value: userId
              });
              dados.push({
                name: "idMunicipio",
                value: $("#idMunicipio").val()
              });
              $.ajax({
                type: "POST",
                url: "/alerta/salvar",
                data: dados,
                success: function(result) {
                  alert("Tudo certo!\nAgora você ficará por dentro de novas atualizações diretamente no seu navegador!\nVocê pode se descadastrar a qualquer momento.");
                }
              });
            });
            OneSignal.setSubscription(true);

          } else {
            OneSignal.registerForPushNotifications();
          }
        }
      });
      event.preventDefault();
    }

    function updateMangeWebPushSubscriptionButton(buttonSelector) {
      var hideWhenSubscribed = false;
      var subscribeText = "Alerta";
      var unsubscribeText = "Descadastrar";

      getSubscriptionState().then(function(state) {
        var buttonText = !state.isPushEnabled || state.isOptedOut ? subscribeText : unsubscribeText;

        var element = document.querySelector(buttonSelector);
        if (element === null) {
          return;
        }

        element.removeEventListener('click', onManageWebPushSubscriptionButtonClicked);
        element.addEventListener('click', onManageWebPushSubscriptionButtonClicked);
        element.textContent = buttonText;

        if (state.hideWhenSubscribed && state.isPushEnabled) {
          element.style.display = "none";
        } else {
          element.style.display = "";
        }
      });
    }

    function getSubscriptionState() {
      return Promise.all([
        OneSignal.isPushNotificationsEnabled(),
        OneSignal.isOptedOut()
      ]).then(function(result) {
        var isPushEnabled = result[0];
        var isOptedOut = result[1];
        return {
          isPushEnabled: isPushEnabled,
          isOptedOut: isOptedOut
        };
      });
    }

    var OneSignal = OneSignal || [];
    var buttonSelector = "#my-notification-button";
    /* This example assumes you've already initialized OneSignal */
    OneSignal.push(function() {
      // If we're on an unsupported browser, do nothing
      if (!OneSignal.isPushNotificationsSupported()) {
        return;
      }
      updateMangeWebPushSubscriptionButton(buttonSelector);
      OneSignal.on("subscriptionChange", function(isSubscribed) {
        updateMangeWebPushSubscriptionButton(buttonSelector);
      });
    });

    OneSignal.push(function() {
      OneSignal.getUserId(function(userId) {
        var dados = [];
        $.ajax({
          type: "POST",
          url: "/alerta/verificaSeIdEstaEmMunicipio/" + userId + "/" + $("#idMunicipio").val(),
          data: dados,
          success: function(result) {
            if (result == "true") {
              //alert("Está cadastrado");
              OneSignal.setSubscription(true);

            } else {
              //alert("Não está cadastrado");
              OneSignal.setSubscription(false);
            }
          }
        });
      });
    });
  </script>

  <!-- novos gráficos -->
  <script>
    $(function() {
      Highcharts.setOptions({
        lang: {
          months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
          shortMonths: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
          weekdays: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
          loading: ['Atualizando o gráfico...aguarde'],
          contextButtonTitle: 'Exportar gráfico',
          decimalPoint: ',',
          thousandsSep: '.',
          downloadJPEG: 'Baixar imagem JPEG',
          downloadPDF: 'Baixar arquivo PDF',
          downloadPNG: 'Baixar imagem PNG',
          downloadSVG: 'Baixar vetor SVG',
          printChart: 'Imprimir gráfico',
          rangeSelectorFrom: 'De',
          rangeSelectorTo: 'Até',
          rangeSelectorZoom: 'Filtrar',
          resetZoom: 'Limpar Zoom',
          resetZoomTitle: 'Voltar Zoom para nível 1:1',
          viewFullscreen: 'Ver em tela cheia'
        }
      });

    });



    $('#toggle_event_editing button').click(function() {
      if ($(this).hasClass('locked_active') || $(this).hasClass('unlocked_inactive')) {
        /* code to do when unlocking */
        $('#container').highcharts().yAxis[0].update({
          type: 'logarithmic'
        });
      } else {
        /* code to do when locking */
        $('#container').highcharts().yAxis[0].update({
          type: 'linear'
        });
      }

      /* reverse locking status */
      $('#toggle_event_editing button').eq(0).toggleClass('locked_inactive locked_active btn-primary btn-light');
      $('#toggle_event_editing button').eq(1).toggleClass('unlocked_inactive unlocked_active btn-light btn-primary');
    });
  </script>
  <!--  -->
  <script type="text/javascript" src="/assets/dist/labs-common.js"></script>
</body>


</html>