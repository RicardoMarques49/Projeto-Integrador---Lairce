<?php
session_start();

require_once "conexao.php";

// Verifique se o usuário está logado
if (!isset($_SESSION['idusuario'])) {
    header("Location: login.php");
    exit();
}

$idusuario = $_SESSION['idusuario'];
//$nomeusuario = $_SESSION['nome']; // Obtém o nome do usuário da sessão
//echo $_SESSION['idusuario'];
//echo $_SESSION['nome'];
?>


<!doctype html>
<html lang="pt_BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Compartilha Bem">
    <meta name="generator" content="Hugo 0.104.2">
    <title>Compartilha Bem</title>

    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
</head>

<body class="text-center">
<div class="mb-3">
        <!--<h3>Usuário Logado: <?php /*echo $nomeusuario;*/ ?></h3>-->
    </div>

    <?php
    
    // Verificar a variavel ação
    
    $acao = "";
    if (isset($_GET['acao'])) {
        $acao = $_GET['acao'];
        if (isset($_GET['idpublic'])) {
            $idpublic = $_GET['idpublic'];
        }
    } else if (isset($_POST['acao'])) {
        $acao = $_POST['acao'];
        $idpublic = $_POST['idpublic'];
        $texto = $_POST['texto'];
        $valor = $_POST['valor'];
        $data = $_POST['data'];
        $status = $_POST['status'];
        $tipo = $_POST['tipo'];
    } else {
        $acao = "Salvar";
        $idpublic = 0;
        $texto = "";
        $valor = "";
        $data = "";
        $status = "";
        $tipo = "";
    }

   // echo $acao;

    // Acesso ao BD
    if ($acao == "editar") {
        $sql = "SELECT * FROM publicacao WHERE idpublic=" . $idpublic;
        $resultado = $conn->query($sql);
        foreach ($resultado as $registro) {
            $texto = $registro['texto'];
            $valor = $registro['valor'];
            $data = $registro['data'];
            $status = $registro['status'];
            $tipo = $registro['tipo'];
        }
    }

    if ($acao == "excluir") {
        echo "<script>window.alert('Excluído.')</script>";
        $sql = "DELETE FROM publicacao WHERE idpublic=" . $idpublic;
        $conn->exec($sql);
        $idpublic = 0;
        $texto = "";
        $valor = "";
        $data = "";
        $status = "";
        $tipo = "";
        $acao = "novo";
    }

    if ($acao == "atualizar") {
        echo "<script>window.alert('Cadastro atualizado.')</script>";
        $sql = "UPDATE publicacao SET texto='$texto', valor='$valor', data='$data', status='$status', tipo='$tipo' WHERE idpublic=" . $idpublic;
        $conn->exec($sql);
        $idpublic = 0;
        $texto = "";
        $valor = "";
        $data = "";
        $status = "";
        $tipo = "";
        $acao = "novo";
    }

    if ($acao == "Salvar" && $idpublic == 0 && $texto != "") {
        echo "<script>window.alert('Cadastrado com sucesso.')</script>";
        $sql = "INSERT INTO publicacao (texto, valor, data, status, tipo, idusuario) VALUES('$texto', '$valor', '$data', '$status', '$tipo', '$idusuario')";
        $conn->exec($sql);
        $idpublic = 0;
        $acao = "Salvar";
        $texto = "";
        $valor = "";
        $data = "";
        $status = "";
        $tipo = "";
    }

    if ($acao == "gravarFoto"){
    ?>
    <form action="cadFotoBanco.php" method="post" enctype="multipart/form-data">
		 <input type="text" name="idpublic" value="<?php echo $idpublic; ?>">
		<label for="avatar">Escolha um imagem:</label>
		<input type="file" id="foto" name="foto" accept="image/png, image/jpeg"  data-required />
		<button class="w-100 btn btn-lg btn-primary" type="submit"><?php echo strtoupper($acao); ?></button><br><br>
	</form>
    <?php
    }
    ?>
</body>

<main class="w-100 m-auto" style="min-height: 400px;">
    <form action="publicacao.php" method="post">
        <div class="container justify-content-center">
            <div class="left">
                <h1 class="h4 mb-3 fw-normal text-center">Publicação</h1>
                <div class="form-floating">
                    <?php
                    if ($idpublic > 0 && $texto != "") {
                        $acao = "atualizar";
                    }
                    ?>
                    <input type="hidden" name="acao" value="<?php echo $acao; ?>">
                    <input type="hidden" name="idpublic" class="form-control" id="floatingInput" placeholder="ID" readonly value="<?php echo $idpublic; ?>">
                    <label for="floatingInput"></label>
                </div>

                <div class="form-floating">
                    <input type="text" name="texto" class="form-control" id="floatingInput" placeholder="" value="<?php echo $texto; ?>" required>
                    <label for="floatingInput">Texto</label>
                </div>

                <div class="form-floating">
                    <input type="number" name="valor" class="form-control" id="floatingInput" placeholder="" value="<?php echo $valor; ?>" step="any" required>
                    <label for="floatingInput">Valor</label>
                </div>


                <div class="form-floating">
                    <input type="date" name="data" class="form-control" id="floatingInput" placeholder="" value="<?php echo $data; ?>" required>
                    <label for="floatingInput">Data</label>
                </div>

                <div class="form-floating">
                    <input type="text" name="status" class="form-control" id="floatingInput" placeholder="" value="<?php echo $status; ?>"required> 
                    <label for="floatingInput">Status</label>
                </div>

                <div class="form-floating">
                    <input type="text" name="tipo" class="form-control" id="floatingInput" placeholder="" value="<?php echo $tipo; ?>"required>
                    <label for="floatingInput">Tipo</label>
                </div><br>

                <button class="w-100 btn btn-lg btn-primary" type="submit"><?php echo strtoupper($acao); ?></button><br><br>

                <p class="mt-5 mb-3 text-muted">&copy; Compartilha Bem - 2024</p>
            </div>
        </div>
    </form>
</main>

<main class="w-100 m-auto" style="min-height: 100px;">
    <button class="w-100 btn btn-primary" onclick="mostrarListagem()">VER CADASTROS</button>

    <div id="listagem" style="display: none;">
        <form action="publicacao.php" method="post">
            <?php
            $sql = "SELECT * FROM publicacao ORDER BY idpublic";
            echo "<table><tr><th>ID</th>  <th>Texto</th>  <th>Valor</th>  <th>Data</th>  <th>Status</th>  <th>Tipo</th>  <th>ID do Usuário</th>  <th>Ações</th></tr>";
            $resultado = $conn->query($sql);
            foreach ($resultado as $registro) {
                echo "<tr><td>" .
                    $registro["idpublic"] . "</td><td>" .
                    $registro["texto"] . "</td><td>" .
                    $registro["data"] . "</td><td>" .
                    $registro["status"] . "</td><td>" .
                    $registro["tipo"] . "</td><td>" .
                    $registro["idusuario"] . "</td><td>
                    <a href='publicacao.php?idpublic=" . $registro["idpublic"] . "&acao=gravarFoto'><span class='material-symbols-outlinedx'>Photos</span></a>
                    <a href='publicacao.php?idpublic=" . $registro["idpublic"] . "&acao=editar'><span class='material-symbols-outlined'>edit</span></a>
                    <a href='publicacao.php?idpublic=" . $registro["idpublic"] . "&acao=excluir'><span class='material-symbols-outlined'>delete</span></a>
                    </td></tr>";
            }
            echo "</table>";
            ?>
            <button class="w-100 btn btn-primary" onclick="alternarListagem()">OCULTAR LISTAGEM</button>
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
// require_once "rodape.php";
?>
