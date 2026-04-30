<?php
/**
 * ======================================================================================
 * Arquivo: index.php (raiz do repositório 2026-DWII)
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 04 - PHP para Web: Formulários. GET e POST
 * Autor: Gabriela Bomfati Garcia
 * Data:  13/04/2026
 * Conceitos: Ponto de entrada, array associativo. foreach, date(), htmlspecialchars()
 * ======================================================================================
 * 
 * Hub de navegação - exibido quando o servidor ssobe na raiz:
 *  php -S localhost:8000
 * 
 * Por estar fora das subpastas, este arquivo NÃO usa os 
 * includes compartilhados (cabecalho.php, nav.php, rodape.php).
 * Cabeçalho, nav e rodapé são definidos inline aqui.
 */
if (session_status() === PHP_SESSION_NONE){
    session_start();
}

// -------- VARIÁVEIS DE CONTEÚDO ----------------------------
$pagina_atual = 'inicio';
$caminho_raiz = './';
$titulo_pagina = 'Portfólio - Gabriela Bomfati Garcia';

// 3 Dados de apresentação
$nome = 'Gabriela Bomfati Garcia';
$descricao = 'Estudante do Ensino Médio, no Instituto Federal do Paraná (IFPR), 
            no Centro de Referência Ponta Grossa, 
            atualmente cursando o 3° ano do Técnico em Informática, o curso trabalha diferentes linguagens de programação, 
            proporcionando um aprendizado bem amplo,
            atualmente estamos aprendendo Desenvolvimento Web II e Desenvolvimento de Aplicativos.';
$email = '20241ctb0100051@estudantes.ifpr.edu.br';
?>
<!DOCTYPE html>

<html lang="pt-BR">
<head>
  <?php

include __DIR__ . '/includes/cabecalho.php';
?>

</head>
<body>

  <main>
    <section class="apresentacao">

  <!-- Foto de perfil -->
  <div class="foto-container">
    <img
      src="<?php echo $caminho_raiz; ?>includes/imgs/foto.jpg"
      alt="Foto de <?php echo htmlspecialchars($nome); ?>"
      class="foto-perfil">
  </div>

  <!-- Bloco de texto + cards informativos -->
  <div class="texto-container">

    <h2 class="nome">
      Olá, eu sou <?php echo htmlspecialchars($nome); ?>! 👋
    </h2>

    <?php
    ?>
    <p class="aps"><?php echo htmlspecialchars($descricao); ?></p>

    <div class="info-cards">

      <div class="info-card">
        <span class="card-icon">🎓</span>
        <span class="card-texto">Técnico em Informática — IFPR CRPG</span>
      </div>

      <div class="info-card">
        <span class="card-icon">💻</span>
        <span class="card-texto">Desenvolvimento Web II — 2026</span>
      </div>

      <div class="info-card">
        <span class="card-icon">📧</span>
        <span class="card-texto">
          <?php echo htmlspecialchars($email); ?>
        </span>
      </div>

    </div><!-- /info-cards -->

  </div><!-- /texto-container -->

</section>
  </main>

  <?php include __DIR__ . '/includes/rodape.php'; ?>

</body>
</html>
    
