<?php
/**
 * ==================================================================
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Projeto: Portfólio Pessoal - versão refatorada
 * Arquivo: projetos.php
 * Autor: Gabriela Bomfati Garcia
 * Data: 27/04/2026
 * Descrição: Lista PÚBLICA de projetos lidos do banco via PDO.
 *            Adaptada de 05_crud/index.php - sem autenticação e 
 *            sem botões de editar/excluir
 * =====================================================================
 */
// session_start() ANTES de qualquer saíd HTML.
// Necessário aqui - cabecalho.php é incluído dentro do <head>
// após o iníico do output HTML, tarde demais para iniciar sessão
if (session_status() === PHP_SESSION_NONE){
    session_start();
}
// Ordem padão - sem session_start() (cabecalho.php cuida).
// Sem $nome (fallback do cabecalho.php).
// require_once ANTES do include do cabecalho - precisamos de $projetos para renderozar HTML.
$pagina_atual = "projetos"; // define o item ativo no menu
$caminho_raiz = "./"; // sobe um vível até 2026-DWII/
$titulo_pagina = "Projetos | Portfólio DWII";

// Conexão PDO via includes/ global (criado na parte B).
require_once __DIR__ . '/includes/conexao.php';

// Mesma query do 05_crud/index.php - dados do mesmo banco.
// Qualquer projeto cadastrado pelo painle aparece automaticamente.
$pdo = conectar();
$stmt = $pdo->query('SELECT * FROM projetos ORDER BY criado_em DESC');
$projetos = $stmt->fetchAll();
// fetchAll() retorna array associativo com todos os registros.
// Retorna array vazio se não houver projetos - nunca retorna false.
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<?php include __DIR__ . '/includes/cabecalho.php'; ?>
</head>
<body>
    <div class="container">
        <div style="display: flex; justify-content: space-between;
                    align-items: center; margin-bottom: 20px;">
            <h1 class="titulo-secao" style="margin-top: 0;">🗂️ Meus Projetos</h1>
            <?php if (!empty($projetos)): ?>
            <span style="color: #6b7280; font-size: 14px;">
                <?php echo count($projetos); ?> projeto(s)
            </span>
        <?php endif; ?>  
        </div>
                
        <?php if (empty($projetos)): ?>

    <!-- Estado vazio: banco ainda sem projetos -->
        <div class="card"
        style="text-align: center; padding: 40px 20px; color: #6b7280;">
            <p style="font-size: 40px; margin: 0 0 12px;">📭</p>
            <p style="font-size: 16px; margin: 0 0 16px;">
            Nenhum projeto cadastrado ainda.
            </p>
        </div>
        <?php else: ?>

        <!-- Grade responsiva de projetos -->
        <div style="display: grid;
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: 20px;">

        <?php foreach ($projetos as $projeto): ?>
            <div class="card">

                <h3 style="margin: 0 0 8px; color: #570b57; font-size: 17px;">
                    <?php echo htmlspecialchars($projeto['nome']); ?>
                </h3>
                <!-- htmlspecialchars() converte <> " & em entidades HTML.
                 Impede XSS: dados do banco não são renderizados como código -->

                <p style="margin: 0 0 10px; color: #374151; font-size: 14px; line-height: 1.6;">
                    <?php echo htmlspecialchars($projeto['descricao']); ?>
                </p>

                <p style="margin: 0 0 6px; color: #6b7280; font-size: 14px;">
                    🛠️ <?php echo htmlspecialchars($projeto['tecnologias']); ?>
                </p>

                <p style="margin: 0 0 12px; color: #6b7280; font-size: 14px;">
                    🗓️ <?php echo (int) $projeto['ano']; ?>
                </p>
                <!-- (int): cast para inteiro - garante que só o número apareça,
                 mesmo que o banco retorne o valor como string. -->

                <?php if ($projeto['link_github']): ?>
                    <a style="color: #570b57;"
                       href="<?php echo htmlspecialchars($projeto['link_github']); ?>"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="btn-secundario">
                        🔗 Ver no GitHub
                    </a>
                <?php endif; ?>
                <!-- SEM botões de Editar/Excluir - versão PÚBLICA. 
                 Os controles do CRUD estão em 05_crud_index.php (area restrita). -->
            </div>
        <?php endforeach; ?>
    </div>

    <?php endif; ?>
    </div>

<?php include __DIR__ . '/includes/rodape.php'; ?>
</body>
</html>