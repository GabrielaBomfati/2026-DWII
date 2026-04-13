<?php
/*
includes/conexao.php 
Arquivo de conexão PDO - incluir em qualquer página que use o banco
*/

// Configurações da conexão (dados do docker-compose.yml)
$host = '127.0.0.1'; // IP do container MariaDB (network_mode: service:db)
$db = 'dwii_db'; // Banco criado automaticamente pela variável MARIADB_DATABASE
$user = 'dwii_user'; // Usuário criado pela variável MARIADB_USER
$pass = 'dwii2026'; // Senha definida em MARIADB_PASSWORD
$charset = 'utf8mb4'; // Suporta emojis e caracteres especiais

// DSN - Data Source Name: string que identifica o banco para o PDO
// sslmode=disabled: comunicação entre containers nãp usa SSL
$dsn = "mysql:host=$host;dbname=$db;charset=$charset;sslmode=disabled";

// Opções de configurações do PDO
$opcoes = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Erros SQL viram exceções
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Resultado como array associativo
    PDO::ATTR_EMULATE_PREPARES => false, // Prepared statements reaus no banco
];

// Criar a conexão PDO
try {
    $pdo = new PDO($dsn, $user, $pass, $opcoes);
} catch (PDOException $e) {
    // Em produção: logar o erro, nunca exibir detalhes técnicos
    die('Erro de conexão com o banco de dados. Verifique o servidor.');
}
?>