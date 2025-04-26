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
    <title>Cadastro</title>
</head>

<body>
    <header>
        <h1>Aline Calesco Estética Funcional Integrativa</h1>
    </header>
    <main>
        <h2>Cadastro de Clientes / <a href="../index.php">VOLTAR</a></h2>
        <section class="data-cliente">
            <form method="post" action="opr_clientes.php" class="data-form" onsubmit="return validarCampos(1)">
                <input type="hidden" name="opr_cliente" value="1">
                <ul class="data-ul">
                    <li>
                        <label for="nome">Nome</label>
                        <input type="text" id="nome" name="nome" placeholder="Digite o nome" required>
                    </li>
                    <li>
                        <label for="endereco">Endereço</label>
                        <input type="text" id="endereco" name="endereco" placeholder="Digite o endereço" required>
                    </li>
                    <li>
                        <label for="tel_residencial">Telefone Residencial</label>
                        <input type="text" id="tel_res" name="tel_res" placeholder="Digite o telefone residencial">
                    </li>
                </ul>
                <ul class="data-ul">
                    <li>
                        <label for="cpf">CPF</label>
                        <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" required>
                    </li>
                    <li>
                        <label for="cep">CEP</label>
                        <input type="text" id="cep" name="cep" placeholder="00000-000" required>
                    </li>
                    <li>
                        <label for="tel_comercial">Telefone Comercial</label>
                        <input type="text" id="tel_com" name="tel_com" placeholder="Digite o telefone comercial">
                    </li>
                </ul>
                <ul class="data-ul">
                    <li>
                        <label for="data_nasc">Data de Nascimeto</label>
                        <input type="text" id="data_nasc" name="data_nasc" placeholder="dd/mm/aaaa" required>
                    </li>
                    <li>
                        <label for="cidade">Cidade</label>
                        <input type="text" id="cidade" name="cidade" placeholder="Digite a cidade" required>
                    </li>
                    <li>
                        <label for="celular">Telefone Celular</label>
                        <input type="text" id="celular" name="celular" placeholder="(00) 00000 - 0000" required>
                    </li>
                </ul>
                <ul class="data-ul">
                    <li>
                        <label for="idade">Idade</label>
                        <input type="text" id="idade" name="idade" placeholder="Digite a idade" required>
                    </li>
                    <li>
                        <label for="bairro">Bairro</label>
                        <input type="text" id="bairro" name="bairro" placeholder="Digite o bairro" required>
                    </li>
                    <li></li>
                </ul>
                <ul class="data-ul">
                    <li>
                        <label for="profissao">Profissão</label>
                        <input type="text" id="profissao" name="profissao" placeholder="Digite a profissão" maxlength="200" required>
                    </li>
                    <li>
                        <label for="estado">Estado</label>
                        <input type="text" id="estado" name="estado" placeholder="SP / RJ / MG /..." maxlength="2" required>
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