<?php
// curriculo.php — SGC
require_once 'conexao.php';

// Valida o parâmetro ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('ID inválido. <a href="listar_candidatos.php">Voltar</a>');
}

$id  = (int) $_GET['id'];
$sql = "SELECT * FROM candidatos WHERE id = $id LIMIT 1";
$res = mysqli_query($conexao, $sql);

if (!$res || mysqli_num_rows($res) === 0) {
    die('Candidato não encontrado. <a href="listar_candidatos.php">Voltar</a>');
}

$c = mysqli_fetch_array($res, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Currículo — <?php echo htmlspecialchars($c['nome']); ?></title>
  <link rel="stylesheet" href="style.css">

</head>

<body>

<!-- CABEÇALHO DO SISTEMA -->
<header>
    <a href="index.html"><img src="logo-SGC-4.1.png" alt="Logo do Site" class="logo"></a>
</header>

<!-- BARRA DE NAVEGAÇÃO -->
  <!-- Cada link aponta para uma funcionalidade -->
  <nav>
    <a href="index.html">Início</a>
    <a href="cadastro.html">Novo Candidato</a>
    <a href="listar_candidatos.php">
      Listar Candidatos
    </a>
    <a href="sobre.html">
      Sobre o SGC
    </a>
  </nav>

  <div class="container">

    <h1>Currículo</h1>
  <h2><?php echo htmlspecialchars($c['nome']); ?></h2>

  <p><b>E-mail:</b> <?php echo htmlspecialchars($c['email']); ?></p>
  <p><b>Telefone:</b> <?php echo htmlspecialchars($c['telefone']); ?></p>
  <!-- <p><b>Data de Nascimento:</b>
     <?php echo htmlspecialchars($c['data_nascimento']); ?></p> -->

  <h3>Formação Acadêmica</h3>
  <p><?php echo nl2br(htmlspecialchars($c['formacao'])); ?></p>

  <h3>Experiência Profissional</h3>
  <p><?php echo nl2br(htmlspecialchars($c['experiencia'])); ?></p>

  <h3>Habilidades</h3>
  <p><?php echo nl2br(htmlspecialchars($c['habilidades'])); ?></p>

  <hr>
  <br>
  <a href="editar_candidato.php?id=<?php echo $id; ?>" class='btn btn-warning'>Editar</a> |
  <a href="listar_candidatos.php" class='btn btn-primary'>Voltar à lista</a>      

  </div>


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