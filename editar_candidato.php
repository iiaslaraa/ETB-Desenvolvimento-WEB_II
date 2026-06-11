<?php
// editar_candidato.php — SGC
require_once 'conexao.php';

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
  <title>SGC — Editar Candidato</title>

<!--  CRIAR FOLHA DE ESTILO ESPECÍFICA -->
<!-- Vincula a folha de estilos externa -->
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

<h1>Editar Candidato</h1>
<form action="atualizar_candidato.php" method="post">
  <input type="hidden" name="id" value="<?php echo $c['id']; ?>">

  <fieldset>
    <legend>Dados Pessoais</legend>
    <label>Nome:
      <input type="text" name="nome"
             value="<?php echo htmlspecialchars($c['nome']); ?>"
             required maxlength="100">
    </label><br>
    <label>E-mail:
      <input type="email" name="email"
             value="<?php echo htmlspecialchars($c['email']); ?>"
             required maxlength="100">
    </label><br>
    <label>Telefone:
      <input type="text" name="telefone"
             value="<?php echo htmlspecialchars($c['telefone']); ?>"
             maxlength="20">
    </label><br>
    <label>Data de nascimento:
      <input type="date" name="data_nascimento"
             value="<?php echo htmlspecialchars($c['data_nascimento']); ?>">
    </label>
  </fieldset>

  <fieldset>
    <legend>Formação e Experiência</legend>
    <label>Formação acadêmica:<br>
      <textarea name="formacao" rows="4" cols="50"><?php
        echo htmlspecialchars($c['formacao']); ?></textarea>
    </label><br>
    <label>Experiência profissional:<br>
      <textarea name="experiencia" rows="4" cols="50"><?php
        echo htmlspecialchars($c['experiencia']); ?></textarea>
    </label><br>
    <label>Habilidades:<br>
      <textarea name="habilidades" rows="3" cols="50"><?php
        echo htmlspecialchars($c['habilidades']); ?></textarea>
    </label>
  </fieldset>

  <button type="submit" class='btn btn-success'>Salvar Alterações</button>
  <a href="curriculo.php?id=<?php echo $id; ?>" class='btn btn-danger'>Cancelar</a>
</form>

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