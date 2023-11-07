<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_name = $_POST['item_name'];
    $item_description = $_POST['item_description'];
    $item_price = $_POST['item_price'];

    // Processar a imagem
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["item_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verificar se o arquivo é uma imagem real ou um arquivo falso
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["item_image"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
    }

    // Verificar se o arquivo já existe
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }

    // Se tudo estiver ok, tenta fazer o upload
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["item_image"]["tmp_name"], $target_file)) {
            // Inserir dados no banco de dados
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Conexão falhou: " . $conn->connect_error);
            }

            $sql = "INSERT INTO itens_happy_hour (nome, descricao, preco, imagem) VALUES ('$item_name', '$item_description', '$item_price', '$target_file')";

            if ($conn->query($sql) === TRUE) {
                echo "Item adicionado com sucesso!";
            } else {
                echo "Erro ao adicionar item: " . $conn->error;
            }

            $conn->close();
        } else {
            echo "Erro ao fazer o upload do arquivo.";
        }
    } else {
        echo "O arquivo não é uma imagem válida ou já existe.";
    }
}
?>
