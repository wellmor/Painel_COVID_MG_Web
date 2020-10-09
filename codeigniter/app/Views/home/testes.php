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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <script src="/assets/dist/jquery-3.5.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.20/lodash.min.js"></script>
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
    <?php 		echo json_encode($casos); ?>
  <!-- conteudo -->
  <style>
    .vertical-center {
      min-height: 100%;
      /* Fallback for browsers do NOT support vh unit */
      min-height: 100vh;
      /* These two lines are counted as one :-)       */
      background-color: white;
      display: flex;
      align-items: center;
    }
  </style>
  <!-- <div class="jumbotron vertical-center">
    <div class="container">
      <div class="row">
        <div class="col-md-5">
          <h6>Gráfico de sumarização Microrregião de Ubá</h6>
          <div id="container-uba"></div>
          <a href="<?php base_url() ?>/Ajax/Graficos/getDadosSumarizacaoUba" style="font-family: Roboto; font-size: 20px">Exportar dados em JSON</a>

        </div>
        <div class="col-md-5">
          <h6>Gráfico de sumarização Microrregião de Juiz de Fora</h6>
          <div id="container-jf"></div>
          <a href="<?php base_url() ?>/Ajax/Graficos/getDadosSumarizacaoJf" style="font-family: Roboto; font-size: 20px">Exportar dados em JSON</a>
        </div>
        <div class="col-md-12 text-center" style="font-family: Roboto; font-size:20px; padding-top: 20px">
          <a href="https://drive.google.com/file/d/1lm3MIBP8NsY3AnVGZ7pRZJmkINlJBaTx/view?usp=sharing">Fazer download da base de dados completa em SQL (12/08/2020 19:40)</a>
        </div>
      </div>
    </div> -->
<!-- 

  </div> -->





  <script src="/assets/dist/bootstrap.bundle.js"></script>
  <script src="/assets/dist/lodash.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
  <script src="/assets/dist/dashboard.js"></script>
  <script src="https://code.highcharts.com/stock/highstock.js"></script>
  <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
  <script type="text/javascript" src="https://www.highcharts.com/samples/data/three-series-1000-points.js"></script>
  <script>
    $(document).ready(function() {

      function filterOutliers(someArray) {
        var indexesToFilter = [];
        // sort and cast
        var values = _.sortBy(someArray, o => parseInt(o.confirmados)); //array com indices preservados
        var pieceConfirmados = _.map(values, 'confirmados'); //array com apenas os confirmados(pra verificar quais indices saem)
        var pieceConfirmadosCasted = _.map(pieceConfirmados, _.parseInt);

         //PROBLEMA DE REPETIÇÃO DE VALORES INTERFERINDO NO VALOR DE Q1 E Q3
        var q1 = pieceConfirmadosCasted[Math.floor((pieceConfirmadosCasted.length / 4))]; //less than or equal to a given number.
        var q3 = pieceConfirmadosCasted[Math.ceil((pieceConfirmadosCasted.length * (3 / 4)))]; //up to the next largest integer.

        var iqr = q3 - q1;

        // // Then find min and max values
        var maxValue = q3 + iqr * 1.5;
        console.log(maxValue, "valor max");

        var minValue = q1 - iqr * 1.5;
        console.log(minValue, "valor min");


        // // Then filter anything beyond or beneath these values.
        const filteredValuesNew = pieceConfirmadosCasted.filter((x, index, arr) => {
          if ((x <= maxValue) && (x >= minValue)) {
            return true;
          } else {
            indexesToFilter.push(index);
            return false;
          }
        })

        //remover os indices outliers
        for (var i = indexesToFilter.length - 1; i >= 0; i--)
          values.splice(indexesToFilter[i], 1);

        console.log(values, "array filtrado");

        //reordenar baseado em data
        var values = _.sortBy(values, o => o.dataCaso); //array com indices preservados
        console.log(values, "array reordenado");

        return values;
      }

      let dataCaso = [];
      let confirmados = [];
      let recuperados = [];
      let obitos = [];

      let confirmadosTest = [];
      let recuperadosTest = [];


      // alert('o id e ' + id);
      $.ajax({
        url: "/Ajax/Graficos/getDadosSumarizacaoUba/", //filtrar por municipio selecionado
        method: "GET",
        dataType: 'JSON',
        success: function(data) {

          var filteredAndOrderedArray = filterOutliers(data);

          for (var key in filteredAndOrderedArray) {

            var dataCaso = new Date(filteredAndOrderedArray[key].dataCaso);
            var dataUNIX = dataCaso.getTime();

            if (!isNaN(dataUNIX)) {
              let confirmadosLocal = [dataUNIX, parseInt(filteredAndOrderedArray[key].confirmados)];
              confirmados.push(confirmadosLocal);

            }
          }


          Highcharts.stockChart('container-uba', {
            legend: {
              enabled: true
            },
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
            credits: {
              text: '*Clique nas legendas para filtrar por tipo de caso',
              href: '#'
            },
            series: [{
                name: 'Confirmados',
                color: 'orange',
                data: confirmados
              },
              // {
              //   name: 'Recuperados',
              //   color: 'green',
              //   data: recuperados
              // },
              // {
              //   name: 'Óbitos',
              //   color: 'red',
              //   data: obitos
              // },
            ],
          });

        }
      });

    });

    $(document).ready(function() {
      let dataCaso = [];
      let confirmados = [];
      let recuperados = [];
      let obitos = [];

      // alert('o id e ' + id);
      $.ajax({
        url: "/Ajax/Graficos/getDadosSumarizacaoJf/", //filtrar por municipio selecionado
        method: "GET",
        dataType: 'JSON',
        success: function(data) {
          for (var key in data) {
            var dataCaso = new Date(data[key].dataCaso);
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
          Highcharts.stockChart('container-jf', {
            legend: {
              enabled: true
            },
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
            credits: {
              text: '*Clique nas legendas para filtrar por tipo de caso',
              href: '#'
            },
            series: [{
                name: 'Confirmados',
                color: 'orange',
                data: confirmados
              }, {
                name: 'Recuperados',
                color: 'green',
                data: recuperados
              },
              {
                name: 'Óbitos',
                color: 'red',
                data: obitos
              },
            ],
          });

        }
      });
    });
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
  </script>
</body>

</html>