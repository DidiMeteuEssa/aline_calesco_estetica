<?php
include("conexao_db.php");
$cpf_sql_melasma =  $_POST["cpf_melasma"];

$sql_melasma =
    "SELECT ficha_melasma.*, campos_comuns.*
FROM ficha_melasma
LEFT JOIN campos_comuns ON ficha_melasma.cliente = campos_comuns.cliente
WHERE ficha_melasma.cliente = ?

UNION ALL

SELECT ficha_melasma.*, campos_comuns.*
FROM campos_comuns
LEFT JOIN ficha_melasma ON campos_comuns.cliente = ficha_melasma.cliente
WHERE campos_comuns.cliente = ?;
";
$stmt_melasma = $conn->prepare($sql_melasma);
$stmt_melasma->bind_param("ss", $cpf_sql_melasma, $cpf_sql_melasma);
$stmt_melasma->execute();
$resultado_melasma = $stmt_melasma->get_result();
$linha_melasma = $resultado_melasma->fetch_assoc();

$sql_pessoal = "SELECT * FROM clientes WHERE cpf = ?";
$stmt_pessoal = $conn->prepare($sql_pessoal);
$stmt_pessoal->bind_param("s", $cpf_sql_melasma);
$stmt_pessoal->execute();
$resultado_pessoal = $stmt_pessoal->get_result();
$linha_pessoal = $resultado_pessoal->fetch_assoc();

if (isset($linha_melasma['data_hoje'])) {
    $data_mysql = $linha_melasma['data_hoje'];
    $data_br = date('d/m/Y', strtotime($data_mysql));
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
    <title>Tratamento de Melasma</title>
</head>

<body>
    <header>
        <h1>Aline Calesco Estética Funcional Integrativa</h1>
    </header>
    <main>
        <h2>Ficha de Tratamento de Melasma / <a href="melasma_pesquisa.php">VOLTAR</a></h2>
        <section class="cliente_ficha">
            <h3>CLIENTE SELECIONADO</h3>
            <input type="text" name="exibir_nome_cliente" value="<?= $_POST["nome_melasma"]; ?>" disabled>
            <input type="text" name="exibir_nome_cliente" value="<?= $_POST["cpf_melasma"]; ?>" disabled>
        </section>
        <section class="ficha_dados">
            <form method="post" action="opr_fichas.php" class="ficha-form" onsubmit="return msgSucesso()">
                <input type="hidden" name="cpf_ficha_melasma" value="<?= $_POST["cpf_melasma"]; ?>">
                <input type="hidden" name="opr" value="3">
                <table class="ficha-table">
                    <tbody>
                        <tr>
                            <td colspan="2" style="text-align: center; padding-bottom: .5rem">
                                <h4>DATA</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="data_hoje_melasma">Data de hoje:</label>
                                <p style="font-size: 0.7rem;">(A data é gerada automaticamente, <br>atualizar se necessário)</p>
                            </td>
                            <td><input type="text" id="data_hoje_melasma" name="data_hoje_melasma" value="<?= !isset($linha_melasma['data_hoje']) ? date('d/m/Y') : $data_br ?>" placeholder="dd/mm/aaaa" required></td>
                        </tr>
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
                            <td><label for="trabalha">Trabalha como:</label></td>
                            <td><input type="text" name="trabalha" value="<?= $linha_pessoal['profissao']; ?>" disabled style="width: 40rem;"></td>
                        </tr>
                        <tr>
                            <td><label for="como_conheceu_trabalho_melasma">Como conheceu meu trabalho?</label></td>
                            <td><textarea name="como_conheceu_trabalho_melasma" maxlength="200" required><?= isset($linha_melasma['como_conheceu_trabalho']) ? $linha_melasma['como_conheceu_trabalho'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="filhos_melasma">Possui filhos?</label></td>
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
                            <td colspan="2" style="text-align: center; padding-bottom: .5rem">
                                <h4>QUEIXAS E HISTÓRICO CLÍNICO</h4>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="queixa_principal_melasma">Queixa principal</label></td>
                            <td><textarea name="queixa_principal_melasma" required maxlength="500"><?= isset($linha_melasma['queixa_principal']) ? $linha_melasma['queixa_principal'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="tempo_percebeu_melasma">Há quanto tempo <br>você percebeu essa(s) <br>QUEIXA(S)?</label></td>
                            <td><textarea name="tempo_percebeu_melasma" required maxlength="200"><?= isset($linha_melasma['tempo_percebeu']) ? $linha_melasma['tempo_percebeu'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="tempo_percebeu_manchas_melasma">Há quanto tempo <br>você percebeu essa(s) <br> MANCHAS?</label></td>
                            <td><textarea name="tempo_percebeu_manchas_melasma" required maxlength="200"><?= isset($linha_melasma['tempo_percebeu_manchas']) ? $linha_melasma['tempo_percebeu_manchas'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="tratou_melasma_melasma">Já tratou melasma antes?</label></td>
                            <td><textarea name="tratou_melasma_melasma" required maxlength="200"><?= isset($linha_melasma['tratou_melasma']) ? $linha_melasma['tratou_melasma'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="uso_acido_melasma">Já fez uso de ácido ou peeling?</label></td>
                            <td><textarea name="uso_acido_melasma" required maxlength="200"><?= isset($linha_melasma['uso_acido']) ? $linha_melasma['uso_acido'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="problemas_saude_melasma">Possui algum problema de saúde?</label></td>
                            <td><textarea name="problemas_saude_melasma" required maxlength="200"><?= isset($linha_melasma['problemas_saude']) ? $linha_melasma['problemas_saude'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="medicacao">Usa alguma medicação frequente? <br>Há quanto tempo?</label></td>
                            <td><textarea name="medicacao" maxlength="300"><?= isset($linha_melasma['medicacao']) ? $linha_melasma['medicacao'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center; padding-bottom: .5rem">
                                <h4>CARACTERÍSTICAS DA PELE E EXPOSIÇÃO</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Tipo de pele: </p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="tipo_pele" value="normal" <?= isset($linha_melasma['tipo_pele']) && $linha_melasma['tipo_pele'] === 'normal' ? 'checked' : '' ?> required> Normal
                                    </label>
                                    <label>
                                        <input type="radio" name="tipo_pele" value="mista" <?= isset($linha_melasma['tipo_pele']) && $linha_melasma['tipo_pele'] === 'mista' ? 'checked' : '' ?> required> Mista
                                    </label>
                                    <label>
                                        <input type="radio" name="tipo_pele" value="seca" <?= isset($linha_melasma['tipo_pele']) && $linha_melasma['tipo_pele'] === 'seca' ? 'checked' : '' ?> required> Seca
                                    </label>
                                    <label>
                                        <input type="radio" name="tipo_pele" value="oleosa" <?= isset($linha_melasma['tipo_pele']) && $linha_melasma['tipo_pele'] === 'oleosa' ? 'checked' : '' ?> required> Oleosa
                                    </label>
                                    <label>
                                        <input type="radio" name="tipo_pele" value="sensivel" <?= isset($linha_melasma['tipo_pele']) && $linha_melasma['tipo_pele'] === 'sensivel' ? 'checked' : '' ?> required> Sensível
                                    </label>
                                    <label>
                                        <input type="radio" name="tipo_pele" value="acneia" <?= isset($linha_melasma['tipo_pele']) && $linha_melasma['tipo_pele'] === 'acneia' ? 'checked' : '' ?> required> Acneia
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
                                        <input type="radio" name="fototipo" value="i" <?= isset($linha_melasma['fototipo']) && $linha_melasma['fototipo'] === 'i' ? 'checked' : '' ?> required> I
                                    </label>
                                    <label>
                                        <input type="radio" name="fototipo" value="ii" <?= isset($linha_melasma['fototipo']) && $linha_melasma['fototipo'] === 'ii' ? 'checked' : '' ?> required> II
                                    </label>
                                    <label>
                                        <input type="radio" name="fototipo" value="iii" <?= isset($linha_melasma['fototipo']) && $linha_melasma['fototipo'] === 'iii' ? 'checked' : '' ?> required> III
                                    </label>
                                    <label>
                                        <input type="radio" name="fototipo" value="iv" <?= isset($linha_melasma['fototipo']) && $linha_melasma['fototipo'] === 'iv' ? 'checked' : '' ?> required> IV
                                    </label>
                                    <label>
                                        <input type="radio" name="fototipo" value="v" <?= isset($linha_melasma['fototipo']) && $linha_melasma['fototipo'] === 'v' ? 'checked' : '' ?> required> V
                                    </label>
                                    <label>
                                        <input type="radio" name="fototipo" value="vi" <?= isset($linha_melasma['fototipo']) && $linha_melasma['fototipo'] === 'vi' ? 'checked' : '' ?> required> VI
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Tipo de melanina:</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="tipo_melanina_melasma" value="eumelanina" <?= isset($linha_melasma['tipo_melanina']) && $linha_melasma['tipo_melanina'] === 'eumelanina' ? 'checked' : '' ?> required> Eumelanina
                                    </label>
                                    <label>
                                        <input type="radio" name="tipo_melanina_melasma" value="feumelanina" <?= isset($linha_melasma['tipo_melanina']) && $linha_melasma['tipo_melanina'] === 'feumelanina' ? 'checked' : '' ?> required> Feumelanina
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Quando você toma Sol, <br>sem protetor solar, sua pele: </p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="reacao_sol_melasma" value="i" <?= isset($linha_melasma['reacao_sol']) && $linha_melasma['reacao_sol'] === 'i' ? 'checked' : '' ?> required> Fica vermelha, arde, e não bronzeia
                                    </label>
                                </div>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="reacao_sol_melasma" value="ii" <?= isset($linha_melasma['reacao_sol']) && $linha_melasma['reacao_sol'] === 'ii' ? 'checked' : '' ?> required> Fica vermelha, arde, depois bronzeia <br> moderadamente, e logo já volta a cor normal
                                    </label>
                                </div>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="reacao_sol_melasma" value="iii" <?= isset($linha_melasma['reacao_sol']) && $linha_melasma['reacao_sol'] === 'iii' ? 'checked' : '' ?> required> Queima e logo já bronzeia
                                    </label>
                                </div>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="reacao_sol_melasma" value="iv" <?= isset($linha_melasma['reacao_sol']) && $linha_melasma['reacao_sol'] === 'iv' ? 'checked' : '' ?> required> Nem queima e nem bronzeia
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="nivel_exposicao_radiacao">Nível de exposição a <br> radiações durante o dia:</label></td>
                            <td><input type="text" name="nivel_exposicao_radiacao" value="<?= isset($linha_melasma['nivel_exposicao_radiacao'])  ? $linha_melasma['nivel_exposicao_radiacao'] : '' ?>" required style="width: 40rem;"></td>
                        </tr>
                        <tr>
                            <td><label for="temperatura_media_melasma">Temperatura media de <br> onde mora / trabalha:</label></td>
                            <td><input type="text" name="temperatura_media_melasma" value="<?= isset($linha_melasma['temperatura_media'])  ? $linha_melasma['temperatura_media'] : '' ?>" required style="width: 40rem;"></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center; padding-bottom: .5rem">
                                <h4>TRATAMENTOS ANTERIORES E CUIDADOS COM A PELE</h4>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="tratamento_realizou">Descreva todos os tratamentos <br>prévios que já realizou (em <br>detalhes do que foi feito e de <br>como foi o pós, em casa e <br> a recuperação): </label></td>
                            <td><textarea name="tratamento_realizou" required maxlength="500"><?= isset($linha_melasma['tratamento_realizou']) ? $linha_melasma['tratamento_realizou'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Faz uso de cosméticos ou tem alguma <br> rotina de skincare?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="uso_cosmetico_rotina_skincare_melasma" value="sim" <?= isset($linha_melasma['uso_cosmetico_rotina_skincare']) && $linha_melasma['uso_cosmetico_rotina_skincare'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="uso_cosmetico_rotina_skincare_melasma" value="nao" <?= isset($linha_melasma['uso_cosmetico_rotina_skincare']) && $linha_melasma['uso_cosmetico_rotina_skincare'] === 'nao' ? 'checked' : '' ?> required> Não
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center;"><label>Se sim, descreva detalhadamente quais são os produtos que você utiliza / já utilizou: </label></td>
                        </tr>
                        <tr>
                            <td><label for="rotina_dia_melasma">Dia: </label></td>
                            <td><textarea name="rotina_dia_melasma" maxlength="300"><?= isset($linha_melasma['rotina_dia']) ? $linha_melasma['rotina_dia'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="rotina_noite_melasma">Noite: </label></td>
                            <td><textarea name="rotina_noite_melasma" maxlength="300"><?= isset($linha_melasma['rotina_noite']) ? $linha_melasma['rotina_noite'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center;">
                                <h4>HÁBITOS E ROTINA</h4>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="alimentacao_detalhada">Alimentação detalhada: </label></td>
                            <td><textarea name="alimentacao_detalhada" required maxlength="300"><?= isset($linha_melasma['alimentacao_detalhada']) ? $linha_melasma['alimentacao_detalhada'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="litros_agua">Quantos litros de água consome por dia:</label></td>
                            <td><input type="text" name="litros_agua" required value="<?= isset($linha_melasma['litros_agua']) ? $linha_melasma['litros_agua'] : '' ?>" style="width: 40rem;"></td>
                        </tr>
                        <tr>
                            <td><label for="diureticos">Ingere algum líquido diurético?</label></td>
                            <td><input type="text" name="diureticos" required placeholder="Bebida alcoólica, chás diuréticos, chimarrão..." value="<?= isset($linha_melasma['diureticos']) ? $linha_melasma['diureticos'] : '' ?>" style="width: 40rem;"></td>
                        </tr>
                        <tr>
                            <td><label for="qualidade_sono">Quantas horas de sono por dia?</label></td>
                            <td><input type="text" name="qualidade_sono" required value="<?= isset($linha_melasma['qualidade_sono']) ? $linha_melasma['qualidade_sono'] : '' ?>" style="width: 40rem;"></td>
                        </tr>
                        <tr>
                            <td><label for="exercicios_melasma">Você pratica alguma atividade física?</label></td>
                            <td><textarea name="exercicios_melasma" required maxlength="200"><?= isset($linha_melasma['exercicios']) ? $linha_melasma['exercicios'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Usa secador / chapinha?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="usa_secador_chapinha_melasma" value="sim" <?= isset($linha_melasma['usa_secador_chapinha']) && $linha_melasma['usa_secador_chapinha'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="usa_secador_chapinha_melasma" value="nao" <?= isset($linha_melasma['usa_secador_chapinha']) && $linha_melasma['usa_secador_chapinha'] === 'nao' ? 'checked' : '' ?> required> Não
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="intestino">Funcionamento intestinal:</label></td>
                            <td><textarea name="intestino" required maxlength="300"><?= isset($linha_melasma['intestino']) ? $linha_melasma['intestino'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center; padding-bottom: .5rem">
                                <h4>ÁREA DA PROFISSIONAL</h4>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="concorda_troca_melasma">Se a profissional dizer que <br>deve trocar os produtos, você concorda? </label></td>
                            <td><textarea name="concorda_troca_melasma" required maxlength="200"><?= isset($linha_melasma['concorda_troca']) ? $linha_melasma['concorda_troca'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="indicacao_plano_tratamento_melasma">Indicação do plano de tratamento:</label></td>
                            <td><textarea name="indicacao_plano_tratamento_melasma" required maxlength="300"><?= isset($linha_melasma['indicacao_plano_tratamento']) ? $linha_melasma['indicacao_plano_tratamento'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="indicacao_skin_care_melasma">Indicação de skin care:</label></td>
                            <td><textarea name="indicacao_skin_care_melasma" required maxlength="300"><?= isset($linha_melasma['indicacao_skin_care']) ? $linha_melasma['contatacao_raiz_problema'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="indicacao_equipe_multidisciplinar_melasma">Indicação de equipe multidisciplinar:</label></td>
                            <td><textarea name="indicacao_equipe_multidisciplinar_melasma" required maxlength="300"><?= isset($linha_melasma['indicacao_equipe_multidisciplinar']) ? $linha_melasma['indicacao_equipe_multidisciplinar'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="indicacao_nutraceticos_orais_melasma">Indicação de nutracêuticos orais <br> (por você ou pelo nutricionista):</label></td>
                            <td><textarea name="indicacao_nutraceticos_orais_melasma" required maxlength="300"><?= isset($linha_melasma['indicacao_nutraceticos_orais']) ? $linha_melasma['indicacao_nutraceticos_orais'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="pontos_acordados_melasma">Pontos acordados:</label></td>
                            <td><textarea name="pontos_acordados_melasma" required maxlength="300"><?= isset($linha_melasma['pontos_acordados']) ? $linha_melasma['pontos_acordados'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="constatacao_raiz_problema_melasma">Constatação da raiz do problema:</label></td>
                            <td><textarea name="constatacao_raiz_problema_melasma" required maxlength="500"><?= isset($linha_melasma['constatacao_raiz_problema']) ? $linha_melasma['constatacao_raiz_problema'] : ''; ?></textarea></td>
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
    <script src="https://unpkg.com/inputmask@5.0.8/dist/inputmask.min.js"></script>
    <script src="../js_files/mascaras.js"></script>
</body>

</html>