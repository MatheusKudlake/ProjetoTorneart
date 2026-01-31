<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/assets/bootstrap-5.3.6-dist/css/bootstrap.min.css">
    <title>Peças - <?= $cliente->getNome() ?></title>
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
                        action="/cliente/<?= $cliente->getId() ?>/pecas"
                        method="post"
                        class="card-body">
                        <div class="form-group">
                            <label for="desc" class="form-label">Descrição:</label>
                            <input
                                type="text"
                                class="form-control"
                                id="desc"
                                name="nome" 
                                placeholder="Nome da peça..."/>
                        </div>
                        <div class="form-group">
                            <label for="preco" class="form-label">Preço:</label>
                            <input
                                type="text"
                                class="form-control"
                                id="preco"
                                name="preco" 
                                placeholder="0.00"/>
                        </div>
                        <button type="submit" class="btn btn-primary col-12"><i class="bi bi-plus-circle"></i> Cadastrar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <div id="modalEditar" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Editar Peça</h3>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form
                        action=""
                        method="post"
                        class="card-body"
                        id="formEdicao">
                        <div class="form-group">
                            <label for="desc" class="form-label">Descrição:</label>
                            <input
                                type="text"
                                class="form-control"
                                id="descEdicao"
                                name="nome" />
                        </div>
                        <div class="form-group">
                            <label for="preco" class="form-label">Preço:</label>
                            <input
                                type="text"
                                class="form-control"
                                id="precoEdicao"
                                name="preco" />
                        </div>
                        <input type="hidden" name="id" id="inputIdEdicao">
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

    <div id="modalExcluir" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Confirmar exclusão</h3>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p id="msgExcluir"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form action="pecas" method="post">
                        <input type="hidden" name="method" value="DELETE">
                        <input type="hidden" name="idpeca" id="inputIdExcluir">
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-10 rounded shadow mt-5">
                <div class="card-header">
                    <h1 class="display-2">Peças - <?php echo $cliente->getNome() ?></h1>
                </div>
                <div class="card-body">
                    <button class="btn btn-primary col-12" onclick='abrirModal("modalCadastro")'><i class="bi bi-plus-circle"></i> Adicionar peça</button>
                    <?php if (!empty($listaPecas)): ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nome</td>
                                    <th scope="col">Preço</td>
                                    <th scope="col">Ações</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listaPecas as $peca): ?>
                                    <tr>
                                        <td> <?= $peca->getNome() ?></td>
                                        <td> <?= 'R$ ' . $peca->getPreco() ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary" onclick="
                                            abrirModalEdicao({id:<?= $peca->getId() ?>, idCliente: <?= $peca->getIdCliente() ?>, desc:'<?= $peca->getNome() ?>', preco:<?= $peca->getPreco() ?>})">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger" onclick="
                                            abrirModalExcluir({id:<?= $peca->getId() ?>, desc:'<?= $peca->getNome() ?>'})">
                                               <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="row text-center mt-3">
                            <p>Nenhuma peça cadastrada ainda!</p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-footer text-center">
                    <a href="/cliente" class="btn btn-outline-secondary"><i class="bi bi-arrow-return-left"></i> Voltar para a lista de clientes</a>
                    <br>
                    <a href="/" class="btn btn-outline-secondary mt-2"><i class="bi bi-house"></i> Voltar para a página inicial</a>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="/assets/bootstrap-5.3.6-dist/js/bootstrap.min.js"></script>
<script src="/assets/js/modal.js"></script>
<script src="/assets/js/mascaraNumeros.js"></script>
<script>
    function abrirModalEdicao(dadosPeca) {
        document.getElementById('formEdicao').action = `/cliente/${dadosPeca.idCliente}/pecas`;
        document.getElementById('inputIdEdicao').value = dadosPeca.id;
        document.getElementById('descEdicao').value = dadosPeca.desc;
        document.getElementById('precoEdicao').value = dadosPeca.preco;
        abrirModal('modalEditar');
    }

    function abrirModalExcluir(dadosPeca) {
        document.getElementById('msgExcluir').innerHTML = `Deseja excluir a peça ${dadosPeca.desc}?`;
        document.getElementById('inputIdExcluir').value = dadosPeca.id;
        abrirModal('modalExcluir');
    }

    mascaraPreco("preco");
</script>

</html>