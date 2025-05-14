 <!-- Modal crear tarea -->
 <div class="modal fade" id="CrearTarea" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nueva tarea</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body modalTarea">
                        <?php 

                            echo form_open('form/crearTarea', ['id' => 'formCrearTarea']);
                            
                            echo form_label('Nombre','nombreTarea', ['class' => 'form-label mt-2', 'id'=>'labelform']).'<br>';
                            echo form_input(array('name'        => 'nombreTarea',
                                                  'class'       => 'rounded inputLogin',
                                                  'placeholder' => '  Nombre',
                                                  'value'       => old('nombreTarea'))).'<br>';
                            ?>

                            <?php if (session('errors.nombreTarea')){   ?>
                                <div style="height: 20px; color: red; font-size: small;"><?= session('errors.nombreTarea') ?></div>
                            <?php } ?>

                            <?php

                            echo form_label('Descripción/Explicación', 'descripcionTarea', ['class' => 'form-label mt-2', 'id'=>'labelform']).'<br>';
                            echo form_input(array('name'        => 'descripcionTarea',
                                                  'class'       => 'rounded inputLogin',
                                                  'placeholder' => '  Descripción',
                                                  'value'       => old('descripcionTarea'))).'<br>';
                            ?>

                            <?php if (session('errors.descripcionTarea')){   ?>
                                <div style="height: 20px; color: red; font-size: small;"><?= session('errors.descripcionTarea') ?></div>
                            <?php } ?>

                            <?php

                            echo form_label('Fecha de Vencimiento', 'fechaVencimiento', ['class' => 'form-label mt-2', 'id'=>'labelform']).'<br>';
                            echo form_input(array('name'        => 'fechaVencimiento',
                                                  'type'        => 'date',
                                                  'class'       => 'rounded inputLogin',
                                                  'value'       => old('fechaVencimiento'))).'<br>';
                            ?>

                            <?php if (session('errors.fechaVencimiento')){   ?>
                                <div style="height: 20px; color: red; font-size: small;"><?= session('errors.fechaVencimiento') ?></div>
                            <?php } ?>

                            <?php

                            echo form_label("Fecha para recordar Vencimiento", 'fechaRecordatorio', ['class' => 'form-label mt-2', 'id'=>'labelform']).'<br>';
                            echo form_input(array('name'        => 'fechaRecordatorio',
                                                  'type'        => 'date',
                                                  'class'       => 'rounded inputLogin',
                                                  'value'       => old('fechaRecordatorio'))).'<br>';
                            ?>

                            <?php if (session('errors.fechaRecordatorio')){   ?>
                                <div style="height: 20px; color: red; font-size: small;"><?= session('errors.fechaRecordatorio') ?></div>
                            <?php } ?>

                            <?php

                            echo form_label('Prioridad', 'prioridadTarea', ['class'=>'mt-2']).'<br>';
                            $opcionesPrioridad = [
                                ''      => 'Seleccione',
                                'alta'  => 'Alta',
                                'media' => 'Media',
                                'baja'  => 'Baja',
                            ];

                            $valorAnterior = old('prioridadTarea');

                            echo form_dropdown('prioridadTarea', $opcionesPrioridad, $valorAnterior, ['class' => 'form-select inputLogin']);

                            ?>

                            <?php if (session('errors.prioridadTarea')){   ?>
                                <div style="height: 20px; color: red; font-size: small;"><?= session('errors.prioridadTarea') ?></div>
                            <?php } ?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btnCancelar rounded" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btnEnviar rounded" onclick="document.getElementById('formCrearTarea').submit();">Guardar</button>
                    </div>

                    <?php  echo form_close(); ?>

                </div>
            </div>
</div>




<!-- Modal SubTarea -->

 <div class="modal fade" id="CrearSubTarea" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nueva SubTarea</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body modalTarea">
                        <?php 

                            echo form_open('form/crearSubTarea', ['id' => 'formCrearSubTarea']);
                            
                            echo form_label('Nombre','nombreSubTarea', ['class' => 'form-label mt-2', 'id'=>'labelform']).'<br>';
                            echo form_input(array('name'        => 'nombreSubTarea',
                                                  'class'       => 'rounded inputLogin',
                                                  'placeholder' => '  Nombre',
                                                  'value'       => old('nombreSubTarea'))).'<br>';
                            ?>

                            <?php if (session('errors.nombreSubTarea')){   ?>
                                <div style="height: 20px; color: red; font-size: small;"><?= session('errors.nombreSubTarea') ?></div>
                            <?php } ?>

                            <?php

                            echo form_label('Descripción/Explicación', 'descripcionSubTarea', ['class' => 'form-label mt-2', 'id'=>'labelform']).'<br>';
                            echo form_input(array('name'        => 'descripcionSubTarea',
                                                  'class'       => 'rounded inputLogin',
                                                  'placeholder' => '  Descripción',
                                                  'value'       => old('descripcionSubTarea'))).'<br>';
                            ?>

                            <?php if (session('errors.descripcionSubTarea')){   ?>
                                <div style="height: 20px; color: red; font-size: small;"><?= session('errors.descripcionSubTarea') ?></div>
                            <?php } ?>

                            <?php

                            echo form_label('Fecha de Vencimiento', 'fechaVencimientoSubTarea', ['class' => 'form-label mt-2', 'id'=>'labelform']).'<br>';
                            echo form_input(array('name'       => 'fechaVencimientoSubTarea',
                                                 'type'        => 'date',
                                                 'class'       => 'rounded inputLogin',
                                                 'value'       => old('fechaVencimientoSubTarea'))).'<br>';
                            ?>

                            <?php if (session('errors.fechaVencimientoSubTarea')){   ?>
                                <div style="height: 20px; color: red; font-size: small;"><?= session('errors.fechaVencimientoSubTarea') ?></div>
                            <?php } ?>

                            <?php

                            echo form_label("Fecha para recordar Vencimiento", 'fechaRecordatorioSubTarea', ['class' => 'form-label mt-2', 'id'=>'labelform']).'<br>';
                            echo form_input(array('name'        => 'fechaRecordatorioSubTarea',
                                                  'type'        => 'date',
                                                  'class'       => 'rounded inputLogin',
                                                  'value'       => old('fechaRecordatorioSubTarea'))).'<br>';
                            ?>

                            <?php if (session('errors.fechaRecordatorioSubTarea')){   ?>
                                <div style="height: 20px; color: red; font-size: small;"><?= session('errors.fechaRecordatorioSubTarea') ?></div>
                            <?php } ?>

                            <?php

                            echo form_label('Prioridad', 'prioridadTareaSubTarea', ['class'=>'mt-2']).'<br>';
                            $opcionesPrioridad = [
                                ''      => 'Seleccione',
                                'alta'  => 'Alta',
                                'media' => 'Media',
                                'baja'  => 'Baja',
                            ];
                            echo form_dropdown('prioridadTareaSubTarea', $opcionesPrioridad, '', ['class' => 'form-select inputLogin']).'<br>';

                            ?>

                            <?php if (session('errors.prioridadTareaSubTarea')){   ?>
                                <div style="height: 20px; color: red; font-size: small;"><?= session('errors.prioridadTareaSubTarea') ?></div>
                            <?php } ?>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btnCancelar rounded" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btnEnviar rounded" onclick="document.getElementById('formCrearSubTarea').submit();">Guardar</button>
                    </div>

                    <?php  echo form_close(); ?>

                </div>
            </div>
 </div>





<!-- Modal compartir tarea -->

 <div class="modal fade" id="compartirTarea" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Compartir Tarea: Nombre</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body modalCompartir">
                        
                    <?php

                        echo form_open('form/compartirTarea', ['id'=>'comparteTarea']);
                        
                        echo form_label('Titulo mensaje','tituloMensaje', ['class' => 'form-label', 'id'=>'labelform']).'<br>';
                        echo form_input(array('name'        => 'tituloMensaje',
                                              'class'       => 'rounded inputLogin ',
                                              'placeholder' => '  Titulo',
                                              'value'       => old('tituloMensaje'))).'<br>';
                        ?>

                        <?php if (session('errors.tituloMensaje')){   ?>
                            <div style="height: 20px; color: red; font-size: small;"><?= session('errors.tituloMensaje') ?></div>
                        <?php } ?>

                        <?php

                        echo form_label('Correo de la persona a compartir','correoCompartido', ['class' => 'form-label mt-2', 'id'=>'labelform']).'<br>';
                        echo form_input(array('name'        => 'correoCompartido',
                                              'class'       => 'rounded inputLogin',
                                              'placeholder' => '  Correo',
                                              'value'       => old('correoCompartido'))).'<br>';
                        ?>

                        <?php if (session('errors.correoCompartido')){   ?>
                            <div style="height: 20px; color: red; font-size: small;"><?= session('errors.correoCompartido') ?></div>
                        <?php } ?>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btnCancelar rounded" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btnEnviar rounded" onclick="document.getElementById('comparteTarea').submit();">Enviar</button>
                    </div>

                    <?php  echo form_close(); ?>
                </div>
            </div>
</div>





<!-- Modal Anotaciones -->


<div class="modal fade" id="anotarTarea" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Anotaciones - Recordatorios</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body modalAnotacion">
                        
                    <?php

                        echo form_open('form/crearAnotacion', ['id'=>'GuardarAnotacion']);
                        
                        echo form_label('Anotación','anotacionTarea', ['class' => 'form-label', 'id'=>'labelform']).'<br>';
                        echo form_textarea(array('name'        =>'anotacionTarea',
                                                 'id'          => 'comentario',
                                                 'class'       => 'rounded',
                                                 'placeholder' => '  Anotar...'));
                        ?>

                        <?php if (session('errors.anotacionTarea')){   ?>
                            <div style="height: 20px; color: red; font-size: small;"><?= session('errors.anotacionTarea') ?></div>
                        <?php } ?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btnCancelar rounded" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btnEnviar rounded" onclick="document.getElementById('GuardarAnotacion').submit();">Anotar</button>
                    </div>

                    <?php  echo form_close(); ?>

                </div>
            </div>
</div>
<?php
$tareaSeleccionada = session();
$tareaSeleccionada = session()->get('tareaSeleccionada');
?>



<!-- modal editar tarea -->

<div class="modal fade" id="editarTarea" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Tarea</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body modalTarea">
                        <?php 

                            echo form_open('form/editarTarea', ['id' => 'formEditarTarea']);
                            
                            echo form_label('Nombre','nombreTarea', ['class' => 'form-label mt-2', 'id'=>'labelform']).'<br>';
                            echo form_input(array('name'        => 'nombreTarea',
                                                  'class'       => 'rounded inputLogin',
                                                  'placeholder' => '  Nombre',
                                                  'value'       => old('nombreTarea', $tareaSeleccionada['tema'] ?? ''))).'<br>';
                            ?>

                            <?php if (session('errors.nombreTarea')){   ?>
                                <div style="height: 20px; color: red; font-size: small;"><?= session('errors.nombreTarea') ?></div>
                            <?php } ?>

                            <?php

                            echo form_label('Descripción/Explicación', 'descripcionTarea', ['class' => 'form-label mt-2', 'id'=>'labelform']).'<br>';
                            echo form_input(array('name'        => 'descripcionTarea',
                                                  'class'       => 'rounded inputLogin',
                                                  'placeholder' => '  Descripción',
                                                  'value'       => old('descripcionTarea', $tareaSeleccionada['descripcion'] ?? ''))).'<br>';
                            ?>

                            <?php if (session('errors.descripcionTarea')){   ?>
                                <div style="height: 20px; color: red; font-size: small;"><?= session('errors.descripcionTarea') ?></div>
                            <?php } ?>

                            <?php

                            echo form_label('Fecha de Vencimiento (actual '. ($tareaSeleccionada['fechaVencimiento'] ?? '' ). ') ', 'fechaVencimiento', ['class' => 'form-label mt-2', 'id'=>'labelform']).'<br>';
                            echo form_input(array('name'        => 'fechaVencimiento',
                                                  'type'        => 'date',
                                                  'class'       => 'rounded inputLogin',
                                                  'value'       => old('fechaVencimiento'))).'<br>';
                            ?>

                            <?php if (session('errors.fechaVencimiento')){   ?>
                                <div style="height: 20px; color: red; font-size: small;"><?= session('errors.fechaVencimiento') ?></div>
                            <?php } ?>

                            <?php

                            echo form_label('Fecha para recordar Vencimiento (actual '. ($tareaSeleccionada['fechaRecordatorio'] ?? '') . ') ', 'fechaRecordatorio', ['class' => 'form-label mt-2', 'id'=>'labelform']).'<br>';
                            echo form_input(array('name'        => 'fechaRecordatorio',
                                                  'type'        => 'date',
                                                  'class'       => 'rounded inputLogin',
                                                  'value'       => old('fechaRecordatorio'))).'<br>';
                            ?>

                            <?php if (session('errors.fechaRecordatorio')){   ?>
                                <div style="height: 20px; color: red; font-size: small;"><?= session('errors.fechaRecordatorio') ?></div>
                            <?php } ?>

                            <?php

                            echo form_label('Prioridad', 'prioridadTarea', ['class'=>'mt-2']).'<br>';
                            $opcionesPrioridad = [
                                ''      => 'Seleccione',
                                'alta'  => 'Alta',
                                'media' => 'Media',
                                'baja'  => 'Baja',
                            ];

                            echo form_dropdown('prioridadTarea', $opcionesPrioridad, old('prioridadTarea',$tareaSeleccionada['prioridad'] ?? ''), ['class' => 'form-select inputLogin']);
                              
                            ?>

                            <?php if (session('errors.prioridadTarea')){   ?>
                                <div style="height: 20px; color: red; font-size: small;"><?= session('errors.prioridadTarea') ?></div>
                            <?php } ?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btnCancelar rounded" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btnEnviar rounded" onclick="document.getElementById('formEditarTarea').submit();">Guardar</button>
                    </div>

                    <?php  echo form_close(); ?>

                </div>
            </div>
</div>





<!-- modal editar subTarea -->

<div class="modal fade" id="editarSubTarea" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar SubTarea</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body modalTarea">
                        <?php 

                            echo form_open('form/editarSubTarea', ['id' => 'formEditarSubTarea']);
                            
                            echo form_label('Nombre','nombreSubTarea', ['class' => 'form-label mt-2', 'id'=>'labelform']).'<br>';
                            echo form_input(array('name'        => 'nombreSubTarea',
                                                  'class'       => 'rounded inputLogin',
                                                  'placeholder' => '  Nombre',
                                                  'value'       => '')).'<br>';
                            ?>

                            <?php if (session('errors.nombreSubTarea')){   ?>
                                <div class="error-subtarea" style="height: 20px; color: red; font-size: small;"><?= session('errors.nombreSubTarea') ?></div>
                            <?php } ?>

                            <?php

                            echo form_label('Descripción/Explicación', 'descripcionSubTarea', ['class' => 'form-label mt-2', 'id'=>'labelform']).'<br>';
                            echo form_input(array('name'        => 'descripcionSubTarea',
                                                  'class'       => 'rounded inputLogin',
                                                  'placeholder' => '  Descripción',
                                                  'value'       => '')).'<br>';
                            ?>

                            <?php if (session('errors.descripcionSubTarea')){   ?>
                                <div class="error-descripcion-subtarea" style="height: 20px; color: red; font-size: small;"><?= session('errors.descripcionSubTarea') ?></div>
                            <?php } ?>

                            <?php

                            echo form_label('Fecha de Vencimiento', 'fechaVencimientoSubTarea', ['class' => 'form-label mt-2', 'id'=>'labelform']).'<br>';
                            echo form_input(array('name'        => 'fechaVencimientoSubTarea',
                                                  'type'        => 'date',
                                                  'class'       => 'rounded inputLogin',
                                                  'value'       => '')).'<br>';
                            ?>

                            <?php if (session('errors.fechaVencimientoSubTarea')){   ?>
                                <div class="error-fecha-vencimiento-subtarea" style="height: 20px; color: red; font-size: small;"><?= session('errors.fechaVencimientoSubTarea') ?></div>
                            <?php } ?>

                            <?php

                            echo form_label("Fecha para recordar Vencimiento", 'fechaRecordatorioSubTarea', ['class' => 'form-label mt-2', 'id'=>'labelform']).'<br>';
                            echo form_input(array('name'        => 'fechaRecordatorioSubTarea',
                                                  'type'        => 'date',
                                                  'class'       => 'rounded inputLogin',
                                                  'value'       => '')).'<br>';
                            ?>

                            <?php if (session('errors.fechaRecordatorioSubTarea')){   ?>
                                <div class="error-fecha-recordatorio-subtarea" style="height: 20px; color: red; font-size: small;"><?= session('errors.fechaRecordatorioSubTarea') ?></div>
                            <?php } ?>

                            <?php

                            echo form_label('Prioridad', 'prioridadTareaSubTarea', ['class'=>'mt-2']).'<br>';
                            $opcionesPrioridad = [
                                ''      => 'Seleccione',
                                'alta'  => 'Alta',
                                'media' => 'Media',
                                'baja'  => 'Baja',
                            ];


                            echo form_dropdown('prioridadTareaSubTarea', $opcionesPrioridad, '', ['class' => 'form-select inputLogin']);
                            echo form_hidden('idSubTarea'); 
                            ?>

                            <?php if (session('errors.prioridadTareaSubTarea')){   ?>
                                <div class="error-prioridad-subtarea" style="height: 20px; color: red; font-size: small;"><?= session('errors.prioridadTareaSubTarea') ?></div>
                            <?php } ?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btnCancelar rounded" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btnEnviar rounded" onclick="document.getElementById('formEditarSubTarea').submit();">Guardar</button>
                    </div>

                    <?php  echo form_close(); ?>

                </div>
            </div>
</div>


<!-- modal cambio de colores a tareas -->
<div class="modal fade" id="cambiarColorTarea" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cambio de colores</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body modalCompartir">
                        
                    <?php

                        echo form_open('form/guardarColores', ['id'=>'ColorTarea']);
                        
                        echo form_label('Color para prioridad alta:', 'alta'); 
                        echo form_input([
                        'name'  => 'alta',
                        'id'    => 'alta',
                        'type'  => 'color',
                        'value' => $coloresTareas['colorAlta'] ?? '#FF0000',
                        'class' => 'form-control form-control-color',]);
                          
                        echo form_label('Color para prioridad media:', 'media');
                        echo form_input([
                            'name'  => 'media',
                            'id'    => 'media',
                            'type'  => 'color',
                            'value' => $coloresTareas['colorMedia'] ?? '#646060',
                            'class' => 'form-control form-control-color',
                        ]);

                        echo form_label('Color para prioridad baja:', 'baja');
                        echo form_input([
                            'name'  => 'baja',
                            'id'    => 'baja',
                            'type'  => 'color',
                            'value' => $coloresTareas['colorBaja'] ?? '#646060',
                            'class' => 'form-control form-control-color',
                        ]);
                    ?>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btnCancelar rounded" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btnEnviar rounded" onclick="document.getElementById('ColorTarea').submit();">Enviar</button>
                    </div>

                    <?php  echo form_close(); ?>
                </div>
            </div>
</div>


<script>

window.addEventListener('DOMContentLoaded', function () {
        <?php if (session('errors.nombreTarea') || session('errors.descripcionTarea') || session('errors.fechaVencimiento') || session('errors.fechaRecordatorio') || session('errors.prioridadTarea')) { ?>
            var myModal = new bootstrap.Modal(document.getElementById('CrearTarea'));
            myModal.show();
        <?php } ?>

        <?php if (session('errors.nombreSubTarea') || session('errors.descripcionSubTarea') || session('errors.fechaVencimientoSubTarea') || session('errors.fechaRecordatorioSubTarea') || session('errors.prioridadTareaSubTarea')){ ?>
            var myModal = new bootstrap.Modal(document.getElementById('CrearSubTarea'));
            myModal.show();
        <?php } ?>
        
        <?php if (session('errors.tituloMensaje') || session('errors.correoCompartido')) { ?>
            var myModal = new bootstrap.Modal(document.getElementById('compartirTarea'));
            myModal.show();
        <?php } ?>    

        <?php if (session('errors.anotacionTarea')) { ?>
            var myModal = new bootstrap.Modal(document.getElementById('anotarTarea'));
            myModal.show();
        <?php } ?>   


 const modalEditarSubTarea = document.getElementById('editarSubTarea');

    if (modalEditarSubTarea) {
        modalEditarSubTarea.addEventListener('hidden.bs.modal', function () {
            // Oculta visualmente los errores
            document.querySelectorAll('.error-subtarea, .error-descripcion-subtarea, .error-fecha-vencimiento-subtarea, .error-fecha-recordatorio-subtarea, .error-prioridad-subtarea').forEach(function(div) {
                div.innerHTML = '';
                div.style.display = 'none';
                <?php session()->remove('errors'); ?>
            });
           
        });
    }

    });

</script>