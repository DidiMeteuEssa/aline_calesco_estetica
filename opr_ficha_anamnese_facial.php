<?php
include("conexao_db.php");

$cpf_facial = $_POST["cpf_ficha_facial"];
$queixa_principal_facial = $_POST["queixa_facial"];
$fez_tratamento_facial = $_POST["tratamento_estetico_facial"];
$qual_tratamento_facial = $_POST["qual_tratamento_facial"];
$obteve_melhora_facial = $_POST["obteve_melhora_facial"];
$usa_lente_facial = $_POST["usa_lente_facial"];
$gestante_facial = $_POST["gestante_facial"];
$contraceptivos_facial = $_POST["contraceptivos_facial"];
$qual_contraceptivo_facial = $_POST["qual_contraceptivo_facial"];
$ingestao_agua_facial = $_POST["ingestao_agua_facial"];
$litros_agua_facial = $_POST["litros_agua_facial"];
$classificacao_alimentacao_facial = $_POST["classificacao_alimentacao_facial"];
$predominio_alimentar_facial = $_POST["predominio_alimentar_facial"];
$hipertensao_facial = $_POST["hipertensao_facial"];
$intestino_normal_facial = $_POST["intestino_normal_facial"];
$insonia_facial = $_POST["insonia_facial"];
$ansiedade_facial = $_POST["ansiedade_facial"];
$sensivel_dor_facial = $_POST["sensivel_dor_facial"];
$cancer_pele_facial = $_POST["cancer_pele_facial"];

if (isset($_POST['habitos_vida_facial'])) {
    $habitos_vida = $_POST['habitos_vida_facial'];
    $habitos_vida_str = implode(",", $habitos_vida);
} else {
    $habitos_vida_str = "";
}

$medicamentos_facial = $_POST["medicamentos_facial"];
$medicamento_qual_freq_facial = $_POST["medicamento_qual_freq_facial"];
$cosmeticos_facial = $_POST["cosmeticos_facial"];
$cosmeticos_qual_freq_facial = $_POST["cosmeticos_qual_freq_facial"];
$botox_facial = $_POST["botox_facial"];
$botox_local_tempo_facial = $_POST["botox_local_tempo_facial"];
$tireoide_facial = $_POST["tireoide_facial"];
$trombose_facial = $_POST["trombose_facial"];
$protetor_solar_facial = $_POST["protetor_solar_facial"];
$protetor_solar_qual_freq_facial = $_POST["protetor_solar_qual_freq_facial"];
$alergias_facial = $_POST["alergias_facial"];
$quais_alergias_facial = $_POST["quais_alergias_facial"];
$exposicao_sol_facial = $_POST["exposicao_sol_facial"];
$disturbio_hormonal_facial = $_POST["disturbio_hormonal_facial"];
$qual_disturbio_facial = $_POST["qual_disturbio_facial"];
$problemas_cardiacos_facial = $_POST["problemas_cardiacos_facial"];
$quais_cardiacos_facial = $_POST["quais_cardiacos_facial"];
$marcapasso_facial = $_POST["marcapasso_facial"];
$diabetes_facial = $_POST["diabetes_facial"];
$menstruacao_facial = $_POST["menstruacao_facial"];
$fototipo_facial = $_POST["fototipo_facial"];
$classif_fototipo_facial = $_POST["classif_fototipo_facial"];
$classif_goglau_facial = $_POST["classif_goglau_facial"];
$goglau_estatica_facial = $_POST["goglau_estatica_facial"];
$goglau_dinamica_facial = $_POST["goglau_dinamica_facial"];
$tipo_pele_facial = $_POST["tipo_pele_facial"];
$grau_hidratacao_facial = $_POST["grau_hidratacao_facial"];
$textura_pele_facial = $_POST["textura_pele_facial"];
$grau_oleosidade_facial = $_POST["grau_oleosidade_facial"];
$acne_facial = $_POST["acne_facial"];

if (isset($_POST['evolucao_cutanea_facial'])) {
    $evolucao_cutanea = $_POST['evolucao_cutanea_facial'];
    $evolucao_cutanea_str = implode(",", $evolucao_cutanea);
} else {
    $evolucao_cutanea_str = "";
}

$olocal_facial = $_POST["local_facial"];

if (isset($_POST['alteracoes_epiderme_facial'])) {
    $alteracoes_epiderme = $_POST['alteracoes_epiderme_facial'];
    $alteracoes_epiderme_str = implode(",", $alteracoes_epiderme);
} else {
    $alteracoes_epiderme_str = "";
}

if (isset($_POST['lesoes_pele_facial'])) {
    $lesoes_pele = $_POST['lesoes_pele_facial'];
    $lesoes_pele_str = implode(",", $lesoes_pele);
} else {
    $lesoes_pele_str = "";
}

if (isset($_POST['cicatriz_facial'])) {
    $cicatriz = $_POST['cicatriz_facial'];
    $cicatriz_str = implode(",", $cicatriz);
} else {
    $cicatriz_str = "";
}

if (isset($_POST['pelos_facial'])) {
    $pelos = $_POST['pelos_facial'];
    $pelos_str = implode(",", $pelos);
} else {
    $pelos_str = "";
}

$olheiras_facial = $_POST["olheiras_facial"];
$observacao_olheiras_facial = $_POST["observacao_olheiras_facial"];
$video_foto_facial = $_POST["video_foto_facial"];
$protocolo_facial = $_POST["protocolo_facial"];
$antes_depois_facial = $_POST["antes_depois_facial"];
$redes_sociais_facial = $_POST["redes_sociais_facial"];
$acordo_tratamento_facial = $_POST["acordo_tratamento_facial"];
$assinatura_facial = $_POST["assinatura_facial"];

$sql_status = $conn->prepare("SELECT status_ficha_facial FROM clientes WHERE cpf = ?");
$sql_status->bind_param("s", $cpf);
$sql_status->execute();
$result = $sql_status->get_result();
$row = $result->fetch_assoc();
$status = $row['status_ficha_facial'];

/*
if ($status === 1) {
    $sql = "UPDATE ficha_anamnese_facial SET
    
WHERE cliente = ?";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param(
            "ssssissssssssssssssssssssss",
            $usa_cosmetico,
            $qual_cosmetico,
            $fumante,
            $ingere_alcool,
            $qtde_agua,
            $qualidade_sono,
            $qualidade_alimentacao,
            $dieta,
            $patologia_pele,
            $toma_medicamento,
            $qual_medicamento,
            $tempo_medicacao,
            $suplemento_oral,
            $quais_suplementos,
            $trombose,
            $qual_trombose,
            $antecedentes_oncologico,
            $diabetes,
            $qual_diabetes,
            $cirurgia_plastica,
            $qual_cirurgia,
            $queixa_alopecia,
            $acomete_corpo,
            $qual_parte_corpo,
            $tempo_disfuncao,
            $status_doenca,
            $cpf
        );
    } else {
        echo "Erro ao preparar statement: " . $conn->error;
    }
} else {
 */
$sql = "INSERT INTO ficha_anamnese_facial 
(cliente, queixa_principal, fez_tratamento, qual_tratamento, obteve_melhora, usa_lente, gestante, contraceptivo, qual_contraceptivo, ingestao_agua, litros_agua, classificacao_alimentacao,
predominio_alimentar, hipertensao, intestino_normal, insonia, ansiedade, sensivel_dor, cancer_pele, habitos_vida, medicamentos, medicamentos_qual_freq, cosmeticos, cosmeticos_qual_freq,
botox, botox_local_tempo, tireoide, trombose, protetor_solar, protetor_solar_qual_freq, alergias, quais_alergias, exposicao_sol, disturbio_hormonal, qual_disturbio, problemas_cardiacos, 
quais_cardiacos, marcapasso, diabetes, menstruacao, fototipo, classif_fototipo, tipo_pele, grau_hidratacao, textura_pele, grau_oleosidade, acne, evolucao_cutanea, local, classif_goglau, goglau_estatica, 
goglau_dinamica, alteracoes_epiderme, lesao_pele, cicatriz, pelos, olheiras, observacao_olheiras, video_foto, protocolo, antes_depois, redes_sociais, acordo_tratamento, assinatura)
VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";


$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param(
        "ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss",
        $cpf_facial,
        $queixa_principal_facial,
        $fez_tratamento_facial,
        $qual_tratamento_facial,
        $obteve_melhora_facial,
        $usa_lente_facial,
        $gestante_facial,
        $contraceptivos_facial,
        $qual_contraceptivo_facial,
        $ingestao_agua_facial,
        $litros_agua_facial,
        $classificacao_alimentacao_facial,
        $predominio_alimentar_facial,
        $hipertensao_facial, 
        $intestino_normal_facial,
        $insonia_facial,
        $ansiedade_facial,
        $sensivel_dor_facial,
        $cancer_pele_facial,
        $habitos_vida_str,
        $medicamentos_facial,
        $medicamento_qual_freq_facial,
        $cosmeticos_facial,
        $cosmeticos_qual_freq_facial,
        $botox_facial,
        $botox_local_tempo_facial,
        $tireoide_facial,
        $trombose_facial,
        $protetor_solar_facial,
        $protetor_solar_qual_freq_facial,
        $alergias_facial,
        $quais_alergias_facial,
        $exposicao_sol_facial,
        $disturbio_hormonal_facial,
        $qual_disturbio_facial,
        $problemas_cardiacos_facial,
        $quais_cardiacos_facial,
        $marcapasso_facial,
        $diabetes_facial,
        $menstruacao_facial,
        $fototipo_facial,
        $classif_fototipo_facial,
        $tipo_pele_facial,
        $grau_hidratacao_facial,
        $textura_pele_facial,
        $grau_oleosidade_facial,
        $acne_facial,
        $evolucao_cutanea_str,
        $olocal_facial,
        $classif_goglau_facial,
        $goglau_estatica_facial,
        $goglau_dinamica_facial,
        $alteracoes_epiderme_str, 
        $lesoes_pele_str,
        $cicatriz_str,
        $pelos_str,
        $olheiras_facial,
        $observacao_olheiras_facial,
        $video_foto_facial,
        $protocolo_facial,
        $antes_depois_facial,
        $redes_sociais_facial,
        $acordo_tratamento_facial,
        $assinatura_facial
    );
} else {
    echo "Erro ao preparar statement: " . $conn->error;
}
//}

if ($stmt->execute()) {
    //if ($status === 0) {
    //    $update = $conn->prepare("UPDATE clientes SET status_ficha_corporal = 1 WHERE cpf = ?");
    //    $update->bind_param("s", $cpf);
    //     $update->execute();
    //  }
    header("Location: anamnese_facial_pesquisa.php");
    exit;
} else {
    echo "Erro ao inserir dados: " . $stmt->error;
}
