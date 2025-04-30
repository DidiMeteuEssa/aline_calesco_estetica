
<?php

$opr = $_POST["opr"];

switch($opr)
{
    case '1':
            opr_corporal();
            break;
    case '2':
            opr_facial();
            break;
    case '3':
            opr_melasma(); 
            break;
}

function opr_corporal()
{
    include("conexao_db.php");
    $cpf = $_POST["cpf_ficha_corporal"];
    //
    $uso_cosmetico = $_POST["uso_cosmetico"];

    $fumante = $_POST["fumante"];
    //
    $diureticos = $_POST["diureticos"];
    //
    $litros_agua = $_POST["litros_agua"];
    //
    $qualidade_sono = $_POST["qualidade_sono"];
    //
    $alimentacao_detalhada = $_POST["alimentacao_detalhada"];

    $dieta = $_POST["dieta"];
    $patologia_pele = $_POST["patologia_pele"];
    //
    $medicacao = $_POST["medicacao"];

    $suplemento_oral = $_POST["suplemento_oral"];
    $quais_suplementos = $_POST["quais_suplementos"];
    //
    $trombose = $_POST["trombose"];

    $antecedentes_oncologico = $_POST["antecedentes_oncologico"];
    //
    $diabetes = $_POST["diabetes"];

    $cirurgia_plastica = $_POST["cirurgia_plastica"];
    $qual_cirurgia = $_POST["qual_cirurgia"];
    $queixa_alopecia = $_POST["queixa_alopecia"];
    $acomete_corpo = $_POST["acomete_corpo"];
    $qual_parte_corpo = $_POST["qual_parte_corpo"];
    $tempo_disfuncao = $_POST["tempo_disfuncao"];
    $status_doenca = $_POST["status_doenca"];

    $sql_status = $conn->prepare("SELECT status_ficha_corporal FROM clientes WHERE cpf = ?");
    $sql_status->bind_param("s", $cpf);
    $sql_status->execute();
    $result = $sql_status->get_result();
    $row = $result->fetch_assoc();
    $status = $row['status_ficha_corporal'];

    if ($status == 1) {
        $sql = "UPDATE ficha_anamnese_corporal SET
    fumante = ?,
    dieta_rigorosa = ?,
    patologia_pele = ?,
    usa_suplemento_oral = ?,
    qual_suplemento_oral = ?,
    antecendentes_oncologicos = ?,
    cirurgia_plastica_estetica = ?,
    qual_cirurgia_plastica = ?,
    queixa_alopecia = ?,
    doenca_acomete_corpo = ?,
    qual_doenca_acomete_corpo = ?,
    tempo_disfuncao = ?,
    status_disfuncao = ?
WHERE cliente = ?";

        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param(
                "ssssssssssssss",
                $fumante,
                $dieta,
                $patologia_pele,
                $suplemento_oral,
                $quais_suplementos,
                $antecedentes_oncologico,
                $cirurgia_plastica,
                $qual_cirurgia,
                $queixa_alopecia,
                $acomete_corpo,
                $qual_parte_corpo,
                $tempo_disfuncao,
                $status_doenca,
                $cpf
            );

            $sql_campos_comuns = "UPDATE campos_comuns SET
        uso_cosmetico = ?,
        diureticos = ?,
        litros_agua = ?,
        qualidade_sono = ?,
        alimentacao_detalhada = ?,
        medicacao = ?,
        trombose = ?,
        diabetes = ?
        WHERE cliente = ?";

            $stmt_campos_comuns = $conn->prepare($sql_campos_comuns);

            if ($stmt_campos_comuns) {
                $stmt_campos_comuns->bind_param(
                    "sssssssss",
                    $uso_cosmetico,
                    $diureticos,
                    $litros_agua,
                    $qualidade_sono,
                    $alimentacao_detalhada,
                    $medicacao,
                    $trombose,
                    $diabetes,
                    $cpf,
                );
            } else {
                echo "Erro ao preparar statement: " . $conn->error;
            }
        }
    } else {
        $sql = "INSERT INTO ficha_anamnese_corporal (
    cliente,
    fumante,
    dieta_rigorosa,
    patologia_pele,
    usa_suplemento_oral,
    qual_suplemento_oral,
    antecendentes_oncologicos,
    cirurgia_plastica_estetica,
    qual_cirurgia_plastica,
    queixa_alopecia,
    doenca_acomete_corpo,
    qual_doenca_acomete_corpo,
    tempo_disfuncao,
    status_disfuncao
    ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param(
                "ssssssssssssss",
                $cpf,
                $fumante,
                $dieta,
                $patologia_pele,
                $suplemento_oral,
                $quais_suplementos,
                $antecedentes_oncologico,
                $cirurgia_plastica,
                $qual_cirurgia,
                $queixa_alopecia,
                $acomete_corpo,
                $qual_parte_corpo,
                $tempo_disfuncao,
                $status_doenca
            );

            $sql_campos_status = $conn->query("SELECT `status_comuns` FROM `clientes` WHERE `cpf` =  '$cpf'");
            $row = $sql_campos_status->fetch_assoc();
            $campos_status = $row['status_comuns'];

            if ($campos_status == 0) {
                $sql_campos_comuns = "INSERT INTO campos_comuns (
                uso_cosmetico,
                diureticos,
                litros_agua,
                qualidade_sono,
                alimentacao_detalhada,
                medicacao,
                trombose,
                diabetes,
                cliente)
                VALUES (?,?,?,?,?,?,?,?,?)";

                $update = $conn->prepare("UPDATE clientes SET status_comuns = 1 WHERE cpf = ?");
                $update->bind_param("s", $cpf);
                $update->execute();
            } else {
                $sql_campos_comuns = "UPDATE campos_comuns SET
                uso_cosmetico = ?,
                diureticos = ?,
                litros_agua = ?,
                qualidade_sono = ?,
                alimentacao_detalhada = ?,
                medicacao = ?,
                trombose = ?,
                diabetes = ?
                WHERE cliente = ?";
            }
            $stmt_campos_comuns = $conn->prepare($sql_campos_comuns);

            if ($stmt_campos_comuns) {
                $stmt_campos_comuns->bind_param(
                    "sssssssss",
                    $uso_cosmetico,
                    $diureticos,
                    $litros_agua,
                    $qualidade_sono,
                    $alimentacao_detalhada,
                    $medicacao,
                    $trombose,
                    $diabetes,
                    $cpf
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
        if ($status == 0) {
            $update = $conn->prepare("UPDATE clientes SET status_ficha_corporal = 1 WHERE cpf = ?");
            $update->bind_param("s", $cpf);
            $update->execute();
        }
        header("Location: anamnese_corporal_pesquisa.php");
        exit;
    } else {
        echo "Erro ao inserir dados: " . $stmt->error;
    }
}

function opr_facial()
{
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
}

function opr_melasma()
{
    include("conexao_db.php");

    /*
"medicacao
tipo pele
fototipo
ja tratamento
alimentacao
agua
diuretico
sono
nivel radaao
intestino
 */

    $medicacao = $_POST["medicacao"];
    $tipo_pele = $_POST["tipo_pele"];
    $fototipo = $_POST["fototipo"];
    $tratamento_realizou = $_POST["tratamento_realizou"];
    $alimentacao_detalhada = $_POST["alimentacao_detalhada"];
    $litros_agua = $_POST["litros_agua"];
    $diureticos = $_POST["diureticos"];
    $qualidade_sono = $_POST["qualidade_sono"];
    $nivel_exposicao_radiacao = $_POST["nivel_exposicao_radiacao"];
    $intestino = $_POST["intestino"];

    $cpf = $_POST["cpf_ficha_melasma"];
    $data_hoje_melasma = $_POST["data_hoje_melasma"];
    $como_conheceu_trabalho_melasma = $_POST["como_conheceu_trabalho_melasma"];
    $filhos_melasma = $_POST["filhos_melasma"];
    $casada_melasma = $_POST["casada_melasma"];
    $casamento_saudavel_melasma = $_POST["casamento_saudavel_melasma"];
    $queixa_principal_melasma = $_POST["queixa_principal_melasma"];
    $tempo_percebeu_manchas_melasma = $_POST["tempo_percebeu_manchas_melasma"];
    $tratou_melasma_melasma = $_POST["tratou_melasma_melasma"];
    $uso_acido_melasma = $_POST["uso_acido_melasma"];
    $problemas_saude_melasma = $_POST["problemas_saude_melasma"];
    $tipo_melanina_melasma = $_POST["tipo_melanina_melasma"];
    $reacao_sol_melasma = $_POST["reacao_sol_melasma"];
    $temperatura_media_melasma = $_POST["temperatura_media_melasma"];
    $uso_cosmetico_rotina_skincare_melasma = $_POST["uso_cosmetico_rotina_skincare_melasma"];
    $rotina_dia_melasma = $_POST["rotina_dia_melasma"];
    $rotina_noite_melasma = $_POST["rotina_noite_melasma"];
    $exercicios_melasma = $_POST["exercicios_melasma"];
    $usa_secador_chapinha_melasma = $_POST["usa_secador_chapinha_melasma"];
    $concorda_troca_melasma = $_POST["concorda_troca_melasma"];
    $indicacao_plano_tratamento_melasma = $_POST["indicacao_plano_tratamento_melasma"];
    $indicacao_nutraceticos_orais_melasma = $_POST["indicacao_nutraceticos_orais_melasma"];
    $indicacao_skin_care_melasma = $_POST["indicacao_skin_care_melasma"];
    $indicacao_equipe_multidisciplinar_melasma = $_POST["indicacao_equipe_multidisciplinar_melasma"];
    $pontos_acordados_melasma = $_POST["pontos_acordados_melasma"];
    $constatacao_raiz_problema_melasma = $_POST["constatacao_raiz_problema_melasma"];


    $sql_status = $conn->prepare("SELECT status_ficha_melasma FROM clientes WHERE cpf = ?");
    $sql_status->bind_param("s", $cpf);
    $sql_status->execute();
    $result = $sql_status->get_result();
    $row = $result->fetch_assoc();
    $status_melasma = $row['status_ficha_melasma'];

    $data_mysql_melasma = date('Y-m-d', strtotime(str_replace('/', '-', $data_hoje_melasma)));

    if ($status_melasma == 1) {
        $sql = "UPDATE ficha_melasma SET 
        data_hoje=?, como_conheceu_trabalho=?, filhos=?, casada=?, casamento_saudavel=?, queixa_principal=?, tempo_percebeu_manchas=?,
        tratou_melasma=?, uso_acido=?, problemas_saude=?, tipo_melanina=?, reacao_sol=?, temperatura_media=?, uso_cosmetico_rotina_skincare=?, rotina_dia=?, 
        rotina_noite=?, exercicios=?, usa_secador_chapinha=?, concorda_troca=?, indicacao_plano_tratamento=?, indicacao_skin_care=?,
        indicacao_equipe_multidisciplinar=?, indicacao_nutraceticos_orais=?, pontos_acordados=?, constatacao_raiz_problema=?
        WHERE cliente = ?";

        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param(
                "ssssssssssssssssssssssssss",
                $data_mysql_melasma,
                $como_conheceu_trabalho_melasma,
                $filhos_melasma,
                $casada_melasma,
                $casamento_saudavel_melasma,
                $queixa_principal_melasma,
                $tempo_percebeu_manchas_melasma,
                $tratou_melasma_melasma,
                $uso_acido_melasma,
                $problemas_saude_melasma,
                $tipo_melanina_melasma,
                $reacao_sol_melasma,
                $temperatura_media_melasma,
                $uso_cosmetico_rotina_skincare_melasma,
                $rotina_dia_melasma,
                $rotina_noite_melasma,
                $exercicios_melasma,
                $usa_secador_chapinha_melasma,
                $concorda_troca_melasma,
                $indicacao_plano_tratamento_melasma,
                $indicacao_skin_care_melasma,
                $indicacao_equipe_multidisciplinar_melasma,
                $indicacao_nutraceticos_orais_melasma,
                $pontos_acordados_melasma,
                $constatacao_raiz_problema_melasma,
                $cpf
            );

            $sql_campos_comuns = "UPDATE campos_comuns SET
        medicacao=?,
        tipo_pele=?,
        fototipo=?,
        tratamento_realizou=?,
        alimentacao_detalhada=?,
        litros_agua=?,
        diureticos=?,
        qualidade_sono=?,
        nivel_exposicao_radiacao=?,
        intestino=?
        WHERE cliente = ?";

            $stmt_campos_comuns = $conn->prepare($sql_campos_comuns);

            if ($stmt_campos_comuns) {
                $stmt_campos_comuns->bind_param(
                    "sssssssssss",
                    $medicacao,
                    $tipo_pele,
                    $fototipo,
                    $tratamento_realizou,
                    $alimentacao_detalhada,
                    $litros_agua,
                    $diureticos,
                    $qualidade_sono,
                    $nivel_exposicao_radiacao,
                    $intestino,
                    $cpf
                );
            } else {
                echo "Erro ao preparar statement: " . $conn->error;
            }
        } else {
            echo "Erro ao preparar statement: " . $conn->error;
        }
    } else {

        $sql = "INSERT INTO ficha_melasma (
        cliente, data_hoje, como_conheceu_trabalho, filhos, casada, casamento_saudavel, queixa_principal, tempo_percebeu_manchas,
        tratou_melasma, uso_acido, problemas_saude, tipo_melanina, reacao_sol, temperatura_media, uso_cosmetico_rotina_skincare, rotina_dia, 
        rotina_noite, exercicios, usa_secador_chapinha, concorda_troca, indicacao_plano_tratamento, indicacao_skin_care,
        indicacao_equipe_multidisciplinar, indicacao_nutraceticos_orais, pontos_acordados, constatacao_raiz_problema) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param(
                "ssssssssssssssssssssssssss",
                $cpf,
                $data_mysql_melasma,
                $como_conheceu_trabalho_melasma,
                $filhos_melasma,
                $casada_melasma,
                $casamento_saudavel_melasma,
                $queixa_principal_melasma,
                $tempo_percebeu_manchas_melasma,
                $tratou_melasma_melasma,
                $uso_acido_melasma,
                $problemas_saude_melasma,
                $tipo_melanina_melasma,
                $reacao_sol_melasma,
                $temperatura_media_melasma,
                $uso_cosmetico_rotina_skincare_melasma,
                $rotina_dia_melasma,
                $rotina_noite_melasma,
                $exercicios_melasma,
                $usa_secador_chapinha_melasma,
                $concorda_troca_melasma,
                $indicacao_plano_tratamento_melasma,
                $indicacao_skin_care_melasma,
                $indicacao_equipe_multidisciplinar_melasma,
                $indicacao_nutraceticos_orais_melasma,
                $pontos_acordados_melasma,
                $constatacao_raiz_problema_melasma,
            );

            $sql_campos_status = $conn->query("SELECT `status_comuns` FROM `clientes` WHERE `cpf` =  '$cpf'");
            $row = $sql_campos_status->fetch_assoc();
            $campos_status = $row['status_comuns'];

            if ($campos_status == 0) {
                $sql_campos_comuns = "INSERT INTO campos_comuns (
                medicacao,
                tipo_pele,
                fototipo,
                tratamento_realizou,
                alimentacao_detalhada,
                litros_agua,
                diureticos,
                qualidade_sono,
                nivel_exposicao_radiacao,
                intestino,
                cliente)
                VALUES (?,?,?,?,?,?,?,?,?,?,?)";

                $update = $conn->prepare("UPDATE clientes SET status_comuns = 1 WHERE cpf = ?");
                $update->bind_param("s", $cpf);
                $update->execute();
            } else {
                $sql_campos_comuns = "UPDATE campos_comuns SET
                medicacao=?,
                tipo_pele=?,
                fototipo=?,
                tratamento_realizou=?,
                alimentacao_detalhada=?,
                litros_agua=?,
                diureticos=?,
                qualidade_sono=?,
                nivel_exposicao_radiacao=?,
                intestino=?
                WHERE cliente = ?";
            }
            $stmt_campos_comuns = $conn->prepare($sql_campos_comuns);

            if ($stmt_campos_comuns) {
                $stmt_campos_comuns->bind_param(
                    "sssssssssss",
                    $medicacao,
                    $tipo_pele,
                    $fototipo,
                    $tratamento_realizou,
                    $alimentacao_detalhada,
                    $litros_agua,
                    $diureticos,
                    $qualidade_sono,
                    $nivel_exposicao_radiacao,
                    $intestino,
                    $cpf
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
        if ($status_melasma == 0) {
            $update = $conn->prepare("UPDATE clientes SET status_ficha_melasma = 1 WHERE cpf = ?");
            $update->bind_param("s", $cpf);
            $update->execute();
        }
        header("Location: melasma_pesquisa.php");
        exit;
    } else {
        echo "Erro ao inserir dados: " . $stmt->error;
    }
}
