<?php
/**
 * Disciplina: Desenvolvimento Web II (DWII)
 * Aula: 07 - CRUD: Create e Read
 * Arquivo: 05_crud/cadastrar.php
 * Autor: Gabriela Bomfati Garcia
 * Data: 30/03/2026
 * Descrição: Exibe o formulário de cadastro e processa o INSERT
 */

// Proteção: apenas usuários autenticados 
require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login();

// Dependências
require_once __DIR__ . '/includes/conexao.php';

$erro = '';
$sucesso = '';

// Preserva os valores do formulário em caso de erro
$form = [
    'nome' => '',
    'descricao' => '',
    'tecnologias' => '',
    'link_github' => '',
    'ano' => date('Y'),
];

//Processamento do POST
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    // 1.Captura e sanitiza entradas
    $form['nome'] = trim($_POST['nome'] ?? '');
    $form['descricao'] = trim($_POST['descricao'] ?? '');
    $form['tecnologias'] = trim($_POST['tecnologias'] ?? '');
    $form['link_github'] = trim($_POST['link_github'] ?? '');
    $form['ano'] = trim($_POST['ano'] ?? date ('Y'));

    // 2.Validação básica (campos obrigatorios)
    if ($form['nome'] === ''){
        $erro = 'O nome do projeto é obrigatório.';
    }elseif ($form['descricao'] === ''){
        $erro = 'A descrição do projeto é obrigatória.';
    }elseif ($form['tecnologias'] === ''){
        $erro = 'Informe ao menos uma tecnologia.';
    }elseif ($form['ano'] < 2000 || $form['ano'] > (int) date ('Y') + 1){
        $erro = 'Ano inválido.';
    }

    //3.Persiste no banco se não há erros
    if($erro === ''){
        $pdo = conectar();

        $sql = 'INSERT INTO projetos (nome, descricao, tecnologias, link_github, ano)
                VALUES (:nome, :descricao, :tecnologias, :link_github, :ano)';

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'nome' => $form ['nome'],
            'descricao' => $form ['descricao'],
            'tecnologias' => $form ['tecnologias'],
            'link_github' => $form ['link_github'] !== '' ? $form ['link_github'] : null ,
            'ano' => $form['ano'],
        ]);

        // 4. Redireciona para a listagem após sucesso
        header('Location: index.php?cadastro=ok');
        exit;
    }
}

$titulo_pagina = 'Cadastrar Projeto - Portfólio';
$caminho_raiz = '../';
$pagina_atual = 'crud';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php require_once __DIR__ . '/../includes/cabecalho.php'; ?>
</head>
<body>

<div class="container">
    <h1 class="titulo-secao">➕ Cadastrar Novo Projeto</h1>

    <?php if ($erro): ?>
        <div class="alerta-erro">
            <p style="margin: 0; font-size: 14px;">🚫 <?php echo
            htmlspecialchars($erro); ?></p>
        </div>
    <?php endif; ?>

    <div class="form-container">
        <form action="cadastrar.php" method="post">
            <label for="nome">Nome do Projeto: <span 
            style="color: #cf1c21;">*</span></label>
            <input type="text"
                    id="nome"
                    name ="nome"
                    value="<?php echo htmlspecialchars($form['nome']); ?>"
                    placeholder="Ex.: Sistema de Login com PHP"
                    maxlength="120">

            <label for="descricao">Descrição do Projeto: <span 
            style="color: #cf1c21;">*</span></label>
            <textarea id="descricao"
                      name ="descricao"
                      rows="4"
                      placeholder="Descreva o projeto em 2-3 frases...">
                      <?php echo htmlspecialchars($form['descricao']); ?></textarea>

            <label for="tecnologias">Tecnologias usadas: <span 
            style="color: #cf1c21;">*</span></label>
            <input type="text"
                    id="tecnologias"
                    name ="tecnologias"
                    value="<?php echo htmlspecialchars($form['tecnologias']); ?>"
                    placeholder="Ex.:PHP, MariaDB, HTML, CSS"
                    maxlength="200">

            <label for="link_github">Link do GitHub: <span 
            style="color: #6b7280; font-weight: normal;">(opcional)</span></label>
            <input type="url"
                    id="link_github"
                    name ="link_github"
                    value="<?php echo htmlspecialchars($form['link_github']); ?>"
                    placeholder="https://github.com/usuario/repositorio">

            <label for="ano">Ano: <span 
            style="color: #cf1c21;">*</span></label>
            <input type="number"
                    id="ano"
                    name ="ano"
                    value="<?php echo htmlspecialchars($form['ano']); ?>"
                    min="2000"
                    max="<?php echo date('Y') + 1; ?>">

            <button type="submit"> 💾 Salvar Projeto</button>

        </form>
    </div>

    <p style="margin-top: 20px; text-align: center;">
        <a href="index.php" style="color: #570b57;"> Voltar à listagem</a>
    </p>

</div>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
    
</body>
</html>