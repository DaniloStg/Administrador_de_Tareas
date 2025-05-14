<?php $sesion = session(); ?>

<div class="modal fade" id="cambiarDatosUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Información</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body modalTarea">
                        
                    <?php

                        echo form_open('form/CambioDatosUsuario', ['id'=>'CambiarDatos']);
                        
                        echo form_label('Nombre', 'nombreRegistro', ['class' => 'form-label', 'id'=>'labelform']).'<br>';
                        echo form_input(array('name'        => 'nombreRegistro',
                                              'class'       => 'rounded inputLogin',
                                              'placeholder' => '  Nombre',
                                              'value'       => old('nombreRegistro',  $sesion->get('usuario_nombre')))).'<br>';
                    ?>

                    <?php if (session('errors.nombreRegistro')){   ?>
                        <div style="height: 20px; color: red; font-size: small;"><?= session('errors.nombreRegistro') ?></div>
                    <?php } ?>

                    <?php
                        echo form_label('Apellido', 'apellidoRegistro', ['class' => 'form-label', 'id'=>'labelform']).'<br>';
                        echo form_input(array('name'        => 'apellidoRegistro',
                                              'class'       => 'rounded inputLogin',
                                              'placeholder' => '  Apellido',
                                              'value'       => old('apellidoRegistro',  $sesion->get('usuario_apellido')))).'<br>';
                    ?>

                    <?php if (session('errors.apellidoRegistro')){   ?>
                        <div style="height: 20px; color: red; font-size: small;"><?= session('errors.apellidoRegistro') ?></div>
                    <?php } ?>

                    <?php
                        echo form_label('Correo','correoRegistro', ['class' => 'form-label', 'id'=>'labelform']).'<br>';
                        echo form_input(array('name'        => 'correoRegistro',
                                              'class'       => 'rounded inputLogin',
                                              'placeholder' => '  Correo',
                                              'value'       => old('correoRegistro',  $sesion->get('usuario_correo')))).'<br>';
                    ?>

                    <?php if (session('errors.correoRegistro')){   ?>
                        <div style="height: 20px; color: red; font-size: small;"><?= session('errors.correoRegistro') ?></div>
                    <?php } ?>
                    
                    <?php
                          echo form_label('Contraseña','passwordEditar', ['class' => 'form-label', 'id'=>'labelform']).'<br>';
                          echo form_input(array('name'        => 'passwordEditar',
                                                'type'        => 'password',
                                                'class'       => 'rounded inputLogin',
                                                'placeholder' => '  Contraseña',
                                                'value'       => old('passwordEditar'))).'<br>';
                            ?>

                        <?php if (session('errors.passwordEditar')){   ?>
                            <div style="height: 20px; color: red; font-size: small;"><?= session('errors.passwordEditar') ?></div>
                        <?php } ?>

                        <?php
                            echo form_label('Repita la contraseña','passwordEditarRep', ['class' => 'form-label', 'id'=>'labelform']).'<br>';
                            echo form_input(array('name'        => 'passwordEditarRep',
                                                  'type'        => 'password',
                                                  'class'       => 'rounded inputLogin',
                                                  'placeholder' => '  Contraseña'));
                        ?>

                        <?php if (session('errors.passwordEditarRep')){   ?>
                            <div style="height: 20px; color: red; font-size: small;"><?= session('errors.passwordEditarRep') ?></div>
                        <?php } ?>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btnCancelar rounded" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btnEnviar rounded" onclick="document.getElementById('CambiarDatos').submit();">Editar</button>
                    </div>

                    <?php  echo form_close(); ?>

            </div>
        </div>
</div>

<script>
    window.addEventListener('DOMContentLoaded', function () {
        <?php if (session('errors.nombreRegistro') || session('errors.apellidoRegistro') || session('errors.correoRegistro') || session('errors.passwordEditar') || session('errors.passwordEditarRep')) { ?>
            var myModal = new bootstrap.Modal(document.getElementById('cambiarDatosUsuario'));
            myModal.show();
        <?php } ?>
    });
</script>
