<?php
/**
 * Disciplian: Desenvolvimento Web II (DWII)
 * Arquivo: logout.php (raiz)
 * Descrição: Encerra a sessão e devolve o usuário à home.
 */

require_once __DIR__ . '/includes/auth.php';

//Limpa todos os dados da sessão
$_SESSION = [];

//Destrói o cookie de sessão no navegador.
if(ini_get('session.use_cookies')) {
    $p = session_get_cookie_params();
    setcookie(
        session_name(), '', time() - 42000,
        $p['path'], $p['domain'], $p['secure'], $p['httponly']
    );
}

// Destrói a sessão no servidor.
session_destroy();

header('Location: index.php');
exit;
