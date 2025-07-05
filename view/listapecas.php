<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/ProjetoTorneart   /assets/bootstrap-5.3.6-dist/css/bootstrap.min.css">
    <title>Peças</title>
</head>
<style>
    body {
        background-color: grey;
    }

    .form-group {
        margin-bottom: 2%;
    }
</style>
<div id="modalForm" class="modal fade">
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
                    <input type="hidden" name="idcliente" value="<?= $cliente->getId() ?>">
                    <button type="submit" class="btn btn-primary col-12">Cadastrar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<body>
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
                                        <a href="#" name="editar" class="btn btn-primary">Editar</a>
                                        <a href="#" name="excluir" class="btn btn-danger">Excluir</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <button class="btn btn-primary col-12" onclick="abrirModal()">Adicionar peça</button>
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
<script>
    function abrirModal() {
        const modal = new bootstrap.Modal(document.getElementById("modalForm"));
        modal.show();
    }
</script>

</html>