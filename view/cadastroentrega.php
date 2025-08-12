<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/ProjetoTorneart/assets/bootstrap-5.3.6-dist/css/bootstrap.min.css">
    <title>Cadastrar serviço</title>
</head>
<style>
    body {
        background-color: grey;
    }

    .form-group {
        margin-bottom: 3%;
    }
</style>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-12 rounded shadow mt-5">
                <div class="card-header">
                    <h1 class="display-2">Cadastrar Entrega</h1>
                </div>
                <div class="card-body">
                    <form action="cadastrar-entrega" method="get">
                        <div class="row align-items-center justify-content-center">
                            <label for="cliente" class="form-label col-auto">Cliente:</label>
                            <div class="col-auto">
                                <select name="cliente" id="cliente" class="form-select">
                                    <option value="">Selecionar...</option>
                                    <?php foreach ($listaClientes as $cliente): ?>
                                        <option value="<?= $cliente->getId() ?>"><?= $cliente->getNome() ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">Confirmar</button>
                            </div>
                    </form>
                    <?php if (isset($_GET["cliente"])): ?>
                        <div class="row">
                            <?php if (empty($listaPecas)): ?>
                                <p>Nenhuma peça cadastrada no sistema!</p>
                            <?php else: ?>
                                <div class="col-6">
                                    <h1 class="display-3 mb-4">Cadastro:</h1>
                                    <form id="formServico">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="row align-items-center justify-content-between form-group">
                                                    <div class="col-auto">
                                                        <label for="peca" class="form-label">Peça:</label>
                                                    </div>
                                                    <div class="col-6">
                                                        <select name="peca" id="selectPeca" class="form-select">
                                                            <option value="">Selecionar...</option>
                                                            <?php foreach ($listaPecas as $peca): ?>
                                                                <option value="<?= $peca->getId() ?>" data-preco="<?= $peca->getPreco() ?>"><?= $peca->getNome() ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row align-items-center justify-content-between form-group">
                                                    <div class="col-auto">
                                                        <label for="preco" class="form-label">Preço (unit.):</label>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="text" id="preco" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row align-items-center justify-content-between form-group">
                                                    <div class="col-auto">
                                                        <label for="custo" class="form-label">Custo (total):</label>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="text" id="custo" name="custo" value="0" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="row align-items-center form-group">
                                                    <div class="col-auto">
                                                        <label for="quant" class="form-label">Quantidade:</label>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="number" id="quant" class="form-control" name="quantidade">
                                                    </div>
                                                </div>
                                                <div class="row align-items-center mt-2 form-group">
                                                    <div>
                                                        <span class="form-text" id="labelPrecoTotal">Preço total:</span>
                                                        <span class="form-text" id="precoTotal"></span>
                                                    </div>
                                                </div>
                                                <div class="row align-items-center mt-3 form-group">
                                                    <div>
                                                        <span class="form-text" id="labelLucro">Lucro:</span>
                                                        <span class="form-text" id="lucro"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center form-group mt-3">
                                            <button type="submit" name="cadastrarServico" class="btn btn-primary col-8">Salvar</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-6">
                                    <h1 class="display-3">Serviços:</h1>
                                    <p id="textoNenhumServico">Nenhum serviço cadastrado!</p>

                                    <table class="table table-striped" id="tabela" style="display:none">
                                        <thead>
                                            <tr>
                                                <th scope="col">Peça</td>
                                                <th scope="col">Quant.</td>
                                                <th scope="col">Preço (total)</td>
                                                <th scope="col">Custo</td>
                                                <th scope="col">Lucro</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (isset($listaServicos)): ?>
                                                <?php foreach ($listaServicos as $servico): ?>
                                                    <tr>
                                                        <th scope="row"><?= $servico->getPeca()->getNome() ?></th>
                                                        <td><?= $servico->getQuantidade() ?></td>
                                                        <td><?= $servico->getPeca()->getPreco() * $servico->getQuantidade() ?></td>
                                                        <td><?= $servico->getCusto() ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                    <div class="col-auto form-check" style="display: none" id="divCheckPago">
                                        <input type="checkbox" name="pago" class="form-check-input" id="checkPago">
                                        <label for="pago" class="form-check-label">Pago</label>
                                    </div>
                                </div>
                        </div>
                        <div class="row justify-content-center mt-2">
                            <form action="cadastrar-entrega" method="post" id="formFinal">
                                <input type="hidden" name="servicosJson" id="servicosJson">
                                <input type="hidden" name="idcliente" value="<?= $_GET["cliente"] ?>">
                                <input type="hidden" name="dataentrega" id="dataEntrega">
                                <input type="hidden" name="datapagamento" id="dataPagamento" value="">
                                <div class="row mt-3">
                                    <button type="submit" class="btn btn-success">Enviar</button>
                                </div>
                            </form>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                </div>
                <div class="card-footer text-center mt-3">
                    <a href="/ProjetoTorneart/entregas"><i class="bi bi-arrow-return-left"></i> Voltar para a lista de entregas</a>
                    <br>
                    <a href="/ProjetoTorneart/"><i class="bi bi-house"></i> Voltar para a página inicial</a>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="/ProjetoTorneart/assets/js/cadastroentrega.js"></script>