<?php
// listar_candidatos.php — SGC
require_once 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>SGC — Lista de Candidatos</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- CABEÇALHO DO SISTEMA -->
<header>
    <a href="index.html"><img src="logo-SGC-4.1.png" alt="Logo do Site" class="logo"></a>
</header>

<nav>
    <a href="index.html">Início</a>
    <a href="cadastro.html">Novo Candidato</a>
    <a href="sobre.html">
      Sobre o SGC
    </a>
</nav>

<h1>Candidatos Cadastrados</h1>

<?php
$sql = "SELECT id, nome, email, telefone FROM candidatos ORDER BY nome ASC";
$res = mysqli_query($conexao, $sql);

if (!$res) {
    die('Erro na consulta: ' . mysqli_error($conexao));
}

$total = mysqli_num_rows($res);
echo "<p>Total de candidatos: <b>$total</b></p>";

if ($total === 0) {
    echo '<p>Nenhum candidato cadastrado ainda.</p>';
} else {
    echo '<table border="1" cellpadding="6">';
    echo '<tr><th>#</th><th>Nome</th><th>E-mail</th><th>Telefone</th><th>Ações</th></tr>';

    while ($linha = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $id    = (int) $linha['id'];
        $nome  = htmlspecialchars($linha['nome']);
        $email = htmlspecialchars($linha['email']);
        $tel   = htmlspecialchars($linha['telefone']);

        echo "<tr>
                <td>$id</td>
                <td>$nome</td>
                <td>$email</td>
                <td>$tel</td>
                <td>
                  <a href='curriculo.php?id=$id' class='btn btn-primary'>Ver Currículo</a> |
                  <a href='editar_candidato.php?id=$id' class='btn btn-warning'>Editar</a> |
                  <a href='excluir_candidato.php?id=$id' class='btn btn-danger'
                     onclick='return confirm(\"Excluir $nome?\")'>Excluir</a>
                </td>
              </tr>";
    }
    echo '</table>';

}

?>
<hr></hr>
<br>
<a href="cadastro.html" class='btn btn-success'>+ Novo Candidato</a>

<!-- RODAPÉ -->
<footer>
    <!-- Utiliza o script abaixo para buscar o ano atual -->
    <p>&copy; <span id="anoAtual"></span> — SGC — PEAR Sistemas de Informação S.A.
  </br>
    Todos os direitos reservados.</p>

<script>
    //busca o ano atual com a função Date()
    document.getElementById("anoAtual").innerHTML = new Date().getFullYear();
</script>

</footer>

</body>
</html>