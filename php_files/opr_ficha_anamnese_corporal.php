<?php
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
