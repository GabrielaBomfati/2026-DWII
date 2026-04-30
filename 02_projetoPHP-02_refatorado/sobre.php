<?php
/**
 * ===============================================================
 * Arquivo: sobre.php (migrado de 01_php-intro/sobre.php)
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Descrição: Página "Sobre" do projeto refatorado
 * Autor: Gabriela Bomfati Garcia
 * Data: 15/04/2026
 * ===============================================================
 */

if (session_status() === PHP_SESSION_NONE){
    session_start();
}

// Variáveis PHP
$nome = "Gabriela Bomfati Garcia";
$pagina_atual = "sobre"; // item ativo no menu
$caminho_raiz = "./"; // agora está na raiz
$titulo_pagina = "Sobre mim - {$nome}";

// Formações acadêmicas
$formacoes = [
    "Ensino Fundamental Completo",
    "Ensino Médio Técnico em Informática - IFPR - Ponta Grossa (em andamento)",

];
?>
<!DOCTYPE html>

<html lang="pt-BR">
<head>
<?php include __DIR__ . '/includes/cabecalho.php'; ?>
</head>

<body style="font-family: Arial, sans-serif; margin: 0; background: white;">
    
    <div style="max-width: 800px; margin: 40px auto; padding: 0 20px;">
        <h1 style="color: #ab5084;">Sobre mim</h1>

        <p>Olá! Sou <strong><?php echo $nome; ?></strong>, estudante de Técnico em Informática no IFPR de Ponta Grossa.</p>

        <p>
        Atualmente moro em Ponta Grossa, no Paraná, estudante do 3° ano do Técnico em Informática no IFPR, gosto bastante de aprender coisas novas principalmente na área da tecnologia. 
        No meu tempo livre gosto de ouvir música, assistir séries e filmes e também aproveitar o tempo com meus amigos e família. 
        Sempre tive interesse em entender como os sistemas funcionam, por trás de uma tela bonita.<br>
        Escolhi a área de informática porque sempre gostei muito e existia uma curiosidade de como essas tecnologias funcionam, 
        também gosto e tenho uma certa facilidade em exatas. 
        Durante o curso, venho desenvolvendo interesse principalmente na área de banco de dados, pois acho interessante a forma como as informações são organizadas e utilizadas nos sistemas. 
        Futuramente, pretendo concluir o curso técnico no IFPR, fazer uma faculdade na área de tecnologia, e talvez me especializar na área de banco de dados, 
        sendo meu objetivo é trabalhar na área de tecnologia, especialmente nesta área construindo uma carreira neste meio.
        </p>
        <br>

        <h3>Formação Acadêmica</h3>
        <ul>
            <?php foreach ($formacoes as $formacao): ?>
                <li><?php echo $formacao; ?></li>
            <?php endforeach; ?>
        </ul>

        <br>
        <a href="index.php" style="color: #551a8b; font-weight: bold;">
            Voltar ao início
        </a>
    </div>

<?php include __DIR__ . '/includes/rodape.php'; ?>
</body>
</html>