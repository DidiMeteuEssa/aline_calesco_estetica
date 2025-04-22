<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Allura&family=Oxygen:wght@300;400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../index.css">
    <title>Anamnese Facial</title>
</head>

<body>
    <header>
        <h1>Aline Calesco Estética Funcional Integrativa</h1>
    </header>
    <main>
        <h2>Ficha de Anamnese de Avaliação Facial / <a href="../index.php">VOLTAR</a></h2>
        <?php
        include("pesquisar.php");
        ?>
        <section class="data">
            <table class="data-table">
                <?php
                if ($numero_linhas > 0) {
                ?>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th colspan="2">Visualizar / Editar Ficha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $resultado->fetch_assoc()) { ?>
                            <tr>
                                <form action="ficha_anamnese_facial.php" method="post" class="data-form">
                                    <input type="hidden" name="cpf_facial" value="<?= $row['cpf']; ?>">
                                    <input type="hidden" name="nome_facial" value="<?= $row['nome']; ?>">
                                    <td>
                                        <input type="text" value="<?= $row['nome']; ?>" disabled>
                                    </td>
                                    <td>
                                        <input id="cpf_lista<?= $row['cpf']; ?>" type="text" name="cpf_lista" value="<?= $row['cpf']; ?>" disabled>
                                    </td>
                                    <td>
                                        <button type="submit" name="acao" value="editar">Visualizar / Editar Ficha</button>
                                    </td>
                                </form>
                            </tr>
                        <?php } ?>
                    </tbody>
                <?php
                } else {
                ?>
                    <tr>
                        <td>
                            <p>Nenhum cliente cadastrado!</p>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </section>
    </main>
    <footer>
        <p>
            Aline Calesco Estética Funcional Integrativa &copy; 2025
        </p>
    </footer>
</body>

</html>