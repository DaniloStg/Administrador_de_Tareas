
<div class="row mt-1" id="divColores">
    <div class="mt-2">
        <span>
            <button type="button" id="btnColores" class="btncrear btn" data-bs-toggle="modal" data-bs-target="#cambiarColorTarea">
                <i class="bi bi-palette-fill mx-2"></i><strong>Guia de colores</strong>    
            </button>
        </span>
    </div>

    <h6 id="SeleccionColorPrioridadAlto" 
    style="box-shadow: 0 2px 5px <?= $coloresTareas['colorAlta'] ?? '#ff0000' ?>, 0 -2px 5px <?= $coloresTareas['colorAlta'] ?? '#ff0000'?>;">  
    Alta Prioridad: Importante<br>
    <span class="etiquetacolor"> <strong>Fecha Vencimiento:</strong></span>  <span class="contenidocolor"> 00/00/0000</span> <br>
    <span class="etiquetacolor"> <strong>Tarea:</strong></span>  <span class="contenidocolor"> Nombre de ejemplo</span> 
    </h6>

    <h6 class="listaTareas"
    style="box-shadow: 0 2px 5px <?= $coloresTareas['colorMedia'] ?? '#646060' ?>, 0 -2px 5px <?= $coloresTareas['colorMedia'] ?? '#646060' ?>;">  
    Media Prioridad: Moderada <br>
    <span class="etiquetacolor"> <strong>Fecha Vencimiento:</strong></span>  <span class="contenidocolor"> 00/00/0000</span> <br>
    <span class="etiquetacolor"> <strong>Tarea:</strong></span>  <span class="contenidocolor"> Nombre de ejemplo</span> 
    </h6>

    <h6 class="listaTareas"
    style="box-shadow: 0 2px 5px <?= $coloresTareas['colorBaja'] ?? '#646060' ?>, 0 -2px 5px <?= $coloresTareas['colorBaja'] ?? '#646060' ?>;">  
    Baja Prioridad: Opcional <br>
    <span class="etiquetacolor"> <strong>Fecha Vencimiento:</strong></span>  <span class="contenidocolor"> 00/00/0000</span> <br>
    <span class="etiquetacolor"> <strong>Tarea:</strong></span>  <span class="contenidocolor"> Nombre de ejemplo</span>
    </h6>


</div>


