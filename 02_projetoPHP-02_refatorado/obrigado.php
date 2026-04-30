<?php
/**
 * ==================================================================
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Projeto: Portfólio Pessoal - versão refatorada
 * Arquivo: obrifado.php (migrado de 02_formularios/obrifado.php)
 * Autor: Gabriela Bomfati Garcia
 * Data: 27/04/2026
 * Descrição: Destino do redirecionamento PRG do contato.php.
 *            Lê o nome do visitante via $_SESSION.
 * =====================================================================
 * 
 * Página de confirmação - destino do redirecionamento PRG.
 * Recebe o nome via GET apenas para exibição amigável.
 * Nenhum dado de formulário é processado aqui.
 */
if (session_status() === PHP_SESSION_NONE){
    session_start();
}

// VARIÁVEIS DO TEMPLATE
$nome = "Gabriela Bomfati Garcia";
$pagina_atual = "contato"; // mantém "contato" ativo no menu
$caminho_raiz = "./"; 
$titulo_pagina = "Obrigado!";

// Recebe o nome enviado pelo header() em contato.php
// ?? 'visitante' garante fallback se alguém acessar a URL diretamente
$nome_visitante = $_SESSION['nome'] ?? null;
$assunto = $_SESSION['assunto'] ?? null;

if ($nome_visitante === null){
    header('Location: contato.php');
    exit;
}
unset($_SESSION['nome'], $_SESSION['assunto']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include __DIR__ . '/includes/cabecalho.php'; ?>
</head>
<body>

<!-- Todo visual vem do style.css - sem CSS inline -->
 <div class="container confirmacao">
    <p class="confirmacao-icone">✅</p>
    <h1 class="confirmacao-titulo">
        Obrigado, <?php echo htmlspecialchars($nome_visitante); ?>! 
    </h1>
    <p class= "confirmacao-assunto">
        Assunto da mensagem: <?php echo ($assunto); ?></p>
    <p class="confirmacao-texto">
        Sua mensagem foi recebida. Entrarei em contato em breve.
    </p>
    <a href="contato.php" class="btn"> Enviar outra mensagem</a>
</div>

<?php include  __DIR__ . '/includes/rodape.php'; ?>
</body>
</html>