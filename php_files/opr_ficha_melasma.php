<?php
include("conexao_db.php");

$cpf = $_POST["cpf_ficha_melasma"];
$data_hoje_melasma = $_POST["data_hoje_melasma"];
$como_conheceu_trabalho_melasma = $_POST["como_conheceu_trabalho_melasma"];
$filhos_melasma = $_POST["filhos_melasma"];
$casada_melasma = $_POST["casada_melasma"];
$casamento_saudavel_melasma = $_POST["casamento_saudavel_melasma"];
$queixa_principal_melasma = $_POST["queixa_principal_melasma"];
$tempo_percebeu_melasma = $_POST["tempo_percebeu_melasma"];
$tempo_percebeu_manchas_melasma = $_POST["tempo_percebeu_manchas_melasma"];
$tratou_melasma_melasma = $_POST["tratou_melasma_melasma"];
$uso_acido_melasma = $_POST["uso_acido_melasma"];
$problemas_saude_melasma = $_POST["problemas_saude_melasma"];
$medicacao_melasma = $_POST["medicacao_melasma"];
$tipo_pele_melasma = $_POST["tipo_pele_melasma"];
$fototipo_melasma = $_POST["fototipo_melasma"];
$tipo_melanina_melasma = $_POST["tipo_melanina_melasma"];
$reacao_sol_melasma = $_POST["reacao_sol_melasma"];
$nivel_exposicao_radiacao_melasma = $_POST["nivel_exposicao_radiacao_melasma"];
$temperatura_media_melasma = $_POST["temperatura_media_melasma"];
$tratamentos_ja_realizou_melasma = $_POST["tratamentos_ja_realizou_melasma"];
$uso_cosmetico_rotina_skincare_melasma = $_POST["uso_cosmetico_rotina_skincare_melasma"];
$rotina_dia_melasma = $_POST["rotina_dia_melasma"];
$rotina_noite_melasma = $_POST["rotina_noite_melasma"];
$alimentacao_detalhada_melasma = $_POST["alimentacao_detalhada_melasma"];
$qtde_agua_melasma = $_POST["qtde_agua_melasma"];
$ingere_diuretico_melasma = $_POST["ingere_diuretico_melasma"];
$sono_melasma = $_POST["sono_melasma"];
$exercicios_melasma = $_POST["exercicios_melasma"];
$usa_secador_chapinha_melasma = $_POST["usa_secador_chapinha_melasma"];
$funcionamento_intestinal_melasma = $_POST["funcionamento_intestinal_melasma"];
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

if ($status_melasma === 1) {
    $sql = "UPDATE ficha_melasma SET
    data_hoje=?, como_conheceu_trabalho=?, filhos=?, casada=?, casamento_saudavel=?, queixa_principal=?, tempo_percebeu=?, tempo_percebeu_manchas=?,
    tratou_melasma=?, uso_acido=?, problemas_saude=?, medicacao=?, tipo_pele=?, fototipo=?, tipo_melanina=?, reacao_sol=?, nivel_exposicao_radiacao=?, 
    temperatura_media=?, tratamentos_ja_realizou=?, uso_cosmetico_rotina_skincare=?, rotina_dia=?, rotina_noite=?, alimentacao_detalhada=?, qtde_agua=?,
    ingere_diuretico=?, sono=?, exercicios=?, usa_secador_chapinha=?, funcionamento_intestinal=?, concorda_troca=?, indicacao_plano_tratamento=?, indicacao_skin_care=?,
    indicacao_equipe_multidisciplinar=?, indicacao_nutraceticos_orais=?, pontos_acordados=?, constatacao_raiz_problema=?
WHERE cliente = ?";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param(
            "sssssssssssssssssssssssssssssssssssss",
            $data_mysql_melasma,
            $como_conheceu_trabalho_melasma,
            $filhos_melasma,
            $casada_melasma,
            $casamento_saudavel_melasma,
            $queixa_principal_melasma,
            $tempo_percebeu_melasma,
            $tempo_percebeu_manchas_melasma,
            $tratou_melasma_melasma,
            $uso_acido_melasma,
            $problemas_saude_melasma,
            $medicacao_melasma,
            $tipo_pele_melasma,
            $fototipo_melasma,
            $tipo_melanina_melasma,
            $reacao_sol_melasma,
            $nivel_exposicao_radiacao_melasma,
            $temperatura_media_melasma,
            $tratamentos_ja_realizou_melasma,
            $uso_cosmetico_rotina_skincare_melasma,
            $rotina_dia_melasma,
            $rotina_noite_melasma,
            $alimentacao_detalhada_melasma,
            $qtde_agua_melasma,
            $ingere_diuretico_melasma,
            $sono_melasma,
            $exercicios_melasma,
            $usa_secador_chapinha_melasma,
            $funcionamento_intestinal_melasma,
            $concorda_troca_melasma,
            $indicacao_plano_tratamento_melasma,
            $indicacao_skin_care_melasma,
            $indicacao_equipe_multidisciplinar_melasma,
            $indicacao_nutraceticos_orais_melasma,
            $pontos_acordados_melasma,
            $constatacao_raiz_problema_melasma,
            $cpf
        );
    } else {
        echo "Erro ao preparar statement: " . $conn->error;
    }
} else {
    $sql = "INSERT INTO ficha_melasma (
        cliente, data_hoje, como_conheceu_trabalho, filhos, casada, casamento_saudavel, queixa_principal, tempo_percebeu, tempo_percebeu_manchas,
        tratou_melasma, uso_acido, problemas_saude, medicacao, tipo_pele, fototipo, tipo_melanina, reacao_sol, nivel_exposicao_radiacao, 
        temperatura_media, tratamentos_ja_realizou, uso_cosmetico_rotina_skincare, rotina_dia, rotina_noite, alimentacao_detalhada, qtde_agua,
        ingere_diuretico, sono, exercicios, usa_secador_chapinha, funcionamento_intestinal, concorda_troca, indicacao_plano_tratamento, indicacao_skin_care,
        indicacao_equipe_multidisciplinar, indicacao_nutraceticos_orais, pontos_acordados, constatacao_raiz_problema) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param(
            "sssssssssssssssssssssssssssssssssssss",
            $cpf,
            $data_mysql_melasma,
            $como_conheceu_trabalho_melasma,
            $filhos_melasma,
            $casada_melasma,
            $casamento_saudavel_melasma,
            $queixa_principal_melasma,
            $tempo_percebeu_melasma,
            $tempo_percebeu_manchas_melasma,
            $tratou_melasma_melasma,
            $uso_acido_melasma,
            $problemas_saude_melasma,
            $medicacao_melasma,
            $tipo_pele_melasma,
            $fototipo_melasma,
            $tipo_melanina_melasma,
            $reacao_sol_melasma,
            $nivel_exposicao_radiacao_melasma,
            $temperatura_media_melasma,
            $tratamentos_ja_realizou_melasma,
            $uso_cosmetico_rotina_skincare_melasma,
            $rotina_dia_melasma,
            $rotina_noite_melasma,
            $alimentacao_detalhada_melasma,
            $qtde_agua_melasma,
            $ingere_diuretico_melasma,
            $sono_melasma,
            $exercicios_melasma,
            $usa_secador_chapinha_melasma,
            $funcionamento_intestinal_melasma,
            $concorda_troca_melasma,
            $indicacao_plano_tratamento_melasma,
            $indicacao_skin_care_melasma,
            $indicacao_equipe_multidisciplinar_melasma,
            $indicacao_nutraceticos_orais_melasma,
            $pontos_acordados_melasma,
            $constatacao_raiz_problema_melasma,
        );
    } else {
        echo "Erro ao preparar statement: " . $conn->error;
    }
}

if ($stmt->execute()) {
    if ($status_melasma === 0) {
        $update = $conn->prepare("UPDATE clientes SET status_ficha_melasma = 1 WHERE cpf = ?");
        $update->bind_param("s", $cpf);
        $update->execute();
    }
    header("Location: melasma_pesquisa.php");
    exit;
} else {
    echo "Erro ao inserir dados: " . $stmt->error;
}
