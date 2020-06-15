<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/animate.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <link rel="icon" href="/assets/images/virus.png">
    <title>Covid-19</title>
    <script>
        window.OneSignal = window.OneSignal || [];
        OneSignal.push(function() {
            OneSignal.getUserId(function(userId) {
                console.log("OneSignal User ID:", userId);
            });
            OneSignal.init({
                appId: "5ea884de-aca8-4ffe-9325-83181ed98de1",
                notifyButton: {
                    enable: true,
                },
            });
        });
    </script>
</head>

<body>
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
            <div class="navbar-brand d-flex align-items-center">
                <div class="container">
                    <img src="/assets/images/logo.png" style="width: 192px; height: 56px">
                </div>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
    </header>

    <main role="main">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/home">Buscar</a></li>
                <li class="breadcrumb-item active" aria-current="page">Notificacao</li>
            </ol>
            <section class="jumbotron text-center p-0">
                <h2 class="jumbotron-heading">Notificação</h2>
                <p class="lead text-muted">Deseja receber notificação de todos os casos da cidade de <b>Rio Pomba</b>?</p>
            </section>

            <form id="form" method="post" class="row text-center">
                <div class="col-md-6">
                    Id OneSignal: <input type="text" class="form-control" name="idOnesignal" id="idOnesignal" value="1">
                </div>
                <div class="col-md-6">
                    Id Municipio: <input type="text" class="form-control" name="idMunicipio" id="idMunicipio" value="1">
                </div>
                <div class="col-md-12">
                    <button type="button" class="btn btn-primary" id="btn">Sim</button>
                    <a href="/home"><button type="button" class="btn btn-danger">Não</button></a>
                </div>

                <div class="col-md-12">
                    <button type="button" class="btn btn-danger" id="btnAlerta">Enviar teste de alerta</button>
                </div>

            </form>
        </div>
        <script>
            $(document).ready(function() {
                $('#btnAlerta').click(function() {
                    var dados = $('#form').serializeArray();
                    $.ajax({
                        type: "POST",
                        url: "/alerta/enviarAlerta",
                        data: dados,
                        success: function(result) {
                            console.log('sucessalert');
                        }
                    });
                    return false;
                });
            });

            $(document).ready(function() {
                $('#btn').click(function() {
                    var dados = $('#form').serializeArray();
                    $.ajax({
                        type: "POST",
                        url: "/alerta/storeDt",
                        data: dados,
                        success: function(result) {
                            console.log('sucess');
                        }
                    });
                    return false;
                });
            });
        </script>
        </div><br><br>
        <?= file_get_contents('http://localhost//ajax/alertas/getdados'); ?>
        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>

</html>