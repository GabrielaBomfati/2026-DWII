<?php
/**
 * Disciplina: Desenvolvimento Web II (DWII)
 * Aula: 06 - Autenticação com sessões e controle de acesso
 * Arquivo: 04_sessoes/perfil.php
 * Autor: Gabriela Bomfati Garcia
 * Data: 27/03/2026
 */

require_once __DIR__ . '/includes/auth.php';
requer_login();

$titulo_pagina = 'Perfil do Usuário';
$caminho_raiz = '../';
$pagina_atual = '';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php require_once __DIR__ . '/../includes/cabecalho.php'; ?>
</head>
<body>

<div class="container">
    <div class="card">
        <h2>👤 Perfil do Usuário</h2>

        <p><strong>Usuário:</strong>
        <?php echo htmlspecialchars($_SESSION['usuario']); ?>
        </p>

        <p><strong>Login realizado em:</strong>
        <?php echo htmlspecialchars($_SESSION['logado_em'] ?? '-'); ?>
        </p>

        <p><strong>Visitas nesta sessão:</strong>
        <?php echo $_SESSION['visitas'] ?? 0; ?>
        </p>
    </div>

    <p style="margin-top: 20px;">
        <a href="painel.php" style="color: #570b57" > Voltar ao painel</a>
    </p>
</div>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
</body>
</html>