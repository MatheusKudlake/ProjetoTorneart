<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/assets/bootstrap-5.3.6-dist/css/bootstrap.min.css">
    <script src="/assets/bootstrap-5.3.6-dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/dselect.js"></script>
    <link rel="stylesheet" href="/assets/css/dselect.scss">

    <title>Serviços</title>
</head>
<style>
    body {
        background-color: grey;
    }

    form {
        display: inline;
    }

    .data {
        display: none;
    }

    .label-valores{
        margin-left: 20px;
        margin-right: 20px;
    }

    .td-texto {
        max-width: 200px;
        white-space: normal;
        word-break: break-word;
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
                        <a href="/cadastrar-entrega" class="btn btn-primary col-11"><i class="bi bi-plus-circle"></i> Adicionar nova entrega</a>
                    </div>
                    <div class="row text-center">
                        <h1 class="display-5">Pesquisar</h1>
                    </div>
                    <div class="row mt-3">
                        <form action="" method="get" id="formMeses">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-auto">
                                    <span>Cliente:</span>
                                </div>
                                <div class="col-3">
                                    <select name="cliente" id="cliente" class="form-select">
                                        <option value="0">Todos</option>
                                        <?php foreach ($listaClientes as $cliente): ?>
                                            <?php $idCliente = $cliente->getId() ?>
                                            <option value="<?= $idCliente ?>" <?php if (isset($_GET["cliente"]) && $idCliente == $_GET["cliente"]) echo 'selected' ?>><?= $cliente->getNome() ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row align-items-center justify-content-center mt-3">
                                <div class="col-auto">
                                    <span>Data:</span>
                                </div>
                                <div class="col-auto mes">
                                    <select name="mes" id="mes" class="form-select" style="display: inline">
                                        <?php
                                        $mesAtual = date('m');
                                        $anoAtual = date('Y');

                                        $meses = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
                                        $anos = [];
                                        for ($i = $anoAtual; $i >= 2025; $i--) {
                                            $anos[] += $i;
                                        }

                                        $i = 1;
                                        foreach ($meses as $mes):
                                        ?>
                                            <option value='<?= $i ?>' <?php if (isset($_GET["mes"]) && $_GET["mes"] == $i) echo 'selected' ?>><?= $mes ?></option>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-auto mes">
                                    <span>de</span>
                                </div>
                                <div class="col-auto mes">
                                    <select name="ano" id="ano" class="form-select">
                                        <?php foreach ($anos as $ano): ?>
                                            <option value="<?= $ano ?>" <?php if (isset($_GET["ano"]) && $_GET["ano"] == $ano) echo 'selected' ?>><?= $ano ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-auto data">
                                    <input type="date" id="dataInicio" name="dataInicio" class="form-control" disabled>
                                </div>
                                <div class="col-auto data">
                                    <span><i class="bi bi-arrow-right"></i></span>
                                </div>
                                <div class="col-auto data">
                                    <input type="date" id="dataFinal" name="dataFinal" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-check d-flex justify-content-center mt-2">
                                    <input type="checkbox" id="checkIntervalo" class="form-check-input me-2">
                                    <label for="checkIntervalo" class="form-check-label">Selecionar intervalo de datas</label>
                                </div>
                            </div>
                            <div class="row justify-content-center mt-2">
                                <button type="submit" class="btn btn-primary col-2"><i class="bi bi-search"></i> Pesquisar</button>
                            </div>
                            <div class="row text-center mt-2" id="divErro" style="display: none">
                                <p style="color: red">Erro: a data de início deve ser antes da final!</p>
                            </div>
                        </form>
                    </div>

                    <?php if (!empty($listaEntregas)): ?>
                        <?php if ((isset($_GET["mes"]) && isset($_GET["ano"]) || (isset($_GET["dataInicio"]) && isset($_GET["dataFinal"])))): ?>
                            <h1 class="display-5">Resultado da pesquisa:</h1>
                        <?php else: ?>
                            <h1 class="display-5">Mês atual:</h1>
                        <?php endif; ?>
                        <div class="d-flex justify-content-center">
                            <span class="fw-bold label-valores">Valor já recebido: <span style="color: green"><?= 'R$ ' . $valorRecebido ?></span></span>
                            <span class="fw-bold label-valores">Lucro atual: <span style="color: <?= $lucroTotal > 0 ? 'green' : 'red' ?>"><?= 'R$ ' . $lucroTotal ?></span></span>
                            <span class="fw-bold label-valores">Valor a receber: <span style="color: red"><?= 'R$ ' . $valorAReceber ?></span></span>
                        </div>
                        <div class="row justify-content-center">
                            <table class="table mt-3">
                                <thead>
                                    <th scope="col">Desc.</th>
                                    <th scope="col">Cliente</th>
                                    <th scope="col">Data</th>
                                    <th scope="col">Pago?</th>
                                    <th scole="col">Preço</th>
                                    <th scope="col">Lucro</th>
                                    <th scope="col">Ações</th>
                                </thead>
                                <tbody>
                                    <?php if (isset($listaEntregas)): ?>
                                        <?php foreach ($listaEntregas as $entrega): ?>
                                            <tr>
                                                <td class="td-texto"><?= $entrega->getDescricao() ?></td>
                                                <?php $pago = $entrega->getPago(); ?>
                                                <td class="td-texto"><?= $clienteDAO->getPorId($entrega->getIdCliente())->getNome() ?></td>
                                                <td><?= DateTime::createFromFormat('Y-m-d', $entrega->getDataEntrega())->format('d/m/Y') ?></td>
                                                <td style="color: <?= $pago ? "green" : "red" ?>; font-weight: bold"><?= $pago ? "Sim" : "Não" ?></td>
                                                <td><?= 'R$ ' . $entrega->getPrecoTotal() ?></td>
                                                <?php $lucroTotal = $entrega->getLucroTotal(); ?>
                                                <td style="color: <?php
                                                                    if ($lucroTotal > 0) {
                                                                        echo "green";
                                                                    } else if ($lucroTotal < 0) {
                                                                        echo "red";
                                                                    } else {
                                                                        echo "black";
                                                                    }
                                                                    ?>">
                                                    <?php
                                                    if ($lucroTotal) echo "R$ " . $lucroTotal ?>
                                                </td>
                                                <td>
                                                    <a href="entregas/<?= $entrega->getId() ?>" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                                    <form action="entregas/<?= $entrega->getId() ?>" method="post">
                                                        <input type="hidden" name="identrega" value="<?= $entrega->getId() ?>">
                                                        <input type="hidden" name="method" value="DELETE">
                                                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                                    </form>
                                                    <form action="entregas/<?= $entrega->getId() ?>/pago" method="post">
                                                        <input type="hidden" name="identrega" value="<?= $entrega->getId() ?>">
                                                        <input type="hidden" name="pago" value="<?= $entrega->getPago() ?>">
                                                        <input type="hidden" name="method" value="PUT">
                                                        <?php if (!$entrega->getPago()): ?>
                                                            <button type="submit" class="btn btn-success"><i class="bi bi-check-lg"></i> Marcar pago</button>
                                                        <?php else: ?>
                                                            <button type="submit" class="btn btn-danger"><i class="bi bi-x-lg"></i> Marcar não pago</button>
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
                    <a href="/" class="btn btn-outline-secondary"><i class="bi bi-house"></i> Voltar para a página inicial</a>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    const checkIntervalo = document.getElementById("checkIntervalo");
    const elementosData = Array.from(document.getElementsByClassName("data"));
    const elementosMes = Array.from(document.getElementsByClassName("mes"));
    const inputMes = document.getElementById("mes");
    const inputAno = document.getElementById("ano");
    const inputDataInicio = document.getElementById("dataInicio");
    const inputDataFinal = document.getElementById("dataFinal");

    const data = new Date();
    const mes = data.getMonth() + 1;
    const ano = data.getFullYear();

    <?php $modoData = isset($_GET["dataInicio"]) && isset($_GET["dataFinal"]) ?>
    document.addEventListener("DOMContentLoaded", function() {
        alternarModoData(<?= json_encode($modoData) ?>);
        if (<?= json_encode($modoData) ?>) {
            inputDataInicio.value = <?= json_encode($_GET["dataInicio"] ?? null)  ?>;
            inputDataFinal.value = <?= json_encode($_GET["dataFinal"] ?? null) ?>;
            checkIntervalo.checked = true;

            const url = new URL(window.location);
            url.searchParams.delete('mes');
            url.searchParams.delete('ano');
            window.history.replaceState({}, '', url);

        }
    });

    checkIntervalo.addEventListener("change", function() {
        alternarModoData(checkIntervalo.checked);
    });

    function alternarModoData(valor) {
        if (valor) {
            elementosMes.forEach(item => item.style.display = "none");
            elementosData.forEach(item => item.style.display = "inline");

            inputMes.value = "";
            inputMes.disabled = true;
            inputAno.value = "";
            inputAno.disabled = true;

            inputDataInicio.value = "";
            inputDataInicio.disabled = false;
            inputDataFinal.value = "";
            inputDataFinal.disabled = false;
        } else {
            elementosMes.forEach(item => item.style.display = "inline");
            elementosData.forEach(item => item.style.display = "none");

            inputMes.disabled = false;
            inputAno.disabled = false;

            inputDataInicio.value = "";
            inputDataInicio.disabled = true;
            inputDataFinal.value = "";
            inputDataFinal.disabled = true;

        }
    }

    inputDataInicio.addEventListener('change', function() {
        inputDataFinal.min = inputDataInicio.value;
    })

    const formMeses = document.getElementById("formMeses");
    formMeses.addEventListener("submit", function(e) {
        const divErro = document.getElementById('divErro');

        if (inputDataInicio.value > inputDataFinal.value) {
            e.preventDefault();
            divErro.style.display = "block";
        } else {
            divErro.style.display = "none";
        }
    });

    const selectClientes = document.getElementById("cliente");
    dselect(selectClientes, {
        search: true
    });
</script>

</html>