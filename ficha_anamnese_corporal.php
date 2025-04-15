<?php
include("conexao_db.php");
$cpf_sql =  $_POST["cpf_corporal"];

$sql = "SELECT * FROM ficha_anamnese_corporal WHERE cliente = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $cpf_sql);
$stmt->execute();
$resultado = $stmt->get_result();
$linha = $resultado->fetch_assoc()
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
        <h2>Ficha de Anamnese Corporal / <a href="anamnese_corporal_pesquisa.php">VOLTAR</a></h2>
        <section class="cliente_ficha_corporal">
            <h3>CLIENTE SELECIONADO</h3>
            <input type="text" name="exibir_nome_cliente" value="<?= $_POST["cpf_corporal"]; ?>" disabled>
            <input type="text" name="exibir_nome_cliente" value="<?= $_POST["nome_corporal"]; ?>" disabled>
        </section>
        <section class="ficha_corporal_dados">
            <form method="post" action="opr_ficha_anamnese_corporal.php" class="ficha_corporal-form">
                <input type="hidden" name="cpf_ficha_corporal" value="<?= $_POST["cpf_corporal"]; ?>">
                <table class="ficha_corporal-table">

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
                            <td><input type="text" id="qual_cosmeticos" name="qual_cosmeticos" value="<?= isset($linha['qual_cosmetico']) ? $linha['qual_cosmetico'] : ''; ?>" maxlength="50"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Usa tabaco?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="fumante" value="sim" required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="fumante" value="nao" required> Nao
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
                                        <input type="radio" name="ingere_alcool" value="sim" required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="ingere_alcool" value="nao" required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="qtde_agua">Quantos copos de água por dia?</label></td>
                            <td><input type="text" id="qtde_agua" name="qtde_agua" maxlength="50"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Qualidade do sono?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="qualidade_sono" value="bom" required> Bom
                                    </label>
                                    <label>
                                        <input type="radio" name="qualidade_sono" value="ruim" required> Ruim
                                    </label>
                                    <label>
                                        <input type="radio" name="qualidade_sono" value="péssimo" required> Péssimo
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
                                        <input type="radio" name="qualidade_alimentacao" value="bom" required> Bom
                                    </label>
                                    <label>
                                        <input type="radio" name="qualidade_alimentacao" value="ruim" required> Ruim
                                    </label>
                                    <label>
                                        <input type="radio" name="qualidade_alimentacao" value="péssimo" required> Péssimo
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
                                        <input type="radio" name="dieta" value="sim" required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="dieta" value="nao" required> Nao
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
                                        <input type="radio" name="patologia_pele" value="hipotiroidismo" required> Hipotiroidismo
                                    </label>
                                    <label>
                                        <input type="radio" name="patologia_pele" value="hipertiroidismo" required> Hipertiroidismo
                                    </label>
                                    <label>
                                        <input type="radio" name="patologia_pele" value="nao" required> Não
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
                                        <input type="radio" name="toma_medicamento" value="sim" required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="toma_medicamento" value="nao" required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="qual_medicamento">Quais medicamentos?</label></td>
                            <td><input type="text" id="qual_medicamento" name="qual_medicamento" maxlength="30"></td>
                        </tr>
                        <tr>
                            <td><label for="tempo_medicacao">Há quanto tempo toma medicamentos?</label></td>
                            <td><input type="text" id="tempo_medicacao" name="tempo_medicacao" maxlength="30"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Usa suplementos oral?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="suplemento_oral" value="sim" required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="suplemento_oral" value="nao" required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="quais_suplementos">Quais suplementos?</label></td>
                            <td><input type="text" id="quais_suplementos" name="quais_suplementos" maxlength="30"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Possui trombose?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="trombose" value="sim" required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="trombose" value="nao" required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="qual_trombose">Qual tipo de trombose?</label></td>
                            <td><input type="text" id="qual_trombose" name="qual_trombose" maxlength="30"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Possiu antecendentes oncológicos?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="antecedentes_oncologico" value="sim" required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="antecedentes_oncologico" value="nao" required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Possiu diabetes?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="diabetes" value="sim" required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="diabetes" value="nao" required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="qual_diabetes">Qual tipo de diabetes?</label></td>
                            <td><input type="text" id="qual_diabetes" name="qual_diabetes" maxlength="50"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>Já fez cirurgia plástica?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="cirurgia_plastica" value="sim" required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="cirurgia_plastica" value="nao" required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="qual_cirurgia">Qual cirurgia?</label></td>
                            <td><input type="text" id="qual_cirurgia" name="qual_cirurgia" maxlength="30"></td>
                        </tr>

                        <tr>
                            <td colspan="2" style="text-align: center; padding-bottom: .5rem">
                                <h4>COM RELAÇÃO À ALOPECIA</h4>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="queixa_alopecia">Queixa principal</label></td>
                            <td><textarea name="queixa_alopecia" id="queixa_alopecia" maxlength="300"></textarea></td>
                        </tr>
                        <tr>
                            <td>
                                <p>A doença acomete outras partes do corpo?</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="acomete_corpo" value="sim" required> Sim
                                    </label>
                                    <label>
                                        <input type="radio" name="acomete_corpo" value="nao" required> Nao
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="qual_parte_corpo">Quais partes do corpo?</label></td>
                            <td><input type="text" id="qual_parte_corpo" name="qual_parte_corpo" maxlength="30"></td>
                        </tr>
                        <tr>
                            <td><label for="tempo_disfuncao">Há quanto começou essa disfunção?</label></td>
                            <td><input type="text" id="tempo_disfuncao" name="tempo_disfuncao" maxlength="30"></td>
                        </tr>
                        <tr>
                            <td>
                                <p>A doença está:</p>
                            </td>
                            <td>
                                <div class="grupo_radio">
                                    <label>
                                        <input type="radio" name="status_doenca" value="estavel" required> Estável
                                    </label>
                                    <label>
                                        <input type="radio" name="status_doenca" value="aumentando" required> Aumentando
                                    </label>
                                    <label>
                                        <input type="radio" name="status_doenca" value="diminuindo" required> Diminuindo
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