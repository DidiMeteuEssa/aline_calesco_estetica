<?php
include("conexao_db.php");


$uso_cosmetico = $_POST["uso_cosmetico"];
$litros_agua = $_POST["litros_agua"];
$qualidade_sono = $_POST["qualidade_sono"];
$alimentacao_detalhada = $_POST["alimentacao_detalhada"];
$medicacao = $_POST["medicacao"];
$trombose = $_POST["trombose"];
$diabetes = $_POST["diabetes"];
$tratamento_realizou = $_POST["tratamento_realizou"];
$intestino = $_POST["intestino"];
$fototipo = $_POST["fototipo"];
$tipo_pele = $_POST["tipo_pele"];
$nivel_exposicao_radiacao = $_POST["nivel_exposicao_radiacao"];
$problemas_cardiacos = $_POST["problemas_cardiacos"];


$cpf_facial = $_POST["cpf_ficha_facial"];
$queixa_principal_facial = $_POST["queixa_facial"];
$usa_lente_facial = $_POST["usa_lente_facial"];
$gestante_facial = $_POST["gestante_facial"];
$contraceptivos_facial = $_POST["contraceptivos_facial"];
$qual_contraceptivo_facial = $_POST["qual_contraceptivo_facial"];
$hipertensao_facial = $_POST["hipertensao_facial"];
$ansiedade_facial = $_POST["ansiedade_facial"];
$sensivel_dor_facial = $_POST["sensivel_dor_facial"];
$cancer_pele_facial = $_POST["cancer_pele_facial"];
$botox_facial = $_POST["botox_facial"];
$botox_local_tempo_facial = $_POST["botox_local_tempo_facial"];
$tireoide_facial = $_POST["tireoide_facial"];
$protetor_solar_facial = $_POST["protetor_solar_facial"];
$protetor_solar_qual_freq_facial = $_POST["protetor_solar_qual_freq_facial"];
$alergias_facial = $_POST["alergias_facial"];
$quais_alergias_facial = $_POST["quais_alergias_facial"];
$disturbio_hormonal_facial = $_POST["disturbio_hormonal_facial"];
$qual_disturbio_facial = $_POST["qual_disturbio_facial"];
$marcapasso_facial = $_POST["marcapasso_facial"];
$menstruacao_facial = $_POST["menstruacao_facial"];
$classif_fototipo_facial = $_POST["classif_fototipo_facial"];
$classif_goglau_facial = $_POST["classif_goglau_facial"];
$goglau_estatica_facial = $_POST["goglau_estatica_facial"];
$goglau_dinamica_facial = $_POST["goglau_dinamica_facial"];
$grau_hidratacao_facial = $_POST["grau_hidratacao_facial"];
$textura_pele_facial = $_POST["textura_pele_facial"];
$grau_oleosidade_facial = $_POST["grau_oleosidade_facial"];
$acne_facial = $_POST["acne_facial"];

if (isset($_POST['habitos_vida_facial'])) {
    $habitos_vida = $_POST['habitos_vida_facial'];
    $habitos_vida_str = implode(",", $habitos_vida);
} else {
    $habitos_vida_str = NULL;
}

if (isset($_POST['evolucao_cutanea_facial'])) {
    $evolucao_cutanea = $_POST['evolucao_cutanea_facial'];
    $evolucao_cutanea_str = implode(",", $evolucao_cutanea);
} else {
    $evolucao_cutanea_str = NULL;
}

$olocal_facial = $_POST["local_facial"];

if (isset($_POST['alteracoes_epiderme_facial'])) {
    $alteracoes_epiderme = $_POST['alteracoes_epiderme_facial'];
    $alteracoes_epiderme_str = implode(",", $alteracoes_epiderme);
} else {
    $alteracoes_epiderme_str = NULL;
}

if (isset($_POST['lesoes_pele_facial'])) {
    $lesoes_pele = $_POST['lesoes_pele_facial'];
    $lesoes_pele_str = implode(",", $lesoes_pele);
} else {
    $lesoes_pele_str = NULL;
}

if (isset($_POST['cicatriz_facial'])) {
    $cicatriz = $_POST['cicatriz_facial'];
    $cicatriz_str = implode(",", $cicatriz);
} else {
    $cicatriz_str = NULL;
}

if (isset($_POST['pelos_facial'])) {
    $pelos = $_POST['pelos_facial'];
    $pelos_str = implode(",", $pelos);
} else {
    $pelos_str = NULL;
}

$sql_zerar_vetor = "UPDATE `ficha_anamnese_facial` SET `habitos_vida` = NULL, `evolucao_cutanea` = NULL, `alteracoes_epiderme` = NULL, 
`lesao_pele` = NULL, `cicatriz` = NULL, `pelos` = NULL WHERE `cliente` = '$cpf_facial'";

$conn->query($sql_zerar_vetor);


$olheiras_facial = $_POST["olheiras_facial"];
$observacao_olheiras_facial = $_POST["observacao_olheiras_facial"];
$video_foto_facial = $_POST["video_foto_facial"];
$protocolo_facial = $_POST["protocolo_facial"];
$antes_depois_facial = $_POST["antes_depois_facial"];
$redes_sociais_facial = $_POST["redes_sociais_facial"];
$acordo_tratamento_facial = $_POST["acordo_tratamento_facial"];

$sql_status_facial = $conn->prepare("SELECT status_ficha_facial FROM clientes WHERE cpf = ?");
$sql_status_facial->bind_param("s", $cpf_facial);
$sql_status_facial->execute();
$result_facial = $sql_status_facial->get_result();
$row_facial = $result_facial->fetch_assoc();
$status_facial = $row_facial['status_ficha_facial'];


if ($status_facial == 1) {
    $sql = "UPDATE ficha_anamnese_facial SET
    queixa_principal=?, usa_lente=?, gestante=?, contraceptivo=?, qual_contraceptivo=?, hipertensao=?, ansiedade=?, sensivel_dor=?, cancer_pele=?, habitos_vida=?, 
    botox=?, botox_local_tempo=?, tireoide=?, protetor_solar=?, protetor_solar_qual_freq=?, alergias=?, quais_alergias=?, disturbio_hormonal=?, qual_disturbio=?, marcapasso=?, 
    menstruacao=?, classif_fototipo=?, grau_hidratacao=?, textura_pele=?, grau_oleosidade=?, acne=?, evolucao_cutanea=?, local=?, classif_goglau=?, goglau_estatica=?, 
    goglau_dinamica=?, alteracoes_epiderme=?, lesao_pele=?, cicatriz=?, pelos=?, olheiras=?, observacao_olheiras=?, video_foto=?, protocolo=?, antes_depois=?, redes_sociais=?, acordo_tratamento=?
    WHERE cliente = ?";


    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param(
            "sssssssssssssssssssssssssssssssssssssssssss",
            $queixa_principal_facial,
            $usa_lente_facial,
            $gestante_facial,
            $contraceptivos_facial,
            $qual_contraceptivo_facial,
            $hipertensao_facial,
            $ansiedade_facial,
            $sensivel_dor_facial,
            $cancer_pele_facial,
            $habitos_vida_str,
            $botox_facial,
            $botox_local_tempo_facial,
            $tireoide_facial,
            $protetor_solar_facial,
            $protetor_solar_qual_freq_facial,
            $alergias_facial,
            $quais_alergias_facial,
            $disturbio_hormonal_facial,
            $qual_disturbio_facial,
            $marcapasso_facial,
            $menstruacao_facial,
            $classif_fototipo_facial,
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
            $cpf_facial
        );

        $sql_campos_comuns = "UPDATE campos_comuns SET
                uso_cosmetico=?,
                litros_agua=?,
                qualidade_sono=?, 
                alimentacao_detalhada=?,
                medicacao=?,
                trombose=?, 
                diabetes=?, 
                tratamento_realizou=?, 
                intestino=?, 
                fototipo=?, 
                tipo_pele=?,
                problemas_cardiacos=?,
                nivel_exposicao_radiacao=?
                WHERE cliente = ?";

        $stmt_campos_comuns = $conn->prepare($sql_campos_comuns);

        if ($stmt_campos_comuns) {
            $stmt_campos_comuns->bind_param(
                "ssssssssssssss",
                $uso_cosmetico,
                $litros_agua,
                $qualidade_sono,
                $alimentacao_detalhada,
                $medicacao,
                $trombose,
                $diabetes,
                $tratamento_realizou,
                $intestino,
                $fototipo,
                $tipo_pele,
                $problemas_cardiacos,
                $nivel_exposicao_radiacao,
                $cpf_facial
            );
        } else {
            echo "Erro ao preparar statement: " . $conn->error;
        }
    } else {
        echo "Erro ao preparar statement: " . $conn->error;
    }
} else {

    $sql = "INSERT INTO ficha_anamnese_facial 
    (cliente, queixa_principal, usa_lente, gestante, contraceptivo, qual_contraceptivo, hipertensao, ansiedade, sensivel_dor, cancer_pele, habitos_vida, 
    botox, botox_local_tempo, tireoide, protetor_solar, protetor_solar_qual_freq, alergias, quais_alergias, disturbio_hormonal, qual_disturbio, marcapasso, 
    menstruacao, classif_fototipo, grau_hidratacao, textura_pele, grau_oleosidade, acne, evolucao_cutanea, local, classif_goglau, goglau_estatica, 
    goglau_dinamica, alteracoes_epiderme, lesao_pele, cicatriz, pelos, olheiras, observacao_olheiras, video_foto, protocolo, antes_depois, redes_sociais, acordo_tratamento)
    VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";


    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param(
            "sssssssssssssssssssssssssssssssssssssssssss",
            $cpf_facial,
            $queixa_principal_facial,
            $usa_lente_facial,
            $gestante_facial,
            $contraceptivos_facial,
            $qual_contraceptivo_facial,
            $hipertensao_facial,
            $ansiedade_facial,
            $sensivel_dor_facial,
            $cancer_pele_facial,
            $habitos_vida_str,
            $botox_facial,
            $botox_local_tempo_facial,
            $tireoide_facial,
            $protetor_solar_facial,
            $protetor_solar_qual_freq_facial,
            $alergias_facial,
            $quais_alergias_facial,
            $disturbio_hormonal_facial,
            $qual_disturbio_facial,
            $marcapasso_facial,
            $menstruacao_facial,
            $classif_fototipo_facial,
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
        );

        $sql_campos_status = $conn->query("SELECT `status_comuns` FROM `clientes` WHERE `cpf` =  '$cpf_facial'");
        $row = $sql_campos_status->fetch_assoc();
        $campos_status = $row['status_comuns'];

        if ($campos_status == 0) {
            $sql_campos_comuns = "INSERT INTO campos_comuns (
                uso_cosmetico,
                litros_agua,
                qualidade_sono, 
                alimentacao_detalhada,
                medicacao,
                trombose, 
                diabetes, 
                tratamento_realizou, 
                intestino, 
                fototipo, 
                tipo_pele,
                problemas_cardiacos,
                nivel_exposicao_radiacao,
                cliente)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

            $update = $conn->prepare("UPDATE clientes SET status_comuns = 1 WHERE cpf = ?");
            $update->bind_param("s", $cpf_facial);
            $update->execute();
        } else {
            $sql_campos_comuns = "UPDATE campos_comuns SET
                uso_cosmetico=?,
                litros_agua=?,
                qualidade_sono=?, 
                alimentacao_detalhada=?,
                medicacao=?,
                trombose=?, 
                diabetes=?, 
                tratamento_realizou=?, 
                intestino=?, 
                fototipo=?, 
                tipo_pele=?,
                problemas_cardiacos=?,
                nivel_exposicao_radiacao=?
                WHERE cliente = ?";
        }
        $stmt_campos_comuns = $conn->prepare($sql_campos_comuns);

        if ($stmt_campos_comuns) {
            $stmt_campos_comuns->bind_param(
                "ssssssssssssss",
                $uso_cosmetico,
                $litros_agua,
                $qualidade_sono,
                $alimentacao_detalhada,
                $medicacao,
                $trombose,
                $diabetes,
                $tratamento_realizou,
                $intestino,
                $fototipo,
                $tipo_pele,
                $problemas_cardiacos,
                $nivel_exposicao_radiacao,
                $cpf_facial
            );
        } else {
            echo "Erro ao preparar statement: " . $conn->error;
        }
    } else {
        echo "Erro ao preparar statement: " . $conn->error;
    }
}

$executou_principal = $stmt->execute();
$executou_campos = $stmt_campos_comuns ? $stmt_campos_comuns->execute() : true;

if ($executou_principal && $executou_campos) {
    if ($status_facial == 0) {
        $update = $conn->prepare("UPDATE clientes SET status_ficha_facial = 1 WHERE cpf = ?");
        $update->bind_param("s", $cpf_facial);
        $update->execute();
    }
    header("Location: anamnese_facial_pesquisa.php");
    exit;
} else {
    echo "Erro ao inserir dados: " . $stmt->error;
}
