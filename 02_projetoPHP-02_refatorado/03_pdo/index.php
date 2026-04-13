<!--
 * Disciplina: Desenvolvimento Web II (DWII)
 * Aula: 05 - PHP + MariaDB: persistência de dados via PDO
 * Autor: Gabriela Bomfati Garcia
 * Data: 16/03/2026
-->
<?php
// Variáveis usadas pelo cabeçalho global (titulo da aba e menu ativo)
$titulo_pagina = "Catálogo de Tecnologias";
$pagina_atual = "catalogo";

// Inclui a conexão PDO - disponibiliza a variável $pdo
require_once 'includes/conexao.php';

$stmtCat = $pdo->query('SELECT DISTINCT categoria FROM tecnologias ORDER BY categoria');
$categorias = $stmtCat->fetchAll();


// Buscar todos os requisitos - query() para SELECTs sem parâmetros
// Capturar o filtro da URL (vazio se não existir)
$busca = trim($_GET['busca'] ?? '');
$categoria = trim($_GET['categoria'] ?? '');

if ($busca) {
    $stmt = $pdo->prepare(
    'SELECT * FROM tecnologias 
     WHERE nome LIKE :termo1 OR descricao LIKE :termo2 
     ORDER BY nome'
);

$stmt->execute([
    'termo1' => "%$busca%",
    'termo2' => "%$busca%"
]);
    
} elseif ($categoria) {
    $stmt = $pdo->prepare(
        'SELECT * FROM tecnologias 
         WHERE categoria = :cat 
         ORDER BY nome'
    );
    $stmt->execute(['cat' => $categoria]);

} else {
    $stmt = $pdo->query('SELECT * FROM tecnologias ORDER BY nome');
}

$tecnologias = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include 'includes/cab_pdo.php'; ?>
</head>
<body>
    <!-- Container e classes vêm do CSS global -->
<div class="container">
    <h1 class="titulo-secao">🗄️ Catálogo de Tecnologias</h1>
    <!-- FORM DE BUSCA -->
<form method="get" style="margin-bottom: 15px;">
    <input type="text" name="busca" placeholder="Buscar tecnologia..." 
           value="<?php echo htmlspecialchars($busca); ?>">
    <button type="submit">Buscar</button>
</form>
<div class="filtro-categorias">
    <span>Filtrar por:</span>

    <a href="index.php" class="<?php echo !$categoria ? 'ativo' : ''; ?>">
        Todos
    </a>

    <?php foreach ($categorias as $cat): ?>
        <a href="index.php?categoria=<?php echo urlencode($cat['categoria']); ?>"
           class="<?php echo $categoria === $cat['categoria'] ? 'ativo' : ''; ?>">
           
            <?php echo htmlspecialchars($cat['categoria']); ?>
        </a>
    <?php endforeach; ?>
</div>
    <p style="color: #6b7280; margin-bottom: 20px;">
        <?php echo count($tecnologias); ?> item(s) encontrado(s)
    </p>
    <!-- Loop pleos registros do banco -->
     <?php foreach ($tecnologias as $tec): ?>
        <div class=" card">
            <div style = "display: flex; justify-content: space-between; align-items: center;">
                <!-- htmlspecialchars{} protege contra XSS -->
                 <h3><?php echo htmlspecialchars($tec['nome']); ?> </h3>
                 <span style ="background: #dd9cdd; color: #570b57; padding:3px 10px;
                 border-radius:20px; font-size: 14px;">
                 <?php echo htmlspecialchars($tec['categoria']); ?>
                </span>
            </div>
            <p><?php echo htmlspecialchars($tec['descricao']); ?></p>

        <!-- Caminho absoluto /03_pdo/ garante que funcione de qualquer nível -->
         <a href="/03_pdo/detalhe.php?id=<?php echo $tec['id']; ?>&categoria=<?php echo urlencode($categoria); ?>"
         style="color: #570b57; font-size: 14px; font-weight: bold;
         display: inline-block; margin-top: 10px;">
         Ver detalhes
        </a>
    </div>
    <?php endforeach; ?>
   </div>

   <!-- Rodapé global via proxy local -->
    <?php include 'includes/rod_pdo.php'; ?>

</body>
</html>