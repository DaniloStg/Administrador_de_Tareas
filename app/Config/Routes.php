<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/Principal', 'Tecnicas\Controlador::index');
$routes->get('/Login', 'Tecnicas\Controlador::login');
$routes->get('/Perfil', 'Tecnicas\Controlador::perfilUsuario');
$routes->get('/Compartidos', 'Tecnicas\Controlador::tareasCompartidas');
$routes->get('/Archivados', 'Tecnicas\Controlador::archivarTarea');
$routes->get('/Cerrar', 'Tecnicas\Controlador::cerrarSesion');
$routes->get('/EliminarTarea', 'Tecnicas\Controlador::eliminarTarea');

$routes->post('form/CambioDatosUsuario','Tecnicas\Controlador::CambioDatosUsuario');
$routes->post('form/crearUsuario', 'Tecnicas\Controlador::crearUsuario');
$routes->post('form/loginUsuario', 'Tecnicas\Controlador::loginUsuario');
$routes->post('form/crearTarea', 'Tecnicas\Controlador::crearTarea');
$routes->post('form/Tarea', 'Tecnicas\Controlador::Tarea');
$routes->post('form/crearSubTarea', 'Tecnicas\Controlador::crearSubTarea');
$routes->post('form/compartirTarea', 'Tecnicas\Controlador::compartirTarea');
$routes->post('form/crearAnotacion', 'Tecnicas\Controlador::crearAnotacion');
$routes->post('form/cambioEstadoTarea', 'Tecnicas\Controlador::cambioEstadoTarea');
$routes->post('form/cambiarEstadoSubtarea', 'Tecnicas\Controlador::cambiarEstadoSubtarea');
$routes->post('form/eliminarSubTarea', 'Tecnicas\Controlador::eliminarSubTarea');
$routes->post('form/editarTarea', 'Tecnicas\Controlador::editarTarea');
$routes->post('form/editarSubTarea', 'Tecnicas\Controlador::editarSubTarea');
$routes->post('form/guardarColores', 'Tecnicas\Controlador::guardarColores');
$routes->post('form/seleccionarOrden','Tecnicas\Controlador::seleccionarOrden');
$routes->post('tareasCompartidas/aceptar','Tecnicas\Controlador::aceptarTarea');
$routes->post('tareasCompartidas/rechazar','Tecnicas\Controlador::rechazarTarea');
$routes->post('anotaciones/eliminar', 'Tecnicas\Controlador::eliminarAnotacion');



