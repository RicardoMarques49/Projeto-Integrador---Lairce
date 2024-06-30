<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compartilhando Bem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/logo.css">
    <style>
        /* Adicione seu estilo personalizado aqui */
        body {
            padding-top: 60px; /* Ajuste para o tamanho do seu cabeçalho */
        }
    </style>
</head>
<body>

    <!-- Cabeçalho -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand"><img src="images/Logo.png" alt="Logo" class="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Produtos/Serviços</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Propaganda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="plano.php">Planos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="publicacao.php">Publicação</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="indextelausuario.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php
       /* session_start();
        // Verifique se o usuário está logado
        if (!isset($_SESSION['idusuario'])) {
            header("Location: login.php");
            exit();
        }

        $idusuario = $_SESSION['idusuario'];
        $nomeusuario = $_SESSION['nome']; // Obtém o nome do usuário da sessão
    */?>
    <!--<header>
        <img src="images/Logo.png" alt="Logo" class="logo">
    </header>
    
    <!-- Carrossel 
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>


        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images\Logo.png" class="d-block w-100" alt="Imagem 1">
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/800x400" class="d-block w-100" alt="Imagem 2">
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/800x400" class="d-block w-100" alt="Imagem 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>