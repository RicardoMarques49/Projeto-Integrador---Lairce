<?php
require_once "topo.php";
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.104.2">
  <title>Compartilha Bem - Permissões</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">
  <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link href="css/style.css" rel="stylesheet">
  <link href="css/signin.css" rel="stylesheet">
</head>
<body class="text-center">
<?php
session_start();
if(isset($_SESSION['idusuario']) && $_SESSION['idusuario'] <> 0) {
  echo "<p> Você está logado como: ".$_SESSION['nomeUsuario']."</p>";
  $acao = "";
  $id = 0;
  $idmodulo = "";
  $idusuario = "";
  $validade = "";
  $nivel = "";

  if(isset($_GET['acao'])) {
    $acao = $_GET['acao'];
    if(isset($_GET['id']))
      $id = $_GET['id'];
  }
  else if(isset($_POST['acao'])) {
    $acao = $_POST['acao'];
    $id = $_POST['id'];
    $idmodulo = $_POST['idmodulo'];
    $idusuario = $_POST['idusuario'];
    $validade = $_POST['validade'];
    
    // Processando os níveis de permissão
    $nivel = "";
    if(isset($_POST['Incluir'])) $nivel .= "I";
    if(isset($_POST['Excluir'])) $nivel .= "E";
    if(isset($_POST['Listar'])) $nivel .= "L";
    if(isset($_POST['Editar'])) $nivel .= "D";
  }

  require_once "bd/conexao.php";

  if($acao == "novo" && $id == 0 && !empty($idmodulo)) {
    echo "<script>window.alert('Salvo com sucesso')</script>";
    $sql = "INSERT INTO tbpermissoes (idmodulo, idusuario, validade, nivel) 
            VALUES ($idmodulo, $idusuario, '$validade', '$nivel')";
    $conn->exec($sql);
    $id = 0;
    $idmodulo = "";
    $idusuario = "";
    $validade = "";
    $nivel = "";
  }

  if($acao == "editar") {
    $sql = "SELECT tbpermissoes.id, tbmodulos.descricao AS modulo_descricao, 
                   tbusuarios.nome AS usuario_nome, 
                   tbpermissoes.validade, tbpermissoes.nivel 
            FROM tbpermissoes 
            JOIN tbmodulos ON tbpermissoes.idmodulo = tbmodulos.id 
            JOIN tbusuarios ON tbpermissoes.idusuario = tbusuarios.id 
            WHERE tbpermissoes.id = $id";
    $resultado = $conn->query($sql);
    foreach($resultado as $registro) {
      $idmodulo = $registro['modulo_descricao'];
      $idusuario = $registro['usuario_nome'];
      $validade = $registro['validade'];
      $nivel = $registro['nivel'];
    }
  }

  if($acao == "excluir") {
    echo "<script>window.alert('Excluído')</script>";
    $sql = "DELETE FROM tbpermissoes WHERE id = $id";
    $conn->exec($sql);
    $id = 0;
    $idmodulo = "";
    $idusuario = "";
    $validade = "";
    $nivel = "";
  }

  if($acao == "atualizar") {
    echo "<script>window.alert('Atualizado')</script>";
    $sql = "UPDATE tbpermissoes 
            SET idmodulo = $idmodulo, 
                idusuario = $idusuario, 
                validade = '$validade', 
                nivel = '$nivel' 
            WHERE id = $id";
    $conn->exec($sql);
    $id = 0;
    $idmodulo = "";
    $idusuario = "";
    $validade = "";
    $nivel = "";
  }
?>

<main class="w-100 m-auto" style="min-height: 300px;">
  <form action="permissao.php" method="post">
    <div class="container justify-content-center">
      <div class="left"><br><br>
        <h1 class="h4 mb-3 fw-normal text-center">Cadastrar Permissões</h1>
        <div class="form-floating">
          <input type="hidden" name="acao" value="<?php echo $acao;?>">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <input type="text" name="id" class="form-control" 
                 id="floatingInput" placeholder="ID" readonly
                 value="<?php echo $id; ?>">
          <label for="floatingInput">Id</label>
        </div>

        <div>
          <label>Módulo</label><br>
          <select name="idmodulo" required>
            <option value="">Selecione um módulo</option>
            <?php
              $sql2 = "SELECT * FROM tbmodulos ORDER BY id";
              $resultado2 = $conn->query($sql2);
              foreach($resultado2 as $registro2) {
                $selected = ($registro2['descricao'] == $idmodulo) ? 'selected' : '';
                echo "<option value='".$registro2['id']."' $selected>".$registro2['descricao']."</option>";
              }
            ?>
          </select><br> 
        </div><br>

        <div>
          <label for="floatingInput">Usuário</label><br>
          <select name="idusuario" required>
            <option value="">Escolha um usuário</option>
            <?php
              $sql3 = "SELECT * FROM tbusuarios ORDER BY nome";
              $resultado3 = $conn->query($sql3);
              foreach($resultado3 as $registro3) {
                $selected = ($registro3['nome'] == $idusuario) ? 'selected' : '';
                echo "<option value='".$registro3['id']."' $selected>".$registro3['nome']."</option>";
              }
            ?>
          </select>
        </div><br>

        <div class="form-floating">
          <input type="date" name="validade" class="form-control" 
                 id="floatingInput" placeholder="Validade"
                 value="<?php echo $validade; ?>">
          <label for="floatingInput">Validade</label>
        </div>

        <div>
          <label for="incluir">Permissões</label><br>
          <input type="checkbox" name="Incluir" <?php echo (strpos($nivel, "I") !== false ? "checked" : ""); ?>>Incluir
          <input type="checkbox" name="Excluir" <?php echo (strpos($nivel, "E") !== false ? "checked" : ""); ?>>Excluir
          <input type="checkbox" name="Listar" <?php echo (strpos($nivel, "L") !== false ? "checked" : ""); ?>>Listar
          <input type="checkbox" name="Editar" <?php echo (strpos($nivel, "D") !== false ? "checked" : ""); ?>>Editar<br><br>
        </div>

        <div class="form-floating"></div>
        <button class="w-100 btn btn-lg btn-primary" type="submit"><?php echo strtoupper($acao); ?></button>
        
        <p class="mt-5 mb-3 text-muted">&copy; 2024</p>
      </div>
    </div>
  </form>
</main>

<main class="w-100 m-auto" style="min-height: 400px;">
  <div id="listagem">
    <form action="permissao.php" method="post">
      <div class="container">
        <div class="row">
          <h1 class="h4 mb-3 fw-normal text-center">Permissões Cadastradas</h1>
          <?php
            $sql = "SELECT tbpermissoes.id, tbmodulos.descricao AS modulo_descricao, 
                           tbusuarios.nome AS usuario_nome, 
                           tbpermissoes.validade, tbpermissoes.nivel 
                    FROM tbpermissoes 
                    JOIN tbmodulos ON tbpermissoes.idmodulo = tbmodulos.id 
                    JOIN tbusuarios ON tbpermissoes.idusuario = tbusuarios.id 
                    ORDER BY tbpermissoes.id";
            
            echo "<table class='table'><thead><tr><th>ID</th><th>Módulo</th><th>Usuário</th><th>Validade</th><th>Nível</th><th></th></tr></thead><tbody>";
        
            $resultado = $conn->query($sql);
            foreach($resultado as $registro) {
              echo "<tr>
                      <td>".$registro["id"]."</td>
                      <td>".$registro["modulo_descricao"]."</td>
                      <td>".$registro["usuario_nome"]."</td>
                      <td>".$registro["validade"]."</td>
                      <td>".$registro["nivel"]."</td>
                      <td>
                        <a href='permissao.php?id=".$registro["id"]."&acao=editar'>
                          <span class='material-symbols-outlined'>edit</span>
                        </a>
                        <a href='permissao.php?id=".$registro["id"]."&acao=excluir'>
                          <span class='material-symbols-outlined'>delete</span>
                        </a>
                      </td>
                    </tr>";
            }
            echo "</tbody></table>";
          ?>
        </div>
      </div>
    </form>
  </div>
</main>

<?php
} else {
  echo "<p> Você não possui permissão para acessar esta página, verifique seu login</p>";
}
?>

<?php
require_once "rodape.php";
?>
