<?php
// excluir_candidato.php — SGC
require_once 'conexao.php';

// Valida o ID recebido via GET
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('ID inválido. <a href="listar_candidatos.php">Voltar</a>');
}

$id = (int) $_GET['id'];

// Verifica se o candidato existe antes de excluir
$check = mysqli_query($conexao, "SELECT id, nome FROM candidatos WHERE id = $id LIMIT 1");

if (!$check || mysqli_num_rows($check) === 0) {
    die('Candidato não encontrado. <a href="listar_candidatos.php">Voltar</a>');
}

//$nome = htmlspecialchars(mysqli_result($check, 0, 'nome'));

// --- Exclui dados relacionados (se existirem tabelas filhas) ---
// Exemplo: experiencias_profissionais, formacoes, habilidades_candidato
// mysql_query("DELETE FROM experiencias WHERE candidato_id = $id", $conn);
// mysql_query("DELETE FROM formacoes     WHERE candidato_id = $id", $conn);

// Exclui o registro principal
$del = mysqli_query($conexao, "DELETE FROM candidatos WHERE id = $id");

if (!$del) {
    die('Erro ao excluir candidato: ' . mysqli_error($conexao));
}

$linhas = mysqli_affected_rows($conexao);

if ($linhas === 0) {
    die('Nenhum registro foi removido. <a href="listar_candidatos.php">Voltar</a>');
}

// Redireciona para a listagem com mensagem de sucesso via query string
header('Location: listar_candidatos.php?msg=excluido&nome=' . urlencode($nome));
exit;
?>