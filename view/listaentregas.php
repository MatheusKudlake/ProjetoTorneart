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
                    <div class="row mt-3">
                        <form action="" action="get" id="formMeses">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-auto">
                                    <select name="startMonth" id="startMonth" class="form-select" style="display: inline">
                                        <?php
                                        $meses = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
                                        ?>
                                        <?php
                                        $i = 1;
                                        foreach ($meses as $mes) {
                                            echo "<option value='$i'>$mes</option>";
                                            $i++;
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <span>de</span>
                                </div>
                                <div class="col-auto">
                                    <select name="startYear" id="startYear" class="form-select">
                                        <option value="2025">2025</option>
                                        <option value="2024">2024</option>
                                        <option value="2023">2023</option>
                                    </select>
                                </div>
                                <div id="divIntervalo" style="display: none">
                                    <div class="col-auto">
                                        <span>até</span>
                                    </div>
                                    <div class="col-auto">
                                        <select name="endMonth" id="endMonth" class="form-select" style="display: inline">
                                            <option value="0">Mês...</option>
                                            <?php
                                            $i = 1;
                                            foreach ($meses as $mes) {
                                                echo "<option value='$i'>$mes</option>";
                                                $i++;
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <span>de</span>
                                    </div>
                                    <div class="col-auto">
                                        <select name="endYear" id="endYear" class="form-select">
                                            <option value="0">Ano...</option>
                                            <option value="2025">2025</option>
                                            <option value="2024">2024</option>
                                            <option value="2023">2023</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-check d-flex justify-content-center mt-2">
                                    <input type="checkbox" id="checkIntervalo" class="form-check-input me-2">
                                    <label for="intervalo" class="form-check-label">Selecionar intervalo de meses</label>
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
                        <div class="row justify-content-center">
                            <table class="table mt-3">
                                <thead>
                                    <th scope="col">ID</th>
                                    <th scope="col">Cliente</th>
                                    <th scope="col">Data</th>
                                    <th scope="col">Pago?</th>
                                    <th scope="col">Data de pagamento</th>
                                    <th scope="col">Lucro</th>
                                    <th scope="col">Ações</th>
                                </thead>
                                <tbody>
                                    <?php if (isset($listaEntregas)): ?>
                                        <?php foreach ($listaEntregas as $entrega): ?>
                                            <tr>
                                                <?php $pago = $entrega->getPago(); ?>
                                                <td scope="row"><?= $entrega->getId() ?></td>
                                                <td><?= $clienteDAO->getPorId($entrega->getIdCliente())->getNome() ?></td>
                                                <td><?= $entrega->getDataEntrega() ?></td>
                                                <td style="color: <?= $pago ? "green" : "red" ?>; font-weight: bold"><?= $pago ? "Sim" : "Não" ?></td>
                                                <td><?= $pago ? $entrega->getDataPagamento() : "" ?></td>
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
                                                        <?php if (!$entrega->getPago()): ?>
                                                            <button type="submit" class="btn btn-success"><i class="bi bi-check-lg"></i> Marcar como pago</button>
                                                        <?php else: ?>
                                                            <button type="submit" class="btn btn-danger"><i class="bi bi-x-lg"></i> Marcar como não pago</button>
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

<script>
    const checkIntervalo = document.getElementById("checkIntervalo");
    const divIntervalo = document.getElementById("divIntervalo");


    checkIntervalo.addEventListener("change", () => {
        if (checkIntervalo.checked) {
            divIntervalo.style.display = "inline";
        } else {
            divIntervalo.style.display = "none";
            document.getElementById('endYear').value = 0;
            document.getElementById('endMonth').value = 0;
        }
    });

    const formMeses = document.getElementById("formMeses");
    formMeses.addEventListener("submit", function(e) {
        const startMonth = document.getElementById('startMonth').value;
        const endMonth = document.getElementById('endMonth').value;
        const startYear = document.getElementById('startYear').value;
        const endYear = document.getElementById('endYear').value;

        const divErro = document.getElementById('divErro');
        if ((endYear != 0 || endMonth != 0) && (endYear < startYear || (endYear == startYear && endMonth < startMonth))) {
            e.preventDefault();
            divErro.style.display = "block";
        } else {
            divErro.style.display = "none";
        }
    })
</script>

</html>