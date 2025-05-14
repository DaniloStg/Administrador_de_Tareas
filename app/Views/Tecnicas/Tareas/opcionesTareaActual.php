<ul id="tarea" class="list-unstyled d-none d-md-flex">
    <li id="">
        <h5>Tarea actual:</h5>
    </li>
    <li id="">
            <!-- Boton modal crear tarea -->
            <button type="button" id="tareabtn" class="btncrear btn" data-bs-toggle="modal" data-bs-target="#CrearTarea">
                <i class="bi bi-plus-circle-fill fs-4"></i> Nueva tarea
            </button>

    </li>
    <li id="">
         <!-- Boton modal compartir tarea -->
            <button id="compartir" type="button" id="tareabtn" class="btncrear btn" data-bs-toggle="modal" data-bs-target="#compartirTarea" data-tipo="subtarea">
                <i class="bi bi-shuffle fs-3"></i>
            </button>
    </li>

</ul>

<ul id="tareamov" class="list-unstyled d-block- d-md-none">
    <li>
        <h5>Tarea actual:</h5>
    </li>
    <li>
        <?= view('Tecnicas/Tareas/opcionesTareaMobile'); ?>
    </li>
</ul>
    <h6 id="nombretarea">Nombre de prueba 1</h6>