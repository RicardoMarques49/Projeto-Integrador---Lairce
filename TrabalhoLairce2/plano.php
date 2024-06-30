<?php
require_once "conexao.php"; // inclua seu arquivo de conexão aqui

session_start();

if (!isset($_SESSION['idusuario'])) {
    header("Location: login.php"); // redireciona para a página de login se o usuário não estiver logado
    exit;
}

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idplano = $_POST['idplano'];
    $idusuario = $_SESSION['idusuario'];
    
    // Insere a compra do plano na tabela usuarioplano
    $sqlCompraPlano = "INSERT INTO usuarioplano (idplano, idusuario) VALUES (?, ?)";
    $stmt = $conn->prepare($sqlCompraPlano);
    $stmt->execute([$idplano, $idusuario]);

    // Redireciona para a página de publicação
    header("Location: publicacao.php");
    exit;
}

// Consulta para buscar os planos disponíveis
$sql = "SELECT * FROM plano";
$resultado = $conn->query($sql);

?>

<!doctype html>
<html lang="pt_BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>Compartilha Bem - Comprar Plano</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="css/style.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <main class="w-100 m-auto" style="min-height: 400px;">
      <form action="planos.php" method="post">
        <div class="container justify-content-center">
          <div class="left">
            <h1 class="h4 mb-3 fw-normal text-center">Escolha um Plano</h1>
            
            <?php
            if ($resultado->rowCount() > 0) {
                foreach ($resultado as $plano) {
                    echo '<div class="card mb-3">
                            <div class="card-body">
                              <h5 class="card-title">' . $plano['descricao'] . '</h5>
                              <p class="card-text">Preço: R$ ' . number_format($plano['preco'], 2, ',', '.') . '</p>
                              <input type="hidden" name="idplano" value="' . $plano['idplano'] . '">
                              <button class="w-100 btn btn-lg btn-primary" type="submit">Comprar</button>
                            </div>
                          </div>';
                }
            } else {
                echo '<p>Não há planos disponíveis no momento.</p>';
            }
            ?>

            <p class="mt-5 mb-3 text-muted">&copy; Compartilha Bem - 2024</p>
          </div>
        </div>
      </form>
    </main>
  </body>
</html>

<?php
//require_once "rodape.php";
?>
