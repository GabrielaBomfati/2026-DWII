<?php
/**
 * Disciplina: Desenvolvimento Web II (DWII)
 * Aula: 07 - CRUD: Create e Read
 * Arquivo: 05_crud/index.php
 * Autor: Gabriela Bomfati Garcia
 * Data: 30/03/2026
 * Descrição: Exibe o formulário de cadastro e processa o INSERT
 */

// Proteção: apenas usuários autenticados 
require_once __DIR__ . '/../04_sessoes/includes/auth.php';
requer_login();

// Dependências
require_once __DIR__ . '/includes/conexao.php';

// Busca todos os projetos ordenados pelo mais recente
$pdo = conectar();
$busca = trim($_GET['busca'] ?? '');

$filtroTec = $_GET['tecnologia'] ?? '';

// buscar tecnologias únicas do banco
$sqlTec = 'SELECT DISTINCT tecnologias FROM projetos ORDER BY tecnologias';
$stmtTec = $pdo->query($sqlTec);
$tecnologias = $stmtTec->fetchAll(PDO::FETCH_COLUMN);

$condicoes = [];
$params = [];

if ($busca !== '') {
    $condicoes[] = 'nome LIKE :termo';
    $params[':termo'] = '%' . $busca . '%';
}
if ($filtroTec !== '') {
    $condicoes[] = 'tecnologias = :tec';
    $params[':tec'] = $filtroTec;
}
$sql = 'SELECT * FROM projetos';
if ($condicoes) {
    $sql .= ' WHERE ' . implode(' AND ', $condicoes);
}
$sql .= ' ORDER BY criado_em DESC';
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$projetos = $stmt->fetchAll();

// Mensagem de sucesso após o cadastro
$cadastroOk = isset($_GET['cadastro']) && $_GET['cadastro'] === 'ok';

$titulo_pagina = 'Meus Projetos - Portfólio';
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
    <div style="display: flex; justify-content: space-between;
                align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 20px;">
        <h1 class="titulo-secao" style="margin-top: 0;">🗂️ Meus Projetos</h1>
        <a href="cadastrar.php" class="btn-primario">➕ Novo Projeto</a>
        
        <div class="form-container">
        <form  method="get">
            <input type="text" name="busca"
                   placeholder="Buscar projeto pelo nome..."
                   value="<?php echo htmlspecialchars($_GET['busca'] ?? ''); ?>"
                   style="flex: 1; padding: 8px;">

        <select name="tecnologia" style="padding: 8px;">
        <option value="">Todas as tecnologias</option>
        <?php foreach ($tecnologias as $tec): ?>
            <option value="<?php echo htmlspecialchars($tec); ?>"
                <?php echo ($tec === $filtroTec) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($tec); ?>
            </option>
        <?php endforeach; ?>
        </select>
            <button type="submit" class="btn-secundario">🔍 Buscar</button>
        </form>
        </div>
    </div>

    <?php if ($cadastroOk):?>
        <div class="alerta-sucesso">
            <p style="margin: 0;">✅ Projeto cadastrado com sucesso!</p>
        </div>
    <?php endif; ?>
    <br>

    <?php if (empty($projetos)): ?>
        <!-- Estado vazio: nenhum projeto ainda -->
         <div class="card" style="text-align: center; 
                                 padding: 40px 20px; color: #6b7280;">
                    <p style="font-size: 40px; margin: 0 0 12px;">📭</p>
                    <p style="font-size: 16px; margin: 0 0 16px;">
                        Nenhum projeto cadastrado ainda.</p>
                    <a href="cadastrar.php" class="btn-primario">➕
                    Cadastrar o primeiro projeto</a>
        </div>

    <?php else: ?>
        <!-- Grade de projetos -->
         <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px;">
            <?php foreach ($projetos as $projeto): ?>
                <div class="card">
                    <h3 style="margin: 0 0 8px; color: #570b57; font-size: 17px;">
                        <?php echo htmlspecialchars($projeto['nome']); ?>
                    </h3>

                    <p style="margin: 0 0 10px; color: #374151; font-size: 14px; line-height: 1.6;">
                        <?php echo htmlspecialchars($projeto['descricao']); ?>
                    </p>

                    <p style="margin: 0 0 6px; color: #6b7280; font-size: 14px;">
                       🛠️ <?php echo htmlspecialchars($projeto['tecnologias']); ?>
                    </p>

                    <p style="margin: 0 0 12px; color: #6b7280; font-size: 14px;">
                       🗓️ <?php echo htmlspecialchars($projeto['ano']); ?>
                    </p>

                    <?php if ($projeto['link_github']): ?>
                        <a style="#570b57;" href="<?php echo htmlspecialchars($projeto['link_github']); ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="btn-secundario">🔗 Ver no GitHub</a>
                    <?php endif; ?>
                    <a style="color: #570b57;" href="detalhe.php?id=<?php echo $projeto['id']; ?>"
                        class="btn-secundario"> 🔓 Ver detalhes</a>
                </div>
            <?php endforeach; ?>
        </div>

        <p style="margin-top: 16px; font-size: 14px; color: #6b7280; text-align: right;">
            <?php echo count($projetos); ?> projeto(s) cadastrado(s)
        </p>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
    
</body>
</html>