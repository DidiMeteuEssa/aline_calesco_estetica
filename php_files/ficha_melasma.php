<?php
include("conexao_db.php");
$cpf_sql_melasma =  $_POST["cpf_melasma"];

$sql_melasma = "SELECT * FROM ficha_melasma WHERE cliente = ?";
$stmt_melasma = $conn->prepare($sql_melasma);
$stmt_melasma->bind_param("s", $cpf_sql_melasma);
$stmt_melasma->execute();
$resultado_melasma = $stmt_melasma->get_result();
$linha_melasma = $resultado_melasma->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="ptbr">

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
        <h1>Aline Calesco Estética</h1>
    </header>
    <main>
        <h2>Ficha de Anamnese Facial / <a href="anamnese_melasma_pesquisa.php">VOLTAR</a></h2>
        <section class="cliente_ficha">
            <h3>CLIENTE SELECIONADO</h3>
            <input type="text" name="exibir_nome_cliente" value="<?= $_POST["nome_melasma"]; ?>" disabled>
            <input type="text" name="exibir_nome_cliente" value="<?= $_POST["cpf_melasma"]; ?>" disabled>
        </section>
        <section class="ficha_dados">
            <form method="post" action="opr_ficha_melasma.php" class="ficha-form" onsubmit="return msgSucesso()">
                <input type="hidden" name="cpf_ficha_melasma" value="<?= $_POST["cpf_melasma"]; ?>">
                <table class="ficha-table">

                    <tbody>
                        <tr>
                            <td colspan="2" style="text-align: center; padding-bottom: .5rem">
                                <h4>ANAMNESE</h4>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="queixa_melasma">Queixa principal</label></td>
                            <td><textarea name="queixa_melasma" maxlength="400"><?= isset($linha_melasma['queixa_principal']) ? $linha_melasma['queixa_principal'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center; padding-bottom: .5rem">
                                <h4>HÁBITOS DIÁRIOS</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Já fez tratamento estético?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="tratamento_estetico_melasma" value="sim" <?= isset($linha_melasma['fez_tratamento']) && $linha_melasma['fez_tratamento'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="tratamento_estetico_melasma" value="nao" <?= isset($linha_melasma['fez_tratamento']) && $linha_melasma['fez_tratamento'] === 'nao' ? 'checked' : '' ?> required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="qual_tratamento_melasma">Quais tratanentos?</label></td>
                            <td><input type="text" id="qual_tratamento_melasma" name="qual_tratamento_melasma" maxlength="50" value="<?= isset($linha_melasma['qual_tratamento']) ? $linha_melasma['qual_tratamento'] : ''; ?>"></td>
                        </tr>

                <button type="submit">Salvar</button>
            </form>
        </section>
    </main>
    <footer>
        <p>
            Aline Calesco Estética &copy; 2025
        </p>
    </footer>

    <script>
        function msgSucesso(){
            alert("Ficha salva com suceso!")
            return true
        }
    </script>
</body>

</html>