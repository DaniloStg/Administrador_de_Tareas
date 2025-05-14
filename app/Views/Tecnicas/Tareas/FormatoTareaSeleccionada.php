<!-- Opciones Tarea -->
<?php if (isset($tareaSeleccionada)) {
    $sesion = session(); ?>

    <ul id="tarea" class="list-unstyled d-none d-md-flex mt-2">
        <li id="">
            <h5>
                Tarea actual:

                <!--  boton editar tareas  -->
                <?php if (($tareaSeleccionada['estado'] == 'Archivada' && $tareaSeleccionada['id_usuario'] == session()->get('usuario_id')) ||
                    ($tareaSeleccionada['estado'] == 'Finalizada' && $tareaSeleccionada['id_usuario'] == session()->get('usuario_id')) ||
                    ($tareaSeleccionada['estado'] != 'Archivada' && $tareaSeleccionada['estado'] != 'Finalizada')
                ) { ?>
                    <button class="btn btn-sm p-0" data-bs-toggle="modal" data-bs-target="#editarTarea">
                        <i class="bi bi-pencil-square fs-5"></i>
                    </button>
                <?php } ?>
            </h5>
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

    <!-- tarea mobile -->
    <ul id="tareamov" class="list-unstyled d-block- d-md-none mt-3">
        <li>
            <h5>
                Tarea actual:

                <!--  boton editar tareas  -->
                <?php if (($tareaSeleccionada['estado'] == 'Archivada' && $tareaSeleccionada['id_usuario'] == session()->get('usuario_id')) ||
                    ($tareaSeleccionada['estado'] == 'Finalizada' && $tareaSeleccionada['id_usuario'] == session()->get('usuario_id')) ||
                    ($tareaSeleccionada['estado'] != 'Archivada' && $tareaSeleccionada['estado'] != 'Finalizada')
                ) { ?>
                    <button class="btn btn-sm p-0" data-bs-toggle="modal" data-bs-target="#editarTarea">
                        <i class="bi bi-pencil-square fs-5"></i>
                    </button>
                <?php } ?>

            </h5>
        </li>
        <li>
            <?= view('Tecnicas/Tareas/opcionesTareaMobile'); ?>
        </li>
    </ul>
    <h6 id="nombretarea"><?= $tareaSeleccionada['tema'] ?></h6>

<?php } ?>

<!-- Cuerpo de tarea -->

<div id="TareaSeleccionada">

    <?php if (isset($tareaSeleccionada)) { ?>
        <div id="divDatosTareaPrincipal">
            <h6 class="d-flex justify-content-between align-items-center">
                <span>
                    <span class="etiqueta"><strong>Vencimiento:</strong></span>
                    <span class="contenido"> <?= $tareaSeleccionada['fechaVencimiento'] ?></span>
                    -
                    <span class="etiqueta"><strong>Prioridad:</strong></span>
                    <span class="contenido"><?= $tareaSeleccionada['prioridad'] ?></span>
                </span>


                <?php if ($tareaSeleccionada['id_usuario'] == session()->get('usuario_id')) { ?>
                    <span>
                        <button class="btn btn-sm p-0" data-bs-toggle="modal" data-bs-target="#modalConfirmarEliminar">
                            <i class="bi bi-trash3-fill fs-5 text-danger"></i>
                        </button>
                    </span>
                <?php } ?>
            </h6>

            <!--Modal para confirmar eliminacion de tarea  -->
            <div class="modal fade" id="modalConfirmarEliminar" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="modalLabel">Confirmar eliminación</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            ¿Estás seguro de que deseas eliminar esta tarea?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <a href="<?= base_url('/EliminarTarea') ?>" class="btn btn-danger">Eliminar</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- --------------------------------------- -->

            <div class="dropdown">
                <span class="etiqueta"><strong>Estado:</strong></span> <strong> <?= $tareaSeleccionada['estado'] ?></strong>
                <?php if (($tareaSeleccionada['estado'] == 'Archivada' && $tareaSeleccionada['id_usuario'] == session()->get('usuario_id')) ||
                    ($tareaSeleccionada['estado'] == 'Finalizada' && $tareaSeleccionada['id_usuario'] == session()->get('usuario_id')) ||
                    ($tareaSeleccionada['estado'] != 'Archivada' && $tareaSeleccionada['estado'] != 'Finalizada')
                ) { ?>
                    <button class="btn btn-secondary btn-sm dropdown-toggle  ms-2 btncambiarestado" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-pencil-square fs-6"></i> Seleccione
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark">

                        <li>
                            <a class="dropdown-item cambiarEstado" href="#" data-estado="En proceso"> En proceso</a>
                        </li>

                        <li>
                            <a class="dropdown-item cambiarEstado" href="#" data-estado="En pausa"> En pausa</a>
                        </li>

                        <li>
                            <a class="dropdown-item cambiarEstado" href="#" data-estado="Finalizada"> Finalizada</a>
                        </li>

                        <?php if ($tareaSeleccionada['estado'] === 'Finalizada') { ?>
                            <li>
                                <a class="dropdown-item cambiarEstado text-danger" href="#" data-estado="Archivada">Archivar</a>
                            </li>
                        <?php }; ?>


                    </ul>
                <?php }; ?>
            </div>
            <!-- mensaje de alerta sobre finalizacion incorrecta -->
            <?php if (session()->getFlashdata('error')) { ?>
                <div id="mensajeError" class="alert alert-danger mt-2">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php } ?>

            <h6 class="mt-2">
                <span class="etiqueta"><strong>Detalles generales: <?= $tareaSeleccionada['descripcion'] ?></strong></span>
            </h6>
        </div>




        <div id="divhr"><br>
            <hr>
        </div>

        <!-- subtareas -->
        <div>
            <h6>
                <span class="etiqueta">
                    <strong>SubTareas:</strong>
                    <?php if (($tareaSeleccionada['estado'] == 'Archivada' && $tareaSeleccionada['id_usuario'] == session()->get('usuario_id')) ||
                        ($tareaSeleccionada['estado'] == 'Finalizada' && $tareaSeleccionada['id_usuario'] == session()->get('usuario_id')) ||
                        ($tareaSeleccionada['estado'] != 'Archivada' && $tareaSeleccionada['estado'] != 'Finalizada')
                    ) { ?>
                        <a id="aCrearTarea" href="" data-bs-toggle="modal" data-bs-target="#CrearSubTarea">
                            <i class="bi bi-plus-circle-fill fs-6"></i> Crear
                        </a>
                    <?php }; ?>
                </span>
            </h6>


        </div>
        <?php if (!empty($subtareas)) { ?>
            <?php foreach ($subtareas as $subtarea) { ?>
                <div id="subtareasPrin" class="row">
                    <div id="subtareasSecun" class="col-md-12">
                        <h6 class="d-flex justify-content-between align-items-center">
                            <span class="d-flex align-items-center">
                                <span class="etiqueta mx-1"><strong>Tarea: </strong></span>
                                <span class="contenido mr-1"> <?= $subtarea['tema']; ?></span> <span class="mx-2">-</span>

                                <!--  boton editar subTareas  -->
                                <!-- se agregan los datos para mostrarlos al abrir el formulario -->
                                <?php if (($tareaSeleccionada['estado'] == 'Archivada' && $tareaSeleccionada['id_usuario'] == session()->get('usuario_id')) ||
                                    ($tareaSeleccionada['estado'] == 'Finalizada' && $tareaSeleccionada['id_usuario'] == session()->get('usuario_id')) ||
                                    ($tareaSeleccionada['estado'] != 'Archivada' && $tareaSeleccionada['estado'] != 'Finalizada')
                                ) { ?>
                                    <button class="btn btn-sm p-0 d-none d-md-block"
                                        data-bs-toggle="modal" data-bs-target="#editarSubTarea"
                                        data-idsub="<?= $subtarea['id'] ?>"
                                        data-tema="<?= $subtarea['tema'] ?>"
                                        data-descripcion="<?= $subtarea['descripcion'] ?>"
                                        data-prioridad="<?= $subtarea['prioridad'] ?>"
                                        data-vencimiento="<?= $subtarea['fechaVencimiento'] ?>"
                                        data-recordatorio="<?= $subtarea['fechaRecordatorio'] ?>">
                                        <i class="bi bi-pencil-square fs-5"></i>
                                    </button>
                                <?php } ?>

                            </span>

                            <?php if ($tareaSeleccionada['id_usuario'] == session()->get('usuario_id')) { ?>
                                <span>
                                    <button class="btn btn-sm p-0" data-bs-toggle="modal" data-bs-target="#modalConfirmarEliminarSub<?= $subtarea['id'] ?>">
                                        <i class="bi bi-trash3-fill fs-5 text-danger"></i>
                                    </button>
                                </span>
                            <?php } ?>
                        </h6>

                        <!--Modal para confirmar eliminacion de subTarea  -->
                        <div class="modal fade" id="modalConfirmarEliminarSub<?= $subtarea['id'] ?>" tabindex="-1" aria-labelledby="modalSubLabel<?= $subtarea['id'] ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="modalSubLabel<?= $subtarea['id'] ?>">Confirmar eliminación</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>

                                    <div class="modal-body">
                                        ¿Deseas eliminar esta <strong>subtarea</strong>: <em><?= esc($subtarea['tema']) ?></em>?
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-danger eliminar-sub" id="btnEliminarSubtarea" data-idElim="<?= $subtarea['id'] ?>">Eliminar</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- --------------------------------------- -->


                        <h6>
                            <span class="etiqueta"><strong>Responsable:</strong></span>
                            <span class="contenido"><?= $subtarea['nombreResponsable'] ?></span>
                        </h6>


                        <div class="dropdown">
                            <span class="etiqueta"><strong>Estado:</strong></span> <strong> <?= $subtarea['estado']; ?></strong>

                            <?php if (($tareaSeleccionada['estado'] == 'Archivada' && $tareaSeleccionada['id_usuario'] == session()->get('usuario_id')) ||
                                ($tareaSeleccionada['estado'] == 'Finalizada' && $tareaSeleccionada['id_usuario'] == session()->get('usuario_id')) ||
                                ($tareaSeleccionada['estado'] != 'Archivada' && $tareaSeleccionada['estado'] != 'Finalizada')
                            ): ?>
                                <?php if ($subtarea['responsable'] == session()->get('usuario_id')): ?>

                                    <button class="btn btn-secondary btn-sm dropdown-toggle  ms-2 btncambiarestado" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-pencil-square fs-6"></i> Seleccione
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark">

                                        <li>
                                            <a class="dropdown-item cambiarEstadoSub" href="#" data-idSubTarea="<?= $subtarea['id'] ?>" data-estadoSub="En proceso"> En proceso</a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item cambiarEstadoSub" href="#" data-idSubTarea="<?= $subtarea['id'] ?>" data-estadoSub="En pausa"> En pausa</a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item cambiarEstadoSub" href="#" data-idSubTarea="<?= $subtarea['id'] ?>" data-estadoSub="Finalizada"> Finalizada</a>
                                        </li>

                                        <li>
                                        </li>

                                    </ul>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>


                        <h6>
                            <span class="etiqueta"><strong>Vencimiento:</strong></span>
                            <span class="contenido"> <?= $subtarea['fechaVencimiento']; ?></span>
                            -
                            <span class="etiqueta"><strong>Prioridad:</strong></span>
                            <span class="contenido"><?= $subtarea['prioridad']; ?></span>
                        </h6>

                        <h6>
                            <span class="etiqueta"><strong>Detalles generales: <?= $subtarea['descripcion']; ?></strong></span>
                        </h6>

                        <!-- Editar Mobile -->
                        <?php if (($tareaSeleccionada['estado'] == 'Archivada' && $tareaSeleccionada['id_usuario'] == session()->get('usuario_id')) ||
                            ($tareaSeleccionada['estado'] == 'Finalizada' && $tareaSeleccionada['id_usuario'] == session()->get('usuario_id')) ||
                            ($tareaSeleccionada['estado'] != 'Archivada' && $tareaSeleccionada['estado'] != 'Finalizada')
                        ) { ?>
                            <h6 class="d-block- d-md-none">
                                <span class="etiqueta"><strong>Editar:</strong></span>
                                <!--  boton editar subTareas  -->
                                <!-- se agregan los datos para mostrarlos al abrir el formulario -->
                                <button class="btn btn-sm p-0"
                                    data-bs-toggle="modal" data-bs-target="#editarSubTarea"
                                    data-idsub="<?= $subtarea['id'] ?>"
                                    data-tema="<?= $subtarea['tema'] ?>"
                                    data-descripcion="<?= $subtarea['descripcion'] ?>"
                                    data-prioridad="<?= $subtarea['prioridad'] ?>"
                                    data-vencimiento="<?= $subtarea['fechaVencimiento'] ?>"
                                    data-recordatorio="<?= $subtarea['fechaRecordatorio'] ?>">
                                    <i class="bi bi-pencil-square fs-5"></i>
                                </button>
                            </h6>
                        <?php } ?>

                        <!-- ------------ -->
                    </div>


                </div>
                <!-- foreach -->
            <?php } ?>
            <!-- if -->
        <?php } else { ?>
            <p class="d-flex  flex-column align-items-center"><strong>No hay subtareas para esta tarea.</strong></p>
        <?php } ?>

    <?php } else { ?>
        <div class="d-flex  flex-column align-items-center pt-3">
            <button type="button" id="tareabtn" class="btncrear btn" data-bs-toggle="modal" data-bs-target="#CrearTarea">
                <i class="bi bi-plus-circle-fill fs-4"></i> Nueva tarea
            </button>
            <p><strong>No hay tarea seleccionada.</strong></p>
        </div>
    <?php } ?>

</div>

<!-- Formulario oculto para obtener el cambio de estado de tarea -->
<?php echo form_open('form/cambioEstadoTarea', ['id' => 'formCambioEstado']);

echo form_input([
    'name'  => 'cambioEstado',
    'id'    => 'cambioEstado',
    'type'  => 'hidden',
    'value' => ''
]);
echo form_close(); ?>

<!-- Formulario oculto para obtener el cambio de estado de subTarea -->
<?php echo form_open('form/cambiarEstadoSubtarea', ['id' => 'formCambioEstadoSubtarea']);

echo form_input([
    'name'  => 'cambioEstadoSub',
    'id'    => 'cambioEstadoSub',
    'type'  => 'hidden',
    'value' => ''
]);

echo form_input([
    'name'  => 'idSubtarea',
    'id'    => 'idSubtarea',
    'type'  => 'hidden',
    'value' => ''
]);

echo form_close() ?>

<!-- Formulario oculto para eliminar la subTarea  -->
<?php echo form_open('form/eliminarSubTarea', ['id' => 'formEliminarSubTarea']);

echo form_input([
    'name'  => 'eliminarSubTarea',
    'id'    => 'eliminarSubTarea',
    'type'  => 'hidden',
    'value' => ''
]);
echo form_close(); ?>


<!-- Modal para confirmar archivado de tarea -->
<div class="modal fade" id="modalConfirmarArchivar" tabindex="-1" aria-labelledby="modalArchivarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="modalArchivarLabel">Confirmar archivado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas archivar esta tarea? <br>
                Ya no aparecerá en el listado de tareas.
                Solo se podrá consultar en otra sección.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button id="confirmarArchivado" class="btn btn-warning">Archivar</button>
            </div>
        </div>
    </div>
</div>