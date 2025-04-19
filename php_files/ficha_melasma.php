<?php
include("conexao_db.php");
$cpf_sql_melasma =  $_POST["cpf_melasma"];

$sql_melasma = "SELECT * FROM ficha_melasma WHERE cliente = ?";
$stmt_melasma = $conn->prepare($sql_melasma);
$stmt_melasma->bind_param("s", $cpf_sql_melasma);
$stmt_melasma->execute();
$resultado_melasma = $stmt_melasma->get_result();
$linha_melasma = $resultado_melasma->fetch_assoc();

$sql_pessoal = "SELECT * FROM clientes WHERE cpf = ?";
$stmt_pessoal = $conn->prepare($sql_pessoal);
$stmt_pessoal->bind_param("s", $cpf_sql_melasma);
$stmt_pessoal->execute();
$resultado_pessoal = $stmt_pessoal->get_result();
$linha_pessoal = $resultado_pessoal->fetch_assoc();
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
        <h2>Ficha de Anamnese Facial / <a href="melasma_pesquisa.php">VOLTAR</a></h2>
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
                                <h4>INFORMAÇÕES PESSOAIS</h4>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="cidade">Cidade em que reside:</label></td>
                            <td><input type="text" name="cidade" value="<?= $linha_pessoal['cidade']; ?>" disabled style="width: 40rem;"></td>
                        </tr>
                        <tr>
                            <td><label for="cidade">Trabalha como:</label></td>
                            <td><input type="text" name="cidade" value="<?= $linha_pessoal['profissao']; ?>" disabled style="width: 40rem;"></td>
                        </tr>
                        <tr>
                            <td><label for="cidade">Possui filhos?</label></td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="filhos_melasma" value="sim" <?= isset($linha_melasma['filhos']) && $linha_melasma['filhos'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="filhos_melasma" value="nao" <?= isset($linha_melasma['filhos']) && $linha_melasma['filhos'] === 'nao' ? 'checked' : '' ?> required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="cidade">Casada?</label></td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="casada_melasma" value="sim" <?= isset($linha_melasma['casada']) && $linha_melasma['casada'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="casada_melasma" value="nao" <?= isset($linha_melasma['casada']) && $linha_melasma['casada'] === 'nao' ? 'checked' : '' ?> required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="casamento_saudavel_melasma">Possui casamento saudável?</label></td>
                            <td><textarea name="casamento_saudavel_melasma" maxlength="300" required><?= isset($linha_melasma['casamento_saudavel']) ? $linha_melasma['casamento_saudavel'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="como_conheceu_trabalho">Como conheceu meu trabalho?</label></td>
                            <td><textarea name="como_conheceu_trabalho" maxlength="200" required><?= isset($linha_melasma['como_conheceu_trabalho']) ? $linha_melasma['como_conheceu_trabalho'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center; padding-bottom: .5rem">
                                <h4>QUEIXA</h4>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="queixa_principal_melasma">Queixa principal</label></td>
                            <td><textarea name="queixa_principal_melasma" maxlength="500"><?= isset($linha_melasma['queixa_principal']) ? $linha_melasma['queixa_principal'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="tempo_percebeu_melasma">Há quanto tempo <br>você percebeu essa(s) <br> queixa(s)?</label></td>
                            <td><textarea name="tempo_percebeu_melasma" maxlength="200"><?= isset($linha_melasma['tempo_percebeu']) ? $linha_melasma['tempo_percebeu'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center; padding-bottom: .5rem">
                                <h4>HISÓTICO DE TRATAMENTOS</h4>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="tempo_percebeu_manchas_melasma">Há quanto tempo <br>você percebeu essa(s) <br> manchas?</label></td>
                            <td><textarea name="tempo_percebeu_manchas_melasma" maxlength="200"><?= isset($linha_melasma['tempo_percebeu_manchas']) ? $linha_melasma['tempo_percebeu_manchas'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Já tratou melasma antes?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="tratou_melasma_melasma" value="sim" <?= isset($linha_melasma['tratou_melasma']) && $linha_melasma['tratou_melasma'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="tratou_melasma_melasma" value="nao" <?= isset($linha_melasma['tratou_melasma']) && $linha_melasma['tratou_melasma'] === 'nao' ? 'checked' : '' ?> required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Já fez uso de ácido ou peeling?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="uso_acido_melasma" value="sim" <?= isset($linha_melasma['uso_acido']) && $linha_melasma['uso_acido'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="uso_acido_melasma" value="nao" <?= isset($linha_melasma['uso_acido']) && $linha_melasma['uso_acido'] === 'nao' ? 'checked' : '' ?> required> Nao
                                    </label>
                                </div>
                            </td>
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

    <script>
        function msgSucesso() {
            alert("Ficha salva com suceso!")
            return true
        }
    </script>
</body>

</html>