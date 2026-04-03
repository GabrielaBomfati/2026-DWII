<?php
/**
 * Disciplina: Desenvolvimento Web II (DWII)
 * Aula: 06 - Autenticação com sessões e controle de acesso
 * Arquivo: 04_sessoes/includes/auth.php
 * Autor: Gabriela Bomfati Garcia
 * Data: 23/03/2026
 */
/**
 * requer_login()
 * Verifica se há sessão ativa.
 * Se não houver, redireciona para o login e encerra.
 * Chamar no topo de qualquer página protegida.
 */
function requer_login(): void
{
    if (session_status() === PHP_SESSION_NONE){
        session_start(); // iniciar se ainda nao foi iniciada
    }

    if(!isset($_SESSION['usuario'])) {
        header('Location: ../04_sessoes/login.php');
        exit;
    }
}

/**
 * usuario_logado()
 * Retorna o nome do usuário da sessão ou string vazia.
 */
function usuario_logado(): string
{
    return $_SESSION['usuario'] ?? '';
}
function redirecionar_se_logado(): void
{
    if (session_status() === PHP_SESSION_NONE){
        session_start();
    }

    if (isset($_SESSION['usuario'])) {
        header('Location: ../04_sessoes/painel.php');
        exit;
    }
}
?>