<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="../assets/bootstrap-5.3.6-dist/css/bootstrap.min.css"
    />

    <title>Cadastrar nova peça</title>
  </head>
  <style>
    body {
      background-color: grey;
    }
    .form-group {
      margin-bottom: 2%;
    }
  </style>

  <body>
    <div class="container">
      <div class="row justify-content-center mt-5">
        <div class="col-6">
          <div class="card">
            <div class="card-header">
              <h1 class="display-2">Cadastrar nova peça</h1>
            </div>
            <form
              action="../controller/PecaController.php"
              method="post"
              class="card-body"
            >
              <div class="form-group">
                <label for="desc" class="form-label">Descrição:</label>
                <input
                  type="text"
                  class="form-control"
                  id="desc"
                  name="descricao"
                />
              </div>
              <div class="form-group">
                <label for="preco" class="form-label">Preço:</label>
                <input
                  type="text"
                  class="form-control"
                  id="preco"
                  name="preco"
                />
              </div>
              <div class="form-group">
                <label for="cliente" class="form-label">Cliente:</label>
                <select name="cliente" id="cliente" class="form-select">
                    <option value="" selected></option>
                    <?php 
                        include_once '../dao/ClienteDAO.php';
                        $clienteDAO = new ClienteDAO();
                        $clientes = $clienteDAO->listar();
                        foreach($clientes as $c){
                            echo "<option value=\"{$c->getNome()}\">{$c->getNome()}</option>";
                        }
                    ?>
                </select>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary col-12">Cadastrar</button>
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
