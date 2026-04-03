<?php
/**
 * Disciplina: Desenvolvimento Web II (DWII)
 * Aula: 07 - CRUD: Create e Read
 * Arquivo: 05_crud/detalhe.php
 * Autor: Gabriela Bomfati Garcia
 * Data: 02/04/2026
 * Descrição: Exibe detalhes sobre o projeto cadastrado
 */

require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login();

require_once __DIR__ . '/includes/conexao.php';

// Validar ID
$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    die('ID inválido.');
}

// Buscar projeto
$pdo = conectar();
$sql = 'SELECT * FROM projetos WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);

$projeto = $stmt->fetch();

if (!$projeto) {
    die('Projeto não encontrado.');
}

$titulo_pagina = 'Detalhe do Projeto';
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
    <h1 class="titulo-secao">
        <?php echo htmlspecialchars($projeto['nome']); ?>
    </h1>

    <p><strong>Descrição:</strong><br>
        <?php echo nl2br(htmlspecialchars($projeto['descricao'])); ?>
    </p>

    <p><strong>Tecnologias:</strong><br>
        <?php echo htmlspecialchars($projeto['tecnologias']); ?>
    </p>

    <p><strong>Ano:</strong>
        <?php echo htmlspecialchars($projeto['ano']); ?>
    </p>

    <?php if ($projeto['link_github']): ?>
        <p>
            <a style="#570b57;" href="<?php echo htmlspecialchars($projeto['link_github']); ?>"
               target="_blank"
               class="btn-secundario">
               🔗 Ver no GitHub
            </a>
        </p>
    <?php endif; ?>

    <p style="margin-top: 20px; color: #570b57;">
        <a href="index.php">Voltar</a>
    </p>
</div>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
</body>
</html>