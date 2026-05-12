<?php
/**
 * Disciplina: Desenvolvimento Web II (DWII)
 * Arquivo: login.php (raiz)
 * Descrição: Autenticação real contra tabela usuarios (bcrypt)
 */

require_once __DIR__ . '/includes/conexao.php';
require_once __DIR__ . '/includes/auth.php';

// Se já está logado, não faz sentido ver o formulário.
if(usuario_logado()){
    header('Location: painel.php');
    exit;
}

$erro = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $senha = $_POST['senha'] ?? '';


if($login === '' || $senha === '') {
    $erro = 'Informe usuário e senha.';
}else{
    $pdo = conectar();


// Busca usuário ATIVO (status='ativo' evita login de conta desabilitada).
$stmt = $pdo->prepare(
"SELECT id, login, senha FROM usuarios WHERE login = :login AND status = 'ativo' LIMIT 1");
$stmt->execute([':login' => $login]);
$usuario = $stmt->fetch();

//password_verify compara o texto digitando com o hash bcrypt.
if ($usuario && password_verify($senha, $usuario['senha'])){

// Defesa contra session fixation: troca o ID da sessão.
session_regenerate_id(true);
$_SESSION['usuario'] = $usuario['login'];

// Auditoria: registra login bem-sucedido
$log = $pdo->prepare("INSERT INTO logs (tabela_afetada, registro_id, acao, usuario_login, detalhes)
VALUES ('usuarios', :id, 'LOGIN', :login, 'Login bem-sucedido')");

$log->execute([
    ':id' => $usuario['id'],
    ':login' =>$usuario['login'],
]);

header('Location: painel.php');
exit;
}

// Auditoria: registra tentativa falha(sem revelar se foi login ou senha).
$log = $pdo->prepare("INSERT INTO logs (tabela_afetada, registro_id, acao, usuario_login, detalhes)
VALUES ('usuarios', 0, 'LOGIN_FAIL', :login, 'Credenciais inválidas')");
$log->execute([':login' => $login]);

// Mensagem genérica: não dizer se o erro foi no login ou na senha.
$erro = 'Usuário ou senha inválidos';
}
}

$pagina_atual = 'login';
$titulo_pagina = 'Login - Portfólio';
$caminho_raiz = './';

require_once __DIR__ . '/includes/cabecalho.php';
?>

<main style="max-width: 420px; margin: 60px auto; padding: 0 20px;  min-height: 450px;">
    <h1>🔐 Login</h1>

<?php if ($erro !== ''): ?>
    <p style="color: #cf1c21;"><?= htmlspecialchars($erro) ?> </p>
    <?php endif; ?>

    <form method="POST" action="login.php">
        <label>Usuário<br>
        <input type="text" name="login" required></label>
        <br><br>
        <label>Senha<br>
         <input type="password" name="senha" required></label>
        <br><br>
        <button type="submit">Entrar</button>
    </form>
</main>

<?php require_once __DIR__ . '/includes/rodape.php'; ?>