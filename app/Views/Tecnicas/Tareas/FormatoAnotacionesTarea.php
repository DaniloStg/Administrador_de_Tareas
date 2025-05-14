<ul class="nav mt-2" id="anotacion">
        <li class="nav-item">
            <p><strong>Anotaciones</strong></p>
        </li>
        <li class="nav-item">
            <!-- Boton modal compartir tarea -->
            <i type="button" class="bi bi-plus-square-fill fs-4 btncrear" title="Nueva Anotacion" id="logoanotacion" data-bs-toggle="modal" data-bs-target="#anotarTarea"></i>
            <!-- <a class="nav-link active" aria-current="page" href=""> <i class="bi bi-plus-square-fill fs-4" title="Nueva Anotacion" id="logoanotacion" ></i></a> -->
        </li>
    </ul>


<div class="row" id="principalAnotacion">
<?php 
    if(!empty($anotaciones)){
        foreach ($anotaciones as $mensaje){ ?>
        <div class="col-md-12" id="cardAnotacion">
            <strong><?= $mensaje['mensaje'] ?? '' ?></strong>
        </div>
    <?php } 
    } else { ?>
        <p class="mt-3"><strong>No tienes anotaciones creadas.</strong></p>
   <?php } ?>
</div>
<div id="divhr" style="color: white;"><br><hr></div>
