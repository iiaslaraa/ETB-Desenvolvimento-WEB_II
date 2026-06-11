<?php
// salvar_candidato.php — SGC
require_once 'conexao.php';

// Verifica se o formulário foi submetido via POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: cadastro.html');
    exit;
}

// Sanitiza as entradas para evitar SQL Injection
$nome       = mysqli_real_escape_string($conexao, trim($_POST['nome']));
$email      = mysqli_real_escape_string($conexao, trim($_POST['email']));
$telefone   = mysqli_real_escape_string($conexao, trim($_POST['telefone']));
$dt_nasc    = mysqli_real_escape_string($conexao, trim($_POST['data_nascimento']));
$formacao   = mysqli_real_escape_string($conexao, trim($_POST['formacao']));
$experiencia= mysqli_real_escape_string($conexao, trim($_POST['experiencia']));
$habilidades= mysqli_real_escape_string($conexao, trim($_POST['habilidades']));

// Validação mínima
if (empty($nome) || empty($email)) {
    die('Erro: Nome e e-mail são obrigatórios. <a href="cadastro.html">Voltar</a>');
}

// Monta e executa a query INSERT
$sql = "INSERT INTO candidatos
            (nome, email, telefone, objetivo,
             formacao, experiencia, habilidades)
        VALUES
            ('$nome', '$email', '$telefone', '$objetivo',
             '$formacao', '$experiencia', '$habilidades')";

$resultado = mysqli_query($conexao, $sql);

if (!$resultado) {
    die('Erro ao salvar candidato: ' . mysqli_error($conexao));
}

$id_inserido = mysqli_insert_id($conexao);

// Redireciona para o currículo recém-criado
header('Location: curriculo.php?id=' . $id_inserido);
exit;
?>