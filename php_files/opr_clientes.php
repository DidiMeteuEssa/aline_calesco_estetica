<?php

$opr_cliente = $_POST["opr_cliente"];

switch ($opr_cliente) {
    case 1:
        opr_cadastro();
        break;
    case 2:
        opr_alterar();
        break;
}


function opr_cadastro()
{
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
    $tel_res = $_POST["tel_res"];
    $tel_com = $_POST["tel_com"];
    $celular = $_POST["celular"];

    $data_mysql = date('Y-m-d', strtotime(str_replace('/', '-', $data_nasc)));

    $sql = "INSERT INTO `clientes` (`cpf`, `nome`, `data_nasc`, `idade`, `endereco`, `cep`, `bairro`,
                                `cidade`, `estado`, `profissao`, `tel_res`, `tel_com`, `tel_cel`) 
                                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?);";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param(
            "sssisssssssss",
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
            $celular,
            $cpf
        );
        $stmt->execute();
        header("Location: ../index.php");
    } else {
        echo "Erro ao cadastrar usuário.";
    }
}

function opr_alterar()
{

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
    $tel_res = $_POST["tel_res"];
    $tel_com = $_POST["tel_com"];
    $celular = $_POST["celular"];
    $cpf_anterior = $_POST["cpf_anterior"];

    $data_mysql = date('Y-m-d', strtotime(str_replace('/', '-', $data_nasc)));

    $sql = "UPDATE clientes SET cpf = ?, nome = ?, data_nasc = ?, idade = ?, endereco = ?, cep = ?, bairro = ?,
                                cidade  = ?, estado  = ?, profissao = ?, tel_res  = ?, tel_com  = ?, tel_cel  = ?
                                WHERE cpf = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param(
            "sssissssssssss",
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
            $celular,
            $cpf_anterior
        );
        $stmt->execute();
        header("Location: alterar_clientes.php");
    } else {
        echo "Erro ao alterar cliente.";
    }
}
