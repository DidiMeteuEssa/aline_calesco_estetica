<?php
include("conexao_db.php");

$cpf = $_POST["cpf_ficha_corporal"];


$sql_status = $conn->prepare("SELECT status_ficha_melasma FROM clientes WHERE cpf = ?");
$sql_status->bind_param("s", $cpf);
$sql_status->execute();
$result = $sql_status->get_result();
$row = $result->fetch_assoc();
$status_melasma = $row['status_ficha_melasma'];

if ($status === 1) {
    $sql = "UPDATE ficha_anamnese_melasma SET
    
WHERE cliente = ?";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param(
            "s",
            
            $cpf
        );
    } else {
        echo "Erro ao preparar statement: " . $conn->error;
    }
} else {
    $sql = "INSERT INTO ficha_anamnese_melasma (
        
    ) VALUES ()";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param(
            "s",
            $cpf,
            
        );
    } else {
        echo "Erro ao preparar statement: " . $conn->error;
    }
}

if ($stmt->execute()) {
    if ($status === 0) {
        $update = $conn->prepare("UPDATE clientes SET status_ficha_melasma = 1 WHERE cpf = ?");
        $update->bind_param("s", $cpf);
        $update->execute();
    }
    header("Location: melasma_pesquisa.php");
    exit;
} else {
    echo "Erro ao inserir dados: " . $stmt->error;
}
