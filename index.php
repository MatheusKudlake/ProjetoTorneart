<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap-5.3.6-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>Página Inicial</title>
</head>
<style>
    body{
        background-color: grey;
    }
    i{
        font-size: 300%;
    }
    p{
        font-size: 150%;
    }
</style>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-12 text-center my-5">
                <h1 class="display-1">TORNEART</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h1>Registrar peça</h1>
                    </div>
                    <div class="card-body text-center">
                        <h2><i class="bi bi-gear"></i></h2>
                        <p class="">Registrar nova peça padrão</p>
                    </div>
                    <div class="card-footer">
                        <a href="view/cadastropeca.php"><button class="col-12 my-1 btn btn-primary">Acessar</button></a>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h1>Visualizar serviços</h1>
                    </div>
                    <div class="card-body text-center">
                        <h2><i class="bi bi-gear"></i></h2>
                        <p class="">Visualizar ou editar serviços</p>
                    </div>
                    <div class="card-footer">
                        <a href="#"><button class="col-12 my-1 btn btn-primary">Acessar</button></a>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h1>Cadastrar cliente</h1>
                    </div>
                    <div class="card-body text-center">
                        <h2><i class="bi bi-gear"></i></h2>
                        <p class="">Cadastrar um novo cliente</p>
                    </div>
                    <div class="card-footer">
                        <a href="view/cadastrocliente.php"><button class="col-12 my-1 btn btn-primary">Acessar</button></a>
                    </div>
                </div>
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-4">
            <div class="card">
                <div class="card-header text-center">
                    <h1>Visualizar clientes</h1>
                </div>
                <div class="card-body text-center">
                    <h2><i class="bi bi-gear"></i></h2>
                    <p class="">Visualizar ou editar clientes</p>
                </div>
                <div class="card-footer">
                    <a href="#"><button class="col-12 my-1 btn btn-primary">Acessar</button></a>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header text-center">
                    <h1>Visualizar renda</h1>
                </div>
                <div class="card-body text-center">
                    <h2><i class="bi bi-gear"></i></h2>
                    <p class="">Ver a renda de cada mês</p>
                </div>
                <div class="card-footer">
                    <a href="#"><button class="col-12 my-1 btn btn-primary">Acessar</button></a>
                </div>
            </div>
        </div>
        
    </div>
</body>
</html>