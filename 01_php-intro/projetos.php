<?php
/**
 * ===============================================================
 * Arquivo: 01_php-intro/projetos.php 
 * Disciplina: Desenvolvimento Web II (2026-DWII)
 * Aula: 03 - Aruqitetura Web e Introdução ao PHP
 * Autor: Gabriela Bomfati Garcia
 * ===============================================================
 */
    // Variáveis PHP - serão usadas no HTML abaixo
    $nome = "Gabriela Bomfati Garcia";
    $curso = "Técnico em Informática - IFPR";
    $pagina_atual = "projetos"; // define o item ativo no menu
    $caminho_raiz = "../"; // sobe um vível até 2026-DWII/
    $titulo_pagina = "Projetos - {$nome}";
    ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projetos criados por <?php echo $nome; ?></title>
</head>

    <body style="font-family: Arial, sans-serif; margin: 0; background: white;">
    
    <?php include '../includes/cabecalho.php'; ?>

   <div style="max-width: 800px; margin: 40px auto; padding: 0 20px;">
    <h1 style="color: #ab5084 ;"> Meus Projetos</h1>
    <p>No meu curso <strong><?php echo $curso; ?></strong>, desenvolvi diversos projetos ao longo dos três anos que estou na instituição, 
    irei listar alguns que acho mais interessante e que gosto mais:</p><br>
    <h2>Site Portfólio HTML/CSS</h2>
    <p>Este site de porfólio foi o primeiro site feito na disciplina de Desenvolvimento Web II, utilizando HTML, para estuturar a página 
        e CSS para estilizar e deixar a página bonita.</p><br>
    <h2>Formulário com CSS Bootstrap</h2>
    <p> Quando fiz esse formulário na disciplina de Desenvolvimento Web I, foi meu primeiro contato com esse tipo de CSS, que já vem pronto,
        neste formulário utilizamos diferentes campos básicos incluídos em formulários, como de texto, de seleção e de data.
    </p><br>
    <h2>Sistema simples em Python</h2>
    <p> Foi uma atividade desenvolvida na disciplina de Programação de Sistemas, basicamente foi realizada, a criação de uma tela de login, 
        uma tela para cadastro de login/senha, com link na página de inicial(de login), além de uma tela de agendamentos, pois o objetivo do projeto
        era criar um sistema básico para trabalhadores autônomos organizarem seus clientes e agendamentos.  
    </p><br>
    <h2>CRUD com Object Pascal</h2>
    <p> Este projeto foi realizado num curso que realizei no contraturno das minhas aulas no IFPR, neste curso, 
        além de aprender, também fui monitora do curso, para fazermos o CRUD, utilizamos a 
        IDE Lazarus para pegar as informações do banco de dados e exibir na tela da IDE, utilizamos diversos 
        conectores/ferramentas oferecidas pelo Lazarus, através da tela exibida, era possível listar, alterar, excluir e cadastrar uma música nova.
    </p><br>
    <h2>Projeto Final de Desenvolvimento Web I</h2>
    <p>Projeto desenvolivdo como avaliação do último bimestre da disciplina de Desenvolvimento Web, 
        onde apliquei tudo que aprendi ao longo do ano, HTML, CSS e PHP, fazendo conexão com banco de dados atráves da utilização de PHP,
        podendo listar, alterar, cadastrar e excluir receitas do banco de dados utilizando PHP, HTML e CSS.</p><br>
    <a href="index.php"
    style="color: #551a8b ; font-weight: bold;"> Voltar ao início</a>
    </div>  
     <?php include '../includes/rodape.php'; ?>
</body>
</body>
</html>