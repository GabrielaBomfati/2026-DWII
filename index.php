<?php
/**
 * ======================================================================================
 * Arquivo: index.php (raiz do repositório 2026-DWII)
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 04 - PHP para Web: Formulários. GET e POST
 * Autor: Gabriela Bomfati Garcia
 * Conceitos: Ponto de entrada, array associativo. foreach, date(), htmlspecialchars()
 * ======================================================================================
 * 
 * Hub de navegação - exibido quando o servidor ssobe na raiz:
 *  php -S localhost:8000
 * 
 * Por estar fora das subpastas, este arquivo NÃO usa os 
 * includes compartilhados (cabecalho.php, nav.php, rodape.php).
 * Cabeçalho, nav e rodapé são definidos inline aqui.
 */

// -------- VARIÁVEIS DE CONTEÚDO ----------------------------
$nome = "Gabriela Bomfati Garcia";
$subtitulo = "Repositório 2026 - Desenvolvimento Web II";

// -------- CATÁLOGO DE AULAS --------------------------------
// Array associativo:: cada aula é um bloco [...] com suas chaves.
// Para adicionar novas aulas: copie um bloco e edite os valores.
$aulas = [
    [
        "numero" => "00",
        "nome" => "Apresentação Pessoal",
        "descricao" => "Página estática com HTML e CSS - foto de perfil e layout responsivo.",
        "link" => "00_apresentacao/index.html",
        "icone" => "👩🏻‍💻",
        "cor" => "#3b579d",
        "conceitos" => "HTML semântico, CSS Flexbox, responsividade",
    ],
    [
        "numero" => "03",
        "nome" => "Potfólio Dinâmico com PHP",
        "descricao" => "Mini-site de portfólio com variáveis, includes e menu dinâmico.",
        "link" => "01_php-intro/index.php",
        "icone" => "🐘",
        "cor" => "#ec4899",
        "conceitos" => "Variáveis, echo, include, foreach, operador ternário",  
    ],
    [
        "numero" => "04",
        "nome" => "Formulário de Contato",
        "descricao" => "Formulário com validação no servidor, proteção XSS e padrão PRG.",
        "link" => "02_formularios/contato.php",
        "icone" => "📬",
        "cor" => "#3ba34a",
        "conceitos" => "$_POST, validação, htmlspecialchars(), header() + exit",  
    ],
];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($subtitulo); ?></title>

<!-- 
    index.php está na RAIZ (2026-DWII).
    A pasta includes/ também está na raiz - mesmo nível.
    Por isso o caminho é direto: "includes/style.css"
    (sem "../" - esse prefixo só aparece nas subpastas).

    Esse <link> faz o navegador carregar o style.css como
    arquivo separado - sem nenhum CSS embutido aqui.
-->
 <link rel="stylesheet" href="includes/style.css">
</head>
<body>
    
<!-- CABEÇALHO -- mesmo padrão visual das demais páginas -->
 <header>
    <h1><?php echo htmlspecialchars($nome); ?> 👩🏻‍💻</h1>
    <p><?php echo htmlspecialchars($subtitulo); ?></p>
</header>
<div class="container">

    <!-- INSTRUÇÃO DE USO -- exibida logo ao abrir o repositório -->
     <div class="card" style="margin-top: 0;">
        <h3> ▶️ Como executar este repositório</h3>
        <p style="font-size: 14px; color: #374151;">
            Suba o servidor PHP na <strong>raiz</strong> para acessar todas as aulas:
        </p>
        <div style="background: #010000; color: #a8e6a3; padding: 10px 16px;
                    border-radius: 6px; margin-top: 10px; font-family: 'Courier New', monospace;
                    font-size: 13px; line-height: 1.8;">
            cd ~/workspaces/2026-DWII<br>php -S localhost:8000
        </div> 
        <p style="font-size: 13px; color: #6b7280; margin-top: 8px;">
            Esta página é o hub de navegação. Use os botões abaixo para acessar cada projeto.
        </p>
    </div>

    <!-- LISTAGEM DAS AULAS -- foreach percorre o array $aulas --> 
     <h2 class="titulo-secao"> 🗂️ Projetos por Aula</h2>

     <?php foreach ($aulas as $aula): ?>
        <!--
        border-left-color dinâmica: cada aula tem sua cor definida no array.
        Isso evita criar uma classe CSS diferente para cada card.
     --> 
        <div class="card"
            style="border-left-color: <?php echo $aula['cor']; ?>;">
        
        <div class="icone"><?php echo  $aula['icone']; ?></div>

        <div class="conteudo">
            <span class="badge">Aula <?php echo htmlspecialchars($aula['numero']); ?>
        </span>
            <h3 style="color: <?php echo $aula['cor']; ?>;">
            <?php echo htmlspecialchars($aula['nome']); ?>
        </h3>
        <p><?php echo htmlspecialchars($aula['descricao']); ?></p>
        <span class="conceitos">
            <?php echo htmlspecialchars($aula['conceitos']); ?>
     </span><br>
     <a href="<?php echo htmlspecialchars($aula['link']); ?>"
        class="btn"
        style="background: <?php echo $aula['cor']; ?>;">
        Abrir 
    </a>
     </div>
    
     </div>
    <?php endforeach; ?>

    <!-- TIMESTAMP -- demonstra date () - igual ao index.php do portfólio -->
      <p style="text-align: right; font-size: 13px; color: #9ca3af; margin-top: 8px;">
        ⏱️ Gerado em: <?php echo date("d/m/Y \à\s H:i:s"); ?>
     </p>

     </div>

    <!-- RODAPÉ -- mesmo padrão visual do rodape.php das subpastas --> 
     <footer>
        <?php echo htmlspecialchars($nome); ?>
        &copy; <?php echo date("Y"); ?>
        | Desenvolvido com PHP | IFPR - Ponta Grossa
     </footer>
     
</body>
</html>