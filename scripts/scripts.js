// scripts.js
document.addEventListener('DOMContentLoaded', function() {
    var reservaForm = document.getElementById('reserva-form');
    reservaForm.addEventListener('submit', function(e) {
        e.preventDefault();
        // Aqui você pode adicionar a lógica para validar e enviar o formulário
        alert('Formulário enviado!');
    });
});
