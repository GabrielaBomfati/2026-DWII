<?php
/**
 * ===============================================================
 * Arquivo: includes/nav.php 
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 04 - PHP para Web: Formulários, GET e POST
 * Autor: Gabriela Bomfati Garcia
 * Data: 13/04/2026
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
// Fallbacks defensivos
// Valores padrão: evita erro se a página esquecer de declarar
if (!isset($pagina_atual)) $pagina_atual = '';
if (!isset($caminho_raiz)) $caminho_raiz = './';

/**
 * Função auxiliar: classe do item ativo
 * menu_class() - retorna 'class="ativo"' se o item corresponde
 * à página atual, ou '' caso contrário.
 * Substitui os quatro operadores ternários repetidos da Aual 03
 * por uma função reutilizável - menos código, mesma lógica.
 */
function menu_class( string $item, string $atual): string {
  return ($item === $atual) ? 'class="ativo"': '';
}

// Verificar estado de autenticação
$logado = isset($_SESSION['usuario']);
?>


<!-- nav usa a classe CSS definida em style.css - sem style inline --> 
 <nav>
  <!-- LINKS PÚBLICOS -->
  <a href="<?php echo $caminho_raiz; ?>index.php"
    <?php echo menu_class('inicio', $pagina_atual); ?>>
    🏠 Início
  </a>
    <a href="<?php echo $caminho_raiz; ?>sobre.php"
    <?php echo menu_class('sobre', $pagina_atual); ?>>
    👩🏻 Sobre
  </a>
    <a href="<?php echo $caminho_raiz; ?>01_php-intro/projetos.php"
    <?php echo menu_class('projetos', $pagina_atual); ?>>
     🚀 Projetos
  </a>

  <!-- Link para o formulário - Aula 04 -->
     <a href="<?php echo $caminho_raiz; ?>02_formularios/contato.php"
    <?php echo menu_class('contato', $pagina_atual); ?>>
     📬Entre em contato
  </a>
  <!-- mudar nome para catalogo no lugar de index -->
   <a href="<?php echo $caminho_raiz; ?>03_pdo/index.php" 
    <?php echo menu_class('catalogo', $pagina_atual); ?>>
     🗄️ Catálogo
  </a>
   <!-- LINKS CONDICIONAIS --> 
   <?php if ($logado): ?>
    <!--USUÁRIO AUTENTICADO: exibe painel e sair -->
    <a href="<?php echo $caminho_raiz; ?>04_sessoes/painel.php"
    <?php echo menu_class('login', $pagina_atual); ?>>
     📊 Painel
  </a>
  <a href="<?php echo $caminho_raiz; ?>04_sessoes/logout.php">
     🚪 Sair
  </a>
  <!--USUÁRIO NÃO AUTENTICADO: exibe apenas login -->
    <?php else: ?>
  <a href="<?php echo $caminho_raiz; ?>04_sessoes/login.php"
    <?php echo menu_class('login', $pagina_atual); ?>>
     🔐 Login
  </a>
  <?php endif;?>
</nav>