<!doctype html>
<html lang="pt_BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v4.0.1">
    <link rel="icon" href="/assets/images/virus.png">

  <title>Painel COVID</title>

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
              <a class="nav-link active" href="/admin/perfil">
                <span data-feather="user"></span>
                Perfil (<?= session()->get('firstname') ?>)
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


          <div class="container">
            <h1 class="h2">Perfil</h1>

            <hr>
            <?php if (session()->get('success')) : ?>
              <div class="alert alert-success" role="alert">
                <?= session()->get('success') ?>
              </div>
            <?php endif; ?>
            <form action="/admin/perfil" method="post">
              <div class="row">
                <div class="col-12 col-sm-12">
                  <div class="form-group">
                    <label for="firstname">Primeiro nome</label>
                    <input type="text" class="form-control" readonly name="firstname" id="firstname" value="<?= set_value('firstname', $user['firstname']) ?>">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" readonly id="email" value="<?= $user['email'] ?>">
                  </div>
                </div>
                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" class="form-control" name="password" id="password" value="">
                  </div>
                </div>
                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <label for="password_confirm">Repita a senha</label>
                    <input type="password" class="form-control" name="password_confirm" id="password_confirm" value="">
                  </div>
                </div>
                <?php if (isset($validation)) : ?>
                  <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                      <?= $validation->listErrors() ?>
                    </div>
                  </div>
                <?php endif; ?>
              </div>
              <div class="row">
                <div class="col-12 col-sm-4">
                  <button type="submit" class="btn btn-primary">Atualizar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </main>
    </div>
  </div>






  <script src="../assets/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
  <script src="../assets/dashboard.js"></script>

</body>

</html>