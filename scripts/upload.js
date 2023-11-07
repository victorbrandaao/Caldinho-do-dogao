// Este script intercepta o envio do formulário e envia o arquivo selecionado para o servidor.

document.addEventListener('DOMContentLoaded', function() {
    var uploadForm = document.getElementById('upload-form');

    uploadForm.addEventListener('submit', function(event) {
        event.preventDefault();

        var formData = new FormData(uploadForm);

        fetch('upload.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data); // Exibe uma mensagem com a resposta do servidor
        })
        .catch(error => {
            alert('Erro ao fazer upload: ' + error);
        });
    });
});
