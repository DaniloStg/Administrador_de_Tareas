
<?php

echo form_open('form/seleccionarOrden', ['id'=>'formOrdenar']);

echo '<span id="spanCuenta"><strong>' .  form_label('Ordenar por:', 'prioridadTarea') . '</span></strong>';
$opcionesOrden = [
    ''             => 'Elegir',
    'prioridad'    => 'Prioridad',
    'FechaProxima' => 'Proxima fecha',
    'todos'        => 'Ver todos',
];
echo form_dropdown('prioridadTarea', $opcionesOrden, '', ['id'=>'selectOrdenTareas', 'onchange' => 'document.getElementById("formOrdenar").submit();']);

echo form_close();



?>
<div id="divListadoTareas">
    <?php 
    if(!empty($tareas)){
        foreach ($tareas as $tarea){ 
            if($tarea['estado'] != 'Archivada'){ ?>
                <?php if($tarea['prioridad'] == 'alta' ){ ?>
                <button id='SeleccionColorPrioridadAlto' class="listaT" 
                style="box-shadow: 0 2px 5px <?= $coloresTareas['colorAlta'] ?? '#ff0000' ?>, 0 -2px 5px <?= $coloresTareas['colorAlta'] ?? '#ff0000'?>;"
                data-id="<?= $tarea['id'] ?>">  
                <?php } if($tarea['prioridad'] == 'media' ) { ?>
                    <button id='SeleccionColorPrioridadAlto' class="listaT" 
                    style="box-shadow: 0 2px 5px <?= $coloresTareas['colorMedia'] ?? '#646060' ?>, 0 -2px 5px <?= $coloresTareas['colorMedia'] ?? '#646060' ?>;"
                    data-id="<?= $tarea['id'] ?>">  
                <?php } if($tarea['prioridad'] == 'baja' ) {?>
                    <button id='SeleccionColorPrioridadAlto' class="listaT" 
                    style="box-shadow: 0 2px 5px <?= $coloresTareas['colorBaja'] ?? '#646060' ?>, 0 -2px 5px <?= $coloresTareas['colorBaja'] ?? '#646060' ?>;"
                    data-id="<?= $tarea['id'] ?>">  
                <?php } ?>        
                    <span class="etiqueta"> <strong>Fecha Vencimiento:</strong></span>
                    <span class="contenido"> <?=$tarea['fechaVencimiento'] ?></span> <br>
                    <span class="etiqueta"> <strong>Tarea:</strong></span> 
                    <span class="contenido"> <?=$tarea['tema'] ?></span> 
                </button>

            <?php } 
        }
        
    } 
    else { ?>
        <p class="mt-3"><strong>No tienes tareas creadas.</strong></p>
    <?php } ?>
</div>
    <!-- Formulario oculto para obtener id de tarea-->
    <?php echo form_open('form/Tarea', ['id' => 'formTareaSeleccionada']) ;
       echo form_input([
                'name'  => 'idTareaSeleccionada',
                'id'    => 'idTareaSeleccionada',
                'type'  => 'hidden',
                'value' => '']);
       echo form_close(); ?>

