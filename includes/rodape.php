<?php
/**
 * ===============================================================
 * Arquivo: includes/cabecalho.php 
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 04 - PHP para Web: Formulários, GET e POST
 * Autor: Gabriela Bomfati Garcia
 * Conceitos: Modularização, include, isset(), caminho dinâmico
 * ===============================================================
 */
// Falback: se $nome não estiver definida na página, exibe "Portfólio"
// Isso evita avisos de PHP quando o rodapé é incluído sem $nome.
$autor = isset($nome) ? htmlspecialchars($nome) : "Portfólio";
?>

<!-- <footer> sem inline: visual controlado pleo style.css -->
  <footer>
    <?php echo $autor; ?>
    &copy; <?php echo date("Y"); ?>
    | Desenvolvido com PHP
    | IFPR - Ponta Grossa
</footer>