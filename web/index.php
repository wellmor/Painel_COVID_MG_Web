<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.jshttps://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/regular.min.js" crossorigin="anonymous"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/solid.min.js" crossorigin="anonymous"></script>  
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

      <script type="text/javascript">
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("pesquisa-proccess.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
                console.log(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="icon" href="images/virus.png">  

    <style type="text/css">
    body{
        font-family: Arail, sans-serif;
    }
    .search-box{
        position: relative;
    }
    /* Formatting search box */
    .result{
        position: absolute;        
        z-index: 999;
        top: 100%;
        left: 0;
    }
    .search-box input[type="text"], .result{
        width: 100%;
        box-sizing: border-box;
    }
    /* Formatting result items */
    .result p{
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #CCCCCC;
        border-top: none;
        cursor: pointer;
    }
    .result p:hover{
        background: #f2f2f2;
    }
</style>
  
  
    <title>Covid-19</title>
  </head>
  <body>
    <header>
      <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
              <h4 class="text-white">About</h4>
              <p class="text-muted">Add some information about the album below, the author, or any other background context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off to some social networking sites or contact information.</p>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
              <h4 class="text-white">Menu</h4>
              <ul class="list-unstyled">
                <li><a href="#" class="text-white">Cidades</a></li>
                <li><a href="#" class="text-white">Doação</a></li>
                <li><a href="#" class="text-white">Mapa</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="Index.php" class="navbar-brand d-flex align-items-center">
              <strong><h6>COVID-19/MINAS GERAIS <i class="fas fa-virus"></i></h6></strong>
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
                <div class="md-form mt-0 animated flash slow search-box">
                    <input class="form-control " autocomplete="off" type="text" placeholder="Buscar">
                    <div class="result"></div>
                </div>  
             
            </section>
            <div class="row">
                <div class="col-md-4">
                    <div class="card animated bounceInUp slow delay-0s">
                            <div class="card-body" align="center">
                                <img  src="images/business%20(1).png"width="70" height="70" alt="">          
                                <h5 class="subtext mt-2">Projetos</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Projetos desenvolvido pelo IF Sudeste</h6>
                                <a href="" type="button" class="btn btn-outline-dark btn-block">Ver Mais</a>
                            </div>    
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card animated bounceInUp slow delay-1s">
                            <div class="card-body" align="center">
                                <img  src="images/dicas.png"width="70" height="70" alt="">          
                                <h5 class="subtext mt-2">Dicas Oficiais</h5>
                                <h6 class="card-subtitle mb-2 text-muted">O que você precisa saber e fazer</h6>
                                <a href="dicas.php" type="button" class="btn btn-outline-dark btn-block">Ver Mais</a>
                            </div>
                        </div>
                </div>
                 <div class="col-md-4">
                    <div class="card animated bounceInUp slow delay-2s">
                            <div class="card-body" align="center">
                                <img  src="images/caixa.png"width="70" height="70" alt="">          
                                <h5 class="subtext mt-2">Doação</h5>
                                <h6 class="card-subtitle mb-2 text-muted">O que você precisa saber e fazer</h6>
                                <a href="" type="button" class="btn btn-outline-dark btn-block">Ver Mais</a>
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