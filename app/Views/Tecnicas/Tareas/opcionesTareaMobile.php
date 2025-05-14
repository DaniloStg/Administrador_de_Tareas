<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle d-block- d-md-none mt-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
  <i class="bi bi-filter-left fs-4"></i>
  </button>
  <ul class="dropdown-menu dropdown-menu-dark">

    <!-- <li>
      <a class="dropdown-item" href="#" >Anotaciones</a>
    </li> -->
    <li>
      <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#compartirTarea"><i class="bi bi-shuffle fs-5"></i>  Compartir</a>
    </li>

    <li><hr class="dropdown-divider"></li>   

    <li>
      <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#CrearTarea"><i class="bi bi-plus-circle-fill fs-5"></i>  Nueva Tarea </a>
    </li>
    
    <li><hr class="dropdown-divider"></li>    
    <li>
      <a class="dropdown-item" href="<?= base_url('Login') ?>"><i class="fa-solid fa-door-open fs-5"></i>  Cerrar Sesión</a>
    </li>
    
  </ul>
</div>


