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
                <section class="data-cliente">
                    <form method="post" action="opr_clientes.php" class="data-form" onsubmit="return validarCampos(1)">
                        <input type="hidden" name="opr_cliente" value="1">
                        <ul class="data-ul">
                            <li>
                                <label for="nome">Nome</label>
                                <input type="text" id="nome" name="nome" placeholder="Digite o nome" value="<?= $_POST["nome_lista"]; ?>" required>
                            </li>
                            <li>
                                <label for="endereco">Endereço</label>
                                <input type="text" id="endereco" name="endereco" placeholder="Digite o endereço" value="<?= $_POST["endereco_lista"]; ?>" required>
                            </li>
                            <li>
                                <label for="tel_residencial">Telefone Residencial</label>
                                <input type="text" id="tel_res" name="tel_res" value="<?= $_POST["tel_res_lista"]; ?>" placeholder="Digite o telefone residencial">
                            </li>
                        </ul>
                        <ul class="data-ul">
                            <li>
                                <label for="cpf">CPF</label>
                                <input type="text" id="cpf" name="cpf" value="<?= $_POST["cpf_lista"]; ?>" placeholder="000.000.000-00" required>
                            </li>
                            <li>
                                <label for="cep">CEP</label>
                                <input type="text" id="cep" name="cep" value="<?= $_POST["cep_lista"]; ?>" placeholder="00000-000" required>
                            </li>
                            <li>
                                <label for="tel_comercial">Telefone Comercial</label>
                                <input type="text" id="tel_com" name="tel_com" value="<?= $_POST["tel_com_lista"]; ?>" placeholder="Digite o telefone comercial">
                            </li>
                        </ul>
                        <ul class="data-ul">
                            <li>
                                <label for="data_nasc">Data de Nascimeto</label>
                                <input type="text" id="data_nasc" name="data_nasc" value="<?= $data_br  ?>" placeholder="dd/mm/aaaa" required>
                            </li>
                            <li>
                                <label for="cidade">Cidade</label>
                                <input type="text" id="cidade" name="cidade" value="<?= $_POST["cidade_lista"]; ?>" placeholder="Digite a cidade" required>
                            </li>
                            <li>
                                <label for="celular">Telefone Celular</label>
                                <input type="text" id="celular" name="celular" value="<?= $_POST["celular_lista"]; ?>" placeholder="(00) 00000 - 0000" required>
                            </li>
                        </ul>
                        <ul class="data-ul">
                            <li>
                                <label for="idade">Idade</label>
                                <input type="text" id="idade" name="idade" value="<?= $_POST["idade_lista"]; ?>" placeholder="Digite a idade" required>
                            </li>
                            <li>
                                <label for="bairro">Bairro</label>
                                <input type="text" id="bairro" name="bairro" value="<?= $_POST["bairro_lista"]; ?>" placeholder="Digite o bairro" required>
                            </li>
                            <li></li>
                        </ul>
                        <ul class="data-ul">
                            <li>
                                <label for="profissao">Profissão</label>
                                <input type="text" id="profissao" name="profissao" placeholder="Digite a profissão" value="<?= $_POST["profissao_lista"]; ?>" maxlength="200" required>
                            </li>
                            <li>
                                <label for="estado">Estado</label>
                                <input type="text" id="estado" name="estado" placeholder="SP / RJ / MG /..." value="<?= $_POST["estado_lista"]; ?>" maxlength="2" required>
                            </li>
                            <li></li>
                        </ul>
                </section>
                <section>
                    <button class="enviar" type="submit">Enviar</button>
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