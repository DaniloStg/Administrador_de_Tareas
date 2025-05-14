// login

function mostrarRegistroMob() {
    document.getElementById('loginformMob').style.display = 'none';
    document.getElementById('registroFormMob').style.display = 'flex';
}

function mostrarLoginMob() {
    document.getElementById('registroFormMob').style.display = 'none';
    document.getElementById('loginformMob').style.display = 'flex';
}

// lista de tareas y seleccion (formatoListaTareas.php)


document.addEventListener('DOMContentLoaded', function () {
    const campoOculto = document.getElementById('idTareaSeleccionada');
    const formTarea = document.getElementById('formTareaSeleccionada');

    document.querySelectorAll('.listaT').forEach(function (boton) {

        boton.addEventListener('click', function () {
            const idTarea = this.getAttribute('data-id');
            campoOculto.value = idTarea; // asigna el id de la tarea al input oculto
            formTarea.submit(); // envia el formulario
        });
    });
});

// Editar Subtareas
    document.addEventListener('DOMContentLoaded', function () {
        var modalEditar = document.getElementById('editarSubTarea');
        modalEditar.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
    
            // Extraer los datos del botón
            var id = button.getAttribute('data-idsub');
            var tema = button.getAttribute('data-tema');
            var descripcion = button.getAttribute('data-descripcion');
            var prioridad = button.getAttribute('data-prioridad');
            var vencimiento = button.getAttribute('data-vencimiento');
            var recordatorio = button.getAttribute('data-recordatorio');
    
            // Rellenar los campos del formulario
            modalEditar.querySelector('input[name="nombreSubTarea"]').value = tema;
            modalEditar.querySelector('input[name="descripcionSubTarea"]').value = descripcion;
            modalEditar.querySelector('input[name="fechaVencimientoSubTarea"]').value = vencimiento;
            modalEditar.querySelector('input[name="fechaRecordatorioSubTarea"]').value = recordatorio;
            modalEditar.querySelector('select[name="prioridadTareaSubTarea"]').value = prioridad;
            modalEditar.querySelector('input[name="idSubTarea"]').value = id;
        });
    });


 

    // Tarea Seleccionada

       // Cambiar estado tarea
document.addEventListener('DOMContentLoaded', function () {
    const campoOculto = document.getElementById('cambioEstado');
    const formEstado = document.getElementById('formCambioEstado');
    let estadoPendiente = '';

    document.querySelectorAll('.cambiarEstado').forEach(function (boton) {

        boton.addEventListener('click', function (enlace) {
            enlace.preventDefault();
            const nuevoEstado = this.getAttribute('data-estado');
           

            if (nuevoEstado === 'Archivada') {
                estadoPendiente = nuevoEstado;
                const modalArchivar = new bootstrap.Modal(document.getElementById('modalConfirmarArchivar'));
                modalArchivar.show();
            } else {
                campoOculto.value = nuevoEstado; // asigna el estado al campo oculto
                formEstado.submit(); // envia el formulario
            }
        });
    });
    
    // Cambiar estado subTarea
    const idSubT = document.getElementById('idSubtarea');
    const campoOcultoSub = document.getElementById('cambioEstadoSub');
    const formEstadoSub = document.getElementById('formCambioEstadoSubtarea');
    
    document.querySelectorAll('.cambiarEstadoSub').forEach(function (btn) {

        btn.addEventListener('click', function (enlaceSub) {
            enlaceSub.preventDefault();
            const nuevoEstadoSub = this.getAttribute('data-estadoSub');
            const idSubtare = this.getAttribute('data-idSubTarea');
            campoOcultoSub.value = nuevoEstadoSub; // asigna el estado al campo oculto
            idSubT.value = idSubtare;
            formEstadoSub.submit(); // envia el formulario
        });
    });
    // confirmar archivado
    document.getElementById('confirmarArchivado').addEventListener('click', function () {
        campoOculto.value = estadoPendiente;
        formEstado.submit();
    });

    // eliminar subTarea

    const idEliminar = document.getElementById('eliminarSubTarea');
    const formEliminarSub = document.getElementById('formEliminarSubTarea');
    
    document.querySelectorAll('.eliminar-sub').forEach(function (btnE) {

        btnE.addEventListener('click', function (enlaceSub) {
            const idSubtareaElim = this.getAttribute('data-idElim');
            idEliminar.value = idSubtareaElim;
            formEliminarSub.submit(); // envia el formulario
        });
    });


});

// Oculta el mensaje despues de 5 segundos
setTimeout(function() {
    const mensaje = document.getElementById('mensajeError');
    if (mensaje) {
        mensaje.style.display = 'none';
    }
}, 4000);