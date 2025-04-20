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
                                <h4>DATA</h4>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="data_hoje_melasma">Data de hoje:</label></td>
                            <td><input type="text" id="data_hoje_melasma" name="data_hoje_melasma" value="<?= isset($linha_melasma['data_hoje']) ? $linha_melasma['data_hoje'] : ''; ?>" placeholder="dd/mm/aaaa" required></td>
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
                            <td><label for="cidade">Trabalha como:</label></td>
                            <td><input type="text" name="cidade" value="<?= $linha_pessoal['profissao']; ?>" disabled style="width: 40rem;"></td>
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
                            <td><label for="como_conheceu_trabalho">Como conheceu meu trabalho?</label></td>
                            <td><textarea name="como_conheceu_trabalho" maxlength="200" required ><?= isset($linha_melasma['como_conheceu_trabalho']) ? $linha_melasma['como_conheceu_trabalho'] : ''; ?></textarea></td>
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
                            <td><label for="medicacao_melasma">Usa alguma medicação frequente? <br>Há quanto tempo?</label></td>
                            <td><textarea name="medicacao_melasma" maxlength="300"><?= isset($linha_melasma['medicacao']) ? $linha_melasma['medicacao'] : ''; ?></textarea></td>
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
                                        <input type="radio" name="tipo_pele_melasma" value="normal" <?= isset($linha_melasma['tipo_pele']) && $linha_melasma['tipo_pele'] === 'normal' ? 'checked' : '' ?> required> Normal
                                    </label>
                                    <label>
                                        <input type="radio" name="tipo_pele_melasma" value="mista" <?= isset($linha_melasma['tipo_pele']) && $linha_melasma['tipo_pele'] === 'mista' ? 'checked' : '' ?> required> Mista
                                    </label>
                                    <label>
                                        <input type="radio" name="tipo_pele_melasma" value="seca" <?= isset($linha_melasma['tipo_pele']) && $linha_melasma['tipo_pele'] === 'seca' ? 'checked' : '' ?> required> Seca
                                    </label>
                                    <label>
                                        <input type="radio" name="tipo_pele_melasma" value="oleosa" <?= isset($linha_melasma['tipo_pele']) && $linha_melasma['tipo_pele'] === 'oleosa' ? 'checked' : '' ?> required> Oleosa
                                    </label>
                                    <label>
                                        <input type="radio" name="tipo_pele_melasma" value="sensivel" <?= isset($linha_melasma['tipo_pele']) && $linha_melasma['tipo_pele'] === 'sensivel' ? 'checked' : '' ?> required> Sensível
                                    </label>
                                    <label>
                                        <input type="radio" name="tipo_pele_melasma" value="acneia" <?= isset($linha_melasma['tipo_pele']) && $linha_melasma['tipo_pele'] === 'acneia' ? 'checked' : '' ?> required> Acneia
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
                                        <input type="radio" name="fototipo_melasma" value="i" <?= isset($linha_melasma['fototipo']) && $linha_melasma['fototipo'] === 'i' ? 'checked' : '' ?> required> I
                                    </label>
                                    <label>
                                        <input type="radio" name="fototipo_melasma" value="ii" <?= isset($linha_melasma['fototipo']) && $linha_melasma['fototipo'] === 'ii' ? 'checked' : '' ?> required> II
                                    </label>
                                    <label>
                                        <input type="radio" name="fototipo_melasma" value="iii" <?= isset($linha_melasma['fototipo']) && $linha_melasma['fototipo'] === 'iii' ? 'checked' : '' ?> required> III
                                    </label>
                                    <label>
                                        <input type="radio" name="fototipo_melasma" value="iv" <?= isset($linha_melasma['fototipo']) && $linha_melasma['fototipo'] === 'iv' ? 'checked' : '' ?> required> IV
                                    </label>
                                    <label>
                                        <input type="radio" name="fototipo_melasma" value="v" <?= isset($linha_melasma['fototipo']) && $linha_melasma['fototipo'] === 'v' ? 'checked' : '' ?> required> V
                                    </label>
                                    <label>
                                        <input type="radio" name="fototipo_melasma" value="vi" <?= isset($linha_melasma['fototipo']) && $linha_melasma['fototipo'] === 'vi' ? 'checked' : '' ?> required> VI
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
                                        <input type="radio" name="tipo_melanina_facial" value="eumelanina" <?= isset($linha_facial['tipo_melanina']) && $linha_facial['tipo_melanina'] === 'eumelanina' ? 'checked' : '' ?> required> Eumelanina
                                    </label>
                                    <label>
                                        <input type="radio" name="tipo_melanina_facial" value="feumelanina" <?= isset($linha_facial['tipo_melanina']) && $linha_facial['tipo_melanina'] === 'feumelanina' ? 'checked' : '' ?> required> Feumelanina
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
                            <td><label for="nivel_exposicao_radiacao_melasma">Nível de exposição a <br> radiações durante o dia:</label></td>
                            <td><input type="text" name="nivel_exposicao_radiacao_melasma" value="<?= isset($linha_melasma['nivel_exposicao_radiacao'])  ? $linha_melasma['nivel_exposicao_radiacao'] : '' ?>" required style="width: 40rem;"></td>
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
                            <td><label for="tratamentos_ja_realizou_melasma">Descreva todos os tratamentos <br>prévios que já realizou (em <br>detalhes do que foi feito e de <br>como foi o pós, em casa e a recuperação): </label></td>
                            <td><textarea name="tratamentos_ja_realizou_melasma" required maxlength="500"><?= isset($linha_melasma['tratamentos_ja_realizou']) ? $linha_melasma['tratamentos_ja_realizou'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Faz uso de cosméticos ou tem alguma <br> rotina de skincare?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="uso_cosmetico_rotina_skincare_facial" value="sim" <?= isset($linha_facial['uso_cosmetico_rotina_skincare']) && $linha_facial['uso_cosmetico_rotina_skincare'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="uso_cosmetico_rotina_skincare_facial" value="nao" <?= isset($linha_facial['uso_cosmetico_rotina_skincare']) && $linha_facial['uso_cosmetico_rotina_skincare'] === 'nao' ? 'checked' : '' ?> required> Não
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
                            <td><label for="alimentacao_detalhada_melasma">Alimentação detalhada: </label></td>
                            <td><textarea name="alimentacao_detalhada_melasma" required maxlength="300"><?= isset($linha_melasma['alimentacao_detalhada']) ? $linha_melasma['alimentacao_detalhada'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="qtde_agua_melasma">Quantos litros de água consome por dia:</label></td>
                            <td><input type="text" name="qtde_agua_melasma" required value="<?= isset($linha_melasma['qtde_agua'])  ? $linha_melasma['qtde_agua'] : '' ?>" required style="width: 40rem;"></td>
                        </tr>
                        <tr>
                            <td><label for="ingere_diuretico_melasma">Ingere algum líquido diurético?</label></td>
                            <td><input type="text" name="ingere_diuretico_melasma" required placeholder="Bebida alcoólica, chás diuréticos, chimarrão..." value="<?= isset($linha_melasma['ingere_diuretico'])  ? $linha_melasma['ingere_diuretico'] : '' ?>" required style="width: 40rem;"></td>
                        </tr>
                        <tr>
                            <td><label for="sono_melasma">Quantas horas de sono por dia?</label></td>
                            <td><input type="text" name="sono_melasma" required value="<?= isset($linha_melasma['sono'])  ? $linha_melasma['sono'] : '' ?>" required style="width: 40rem;"></td>
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
                                        <input type="radio" name="usa_secador_chapinha_facial" value="sim" <?= isset($linha_facial['usa_secador_chapinha']) && $linha_facial['usa_secador_chapinha'] === 'sim' ? 'checked' : '' ?> required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="usa_secador_chapinha_facial" value="nao" <?= isset($linha_facial['usa_secador_chapinha']) && $linha_facial['usa_secador_chapinha'] === 'nao' ? 'checked' : '' ?> required> Não
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="funcionamento_intestinal_melasma">Funcionamento intestinal:</label></td>
                            <td><textarea name="funcionamento_intestinal_melasma" maxlength="300"><?= isset($linha_melasma['funcionamento_intestinal']) ? $linha_melasma['funcionamento_intestinal'] : ''; ?></textarea></td>
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
                            <td><label for="contatacao_raiz_problema_melasma">Indicação de skin care:</label></td>
                            <td><textarea name="contatacao_raiz_problema_melasma" required maxlength="300"><?= isset($linha_melasma['contatacao_raiz_problema']) ? $linha_melasma['contatacao_raiz_problema'] : ''; ?></textarea></td>
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
    <script src="../js_files/mascaras.js"></script>
</body>

</html>