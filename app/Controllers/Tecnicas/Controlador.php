<?php

namespace App\Controllers\Tecnicas;

use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;

class Controlador extends BaseController
{

    public function __construct()
    {
        helper('form');
    }




    public function index()
    {

        $sesion = session();
        //  si no se inicio sesion, lleva a login
        if (!$sesion->get('logeado')) {
            return redirect()->to(base_url('/Login'));
        }
        // -------------------------------- //

        // Carga todas las tareas del usuario //

        $idUsuario = $sesion->get('usuario_id');

        // Orden actual
        $orden = $sesion->get('ordenTareas') ?? '';

        $model = new \App\Models\Tecnicas\ModelCrearTarea();

        // Aplica el orden
        if (!empty($orden)) {
            if ($orden === 'prioridad') {
                $model->orderBy("FIELD(prioridad, 'alta', 'media', 'baja')");
            } elseif ($orden === 'FechaProxima') {
                $model->orderBy('fechaVencimiento', 'DESC');
            } elseif ($orden === 'todos') {
                $model->orderBy('id', 'DESC');
            } else {
                // Orden por defecto
                $model->orderBy('fechaVencimiento', 'DESC');
            }
        }
        $tareas = $model->where('id_usuario', $idUsuario)->orderBy('fechaVencimiento', 'DESC')->findAll();

        // -------------------------------- //

        // Carga tarea seleccionada //

        $tareaSeleccionada = session()->get('tareaSeleccionada');


        // carga el responsable //
        $responsable = null;
        if ($tareaSeleccionada) {
            $modelUsuario = new \App\Models\Tecnicas\ModelsCrearUsuario();
            $responsable = $modelUsuario->find($tareaSeleccionada['id_usuario']);
        }
        // -------------------------------- //

        // Carga subTareas //

        $subtareas = session()->get('subtareas');

        // Nombre del responsable a cada subtarea

        if ($subtareas) {
            $modelUsuario = new \App\Models\Tecnicas\ModelsCrearUsuario();
            foreach ($subtareas as &$subtarea) {
                $usuario = $modelUsuario->where('id', $subtarea['responsable'])->first();
                $subtarea['nombreResponsable'] = $usuario ? $usuario['nombre'] . ' ' . $usuario['apellido'] : 'Desconocido';
            }
            unset($subtarea);
        }
        // Carga anotaciones

        $modelAnotacion = new \App\Models\Tecnicas\ModelAnotacion();

        $anotaciones = $modelAnotacion->where('id_usuario', $idUsuario)
            ->where('id_tarea', $tareaSeleccionada['id'] ?? 0)
            ->orderBy('id', 'DESC')
            ->findAll();

        $anotaciones = session()->get('anotaciones');

        // -------------------------------- //


        // Carga colores de tareas //

        $modeloColor = new \App\Models\Tecnicas\ModelColorPrioridad();
        $coloresTareas = $modeloColor->where('id_usuario', $idUsuario)->first();

        // -------------------------------- //


        return view('Tecnicas/principal', [
            'tareas'            => $tareas,
            'tareaSeleccionada' => $tareaSeleccionada,
            'subtareas'         => $subtareas,
            'coloresTareas'     => $coloresTareas,
            'anotaciones'       => $anotaciones,
            'responsable'       => $responsable
        ]);
    }

    public function login()
    {
        return view('Tecnicas/Formularios/Login');
    }




    public function loginUsuario()
    {

        $validacion = service('validation');
        $validacion->setRules(
            [
                'correoLogin' => 'required|valid_email',
                'passwordLogin' => 'required|min_length[4]',
            ],

            [
                'correoLogin' => [
                    'required'   => 'Campo requerido',
                    'valid_email' => 'No es un correo',
                ],

                'passwordLogin' => [
                    'required'   => 'Campo requerido',
                    'min_length' => 'No es valida',
                ]
            ]
        );

        if (!$validacion->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validacion->getErrors());
        }

        $correo = $this->request->getPost('correoLogin');
        $password = $this->request->getPost('passwordLogin');

        $model = new \App\Models\Tecnicas\ModelsCrearUsuario();

        // array con los datos del usuario (si lo encuentra)
        $usuario = $model->where('correo', $correo)->first();

        if (!$usuario) {
            return redirect()->back()->with('errors', ['correoLogin' => 'El correo no está registrado']);
        }

        if (!password_verify($password, $usuario['contrasena'])) {
            return redirect()->back()->with('errors', ['passwordLogin' => 'Contraseña incorrecta']);
        }

        $sesion = session();
        $sesion->set([
            'usuario_id'       => $usuario['id'],
            'usuario_nombre'   => $usuario['nombre'],
            'usuario_apellido' => $usuario['apellido'],
            'usuario_correo'   => $usuario['correo'],
            'logeado'          => true,
        ]);


        return redirect()->to(base_url('/Principal'));
    }




    public function crearUsuario()
    {
        $validacion = service('validation');
        $validacion->setRules(
            [
                'nombreRegistro'      => 'required|min_length[3]|alpha_space',
                'apellidoRegistro'    => 'required|min_length[3]|alpha_space',
                'correoRegistro'      => 'required|valid_email|is_unique[usuarios.correo]',
                'passwordRegistro'    => 'required|min_length[4]',
                'passwordRegistroRep' => 'matches[passwordRegistro]'
            ],

            [
                'nombreRegistro' => [
                    'required'   => 'Campo requerido',
                    'min_length' => 'Tres caracteres mínimos',
                    'alpha_space' => 'Sin números'
                ],

                'apellidoRegistro' => [
                    'required'   => 'Campo requerido',
                    'min_length' => 'Tres caracteres mínimos',
                    'alpha_space' => 'Sin números'
                ],

                'correoRegistro' => [
                    'required'   => 'Campo requerido',
                    'valid_email' => 'No es un Correo',
                    'is_unique'  => 'El correo ya está registrado'
                ],

                'passwordRegistro' => [
                    'required'  => 'Campo requerido',
                    'min_length' => 'Cuatro caracteres mínimos'
                ],

                'passwordRegistroRep' => ['matches' => 'La contraseña no coincide']


            ]
        );

        if (!$validacion->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validacion->getErrors());
        }

        $datos = array(
            'nombre' => $this->request->getPost('nombreRegistro'),
            'apellido' => $this->request->getPost('apellidoRegistro'),
            'correo' => $this->request->getPost('correoRegistro'),
            'contrasena' => password_hash($this->request->getPost('passwordRegistro'), PASSWORD_DEFAULT)
        );


        $model = new \App\Models\Tecnicas\ModelsCrearUsuario();
        $model->insert($datos);

        return redirect()->to(base_url('/Login'));
    }




    public function crearTarea()
    {

        $validacion = service('validation');
        $validacion->setRules(
            [
                'nombreTarea'      => 'required|min_length[4]|regex_match[/^[\p{L}0-9\s.,!¡¿?()@#%&*\-_:;"]+$/u]',
                'descripcionTarea' => 'required|min_length[5]|regex_match[/^[\p{L}0-9\s.,!¡¿?()@#%&*\-_:;"]+$/u]',
                'fechaVencimiento' => 'required',
                'fechaRecordatorio' => 'required',
                'prioridadTarea'   => 'required|in_list[alta,media,baja]'
            ],

            [
                'nombreTarea' => [
                    'required'            => 'Campo Requerido',
                    'min_length'          => 'Cuatro caracteres mínimos',
                    'alpha_numeric_space' => 'Sin caracteres especiales'
                ],

                'descripcionTarea' => [
                    'required'            => 'Campo Requerido',
                    'min_length'          => 'Cinco caracteres mínimos',
                    'alpha_numeric_space' => 'Sin caracteres especiales'
                ],

                'fechaVencimiento' => ['required' => 'Campo Requerido'],

                'fechaRecordatorio' => ['required' => 'Campo Requerido'],

                'prioridadTarea' => [
                    'required' => 'Seleccionar una prioridad',
                    'in_list'  => 'Selecciona una prioridad válida'
                ],

            ]
        );

        if (!$validacion->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validacion->getErrors());
        }

        $fechaVencimiento = $this->request->getPost('fechaVencimiento');
        $fechaRecordatorio = $this->request->getPost('fechaRecordatorio');

        $fechaVencimientoTime = Time::parse($fechaVencimiento, 'America/Argentina/Buenos_Aires');
        $fechaRecordatorioTime = Time::parse($fechaRecordatorio, 'America/Argentina/Buenos_Aires');

        $fechaActual = Time::today('America/Argentina/Buenos_Aires');

        if ($fechaVencimientoTime->isBefore($fechaActual)) {
            return redirect()->back()->withInput()->with('errors', ['fechaVencimiento' => 'La fecha de vencimiento no puede ser anterior a hoy.']);
        }

        if ($fechaRecordatorioTime->isBefore($fechaActual)) {
            return redirect()->back()->withInput()->with('errors', ['fechaRecordatorio' =>  'La fecha de recordatorio no puede ser anterior a hoy']);
        }

        $fechaVencimientoFormateada = $fechaVencimientoTime->toLocalizedString('d/M/Y');
        $fechaRecordatorioFormateada = $fechaRecordatorioTime->toLocalizedString('d/M/Y');

        $sesion = session();

        $datosTarea = array(
            'tema' => $this->request->getPost('nombreTarea'),
            'descripcion' => $this->request->getPost('descripcionTarea'),
            'prioridad' => $this->request->getPost('prioridadTarea'),
            'fechaVencimiento' => $fechaVencimientoFormateada,
            'fechaRecordatorio' =>  $fechaRecordatorioFormateada,
            'id_usuario' => $sesion->get('usuario_id'),

        );


        $model = new \App\Models\Tecnicas\ModelCrearTarea();
        $model->insert($datosTarea);

        return redirect()->to(base_url('/Principal'));
    }


    public function Tarea()
    {

        $idTarea = $this->request->getPost('idTareaSeleccionada');

        // Obtener la tarea desde la base de datos
        $model = new \App\Models\Tecnicas\ModelCrearTarea();
        $tareaseleccionada = $model->find($idTarea);

        session()->set('tareaSeleccionada', $tareaseleccionada);
        session()->set('idTareaSeleccionada', $idTarea);

        // Obtener las subtareas 

        $modelSub = new \App\Models\Tecnicas\ModelCrearSubTarea();
        $subtareas = $modelSub->where('idTareaPrincipal', $idTarea)->findAll();

        // Obtener las anotaciones

        $modelAnotacion = new \App\Models\Tecnicas\ModelAnotacion();
        $anotaciones = $modelAnotacion->where('id_tarea', $idTarea)->findAll();

        session()->set('subtareas', $subtareas);
        session()->set('anotaciones', $anotaciones);

        return redirect()->to(base_url('/Principal'));
    }





    public function crearSubTarea()
    {
        $sesion = session();
        $validacion = service('validation');
        $validacion->setRules(
            [
                'nombreSubTarea'      => 'required|min_length[4]|regex_match[/^[\p{L}0-9\s.,!¡¿?()@#%&*\-_:;"]+$/u]',
                'descripcionSubTarea' => 'required|min_length[5]|regex_match[/^[\p{L}0-9\s.,!¡¿?()@#%&*\-_:;"]+$/u]'
            ],

            [
                'nombreSubTarea' => [
                    'required'            => 'Campo Requerido',
                    'min_length'          => 'Cuatro caracteres mínimos',
                    'alpha_numeric_space' => 'Sin caracteres especiales'
                ],

                'descripcionSubTarea' => [
                    'required'            => 'Campo Requerido',
                    'min_length'          => 'Cinco caracteres mínimos',
                    'alpha_numeric_space' => 'Sin caracteres especiales'
                ],

            ]
        );

        if (!$validacion->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validacion->getErrors());
        }

        $fechaRecordatorioFormateada = '';
        $fechaVencimientoFormateada = '';

        if (!empty($this->request->getPost('fechaVencimientoSubTarea'))) {

            $fechaVencimiento  = $this->request->getPost('fechaVencimientoSubTarea');
            $fechaVencimientoTime = Time::parse($fechaVencimiento, 'America/Argentina/Buenos_Aires');
            $fechaActual = Time::today('America/Argentina/Buenos_Aires');

            if ($fechaVencimientoTime->isBefore($fechaActual)) {
                return redirect()->back()->withInput()->with('errors', ['fechaVencimientoSubTarea' => 'La fecha de vencimiento no puede ser anterior a hoy.']);
            }

            $fechaVencimientoFormateada = $fechaVencimientoTime->toLocalizedString('d/M/Y');
        }

        if (!empty($this->request->getPost('fechaRecordatorioSubTarea'))) {

            $fechaRecordatorio = $this->request->getPost('fechaRecordatorioSubTarea');
            $fechaRecordatorioTime = Time::parse($fechaRecordatorio, 'America/Argentina/Buenos_Aires');
            $fechaActual = Time::today('America/Argentina/Buenos_Aires');

            if ($fechaRecordatorioTime->isBefore($fechaActual)) {
                return redirect()->back()->withInput()->with('errors', ['fechaRecordatorioSubTarea' =>  'La fecha de recordatorio no puede ser anterior a hoy']);
            }

            $fechaRecordatorioFormateada = $fechaRecordatorioTime->toLocalizedString('d/M/Y');
        }


        $datosSubTarea = array(
            'tema'              => $this->request->getPost('nombreSubTarea'),
            'descripcion'       => $this->request->getPost('descripcionSubTarea'),
            'prioridad'         => $this->request->getPost('prioridadTareaSubTarea'),
            'fechaVencimiento'  => $fechaVencimientoFormateada,
            'fechaRecordatorio' => $fechaRecordatorioFormateada,
            'idTareaPrincipal'  => $sesion->get('idTareaSeleccionada'),
            'responsable'       => $sesion->get('usuario_id')
        );

        $model = new \App\Models\Tecnicas\ModelCrearSubTarea();
        $model->insert($datosSubTarea);


        // Actualiza el estado de la tarea principal si esta finalizada
        $modelTarea = new \App\Models\Tecnicas\ModelCrearTarea();

        $tarea = $modelTarea->find(session()->get('idTareaSeleccionada'));
        if ($tarea && $tarea['estado'] == 'Finalizada') {

            $modelTarea->update(session()->get('idTareaSeleccionada'), ['estado' => 'En proceso']);

            // Actualiza la sesion
            $tareaActualizada = $modelTarea->find(session()->get('idTareaSeleccionada'));
            $sesion->set('tareaSeleccionada', $tareaActualizada);
        }

        // Actualiza las subtareas para traer todas de nuevo
        $modelSub = new \App\Models\Tecnicas\ModelCrearSubTarea();
        $subtareas = $modelSub->where('idTareaPrincipal', $sesion->get('idTareaSeleccionada'))->findAll();

        session()->set('subtareas', $subtareas);

        return redirect()->to(base_url('/Principal'));
    }




    public function cambioEstadoTarea()
    {

        $estado = $this->request->getPost('cambioEstado');
        $idTarea = session()->get('idTareaSeleccionada');

        $model = new \App\Models\Tecnicas\ModelCrearTarea();
        $modelSub = new \App\Models\Tecnicas\ModelCrearSubTarea();

        //si quiere finalizar, revisa subtareas
        if ($estado === 'Finalizada') {
            $subtareas = $modelSub->where('idTareaPrincipal', $idTarea)->findAll();

            foreach ($subtareas as $sub) {
                if ($sub['estado'] !== 'Finalizada') {
                    session()->setFlashdata('error', 'No puedes finalizar esta tarea hasta que todas sus subtareas estén finalizadas.');
                    return redirect()->to(base_url('/Principal'));
                }
            }
        }

        $model->update($idTarea, ['estado' => $estado]);

        // Actualiza la tarea en la sesion
        $tareaseleccionada = $model->find($idTarea);

        session()->set('tareaSeleccionada', $tareaseleccionada);

        return redirect()->to(base_url('/Principal'));
    }




    public function cambiarEstadoSubtarea()
    {

        $sesion = session();

        $estado = $this->request->getPost('cambioEstadoSub');
        $idSubTarea = $this->request->getPost('idSubtarea');

        $modelsubTarea = new \App\Models\Tecnicas\ModelCrearSubTarea();
        $modelsubTarea->update($idSubTarea, ['estado' => $estado]);

        // Actualiza la Subtarea en la sesion

        $subtareas = $modelsubTarea->where('idTareaPrincipal', session()->get('idTareaSeleccionada'))->findAll();

        session()->set('subtareas', $subtareas);

        // Actualiza el estado de la tarea principal si esta Definida
        if ($estado == 'Finalizada') {
            $modelTarea = new \App\Models\Tecnicas\ModelCrearTarea();

            $tarea = $modelTarea->find(session()->get('idTareaSeleccionada'));
            if ($tarea && $tarea['estado'] == 'Definida') {

                $modelTarea->update(session()->get('idTareaSeleccionada'), ['estado' => 'En proceso']);

                // Actualiza la sesion
                $tareaActualizada = $modelTarea->find(session()->get('idTareaSeleccionada'));
                $sesion->set('tareaSeleccionada', $tareaActualizada);
            }
        }

        return redirect()->to(base_url('/Principal'));
    }




    public function archivarTarea()
    {

        $sesion = session();

        // Carga todas las tareas del usuario //

        $idUsuario = $sesion->get('usuario_id');

        $model = new \App\Models\Tecnicas\ModelCrearTarea();
        $tareas = $model->where('id_usuario', $idUsuario)->orderBy('fechaVencimiento', 'DESC')->findAll();

        return view('Tecnicas/Tareas/TareasArchivadas', ['tareas' => $tareas]);
    }




    public function eliminarTarea()
    {

        // elimina la tarea
        $model = new \App\Models\Tecnicas\ModelCrearTarea();
        $model->delete(session()->get('idTareaSeleccionada'));

        // elimina las subTareas asociadas
        $modelSub = new \App\Models\Tecnicas\ModelCrearSubTarea();
        $modelSub->where('idTareaPrincipal', session()->get('idTareaSeleccionada'))->delete();

        // elimina los registros de la tabla compartidas
        $modelCompartida = new \App\Models\Tecnicas\ModelCompartidos();
        $modelCompartida->where('idTareaCompartida', session()->get('idTareaSeleccionada'))->delete();

        session()->remove(['idTareaSeleccionada', 'tareaSeleccionada', 'subtareas']);

        return redirect()->to('/Principal');
    }




    public function eliminarSubTarea()
    {

        $idEliminar = $this->request->getPost('eliminarSubTarea');

        $model = new \App\Models\Tecnicas\ModelCrearSubTarea();
        $model->delete($idEliminar);

        // Obtener subtareas de la tarea principal

        $idTarea = session()->get('idTareaSeleccionada');
        $subtareas = $model->where('idTareaPrincipal', $idTarea)->findAll();

        session()->set('subtareas', $subtareas);

        return redirect()->to('/Principal');
    }

    public function editarTarea()
    {

        $validacion = service('validation');
        $validacion->setRules(
            [
                'nombreTarea'      => 'required|min_length[4]|regex_match[/^[\p{L}0-9\s.,!¡¿?()@#%&*\-_:;"]+$/u]',
                'descripcionTarea' => 'required|min_length[5]|regex_match[/^[\p{L}0-9\s.,!¡¿?()@#%&*\-_:;"]+$/u]',
                'prioridadTarea'   => 'required|in_list[alta,media,baja]'
            ],

            [
                'nombreTarea' => [
                    'required'            => 'Campo Requerido',
                    'min_length'          => 'Cuatro caracteres mínimos',
                ],

                'descripcionTarea' => [
                    'required'            => 'Campo Requerido',
                    'min_length'          => 'Cinco caracteres mínimos',
                ],

                'fechaVencimiento' => ['required' => 'Campo Requerido'],

                'fechaRecordatorio' => ['required' => 'Campo Requerido'],

                'prioridadTarea' => [
                    'required' => 'Seleccionar una prioridad',
                    'in_list'  => 'Selecciona una prioridad válida'
                ],

            ]
        );

        if (!$validacion->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validacion->getErrors());
        }


        $fechaVencimiento = $this->request->getPost('fechaVencimiento');
        $fechaRecordatorio = $this->request->getPost('fechaRecordatorio');

        $sesion = session();

        $datosTarea = array(
            'tema' => $this->request->getPost('nombreTarea'),
            'descripcion' => $this->request->getPost('descripcionTarea'),
            'prioridad' => $this->request->getPost('prioridadTarea'),
            // 'id_usuario' => $sesion->get('usuario_id'),
        );


        if (!empty($fechaVencimiento)) {
            $fechaVencimientoTime = Time::parse($fechaVencimiento, 'America/Argentina/Buenos_Aires');
            $fechaActual = Time::today('America/Argentina/Buenos_Aires');

            if ($fechaVencimientoTime->isBefore($fechaActual)) {
                return redirect()->back()->withInput()->with('errors', ['fechaVencimiento' => 'La fecha de vencimiento no puede ser anterior a hoy.']);
            }

            $fechaRecordatorioFormateada = $fechaVencimientoTime->toLocalizedString('d/M/Y');
            $datosTarea['fechaVencimiento'] = $fechaRecordatorioFormateada;
        }

        if (!empty($fechaRecordatorio)) {
            $fechaRecordatorioTime = Time::parse($fechaRecordatorio, 'America/Argentina/Buenos_Aires');
            $fechaActual = Time::today('America/Argentina/Buenos_Aires');

            if ($fechaRecordatorioTime->isBefore($fechaActual)) {
                return redirect()->back()->withInput()->with('errors', ['fechaRecordatorio' => 'La fecha de recordatorio no puede ser anterior a hoy.']);
            }
            $fechaRecordatorioFormateada = $fechaRecordatorioTime->toLocalizedString('d/M/Y');
            $datosTarea['fechaRecordatorio'] = $fechaRecordatorioFormateada;
        }

        $model = new \App\Models\Tecnicas\ModelCrearTarea();
        $model->update($sesion->get('idTareaSeleccionada'), $datosTarea);


        // Actualiza la tarea en la sesion
        $tareaseleccionada = $model->find($sesion->get('idTareaSeleccionada'));

        session()->set('tareaSeleccionada', $tareaseleccionada);


        return redirect()->to(base_url('/Principal'));
    }





    public function editarSubTarea()
    {

        $sesion = session();
        $validacion = service('validation');
        $validacion->setRules(
            [
                'nombreSubTarea'      => 'required|min_length[4]|regex_match[/^[\p{L}0-9\s.,!¡¿?()@#%&*\-_:;"]+$/u]',
                'descripcionSubTarea' => 'required|min_length[5]|regex_match[/^[\p{L}0-9\s.,!¡¿?()@#%&*\-_:;"]+$/u]'
            ],

            [
                'nombreSubTarea' => [
                    'required'            => 'Campo Requerido',
                    'min_length'          => 'Cuatro caracteres mínimos',
                ],

                'descripcionSubTarea' => [
                    'required'            => 'Campo Requerido',
                    'min_length'          => 'Cinco caracteres mínimos',
                ],

            ]
        );

        if (!$validacion->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validacion->getErrors());
        }

        $fechaRecordatorioFormateada = '';
        $fechaVencimientoFormateada = '';

        if (!empty($this->request->getPost('fechaVencimientoSubTarea'))) {

            $fechaVencimiento  = $this->request->getPost('fechaVencimientoSubTarea');
            $fechaVencimientoTime = Time::parse($fechaVencimiento, 'America/Argentina/Buenos_Aires');
            $fechaActual = Time::today('America/Argentina/Buenos_Aires');

            if ($fechaVencimientoTime->isBefore($fechaActual)) {
                return redirect()->back()->withInput()->with('errors', ['fechaVencimientoSubTarea' => 'La fecha de vencimiento no puede ser anterior a hoy.']);
            }

            $fechaVencimientoFormateada = $fechaVencimientoTime->toLocalizedString('d/M/Y');
        }

        if (!empty($this->request->getPost('fechaRecordatorioSubTarea'))) {

            $fechaRecordatorio = $this->request->getPost('fechaRecordatorioSubTarea');
            $fechaRecordatorioTime = Time::parse($fechaRecordatorio, 'America/Argentina/Buenos_Aires');
            $fechaActual = Time::today('America/Argentina/Buenos_Aires');

            if ($fechaRecordatorioTime->isBefore($fechaActual)) {
                return redirect()->back()->withInput()->with('errors', ['fechaRecordatorioSubTarea' =>  'La fecha de recordatorio no puede ser anterior a hoy']);
            }

            $fechaRecordatorioFormateada = $fechaRecordatorioTime->toLocalizedString('d/M/Y');
        }


        $datosSubTarea = array(
            'tema'              => $this->request->getPost('nombreSubTarea'),
            'descripcion'       => $this->request->getPost('descripcionSubTarea'),
            'prioridad'         => $this->request->getPost('prioridadTareaSubTarea'),
            'fechaVencimiento'  => $fechaVencimientoFormateada,
            'fechaRecordatorio' => $fechaRecordatorioFormateada,
            'idTareaPrincipal'  => $sesion->get('idTareaSeleccionada'),
            // 'responsable'       => $sesion->get('usuario_id')
        );

        $idSubTarea = $this->request->getPost('idSubTarea');

        $modelSub = new \App\Models\Tecnicas\ModelCrearSubTarea();
        $modelSub->update($idSubTarea, $datosSubTarea);


        // Actualiza las subtareas para traer todas de nuevo
        $modelSub = new \App\Models\Tecnicas\ModelCrearSubTarea();
        $subtareas = $modelSub->where('idTareaPrincipal', $sesion->get('idTareaSeleccionada'))->findAll();

        session()->set('subtareas', $subtareas);

        return redirect()->to(base_url('/Principal'));
    }




    public function guardarColores()
    {

        $sesion = session();
        $idUsuario = $sesion->get('usuario_id');

        $modelo = new \App\Models\Tecnicas\ModelColorPrioridad();

        $datosColores = array(
            'colorAlta'  => $this->request->getPost('alta'),
            'colorMedia' => $this->request->getPost('media'),
            'colorBaja'   => $this->request->getPost('baja'),
            'id_usuario' => $idUsuario,
        );


        $existe = $modelo->where('id_usuario', $idUsuario)->first();

        if ($existe) {
            $modelo->update($idUsuario, $datosColores);
        } else {
            $modelo->insert($datosColores);
        }

        return redirect()->to(base_url('/Principal'));
    }


    public function crearAnotacion()
    {

        $validacion = service('validation');
        $validacion->setRules(
            ['anotacionTarea' => 'required|min_length[5]'],

            [
                'anotacionTarea' => [
                    'required'   => 'Campo Requerido',
                    'min_length' => 'Cinco caracteres mínimos',
                ]

            ]
        );

        if (!$validacion->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validacion->getErrors());
        }

        $sesion = session();
        $idUsuario = $sesion->get('usuario_id');
        $idTarea = $sesion->get('idTareaSeleccionada');
        $anotacionTexto = $this->request->getPost('anotacionTarea');

        $modelo = new \App\Models\Tecnicas\ModelAnotacion();

        $anotaciones = array(
            'id_usuario' => $idUsuario,
            'id_tarea'   => $idTarea,
            'mensaje'  => $anotacionTexto,
        );

        $modelo->insert($anotaciones);

        $todasAnotaciones = $modelo->where('id_usuario', $idUsuario)
            ->where('id_tarea', $idTarea)
            ->orderBy('id', 'DESC')
            ->findAll();


        session()->set('anotaciones', $todasAnotaciones);

        return redirect()->to(base_url('/Principal'));
    }



    public function perfilUsuario()
    {
        return view('Tecnicas/Usuario/PerfilUsuario');
    }




    public function CambioDatosUsuario()
    {

        $sesion = session();

        $correoverif = $sesion->get('usuario_correo');

        $reglas = [
            'nombreRegistro'      => 'required|min_length[3]|alpha_space',
            'apellidoRegistro'    => 'required|min_length[3]|alpha_space',
            'correoRegistro'      => 'required|valid_email',
            'passwordEditar'      => 'permit_empty|min_length[4]',
            'passwordEditarRep'   => 'permit_empty|matches[passwordEditar]'
        ];


        if ($this->request->getPost('correoRegistro') !== $correoverif) {
            $reglas['correoRegistro'] .= '|is_unique[usuarios.correo]';
        }

        $mensajeEditar =
            [
                'nombreRegistro' => [
                    'required'   => 'Campo requerido',
                    'min_length' => 'Tres caracteres mínimos',
                    'alpha_space' => 'Sin números'
                ],

                'apellidoRegistro' => [
                    'required'   => 'Campo requerido',
                    'min_length' => 'Tres caracteres mínimos',
                    'alpha_space' => 'Sin números'
                ],

                'correoRegistro' => [
                    'required'   => 'Campo requerido',
                    'valid_email' => 'No es un Correo',
                    'is_unique'  => 'El correo ya está registrado'
                ],

                'passwordEditar' => ['min_length' => 'Cuatro caracteres mínimos'],

                'passwordEditarRep' => ['matches' => 'La contraseña no coincide']
            ];

        $validacion = service('validation');
        $validacion->setRules($reglas, $mensajeEditar);

        if (!$validacion->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validacion->getErrors());
        }

        $session = session();
        $idUsuario = $session->get('usuario_id');

        $datos = array(
            'nombre' => $this->request->getPost('nombreRegistro'),
            'apellido' => $this->request->getPost('apellidoRegistro'),
            'correo' => $this->request->getPost('correoRegistro'),
        );

        if (!empty($this->request->getPost('passwordEditar'))) {
            $datos['contraseña'] = password_hash($this->request->getPost('passwordEditar'), PASSWORD_DEFAULT);
        }


        $model = new \App\Models\Tecnicas\ModelsCrearUsuario();
        $model->update($idUsuario, $datos);

        $session->set('usuario_nombre', $datos['nombre']);
        $session->set('usuario_apellido', $datos['apellido']);
        $session->set('usuario_correo', $datos['correo']);

        return view('Tecnicas/Usuario/PerfilUsuario');
    }

    public function seleccionarOrden()
    {

        $orden = $this->request->getPost('prioridadTarea');

        session()->set('ordenTareas', $orden);

        return redirect()->to(base_url('/Principal'));
    }




    public function compartirTarea()
    {

        $validacion = service('validation');
        $validacion->setRules(
            [
                'tituloMensaje'    => 'required|min_length[4]',
                'correoCompartido' => 'required|valid_email'
            ],

            [
                'tituloMensaje' => [
                    'required'   => 'Campo Requerido',
                    'min_length' => 'Cuatro caracteres mínimos',
                ],

                'correoCompartido' => [
                    'required'    => 'Campo Requerido',
                    'valid_email' => 'No es un correo',
                ]
            ]
        );

        if (!$validacion->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validacion->getErrors());
        }

        $titulo = $this->request->getPost('tituloMensaje');
        $correoInvitado = $this->request->getPost('correoCompartido');

        // ID del usuario que comparte y de la tarea seleccionada
        $sesion = session();
        $idUsuarioEnvia = $sesion->get('usuario_id');
        $idTarea = $sesion->get('idTareaSeleccionada');

        // ID del usuario invitado segun el correo
        $usuarioModel = new \App\Models\Tecnicas\ModelsCrearUsuario();
        $usuarioInvitado = $usuarioModel->where('correo', $correoInvitado)->first();

        if (!$usuarioInvitado) {
            return redirect()->back()->withInput()->with('errors', 'No se encontró ningún usuario con ese correo.');
        }

        $idUsuarioRecibe = $usuarioInvitado['id'];

        // Insertar en tabla 
        $modeloCompartidas = new \App\Models\Tecnicas\ModelCompartidos();
        $modeloCompartidas->insert([
            'idTareaCompartida' => $idTarea,
            'idUsuarioEnvio'    => $idUsuarioEnvia,
            'idUsuarioInvitado' => $idUsuarioRecibe,
        ]);


        $email = service('email');

        $email->setFrom('testverydeli@gmail.com', 'Invitación.');
        $email->setTo($correoInvitado);
        $email->setSubject($titulo);
        $email->setMailType('html');

        $nombreUsuario = session()->get('usuario_nombre');
        $apellidoUsuario = session()->get('usuario_apellido');

        $mensaje = '
    <p>Has sido invitado por <strong>' . $nombreUsuario . ' ' . $apellidoUsuario . '</strong> para colaborar en una tarea.</p>
    <p><a href="' . base_url('/Compartidos') . '" style="display: inline-block; padding: 10px 15px; background-color:rgb(7, 99, 155); color: white; text-decoration: none; border-radius: 5px;">Ver Tarea</a></p>';

        $email->setMessage($mensaje);


        if (!$email->send()) {
            log_message('error', $email->printDebugger(['headers']));
            return redirect()->to(base_url('/Principal'))->with('errors', 'La tarea fue compartida, pero no se pudo enviar el correo.');
        }

        return redirect()->to(base_url('/Principal'));
    }

    public function tareasCompartidas()
    {

        $idUsuario = session()->get('usuario_id');

        $modeloCompartidos  = new \App\Models\Tecnicas\ModelCompartidos();
        $modeloTareas = new \App\Models\Tecnicas\ModelCrearTarea();
        $modeloUsuarios = new \App\Models\Tecnicas\ModelsCrearUsuario();

        // Solo tareas que fueron compartidas a este usuario
        $tareasCompartidas  = $modeloCompartidos->where('idUsuarioInvitado', $idUsuario)->findAll();

        foreach ($tareasCompartidas as $compartido) {
            $tarea = $modeloTareas->find($compartido['idTareaCompartida']);
            $usuario = $modeloUsuarios->find($compartido['idUsuarioEnvio']);

            $datosTareas[] = [
                'idcompartido'      => $compartido['idCompartido'],
                'idTareaCompartida' => $compartido['idTareaCompartida'],
                'estado'            => $compartido['estado'],
                'titulo'            => $tarea['tema'] ?? 'Sin título',
                'fechaVencimiento'  => $tarea['fechaVencimiento'] ?? 'Sin fecha',
                'nombreUsuario'     => $usuario['nombre'] ?? 'Desconocido',
            ];
        }

        return view('Tecnicas/Tareas/TareasCompartidas', ['tareasCompartidas' => $datosTareas ?? '']);
    }


    public function aceptarTarea()
    {
        $id = $this->request->getPost('id');
        $modelo = new \App\Models\Tecnicas\ModelCompartidos();

        $tarea = $modelo->find($id);

        $modelo->update($id, ['estado' => 'Aceptada']);


        return redirect()->to(base_url('/Compartidos'));
    }




    public function rechazarTarea()
    {
        $id = $this->request->getPost('id');
        $modelo = new \App\Models\Tecnicas\ModelCompartidos();

        $tarea = $modelo->find($id);

        $modelo->update($id, ['estado' => 'Rechazada']);

        return redirect()->to(base_url('/Compartidos'));
    }





    public function cerrarSesion()
    {

        $sesion = session();
        $sesion->destroy();

        return redirect()->to(base_url('/Login'));
    }
}





