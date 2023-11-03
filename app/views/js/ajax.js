// Obtén todos los elementos con la clase "FormularioAjax".
const formularios_ajax = document.querySelectorAll(".FormularioAjax");

// Agrega un controlador de eventos para cada formulario.
formularios_ajax.forEach(formulario => {
    formulario.addEventListener("submit", function(e) {
        e.preventDefault(); // Previene el envío del formulario por defecto.

        // Muestra una ventana emergente de confirmación con SweetAlert2.
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¿Quieres realizar la acción solicitada?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, realizar',
            cancelButtonText: 'No, cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Procesa el formulario mediante una solicitud AJAX.

                // Crea un objeto FormData con los datos del formulario.
                let data = new FormData(this);
                let method = this.getAttribute("method");
                let action = this.getAttribute("action");

                // Configura los encabezados y opciones de la solicitud fetch.
                let encabezados = new Headers();
                let config = {
                    method: method,
                    headers: encabezados,
                    mode: 'cors',
                    cache: 'no-cache',
                    body: data
                };

                // Realiza una solicitud fetch a la URL de acción.
                fetch(action, config)
                .then(respuesta => respuesta.json())
                .then(respuesta => { 
                    return alertas_ajax(respuesta);
                });
            }
        });
    });
});

// Función para manejar alertas en respuesta a solicitudes AJAX.
function alertas_ajax(alerta) {
    if (alerta.tipo === "simple") {
        // Muestra una alerta simple con SweetAlert2.
        Swal.fire({
            icon: alerta.icono,
            title: alerta.titulo,
            text: alerta.texto,
            confirmButtonText: 'Aceptar'
        });
    } else if (alerta.tipo === "recargar") {
        // Muestra una alerta y recarga la página después de la confirmación.
        Swal.fire({
            icon: alerta.icono,
            title: alerta.titulo,
            text: alerta.texto,
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if(result.isConfirmed) {
                location.reload();
            }
        });
    } else if (alerta.tipo === "limpiar") {
        // Muestra una alerta y restablece el formulario después de la confirmación.
        Swal.fire({
            icon: alerta.icono,
            title: alerta.titulo,
            text: alerta.texto,
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if(result.isConfirmed) {
                document.querySelector(".FormularioAjax").reset();
            }
        });
    } else if (alerta.tipo === "redireccionar") {
        // Redirige a una URL especificada después de la confirmación.
        window.location.href = alerta.url;
    }
}

// Agrega un controlador de eventos al botón de cierre de sesión.
let btn_exit = document.getElementById("btn_exit");
btn_exit.addEventListener("click", function(e) {
    e.preventDefault();

    // Muestra una ventana emergente de confirmación antes de cerrar la sesión.
    Swal.fire({
        title: '¿Quieres salir del sistema?',
        text: 'La sesión actual se cerrará y saldrás del sistema',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, salir',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            let url = this.getAttribute("href");
            window.location.href = url; // Redirige a la URL de cierre de sesión.
        }
    });
});
