<?php
/**
 * Disciplina: Desenvolvimento Web II (DWII)
 * Aula: 07 - CRUD Completo: Update
 * Arquivo: 05_crud/editar.php
 * Autor: Gabriela Bomfati Garcia
 * Data: 06/04/2026
 * Descrição: Implementa o U do CRUD (Update).
 *            Este arquivo tem três responsabilidades:
 *            1. Validar o ID recebido via GET
 *            2. Exibir formulário preenchido com dados atuais (GET)
 *            3. Processar as alterações e executar UPDATE (POST)
 */

// Proteção: apenas usuários autenticados 
require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login();

// Dependências
require_once __DIR__ . '/includes/conexao.php';

// Validação do ID - Camada 1: formato
// O ID chega pel URL: editar.php?id=5
// (int) converte para inteiro - "abc" vira 0, "5" vira 5.
$id = (int) ($_GET['id'] ?? 0);

// ID deve ser positivo - 0 ou negativo é entrada inválida.
if ($id <=0){
    header('Location: index.php?erro=id_invalido');
    exit;
}

// Validação do ID - Camada 2: existência no banco
// Um inteiro positivo com 999 pode não existir na tabela.
// Fazemos o SELECT antes de qualquer operação para confirmar.
$pdo = conectar();
$stmt = $pdo->prepare('SELECT * FROM projetos WHERE id = :id');
$stmt->execute([':id' => $id]);
$projeto = $stmt->fetch();
// fetch() retorna array associativo se encontrar, ou false se não.

if(!$projeto){
    header('Location: index.php?erro=nao_encontrado');
    exit;
}

// A partir daqui, $projeto tem os dados atuais do registro

// Variável de erro
$erro = '';

// Processamento do POST (UPDATE)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

// Captura e sanitiza
$nome = trim($_POST['nome'] ?? '');
$descricao = trim($_POST['descricao'] ?? '');
$tecnologias = trim($_POST['tecnologias'] ?? '');
$link_github = trim($_POST['link_github'] ?? '');
$ano = (int) ($_POST['ano'] ??  date ('Y'));

// Validação
if ($nome === '' || $descricao === '' || $tecnologias === '') 
    { $erro = 'Preencha todos os campos obrigatórios.';
    }

    // UPDATE - só executa se nãi há erro
    if ($erro === ''){
        //WHERE id = :id é OBRIGATÓRIO
        //Sem ele, TODOS, os registros da tabela seriam alterados.
        $sql = 'UPDATE projetos
                SET nome = :nome,
                    descricao = :descricao,
                    tecnologias = :tecnologias,
                    link_github = :link_github,
                    ano = :ano
                WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nome' => $nome,
            ':descricao' => $descricao,
            ':tecnologias' => $tecnologias,
            ':link_github' => $link_github !== '' ? $link_github : null,
            ':ano' => $ano,
            ':id' => $id,
            // :id no WHERE garante que só este registro é alterado
        ]);

        // Padrão PRG: redireciona após o UPDATE
        header('Location: index.php?editado=ok');
        exit;
    }

    // se houver erro, atualiza $projeto com o que o usuário digitou
    // para reexibir no formulário sem perder o conteúdo.
    $projeto['nome'] = $nome;
    $projeto['descricao'] = $descricao;
    $projeto['tecnologias'] = $tecnologias;
    $projeto['link_github'] = $link_github;
    $projeto['ano'] = $ano;
}

// Variáveis para o cabecalho.php
$titulo_pagina = 'Editar Projeto - Portfólio';
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
    <h1 class="titulo-secao">✏️ Editar Projeto</h1>

    <!-- Mensagem de erro de validação --> 
    <?php if ($erro): ?>
        <div class="alerta-erro">
            <p style="margin: 0;">🚫 <?php echo htmlspecialchars($erro); ?></p>
        </div>
    <?php endif; ?>

    <!-- Formulário de edição
        action inclui o ID na URL para que, ao submeter via POST,
        o arquivo ainda acesse o ID pelo $_GET['id']. --> 
    <form action="editar.php?id=<?php echo $id; ?>" method="post" class="formulario">

        <div class="campo">
            <label class="label-campo">Nome do Projeto *</label>
            <!-- value preenchido com dados atuais do banco (ou digitados, se houve erro) --> 
            <input type="text" name="nome" class="input-texto"
                   value="<?php echo htmlspecialchars($projeto['nome']); ?>">
        </div>

        <div class="campo">
            <label class="label-campo">Descrição *</label>
            <textarea name="descricao" class="input-texto" rows="4">
                      <?php echo htmlspecialchars($projeto['descricao']); ?></textarea>
        </div>

        <div class="campo">
            <label class="label-campo">Tecnologias *</label>
            <input type="text" name="tecnologias" class="input-texto"
                   value="<?php echo htmlspecialchars($projeto['tecnologias']); ?>">
        </div>

        <div class="campo">
            <label class="label-campo">Link GitHub (opcional)</label>
            <input type="url" name="link_github" class="input-texto"
                   value="<?php echo htmlspecialchars($projeto['link_github'] ?? ''); ?>">
        </div>

        <div class="campo">
            <label class="label-campo">Ano *</label>
            <input type="number" name="ano" class="input-texto"
                    value="<?php echo (int) $projeto['ano']; ?>"
                    min="2000" max="2099">
        </div>

        <div style="display: flex; gap: 12px; margin-top: 8px;">
            <button type="submit" class="btn-primario">💾 Salvar Alterações</button>
            <a style="color: #570b57;" href="index.php" class="btn-secundario">Cancelar</a>
        </div>

    </form>

</div>
<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
    
</body>
</html>
