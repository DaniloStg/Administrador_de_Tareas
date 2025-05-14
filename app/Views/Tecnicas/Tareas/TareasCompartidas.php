<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= view('Tecnicas/Enlaces/Enlaces'); ?>

    <title>Compartidos</title>
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
                <h4><strong>Tareas Compartidas</strong></h4>
            </div>

            <hr class="hrEst">

            <!-- <div class="cardEst2"> </div> -->
            <div id="divListadoTareas">


                <?php
                if (!empty($tareasCompartidas)) {
                    foreach ($tareasCompartidas as $tarea) {
                        if ($tarea['estado'] == 'Aceptada') { ?>
                            <!-- hacer la logica para poner las compartidas usar la tabla  -->
                            <button class="listaT listaTareas mt-1" data-id="<?= $tarea['idTareaCompartida'] ?>">
                                <span class="etiqueta"><strong>Fecha Vencimiento:</strong></span>
                                <span class="contenido"><?= $tarea['fechaVencimiento'] ?></span> <br>
                                <span class="etiqueta"><strong>Tarea:</strong></span>
                                <span class="contenido"><?= $tarea['titulo'] ?></span>
                            </button>

                    <?php
                        }
                    }
                } else { ?>
                    <p class="mt-3"><strong>No tienes tareas Compartidas.</strong></p>
                <?php } ?>

                <hr class="hrEst">

                <!-- Aceptar o rechazar invitaciones -->
                <h4>Tareas pendientes de respuesta</h4>

                <?php $tienePendientes = false; ?>

                <?php if (!empty($tareasCompartidas)): ?>
                    <?php foreach ($tareasCompartidas  as $tarea): ?>
                        <?php if ($tarea['estado'] == 'Pendiente'): ?>
                            <div class="card mt-3 p-3">
                                <?php
                                $tienePendientes = true; ?>
                                <p><strong>Nombre Tarea:</strong> <?= $tarea['titulo'] ?></p>
                                <p><strong>Usuario:</strong> <?= $tarea['nombreUsuario'] ?></p>



                                <!-- Aceptar -->
                                <?php echo form_open('tareasCompartidas/aceptar', ['method' => 'post', 'style' => 'display:inline;']);
                                echo form_hidden('id', $tarea['idcompartido']);
                                echo form_submit('aceptar', 'Aceptar', ['class' => 'btn btn-success btn-sm mb-3']);
                                echo form_close(); ?>

                                <!-- Rechazar -->
                                <?php echo form_open('tareasCompartidas/rechazar', ['method' => 'post', 'style' => 'display:inline;']);
                                echo form_hidden('id', $tarea['idcompartido']);
                                echo form_submit('rechazar', 'Rechazar', ['class' => 'btn btn-danger btn-sm']);
                                echo form_close(); ?>

                                <hr class="hrEst">
                            </div>
                <?php endif;
                    endforeach;
                endif;
                if (!$tienePendientes) {
                    echo '<p class="mt-3"><strong>No tienes tareas compartidas pendientes.</strong></p>';
                }  ?>

            </div>

        </div>

        <!-- mobile -->
        <?= view('Tecnicas/Nav/navMobile'); ?>

        <!-- Formulario oculto para obtener id de tarea y poder ser vista -->
        <?php echo form_open('form/Tarea', ['id' => 'formTareaSeleccionada']);
        echo form_input([
            'name'  => 'idTareaSeleccionada',
            'id'    => 'idTareaSeleccionada',
            'type'  => 'hidden',
            'value' => ''
        ]);
        echo form_close(); ?>

</body>

</html>

<script src="<?= base_url('JavaScript/Script.js') ?>"></script>