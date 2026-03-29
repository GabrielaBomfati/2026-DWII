<?php
/**
 * Disciplina: Desenvolvimento Web II (DWII)
 * Aula: 06 - Autenticação com sessões e controle de acesso
 * Arquivo: 04_sessoes/login.php
 * Autor: Gabriela Bomfati Garcia
 * Data: 23/03/2026
 */

// session_start() DEVE ser a primeira coisa do arquvivo
session_start();

// Se já estiver logado, ir direto ao painel
require_once __DIR__ . '/includes/auth.php';
redirecionar_se_logado();

// Credenciais válidas (fixas por enquanto - virão do BD na Aula 07)
$USUARIO_VALIDO = 'admin';
$SENHA_VALIDA = 'dwii2026';

$erro = '';
$login = '';
$agora= time();

// Verifica se está bloqueado
if (isset($_SESSION['bloqueado_ate']) && $agora < $_SESSION['bloqueado_ate']) {
    $erro = 'Tentativas esgotadas. Aguarde um momento e tente novamente.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($erro)) {
        // Já está bloqueado, não faz nada
    } else {
            $login = trim($_POST['usuario'] ?? '');
            $senha = trim($_POST['senha'] ?? '');

    if($login === $USUARIO_VALIDO && $senha === $SENHA_VALIDA) {
        // Credenciais corretas - nov ID de sessão após login (segurança)
        session_regenerate_id(true);
        $_SESSION['usuario'] = $login;
        $_SESSION['logado_em'] = date('d/m/Y \à\s H:i');
        // Zera tentativas
        $_SESSION['tentativas'] = 0;
        // Flash Message 
        $_SESSION['flash'] = "Bem-vindo(a), $login!";
        header('Location: painel.php');
        exit;
    } else {
            // Contador tentativas
            $_SESSION['tentativas'] = ($_SESSION['tentativas'] ?? 0) + 1;
            // Se errar 3 vezes, bloqueia
            if ($_SESSION['tentativas'] >= 3) {
                $_SESSION['bloqueado_ate'] = time() + 60; // 60 segundos
                $_SESSION['tentativas'] = 0;
            }
            $erro = 'Usuário ou senha incorretos.';
        }
    }
}

$titulo_pagina = 'Login - Área Restrita';
$caminho_raiz = '../';
$pagina_atual = '';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
   <?php require_once __DIR__ . '/../includes/cabecalho.php'; ?>
</head>
<body>
    
<div class="container" style="max-width: 420px;">
    <div class="form-container">
        <h1 class="titulo-secao" style= "text-align: center; font-size: 22px;">
            🔐 Área Restrita
        </h1>

        <?php if ($erro): ?>
            <div class="alerta-erro">
                <p style="margin: 0; font-size: 14px;">
                    🚫 <?php echo htmlspecialchars($erro); ?>
                </p>
            </div>
            <?php endif; ?>

            <form action="login.php" method="post">
                <label>Usuário:</label>
                <input type="text"
                       name="usuario"
                       value="<?php echo htmlspecialchars($login); ?>"
                       autocomplete="username">
                
                <label>Senha:</label>
                <input type="password"
                       name="senha"
                       autocomplete="current-password">

                
                <button type="submit">Entrar</button>
            </form>
            <p style="text-align: center; margin-top: 20px;
                      font-size: 13px; color: #570b57;">
                <a href="../index.php" style="color: #570b57">
                    Voltar ao início </a>
            </p>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
</body>
</html>