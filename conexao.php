<?php
// ============================================
// conexao.php — Configuração da Conexão
// AJUSTE ESTAS VARIÁVEIS CONFORME SEU AMBIENTE
// ============================================

// Endereço do servidor MySQL
// 'localhost' funciona para instalações locais
$servidor = 'localhost';

// Usuário do MySQL
// No XAMPP padrão, o usuário é 'root'
$usuario  = 'root';

// Senha do MySQL
// No XAMPP padrão, a senha é vazia ('')
// Se você definiu uma senha, coloque aqui
$senha    = '';

// Nome do banco de dados criado no phpMyAdmin
$banco    = 'bd_sgc_eab';

// Abre a conexão com o servidor MySQL
$conexao = mysqli_connect($servidor, $usuario,
                          $senha, $banco);

// Verifica se a conexão foi bem-sucedida
if (!$conexao) {
    // Exibe mensagem de erro e encerra o script
    die('Erro de conexão: '
        . mysqli_connect_error());
}

// Define o charset para suporte a acentos
mysqli_set_charset($conexao, 'utf8');
?>