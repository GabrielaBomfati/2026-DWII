<?php
/**
 * ===============================================================
 * Arquivo: includes/cabecalho.php 
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 04 - PHP para Web: Formulários, GET e POST
 * Autor: Gabriela Bomfati Garcia
 * Data: 13/04/2026
 * Conceitos: Modularização, include, isset(), caminho dinâmico
 * ===============================================================
 * 
 * Responsabilidade: gera <meta>, <title>, link para o CSS 
 * externo e inclui o nav.php.
 * 
 * Variáveis esperadas na página que inclui este arquivo:
 *  $titulo_pagina - string (opcional): texto da aba do navegador
 *  $caminho_raiz - string: caminho relativo até a raiz do projeto
 *                 Ex: '../' para páginas em 01_php-intro/ ou
 *                           02_formularios/ (um nível acima)
 *
 *  */
// isset () verifica se a variável foi definida antes de usá-la.
 // Valor padrão ativa caso a página esqueça de declarar $titulo_pagina.

 if (!isset($titulo_pagina)) $titulo_pagina = 'Portfólio DWII';
 if (!isset($caminho_raiz)) $caminho_raiz = './'; 
 if (!isset($pagina_atual)) $pagina_atual = ''; 
 ?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo htmlspecialchars($titulo_pagina); ?></title>

  <!--
    <link> aponta para o CSS usando $caminho_raiz.]
    01_php-intro/index.php - $caminho_raiz = '../' - '../includes/style.css'
    02_formularios/contato.php - igual: '../' - '../includes/style.css'
    Assim um único arquivo CSS serve a todas as pastas.
  -->

  <link rel="stylesheet" href="<?php echo $caminho_raiz; ?>includes/style.css">

<?php
  // _DIR_ é uma constante PHP que retorna o caminho absoluto
  // do diretório onde este arquivo está - garante que o include
  // funciona independente de onde a página que o chamou está.

  include __DIR__ . '/nav.php'; ?>