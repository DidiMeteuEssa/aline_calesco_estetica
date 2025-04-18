<?php
include("conexao_db.php");
$cpf_sql_facial =  $_POST["cpf_facial"];

$sql_facial = "SELECT * FROM ficha_anamnese_facial WHERE cliente = ?";
$stmt_facial = $conn->prepare($sql_facial);
$stmt_facial->bind_param("s", $cpf_sql_facial);
$stmt_facial->execute();
$resultado_facial = $stmt_facial->get_result();
$linha_facial = $resultado_facial->fetch_assoc();

if (isset($linha_facial['habitos_vida'])) {
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
                                    <label>
                                        <input type="radio" name="classificacao_alimentacao_facial" value="regular" <?= isset($linha_facial['classificacao_alimentacao']) && $linha_facial['classificacao_alimentacao'] === 'regular' ? 'checked' : '' ?> required> Regular
                                    </label>
                                </div>
                                <div class="grupo_radio">
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
                            <td><input type="text" id="medicamento_qual_freq_facial" name="medicamento_qual_freq_facial" maxlength="50" value="<?= isset($linha_facial['medicamento_qual_freq']) ? $linha_facial['medicamento_qual_freq'] : ''; ?>"></td>
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
                            <td><input type="text" id="cosmeticos_qual_freq_facial" name="cosmeticos_qual_freq_facial" maxlength="50" value="<?= isset($linha_facial['cosmeticos_qual_freq']) ? $linha_facial['cosmeticos_qual_freq'] : ''; ?>"></td>
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
                            <td><input type="text" id="botox_local_tempo_facial" name="botox_local_tempo_facial" maxlength="50" value="<?= isset($linha_facial['botox_local_tempo']) ? $linha_facial['botox_local_tempo'] : ''; ?>"></td>
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
                            <td><input type="text" id="protetor_solar_qual_freq_facial" name="protetor_solar_qual_freq_facial" maxlength="40" value="<?= isset($linha_facial['protetor_solar_qual_freq']) ? $linha_facial['protetor_solar_qual_freq'] : ''; ?>"></td>
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
                            <td><input type="text" id="quais_alergias_facial" name="quais_alergias_facial" maxlength="40" value="<?= isset($linha_facial['quais_alergias']) ? $linha_facial['quais_alergias'] : ''; ?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Exposição ao Sol?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="exposicao_sol_facial" value="sim" <?= isset($linha_facial['exposicao_sol']) && $linha_facial['exposicao_sol'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="exposicao_sol_facial" value="nao" <?= isset($linha_facial['exposicao_sol']) && $linha_facial['exposicao_sol'] === 'nao' ? 'checked' : '' ?> required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Disturbio hormonal?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="disturbio_hormonal_facial" value="sim" <?= isset($linha_facial['disturbio_hormonal']) && $linha_facial['disturbio_hormonal'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="disturbio_hormonal_facial" value="nao" <?= isset($linha_facial['disturbio_hormonal']) && $linha_facial['disturbio_hormonal'] === 'nao' ? 'checked' : '' ?> required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="qual_disturbio_facial">Quais alergias?</label>
                            <td><input type="text" id="qual_disturbio_facial" name="qual_disturbio_facial" maxlength="40" value="<?= isset($linha_facial['qual_disturbio']) ? $linha_facial['qual_disturbio'] : ''; ?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Problemas cardíacos?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="problemas_cardiacos_facial" value="sim" <?= isset($linha_facial['problemas_cardiacos']) && $linha_facial['problemas_cardiacos'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="problemas_cardiacos_facial" value="nao" <?= isset($linha_facial['problemas_cardiacos']) && $linha_facial['problemas_cardiacos'] === 'nao' ? 'checked' : '' ?> required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="quais_cardiacos_facial">Quais problemas cardiacos?</label>
                            <td><input type="text" id="quais_cardiacos_facial" name="quais_cardiacos_facial" maxlength="40" value="<?= isset($linha_facial['quais_cardiaco']) ? $linha_facial['quais_cardiaco'] : ''; ?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Portador de marcapasso?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="marcapasso_facial" value="sim" <?= isset($linha_facial['marcapasso']) && $linha_facial['marcapasso'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="marcapasso_facial" value="nao" <?= isset($linha_facial['marcapasso']) && $linha_facial['marcapasso'] === 'nao' ? 'checked' : '' ?> required> Nao
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
                                        <input type="radio" name="diabetes_facial" value="sim" <?= isset($linha_facial['diabetes']) && $linha_facial['diabetes'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="diabetes_facial" value="nao" <?= isset($linha_facial['diabetes']) && $linha_facial['diabetes'] === 'nao' ? 'checked' : '' ?> required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Mentruação: </p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="menstruacao_facial" value="regular" <?= isset($linha_facial['menstruacao']) && $linha_facial['menstruacao'] === 'regular' ? 'checked' : '' ?> required> Regular
                                    </label>
                                    <label>
                                        <input type="radio" name="menstruacao_facial" value="irregular" <?= isset($linha_facial['menstruacao']) && $linha_facial['menstruacao'] === 'irregular' ? 'checked' : '' ?> required> Irregular
                                    </label>
                                </div>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="menstruacao_facial" value="menopausa" <?= isset($linha_facial['menstruacao']) && $linha_facial['menstruacao'] === 'menopausa' ? 'checked' : '' ?> required> Menopausa
                                    </label>
                                    <label>
                                        <input type="radio" name="menstruacao_facial" value="histerectomia" <?= isset($linha_facial['menstruacao']) && $linha_facial['menstruacao'] === 'histerectomia' ? 'checked' : '' ?> required> Histerectomia
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Fototipo: </p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="fototipo_facial" value="i" <?= isset($linha_facial['fototipo']) && $linha_facial['fototipo'] === 'i' ? 'checked' : '' ?> required> I
                                    </label>
                                    <label>
                                        <input type="radio" name="fototipo_facial" value="ii" <?= isset($linha_facial['fototipo']) && $linha_facial['fototipo'] === 'ii' ? 'checked' : '' ?> required> II
                                    </label>
                                    <label>
                                        <input type="radio" name="fototipo_facial" value="iii" <?= isset($linha_facial['fototipo']) && $linha_facial['fototipo'] === 'iii' ? 'checked' : '' ?> required> III
                                    </label>
                                    <label>
                                        <input type="radio" name="fototipo_facial" value="iv" <?= isset($linha_facial['fototipo']) && $linha_facial['fototipo'] === 'iv' ? 'checked' : '' ?> required> IV
                                    </label>
                                    <label>
                                        <input type="radio" name="fototipo_facial" value="v" <?= isset($linha_facial['fototipo']) && $linha_facial['fototipo'] === 'v' ? 'checked' : '' ?> required> V
                                    </label>
                                    <label>
                                        <input type="radio" name="fototipo_facial" value="vi" <?= isset($linha_facial['fototipo']) && $linha_facial['fototipo'] === 'vi' ? 'checked' : '' ?> required> VI
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Fototipo (Fitzpatrick): </p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="classif_fototipo_facial" value="i" <?= isset($linha_facial['classif_fototipo']) && $linha_facial['classif_fototipo'] === 'i' ? 'checked' : '' ?> required> Tipo I - Muito sensível – queima facilmente <br>e nunca pigmenta
                                    </label>
                                </div>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="classif_fototipo_facial" value="ii" <?= isset($linha_facial['classif_fototipo']) && $linha_facial['classif_fototipo'] === 'ii' ? 'checked' : '' ?> required> Tipo II - Sensível – queima moderadamente <br>e pigmenta levemente
                                    </label>
                                </div>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="classif_fototipo_facial" value="iii" <?= isset($linha_facial['classif_fototipo']) && $linha_facial['classif_fototipo'] === 'iii' ? 'checked' : '' ?> required> Tipo III - Moderadamente sensível – <br>queima levemente e pigmenta facilmente
                                    </label>
                                </div>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="classif_fototipo_facial" value="iv" <?= isset($linha_facial['classif_fototipo']) && $linha_facial['classif_fototipo'] === 'iv' ? 'checked' : '' ?> required> Tipo IV - Muito pouco sensível – as vezes <br>queima e está sempre pigmentada
                                    </label>
                                </div>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="classif_fototipo_facial" value="v" <?= isset($linha_facial['classif_fototipo']) && $linha_facial['classif_fototipo'] === 'v' ? 'checked' : '' ?> required> Tipo V - Nunca queima e pigmenta mais <br>que a média
                                    </label>
                                </div>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="classif_fototipo_facial" value="vi" <?= isset($linha_facial['classif_fototipo']) && $linha_facial['classif_fototipo'] === 'vi' ? 'checked' : '' ?> required> Tipo VI - Pele negra – Sempre pigmenta <br>e nunca queima
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Tipo de pele: </p>
                            </td>
                            <td>
                                <div class="grupo_radio" style="margin-top: 1rem;">
                                    <label>
                                        <input type="radio" name="tipo_pele_facial" value="normal" <?= isset($linha_facial['tipo_pele']) && $linha_facial['tipo_pele'] === 'normal' ? 'checked' : '' ?> required> Normal
                                    </label>
                                    <label>
                                        <input type="radio" name="tipo_pele_facial" value="mista" <?= isset($linha_facial['tipo_pele']) && $linha_facial['tipo_pele'] === 'mista' ? 'checked' : '' ?> required> Mista
                                    </label>
                                    <label>
                                        <input type="radio" name="tipo_pele_facial" value="seca" <?= isset($linha_facial['tipo_pele']) && $linha_facial['tipo_pele'] === 'seca' ? 'checked' : '' ?> required> Seca
                                    </label>
                                    <label>
                                        <input type="radio" name="tipo_pele_facial" value="oleosa" <?= isset($linha_facial['tipo_pele']) && $linha_facial['tipo_pele'] === 'oleosa' ? 'checked' : '' ?> required> Oleosa
                                    </label>
                                </div>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="tipo_pele_facial" value="sensivel" <?= isset($linha_facial['tipo_pele']) && $linha_facial['tipo_pele'] === 'sensivel' ? 'checked' : '' ?> required> Sensível
                                    </label>
                                    <label>
                                        <input type="radio" name="tipo_pele_facial" value="acneia" <?= isset($linha_facial['tipo_pele']) && $linha_facial['tipo_pele'] === 'acneia' ? 'checked' : '' ?> required> Acneia
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Grau de hidratação: </p>
                            </td>
                            <td>
                                <div class="grupo_radio" style="margin-top: 1rem;">
                                    <label>
                                        <input type="radio" name="grau_hidratacao_facial" value="normal" <?= isset($linha_facial['grau_hidratacao']) && $linha_facial['grau_hidratacao'] === 'normal' ? 'checked' : '' ?> required> Normal
                                    </label>
                                    <label>
                                        <input type="radio" name="grau_hidratacao_facial" value="desidratada_superficial" <?= isset($linha_facial['grau_hidratacao']) && $linha_facial['grau_hidratacao'] === 'desidratada_superficial' ? 'checked' : '' ?> required> Desidratada Superficial
                                    </label>
                                </div>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="grau_hidratacao_facial" value="desidratada_profunda" <?= isset($linha_facial['grau_hidratacao']) && $linha_facial['grau_hidratacao'] === 'desidratada_profunda' ? 'checked' : '' ?> required> Desidratada Profunda
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Textura da pele: </p>
                            </td>
                            <td>
                                <div class="grupo_radio" style="margin-top: 1rem;">
                                    <label>
                                        <input type="radio" name="textura_pele_facial" value="normal" <?= isset($linha_facial['textura_pele']) && $linha_facial['textura_pele'] === 'normal' ? 'checked' : '' ?> required> Normal
                                    </label>
                                    <label>
                                        <input type="radio" name="textura_pele_facial" value="lisa" <?= isset($linha_facial['textura_pele']) && $linha_facial['textura_pele'] === 'lisa' ? 'checked' : '' ?> required> Lisa
                                    </label>
                                    <label>
                                        <input type="radio" name="textura_pele_facial" value="aspera" <?= isset($linha_facial['textura_pele']) && $linha_facial['textura_pele'] === 'aspera' ? 'checked' : '' ?> required> Áspera
                                    </label>
                                    <label>
                                        <input type="radio" name="textura_pele_facial" value="fina" <?= isset($linha_facial['textura_pele']) && $linha_facial['textura_pele'] === 'fina' ? 'checked' : '' ?> required> Fina
                                    </label>
                                </div>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="textura_pele_facial" value="grossa" <?= isset($linha_facial['textura_pele']) && $linha_facial['textura_pele'] === 'grossa' ? 'checked' : '' ?> required> Grossa
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Acne: </p>
                            </td>
                            <td>
                                <div class="grupo_radio" style="margin-top: 1rem;">
                                    <label>
                                        <input type="radio" name="acne_facial" value="ausente" <?= isset($linha_facial['acne']) && $linha_facial['acne'] === 'ausente' ? 'checked' : '' ?> required> Ausente
                                    </label>
                                </div>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="acne_facial" value="i" <?= isset($linha_facial['acne']) && $linha_facial['acne'] === 'i' ? 'checked' : '' ?> required> Grau I - Comedões
                                    </label>
                                </div>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="acne_facial" value="ii" <?= isset($linha_facial['acne']) && $linha_facial['acne'] === 'ii' ? 'checked' : '' ?> required> Grau II - Comedões Comedões abertos, <br>pápulas, seborréia, com ou sem inflamação <br>de pústulas
                                    </label>
                                </div>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="acne_facial" value="iii" <?= isset($linha_facial['acne']) && $linha_facial['acne'] === 'iii' ? 'checked' : '' ?> required> Grau III - Comedões abertos, pápulas, pústulas, <br>seborréia e cistos
                                    </label>
                                </div>
                                </div>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="acne_facial" value="iv" <?= isset($linha_facial['acne']) && $linha_facial['acne'] === 'iv' ? 'checked' : '' ?> required> Grau IV - Todas as complicações acima com a <br>presença de grandes nódulos purulentos
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
</body>

</html>