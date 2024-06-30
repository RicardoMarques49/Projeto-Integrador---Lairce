<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compartilha Bem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/logo.css">
    <style>
        /* Adicione seu estilo personalizado aqui */
        body {
            padding-top: 80px; /* Ajuste para o tamanho do seu cabeçalho */
        }
        nav.navbar {
            height: 80px; /* Define a altura do cabeçalho */
        }
        nav.navbar .container {
            height: 100%; /* Garante que o conteúdo do container também tenha a mesma altura */
        }
        nav.navbar .navbar-brand img {
            height: 100%; /* Ajusta a altura da logo para ocupar todo o espaço do cabeçalho */
            max-height: 80px; /* Ajuste a altura máxima da logo, se necessário */
        }
        main {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 80px); /* Altura da tela menos a altura do cabeçalho */
        }
        form {
            width: 100%;
            max-width: 400px; /* Ajuste o tamanho máximo do formulário conforme necessário */
            padding: 15px;
            margin: auto;
        }
    </style>
</head>
<body>

<?php
  //require_once "topo.php";
  require_once "conexao.php";
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
    <style>
        /* Adicione seu estilo personalizado aqui */
        body {
            padding-top: 80px; /* Ajuste para o tamanho do seu cabeçalho */
        }
        nav.navbar {
            height: 80px; /* Define a altura do cabeçalho */
        }
        nav.navbar .container {
            height: 100%; /* Garante que o conteúdo do container também tenha a mesma altura */
        }
        nav.navbar .navbar-brand img {
            height: 100%; /* Ajusta a altura da logo para ocupar todo o espaço do cabeçalho */
            max-height: 80px; /* Ajuste a altura máxima da logo, se necessário */
        }
        main {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 80px); /* Altura da tela menos a altura do cabeçalho */
        }
        form {
            width: 100%;
            max-width: 400px; /* Ajuste o tamanho máximo do formulário conforme necessário */
            padding: 15px;
            margin: auto;
        }
    </style>
  </head>

<body class="text-center">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand"><img src="images/Screenshot_3.jpg" alt="Logo" class="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Publicar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Minhas publicações</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Planos</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                                   
                    <li class="nav-item">
                        <a class="nav-link" href="#">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
  <?php
    //verificar a variavel ação
    $acao="";
    if(isset($_GET['acao'])){
      $acao=$_GET['acao'];
      if(isset($_GET['id']))
      $id=$_GET['id'];
      //echo "entrou no get";
    }else if(isset($_POST['acao'])){
      $acao=$_POST['acao'];
      $id=$_POST['id'];
      $foto=$_POST['foto'];
      $video=$_POST['video'];
      $texto=$_POST['texto'];
      $data=$_POST['data'];
      $status=$_POST['status'];
      $tipo=$_POST['tipo'];
      //echo "entrou no post";
    } else {
      $acao="Salvar";
      $id=0;
      $foto="";
      $video="";
      $texto="";
      $data="";
      $status="";
      $tipo="";
    }
    //acesso ao BD
    if($acao=="editar"){
      $sql = "select * FROM usuario where id=".$id;
      $resultado = $conn->query($sql);
      foreach($resultado as $registro) {
        $foto = $registro['foto'];
        $video = $registro['video'];
        $texto = $registro['texto'];
        $data = $registro['data'];
        $status = $registro['status'];
        $tipo = $registro['tipo'];
        //echo $descricao;
      }
    }
    if($acao=="excluir"){
      echo "<script>window.alert('Excluído.')</script>";
      $sql = "delete from usuario where id=".$id;
      $conn->exec($sql);
      $id=0;
      $foto="";
      $video="";
      $texto="";
      $data="";
      $status="";
      $tipo="";
      $acao="novo";
    }
    if($acao=="atualizar"){
      echo "<script>window.alert('Cadastro atualizado.')</script>";
      $sql = "update usuario set foto='".$foto."', video='".$video."', texto='".$texto."', data='".$data."', status='".$status."', tipo='".$tipo."'  where id=".$id;
      //echo $sql;
      $conn->exec($sql);
      $id=0;
      $foto="";
      $video="";
      $texto="";
      $data="";
      $status="";
      $tipo="";
      $acao="novo";
    }
      
    if($acao=="novo" && $id==0 && $foto!=""){
    echo "<script>window.alert('Cadastrado com sucesso.')</script>";
    $sql = "insert into usuario (foto,video,texto,data,status,tipo) values('".$foto."','".$video."','".$texto."','".$data."','".$status."','".$tipo."')";
    //echo $sql;
    $conn->exec($sql);
    $id=0;
    $acao="novo";
    $foto="";
    $video="";
    $texto="";
    $data="";
    $status="";
    $tipo="";
    }
  ?>
</body>

<main class="w-100 m-auto" style="min-height: 400px;">
  <form action="telafazerpublicacao.php" method="post">
    <div class="container justify-content-center">
      <div class="left">
        <!-- <h1 class="h4 mb-3 fw-normal text-center">Cadastre-se</h1> -->
        <div class="form-floating">
          <?php
            if($id>0 && $foto!="")
            $acao="atualizar"; 
          ?>
          <input type="hidden" name="acao" value="<?php echo $acao;?>">
          <input type="text" name="id" class="form-control" 
          id="floatingInput" placeholder="ID" readonly
          value="<?php echo $id; ?>">
          <label for="floatingInput">Id</label>
        </div><br>

        <div class="form-floating">
        <input type="text" name="foto" class="form-control" 
        id="floatingInput" placeholder="Foto"
        value="<?php echo $foto; ?>" required>
        <label for="floatingInput">Foto</label>
      </div><br>

      <div class="form-floating">
        <input type="text" name="video" class="form-control" 
        id="floatingInput" placeholder="video"
        value="<?php echo $video; ?>" required>
        <label for="floatingInput">Video</label>
      </div><br>
      
      <div class="form-floating">
        <input type="text" name="texto" class="form-control" 
        id="floatingInput" placeholder="Texto"
        value="<?php echo $texto; ?>" required>
        <label for="floatingInput">Texto</label>
      </div><br>

      <div class="form-floating">
        <input type="date" name="data" class="form-control" 
        id="floatingInput" placeholder="Data"
        value="<?php echo $data; ?>" required>
        <label for="floatingInput">Data</label>
      </div><br>

      <div class="form-floating">
        <input type="text" name="status" class="form-control" 
        id="floatingInput" placeholder="Status"
        value="<?php echo $status; ?>" required>
        <label for="floatingInput">Status</label>
      </div><br>


      <div class="form-floating">
        <input type="text" name="tipo" class="form-control" 
        id="floatingInput" placeholder="Tipo"
        value="<?php echo $tipo; ?>" required>
        <label for="floatingInput">Tipo</label>
      </div><br>


      <div class="form-floating"></div>
      <button class="w-100 btn btn-lg btn-primary" type="submit"><?php echo strtoupper($acao); ?></button><br><br>

      <p class="mt-5 mb-3 text-muted text-center" >&copy; Compartilha Bem - 2024</p>
    </div>
  </form>
</main>



  <div id="listagem" style="display: none;">
    <form action="cadUsuario.php" method="post">

        <?php
          $sql="Select * from usuario order by id";
          echo "<table><tr><th>ID</th><th>Foto</th><th>Video</th><th>Texto</th><th>Data</th><th>Status</th><th>Tipo</th><th>Acoes</th></tr>";
          $resultado = $conn->query($sql);
          foreach($resultado as $registro) {
            echo "<tr><td>".$registro["id"]."</td><td>".
            $registro["foto"]."</td><td>".
            $registro["video"]."</td><td>".
            $registro["texto"]."</td><td>".
            $registro["data"]."</td><td>".
            $registro["status"]."</td><td>".
            $registro["tipo"]."</td<td>
            <a href='cadUsuario.php?id=".$registro["id"]."&acao=editar'><span class='material-symbols-outlined'>edit</span></a>
            <a href='cadUsuario.php?id=".$registro["id"]."&acao=excluir'><span class='material-symbols-outlined'>delete</span></a>
            </td></tr>";
          }
          echo "</table>";
        ?>
        <button class="w-100 btn btn-primary" onclick="alternarListagem()">OCULTAR LISTAGEM</button>

      </div>
    </div>
  </form>
</main>

</div>
      </div>
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

</html>
<?php
//require_once "rodape.php";
?>
