<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ProjetoTorneart   /assets/bootstrap-5.3.6-dist/css/bootstrap.min.css">
    <title>Peças</title>
</head>
<style>
    body{
        background-color: grey;
    }
</style>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-10 rounded shadow mt-5">
                <div class="card-header">
                    <h1 class="display-2">Peças - <?php echo $cliente->getNome() ?></h1>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <td scope="col">ID</td>
                                <td scope="col">Nome</td>
                                <td scope="col">Preço</td>
                                <td scope="col">Ações</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($listaPecas as $peca): ?>
                                <tr>
                                    <td scope="row"> <?= $peca->getId() ?> </td>
                                    <td> <?= $peca->getNome() ?></td>
                                    <td> <?= $peca->getPreco() ?></td>
                                    <td>
                                        <a href="#" name="editar" class="btn btn-primary">Editar</a>
                                        <a href="#" name="excluir" class="btn btn-danger">Excluir</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <button class="btn btn-primary">Adicionar peça</button>
                </div>
                <div class="card-footer text-center">
                    <a href="" onclick="history.back()">Voltar para a lista de clientes</a>
                    <br>
                    <a href="/ProjetoTorneart/">Voltar para a página inicial</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>