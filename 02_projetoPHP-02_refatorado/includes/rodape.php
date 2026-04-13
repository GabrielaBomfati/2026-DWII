<?php
/**
 * ════════════════════════════════════════════════════════════
 * Disciplina : Desenvolvimento Web II (DWII)
 * Projeto    : Portfólio Pessoal — versão refatorada
 * Arquivo    : includes/rodape.php
 * Autor      : Gabriela Bomfati Garcia
 * Data       : 13/04/2026
 * Descrição  : Rodapé global do projeto.
 *              Exibe o nome do autor e o ano atual (gerado
 *              dinamicamente por date()). Se $nome não estiver
 *              definida na página, usa 'Portfólio' como fallback.
 * ════════════════════════════════════════════════════════════
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