<?php
/**
 * Disciplina: Desenvolvimento Web II (DWII)
 * Aula: 07 - CRUD Completo: Delete
 * Arquivo: 05_crud/excluir.php
 * Autor: Gabriela Bomfati Garcia
 * Data: 10/04/2026
 * Descrição: Implementa o D do CRUD (Delete).
 *            Este arquivo tem três responsabilidades:
 *            1. Validar o ID recebido via GET
 *            2. Exibir tela de confirmação (GET)
 *            3. Processar o DELETE após confirmação (POST)
 * 
 *            REGRA: DELETE nunca é executado via GET.
 *            Somente um POST intencional dispara a remoção.
 */

// Proteção: apenas usuários autenticados 
require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login();

// Dependências
require_once __DIR__ . '/includes/conexao.php';

// Validação do ID - Camada 1: formato
$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    header('Location: index.php?erro=id_invalido');
    exit;
}

// Validação do ID - Camada 2: existência no banco
// Buscamos apenas o nome - suficiente para a tela de confirmação.
$pdo = conectar();
$stmt = $pdo->prepare('SELECT nome FROM projetos WHERE id = :id');
$stmt->execute([':id' => $id]);
$projeto = $stmt->fetch();

if(!$projeto){
    header('Location: index.php?erro=nao_encontrado');
    exit;
}

//Processamento do POST (DELETE) 
//Este bloco SÓ executa quando o usuário confirma a exclusão.

//Por que POST e não GET?
// GET pode ser acionado por bots, prefetch de navegador ou links
// em e-mails - sem interação intencional do usuário.
// POST exige submissão deliberada de formulário.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // WHERE obrigatório - sem ele, TODOS os registros seriam removidos.
    $stmt = $pdo->prepare('DELETE FROM projetos WHERE id= :id');
    $stmt->execute([':id' => $id]);

    // Padrão PRG: redireciona após o UPDATE
    header('Location: index.php?excluido=ok');
    exit;
}

// Variáveis para o cabecalho.php
// Só chegamos aqui na requisição GET (exibir confirmação)
$titulo_pagina = 'Excluir Projeto - Portfólio';
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

    <h1 class="titulo-secao">🗑️ Confirmar Exclusão</h1>

    <!-- Tela de confirmação - exibida apenas via GET --> 
    <div class="card" style="max-width: 480px;">

        <p style="font-size: 16px; margin: 0 0 8px;">
            Você está prestes a excluir o projeto: 
        </p>

        <p style="font-size: 18px; font-weight: bold; 
                  color: #3b579d; margin: 0 0 16px;">
                  <?php echo htmlspecialchars($projeto['nome']); ?>
                <!-- htmlspecialchars() previne XSS: se o nome tiver caracteres HTML
                eles são exibidos como texto --> </p>

        <p style="font-size: 14px; color: #cf1c21; margin: 0 0 20px;">
            ⚠️ Esta ação <strong>não pode ser desfeita</strong>.
        </p>

        <!-- Formulário de confirmação
            O formulário submete via POST para este mesmo arquivo,
            mantendo o ID na URL para o bloco de DELETE acima. --> 
        <form action="excluir.php?id=<?php echo $id; ?>" method="post">
            <div style="display: flex; gap: 12px;">
                <!-- Confirma: dispara o POST - executa DELETE --> 
                <button type="submit" class="btn-perigo">🗑️ Sim, excluir</button>
                <!-- Cancela: volta a listagem sem alterar o banco --> 
                 <a href="index.php" class="btn-secundario">Cancelar</a>
            </div>
        </form>
     </div>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
    
</body>
</html>

