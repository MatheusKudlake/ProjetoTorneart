<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ProjetoTorneart/assets/bootstrap-5.3.6-dist/css/bootstrap.min.css">
    <title>Serviços</title>
</head>
<style>
    body {
        background-color: grey;
    }
    form{
        display: inline;
    }
</style>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-11 rounded shadow mt-5">
                <div class="card-header">
                    <h1 class="display-2">Entregas</h1>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <a href="/ProjetoTorneart/cadastrar-entrega" class="btn btn-primary col-11">Adicionar nova entrega</a>
                    </div>
                    <div class="row justify-content-center">
                        <table class="table mt-3">
                            <thead>
                                <th scope="col">ID</th>
                                <th scope="col">Cliente</th>
                                <th scope="col">Data</th>
                                <th scope="col">Pago?</th>
                                <th scope="col">Data de pagamento</th>
                                <th scope="col">Ações</th>
                            </thead>
                            <tbody>
                                <?php if (isset($listaEntregas)): ?>
                                    <?php foreach ($listaEntregas as $entrega): ?>
                                        <tr>
                                            <td scope="row"><?= $entrega->getId() ?></td>
                                            <td><?= $clienteDAO->getPorId($entrega->getIdCliente())->getNome() ?></td>
                                            <td><?= $entrega->getDataEntrega() ?></td>
                                            <td><?= $entrega->getPago() ? "Sim" : "Não" ?></td>
                                            <td><?= $entrega->getPago() ? $entrega->getDataPagamento() : "" ?></td>
                                            <td><a href="entregas/<?= $entrega->getId() ?>" class="btn btn-primary">Ver ou Editar</a>
                                            <form action="entregas/<?= $entrega->getId() ?>" method="post">
                                                <input type="hidden" name="identrega" value="<?= $entrega->getId() ?>">
                                                <input type="hidden" name="method" value="DELETE">
                                                <button type="submit" class="btn btn-danger">Excluir</button>
                                            </form>
                                        </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="/ProjetoTorneart/">Voltar para a página inicial</a>
                </div>

            </div>
        </div>
    </div>
</body>

</html>