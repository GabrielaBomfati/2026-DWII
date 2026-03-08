<!-- 01_php-intro/sobre.php -->
 <?php
 $nome = "Gabriela Bomfati Garcia";
 $pagina_atual = "sobre";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre - <?php echo $nome; ?></title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; background: white;">
    
    <?php include 'includes/cabecalho.php'; ?>

   <div style="max-width: 800px; margin: 40px auto; padding: 0 20px;">
    <h1 style="color: #ab5084 ;"> Sobre mim</h1>
    <p>Olá! Sou <strong><?php echo $nome; ?></strong>, estudante de Técnico em Infromática no IFPR de Ponta Grossa.</p>
    <p>Meu principal interesse, nos estudos é na área técnica e na parte de exatas,
        quero me formar no IFPR e cursar faculdade, penso em seguir na área técnica e cursar algo nessa área, particularmente prefiro a área de banco de dados.
        E futuramente pretendo seguir profissão nesta área.
    </p>
    <a href="index.php"
    style="color: #551a8b ; font-weight: bold;"> Voltar ao início</a>
    </div>  
     <?php include 'includes/rodape.php'; ?>
</body>
</html>