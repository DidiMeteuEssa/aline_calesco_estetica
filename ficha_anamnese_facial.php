<?php
include("conexao_db.php");
$cpf_sql_facial =  $_POST["cpf_facial"];

$sql_facial = "SELECT * FROM ficha_anamnese_facial WHERE cliente = ?";
$stmt_facial = $conn->prepare($sql_facial);
$stmt_facial->bind_param("s", $cpf_sql_facial);
$stmt_facial->execute();
$resultado_facial = $stmt_facial->get_result();
$linha_facial = $resultado_facial->fetch_assoc();

if(isset($linha_facial['habitos_vida'])) {
    $habitos_vida_marcados = explode(",", $linha_facial['habitos_vida']);
}

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
    <title>Anamnese Facial</title>
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
                            <td><textarea name="queixa_facial" id="queixa_facial" maxlength="400"><?= isset($linha_facial['queixa_principal']) ? $linha_facial['queixa_principal'] : ''; ?></textarea></td>
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
                                        <input type="radio" name="tratamento_estetico_facial" value="sim" <?= isset($linha_facial['fez_tratamento']) && $linha_facial['fez_tratamento'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="tratamento_estetico_facial" value="nao" <?= isset($linha_facial['fez_tratamento']) && $linha_facial['fez_tratamento'] === 'nao' ? 'checked' : '' ?> required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="qual_tratamento_facial">Quais tratanentos?</label></td>
                            <td><input type="text" id="qual_tratamento_facial" name="qual_tratamento_facial" maxlength="50" value="<?= isset($linha_facial['qual_tratamento']) ? $linha_facial['qual_tratamento'] : ''; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="obteve_melhora_facial">Obteve alguma melhora?</label></td>
                            <td><input type="text" id="obteve_melhora_facial" name="obteve_melhora_facial" maxlength="50" value="<?= isset($linha_facial['obteve_melhora']) ? $linha_facial['obteve_melhora'] : ''; ?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Usa lentes de contato?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="usa_lente_facial" value="sim" <?= isset($linha_facial['usa_lente']) && $linha_facial['usa_lente'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="usa_lente_facial" value="nao" <?= isset($linha_facial['usa_lente']) && $linha_facial['usa_lente'] === 'nao' ? 'checked' : '' ?> required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Está gestante?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="gestante_facial" value="sim" <?= isset($linha_facial['gestante']) && $linha_facial['gestante'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="gestante_facial" value="nao" <?= isset($linha_facial['gestante']) && $linha_facial['gestante'] === 'nao' ? 'checked' : '' ?> required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Usa contraceptivos?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="contraceptivos_facial" value="sim" <?= isset($linha_facial['contraceptivos']) && $linha_facial['contraceptivos'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="contraceptivos_facial" value="nao" <?= isset($linha_facial['contraceptivos']) && $linha_facial['contraceptivos'] === 'nao' ? 'checked' : '' ?> required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="qual_contraceptivo_facial">Quais contraceptivos?</label></td>
                            <td><input type="text" id="qual_contraceptivo_facial" name="qual_contraceptivo_facial" maxlength="30" value="<?= isset($linha_facial['obteve_melhora']) ? $linha_facial['obteve_melhora'] : ''; ?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Faz uma boa ingestão de água?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="ingestao_agua_facial" value="sim" <?= isset($linha_facial['ingestao_agua']) && $linha_facial['ingestao_agua'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="ingestao_agua_facial" value="nao" <?= isset($linha_facial['ingestao_agua']) && $linha_facial['ingestao_agua'] === 'nao' ? 'checked' : '' ?> required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="litros_agua_facial">Quantos litros por dia?</label></td>
                            <td><input type="text" id="litros_agua_facial" name="litros_agua_facial" maxlength="30" value="<?= isset($linha_facial['litros_agua']) ? $linha_facial['litros_agua'] : ''; ?>" required></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Como classifica sua alimentação?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="classificacao_alimentacao_facial" value="otima" <?= isset($linha_facial['classificacao_alimentacao']) && $linha_facial['classificacao_alimentacao'] === 'otima' ? 'checked' : '' ?> required> Ótima
                                    </label>
                                    <label>
                                        <input type="radio" name="classificacao_alimentacao_facial" value="boa" <?= isset($linha_facial['classificacao_alimentacao']) && $linha_facial['classificacao_alimentacao'] === 'boa' ? 'checked' : '' ?> required> Boa
                                    </label>
                                </div>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="classificacao_alimentacao_facial" value="regular" <?= isset($linha_facial['classificacao_alimentacao']) && $linha_facial['classificacao_alimentacao'] === 'regular' ? 'checked' : '' ?> required> Regular
                                    </label>
                                    <label>
                                        <input type="radio" name="classificacao_alimentacao_facial" value="ruim" <?= isset($linha_facial['classificacao_alimentacao']) && $linha_facial['classificacao_alimentacao'] === 'ruim' ? 'checked' : '' ?> required> Ruim
                                    </label>
                                    <label>
                                        <input type="radio" name="classificacao_alimentacao_facial" value="pessima" <?= isset($linha_facial['classificacao_alimentacao']) && $linha_facial['classificacao_alimentacao'] === 'pessima' ? 'checked' : '' ?> required> Péssima
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="predominio_alimentar_facial">Predomínio alimentar:</label></td>
                            <td><input type="text" id="predominio_alimentar_facial" name="predominio_alimentar_facial" maxlength="30" value="<?= isset($linha_facial['predominio_alimentar']) ? $linha_facial['predominio_alimentar'] : ''; ?>" required></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Possui hipertensão arterial?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="hipertensao_facial" value="sim" <?= isset($linha_facial['hipertensao']) && $linha_facial['hipertensao'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="hipertensao_facial" value="nao" <?= isset($linha_facial['hipertensao']) && $linha_facial['hipertensao'] === 'nao' ? 'checked' : '' ?> required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Intestino normal?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="intestino_normal_facial" value="sim" <?= isset($linha_facial['intestino_normal']) && $linha_facial['intestino_normal'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="intestino_normal_facial" value="nao" <?= isset($linha_facial['intestino_normal']) && $linha_facial['intestino_normal'] === 'nao' ? 'checked' : '' ?> required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Possui insônia?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="insonia_facial" value="sim" <?= isset($linha_facial['insonia']) && $linha_facial['insonia'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="insonia_facial" value="nao" <?= isset($linha_facial['insonia']) && $linha_facial['insonia'] === 'nao' ? 'checked' : '' ?> required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Possui ansiedade?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="ansiedade_facial" value="sim" <?= isset($linha_facial['ansiedade']) && $linha_facial['ansiedade'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="ansiedade_facial" value="nao" <?= isset($linha_facial['ansiedade']) && $linha_facial['ansiedade'] === 'nao' ? 'checked' : '' ?> required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Sensivel a dor?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="sensivel_dor_facial" value="sim" <?= isset($linha_facial['sensivel_dor']) && $linha_facial['sensivel_dor'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="sensivel_dor_facial" value="nao" <?= isset($linha_facial['sensivel_dor']) && $linha_facial['sensivel_dor'] === 'nao' ? 'checked' : '' ?> required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Possui câncer de pele?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="cancer_pele_facial" value="sim" <?= isset($linha_facial['cancer_pele']) && $linha_facial['cancer_pele'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="cancer_pele_facial" value="nao" <?= isset($linha_facial['cancer_pele']) && $linha_facial['cancer_pele'] === 'nao' ? 'checked' : '' ?> required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Hábitos de vida:</p>
                                <p style="font-size: .7rem;">(Selecione mais de um)</p>
                            </td>
                            <td>
                                <div class="grupo_checkbox">
                                    <label>
                                        <input type="checkbox" name="habitos_vida_facial[]" value="tabagismo" <?= isset($linha_facial['habitos_vida']) && in_array("tabagismo", $suplementos_marcados) ? 'checked' : '' ?>> Tabagismo
                                    </label>
                                    <label>
                                        <input type="checkbox" name="habitos_vida_facial[]" value="bebida_alcoolica" <?= isset($linha_facial['habitos_vida']) && in_array("bebida_alcoolica", $suplementos_marcados) ? 'checked' : '' ?>> Bebida Alcóolica
                                    </label>
                                </div>
                                <div class="grupo_checkbox">
                                    <label>
                                        <input type="checkbox" name="habitos_vida_facial[]" value="atividades_fisicas" <?= isset($linha_facial['habitos_vida']) && in_array("atividades_fisicas", $suplementos_marcados) ? 'checked' : '' ?>> Atividades Físicas
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Usa medicamentos?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="medicamentos_facial" value="sim" <?= isset($linha_facial['medicamentos']) && $linha_facial['medicamentos'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="medicamentos_facial" value="nao" <?= isset($linha_facial['medicamentos']) && $linha_facial['medicamentos'] === 'nao' ? 'checked' : '' ?> required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="medicamento_qual_freq_facial">Quais medicamentos, <p>qual frequência?</p></label>
                            <td><input type="text" id="medicamento_qual_freq_facial" name="medicamento_qual_freq_facial" maxlength="30" value="<?= isset($linha_facial['medicamento_qual_freq']) ? $linha_facial['medicamento_qual_freq'] : ''; ?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Usa cosméticos?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="cosmeticos_facial" value="sim" <?= isset($linha_facial['cosmeticos']) && $linha_facial['cosmeticos'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="cosmeticos_facial" value="nao" <?= isset($linha_facial['cosmeticos']) && $linha_facial['cosmeticos'] === 'nao' ? 'checked' : '' ?> required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="cosmeticos_qual_freq_facial">Quais cosmeticos, <p>qual frequência?</p></label>
                            <td><input type="text" id="cosmeticos_qual_freq_facial" name="cosmeticos_qual_freq_facial" maxlength="30" value="<?= isset($linha_facial['cosmeticos_qual_freq']) ? $linha_facial['cosmeticos_qual_freq'] : ''; ?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Usa botox?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="botox_facial" value="sim" <?= isset($linha_facial['botox']) && $linha_facial['botox'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="botox_facial" value="nao" <?= isset($linha_facial['botox']) && $linha_facial['botox'] === 'nao' ? 'checked' : '' ?> required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="botox_local_tempo_facial">Qual local, <p>ha quanto tempo?</p></label>
                            <td><input type="text" id="botox_local_tempo_facial" name="botox_local_tempo_facial" maxlength="30" value="<?= isset($linha_facial['botox_local_tempo']) ? $linha_facial['botox_local_tempo'] : ''; ?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Tireoide?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="tireoide_facial" value="sim" <?= isset($linha_facial['tireoide']) && $linha_facial['tireoide'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="tireoide_facial" value="nao" <?= isset($linha_facial['tireoide']) && $linha_facial['tireoide'] === 'nao' ? 'checked' : '' ?> required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Trombose?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="trombose_facial" value="sim" <?= isset($linha_facial['trombose']) && $linha_facial['trombose'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="trombose_facial" value="nao" <?= isset($linha_facial['trombose']) && $linha_facial['trombose'] === 'nao' ? 'checked' : '' ?> required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Usa protetor solar?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="medicamentos_facial" value="sim" <?= isset($linha_facial['medicamentos']) && $linha_facial['medicamentos'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="medicamentos_facial" value="nao" <?= isset($linha_facial['medicamentos']) && $linha_facial['medicamentos'] === 'nao' ? 'checked' : '' ?> required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="protetor_solar_qual_freq_facial">Qual protetor, <p>qual frequência?</p></label>
                            <td><input type="text" id="protetor_solar_qual_freq_facial" name="protetor_solar_qual_freq_facial" maxlength="30" value="<?= isset($linha_facial['protetor_solar_qual_freq']) ? $linha_facial['protetor_solar_qual_freq'] : ''; ?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Possui alergias?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="alergias_facial" value="sim" <?= isset($linha_facial['alergias']) && $linha_facial['alergias'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="alergias_facial" value="nao" <?= isset($linha_facial['alergias']) && $linha_facial['alergias'] === 'nao' ? 'checked' : '' ?> required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="quais_alergias_facial">Quais alergias?</label>
                            <td><input type="text" id="quais_alergias_facial" name="quais_alergias_facial" maxlength="30" value="<?= isset($linha_facial['quais_alergias']) ? $linha_facial['quais_alergias'] : ''; ?>"></td>
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