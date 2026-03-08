<!-- 01_php-intro/index.php -->
 <!--
    Disciplina: Desenvolvimento Web II (DWII)
    Aula: 03 - Arquitetura Web e Introdução ao PHP
    Autor: Gabriela Bomfati Garcia
    Data: 02/03/2026
    Repositório: https://github.com/GabrielaBomfati/2026-DWII
-->

<?php
    // Variáveis PHP - serão usadas no HTML abaixo
    $nome = "Gabriela Bomfati Garcia";
    $profissao = "Estudante de  Tecnologia";
    $curso = "Técnico em Informática - IFPR";
    $pagina_atual = "inicio";
    ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfólio - <?php echo $nome; ?></title>
    <style>
        body {
                font-family: Arial, sans-serif; margin: 0; background: white;
        }
       
        .hero {
                border:4px solid #af06d1; color:#570b57; text-align: center; padding: 60px 20px; margin: 20px;
        }
        .hero h1 {
                font-size: 2.5em; margin-bottom: 10px;
        }
        .hero p {
                font-size: 1.2em; opacity: 0.9;
        }
        .container {
                max-width: 800px; margin: 40px auto; padding: 0 20px;
        }
</style>
</head>

<body>

    <!-- Substitua o bloco <nav>...</nav> por: -->
     <?php include 'includes/cabecalho.php'; ?>

    <div class="hero">
        <h1><?php echo $nome; ?></h1>
        <p><?php echo $profissao; ?> | <?php echo $curso; ?></p>
    </div>

    <div class="container">
    <h2>Bem-vindo ao meu portfólio</h2>
    <p> Está página foi gerada pelo PHP em:
        <strong><?php echo date("d/m/Y \à\s H:i:s"); ?></strong></p>
    </div>

    <!-- Substitua o bloco <footer>...</footer> por: -->
     <?php include 'includes/rodape.php'; ?>

</body> 
</html>
