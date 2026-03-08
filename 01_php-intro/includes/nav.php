<!--
  Disciplina : Desenvolvimento Web II (DWII)
  Aula       : 03 - PHP Intro
  Autor      : Gabriela Bomfati Garcia
  Data       : 02/03/2026
-->

<?php
$cor_inicio   = ($pagina_atual === "inicio")   ? "color: #551a8b; font-weight: bold;" : "color: white;";
$cor_sobre    = ($pagina_atual === "sobre")    ? "color: #551a8b; font-weight: bold;" : "color: white;";
$cor_projetos = ($pagina_atual === "projetos") ? "color: #551a8b; font-weight: bold;" : "color: white;";
?>
<nav>
  <a href="index.php"    style="<?php echo $cor_inicio; ?>">Início</a>
  <a href="sobre.php"    style="<?php echo $cor_sobre; ?>">Sobre</a>
  <a href="projetos.php" style="<?php echo $cor_projetos; ?>">Projetos</a>
</nav>