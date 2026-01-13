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
    body {
        background-color: grey;
    }

    .icon {
        font-size: 300%;
    }

    p {
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
        <div class="row justify-content-center">
            <div class="col-5">
                <div class="card">
                    <div class="card-header text-center">
                        <h1>Clientes</h1>
                    </div>
                    <div class="card-body text-center">
                        <h2><i class="bi bi-person icon"></i></h2>
                        <p>Visualizar e editar clientes</p>
                    </div>
                    <div class="card-footer">
                        <a href="cliente" class="col-12 my-1 btn btn-primary"><i class="bi bi-box-arrow-in-right"></i> Acessar</a>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="card">
                    <div class="card-header text-center">
                        <h1>Entregas</h1>
                    </div>
                    <div class="card-body text-center">
                        <h2><i class="bi bi-box-seam icon"></i></h2>
                        <p>Visualizar ou adicionar entregas</p>
                    </div>
                    <div class="card-footer">
                        <a href="entregas" class="col-12 my-1 btn btn-primary"><i class="bi bi-box-arrow-in-right"></i> Acessar</a>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>