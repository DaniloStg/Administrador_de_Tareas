<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= view('Tecnicas/Enlaces/Enlaces'); ?>

    <title>Perfil</title>
</head>
<body>
    <?php $sesion = session(); ?>
<div class="row principalEst" >

    <div class="col-md-9 d-none d-md-block " id="div1">
    <?= view('Tecnicas/Nav/nav1'); ?>
    </div>

    <div class="col-md-3 d-none d-md-block" id="div2">
    <?= view('Tecnicas/Nav/nav2'); ?>
    </div>

    <div class="cardEst">

        <div id="infoUsuario">
            <h4><strong>Información Personal</strong></h4>
        </div>

        <hr class="hrEst">

        <div id="datosUsuario">
            <h5><strong><?= $sesion->get('usuario_nombre').' '. $sesion->get('usuario_apellido')  ?></strong></h5>
            <h6><i class="bi bi-envelope-fill"></i> Correo: <?= $sesion->get('usuario_correo') ?> </h6>

                        <!-- Boton modal cambiar datos usuario -->
            <button type="button" id="btnEditarInfo" class="btn mb-2" data-bs-toggle="modal" data-bs-target="#cambiarDatosUsuario">
                <i class="bi bi-pencil-fill fs-6"></i><strong>  Editar Información</strong>
            </button>

        </div>
        
        

    </div>

</div>


<!-- modal con formulario para editar datos del usuario -->
<?= view('Tecnicas/Formularios/Usuario'); ?>

<!-- mobile -->
<?= view('Tecnicas/Nav/navMobile'); ?>



</body>
</html>

