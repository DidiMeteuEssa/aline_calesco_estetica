<?php
include("conexao_db.php");
$cpf_sql_facial =  $_POST["cpf_facial"];

$sql_facial = "SELECT ficha_anamnese_facial.*, campos_comuns.*
FROM ficha_anamnese_facial
LEFT JOIN campos_comuns ON ficha_anamnese_facial.cliente = campos_comuns.cliente
WHERE ficha_anamnese_facial.cliente = ?

UNION ALL

SELECT ficha_anamnese_facial.*, campos_comuns.*
FROM campos_comuns
LEFT JOIN ficha_anamnese_facial ON campos_comuns.cliente = ficha_anamnese_facial.cliente
WHERE campos_comuns.cliente = ?;
";
$stmt_facial = $conn->prepare($sql_facial);
$stmt_facial->bind_param("ss", $cpf_sql_facial, $cpf_sql_facial);
$stmt_facial->execute();
$resultado_facial = $stmt_facial->get_result();
$linha_facial = $resultado_facial->fetch_assoc();

if (isset($linha_facial['habitos_vida'])) {
    $habitos_vida_marcados = explode(",", $linha_facial['habitos_vida']);
}

if (isset($linha_facial['evolucao_cutanea'])) {
    $evolucao_cutanea_marcados = explode(",", $linha_facial['evolucao_cutanea']);
}

if (isset($linha_facial['alteracoes_epiderme'])) {
    $alteracoes_epiderme_marcados = explode(",", $linha_facial['alteracoes_epiderme']);
}

if (isset($linha_facial['lesao_pele'])) {
    $lesao_pele_marcados = explode(",", $linha_facial['lesao_pele']);
}

if (isset($linha_facial['cicatriz'])) {
    $cicatriz_marcados = explode(",", $linha_facial['cicatriz']);
}

if (isset($linha_facial['pelos'])) {
    $pelos_marcados = explode(",", $linha_facial['pelos']);
}

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
    <title>Anamnese Facial</title>
</head>

<body>
    <header>
        <h1>Aline Calesco Estética Funcional Integrativa</h1>
    </header>
    <main>
        <h2>Ficha de Anamnese Facial / <a href="anamnese_facial_pesquisa.php">VOLTAR</a></h2>
        <section class="cliente_ficha">
            <h3>CLIENTE SELECIONADO</h3>
            <input type="text" name="exibir_nome_cliente" value="<?= $_POST["nome_facial"]; ?>" disabled>
            <input type="text" name="exibir_nome_cliente" value="<?= $_POST["cpf_facial"]; ?>" disabled>
        </section>
        <section class="ficha_dados">
        <form method="post" action="opr_fichas.php" class="ficha-form" onsubmit="return msgSucesso()">
                <input type="hidden" name="cpf_ficha_facial" value="<?= $_POST["cpf_facial"]; ?>">
                <input type="hidden" name="opr" value="2">
                <table class="ficha-table">

                    <tbody>
                        <tr>
                            <td colspan="2" style="text-align: center; padding-bottom: .5rem">
                                <h4>ANAMNESE</h4>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="queixa_facial">Queixa principal</label></td>
                            <td><textarea name="queixa_facial" maxlength="1000"><?= isset($linha_facial['queixa_principal']) ? $linha_facial['queixa_principal'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center; padding-bottom: .5rem">
                                <h4>HÁBITOS DIÁRIOS</h4>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="tratamento_realizou">Descreva todos os tratamentos <br>prévios que já realizou (em <br>detalhes do que foi feito e de <br>como foi o pós, em casa e <br> a recuperação): </label></td>
                            <td><textarea name="tratamento_realizou" maxlength="1000"><?= isset($linha_facial['tratamento_realizou']) ? $linha_facial['tratamento_realizou'] : ''; ?></textarea></td>
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
                                        <input type="radio" name="contraceptivos_facial" value="sim" <?= isset($linha_facial['contraceptivo']) && $linha_facial['contraceptivo'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="contraceptivos_facial" value="nao" <?= isset($linha_facial['contraceptivo']) && $linha_facial['contraceptivo'] === 'nao' ? 'checked' : '' ?> required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="qual_contraceptivo_facial">Quais contraceptivos?</label></td>
                            <td><textarea name="qual_contraceptivo_facial" maxlength="500"><?= isset($linha_facial['qual_contraceptivo']) ? $linha_facial['qual_contraceptivo'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="litros_agua">Quantos litros de água consome por dia:</label></td>
                            <td><input type="text" name="litros_agua" maxlength="500" value="<?= isset($linha_facial['litros_agua']) ? $linha_facial['litros_agua'] : '' ?>" style="width: 40rem;"></td>
                        </tr>
                        <tr>
                            <td><label for="alimentacao_detalhada">Alimentação detalhada: </label></td>
                            <td><textarea name="alimentacao_detalhada" maxlength="1000"><?= isset($linha_facial['alimentacao_detalhada']) ? $linha_facial['alimentacao_detalhada'] : ''; ?></textarea></td>
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
                            <td><label for="intestino">Funcionamento intestinal:</label></td>
                            <td><textarea name="intestino" maxlength="500"><?= isset($linha_facial['intestino']) ? $linha_facial['intestino'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="qualidade_sono">Quantas horas de sono por dia?</label></td>
                            <td><input type="text" maxlength="500" name="qualidade_sono" value="<?= isset($linha_facial['qualidade_sono']) ? $linha_facial['qualidade_sono'] : '' ?>" style="width: 40rem;"></td>
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
                                        <input type="checkbox" name="habitos_vida_facial[]" value="tabagismo" <?= isset($linha_facial['habitos_vida']) && in_array("tabagismo", $habitos_vida_marcados) ? 'checked' : '' ?>> Tabagismo
                                    </label>
                                    <label>
                                        <input type="checkbox" name="habitos_vida_facial[]" value="bebida_alcoolica" <?= isset($linha_facial['habitos_vida']) && in_array("bebida_alcoolica", $habitos_vida_marcados) ? 'checked' : '' ?>> Bebida Alcóolica
                                    </label>
                                    <label>
                                        <input type="checkbox" name="habitos_vida_facial[]" value="atividades_fisicas" <?= isset($linha_facial['habitos_vida']) && in_array("atividades_fisicas", $habitos_vida_marcados) ? 'checked' : '' ?>> Atividades Físicas
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="medicacao">Usa alguma medicação frequente? <br>Há quanto tempo?</label></td>
                            <td><textarea name="medicacao" maxlength="500"><?= isset($linha_facial['medicacao']) ? $linha_facial['medicacao'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td><label>Descreva detalhadamente quais <br>são os cosmeticos que você <br>utiliza / já utilizou: </label></td>
                            <td><textarea name="uso_cosmetico" maxlength="1000"><?= isset($linha_facial['uso_cosmetico']) ? $linha_facial['uso_cosmetico'] : ''; ?></textarea></td>
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
                            <td><textarea name="botox_local_tempo_facial" maxlength="500"><?= isset($linha_facial['botox_local_tempo']) ? $linha_facial['botox_local_tempo'] : ''; ?></textarea></td>
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
                            <td><label for="trombose">Possui trombose? Qual?</label></td>
                            <td><textarea name="trombose" maxlength="500"><?= isset($linha_facial['trombose']) ? $linha_facial['trombose'] : ''; ?></textarea></td>
                        </tr>
                        </tr>
                        <tr>
                            <td>
                                <p>Usa protetor solar?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="protetor_solar_facial" value="sim" <?= isset($linha_facial['protetor_solar']) && $linha_facial['protetor_solar'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="protetor_solar_facial" value="nao" <?= isset($linha_facial['protetor_solar']) && $linha_facial['protetor_solar'] === 'nao' ? 'checked' : '' ?> required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="protetor_solar_qual_freq_facial">Qual protetor, <p>qual frequência?</p></label>
                            <td><textarea name="protetor_solar_qual_freq_facial" maxlength="500"><?= isset($linha_facial['protetor_solar_qual_freq']) ? $linha_facial['protetor_solar_qual_freq'] : ''; ?></textarea></td>
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
                            <td><textarea name="quais_alergias_facial" maxlength="500"><?= isset($linha_facial['quais_alergias']) ? $linha_facial['quais_alergias'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="nivel_exposicao_radiacao">Nível de exposição a <br> radiações durante o dia:</label></td>
                            <td><input type="text" maxlength="500" name="nivel_exposicao_radiacao" value="<?= isset($linha_facial['nivel_exposicao_radiacao'])  ? $linha_facial['nivel_exposicao_radiacao'] : '' ?>" style="width: 40rem;"></td>
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
                            <td><label for="qual_disturbio_facial">Quais disturbios?</label>
                            <td><textarea name="qual_disturbio_facial" maxlength="500"><?= isset($linha_facial['qual_disturbio']) ? $linha_facial['qual_disturbio'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="problemas_cardiacos">Problemas cardíacos: </label></td>
                            <td><textarea name="problemas_cardiacos" maxlength="500"><?= isset($linha_facial['problemas_cardiacos']) ? $linha_facial['problemas_cardiacos'] : ''; ?></textarea></td>
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
                            <td><label for="diabetes">Possui diabetes? Qual?</label></td>
                            <td><textarea name="diabetes" maxlength="500"><?= isset($linha_facial['diabetes']) ? $linha_facial['diabetes'] : ''; ?></textarea></td>
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
                            <td colspan="2" style="text-align: center; padding-bottom: .5rem">
                                <h4>EXAME FÍSICO-FUNCIONAL</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Fototipo: </p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="fototipo" value="i" <?= isset($linha_facial['fototipo']) && $linha_facial['fototipo'] === 'i' ? 'checked' : '' ?> required> I
                                    </label>
                                    <label>
                                        <input type="radio" name="fototipo" value="ii" <?= isset($linha_facial['fototipo']) && $linha_facial['fototipo'] === 'ii' ? 'checked' : '' ?> required> II
                                    </label>
                                    <label>
                                        <input type="radio" name="fototipo" value="iii" <?= isset($linha_facial['fototipo']) && $linha_facial['fototipo'] === 'iii' ? 'checked' : '' ?> required> III
                                    </label>
                                    <label>
                                        <input type="radio" name="fototipo" value="iv" <?= isset($linha_facial['fototipo']) && $linha_facial['fototipo'] === 'iv' ? 'checked' : '' ?> required> IV
                                    </label>
                                    <label>
                                        <input type="radio" name="fototipo" value="v" <?= isset($linha_facial['fototipo']) && $linha_facial['fototipo'] === 'v' ? 'checked' : '' ?> required> V
                                    </label>
                                    <label>
                                        <input type="radio" name="fototipo" value="vi" <?= isset($linha_facial['fototipo']) && $linha_facial['fototipo'] === 'vi' ? 'checked' : '' ?> required> VI
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
                                        <input type="radio" name="classif_fototipo_facial" value="i" <?= isset($linha_facial['classif_fototipo']) && $linha_facial['classif_fototipo'] === 'i' ? 'checked' : '' ?> required> Tipo I - Muito sensível – queima facilmente e nunca pigmenta
                                    </label>
                                </div>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="classif_fototipo_facial" value="ii" <?= isset($linha_facial['classif_fototipo']) && $linha_facial['classif_fototipo'] === 'ii' ? 'checked' : '' ?> required> Tipo II - Sensível – queima moderadamente e pigmenta levemente
                                    </label>
                                </div>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="classif_fototipo_facial" value="iii" <?= isset($linha_facial['classif_fototipo']) && $linha_facial['classif_fototipo'] === 'iii' ? 'checked' : '' ?> required> Tipo III - Moderadamente sensível – queima levemente e pigmenta facilmente
                                    </label>
                                </div>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="classif_fototipo_facial" value="iv" <?= isset($linha_facial['classif_fototipo']) && $linha_facial['classif_fototipo'] === 'iv' ? 'checked' : '' ?> required> Tipo IV - Muito pouco sensível – as vezes queima e está sempre pigmentada
                                    </label>
                                </div>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="classif_fototipo_facial" value="v" <?= isset($linha_facial['classif_fototipo']) && $linha_facial['classif_fototipo'] === 'v' ? 'checked' : '' ?> required> Tipo V - Nunca queima e pigmenta mais que a média
                                    </label>
                                </div>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="classif_fototipo_facial" value="vi" <?= isset($linha_facial['classif_fototipo']) && $linha_facial['classif_fototipo'] === 'vi' ? 'checked' : '' ?> required> Tipo VI - Pele negra – Sempre pigmenta e nunca queima
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Fototipo (Goglau): </p>
                            </td>
                            <td>
                                <div class="grupo_radio" style="margin-top: 1rem;">
                                    <label>
                                        <input type="radio" name="classif_goglau_facial" value="i" <?= isset($linha_facial['classif_goglau']) && $linha_facial['classif_goglau'] === 'i' ? 'checked' : '' ?> required> Tipo I - Sem rugas, efélides, textura ideal – 20 anos
                                    </label>
                                </div>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="classif_goglau_facial" value="ii" <?= isset($linha_facial['classif_goglau']) && $linha_facial['classif_goglau'] === 'ii' ? 'checked' : '' ?> required> Tipo II - Rugas ao movimento, pequenas alterações pigmentares – 30 anos
                                    </label>
                                </div>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="classif_goglau_facial" value="iii" <?= isset($linha_facial['classif_goglau']) && $linha_facial['classif_goglau'] === 'iii' ? 'checked' : '' ?> required> Tipo III - Rugas no repouso, melasma região zigomática, elastose solar – 40 anos
                                    </label>
                                </div>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="classif_goglau_facial" value="iv" <?= isset($linha_facial['classif_goglau']) && $linha_facial['classif_goglau'] === 'iv' ? 'checked' : '' ?> required> Tipo IV - Muitas rugas, telangiectasias, hiperpigmentação, hirsutismo e/ou <br>hipertricose, tumoração
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="goglau_estatica_facial">Tipo estática:</label>
                            <td><textarea name="goglau_estatica_facial" maxlength="500"><?= isset($linha_facial['goglau_estatica']) ? $linha_facial['goglau_estatica'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="goglau_dinamica_facial">Tipo dinâmica:</label>
                            <td><textarea name="goglau_dinamica_facial" maxlength="500"><?= isset($linha_facial['goglau_dinamica']) ? $linha_facial['goglau_dinamica'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Tipo de pele: </p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="tipo_pele" value="normal" <?= isset($linha_facial['tipo_pele']) && $linha_facial['tipo_pele'] === 'normal' ? 'checked' : '' ?> required> Normal
                                    </label>
                                    <label>
                                        <input type="radio" name="tipo_pele" value="mista" <?= isset($linha_facial['tipo_pele']) && $linha_facial['tipo_pele'] === 'mista' ? 'checked' : '' ?> required> Mista
                                    </label>
                                    <label>
                                        <input type="radio" name="tipo_pele" value="seca" <?= isset($linha_facial['tipo_pele']) && $linha_facial['tipo_pele'] === 'seca' ? 'checked' : '' ?> required> Seca
                                    </label>
                                    <label>
                                        <input type="radio" name="tipo_pele" value="oleosa" <?= isset($linha_facial['tipo_pele']) && $linha_facial['tipo_pele'] === 'oleosa' ? 'checked' : '' ?> required> Oleosa
                                    </label>
                                    <label>
                                        <input type="radio" name="tipo_pele" value="sensivel" <?= isset($linha_facial['tipo_pele']) && $linha_facial['tipo_pele'] === 'sensivel' ? 'checked' : '' ?> required> Sensível
                                    </label>
                                    <label>
                                        <input type="radio" name="tipo_pele" value="acneia" <?= isset($linha_facial['tipo_pele']) && $linha_facial['tipo_pele'] === 'acneia' ? 'checked' : '' ?> required> Acneia
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
                                    <label>
                                        <input type="radio" name="textura_pele_facial" value="grossa" <?= isset($linha_facial['textura_pele']) && $linha_facial['textura_pele'] === 'grossa' ? 'checked' : '' ?> required> Grossa
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Grau de oleosidade: </p>
                            </td>
                            <td>
                                <div class="grupo_radio" style="margin-top: 1rem;">
                                    <label>
                                        <input type="radio" name="grau_oleosidade_facial" value="equilibrado" <?= isset($linha_facial['grau_oleosidade']) && $linha_facial['grau_oleosidade'] === 'equilibrado' ? 'checked' : '' ?> required> Equilibrado
                                    </label>
                                    <label>
                                        <input type="radio" name="grau_oleosidade_facial" value="aumentado" <?= isset($linha_facial['grau_oleosidade']) && $linha_facial['grau_oleosidade'] === 'aumentado' ? 'checked' : '' ?> required> Aumentado
                                    </label>
                                    <label>
                                        <input type="radio" name="grau_oleosidade_facial" value="excessivo" <?= isset($linha_facial['grau_oleosidade']) && $linha_facial['grau_oleosidade'] === 'excessivo' ? 'checked' : '' ?> required> Excessivo
                                    </label>
                                    <label>
                                        <input type="radio" name="grau_oleosidade_facial" value="pontual" <?= isset($linha_facial['grau_oleosidade']) && $linha_facial['grau_oleosidade'] === 'pontual' ? 'checked' : '' ?> required> Pontual
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
                                        <input type="radio" name="acne_facial" value="ii" <?= isset($linha_facial['acne']) && $linha_facial['acne'] === 'ii' ? 'checked' : '' ?> required> Grau II - Comedões Comedões abertos, pápulas, seborréia, com ou sem <br> inflamação de pústulas
                                    </label>
                                </div>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="acne_facial" value="iii" <?= isset($linha_facial['acne']) && $linha_facial['acne'] === 'iii' ? 'checked' : '' ?> required> Grau III - Comedões abertos, pápulas, pústulas, seborréia e cistos
                                    </label>
                                </div>
                                </div>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="acne_facial" value="iv" <?= isset($linha_facial['acne']) && $linha_facial['acne'] === 'iv' ? 'checked' : '' ?> required> Grau IV - Todas as complicações acima com a presença de grandes <br> nódulos purulentos
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Evolução cutânea: </p>
                                <p style="font-size: .7rem;">(Selecione mais de um)</p>
                            </td>
                            <td>
                                <div class="grupo_checkbox">
                                    <label>
                                        <input type="checkbox" name="evolucao_cutanea_facial[]" value="linhas" <?= isset($linha_facial['evolucao_cutanea']) && in_array("linhas", $evolucao_cutanea_marcados) ? 'checked' : '' ?>> Linhas
                                    </label>
                                    <label>
                                        <input type="checkbox" name="evolucao_cutanea_facial[]" value="sulcos" <?= isset($linha_facial['evolucao_cutanea']) && in_array("sulcos", $evolucao_cutanea_marcados) ? 'checked' : '' ?>> Sulcos
                                    </label>
                                    <label>
                                        <input type="checkbox" name="evolucao_cutanea_facial[]" value="rugas" <?= isset($linha_facial['evolucao_cutanea']) && in_array("rugas", $evolucao_cutanea_marcados) ? 'checked' : '' ?>> Rugas
                                    </label>
                                    <label>
                                        <input type="checkbox" name="evolucao_cutanea_facial[]" value="ptose" <?= isset($linha_facial['evolucao_cutanea']) && in_array("ptose", $evolucao_cutanea_marcados) ? 'checked' : '' ?>> Ptose
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="local_facial">Local</label>
                            <td><textarea name="local_facial" maxlength="200"><?= isset($linha_facial['local']) ? $linha_facial['local'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Alterações da epiderme: </p>
                                <p style="font-size: .7rem;">(Selecione mais de um)</p>
                            </td>
                            <td style="padding: 0;">
                                <table>
                                    <tr>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="alteracoes_epiderme_facial[]" value="milio" <?= isset($linha_facial['alteracoes_epiderme']) && in_array("milio", $alteracoes_epiderme_marcados) ? 'checked' : '' ?>> Mílio
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="alteracoes_epiderme_facial[]" value="hidroadenoma" <?= isset($linha_facial['alteracoes_epiderme']) && in_array("hidroadenoma", $alteracoes_epiderme_marcados) ? 'checked' : '' ?>> Hidroadenoma
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="alteracoes_epiderme_facial[]" value="tricose" <?= isset($linha_facial['alteracoes_epiderme']) && in_array("tricose", $alteracoes_epiderme_marcados) ? 'checked' : '' ?>> Tricose
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="alteracoes_epiderme_facial[]" value="seborreia" <?= isset($linha_facial['alteracoes_epiderme']) && in_array("seborreia", $alteracoes_epiderme_marcados) ? 'checked' : '' ?>> Seborréia
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="alteracoes_epiderme_facial[]" value="xantalasma" <?= isset($linha_facial['alteracoes_epiderme']) && in_array("xantalasma", $alteracoes_epiderme_marcados) ? 'checked' : '' ?>> Xantalasma
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="alteracoes_epiderme_facial[]" value="verrugas" <?= isset($linha_facial['alteracoes_epiderme']) && in_array("verrugas", $alteracoes_epiderme_marcados) ? 'checked' : '' ?>> Verrugas
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="alteracoes_epiderme_facial[]" value="rosacea" <?= isset($linha_facial['alteracoes_epiderme']) && in_array("rosacea", $alteracoes_epiderme_marcados) ? 'checked' : '' ?>> Rosácea
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="alteracoes_epiderme_facial[]" value="dermatite" <?= isset($linha_facial['alteracoes_epiderme']) && in_array("dermatite", $alteracoes_epiderme_marcados) ? 'checked' : '' ?>> Dermatite
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="alteracoes_epiderme_facial[]" value="fotoenvelhecimento" <?= isset($linha_facial['alteracoes_epiderme']) && in_array("fotoenvelhecimento", $alteracoes_epiderme_marcados) ? 'checked' : '' ?>> Fotoenvelhecimento
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="alteracoes_epiderme_facial[]" value="melasma" <?= isset($linha_facial['alteracoes_epiderme']) && in_array("melasma", $alteracoes_epiderme_marcados) ? 'checked' : '' ?>> Melasma
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="alteracoes_epiderme_facial[]" value="efelides" <?= isset($linha_facial['alteracoes_epiderme']) && in_array("efelides", $alteracoes_epiderme_marcados) ? 'checked' : '' ?>> Efélides
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="alteracoes_epiderme_facial[]" value="hipercromia" <?= isset($linha_facial['alteracoes_epiderme']) && in_array("hipercromia", $alteracoes_epiderme_marcados) ? 'checked' : '' ?>> Hipercromia
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="alteracoes_epiderme_facial[]" value="acromias" <?= isset($linha_facial['alteracoes_epiderme']) && in_array("acromias", $alteracoes_epiderme_marcados) ? 'checked' : '' ?>> Acromias
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="alteracoes_epiderme_facial[]" value="nevus" <?= isset($linha_facial['alteracoes_epiderme']) && in_array("nevus", $alteracoes_epiderme_marcados) ? 'checked' : '' ?>> Nevus
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="alteracoes_epiderme_facial[]" value="hipocromia" <?= isset($linha_facial['alteracoes_epiderme']) && in_array("hipocromia", $alteracoes_epiderme_marcados) ? 'checked' : '' ?>> Hipocromia
                                            </label>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Lesões de pele: </p>
                                <p style="font-size: .7rem;">(Selecione mais de um)</p>
                            </td>
                            <td style="padding: 0;">
                                <table>
                                    <tr>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="lesoes_pele_facial[]" value="comedoes" <?= isset($linha_facial['lesao_pele']) && in_array("comedoes", $lesao_pele_marcados) ? 'checked' : '' ?>> Comedões
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="lesoes_pele_facial[]" value="papula" <?= isset($linha_facial['lesao_pele']) && in_array("papula", $lesao_pele_marcados) ? 'checked' : '' ?>> Pápula
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="lesoes_pele_facial[]" value="pustulas" <?= isset($linha_facial['lesao_pele']) && in_array("pustulas", $lesao_pele_marcados) ? 'checked' : '' ?>> Pústulas
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="lesoes_pele_facial[]" value="milium" <?= isset($linha_facial['lesao_pele']) && in_array("milium", $lesao_pele_marcados) ? 'checked' : '' ?>> Mílium
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="lesoes_pele_facial[]" value="cisto" <?= isset($linha_facial['lesao_pele']) && in_array("cisto", $lesao_pele_marcados) ? 'checked' : '' ?>> Cisto
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="lesoes_pele_facial[]" value="nodulo" <?= isset($linha_facial['lesao_pele']) && in_array("nodulo", $lesao_pele_marcados) ? 'checked' : '' ?>> Nódulo
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="lesoes_pele_facial[]" value="ulceracao" <?= isset($linha_facial['lesao_pele']) && in_array("ulceracao", $lesao_pele_marcados) ? 'checked' : '' ?>> Ulceração
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="lesoes_pele_facial[]" value="hiperqueratose" <?= isset($linha_facial['lesao_pele']) && in_array("hiperqueratose", $lesao_pele_marcados) ? 'checked' : '' ?>> Hiperqueratose
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="lesoes_pele_facial[]" value="psoriase" <?= isset($linha_facial['lesao_pele']) && in_array("psoriase", $lesao_pele_marcados) ? 'checked' : '' ?>> Psoríase
                                            </label>
                                        </td>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Cicatriz: </p>
                                <p style="font-size: .7rem;">(Selecione mais de um)</p>
                            </td>
                            <td>
                                <div class="grupo_checkbox">
                                    <label>
                                        <input type="checkbox" name="cicatriz_facial[]" value="atrofica" <?= isset($linha_facial['cicatriz']) && in_array("atrofica", $cicatriz_marcados) ? 'checked' : '' ?>> Atrófica
                                    </label>
                                    <label>
                                        <input type="checkbox" name="cicatriz_facial[]" value="queloideana" <?= isset($linha_facial['cicatriz']) && in_array("queloideana", $cicatriz_marcados) ? 'checked' : '' ?>> Queloideana
                                    </label>
                                    <label>
                                        <input type="checkbox" name="cicatriz_facial[]" value="hipotrofica" <?= isset($linha_facial['cicatriz']) && in_array("hipotrofica", $cicatriz_marcados) ? 'checked' : '' ?>> Hipotrófica
                                    </label>
                                    <label>
                                        <input type="checkbox" name="cicatriz_facial[]" value="hipertrofica" <?= isset($linha_facial['cicatriz']) && in_array("hipertrofica", $cicatriz_marcados) ? 'checked' : '' ?>> Hipertrófica
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Pelos: </p>
                                <p style="font-size: .7rem;">(Selecione mais de um)</p>
                            </td>
                            <td>
                                <div class="grupo_checkbox">
                                    <label>
                                        <input type="checkbox" name="pelos_facial[]" value="hirutismo" <?= isset($linha_facial['pelos']) && in_array("hirutismo", $pelos_marcados) ? 'checked' : '' ?>> Hirutismo
                                    </label>
                                    <label>
                                        <input type="checkbox" name="pelos_facial[]" value="hipertricose" <?= isset($linha_facial['pelos']) && in_array("hipertricose", $pelos_marcados) ? 'checked' : '' ?>> Hipertricose
                                    </label>
                                    <label>
                                        <input type="checkbox" name="pelos_facial[]" value="alopecia" <?= isset($linha_facial['pelos']) && in_array("alopecia", $pelos_marcados) ? 'checked' : '' ?>> Alopécia
                                    </label>
                                    <label>
                                        <input type="checkbox" name="pelos_facial[]" value="foliculite" <?= isset($linha_facial['pelos']) && in_array("foliculite", $pelos_marcados) ? 'checked' : '' ?>> Foliculite
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Possui olheiras?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="olheiras_facial" value="sim" <?= isset($linha_facial['olheiras']) && $linha_facial['olheiras'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="olheiras_facial" value="nao" <?= isset($linha_facial['olheiras']) && $linha_facial['olheiras'] === 'nao' ? 'checked' : '' ?> required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="observacao_olheiras_facial">Observação olheiras</label>
                            <td><textarea name="observacao_olheiras_facial" maxlength="1000"><?= isset($linha_facial['observacao_olheiras']) ? $linha_facial['observacao_olheiras'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center; padding-bottom: .5rem">
                                <h4>AVALIAÇÃO POR IMAGEM</h4>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="video_foto_facial">Vídeo câmera / foto</label></td>
                            <td><textarea name="video_foto_facial" maxlength="1000"><?= isset($linha_facial['video_foto']) ? $linha_facial['video_foto'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="protocolo_facial">Protocolo de tratamento facial:</label></td>
                            <td><textarea name="protocolo_facial" maxlength="1000"><?= isset($linha_facial['protocolo']) ? $linha_facial['protocolo'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td>
                                <p>
                                    Autorizo fotos e vídeos para <br>comparativo de antes / depois:
                                </p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="antes_depois_facial" value="sim" <?= isset($linha_facial['antes_depois']) && $linha_facial['antes_depois'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="antes_depois_facial" value="nao" <?= isset($linha_facial['antes_depois']) && $linha_facial['antes_depois'] === 'nao' ? 'checked' : '' ?> required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>
                                    Autorizo fotos e vídeos para <br>publicação em redes sociais:
                                </p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="redes_sociais_facial" value="sim" <?= isset($linha_facial['redes_sociais']) && $linha_facial['redes_sociais'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="redes_sociais_facial" value="nao" <?= isset($linha_facial['redes_sociais']) && $linha_facial['redes_sociais'] === 'nao' ? 'checked' : '' ?> required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p>
                                    Estou de acordo com tratamento <br>elaborado:
                                </p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="acordo_tratamento_facial" value="sim" <?= isset($linha_facial['acordo_tratamento']) && $linha_facial['acordo_tratamento'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="acordo_tratamento_facial" value="nao" <?= isset($linha_facial['acordo_tratamento']) && $linha_facial['acordo_tratamento'] === 'nao' ? 'checked' : '' ?> required> Nao
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-textarea-counter/0.3.1/jquery.textarea-counter.min.js"></script>
    <script src="../js_files/contadorCaractere.js"></script>
</body>

</html>