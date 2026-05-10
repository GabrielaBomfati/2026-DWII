<?php
/** 
 * Disciplina: Desenvolvimento Web II (DWII)
 * Projeto: Portfólio Pessoa - versão refatorada
 * Arquivo: detalhe.php (migrado de 03_pdo/detalhe.php)
 * Autor: Gabriela Bomfati Garcia
 * Data: 09/05/2026
 * Descrição: Detalhe de uma tecnologia. Acessada via GET ?id=N
 * Usa prepared statement para prevenir SQL Injection.
 * Exibe apenas registros com status = 'ativo'
*/

// session_start() é idempotente: já iniciada não dá erro,
// mas chamar duas vezes gera warning. session_status() evita isso.
if (session_status() === PHP_SESSION_NONE) session_start();

// $pagina_atual = 'catalogo' (não 'detalhe') porque queremos que o item "Catálogo"
// do nav fique destacado em ambas as páginas.
// Pedagogicamente: detakhe é uma sub-página de catálogo
$titulo_pagina = "Detalhe | Portfólio DWII";
$pagina_atual = "catalogo";
$caminho_raiz = './';

// incluir a conexão PDO
require_once __DIR__ . '/includes/conexao.php';

// filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT):
// - retorna o INT se a string for um inteiro válido
// - retorna FALSE se não for inteiro
// - retorna NULL se 'id' não estiver na URL
// Já elimina entrada maliciosa antes mesmo de chegar ao banco.
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$categoria = trim($_GET['categoria'] ?? '');

// Além do filter_input, exigimos id > 0.
// IDs sempre começam em 1 - qualquer valor <= 0 é entrada inválida.
if(!$id || $id <= 0){
    header('Location: catalogo.php');
    exit; // SEMPRE após header() - sem exit, código continua executando
}
$pdo = conectar();

//Prepared statement: o valor :id é enviado SEPARADO da string SQL.
// O banco trata como dados, NUNCA como código. SQL Injection fica impossível
$stmt = $pdo->prepare("SELECT * FROM tecnologias WHERE id = :id AND status = 'ativo' LIMIT 1");
$stmt->execute (['id' => $id]);
$tec = $stmt->fetch(); // fetch() retorna UMA linha (ou false se não encontrou)

// $tec === false quando: id não existe OU está inativo
// Em qualquer caso,, redirecionamos sem revelar o motivo
// (boa prática: não dar pistas a quem está sondando).
if (!$tec) {
    header('Location: catalogo.php');
    exit;
}

$titulo_pagina = htmlspecialchars($tec['nome']) . ' | Portfólio DWII';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include __DIR__ . '/includes/cabecalho.php'; ?>
</head>
<body>
    <div class="container">
        <a href="catalogo.php<?php echo $categoria ? '?categoria=' . urlencode($categoria) : ''; ?>" style="color: #570b57; font-weight: bold; display: inline-block; margin-bottom: 20px;">
            Voltar ao catálogo</a>

        <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 16px;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <h1 class="titulo-secao" style="margin: 0;">
                        <?php echo htmlspecialchars($tec['nome']); ?>
                </h1>
                <span style="background: #dd9cdd; color: #570b57; padding: 4px 12px;
                            border-radius: 20px; font-size: 14px; white-space: nowrap; margin-left: 12px;" >
                    <?php echo htmlspecialchars($tec['categoria']); ?> 
                </span>
            </div>
            <p style="font-size: 16px; margin: 16px 0;">
                <?php echo htmlspecialchars($tec['descricao']); ?>
            </p>

            <!-- Tabela de metadados do registro -->
<table style="width: 100%; border-collapse: collapse; margin-top: 20px;
              font-size: 14px;">

    <tr style="background: #f3f4f6;">
        <td style="padding: 10px; border: 1px solid #e5e7eb;
                   font-weight: bold; width: 160px;">
            ID
        </td>

        <td style="padding: 10px; border: 1px solid #e5e7eb;">
            <?php echo $tec['id']; ?>
        </td>
    </tr>

    <tr>
        <td style="padding: 10px; border: 1px solid #e5e7eb;
                   font-weight: bold;">
            Ano de criação
        </td>

        <td style="padding: 10px; border: 1px solid #e5e7eb;">
            <?php echo $tec['ano_criacao']; ?>
        </td>
    </tr>

    <tr style="background: #f3f4f6;">
        <td style="padding: 10px; border: 1px solid #e5e7eb;
                   font-weight: bold;">
            Cadastrado em
        </td>

        <td style="padding: 10px; border: 1px solid #e5e7eb;">
            <?php echo date('d/m/Y \à\s H:i', strtotime($tec['criado_em'])); ?>
        </td>
    </tr>

</table>

</div>
</div>

<!-- Rodapé global via proxy local -->
<?php include __DIR__ . '/includes/rodape.php'; ?>

</body>
</html>