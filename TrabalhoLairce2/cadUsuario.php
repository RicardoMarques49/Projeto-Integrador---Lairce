<?php
require_once "conexao.php";

$id = 0;
$nome = "";
$telefone = "";
$email = "";
$senha = "";
$ramoatividade = "";
$acao = "Salvar"; // Valor padrão da ação

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $acao = $_POST['acao'];
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $ramoatividade = $_POST['ramoatividade'];
    $id = isset($_POST['id']) ? $_POST['id'] : 0;
} else if (isset($_GET['acao'])) {
    $acao = $_GET['acao'];
    $id = isset($_GET['idusuario']) ? $_GET['idusuario'] : 0;
}

if ($acao == "editar" && $id > 0) {
    $sql = "SELECT * FROM usuario WHERE idusuario = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    $registro = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($registro) {
        $nome = $registro['nome'];
        $telefone = $registro['telefone'];
        $email = $registro['email'];
        $senha = $registro['senha'];
        $ramoatividade = $registro['ramoatividade'];
    }
    // Definir ação como "atualizar" após carregar os dados para edição
    $acao = "atualizar";
} elseif ($acao == "excluir" && $id > 0) {
    echo "<script>window.alert('Excluído.')</script>";
    $sql = "DELETE FROM usuario WHERE idusuario = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    // Reset fields and action
    $id = 0;
    $nome = "";
    $telefone = "";
    $email = "";
    $senha = "";
    $ramoatividade = "";
    $acao = "Salvar";
} elseif ($acao == "atualizar" && $id > 0) {
    echo "<script>window.alert('Cadastro atualizado.')</script>";
    $sql = "UPDATE usuario SET nome = :nome, telefone = :telefone, email = :email, senha = :senha, ramoatividade = :ramoatividade WHERE idusuario = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'nome' => $nome,
        'telefone' => $telefone,
        'email' => $email,
        'senha' => $senha,
        'ramoatividade' => $ramoatividade,
        'id' => $id
    ]);
    // Reset fields and action
    $id = 0;
    $nome = "";
    $telefone = "";
    $email = "";
    $senha = "";
    $ramoatividade = "";
    $acao = "Salvar";
} elseif ($acao == "Salvar" && $nome != "") {

try{
    
    $sql = "INSERT INTO usuario (nome, telefone, email, senha, ramoatividade) VALUES (:nome, :telefone, :email, :senha, :ramoatividade)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'nome' => $nome,
        'telefone' => $telefone,
        'email' => $email,
        'senha' => $senha,
        'ramoatividade' => $ramoatividade
    ]);
    echo "<script>window.alert('Cadastrado com sucesso.')</script>";
    // Reset fields and action
    $id = 0;
    $nome = "";
    $telefone = "";
    $email = "";
    $senha = "";
    $ramoatividade = "";
    $acao = "Salvar";
  } catch (PDOException $e) {
    //echo "Cadastro com esse email já existe!" . $e->getMessage();
    echo "<script>window.alert('Cadastro com esse email já existe!')</script>";
  }
}
?>

<!doctype html>
<html lang="pt_BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>Compartilha Bem</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="css/style.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
</head>

<body class="text-center">
<main class="w-100 m-auto" style="min-height: 400px;">
  <form action="cadUsuario.php" method="post">
    <div class="container justify-content-center">
      <div class="left">
        <h1 class="h4 mb-3 fw-normal text-center">Cadastre-se</h1>
        <div class="form-floating">
          <input type="hidden" name="acao" value="<?php echo $acao; ?>">
          <input type="hidden" name="id" class="form-control" id="floatingInput" value="<?php echo $id; ?>">
        </div>

        <div class="form-floating">
          <input type="text" name="nome" class="form-control" id="floatingInput" placeholder="Nome" value="<?php echo $nome; ?>" required>
          <label for="floatingInput">Nome</label>
        </div>

        <div class="form-floating">
          <input type="text" name="telefone" class="form-control" id="floatingInput" placeholder="Telefone" value="<?php echo $telefone; ?>" required>
          <label for="floatingInput">Telefone</label>
        </div>
      
        <div class="form-floating">
          <input type="text" name="email" class="form-control" id="floatingInput" placeholder="Email" value="<?php echo $email; ?>" required>
          <label for="floatingInput">Email</label>
        </div>

        <div class="form-floating">
          <input type="password" name="senha" class="form-control" id="floatingInput" placeholder="Senha" value="<?php echo $senha; ?>" required>
          <label for="floatingInput">Senha</label>
        </div>

        <div class="form-floating">
          <input type="text" name="ramoatividade" class="form-control" id="floatingInput" placeholder="Ramo de Atividade" value="<?php echo $ramoatividade; ?>" required>
          <label for="floatingInput">Ramo de Atividade</label>
        </div><br>

        <div class="form-floating"></div>
        <button class="w-100 btn btn-lg btn-primary" type="submit"><?php echo strtoupper($acao); ?></button><br><br>
        <p class="mt-5 mb-3 text-muted">&copy; Compartilha Bem - 2024</p>
      </div>
    </div>
  </form>
</main>

<main class="w-100 m-auto" style="min-height: 100px;">
<button class="w-100 btn btn-primary" onclick="mostrarListagem()">VER CADASTROS</button>

  <div id="listagem" style="display: none;">
    <form action="cadUsuario.php" method="post">
      <?php      
        $sql = "SELECT * FROM usuario ORDER BY idusuario";
        echo "<table><tr><th>ID</th><th>Nome</th><th>Telefone</th><th>Email</th><th>Senha</th><th>RamoAtividade</th><th>Acoes</th></tr>";
        $resultado = $conn->query($sql);
        foreach ($resultado as $registro) {
          echo "<tr><td>".
          $registro["idusuario"]."</td><td>".
          $registro["nome"]."</td><td>".
          $registro["telefone"]."</td><td>".
          $registro["email"]."</td><td>".
          $registro["senha"]."</td><td>".
          $registro["ramoatividade"]."</td><td>
          
          <a href='cadUsuario.php?idusuario=".$registro["idusuario"]."&acao=editar'><span class='material-symbols-outlined'>edit</span></a>
          <a href='cadUsuario.php?idusuario=".$registro["idusuario"]."&acao=excluir'><span class='material-symbols-outlined'>delete</span></a>
          </td></tr>";
        }
        echo "</table>";
      ?>
        <button class="w-100 btn btn-primary" onclick="alternarListagem()">OCULTAR LISTAGEM</button>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
      </ul>
    </form>
  </div>
</main>

<script>
function mostrarListagem() {
  var listagemDiv = document.getElementById("listagem");
  listagemDiv.style.display = "block";
}

function alternarListagem() {
  var listagemDiv = document.getElementById("listagem");
  if (listagemDiv.style.display === "none") {
    listagemDiv.style.display = "block";
  } else {
    listagemDiv.style.display = "none";
  }
}
</script>
</body>
</html>
