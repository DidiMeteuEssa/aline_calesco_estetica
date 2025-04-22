<?php
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
$tempo_percebeu_melasma = $_POST["tempo_percebeu_melasma"];
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
        data_hoje=?, como_conheceu_trabalho=?, filhos=?, casada=?, casamento_saudavel=?, queixa_principal=?, tempo_percebeu=?, tempo_percebeu_manchas=?,
        tratou_melasma=?, uso_acido=?, problemas_saude=?, tipo_melanina=?, reacao_sol=?, temperatura_media=?, uso_cosmetico_rotina_skincare=?, rotina_dia=?, 
        rotina_noite=?, exercicios=?, usa_secador_chapinha=?, concorda_troca=?, indicacao_plano_tratamento=?, indicacao_skin_care=?,
        indicacao_equipe_multidisciplinar=?, indicacao_nutraceticos_orais=?, pontos_acordados=?, constatacao_raiz_problema=?
        WHERE cliente = ?";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param(
            "sssssssssssssssssssssssssss",
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
        cliente, data_hoje, como_conheceu_trabalho, filhos, casada, casamento_saudavel, queixa_principal, tempo_percebeu, tempo_percebeu_manchas,
        tratou_melasma, uso_acido, problemas_saude, tipo_melanina, reacao_sol, temperatura_media, uso_cosmetico_rotina_skincare, rotina_dia, 
        rotina_noite, exercicios, usa_secador_chapinha, concorda_troca, indicacao_plano_tratamento, indicacao_skin_care,
        indicacao_equipe_multidisciplinar, indicacao_nutraceticos_orais, pontos_acordados, constatacao_raiz_problema) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param(
            "sssssssssssssssssssssssssss",
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
