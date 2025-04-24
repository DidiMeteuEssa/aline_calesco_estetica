<?php
include("conexao_db.php");
$cpf_sql =  $_POST["cpf_corporal"];

$sql = "SELECT ficha_anamnese_corporal.*, campos_comuns.*
FROM ficha_anamnese_corporal
LEFT JOIN campos_comuns ON ficha_anamnese_corporal.cliente = campos_comuns.cliente
WHERE ficha_anamnese_corporal.cliente = ?

UNION ALL

SELECT ficha_anamnese_corporal.*, campos_comuns.*
FROM campos_comuns
LEFT JOIN ficha_anamnese_corporal ON campos_comuns.cliente = ficha_anamnese_corporal.cliente
WHERE campos_comuns.cliente = ?;
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $cpf_sql, $cpf_sql);
$stmt->execute();
$resultado = $stmt->get_result();
$linha = $resultado->fetch_assoc();
?>
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
    <title>Anamnese Corporal</title>
</head>

<body>
    <header>
        <h1>Aline Calesco Estética Funcional Integrativa</h1>
    </header>
    <main>
        <h2>Ficha de Anamnese Corporal / <a href="anamnese_corporal_pesquisa.php">VOLTAR</a></h2>
        <section class="cliente_ficha">
            <h3>CLIENTE SELECIONADO</h3>
            <input type="text" name="exibir_nome_cliente" value="<?= $_POST["nome_corporal"]; ?>" disabled>
            <input type="text" name="exibir_nome_cliente" value="<?= $_POST["cpf_corporal"]; ?>" disabled>
        </section>
        <section class="ficha_dados">
            <form method="post" action="opr_fichas.php" class="ficha-form" onsubmit="return msgSucesso()">
                <input type="hidden" name="cpf_ficha_corporal" value="<?= $_POST["cpf_corporal"]; ?>">
                <input type="hidden" name="opr" value="1">
                <table class="ficha-table">
                    <tbody>
                        <tr>
                            <td><label>Descreva detalhadamente quais <br>são os cosmeticos que você <br>utiliza / já utilizou: </label></td>
                            <td><textarea name="uso_cosmetico" maxlength="300"><?= isset($linha['uso_cosmetico']) ? $linha['uso_cosmetico'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Usa tabaco?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="fumante" value="sim" <?= isset($linha['fumante']) && $linha['fumante'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="fumante" value="nao" <?= isset($linha['fumante']) && $linha['fumante'] === 'nao' ? 'checked' : '' ?> required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="diureticos">Ingere algum líquido diurético?</label></td>
                            <td><input type="text" name="diureticos" required placeholder="Bebida alcoólica, chás diuréticos, chimarrão..." value="<?= isset($linha['diureticos']) ? $linha['diureticos'] : '' ?>" style="width: 40rem;"></td>
                        </tr>
                        <tr>
                            <td><label for="litros_agua">Quantos litros de água consome por dia:</label></td>
                            <td><input type="text" name="litros_agua" required value="<?= isset($linha['litros_agua']) ? $linha['litros_agua'] : '' ?>" style="width: 40rem;"></td>
                        </tr>
                        <tr>
                            <td><label for="qualidade_sono">Quantas horas de sono por dia?</label></td>
                            <td><input type="text" name="qualidade_sono" required value="<?= isset($linha['qualidade_sono']) ? $linha['qualidade_sono'] : '' ?>" style="width: 40rem;"></td>
                        </tr>
                        <tr>
                            <td><label for="alimentacao_detalhada">Alimentação detalhada: </label></td>
                            <td><textarea name="alimentacao_detalhada" required maxlength="300"><?= isset($linha['alimentacao_detalhada']) ? $linha['alimentacao_detalhada'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Faz dieta rigorosa?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="dieta" value="sim" required <?= isset($linha['dieta_rigorosa']) && $linha['dieta_rigorosa'] === 'sim' ? 'checked' : '' ?>> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="dieta" value="nao" required <?= isset($linha['dieta_rigorosa']) && $linha['dieta_rigorosa'] === 'nao' ? 'checked' : '' ?>> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center; padding-bottom: .5rem">
                                <h4>HISTÓRICO CLÍNICO E AVALIAÇÃO CUTÂNEA</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Alguma patologia de pele?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="patologia_pele" value="hipotireoidismo" required <?= isset($linha['patologia_pele']) && $linha['patologia_pele'] === 'hipotireoidismo' ? 'checked' : '' ?>> Hipotiroidismo
                                    </label>
                                    <label>
                                        <input type="radio" name="patologia_pele" value="hipertiroidismo" required <?= isset($linha['patologia_pele']) && $linha['patologia_pele'] === 'hipertiroidismo' ? 'checked' : '' ?>> Hipertiroidismo
                                    </label>
                                    <label>
                                        <input type="radio" name="patologia_pele" value="nao" required <?= isset($linha['patologia_pele']) && $linha['patologia_pele'] === 'nao' ? 'checked' : '' ?>> Não
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="medicacao">Usa alguma medicação frequente? <br>Há quanto tempo?</label></td>
                            <td><textarea name="medicacao" maxlength="300"><?= isset($linha['medicacao']) ? $linha['medicacao'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Usa suplementos oral?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="suplemento_oral" value="sim" required <?= isset($linha['usa_suplemento_oral']) && $linha['usa_suplemento_oral'] === 'sim' ? 'checked' : '' ?>> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="suplemento_oral" value="nao" required <?= isset($linha['usa_suplemento_oral']) && $linha['usa_suplemento_oral'] === 'nao' ? 'checked' : '' ?>> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="quais_suplementos">Quais suplementos?</label></td>
                            <td><textarea name="quais_suplementos" maxlength="200"><?= isset($linha['qual_suplemento_oral']) ? $linha['qual_suplemento_oral'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="trombose">Possui trombose? Qual?</label></td>
                            <td><textarea name="trombose" maxlength="200"><?= isset($linha['trombose']) ? $linha['trombose'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Possui antecendentes oncológicos?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="antecedentes_oncologico" value="sim" required <?= isset($linha['antecendentes_oncologicos']) && $linha['antecendentes_oncologicos'] === 'sim' ? 'checked' : '' ?>> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="antecedentes_oncologico" value="nao" required <?= isset($linha['antecendentes_oncologicos']) && $linha['antecendentes_oncologicos'] === 'nao' ? 'checked' : '' ?>> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="diabetes">Possui diabetes? Qual?</label></td>
                            <td><textarea name="diabetes" maxlength="200"><?= isset($linha['diabetes']) ? $linha['diabetes'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Já fez cirurgia plástica?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="cirurgia_plastica" value="sim" required <?= isset($linha['cirurgia_plastica_estetica']) && $linha['cirurgia_plastica_estetica'] === 'sim' ? 'checked' : '' ?>> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="cirurgia_plastica" value="nao" required <?= isset($linha['cirurgia_plastica_estetica']) && $linha['cirurgia_plastica_estetica'] === 'nao' ? 'checked' : '' ?>> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="qual_cirurgia">Qual cirurgia?</label></td>
                            <td><textarea name="qual_cirurgia" maxlength="200"><?= isset($linha['qual_cirurgia_plastica']) ? $linha['qual_cirurgia_plastica'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center; padding-bottom: .5rem">
                                <h4>COM RELAÇÃO À ALOPECIA</h4>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="queixa_alopecia">Queixa principal</label></td>
                            <td><textarea name="queixa_alopecia" id="queixa_alopecia" maxlength="500"><?= isset($linha['queixa_alopecia']) ? $linha['queixa_alopecia'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td>
                                <p>A doença acomete outras partes do corpo?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="acomete_corpo" value="sim" required <?= isset($linha['doenca_acomete_corpo']) && $linha['doenca_acomete_corpo'] === 'sim' ? 'checked' : '' ?>> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="acomete_corpo" value="nao" required <?= isset($linha['doenca_acomete_corpo']) && $linha['doenca_acomete_corpo'] === 'nao' ? 'checked' : '' ?>> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="qual_parte_corpo">Quais partes do corpo?</label></td>
                            <td><textarea name="qual_parte_corpo" maxlength="200"><?= isset($linha['qual_doenca_acomete_corpo']) ? $linha['qual_doenca_acomete_corpo'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="tempo_disfuncao">Há quanto começou essa disfunção?</label></td>
                            <td><textarea name="tempo_disfuncao" maxlength="200"><?= isset($linha['tempo_disfuncao']) ? $linha['tempo_disfuncao'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td>
                                <p>A doença está:</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="status_doenca" value="estavel" required <?= isset($linha['status_disfuncao']) && $linha['status_disfuncao'] === 'estavel' ? 'checked' : '' ?>> Estável
                                    </label>
                                    <label>
                                        <input type="radio" name="status_doenca" value="aumentando" required <?= isset($linha['status_disfuncao']) && $linha['status_disfuncao'] === 'aumentando' ? 'checked' : '' ?>> Aumentando
                                    </label>
                                    <label>
                                        <input type="radio" name="status_doenca" value="diminuindo" required <?= isset($linha['status_disfuncao']) && $linha['status_disfuncao'] === 'diminuindo' ? 'checked' : '' ?>> Diminuindo
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
            Aline Calesco Estética Funcional Integrativa &copy; 2025
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