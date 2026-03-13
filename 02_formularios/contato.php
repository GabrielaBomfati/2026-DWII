<?php
/**
 * ==================================================================
 * ARQUIVO: 02_formularios/contato.php (versão com validação)
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 04 - PHP para Web: Fomrulários, GET e POST
 * Autor: Gabriela Bomfati Garcia
 * Conceitos: $_SERVER, REQUEST_METHOD, trim(), empty(),
 *            strlen(), array de erros, separação lógica/visual
 * =====================================================================
 * 
 * Página de contato - primeira versão com GET.
 * cabaecalho.php gerar o <head> completo (incluindo o <link>
 * para style.css) e o <bofy> até o <main>
 */

// VARIÁVEIS DO TEMPLATE
// Definida ANTES do include - cabecalho.php as usa par 
// montar o <title>, o <link> do CSS e o item ativo do menu.
$nome = "Gabriela Bomfati Garcia";
$pagina_atual = "contato";
$caminho_raiz = "../"; // sobe de 02_formularios/ até a raiz
$titulo_pagina = "Contato";

// RECEBER DADOS DO FORUMLARIO
// $_GET é um array superglobal - PHP preenche4 automaticamente
// com os parâmetros da URL

// ?? '' é o operador nul coalescing:
// retorna o valor de $_GET['chave'] se existir,
// ou '' se a chave não existir (ex: primeira visita, sem envio)
// ESTADO INICIAL
// Inicializamos as variáveis vazias para que o HTML abaixo
// possa referenciá-las mesmo antes de qualquer envio.
$nome_visitante = '';
$mensagem = '';
$erros = []; // array vazio = nenhum erro ainda
// PROCESSAR SOMENTE SE VEIO POST
// $_SERVER['REQUEST_METHOD'] informa como a página foi acessada.
// 'POST' = usuario clicou em Enviar. Qualuqer outro valor 
// significa que foi um acesso direto - não há dados para processar.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // trim() remove espaços das bordas - evita aceitar " " como válido
    $nome_visitante = trim($_POST['nome_visitante'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');

//VALIDAÇÕES
// $erros[] = 'texto' adiciona um item ao array.
// Ao final, se $erros estiver vazio, todos os campos são válidos
if (empty($nome_visitante)){
    $erros[] = 'O campo Nome é obrigatório.';
}
if (empty($mensagem)){
    $erros[] = 'O campo Mensagem é obrigatório.';
} elseif (strlen($mensagem) < 10){
    // elseif evita duplicar erro qaundo $mensagem já está vazia
    $erros[] = "A mensagem deve ter pelo menos 10 caracteres.";
}
}
// REDIRECIONAR SE NÃO HÁ ERROS
// header() instrui o navegador a ir pra outra URL
// OBRIGATORIO: chamado antes de qualuqer saída HTML.
// urlencode() codifica o nome para uso seguro na URL
// (ex: "Ana Lima" vira "Ana + Lima")
// exit encerra o PHP imediatamente - sem exit, o código
// abaixo continuaria executando mesmo após o redirect.
if (empty($erros) && $_SERVER['REQUEST_METHOD'] === 'POST'){
    header('Location: obrigado.php?nome=' . urlencode($nome_visitante));
    exit;
}

?>

<!--cabecalho.php gera tudo até <body>--> 
<?php include '../includes/cabecalho.php'; ?>

<div class="container">
    <h1 class="titulo-secao"> 📬 Formulário de Contato</h1>
    <?php if (!empty($erros)): ?>
<div class="alerta-erro">
    <h3>🚫 Corrija os erros:</h3>

    <?php foreach ($erros as $erro): ?>
        <p><?php echo htmlspecialchars($erro); ?></p>
    <?php endforeach; ?>

</div>
<?php endif; ?>

<!-- action="contao.php" - envia para a prórpia página (auto-submit)
 method="get" - dados vão na URL; vamos observar isso
 Sem CSS inline: tofdo o visual vem do style.css via cabecalho.php
-->
 <form class="form-container" action="contato.php" method="post">
    <label>Seu nome:</label>
    <input type="text" name="nome_visitante">

    <label>Sua mensagem:</label>
    <textarea name="mensagem" rows="4"></textarea>

    <button type="submit">Enviar</button>

</form>



<?php include '../includes/rodape.php'; ?>
