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
$profissao = $_POST["profissao"];
$como_conheceu_trabalho = $_POST["como_conheceu_trabalho"];
$tel_res = $_POST["tel_res"];
$tel_com = $_POST["tel_com"];
$celular = $_POST["celular"];

$data_mysql = date('Y-m-d', strtotime(str_replace('/', '-', $data_nasc)));

$sql = "INSERT INTO `clientes` (`cpf`, `nome`, `data_nasc`, `idade`, `endereco`, `cep`, `bairro`,
                                `cidade`, `estado`, `profissao`, `tel_res`, `tel_com`, `tel_cel`) 
                                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?);";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("sssisssssssss",
        $cpf,
        $nome,
        $data_mysql,
        $idade,
        $endereco,
        $cep,
        $bairro,
        $cidade,
        $estado,
        $profissao,
        $tel_res,
        $tel_com,
        $celular);
    $stmt->execute();
    header("Location: ../index.php");
} else {
    echo "Erro ao cadastrar usuário.";
}
