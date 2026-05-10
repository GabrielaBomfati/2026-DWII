<?php
/** 
 * Disciplina: Desenvolvimento Web II (DWII)
 * Projeto: Portfólio Pessoa - versão refatorada
 * Arquivo: catalogo.php (migrado de 03_pdo/index.php)
 * Autor: Gabriela Bomfati Garcia
 * Data: 09/05/2026
 * Descrição: Lista pública de tecnologias do banco unificado.
 * Exibe apenas registros com status = 'ativo'
*/

// session_start() é idempotente: já iniciada não dá erro,
// mas chamar duas vezes gera warning. session_status() evita isso.
if (session_status() === PHP_SESSION_NONE) session_start();

// Variáveis usadas pelo cabeçalho global

$titulo_pagina = "Catálogo de Tecnologias | Portfólio DWII";
$pagina_atual = "catalogo";
$caminho_raiz = './';

// Inclui a conexão PDO - disponibiliza a variável $pdo
require_once __DIR__ .'/includes/conexao.php';

$pdo = conectar();

$stmtCat = $pdo->query("SELECT DISTINCT categoria FROM tecnologias WHERE status = 'ativo' ORDER BY categoria");
$categorias = $stmtCat->fetchAll();


// Buscar todos os requisitos - query() para SELECTs sem parâmetros
// Capturar o filtro da URL (vazio se não existir)
$busca = trim($_GET['busca'] ?? '');
$categoria = trim($_GET['categoria'] ?? '');

if ($busca) {
    $stmt = $pdo->prepare(
    "SELECT * FROM tecnologias 
     WHERE status = 'ativo' AND (nome LIKE :termo1 OR descricao LIKE :termo2) 
     ORDER BY nome");

$stmt->execute([
    'termo1' => "%$busca%",
    'termo2' => "%$busca%"
]);
    
} elseif ($categoria) {
    $stmt = $pdo->prepare(
        "SELECT * FROM tecnologias 
         WHERE status = 'ativo' AND categoria = :cat 
         ORDER BY nome");
         
    $stmt->execute([
        'cat' => $categoria
    ]);

} else {
    $stmt = $pdo->query("SELECT * FROM tecnologias WHERE status = 'ativo' ORDER BY nome");
}

$tecnologias = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include  __DIR__ . '/includes/cabecalho.php'; ?>
</head>
<body>
    <!-- Container e classes vêm do CSS global -->
<div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;"> 
    <h1 class="titulo-secao" style="margin: 0;">🗄️ Catálogo de Tecnologias</h1>
    <span style="color: #6b7280; font-size: 14px;">
        <?php echo count($tecnologias); ?> tecnologia(s)</span>
    </div>
    <!-- FORM DE BUSCA -->
<form method="get" style="margin-bottom: 15px;">
    <input type="text" name="busca" placeholder="Buscar tecnologia..." 
           value="<?php echo htmlspecialchars($busca); ?>">
    <button type="submit">Buscar</button>
</form>
<div class="filtro-categorias">
    <span>Filtrar por:</span>

    <a href="catalogo.php" class="<?php echo !$categoria ? 'ativo' : ''; ?>">
        Todos
    </a>

    <?php foreach ($categorias as $cat): ?>
        <a href="catalogo.php?categoria=<?php echo urlencode($cat['categoria']); ?>"
           class="<?php echo $categoria === $cat['categoria'] ? 'ativo' : ''; ?>">
           
            <?php echo htmlspecialchars($cat['categoria']); ?>
        </a>
    <?php endforeach; ?>
</div>
    
    <?php if (empty($tecnologias)): ?>
        <!-- Estado vazio: nenhuma tecnologia ativa cadastrada. -->
         <div class="card" style="text-align: center; padding: 40px 20px; color: #6b7280;">
            <p style="font-size: 40px; margin: 0 0 12px;">📭</p>
            <p style="font-size: 16px; margin: 0;">Nenhuma tecnologia ativa.</p>
         </div>
    <?php else: ?>

    <!-- Loop pelos registros do banco -->
     <?php foreach ($tecnologias as $tec): ?>
        <div class="card">
            <div style = "display: flex; justify-content: space-between; align-items: center;">
                <!-- htmlspecialchars{} protege contra XSS -->
                 <h3 style="margin: 0;"> <?php echo htmlspecialchars($tec['nome']); ?> </h3>
                 <span style ="background: #dd9cdd; color: #570b57; padding:3px 10px;
                 border-radius:20px; font-size: 14px; white-space: nowrap;">
                 <?php echo htmlspecialchars($tec['categoria']); ?>
                </span>
            </div>
            <p style="margin: 0 0 10px;"> <?php echo htmlspecialchars($tec['descricao']); ?></p>

        <!-- (int) sobre ID: cast defensivo. Mesmo vindo do banco como string,
         garantimos que só inetiro entra na URL. -->
         <a href="detalhe.php?id=<?php echo (int) $tec['id']; ?>&categoria=<?php echo urlencode($categoria); ?>"
         style="color: #570b57; font-size: 14px; font-weight: bold;
         display: inline-block; margin-top: 10px;"
        class="btn-secundario" >Ver detalhes</a>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>

   <!-- Rodapé global via proxy local -->
    <?php include __DIR__ . '/includes/rodape.php'; ?>

</body>
</html>