<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ProjetoTorneart/assets/bootstrap-5.3.6-dist/css/bootstrap.min.css" />
    <title>Lista de Serviços</title>
</head>
<style>
    body {
        background-color: grey;
    }

    .form-group {
        margin-bottom: 2%;
    }

    form {
        display: inline;
    }
</style>

<body>
    <?php if (isset($_GET["editarServico"])): ?>
        <div id="modalEditar" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Editar serviço</h3>
                        <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/ProjetoTorneart/servicos/<?= $entrega->getId() ?>" method="post">
                            <div class="row justify-content-between align-items-center form-group">
                                <div class="col-auto">
                                    <label for="peca" class="form-label">Peça:</label>
                                </div>
                                <div class="col-4">
                                    <select name="idpeca" class="form-select">
                                        <?php foreach ($listaPecas as $peca): ?>
                                            <option value="<?= $peca->getId() ?>" <?php if ($peca->getId() == $_GET["editarServico"]) {
                                                                                        echo 'selected';
                                                                                    } ?>><?= $peca->getNome() ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <label for="quant" class="form-label">Quant.:</label>
                                </div>
                                <div class="col-2">
                                    <input type="text" class="form-control" name="quantidade" id="quant"
                                        value="<?= $servicoEditar->getQuantidade() ?>">
                                </div>
                            </div>

                            <div class="row align-items-center justify-content-between form-group">
                                <div class="col-auto">
                                    <label for="preco" class="form-label">Preço:</label>
                                </div>
                                <div class="col-2">
                                    <input type="text" class="form-control" name="preco" id="preco"
                                        value="<?= $servicoEditar->getPreco() ?>">
                                </div>

                                <div class="col-auto">
                                    <label for="custo" class="form-label">Custo:</label>
                                </div>
                                <div class="col-2">
                                    <input type="text" class="form-control" name="custo" id="custo"
                                        value="<?= $servicoEditar->getCusto() ?>">
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?= $servicoEditar->getId() ?>">
                            <input type="hidden" name="identrega" value="<?= $entrega->getId() ?>">
                            <input type="hidden" name="method" value="PUT">
                            <div class="form-group">
                                <button type="submit" class="col-12 btn btn-primary">Editar</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div id="modalCadastro" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Adicionar serviço</h3>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="/ProjetoTorneart/servicos/<?= $entrega->getId() ?>" method="post">
                        <div class="row justify-content-between align-items-center form-group">
                            <div class="col-auto">
                                <label for="peca" class="form-label">Peça:</label>
                            </div>
                            <div class="col-4">
                                <select name="idpeca" id="selectPeca" class="form-select">
                                    <option value="">Selecionar...</option>
                                    <?php foreach ($listaPecas as $peca): ?>
                                        <option value="<?= $peca->getId() ?>" data-preco=<?= $peca->getPreco() ?>><?= $peca->getNome() ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-auto">
                                <label for="quantidade" class="form-label">Quant.:</label>
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control" name="quantidade">
                            </div>
                        </div>

                        <div class="row align-items-center justify-content-between form-group">
                            <div class="col-auto">
                                <label for="preco" class="form-label">Preço:</label>
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control" name="preco" id="preco">
                            </div>

                            <div class="col-auto">
                                <label for="custo" class="form-label">Custo:</label>
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control" name="custo" id="custo">
                            </div>
                        </div>
                        <input type="hidden" name="identrega" value="<?= $entrega->getId() ?>">
                        <div class="form-group">
                            <button type="submit" class="col-12 btn btn-primary">Adicionar</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-10 rounded shadow mt-5">
                <div class="card-header">
                    <h1 class="display-2">Lista de Serviços</h1>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary col-12" onclick="abrirModal('modalCadastro')">Adicionar Serviço</button>
                    <table class="table">
                        <thead>
                            <tr>
                                <td scope="col">ID</td>
                                <td scope="col">Peça</td>
                                <td scope="col">Quant.</td>
                                <td scope="col">Preço</td>
                                <td scope="col">Custo</td>
                                <td scope="col">Lucro (total)</td>
                                <td scope="col">Ações</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listaServicos as $servico): ?>
                                <tr>
                                    <td scope="row"> <?= $servico->getId() ?></td>
                                    <td><?= $pecaDAO->getPorId($servico->getIdPeca())->getNome() ?></td>
                                    <td><?= $servico->getQuantidade() ?></td>
                                    <td><?= 'R$' . $servico->getPreco() ?></td>
                                    <td><?= 'R$' . $servico->getCusto() ?></td>
                                    <td><?= 'R$' . ($servico->getPreco() - $servico->getCusto()) * $servico->getQuantidade() ?></td>
                                    <td>
                                        <a href="?editarServico=<?= $servico->getId() ?>" class="btn btn-primary">Editar</a>
                                        <form action="/ProjetoTorneart/servicos/<?= $entrega->getId() ?>" method="post" class="form-delete">
                                            <input type="hidden" name="id" value="<?= $servico->getId() ?>">
                                            <input type="hidden" name="method" value="DELETE">
                                            <button type="submit" class="btn btn-danger">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-center">
                    <a href="" onclick="history.back()">Voltar para a página inicial</a>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="/ProjetoTorneart/assets/bootstrap-5.3.6-dist/js/bootstrap.min.js"></script>
<script src="/ProjetoTorneart/assets/js/modal.js"></script>
<script src="/ProjetoTorneart/assets/js/cadastroentrega.js"></script>
<script>
    <?php if (isset($_GET["editarServico"])): ?>
        abrirModal("modalEditar");
    <?php endif; ?>
</script>

</html>