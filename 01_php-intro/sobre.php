<?php
/**
 * ===============================================================
 * Arquivo: 01_php-intro/sobre.php 
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 03 - Aruqitetura Web e Introdução ao PHP
 * Autor: Gabriela Bomfati Garcia
 * ===============================================================
 */
    // Variáveis PHP - serão usadas no HTML abaixo
    $nome = "Gabriela Bomfati Garcia";
    $pagina_atual = "sobre"; // define o item ativo no menu
    $caminho_raiz = "../"; // sobe um vível até 2026-DWII/
    $titulo_pagina = "Sobre mim - {$nome}";
    ?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre - <?php echo $nome; ?></title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; background: white;">
    
    <?php include '../includes/cabecalho.php'; ?>

   <div style="max-width: 800px; margin: 40px auto; padding: 0 20px;">
    <h1 style="color: #ab5084 ;"> Sobre mim</h1>
    <p>Olá! Sou <strong><?php echo $nome; ?></strong>, estudante de Técnico em Infromática no IFPR de Ponta Grossa.</p>
    <p>Atualmente moro em Ponta Grossa, no Paraná, estudante do 3°ano do Técnico em Informática no IFPR, gosto bastante de aprender coisas novas principalmente na área da tecnologia. 
    No meu tempo livre gosto de ouvir música, assitir séries e filmes e também aproveitar o tempo com meus amigos e família. 
    Sempre tive interesse em entender como os sistemas funcionam, por trás de uma tela bonita.<br>
    Escolhi a área de informática porque sempre gostei muito e existia uma curiosidade de como essas tecnologias funcionam, 
    também gosto e tenho uma certa facilidade em exatas. 
    Durante o curso, venho desenvolvendo interesse principalmente na área de banco de dados, pois acho interessante a forma como as informações são organizadas e utilizadas nos sistemas. 
    Futuramente, pretendo concluir o curso técnico no IFPR, fazer uma faculdade na área de tecnologia, e talvez me especializar na área de banco de dados, 
    sendo meu objetivo é trabalhar na área de tecnologia, especialmente nesta área construindo uma carreira neste campo.
    </p><br>
    <a href="index.php"
    style="color: #551a8b ; font-weight: bold;"> Voltar ao início</a>
    </div>  
     <?php include '../includes/rodape.php'; ?>
</body>
</html>