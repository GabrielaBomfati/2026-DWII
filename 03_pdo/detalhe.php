<?php
// Caminho relativo da subpasta 03_pdo/ até a raiz (usanda pelo CSS global)
$caminho_raiz = '../';

// incluir a conexão PDO
require_once 'includes/conexao.php';

// Validar o ID recebido via GET - retorna false se não for inteiro válido
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if(!$id){
    // ID inválido ou ausente - redirecionar para a lista
    header('Location: index.php');
    exit;
}

// prepare() + execute() - NUNCA concatene variáveis no SQL (previne SQL injection
$stmt = $pdo->prepare('SELECT * FROM tecnologias WHERE id = :id');
$stmt->execute (['id' => $id]);
$tec = $stmt->fetch(); // fetch() retorna UMA linha (ou false se não encontrou)

if (!$tec) {
    // Registro não encontrado - redirecionar para a lista
    header('Location: index.php');
    exit;
}

// Variáveis para o cabeçalho global
$titulo_pagina = htmlspecialchars($tec['nome']) . "- Catálogo";
$pagina_atual = "catalogo";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!--Cabeçalho global via proxy local --> 
    <?php include 'includes/cab_pdo.php'; ?>
</head>
<body>
    <div class="container">
        <a href="index.php" style="color: #570b57; font-weight: bold;">
            Voltar ao catálogo</a>

        <div class="card" style="margin-top: 20px;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <h1 style="color: black; margin: 0 0 8px; font-size: 24px">
                        <?php echo htmlspecialchars($tec['nome']); ?>
                </h1>
                <span style="background: #dd9cdd; color: #570b57; padding: 4px 12px;
                            border-radius: 20px; font-size: 14px; font-weight: bold;
                            white-space: nowrap;">
                    <?php echo htmlspecialchars($tec['categoria']); ?> 
                </span>
            </div>
            <p style="font-size: 16px; margin: 16px 0;">
                <?php echo htmlspecialchars($tec['descricao']); ?>
            </p>

            <!-- Tabela de metados do registro -->
             <table style="width: 100%; border-collapse: collapse; margin-top: 20px;
                           font-size: 14px;">
                    <tr style="background: #f3f4f6;">
                    <td style="padding: 10px; border: 1px solid #e5e7eb; font-weight: bold;
                               width: 160px;">ID</td>
                        <td style="padding: 10px; border: 1px solid #e5e7eb;">
                            <?php echo $tec['id']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #e5e7eb; font-weight: bold;">
                            Ano de criação</td>
                        <td style="padding: 10px; border: 1px solid #e5e7eb;">
                            <?php echo $tec['ano_criacao']; ?>
                        </td>
                    </tr>
                    <tr style="background: #f3f4f6">
                        <td style="padding: 10px; border: 1px solid #e5e7eb;
                                   font-weight: bold;">Cadastrado em</td>
                            <td style="padding: 10px; border: 1px solid #e5e7eb;">
                                <!-- Formatar timestamp para padrão BR -->
                                 <?php echo date('d/m/Y \á\s H:i', strtotime($tec['criado_em'])); ?>
                            </td>
                    </tr>
                </table>
            </div>
    </div>    

<!-- Rodapé global via proxy local -->
 <?php include 'includes/rod_pdo.php';?>
</body>
</html>
