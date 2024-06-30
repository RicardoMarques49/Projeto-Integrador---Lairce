<?php
require_once "conexao.php"; // Incluir seu arquivo de conexão aqui
session_start();

if (!isset($_SESSION['idusuario'])) {
    header("Location: login.php");
    exit;
}

$idusuario = $_SESSION['idusuario'];

// Recebendo os dados do formulário
$idplano = $_POST['idplano']; // Verifique se o nome do campo do formulário está correto
$data = date('Y-m-d'); // Data atual
$tipo = "Plano"; // Defina o tipo de pagamento, pode ser ajustado conforme necessário

// Consultar o preço do plano para inserir no pagamento
$sqlPreco = "SELECT preco FROM plano WHERE idplano = :idplano";
$stmtPreco = $conn->prepare($sqlPreco);
$stmtPreco->bindParam(':idplano', $idplano);
$stmtPreco->execute();
$resultadoPreco = $stmtPreco->fetch(PDO::FETCH_ASSOC);

if ($resultadoPreco) {
    $valor = $resultadoPreco['preco'];

    // Inserir o pagamento mensal na tabela
    $sql = "INSERT INTO pagamentomensal (data, tipo, valor, idplano, idusuario) 
            VALUES (:data, :tipo, :valor, :idplano, :idusuario)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':data', $data);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':valor', $valor);
    $stmt->bindParam(':idplano', $idplano);
    $stmt->bindParam(':idusuario', $idusuario);

    if ($stmt->execute()) {
        // Pagamento inserido com sucesso, redireciona para página de publicações
        header("Location: publicacao.php");
        exit;
    } else {
        // Erro ao inserir pagamento
        echo "Erro ao inserir pagamento mensal";
    }
} else {
    // Plano não encontrado
    echo "Plano não encontrado";
}
?>
