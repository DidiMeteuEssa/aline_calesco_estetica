<?php
include("conexao_db.php");

$nome = $_POST["nome"];
$cpf = $_POST["cpf"];
$data_nasc = $_POST["data_nasc"];
$idade = $_POST["idade"];
$endereco = $_POST["endereco"];
$cep = $_POST["cep"];
$bairro = $_POST["bairro"];
$cidade = $_POST["cidade"];
$estado = $_POST["estado"];
$tel_res = $_POST["tel_res"];
$tel_com = $_POST["tel_com"];
$celular = $_POST["celular"];

$sql = "INSERT INTO `clientes` (`cpf`, `nome`, `data_nasc`, `idade`, `endereco`, `cep`, `bairro`,
                                `cidade`, `estado`, `tel_res`, `tel_com`, `tel_cel`) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("sssissssssss",
        $cpf,
        $nome,
        $data_nasc,
        $idade,
        $endereco,
        $cep,
        $bairro,
        $cidade,
        $estado,
        $tel_res,
        $tel_com,
        $celular);
    $stmt->execute();
    header("Location: cadastro_clientes.php");
} else {
    echo "Erro ao cadastrar usuário.";
}
