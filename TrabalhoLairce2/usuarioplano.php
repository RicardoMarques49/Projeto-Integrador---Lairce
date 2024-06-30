<?php
require_once "conexao.php"; // inclua seu arquivo de conexão aqui

session_start();

if (!isset($_SESSION['idusuario'])) {
    header("Location: login.php"); // redireciona para a página de login se o usuário não estiver logado
    exit;
}

$idusuario = $_SESSION['idusuario'];

// Verifica se o usuário possui um plano ativo para fazer publicações
$sql = "SELECT * FROM usuarioplano WHERE idusuario = $idusuario";
$resultado = $conn->query($sql);

if ($resultado->rowCount() == 0) {
    echo "<p>Você precisa comprar um plano para fazer publicações.</p>";
    echo "<a href='planos.php'>Comprar Plano</a>";
    exit;
}

// Se o usuário possui um plano válido, continue com a página de publicação
?>

<!doctype html>
<html lang="pt_BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>Compartilha Bem - Publicações</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="css/style.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <main class="w-100 m-auto" style="min-height: 400px;">
      <div class="container justify-content-center">
        <div class="left">
          <h1 class="h4 mb-3 fw-normal text-center">Publicações</h1>
          <!-- Aqui você pode colocar o formulário para fazer publicações -->
          <!-- Exemplo de formulário -->
          <form action="salvar_publicacao.php" method="post">
            <textarea name="texto" class="form-control" placeholder="Escreva sua publicação aqui..." required></textarea>
            <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Publicar</button>
          </form>

          <p class="mt-5 mb-3 text-muted">&copy; Compartilha Bem - 2024</p>
        </div>
      </div>
    </main>
  </body>
</html>
