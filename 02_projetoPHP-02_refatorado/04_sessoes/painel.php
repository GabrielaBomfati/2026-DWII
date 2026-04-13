<?php
/**
 * Disciplina: Desenvolvimento Web II (DWII)
 * Aula: 06 - Autenticação com sessões e controle de acesso
 * Arquivo: 04_sessoes/painel.php
 * Autor: Gabriela Bomfati Garcia
 * Data: 23/03/2026
 */
// VERSÃO INCIAL (Passo 2) 
// Substituir pelo bloco abaixo no Passo 3

//session_start();
//if (!isset($_SESSION['usuario'])) {
  //  header('Location: login.php');
   // exit;
//}

// VERSÃO REFATORADA (Passo 3) - substitui o bloco acima
require_once __DIR__ . '/includes/auth.php';
requer_login();

// No painel.php, após requer_login():
if (!isset($_SESSION['visitas'])) {
    $_SESSION['visitas'] = 0;
}
$_SESSION['visitas']++;
// A cada F5 o contador aumenta — por quê?

$titulo_pagina = 'Painel - Área Restrita';
$caminho_raiz = '../';
$pagina_atual = 'login';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php require_once __DIR__ . '/../includes/cabecalho.php'; ?>
</head>
<body>

<?php if (isset($_SESSION['flash'])): ?>
    <div class="boasvindas">
        <?php echo htmlspecialchars($_SESSION['flash']); ?>
    </div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>
    
<div class="container">
    <div class="alerta-sucesso">
    <h3>✅ Você está autenticado!</h3>
    <p><strong>Usuário:</strong>
    <?php echo htmlspecialchars($_SESSION['usuario']); ?>
    </p>
    <p><strong>Login realizado em:</strong>
    <?php echo htmlspecialchars($_SESSION['logado_em'] ?? '-') ?>
    </p>
    <p><strong>Número de visitas nesta sessão:</strong>
    <?php echo $_SESSION['visitas']; ?>
    </p>
    </div>
    <br> 

<div class="card">
    <h3>📊 Painel de controle</h3>
    <p>Este conteúdo só é visível para usuários autenticados.</p>
    <p>Nas próximas aulas este painel terá funcionalidades reais (CRUD).</p>
    <p>Deseja acessar seu perfil?</p>
    <a href="perfil.php" style="color: #570b57">👤 Ver Perfil</a>
    <!-- Link para o módulo CRUD implementado na Aula 08.
         O caminho sobe um nível (../) para sar de 04_sessoes/
         e e tão entra em 05_crud/. -->
    <a href="../05_crud/index.php" class="btn-primario" style="color: #570b57">🗂️ Gerenciar projetos</a>
</div>

<p style="margin-top: 24px; text-align: center;">
    <a href="logout.php"
       style="background: #cf1c21; color: white; padding: 10px 24px;
              border-radius: 6px; text-decoration: none; font-weight: bold;">
            🚪 Sair</a>
    </p>
</div>
      
<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
</body>
</html>