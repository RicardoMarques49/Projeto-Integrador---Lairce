<?php
require_once "conexao.php"; // Certifique-se de que o arquivo "conexao.php" está corretamente incluído e contém a conexão com o banco de dados

// Pegar e validar os campos de usuário e senha do login.php
if (isset($_POST['email']) && isset($_POST['senha'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    try {
        // Preparar a consulta SQL com placeholders
        $sql = "SELECT * FROM usuario WHERE email = :email AND senha = :senha";
        $stmt = $conn->prepare($sql);

        // Vincular os parâmetros
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);

        // Executar a consulta
        $stmt->execute();

        // Verificar se encontrou algum registro
        if ($stmt->rowCount() > 0) {
            // Usuário encontrado, recuperar os dados
            $registro = $stmt->fetch(PDO::FETCH_ASSOC);
           
            // Verificar o status do usuário
            // Se o status permitir acesso (exemplo: status = 1)
            if ($registro['idusuario']!="") {
                echo "<p>Login deu certo</p>";

                // Criar sessão do usuário para manter o login em outras páginas
                session_start();
                $_SESSION['idusuario'] = $registro['idusuario'];
                $_SESSION['nomeusuario'] = $registro['nome'];

                // Redirecionar para index.php
                header("Location: index.php");
                exit; // Encerrar o script após criar a sessão
            } //else //{
                // Caso o status não permita acesso
                //echo "<h3>Você precisa verificar seu login, status = " . $registro['idstatus'] . "</h3>";
           // }
        } else {
            // Usuário não encontrado ou senha incorreta
            echo "<h3>Usuário ou senha inválidos</h3>";
        }
    } catch (PDOException $e) {
        echo "Erro ao executar a consulta: " . $e->getMessage();
    }
} else {
    // Se os campos não foram preenchidos
    echo "<h3>Preencha o e-mail e a senha.</h3>";
}
?>
