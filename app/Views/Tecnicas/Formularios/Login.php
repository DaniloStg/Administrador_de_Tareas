<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= view('Tecnicas/Enlaces/Enlaces'); ?>

    <title>Inicio de sesión</title>
</head>
<body>
    
<div class="row d-none d-md-flex" id="logindesktop">

    <div class="col-md-5" id="divprincipal1">
        <div id="divsecun1">
            <h4 id="logo">Taskión</h4><br><br>
            <h6 id="slogan">Organiza tu día, domina tu tiempo.</h6>
        </div>
    </div>

    <div class="col-md-7 " id="divprincipal2">

                <!-- Formulario de Login -->
        <div id="loginform">
            <?php
        
                echo form_open('form/loginUsuario', ['id'=>'formLogin']);

                echo '<h3 id="h3Sesion">Iniciar sesión</h3> <br><br>';

                echo form_label('Correo','correoLogin', ['class' => 'form-label', 'id'=>'labelform']).'<br>';
                echo form_input(array('name'        => 'correoLogin',
                                      'class'       => 'rounded inputLogin ',
                                      'placeholder' => '  Correo',
                                      'value'       => old('correoLogin') ));
            ?>

            <?php if (session('errors.correoLogin')){   ?>
                <div style="height: 20px; color: red; font-size: small;"><?= session('errors.correoLogin') ?></div>
            <?php } ?>
            

            <?php
                echo '<br>'.form_label('Contraseña','passwordLogin', ['class' => 'form-label', 'id'=>'labelform']).'<br>';
                echo form_input(array('name'        => 'passwordLogin',
                                      'type'        => 'password',
                                      'class'       => 'rounded inputLogin',
                                      'placeholder' => '  Contraseña',
                                      'value'       => old('passwordLogin')));
            ?>

            <?php if (session('errors.passwordLogin')){   ?>
                <div  style="height: 20px; color: red; font-size: small;"><?= session('errors.passwordLogin') ?></div>
            <?php } ?>

            <?php
                echo '<br><span id="spanCuenta"><strong>¿No tienes una cuenta?  </strong></span>';
                echo '<a href="#" onclick="mostrarRegistro()" id="BtnRegistrarse">Registrarse</a><br><br><br>';                                            
                
                echo form_submit('enviar','Ingresar', 
                                ['id'   =>'btnenviar',
                                 'class'=>'fs-5 rounded']).'<br>';

                echo form_close();
            ?>

        </div>

                 <!-- Formulario de Registro -->
        <div id="registroForm" style="display: none;">
            <?php
                echo form_open('form/crearUsuario', ['id'=>'formRegistro']);

                echo '<h3 id="h3Crear">Crear Usuario</h3> <br>';

                echo form_label('Nombre', 'nombreRegistro', ['class' => 'form-label', 'id'=>'labelform']).'<br>';
                echo form_input(array('name'        =>'nombreRegistro',
                                      'class'       => 'rounded inputLogin',
                                      'placeholder' => '  Nombre',
                                      'value'       => old('nombreRegistro'))).'<br>';
             ?>

            <?php if (session('errors.nombreRegistro')){   ?>
                <div style="height: 20px; color: red; font-size: small;"><?= session('errors.nombreRegistro') ?></div>
            <?php } ?>

            <?php
                echo form_label('Apellido', 'apellidoRegistro', ['class' => 'form-label', 'id'=>'labelform']).'<br>';
                echo form_input(array('name'        =>'apellidoRegistro',
                                      'class'       => 'rounded inputLogin',
                                      'placeholder' => '  Apellido',
                                      'value'       => old('apellidoRegistro'))).'<br>';
             ?>

            <?php if (session('errors.apellidoRegistro')){   ?>
                <div style="height: 20px; color: red; font-size: small;"><?= session('errors.apellidoRegistro') ?></div>
            <?php } ?>

            <?php
                echo form_label('Correo','correoRegistro', ['class' => 'form-label', 'id'=>'labelform']).'<br>';
                echo form_input(array('name'        => 'correoRegistro',
                                      'class'       => 'rounded inputLogin',
                                      'placeholder' => '  Correo',
                                      'value'       => old('correoRegistro'))).'<br>';
             ?>

            <?php if (session('errors.correoRegistro')){   ?>
                <div style="height: 20px; color: red; font-size: small;"><?= session('errors.correoRegistro') ?></div>
            <?php } ?>

            <?php
                echo form_label('Contraseña','passwordRegistro', ['class' => 'form-label', 'id'=>'labelform']).'<br>';
                echo form_input(array('name'        =>'passwordRegistro', 
                                      'type'        => 'password',
                                      'class'       => 'rounded inputLogin',
                                      'placeholder' => '  Contraseña',
                                      'value'       => old('passwordRegistro'))).'<br>';
             ?>

            <?php if (session('errors.passwordRegistro')){   ?>
                <div style="height: 20px; color: red; font-size: small;"><?= session('errors.passwordRegistro') ?></div>
            <?php } ?>

            <?php
                echo form_label('Repita contraseña','passwordRegistroRep', ['class' => 'form-label', 'id'=>'labelform']).'<br>';
                echo form_input(array('name'        =>'passwordRegistroRep',
                                      'type'        => 'password',
                                      'class'       => 'rounded inputLogin',
                                      'placeholder' => '  Repita la contraseña')).'<br>';
             ?>

            <?php if (session('errors.passwordRegistroRep')){   ?>
                <div style="height: 20px; color: red; font-size: small;"><?= session('errors.passwordRegistroRep') ?></div>
            <?php } ?>

            <?php
                echo '<span id="spanCuenta"><strong>¿Ya tienes cuenta?  </span></strong>';
                echo '<a href="#" onclick="mostrarLogin()" id="BtnRegistrarse">Iniciar sesión</a><br><br>';

                echo form_submit('enviar','Crear', ['id'=>'btnenviar',
                                                    'class'=>'fs-5 rounded']).'<br>';

                echo form_close();
            ?>
        </div>
        
    </div>

</div>

<script>
    function mostrarRegistro() {
        document.getElementById('loginform').style.display = 'none';
        document.getElementById('registroForm').style.display = 'flex';
    }

    function mostrarLogin() {
        document.getElementById('registroForm').style.display = 'none';
        document.getElementById('loginform').style.display = 'flex';
    }
</script>


<!-- login mobile -->

<div class="row d-block- d-md-none" id="loginMovile">
<div class="col-sm-12" id="divprincipal1">
        <div id="divsecun1mob">
            <h4 id="logo">Taskión</h4><br><br>
            <h6 id="slogan">Organiza tu día, domina tu tiempo.</h6>
        </div>
    </div>

    <div class="col-sm-12" id="divprincipal2mob">

                <!-- Formulario de Login -->
        <div id="loginformMob">
            <?php
        
                echo form_open('form/loginUsuario', ['id'=>'formLogin']);

                echo '<h3 id="h3Sesion">Iniciar sesión</h3> <br>';

                echo form_label('Correo','correoLogin', ['class' => 'form-label', 'id'=>'labelform']).'<br>';
                echo form_input(array('name'        => 'correoLogin',
                                      'class'       => 'rounded inputLogin',
                                      'placeholder' => '  Correo',
                                      'value'       => old('correoLogin'))).'<br>';
            ?>

            <?php if (session('errors.correoLogin')){   ?>
                <div style="height: 20px; color: red; font-size: small;"><?= session('errors.correoLogin') ?></div>
            <?php } ?>

            <?php
                echo form_label('Contraseña','passwordLogin', ['class' => 'form-label', 'id'=>'labelform']).'<br>';
                echo form_input(array('name'        => 'passwordLogin',
                                      'type'        => 'password',
                                      'class'       => 'rounded inputLogin',
                                      'placeholder' => '  Contraseña',
                                      'value'       => old('passwordLogin')));
            ?>

            <?php if (session('errors.passwordLogin')){   ?>
                <div style="height: 20px; color: red; font-size: small;"><?= session('errors.passwordLogin') ?></div>
            <?php } ?>

            <?php   

                echo '<br><span id="spanCuenta"><strong>¿No tienes una cuenta?  </strong></span>';
                echo '<a href="#" onclick="mostrarRegistroMob()" id="BtnRegistrarse">Registrarse</a><br><br><br>';                                            

                echo form_submit('enviar','Ingresar', ['id'=>'btnenviar',
                                                       'class'=>'fs-5 rounded']).'<br>';

                echo form_close();
            ?>

        </div>

                 <!-- Formulario de Registro -->
        <div id="registroFormMob" style="display: none;">
            <?php
                echo form_open('form/crearUsuario', ['id'=>'formRegistro']);

                echo '<h3 id="h3Crear">Crear de Usuario</h3> <br>';

                echo form_label('Nombre', 'nombreRegistro', ['class' => 'form-label', 'id'=>'labelform']).'<br>';
                echo form_input(array('name'        => 'nombreRegistro',
                                      'class'       => 'rounded inputLogin',
                                      'placeholder' => '  Nombre',
                                      'value'       => old('nombreRegistro'))).'<br>';
             ?>

            <?php if (session('errors.nombreRegistro')){   ?>
                <div style="height: 20px; color: red; font-size: small;"><?= session('errors.nombreRegistro') ?></div>
            <?php } ?>

            <?php
                echo form_label('Apellido', 'apellidoRegistro', ['class' => 'form-label', 'id'=>'labelform']).'<br>';
                echo form_input(array('name'        => 'apellidoRegistro',
                                      'class'       => 'rounded inputLogin',
                                      'placeholder' => '  Apellido',
                                      'value'       => old('apellidoRegistro'))).'<br>';
            ?>

            <?php if (session('errors.apellidoRegistro')){   ?>
                <div style="height: 20px; color: red; font-size: small;"><?= session('errors.apellidoRegistro') ?></div>
            <?php } ?>

            <?php
                echo form_label('Correo','correoRegistro', ['class' => 'form-label', 'id'=>'labelform']).'<br>';
                echo form_input(array('name'        => 'correoRegistro',
                                      'class'       => 'rounded inputLogin',
                                      'placeholder' => '  Correo',
                                      'value'       => old('correoRegistro'))).'<br>';
             ?>

            <?php if (session('errors.correoRegistro')){   ?>
                <div style="height: 20px; color: red; font-size: small;"><?= session('errors.correoRegistro') ?></div>
            <?php } ?>

            <?php
                echo form_label('Contraseña','passwordRegistro', ['class' => 'form-label', 'id'=>'labelform']).'<br>';
                echo form_input(array('name'        => 'passwordRegistro',
                                      'type'        => 'password',
                                      'class'       => 'rounded inputLogin',
                                      'placeholder' => '  Contraseña',
                                      'value'       => old('passwordRegistro'))).'<br>';
            ?>

            <?php if (session('errors.passwordRegistro')){   ?>
                <div style="height: 20px; color: red; font-size: small;"><?= session('errors.passwordRegistro') ?></div>
            <?php } ?>

            <?php
                echo form_label('Repita la contraseña','passwordRegistroRep', ['class' => 'form-label', 'id'=>'labelform']).'<br>';
                echo form_input(array('name'        => 'passwordRegistroRep',
                                      'type'        => 'password',
                                      'class'       => 'rounded inputLogin',
                                      'placeholder' => '  Contraseña'));
             ?>

            <?php if (session('errors.passwordRegistroRep')){   ?>
                <div style="height: 20px; color: red; font-size: small;"><?= session('errors.passwordRegistroRep') ?></div>
            <?php } ?>

            <?php
                echo '<br><span id="spanCuenta"><strong>¿Ya tienes cuenta?  </span></strong>';
                echo '<a href="#" onclick="mostrarLoginMob()" id="BtnRegistrarse">Iniciar sesión</a><br><br>';

                echo form_submit('enviar','Crear', ['id'=>'btnenviar',
                                                   'class'=>'fs-5 rounded']).'<br>';

                echo form_close();
            ?>
        </div>

    </div>

</div>

<script src="<?= base_url('JavaScript/Script.js') ?>"></script>

<script>

    // muestra registro en caso de errores
    window.addEventListener('DOMContentLoaded', function () {
        <?php if (session('errors.nombreRegistro') || session('errors.apellidoRegistro') || session('errors.correoRegistro') || session('errors.passwordRegistro') || session('errors.passwordRegistroRep')) { ?>
            mostrarRegistro();
            document.getElementById('loginform').style.height = '95vh';
            document.getElementById('registroForm').style.height = '95vh';
            document.getElementById('divsecun1').style.height = '95vh';

        <?php } ?>
        
        <?php if (session('errors.nombreRegistro') || session('errors.apellidoRegistro') || session('errors.correoRegistro') || session('errors.passwordRegistro') || session('errors.passwordRegistroRep')) { ?>
            mostrarRegistroMob();
        <?php } ?>
    });


</script>

</body>
</html>