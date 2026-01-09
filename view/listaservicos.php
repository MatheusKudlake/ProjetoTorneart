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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/ProjetoTorneart/assets/bootstrap-5.3.6-dist/css/bootstrap.min.css" />
    <script src="/ProjetoTorneart/assets/bootstrap-5.3.6-dist/js/bootstrap.bundle.min.js"></script>
    <script src="/ProjetoTorneart/assets/js/dselect.js"></script>
    <link rel="stylesheet" href="/ProjetoTorneart/assets/css/dselect.scss">

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

    .label-valores {
        margin-left: 20px;
        margin-right: 20px;
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
                                    <select name="idpeca" id="selectPecaEdicao" class="form-select">
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
                                    <input type="text" class="form-control" name="quantidade" id="quantEditar"
                                        value="<?= $servicoEditar->getQuantidade() ?>">
                                </div>
                            </div>

                            <div class="row align-items-center justify-content-between form-group">
                                <div class="col-auto">
                                    <label for="preco" class="form-label">Preço:</label>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" name="preco" id="precoEditar"
                                        value="<?= $servicoEditar->getPreco() ?>">
                                </div>

                                <div class="col-auto">
                                    <label for="custo" class="form-label">Custo:</label>
                                </div>
                                <div class="col-2">
                                    <input type="text" class="form-control" name="custo" id="custoEditar"
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
                    <h3 class="modal-title"><i class="bi bi-plus-circle"></i> Adicionar serviço</h3>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="/ProjetoTorneart/servicos/<?= $entrega->getId() ?>" method="post">
                        <div class="row justify-content-between align-items-center form-group">
                            <div class="col-auto">
                                <label for="peca" class="form-label">Peça:</label>
                            </div>
                            <div class="col-4">
                                <select name="idpeca" id="selectPecaCadastro" class="form-select">
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
                            <div class="col-3">
                                <input type="text" class="form-control" name="preco" id="precoCadastro">
                            </div>

                            <div class="col-auto">
                                <label for="custo" class="form-label">Custo:</label>
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control" name="custo" id="custoCadastro">
                            </div>
                        </div>
                        <input type="hidden" name="identrega" value="<?= $entrega->getId() ?>">
                        <div class="form-group">
                            <button type="submit" class="col-12 btn btn-primary"><i class="bi bi-plus-circle"></i> Adicionar</button>
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
                    <button type="button" class="btn btn-primary col-12" onclick="abrirModal('modalCadastro')"><i class="bi bi-plus-circle"></i> Adicionar Serviço</button>
                    <div class="text-center mt-3 mb-3">
                        <span class="fw-bold label-valores">Preço total: <span style="color: green"><?= 'R$ ' . $precoTotal ?></span></span>
                        <span class="fw-bold label-valores">Lucro total: <span style="color: <?= $lucroTotal > 0 ? 'green' : 'red' ?>"><?= 'R$ ' . $lucroTotal ?></span></span>
                    </div>
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
                                    <td><?= 'R$' . ($servico->getPreco() * $servico->getQuantidade()) - $servico->getCusto() ?></td>
                                    <td>
                                        <a href="?editarServico=<?= $servico->getId() ?>" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                        <form action="/ProjetoTorneart/servicos/<?= $entrega->getId() ?>" method="post" class="form-delete">
                                            <input type="hidden" name="id" value="<?= $servico->getId() ?>">
                                            <input type="hidden" name="method" value="DELETE">
                                            <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <form method="post">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-auto d-flex align-items-center">
                                <div class="form-check m-0">
                                    <input type="checkbox" id="pago" name="pago" class="form-check-input" <?php if ($entrega->getPago()) echo 'checked' ?>>
                                    <label for="pago" class="form-check-label">Pago?</label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <label for="datapagamento" class="form-label">Data de pagamento:</label>
                            </div>
                            <div class="col-3">
                                <input type="date" id="datapagamento" name="datapagamento" class="form-control"
                                    <?php if ($entrega->getPago()) echo "value=" . $entrega->getDataPagamento() ?>>
                            </div>
                            <div class="col-auto">
                                <label for="dataentrega" class="form-label">Data de entrega:</label>
                            </div>
                            <div class="col-3">
                                <input type="date" id="dataentrega" name="dataentrega" class="form-control"
                                    value="<?= $entrega->getDataEntrega() ?>">
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-between form-group mb-0 mt-3">
                            <div class="col-auto">
                                <label for="descricao" class="form-label">Descrição:</label>
                            </div>
                            <div class="col-10">
                                <input type="text" id="descricao" name="descricao" class="form-control" value="<?= $entrega->getDescricao() ?>">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <button type="submit" class="btn btn-success col-12"><i class="bi bi-check-lg"></i> Atualizar</button>
                        </div>
                        <input type="hidden" name="method" value="PUT">
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a href="/ProjetoTorneart/entregas" class="btn btn-outline-secondary"><i class="bi bi-arrow-return-left"></i> Voltar para lista de entregas</a>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="/ProjetoTorneart/assets/js/modal.js"></script>
<?php if (isset($_GET["editarServico"])): ?>
    <script>
        abrirModal("modalEditar");
    </script>
<?php endif; ?>
<script>
    const pago = document.getElementById('pago');
    const dataPagamento = document.getElementById('datapagamento');
    const data = new Date();

    let hoje = data.getFullYear();
    hoje += data.getMonth() < 9 ? "-0" + (data.getMonth() + 1) : "-" + (data.getMonth() + 1);
    hoje += data.getDate() < 10 ? "-0" + data.getDate() : "-" + data.getDate();

    pago.addEventListener("change", function() {
        if (this.checked) {
            dataPagamento.value = hoje;
        } else {
            dataPagamento.value = "";
        }
    });

    document.getElementById('selectPecaCadastro').addEventListener('change', function() {
        document.getElementById('precoCadastro').value = this.options[this.selectedIndex].dataset.preco || "";
    });

    dselect(document.getElementById('selectPecaCadastro'), {
        search: true
    });

    const selectPecaEdicao = document.getElementById('selectPecaEdicao');
    if (selectPecaEdicao) {
        dselect(selectPecaEdicao, {
            search: true
        });
    }
</script>

</html>