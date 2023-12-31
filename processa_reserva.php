<?php
include 'config.php';
// Substitua os valores abaixo com as informações do seu banco de dados
$servername = "localhost";
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "nome_do_seu_banco_de_dados";

// Cria a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Checa a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Prepara a declaração SQL
$stmt = $conn->prepare("INSERT INTO reservas (nome_cliente, telefone_cliente, data_reserva, quantidade_pessoas, comanda_individual) VALUES (?, ?, ?, ?, ?)");

// Converte comanda_individual para um valor booleano adequado para o banco de dados
$comanda_individual = ($_POST['comanda_individual'] === 'sim') ? 1 : 0;

// Obtém os dados do formulário
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$data_reserva = $_POST['data_reserva'];
$quantidade_pessoas = $_POST['quantidade_pessoas'];

// Vincula os parâmetros
$stmt->bind_param("sssii", $nome, $telefone, $data_reserva, $quantidade_pessoas, $comanda_individual);

// Executa a declaração preparada
if ($stmt->execute()) {
    echo "Reserva feita com sucesso!";
} else {
    echo "Erro ao fazer a reserva: " . $stmt->error;
}

// Fecha a declaração e a conexão
$stmt->close();
$conn->close();
?>
