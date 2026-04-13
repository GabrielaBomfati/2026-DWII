<!--
 * Disciplina: Desenvolvimento Web II (DWII)
 * Aula: 05 - PHP + MariaDB: persistência de dados via PDO
 * Autor: Gabriela Bomfati Garcia
 * Data: 21/03/2026
-->
<?php

// VARIÁVEIS DO TEMPLATE
$nome = "Gabriela Bomfati Garcia";
$pagina_atual = "catalogo";
$caminho_raiz = "../";
$titulo_pagina = "Página não encontrada";

// Define o código HTTP 404
http_response_code(404);
?>

<!-- Cabeçalho global -->
<?php include 'includes/cab_pdo.php'; ?>

<div class="container confirmacao404">
    <p class="confirmacao-icone">❌</p>

    <h1 class="confirmacao-titulo404">
        Erro 404
    </h1>

    <p class="confirmacao-texto">
        A tecnologia que você tentou acessar não foi encontrada.
    </p>

    <a href="index.php" class="btn404"> Voltar ao catálogo</a>
</div>

<!-- Rodapé global -->
<?php include 'includes/rod_pdo.php'; ?>