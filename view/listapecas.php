<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ProjetoTorneart/assets/bootstrap-5.3.6-dist/css/bootstrap.min.css">
    <title>Peças</title>
</head>
<style>
    body {
        background-color: grey;
    }

    .form-delete {
        display: inline;
    }

    .form-group {
        margin-bottom: 2%;
    }
</style>


<body>
    <div id="modalCadastro" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Cadastrar Nova Peça</h3>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form
                        action="/ProjetoTorneart/cliente/<?= $cliente->getId() ?>/pecas"
                        method="post"
                        class="card-body">
                        <div class="form-group">
                            <label for="desc" class="form-label">Descrição:</label>
                            <input
                                type="text"
                                class="form-control"
                                id="desc"
                                name="nome" />
                        </div>
                        <div class="form-group">
                            <label for="preco" class="form-label">Preço:</label>
                            <input
                                type="text"
                                class="form-control"
                                id="preco"
                                name="preco" />
                        </div>
                        <button type="submit" class="btn btn-primary col-12">Cadastrar</button>
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
                        <h3 class="modal-title">Editar Peça</h3>
                        <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form
                            action="/ProjetoTorneart/cliente/<?= $cliente->getId() ?>/pecas"
                            method="post"
                            class="card-body">
                            <div class="form-group">
                                <label for="desc" class="form-label">Descrição:</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="desc"
                                    name="nome"
                                    value="<?= $pecaEditar->getNome() ?>" />
                            </div>
                            <div class="form-group">
                                <label for="preco" class="form-label">Preço:</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="preco"
                                    name="preco"
                                    value="<?= $pecaEditar->getPreco() ?>" />
                            </div>
                            <input type="hidden" name="id" value="<?= $pecaEditar->getId() ?>">
                            <input type="hidden" name="method" value="PUT">
                            <button type="submit" class="btn btn-primary col-12">Editar</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    
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
                            <?php foreach ($listaPecas as $peca): ?>
                                <tr>
                                    <td scope="row"> <?= $peca->getId() ?> </td>
                                    <td> <?= $peca->getNome() ?></td>
                                    <td> <?= $peca->getPreco() ?></td>
                                    <td>
                                        <a href="pecas?editar=<?= $peca->getId() ?>" name="editar" class="btn btn-primary">Editar</a>
                                        <form action="pecas" method="post" class="form-delete">
                                            <input type="hidden" name="idpeca" value="<?= $peca->getId() ?>">
                                            <input type="hidden" name="method" value="DELETE">
                                            <button type="submit" class="btn btn-danger">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <button class="btn btn-primary col-12" onclick='abrirModal("modalCadastro")'>Adicionar peça</button>
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
<script src="/ProjetoTorneart/assets/bootstrap-5.3.6-dist/js/bootstrap.min.js"></script>
<script src="/ProjetoTorneart/assets/js/modal.js"></script>
<script>
    <?php if (isset($_GET["editar"])): ?>
        abrirModal("modalEditar");
    <?php endif; ?>
</script>

</html>