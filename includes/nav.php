<?php
/**
 * ===============================================================
 * Arquivo: includes/nav.php 
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 04 - PHP para Web: Formulários, GET e POST
 * Autor: Gabriela Bomfati Garcia
 * Conceitos: Menu dinâmico, operador ternário, $caminho_raiz
 * ===============================================================
 * 
 * Mesmo padrão do nav.php da Aula 03, com duas melhorias:
 *  1. Link montados via $caminho_raiz - funciona de qualquer pasta
 *  2. Classe CSS "ativo" em vez de style inline - CSS externo controla
 * 
 * Variáveis esperadas:
 *  $pagina_atual - string: identifica qual item destacar no menu
 *  $caminho_raiz - string: caminho relativo até a raiz
 */

// Valores padrão: evita erro se a página esquecer de declarar
if (!isset($pagina_atual)) $pagina_atual = "";
if (!isset($caminho_raiz)) $caminho_raiz = "../";

/**
 * menu_class() - retorna 'class="ativo"' se o item corresponde
 * à página atual, ou '' caso contrário.
 * Substitui os quatro operadores ternários repetidos da Aual 03
 * por uma função reutilizável - menos código, mesma lógica.
 */
function menu_class($item, $atual) {
  return ($item === $atual) ? 'class="ativo"': '';
}
?>

<!-- nav usa a classe CSS definida em style.css - sem style inline --> 
 <nav>
  <!-- Links para o portfólio - Aula 03 -->
  <a href="<?php echo $caminho_raiz; ?>01_php-intro/index.php"
    <?php echo menu_class("inicio", $pagina_atual); ?>>
    Início
  </a>
    <a href="<?php echo $caminho_raiz; ?>01_php-intro/sobre.php"
    <?php echo menu_class("sobre", $pagina_atual); ?>>
    Sobre
  </a>
    <a href="<?php echo $caminho_raiz; ?>01_php-intro/projetos.php"
    <?php echo menu_class("projetos", $pagina_atual); ?>>
    Projetos
  </a>

  <!-- Link para o fromulário - Aula 04 -->
     <a href="<?php echo $caminho_raiz; ?>02_formularios/contatp.php"
    <?php echo menu_class("contato", $pagina_atual); ?>>
    Contato
  </a>
</nav>

