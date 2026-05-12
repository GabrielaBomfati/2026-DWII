<?php
/**
 * Disciplina: Desenvolvimento Web II (DWII)
 * Arquivo: includes/auth.php
 * Descrição: Helpers de autenticação - verifica login e protege páginas
 */

// Garante sessão ativa sem disparar warning se houver uma.
if (session_status() === PHP_SESSION_NONE) session_start();

/**
 * Retorna true se há um usuário logado nesta sessão.
 */
function usuario_logado(): bool {
    return isset($_SESSION['usuario']) && $_SESSION['usuario'] !== '';
}

/**
 * Retorna o login do usuário atual ou  null se não houver.
 */
function usuario_atual(): ?string {
    return $_SESSION ['usuario'] ?? null;
}

/**
 * Bloqueia o acesso a uma página: se não estiver logado, redireciona.
 * Chame esta função no TOPO de qualuqer página privada.
 */
function requer_login(): void{
    if(!usuario_logado()) {
        header('Location: login.php');
        exit;
    }
}

