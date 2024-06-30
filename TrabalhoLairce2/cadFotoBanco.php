<?php
//try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") { // Verifica se o formulário foi submetido
        // Verifica se todos os campos necessários estão definidos
        
        //$idpublic = $_POST['idpublicacao'];
        // echo $idpublic;
        
        if (isset($_POST["idpublicacao"])) {

                $idpublic = $_POST['idpublicacao'];
               

            // Verifica se uma imagem foi enviada
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
                $imagem = $_FILES['foto'];
                $tipoimagem = $imagem['type'];
                define('TAMANHO_MAXIMO', (2 * 1024 * 1024)); // 2 MB
				
				echo "teste";
                if($imagem != NULL) {
                    $tamanho = $imagem['size'];
                    // Validações básicas
                    // Formato
                    if(!preg_match('/^image\/(pjpeg|jpeg|png|gif|bmp)$/', $tipoimagem))
                    {
                        echo 'Não é uma imagem válida';
                        exit;
                    }
                    // Tamanho
                    if ($tamanho > TAMANHO_MAXIMO)
                    {
                        echo 'A imagem deve possuir no máximo 2 MB';
                        exit;
                    }
                    // Transformando foto em dados (binário)
                    $conteudo = file_get_contents($imagem['tmp_name']);
                } else {
                    echo "Você não realizou o upload de forma satisfatória.";
                    exit;
                }
            } else {
                echo "Nenhuma imagem foi enviada.";
                exit;
            }

            // Inclua aqui a configuração da conexão com o banco de dados
            require_once("conexao.php");

            // Prepare a declaração SQL para inserir os dados
            $stmt = $conn->prepare('INSERT INTO fotosvideos (foto, idpublic) VALUES (:foto, :idpublic)');

            // Defina os parâmetros
            $stmt->bindParam(':idfoto', $idfoto, PDO::PARAM_STR);
            $stmt->bindParam(':conteudo', $conteudo, PDO::PARAM_LOB);
            $stmt->bindParam(':idpublic', $idpublic, PDO::PARAM_STR);

            // Execute a declaração
            $stmt->execute();

            // Redirecione após o registro ser salvo
            header("Location:telalogado.php");
            exit();
        } else {
            echo "<p>Digite todos os dados.</p>";
        }
    }
//} catch(Exception $e) {
    //echo "<br>" . $e->getMessage();
//}
?>
