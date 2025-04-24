<?php
$data_mysql = $_POST["data_nasc_lista"];
$data_br = date('d/m/Y', strtotime($data_mysql));
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Allura&family=Oxygen:wght@300;400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../index.css">
    <title>Alteração</title>
</head>

<body>
    <header>
        <h1>Aline Calesco Estética Funcional Integrativa</h1>
    </header>
    <main>
        <h2>Alteração de Clientes / <a href="alterar_clientes.php">VOLTAR</a></h2>
        <section class="data">
            <form method="post" action="opr_clientes.php" class="data-form" onsubmit="return validarCampos(2)">
                <input type="hidden" name="opr_cliente" value="2">
                <input type="hidden" name="cpf_anterior" value="<?= $_POST["cpf_lista"]; ?>">
                <table class="data-table">
                    <tbody>
                        <tr>
                            <td><label for="nome">Nome</label></td>
                            <td><input type="text" id="nome" name="nome" placeholder="Digite o nome" value="<?= $_POST["nome_lista"]; ?>" required></td>
                            <td><label for="endereco">Endereço</label></td>
                            <td><input type="text" id="endereco" name="endereco" placeholder="Digite o endereço" value="<?= $_POST["endereco_lista"]; ?>" required></td>
                            <td><label for="tel_residencial">Telefone Residencial</label></td>
                            <td><input type="text" id="tel_res" name="tel_res" placeholder="Digite o telefone residencial" value="<?= $_POST["tel_res_lista"]; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="cpf">CPF</label></td>
                            <td><input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" value="<?= $_POST["cpf_lista"]; ?>" required></td>
                            <td><label for="cep">CEP</label></td>
                            <td><input type="text" id="cep" name="cep" placeholder="00000-000" value="<?= $_POST["cep_lista"]; ?>" required></td>
                            <td><label for="tel_comercial">Telefone Comercial</label></td>
                            <td><input type="text" id="tel_com" name="tel_com" placeholder="Digite o telefone comercial" value="<?= $_POST["tel_com_lista"]; ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="data_nasc">Data de Nascimeto</label></td>
                            <td><input type="text" id="data_nasc" name="data_nasc" placeholder="dd/mm/aaaa" value="<?= $data_br  ?>" required></td>
                            <td><label for="cidade">Cidade</label></td>
                            <td><input type="text" id="cidade" name="cidade" placeholder="Digite a cidade" value="<?= $_POST["cidade_lista"]; ?>" required></td>
                            <td><label for="celular">Telefone Celular</label></td>
                            <td><input type="text" id="celular" name="celular" placeholder="(00) 00000 - 0000" value="<?= $_POST["celular_lista"]; ?>" required></td>
                        </tr>
                        <tr>
                            <td><label for="idade">Idade</label></td>
                            <td><input type="text" id="idade" name="idade" placeholder="Digite a idade" value="<?= $_POST["idade_lista"]; ?>" required></td>
                            <td><label for="bairro">Bairro</label></td>
                            <td><input type="text" id="bairro" name="bairro" placeholder="Digite o bairro" value="<?= $_POST["bairro_lista"]; ?>" required></td>
                        </tr>
                        <tr>
                            <td><label for="profissao">Profissão</label></td>
                            <td><input type="text" id="profissao" value="<?= $_POST["profissao_lista"]; ?>" name="profissao" placeholder="Digite a profissão" maxlength="30" required></td>
                            <td><label for="estado">Estado</label></td>
                            <td><input type="text" id="estado" name="estado" placeholder="SP / RJ / MG /..." maxlength="2" value="<?= $_POST["estado_lista"]; ?>" required></td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit">Enviar</button>
            </form>
        </section>
    </main>
    <footer>
        <p>
            Aline Calesco Estética Funcional Integrativa &copy; 2025
        </p>
    </footer>


    <script src="https://unpkg.com/inputmask@5.0.8/dist/inputmask.min.js"></script>
    <script src="../js_files/mascaras.js"></script>
    <script src="../js_files/validacao_clientes.js"></script>
</body>

</html>