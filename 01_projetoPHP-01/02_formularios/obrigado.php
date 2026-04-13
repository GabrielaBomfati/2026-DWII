<?php
/**
 * ==================================================================
 * ARQUIVO: 02_formularios/obrigado.php
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 04 - PHP para Web: Fomrulários, GET e POST
 * Autor: Gabriela Bomfati Garcia
 * Conceitos: header() + exit (PRG), $_GET para parâmetros
 *            de confirmação, htmlspecialchars()
 * =====================================================================
 * 
 * Página de confirmação - destino do redirecionamento PRG.
 * Recebe o nome via GET apenas para exibição amigável.
 * Nenhum dado de formulário é processado aqui.
 */

// VARIÁVEIS DO TEMPLATE
$nome = "Gabriela Bomfati Garcia";
$pagina_atual = "contato"; // mantém "contato" ativo no menu
$caminho_raiz = "../"; 
$titulo_pagina = "Obrigado!";

// Recebe o nome enviado pelo header() em contato.php
// ?? 'visitante' garante fallback se alguém acessar a URL diretamente
$nome_visitante = htmlspecialchars($_GET['nome'] ?? 'visitante');
$assunto = htmlspecialchars($_GET['assunto'] ?? '');
?>
<!--cabecalho.php gera tudo até <body>--> 
<?php include '../includes/cabecalho.php'; ?>

<!-- Todo visual vem do style.css - sem CSS inline -->
 <div class="container confirmacao">
    <p class="confirmacao-icone">✅</p>
    <h1 class="confirmacao-titulo">
        Obrigado, <?php echo $nome_visitante; ?>! 
    </h1>
    <p class= "confirmacao-assunto">
        Assunto da mensagem: <?php echo $assunto; ?></p>
    <p class="confirmacao-texto">
        Sua mensagem foi recebida. Entrarei em contato em breve.
    </p>
    <a href="contato.php" class="btn"> Enviar outra mensagem</a>
</div>

<?php include '../includes/rodape.php'; ?>


