<ul class="nav mt-2" id="anotacion">
    <li class="nav-item">
        <p><strong>Anotaciones</strong></p>
    </li>
    <?php if (isset($tareaSeleccionada)): ?>
        <li class="nav-item">
            <i type="button" class="bi bi-plus-square-fill fs-4 btncrear" title="Nueva Anotacion" id="logoanotacion" data-bs-toggle="modal" data-bs-target="#anotarTarea"></i>
        </li>
    <?php endif; ?>
</ul>



<div class="row" id="principalAnotacion">
    <?php
    if (!empty($anotaciones)) {
        foreach ($anotaciones as $mensaje) {
            $id = $mensaje['id'];
            $mensajeTexto = $mensaje['mensaje'];
    ?>
            <div class="col-md-12 mb-2" id="cardAnotacion">
                <div class="d-flex justify-content-between align-items-center">
                    <strong><?= $mensajeTexto ?></strong>

                    <!-- Boton modal -->
                    <button class="btn btn-link p-0 m-0" data-bs-toggle="modal" data-bs-target="#confirmarEliminar<?= $id ?>">
                        <i class="bi bi-trash3-fill fs-5 text-danger" title="Eliminar"></i>
                    </button>
                </div>
            </div>

            <!-- Modal de confirmacion -->
            <div class="modal fade" id="confirmarEliminar<?= $id ?>" tabindex="-1" aria-labelledby="modalLabel<?= $id ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="modalLabel<?= $id ?>">Confirmar eliminación</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <span class="text-dark">¿Estás seguro de que deseas eliminar esta anotación?</span>
                            <div class="mt-2 p-2 border rounded">
                                <span class="text-dark"><?= $mensajeTexto ?></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <?php echo form_open('anotaciones/eliminar');
                                  echo form_hidden('id', $id) ?>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                            <?php echo form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
    } else { ?>
        <p class="mt-3"><strong>No tienes anotaciones creadas.</strong></p>
    <?php } ?>
</div>