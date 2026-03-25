<?php
/**
 * Disciplina: Desenvolvimento Web II (DWII)
 * Aula: 06 - Autenticação com sessões e controle de acesso
 * Arquivo: 04_sessoes/logout.php
 * Autor: Gabriela Bomfati Garcia
 * Data: 23/03/2026
 */

session_start();

// 1. Limpar todos os dados da sessão
session_unset();

// 2. Destruir a sessão no servidor
session_destroy();

// 3. Redirecionar para o login
header('Location: login.php');
exit;
?>