<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="/ProjetoTorneart/assets/bootstrap-5.3.6-dist/css/bootstrap.min.css" />
    <title>Lista de Clientes</title>
</head>
<style>
    body {
        background-color: grey;
    }

    .form-group {
        margin-bottom: 2%;
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
                <form action="cliente" method="post" class="card-body">
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
                    <form action="cliente" method="post" class="card-body">
                        <div class="form-group">
                            <label for="nome" class="form-label">Nome:</label>
                            <input type="text" id="nome" name="nome" class="form-control" value="<?= $clienteEditar->getNome() ?>" />
                        </div>
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
                    <table class="table">
                        <thead>
                            <tr>
                                <td scope="col">ID</td>
                                <td scope="col">Nome</td>
                                <td scope="col">Ações</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listaClientes as $cliente): ?>
                                <tr>
                                    <td scope="row"> <?= $cliente->getId() ?></td>
                                    <td> <?= $cliente->getNome() ?></td>
                                    <td>
                                        <a href="cliente?editar=<?= $cliente->getId() ?>" class="btn btn-primary">Editar</a>
                                        <a href="#" class="btn btn-danger">Excluir</a>
                                        <a href="cliente/<?= $cliente->getId() ?>/pecas" class="btn btn-success">Ver peças</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-primary col-12" onclick='abrirModal("modalCadastro")'>Adicionar cliente</button>
                <div class="card-footer text-center">
                    <a href="" onclick="history.back()">Voltar para a página inicial</a>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="/ProjetoTorneart/assets/bootstrap-5.3.6-dist/js/bootstrap.min.js"></script>
<script>
    function abrirModal(idModal) {
        const modal = new bootstrap.Modal(document.getElementById(idModal));
        modal.show();
    }

    <?php if (isset($_GET["editar"])): ?>
        abrirModal("modalEditar");
    <?php endif; ?>
</script>

</html>