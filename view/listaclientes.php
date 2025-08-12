<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/ProjetoTorneart/assets/bootstrap-5.3.6-dist/css/bootstrap.min.css" />

    <title>Lista de Clientes</title>
</head>
<style>
    body {
        background-color: grey;
    }

    .form-group {
        margin-bottom: 2%;
    }

    .form-delete {
        display: inline;
    }
</style>

<div id="modalCadastro" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Cadastrar nova peça</h3>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="cliente" method="post">
                    <div class="form-group">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" id="nome" name="nome" class="form-control" />
                    </div>
                    <div class="form-group">
                        <button type="submit" class="col-12 btn btn-primary">
                            Cadastrar
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<?php if (isset($_GET["editar"])): ?>
    <div id="modalEditar" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Editar peça</h3>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="cliente" method="post">
                        <div class="form-group">
                            <label for="nome" class="form-label">Nome:</label>
                            <input type="text" id="nome" name="nome" class="form-control" value="<?= $clienteEditar->getNome() ?>" />
                        </div>
                        <input type="hidden" name="id" value="<?= $clienteEditar->getId() ?>">
                        <input type="hidden" name="method" value="PUT">
                        <div class="form-group">
                            <button type="submit" class="col-12 btn btn-primary">
                                Editar
                            </button>
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

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-10 rounded shadow mt-5">
                <div class="card-header">
                    <h1 class="display-2">Lista de Clientes</h1>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary col-12" onclick='abrirModal("modalCadastro")'><i class="bi bi-plus-circle"></i> Adicionar cliente</button>
                    <?php if (!empty($listaClientes)): ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</td>
                                    <th scope="col">Nome</td>
                                    <th scope="col">Ações</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listaClientes as $cliente): ?>
                                    <tr>
                                        <td scope="row"> <?= $cliente->getId() ?></td>
                                        <td> <?= $cliente->getNome() ?></td>
                                        <td>
                                            <a href="cliente?editar=<?= $cliente->getId() ?>" class="btn btn-primary">Editar</a>
                                            <form action="cliente" method="post" class="form-delete">
                                                <input type="hidden" name="idcliente" value="<?= $cliente->getId() ?>">
                                                <input type="hidden" name="method" value="DELETE">
                                                <button type="submit" class="btn btn-danger">Excluir</button>
                                            </form>
                                            <a href="cliente/<?= $cliente->getId() ?>/pecas" class="btn btn-success">Ver peças</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
                <div class="card-footer text-center">
                    <a href="" onclick="history.back()"><i class="bi bi-house"></i> Voltar para a página inicial</a>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="/ProjetoTorneart/assets/bootstrap-5.3.6-dist/js/bootstrap.min.js"></script>
<script src="/ProjetoTorneart/assets/js/modal.js"></script>
<script>
    <?php if (isset($_GET["editar"])): ?>
        abrirModal("modalEditar");
    <?php endif; ?>
</script>

</html>