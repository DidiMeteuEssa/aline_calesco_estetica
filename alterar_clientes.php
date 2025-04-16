<!DOCTYPE html>
<html lang="ptbr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Allura&family=Oxygen:wght@300;400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="index.css">
    <title>Alteração</title>
</head>

<body>
    <header>
        <h1>Aline Calesco Estética</h1>
    </header>
    <main>
        <h2>Alteração de Clientes / <a href="index.php">VOLTAR</a></h2>
        <?php 
        include("pesquisar.php");
        ?>
        <section class="data">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th >CPF</th>
                        <th colspan="2">Editar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $resultado->fetch_assoc()) { ?>
                        <tr>
                            <form action="alterar_clientes_dados.php" method="post" class="data-form">
                                <input type="hidden" name="cpf_lista" value="<?= $row['cpf']; ?>">
                                <input type="hidden" name="nome_lista" value="<?= $row['nome']; ?>">
                                <input type="hidden" name="idade_lista" value="<?= $row['idade']; ?>">
                                <input type="hidden" name="data_nasc_lista" value="<?= $row['data_nasc']; ?>">

                                <input type="hidden" name="endereco_lista" value="<?= $row['endereco']; ?>">
                                <input type="hidden" name="cep_lista" value="<?= $row['cep']; ?>">
                                <input type="hidden" name="cidade_lista" value="<?= $row['cidade']; ?>">
                                <input type="hidden" name="bairro_lista" value="<?= $row['bairro']; ?>">
                                <input type="hidden" name="estado_lista" value="<?= $row['estado']; ?>">

                                <input type="hidden" name="tel_res_lista" value="<?= $row['tel_res']; ?>">
                                <input type="hidden" name="tel_com_lista" value="<?= $row['tel_com']; ?>">
                                <input type="hidden" name="celular_lista" value="<?= $row['tel_cel']; ?>">
                                <td>
                                    <input type="text" value="<?= $row['nome']; ?>" disabled>
                                </td>
                                <td>
                                    <input id="cpf_lista<?= $row['cpf']; ?>" type="text" name="cpf_lista" value="<?= $row['cpf']; ?>" disabled>
                                </td>
                                <td>
                                    <button type="submit" name="acao" value="editar">Editar este cliente</button>
                                </td>
                            </form>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </main>
    <footer>
        <p>
            Aline Calesco Estética &copy; 2025
        </p>
    </footer>

    <script src="https://unpkg.com/inputmask@5.0.8/dist/inputmask.min.js"></script>
    <script src="mascaras.js"></script>
    <script src="validacao_clientes.js"></script>
</body>

</html>