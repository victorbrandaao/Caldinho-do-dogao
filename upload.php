<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Verifique se o arquivo é uma imagem real ou falsa
$check = getimagesize($_FILES["file"]["tmp_name"]);
if ($check === false) {
    exit("Arquivo não é uma imagem.");
}

// Permita apenas determinados formatos de arquivo
if (!in_array($imageFileType, ['jpg', 'png', 'jpeg'])) {
    exit("Desculpe, apenas arquivos JPG, JPEG, PNG são permitidos.");
}

// Verifique se o arquivo já existe
if (file_exists($target_file)) {
    exit("Desculpe, o arquivo já existe.");
}

// Tente salvar o arquivo
if (!move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    exit("Desculpe, houve um erro ao enviar seu arquivo.");
}
// Não esqueça de criar a pasta uploads/ no servidor e garantir que ela tenha as permissões corretas para que o PHP possa escrever arquivos nela. Isso pode ser feito através de um cliente FTP ou diretamente no terminal do servidor com o comando mkdir uploads e chmod 755 uploads.
echo "O arquivo " . htmlspecialchars(basename($_FILES["file"]["name"])) . " foi enviado.";
?>


