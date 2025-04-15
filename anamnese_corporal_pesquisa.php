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
    <title>Anamnese Corporal</title>
</head>

<body>
    <header>
        <h1>Aline Calesco Estética</h1>
    </header>
    <main>
        <h2>Ficha de Anamnese de Avaliação Corporal / <a href="index.php">VOLTAR</a></h2>
        <?php 
        include("pesquisar.php");
        ?>
        <section class="alterar_clientes">
            <table class="alterar_clientes-table">
                <thead>
                    <tr class="borda">
                        <th class="itens">Nome</th>
                        <th class="itens">CPF</th>
                        <th class="itens" colspan="2">Criar / Editar Ficha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $resultado->fetch_assoc()) { ?>
                        <tr>
                            <form action="ficha_anamnese_corporal.php" method="post" class="alterar_clientes-form">
                                <input type="hidden" name="cpf_corporal" value="<?= $row['cpf']; ?>">
                                <input type="hidden" name="nome_corporal" value="<?= $row['nome']; ?>">
                                <td>
                                    <input type="text" value="<?= $row['nome']; ?>" disabled>
                                </td>
                                <td>
                                    <input id="cpf_lista<?= $row['cpf']; ?>" type="text" name="cpf_lista" value="<?= $row['cpf']; ?>" disabled>
                                </td>
                                <td>
                                    <button type="submit" name="acao" value="editar">Criar / Editar Ficha</button>
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