<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="../assets/bootstrap-5.3.6-dist/css/bootstrap.min.css"
    />
    <title>Cadastro de cliente</title>
  </head>
  <style>
    body{
        background-color: grey;
    }
    .form-group{
        margin-bottom:2%;
    }
  </style>
  <body>
    <div class="container">
      <div class="row justify-content-center mt-5">
        <div class="col-6">
          <div class="card">
            <div class="card-header">
              <h1 class="display-2">Cadastrar novo cliente</h1>
            </div>
            <form action="#" method="post" class="card-body">
              <div class="form-group">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" id="nome" name="nome" class="form-control" />
              </div>
              <div class="form-group">
                <button type="submit" class="col-12 btn btn-primary">
                  Enviar
                </button>
              </div>
            </form>
            <div class="card-footer text-center">
              <a href="../index.php">Voltar para a página inicial</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
