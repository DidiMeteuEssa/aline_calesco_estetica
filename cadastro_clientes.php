<!DOCTYPE html>
<html lang="ptbr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Allura&family=Oxygen:wght@300;400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="index.css">
    <title>Cadastro</title>
</head>

<body>
    <header>
        <h1>Aline Calesco Estética</h1>
    </header>
    <main>
        <h2>Cadastro de Clientes / <a href="index.php">VOLTAR</a></h2>
        <section class="cadastro_clientes">
            <form method="post" action="opr_cadastro_clientes.php" class="form_cadastro_clientes">
                <table class="form_cadastro_clientes-table">
                    <tbody>
                        <tr>
                            <td><label for="nome">Nome</label></td>
                            <td><input type="text" id="nome" name="nome" placeholder="Digite o nome" required></td>
                            <td><label for="endereco">Endereço</label></td>
                            <td><input type="text" id="endereco" name="endereco" placeholder="Digite o endereço" required></td>
                            <td><label for="tel_residencial">Telefone Residencial</label></td>
                            <td><input type="text" id="tel_res" name="tel_res" placeholder="Digite o telefone residencial" required></td>
                        </tr>
                        <tr>
                            <td><label for="cpf">CPF</label></td>
                            <td><input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" required></td>
                            <td><label for="cep">CEP</label></td>
                            <td><input type="text" id="cep" name="cep" placeholder="00000-000" required></td>
                            <td><label for="tel_comercial">Telefone Comercial</label></td>
                            <td><input type="text" id="tel_com" name="tel_com" placeholder="Digite o telefone comercial" required></td>
                        </tr>
                        <tr>
                            <td><label for="data_nasc">Data de Nascimeto</label></td>
                            <td><input type="text" id="data_nasc" name="data_nasc" placeholder="dd/mm/aaaa" required></td>
                            <td><label for="cidade">Cidade</label></td>
                            <td><input type="text" id="cidade" name="cidade" placeholder="Digite a cidade" required></td>
                            <td><label for="celular">Telefone Celular</label></td>
                            <td><input type="text" id="celular" name="celular" placeholder="(00) 00000 - 0000" required></td>
                        </tr>
                        <tr>
                            <td><label for="idade">Idade</label></td>
                            <td><input type="text" id="idade" name="idade" placeholder="Digite a idade" required></td>
                            <td><label for="bairro">Bairro</label></td>
                            <td><input type="text" id="bairro" name="bairro" placeholder="Digite o bairro" required></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><label for="estado">Estado</label></td>
                            <td><input type="text" id="estado" name="estado" placeholder="SP / RJ / MG /..." required></td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit">Enviar</button>
            </form>
        </section>
    </main>
    <footer>
        <p>
            Aline Calesco Estética &copy; 2025
        </p>
    </footer>
</body>

</html>