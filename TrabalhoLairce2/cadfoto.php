<?php
session_start();
require_once "conexao.php";
echo $_SESSION['idpublic'];


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
<body>
	<?php 
		$acao = "Salvar"; 
	?>
	<form action="cadfoto.php" method="post">
		 <input type="text" name="idpublicacao" value="<?php echo $_SESSION['idpublic']; ?>">
		<label for="avatar">Escolha um imagem:</label>
		<input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg" />
		<button class="w-100 btn btn-lg btn-primary" type="submit"><?php echo strtoupper($acao); ?></button><br><br>
	</form>
</body>

</html>
