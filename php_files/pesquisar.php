<section class="filtrar_clientes">
    <h3>Pesquisar cliente por seu nome</h3>
    <form action="" method="post">
        <input type="text" name="pesquisa_cliente_nome">
        <button type="submit">Pesquisar</button>
    </form>
    <?php
    include("conexao_db.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pesquisa_cliente_nome"]) && $_POST["pesquisa_cliente_nome"] != '') {
        $nome_pesquisado = $_POST["pesquisa_cliente_nome"];
        $sql = "SELECT * FROM clientes WHERE nome LIKE ?";
        $stmt = $conn->prepare($sql);
        $like_nome = "%" . $nome_pesquisado . "%";
        $stmt->bind_param("s", $like_nome);
        $stmt->execute();
        $resultado = $stmt->get_result();
    } else {
        $sql = "SELECT * FROM clientes";
        $resultado = $conn->query($sql);
        if (!$resultado) {
            die("Erro ao buscar clientes: " . $conn->error);
        }
    }
    ?>
    <p>Para cancelar o filtro, pesquise com este campo vazio.</p>
</section>