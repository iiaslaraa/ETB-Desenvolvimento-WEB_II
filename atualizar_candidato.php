<?php
// atualizar_candidato.php — SGC
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: listar_candidatos.php');
    exit;
}

// Valida o ID oculto
if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    die('ID inválido.');
}

$id = (int) $_POST['id'];

// Sanitiza os campos recebidos
$nome        = mysqli_real_escape_string($conexao, trim($_POST['nome']));
$email       = mysqli_real_escape_string($conexao, trim($_POST['email']));
$telefone    = mysqli_real_escape_string($conexao, trim($_POST['telefone']));
//$dt_nasc     = mysqli_real_escape_string($conexao, trim($_POST['data_nascimento']));
$formacao    = mysqli_real_escape_string($conexao, trim($_POST['formacao']));
$experiencia = mysqli_real_escape_string($conexao, trim($_POST['experiencia']));
$habilidades = mysqli_real_escape_string($conexao, trim($_POST['habilidades']));

// Validação mínima
if (empty($nome) || empty($email)) {
    die('Erro: Nome e e-mail são obrigatórios. <a href="javascript:history.back()">Voltar</a>');
}

// Monta e executa a query UPDATE
$sql = "UPDATE candidatos SET
            nome         = '$nome',
            email        = '$email',
            telefone     = '$telefone',
            formacao     = '$formacao',
            experiencia  = '$experiencia',
            habilidades  = '$habilidades'
        WHERE id = $id";

$resultado = mysqli_query($conexao, $sql);

if (!$resultado) {
    die('Erro ao atualizar: ' . mysqli_error($conexao));
}

// Verifica se alguma linha foi realmente alterada
$linhas_afetadas = mysqli_affected_rows($conexao);

// Redireciona para o currículo atualizado
header('Location: curriculo.php?id=' . $id);
exit;
?>