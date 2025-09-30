// Componente reutilizable para mostrar alertas visuales con SweetAlert2
// Requiere que SweetAlert2 esté incluido en el proyecto
// Uso: showAlert('Título', 'Mensaje', 'tipo')
// tipo: 'success', 'error', 'warning', 'info', 'question'

function showAlert(title, message, type = 'info', callback = null) {
    if (typeof Swal === 'undefined') {
        alert(message); // Fallback si SweetAlert2 no está disponible
        if (callback) callback();
        return;
    }
    Swal.fire({
        title: title,
        text: message,
        icon: type,
        confirmButtonText: 'Aceptar'
    }).then(function() {
        if (callback) callback();
    });
}

// Ejemplo de uso:
// showAlert('Reserva', 'Debes iniciar sesión para reservar.', 'warning');
