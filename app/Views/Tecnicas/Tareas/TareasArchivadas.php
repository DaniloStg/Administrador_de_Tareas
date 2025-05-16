<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= view('Tecnicas/Enlaces/Enlaces'); ?>

    <title>Archivados</title>
</head>
<body>
    
<div class="row principalEst">

    <div class="col-md-9 d-none d-md-block " id="div1">
    <?= view('Tecnicas/Nav/nav1'); ?>
    </div>

    <div class="col-md-3 d-none d-md-block" id="div2">
    <?= view('Tecnicas/Nav/nav2'); ?>
    </div>


    <div class="cardEst">

        <div id="infoUsuario">
            <h4><strong>Tareas Archivadas</strong></h4>
        </div>

        <hr class="hrEst">

        <!-- <div class="cardEst2"> </div> -->
        <div id="divListadoTareas">

    <?php 
    $tieneArchivadas = false;
    if(!empty($tareas)){
        foreach ($tareas as $tarea){ 
            if($tarea['estado'] == 'Archivada'){ 
                $tieneArchivadas = true;?>
                <button class="listaT listaTareas mt-1" data-id="<?= $tarea['id'] ?>">  
                    <span class="etiqueta"> <strong>Fecha Vencimiento:</strong></span>
                    <span class="contenido"> <?=$tarea['fechaVencimiento'] ?></span> <br>
                    <span class="etiqueta"> <strong>Tarea:</strong></span> 
                    <span class="contenido"> <?=$tarea['tema'] ?></span> 
                </button>

            <?php } 
        }
        
    }  ?>
    <?php if(!$tieneArchivadas) { ?>
            <p class="mt-3"><strong>No tienes tareas archivadas.</strong></p>  
        <?php } ?>
    </div>    

</div>

    <!-- mobile -->
    <?= view('Tecnicas/Nav/navMobile'); ?>

    <!-- Formulario oculto para obtener id de tarea-->
    <?php echo form_open('form/Tarea', ['id' => 'formTareaSeleccionada']) ;
       echo form_input([
                'name'  => 'idTareaSeleccionada',
                'id'    => 'idTareaSeleccionada',
                'type'  => 'hidden',
                'value' => '']);
       echo form_close(); ?>


</body>
</html>

<script src="<?= base_url('JavaScript/Script.js') ?>"></script>
