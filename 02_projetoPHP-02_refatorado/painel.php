<?php
/**
 * Disciplina: Desenvolvimento Web II (DWII)
 * Arquivo: painel.php (raiz)
 * Descrição: Área restrita - exige login via includes/auth.php 
 */

require_once __DIR__ . '/includes/auth.php';
requer_login();

$pagina_atual = 'painel';
$titulo_pagina = 'Painel - Portfólio';
$caminho_raiz = './';

require_once __DIR__ . '/includes/cabecalho.php';
?>

<main style="max-width: 900px; margin: 40px auto; padding: 0 20px;">
    <h1>📊 Painel</h1>
    <p>Olá, <strong><?= htmlspecialchars(usuario_atual()) ?></strong>!
    Você está em uma área restrita.
    </p>

    <p>Em breve, está página listará seus projetos para edição
        (a ser implementado na <strong>Aula 13 - Refatoração Parte V</strong>).
    </p>

    <p><a style="color: #570b57;" href="logout.php">Sair</a></p>
</main>

<?php require_once __DIR__ . '/includes/rodape.php'; ?>
