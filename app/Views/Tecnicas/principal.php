<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= view('Tecnicas/Enlaces/Enlaces'); ?>

    <title>Principal</title>

</head>

<body>

<div class="row " id="principal">

<div class="col-md-9 d-none d-md-block " id="div1">
    <?= view('Tecnicas/Nav/nav1'); ?>
</div>

<div class="col-md-3 d-none d-md-block" id="div2">
    <?= view('Tecnicas/Nav/nav2'); ?>   
</div>

<div class="col-sm-12 col-md-9 pb-2 " id="div3">

     <!-- view('Tecnicas/Tareas/opcionesTareaActual'); BORRAR ARCHIVO DESPUES DE VERIFICAR FUNCIONAMIENTO-->
    <?= view('Tecnicas/Tareas/FormatoTareaSeleccionada'); ?>

</div>

<div class="col-sm-12 col-md-3 pb-2" id="div4">
<hr class="mx-auto w-75 border-2 d-block- d-md-none">
    <?= view('Tecnicas/Tareas/FormatoListaTareas'); ?>

</div>

<div class="col-sm-12 col-md-9 pb-3" id="div5">

     <!-- view('Tecnicas/Tareas/Anotaciones');  -->
    <?= view('Tecnicas/Tareas/FormatoAnotacionesTarea'); ?>
</div>

<div class="col-sm-12 col-md-3 pb-3" id="div6">

    <?= view('Tecnicas/Tareas/ColoresTareaPrioridad'); ?>

</div>

</div>

<?= view('Tecnicas/Nav/navMobile'); ?>
<?= view('Tecnicas/Formularios/ModalesTarea'); ?>
    
</body>
</html>

<script src="<?= base_url('JavaScript/Script.js') ?>"></script>

