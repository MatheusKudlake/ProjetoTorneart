<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="../assets/bootstrap-5.3.6-dist/css/bootstrap.min.css" />
    <title>Lista de Clientes</title>
</head>
<style>
    body {
        background-color: grey;
    }
</style>

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
                            <?php
                            
                            foreach ($listaclientes as $cliente) {
                                echo '<tr>
                                        <td scope="row">
                                            ' . $cliente->getId() . '
                                        </td>
                                        <td>
                                            ' . $cliente->getNome() . '
                                        </td>
                                        <td>
                                            <a href="#?id=' . $cliente->getId() . '" name="editar" class="btn btn-primary">Editar</a>
                                            <a href="#?id=' . $cliente->getId() . '" name="excluir" class="btn btn-danger">Excluir</a>
                                        </td>
                                    <tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="../index.php">Voltar para a página inicial</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>