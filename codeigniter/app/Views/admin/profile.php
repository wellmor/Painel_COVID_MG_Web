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
  <link href="/assets/css/bootstrap.css" rel="stylesheet">
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
              <a class="nav-link" href="/admin/painel">
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
              <a class="nav-link active" href="/admin/perfil">
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
          <div class="container">
            <h1 class="h2">Perfil - Alterar senha</h1>
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
                    <label for="nomeUsuario">Nome</label>
                    <input type="text" class="form-control" readonly name="nomeUsuario" id="nomeUsuario" value="<?= set_value('nomeUsuario', $user['nomeUsuario']) ?>">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" readonly id="emailUsuario" value="<?= $user['emailUsuario'] ?>">
                  </div>
                </div>
                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <label for="senhaUsuario">Nova senha</label>
                    <input type="password" class="form-control" name="senhaUsuario" id="senhaUsuario" value="">
                  </div>
                </div>
                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <label for="senhaUsuario_confirm">Repita a nova senha</label>
                    <input type="password" class="form-control" name="senhaUsuario_confirm" id="senhaUsuario_confirm" value="">
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






  <script src="/assets/dist/bootstrap.bundle.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
  <script src="/assets/dist/dashboard.js"></script>

</body>

</html>