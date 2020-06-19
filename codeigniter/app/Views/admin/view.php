    <!DOCTYPE html>
    <html lang="pt">

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Painel COVID</title>
      <link href="/assets/css/bootstrap.css" rel="stylesheet">
      <link rel="icon" href="/assets/images/virus.png">

    </head>

    <body>
      <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
        <div class="container">
          <h3 class="text-center">Painel de Informações e Emissão de Alertas no Enfrentamento ao COVID-19 nas Microrregiões de Ubá e Juiz de Fora</h3>
          <hr>
          <?php if (session()->get('success')) : ?>
            <div class="alert alert-success" role="alert">
              <?= session()->get('success') ?>
            </div>
          <?php endif; ?>
          <form action="/admin" method="post">
            <div class="form-group">
              <label for="emailUsuario">Email</label>
              <input type="text" class="form-control" name="emailUsuario" id="emailUsuario" value="<?= set_value('emailUsuario') ?>">
            </div>
            <div class="form-group">
              <label for="senhaUsuario">Senha</label>
              <input type="password" class="form-control" name="senhaUsuario" id="senhaUsuario" placeholder="Insira sua senha">
            </div>
            <?php if (isset($validation)) : ?>
              <div class="col-12">
                <div class="alert alert-danger" role="alert">
                  <?= $validation->listErrors() ?>
                </div>
              </div>
            <?php endif; ?>
            <div class="row">
              <div class="col-12 col-sm-4">
                <button type="submit" class="btn btn-primary">Entrar</button>
              </div>
              <div class="col-12 col-sm-8 text-right">
                <a href="/home">Voltar ao início</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </body>

    </html>