<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/ProjetoTorneart/assets/bootstrap-5.3.6-dist/css/bootstrap.min.css">
    <title>Serviços</title>
</head>
<style>
    body {
        background-color: grey;
    }

    form {
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
                        <a href="/ProjetoTorneart/cadastrar-entrega" class="btn btn-primary col-11"><i class="bi bi-plus-circle"></i> Adicionar nova entrega</a>
                    </div>
                    <?php if (!empty($listaEntregas)): ?>
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
                                                <td><a href="entregas/<?= $entrega->getId() ?>" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                                    <form action="entregas/<?= $entrega->getId() ?>" method="post">
                                                        <input type="hidden" name="identrega" value="<?= $entrega->getId() ?>">
                                                        <input type="hidden" name="method" value="DELETE">
                                                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                                    </form>
                                                    <form action="entregas/<?= $entrega->getId() ?>/pago" method="post">
                                                        <input type="hidden" name="identrega" value="<?= $entrega->getId() ?>">
                                                        <input type="hidden" name="pago" value="<?= $entrega->getPago() ?>">
                                                        <input type="hidden" name="method" value="PUT">
                                                        <?php if ($entrega->getPago()): ?>
                                                            <button type="submit" class="btn btn-success"><i class="bi bi-check-lg"></i> Marcar como pago</button>
                                                        <?php else: ?>
                                                            <button type="submit" class="btn btn-success"><i class="bi bi-x-lg"></i> Marcar como não pago</button>
                                                        <?php endif; ?>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-footer text-center">
                    <a href="/ProjetoTorneart/" class="btn btn-outline-secondary"><i class="bi bi-house"></i> Voltar para a página inicial</a>
                </div>

            </div>
        </div>
    </div>
</body>

</html>