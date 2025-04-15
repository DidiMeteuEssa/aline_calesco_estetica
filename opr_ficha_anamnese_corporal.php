<?php
include("conexao_db.php");

$id = 1;
$cpf = $_POST["cpf_ficha_corporal"];
$usa_cosmetico = $_POST["usa_cosmetico"];
$qual_cosmetico = $_POST["qual_cosmeticos"];
$fumante = $_POST["fumante"];
$ingere_alcool = $_POST["ingere_alcool"];
$qtde_agua = $_POST["qtde_agua"];
$qualidade_sono = $_POST["qualidade_sono"];
$qualidade_alimentacao = $_POST["qualidade_alimentacao"];
$dieta = $_POST["dieta"];
$patologia_pele = $_POST["patologia_pele"];
$toma_medicamento = $_POST["toma_medicamento"];
$qual_medicamento = $_POST["qual_medicamento"];
$tempo_medicacao = $_POST["tempo_medicacao"];
$suplemento_oral = $_POST["suplemento_oral"];
$quais_suplementos = $_POST["quais_suplementos"];
$trombose = $_POST["trombose"];
$qual_trombose = $_POST["qual_trombose"];
$antecedentes_oncologico = $_POST["antecedentes_oncologico"];
$diabetes = $_POST["diabetes"];
$qual_diabetes = $_POST["qual_diabetes"];
$cirurgia_plastica = $_POST["cirurgia_plastica"];
$qual_cirurgia = $_POST["qual_cirurgia"];
$queixa_alopecia = $_POST["queixa_alopecia"];
$acomete_corpo = $_POST["acomete_corpo"];
$qual_parte_corpo = $_POST["qual_parte_corpo"];
$tempo_disfuncao = $_POST["tempo_disfuncao"];
$status_doenca = $_POST["status_doenca"];

$sql_status = "select status_ficha_corporal from clientes where cpf = $cpf";

if ($sql_status == 1) {
    $sql = "UPDATE ficha_anamnese_corporal SET
    usa_cosmetico = ?,
    qual_cosmetico = ?,
    fumante = ?,
    ingere_alcool = ?,
    qtde_copos_agua = ?,
    qualidade_sono = ?,
    qualidade_alientacao = ?,
    dieta_rigorosa = ?,
    patologia_pele = ?,
    toma_medicacao = ?,
    qual_medicacao = ?,
    quanto_tempo_medicacao = ?,
    usa_suplemento_oral = ?,
    qual_suplemento_oral = ?,
    trombose = ?,
    qual_trombose = ?,
    antecendentes_oncologicos = ?,
    diabetes = ?,
    qual_diabetes = ?,
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
    }
} else {
    $sql = "INSERT INTO ficha_anamnese_corporal (
        id,
        cliente,
        usa_cosmetico,
        qual_cosmetico,
        fumante,
        ingere_alcool,
        qtde_copos_agua,
        qualidade_sono,
        qualidade_alientacao,
        dieta_rigorosa,
        patologia_pele,
        toma_medicacao,
        qual_medicacao,
        quanto_tempo_medicacao,
        usa_suplemento_oral,
        qual_suplemento_oral,
        trombose,
        qual_trombose,
        antecendentes_oncologicos,
        diabetes,
        qual_diabetes,
        cirurgia_plastica_estetica,
        qual_cirurgia_plastica,
        queixa_alopecia,
        doenca_acomete_corpo,
        qual_doenca_acomete_corpo,
        tempo_disfuncao,
        status_disfuncao
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param(
            "isssssssssssssssssssssssssss",
            $id,
            $cpf,
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
            $status_doenca
        );
    } else {
        echo "Erro ao preparar statement: " . $conn->error;
    }

    if ($stmt->execute()) {
        if ($sql_status === 0) {
            $update = $conn->prepare("UPDATE clientes SET status_ficha_corporal= 1 WHERE cpf = ?");
            $update->bind_param("s", $cpf);
            $update->execute();
        }
        header("Location: anamnese_corporal_pesquisa.php");
        exit;
    } else {
        echo "Erro ao inserir dados: " . $stmt->error;
    }
}
