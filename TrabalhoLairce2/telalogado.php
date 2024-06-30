<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['idusuario'])) {
    header("Location: login.php");
    exit();
}

// Pega o nome do usuário da sessão
$nomeUsuario = $_SESSION['nome'];
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>Compartilha Bem - Área Logada</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <header>
      <div class="container">
        <h1>Bem-vindo, <?php echo htmlspecialchars($nomeUsuario); ?>!</h1>
      </div>
    </header>

    <!-- Resto do seu conteúdo -->

  </body>
</html>
