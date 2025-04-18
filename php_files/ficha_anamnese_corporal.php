<?php
include("conexao_db.php");
$cpf_sql =  $_POST["cpf_corporal"];

$sql = "SELECT * FROM ficha_anamnese_corporal WHERE cliente = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $cpf_sql);
$stmt->execute();
$resultado = $stmt->get_result();
$linha = $resultado->fetch_assoc();
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
    <title>Anamnese Corporal</title>
</head>

<body>
    <header>
        <h1>Aline Calesco Estética</h1>
    </header>
    <main>
        <h2>Ficha de Anamnese Corporal / <a href="anamnese_corporal_pesquisa.php">VOLTAR</a></h2>
        <section class="cliente_ficha">
            <h3>CLIENTE SELECIONADO</h3>
            <input type="text" name="exibir_nome_cliente" value="<?= $_POST["nome_corporal"]; ?>" disabled>
            <input type="text" name="exibir_nome_cliente" value="<?= $_POST["cpf_corporal"]; ?>" disabled>
        </section>
        <section class="ficha_dados">
            <form method="post" action="opr_ficha_anamnese_corporal.php" class="ficha-form" onsubmit="return msgSucesso()">
                <input type="hidden" name="cpf_ficha_corporal" value="<?= $_POST["cpf_corporal"]; ?>">
                <table class="ficha-table">
                    <tbody>
                        <tr>
                            <td colspan="2" style="text-align: center; padding-bottom: .5rem">
                                <h4>HÁBITOS DIÁRIOS</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Utiliza cosméticos?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="usa_cosmetico" value="sim" required <?= isset($linha['usa_cosmetico']) && $linha['usa_cosmetico'] === 'sim' ? 'checked' : '' ?>> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="usa_cosmetico" value="nao" required <?= isset($linha['usa_cosmetico']) && $linha['usa_cosmetico'] === 'nao' ? 'checked' : '' ?>> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="qual_cosmeticos">Quais cosméticos?</label></td>
                            <td><input type="text" id="qual_cosmeticos" name="qual_cosmeticos" value="<?= isset($linha['qual_cosmetico']) ? $linha['qual_cosmetico'] : ''; ?>" maxlength="200"></td>
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
                            <td>
                                <p>Faz ingestão de alcool?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="ingere_alcool" value="sim" required <?= isset($linha['ingere_alcool']) && $linha['ingere_alcool'] === 'sim' ? 'checked' : '' ?>> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="ingere_alcool" value="nao" required <?= isset($linha['ingere_alcool']) && $linha['ingere_alcool'] === 'nao' ? 'checked' : '' ?>> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="qtde_agua">Quantos copos de água por dia?</label></td>
                            <td><input type="text" id="qtde_agua" name="qtde_agua" maxlength="200" value="<?= isset($linha['qtde_copos_agua']) ? $linha['qtde_copos_agua'] : ''; ?>" required></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Qualidade do sono?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="qualidade_sono" value="bom" required <?= isset($linha['qualidade_sono']) && $linha['qualidade_sono'] === 'bom' ? 'checked' : '' ?>> Bom
                                    </label>
                                    <label>
                                        <input type="radio" name="qualidade_sono" value="ruim" required <?= isset($linha['qualidade_sono']) && $linha['qualidade_sono'] === 'ruim' ? 'checked' : '' ?>> Ruim
                                    </label>
                                    <label>
                                        <input type="radio" name="qualidade_sono" value="pessimo" required <?= isset($linha['qualidade_sono']) && $linha['qualidade_sono'] === 'pessimo' ? 'checked' : '' ?>> Péssimo
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Qualidade da alimentação?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="qualidade_alimentacao" value="bom" required <?= isset($linha['qualidade_alimentacao']) && $linha['qualidade_alimentacao'] === 'bom' ? 'checked' : '' ?>> Bom
                                    </label>
                                    <label>
                                        <input type="radio" name="qualidade_alimentacao" value="ruim" required <?= isset($linha['qualidade_alimentacao']) && $linha['qualidade_alimentacao'] === 'ruim' ? 'checked' : '' ?>> Ruim
                                    </label>
                                    <label>
                                        <input type="radio" name="qualidade_alimentacao" value="pessimo" required <?= isset($linha['qualidade_alimentacao']) && $linha['qualidade_alimentacao'] === 'pessimo' ? 'checked' : '' ?>> Péssimo
                                    </label>
                                </div>
                            </td>
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
                            <td>
                                <p>Toma medicamento?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="toma_medicamento" value="sim" required <?= isset($linha['toma_medicacao']) && $linha['toma_medicacao'] === 'sim' ? 'checked' : '' ?>> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="toma_medicamento" value="nao" required <?= isset($linha['toma_medicacao']) && $linha['toma_medicacao'] === 'nao' ? 'checked' : '' ?>> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="qual_medicamento">Quais medicamentos?</label></td>
                            <td><input type="text" id="qual_medicamento" name="qual_medicamento" maxlength="200" value="<?= isset($linha['qual_medicacao']) ? $linha['qual_medicacao'] : ''; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="tempo_medicacao">Há quanto tempo toma medicamentos?</label></td>
                            <td><input type="text" id="tempo_medicacao" name="tempo_medicacao" maxlength="200" value="<?= isset($linha['quanto_tempo_medicacao']) ? $linha['quanto_tempo_medicacao'] : ''; ?>"></td>
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
                            <td><input type="text" id="quais_suplementos" name="quais_suplementos" maxlength="200" value="<?= isset($linha['qual_suplemento_oral']) ? $linha['qual_suplemento_oral'] : ''; ?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Possui trombose?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="trombose" value="sim" required <?= isset($linha['trombose']) && $linha['trombose'] === 'sim' ? 'checked' : '' ?>> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="trombose" value="nao" required <?= isset($linha['trombose']) && $linha['trombose'] === 'nao' ? 'checked' : '' ?>> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="qual_trombose">Qual tipo de trombose?</label></td>
                            <td><input type="text" id="qual_trombose" name="qual_trombose" maxlength="200" value="<?= isset($linha['qual_trombose']) ? $linha['qual_trombose'] : ''; ?>"></td>
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
                            <td>
                                <p>Possui diabetes?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="diabetes" value="sim" required <?= isset($linha['diabetes']) && $linha['diabetes'] === 'sim' ? 'checked' : '' ?>> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="diabetes" value="nao" required <?= isset($linha['diabetes']) && $linha['diabetes'] === 'nao' ? 'checked' : '' ?>> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="qual_diabetes">Qual tipo de diabetes?</label></td>
                            <td><input type="text" id="qual_diabetes" name="qual_diabetes" maxlength="200" value="<?= isset($linha['qual_diabetes']) ? $linha['qual_diabetes'] : ''; ?>"></td>
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
                            <td><input type="text" id="qual_cirurgia" name="qual_cirurgia" maxlength="200" value="<?= isset($linha['qual_cirurgia_plastica']) ? $linha['qual_cirurgia_plastica'] : ''; ?>"></td>
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
                            <td><input type="text" id="qual_parte_corpo" name="qual_parte_corpo" maxlength="200" value="<?= isset($linha['qual_doenca_acomete_corpo']) ? $linha['qual_doenca_acomete_corpo'] : ''; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="tempo_disfuncao">Há quanto começou essa disfunção?</label></td>
                            <td><input type="text" id="tempo_disfuncao" name="tempo_disfuncao" maxlength="200" value="<?= isset($linha['tempo_disfuncao']) ? $linha['tempo_disfuncao'] : ''; ?>"></td>
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