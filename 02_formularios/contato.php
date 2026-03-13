<?php
/**
 * ==================================================================
 * ARQUIVO: 02_formularios/contato.php (versão com validação)
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 04 - PHP para Web: Formulários, GET e POST
 * Autor: Gabriela Bomfati Garcia
 * Conceitos: $_SERVER, REQUEST_METHOD, trim(), empty(),
 *            strlen(), array de erros, separação lógica/visual
 * =====================================================================
 * 
 * Página de contato - primeira versão final.
 * cabaecalho.php gerar o <head> completo (incluindo o <link>
 * para style.css) e o <bofy> até o <main>
 */


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
$email = '';
$assunto = '';
$erros = []; // array vazio = nenhum erro ainda
// PROCESSAR SOMENTE SE VEIO POST
// $_SERVER['REQUEST_METHOD'] informa como a página foi acessada.
// 'POST' = usuario clicou em Enviar. Qualuqer outro valor 
// significa que foi um acesso direto - não há dados para processar.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // trim() remove espaços das bordas - evita aceitar " " como válido
    $nome_visitante = trim($_POST['nome_visitante'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $assunto = trim($_POST['assunto'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');

//VALIDAÇÕES
// $erros[] = 'texto' adiciona um item ao array.
// Ao final, se $erros estiver vazio, todos os campos são válidos
if (empty($nome_visitante)){
    $erros[] = 'O campo Nome é obrigatório.';
}
if (empty($email)) {
        $erros[] = 'O campo E-mail é obrigatório.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erros[] = 'Informe um e-mail válido.';
}

if (empty($assunto)) {
    $erros[] = 'Selecione um assunto.';
}

if (empty($mensagem)){
    $erros[] = 'O campo Mensagem é obrigatório.';
} elseif (strlen($mensagem) < 10){
    // elseif evita duplicar erro qaundo $mensagem já está vazia
    $erros[] = "A mensagem deve ter pelo menos 10 caracteres.";
} elseif (strlen($mensagem) > 500){
    $erros[] = "A mensagem deve ter no máximo 500 caracteres.";
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
    header('Location: obrigado.php?nome=' . urlencode($nome_visitante) . '&assunto=' . urlencode($assunto));
    exit;
}
// VARIÁVEIS DO TEMPLATE
// Definida ANTES do include - cabecalho.php as usa par 
// montar o <title>, o <link> do CSS e o item ativo do menu.
$nome = "Gabriela Bomfati Garcia";
$pagina_atual = "contato";
$caminho_raiz = "../"; // sobe de 02_formularios/ até a raiz
$titulo_pagina = "Contato";
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
    <input type="text" name="nome_visitante"
    value="<?php echo htmlspecialchars($nome_visitante); ?>">

    <label>Seu e-mail:</label>
    <input type="email" name="email"
    value="<?php echo htmlspecialchars($email); ?>">

    <label>Assunto:</label>
    <select name="assunto">
    <option value="">Selecione um assunto</option>
    <option value="Duvida"
    <?php if ($assunto === 'Duvida') echo 'selected'; ?>>
    ❓ Dúvida
    </option>

    <option value="Proposta de trabalho"
    <?php if ($assunto === 'Proposta de trabalho') echo 'selected'; ?>>
     👩🏻‍💻 Proposta de trabalho
    </option>

    <option value="Colaboracao"
    <?php if ($assunto === 'Colaboracao') echo 'selected'; ?>>
    ℹ️  Colaboração
    </option>

    <option value="Outro"
    <?php if ($assunto === 'Outro') echo 'selected'; ?>>
    ➡️  Outro
    </option>
</select>

    <label>Sua mensagem:</label>
    <textarea name="mensagem" rows="4"><?php echo htmlspecialchars($mensagem); ?></textarea>
    <p class= "contador">
    <?php echo strlen($mensagem); ?> de 500 caracteres usados
    </p>
    <button type="submit">Enviar</button>

</form>

<?php include '../includes/rodape.php'; ?>
