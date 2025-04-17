<?php
include("conexao_db.php");
$cpf_sql_facial =  $_POST["cpf_facial"];

$sql_facial = "SELECT * FROM ficha_anamnese_facial WHERE cliente = ?";
$stmt_facial = $conn->prepare($sql_facial);
$stmt_facial->bind_param("s", $cpf_sql_facial);
$stmt_facial->execute();
$resultado_facial = $stmt_facial->get_result();
$linha_facial = $resultado_facial->fetch_assoc();
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
    <link rel="stylesheet" href="index.css">
    <title>Anamnese Corporal</title>
</head>

<body>
    <header>
        <h1>Aline Calesco Estética</h1>
    </header>
    <main>
        <h2>Ficha de Anamnese Facial / <a href="anamnese_facial_pesquisa.php">VOLTAR</a></h2>
        <section class="cliente_ficha">
            <h3>CLIENTE SELECIONADO</h3>
            <input type="text" name="exibir_nome_cliente" value="<?= $_POST["cpf_facial"]; ?>" disabled>
            <input type="text" name="exibir_nome_cliente" value="<?= $_POST["nome_facial"]; ?>" disabled>
        </section>
        <section class="ficha_dados">
            <form method="post" action="opr_ficha_anamnese_corporal.php" class="ficha-form">
                <input type="hidden" name="cpf_ficha_facial" value="<?= $_POST["cpf_facial"]; ?>">
                <table class="ficha-table">

                    <tbody>
                        <tr>
                            <td colspan="2" style="text-align: center; padding-bottom: .5rem">
                                <h4>ANAMNESE</h4>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="queixa_facial">Queixa principal</label></td>
                            <td><textarea name="queixa_facial" id="queixa_facial" maxlength="400"><?= isset($linha['queixa_principal']) ? $linha['queixa_principal'] : ''; ?></textarea></td>
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
                                        <input type="radio" name="tratamento_estetico_facial" value="sim" <?= isset($linha['fez_tratamento']) && $linha['fez_tratamento'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="tratamento_estetico_facial" value="nao" <?= isset($linha['fez_tratamento']) && $linha['fez_tratamento'] === 'nao' ? 'checked' : '' ?> required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="obteve_melhora_facial">Obteve alguma melhora?</label></td>
                            <td><input type="text" id="obteve_melhora_facial" name="obteve_melhora_facial" maxlength="50" value="<?= isset($linha['obteve_melhora']) ? $linha['obteve_melhora'] : ''; ?>"></td>
                        </tr>
                    </tbody>
                </table>

                <button type="submit">Salvar</button>
            </form>
        </section>
    </main>
    <footer>
        <p>
            Aline Calesco Estética &copy; 2025
        </p>
    </footer>
</body>

</html>