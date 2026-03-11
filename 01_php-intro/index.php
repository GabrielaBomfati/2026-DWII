<?php
/**
 * ===============================================================
 * Arquivo: 01_php-intro/index.php 
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 03 - Arquitetura Web e Introdução ao PHP
 * Autor: Gabriela Bomfati Garcia
 * ===============================================================
 */
    // Variáveis PHP - serão usadas no HTML abaixo
    $nome = "Gabriela Bomfati Garcia";
    $profissao = "Técnico em Informática em formação";
    $curso = "Técnico em Informática - IFPR";
    $pagina_atual = "inicio"; // define o item ativo no menu
    $caminho_raiz = "../"; // sobe um vível até 2026-DWII/
    $titulo_pagina = "Portfólio - {$nome}";
    ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfólio - <?php echo $nome; ?></title>
    
     <!-- SEM bloco <style> aqui - CSS vem do includes/style.css -->
</head>

<body>
<?php include '../includes/cabecalho.php'; ?>
    <div class="inicio">
        <h1><?php echo $nome; ?></h1>
        <p><?php echo $profissao; ?> | <?php echo $curso; ?></p>
    </div>

    <div class="container">
    <h2>Bem-vindo ao meu portfólio</h2>
    <p> Está página foi gerada pelo PHP em:
        <strong><?php echo date("d/m/Y \à\s H:i:s"); ?></strong></p>
    </div>

    <!-- Substitua o bloco <footer>...</footer> por: -->
     <?php include '../includes/rodape.php'; ?>

</body> 
</html>
