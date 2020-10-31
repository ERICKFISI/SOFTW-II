<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Modificar Usuario</h3>
        </div>
    </div>
    <div class="col-md-3-6 ">
        <div class="x_panel">

            <div class="x_content">
                <br />
                <?= form_open('visualizarusuario/update/' . $usuarios['idusuario'], 'class="form-horizontal form-label-left h6" '); ?>
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Nombre Usuario
                    </label>
                    <div class="col-md-9 col-sm-9 ">
                        <?= form_input(['type' => 'text', 'class' => 'form-control', 'value' => $usuarios['nombreusuario'], 'name' => 'nombreusuario', 'required']); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 ">Contraseña</label>
                    <div class="col-md-9 col-sm-9 ">
                        <?= form_input(['type' => 'password', 'class' => 'form-control', 'value' => $usuarios['contrasena'], 'name' => 'contrasena', 'required']); ?>
                    </div>
                </div>

                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Nombre </label>
                    <div class="col-md-9 col-sm-9 ">
                        <?= form_input(['type' => 'text', 'class' => 'form-control', 'value' => $usuarios['nombre'], 'name' => 'nombre', 'id' => 'nombre', 'required']); ?>
                    </div>
                </div>

                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">DNI </label>
                    <div class="col-md-9 col-sm-9 ">
                        <?= form_input(['type' => 'text', 'class' => 'form-control', 'value' => $usuarios['dni'], 'name' => 'dni', 'id' => 'dni', 'minlength' => '8', 'maxlength' => '8', 'required']); ?>
                    </div>
                </div>

                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Telefono</label>
                    <div class="col-md-9 col-sm-9 ">
                        <?= form_input(['type' => 'text', 'class' => 'form-control', 'value' => $usuarios['telefono'], 'name' => 'telefono', 'minlength' => '9', 'maxlength' => '9', 'id' => 'telefono', 'required']); ?>
                    </div>
                </div>

                <br>

                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 ">Perfil</label>
                    <div class="col-md-9 col-sm-9 ">
                            <select class="form-control" name="idperfil" id="idperfil" required>

                                <?php
                                foreach ($perfiles as $perfil) {
                                    $nombreperfil = $perfil['nombre'];
                                    $idperfil = $perfil['idperfil'];
                                    if( $idperfil == $usuarios[ 'idperfil' ] )
                                    { ?>
                                    <option selected="selected" value="<?php echo $idperfil ?>"> <?php echo $nombreperfil ?> 
                                    </option>
                            <?php   }
                                    else
                                    { ?>
                                    <option value="<?php echo $idperfil ?>"> <?php echo $nombreperfil ?> 
                                    </option>
                            <?php   }} ?>

                            </select>
                    </div>
                </div>




                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-9 col-sm-9  offset-md-3">
                        <button type="submit" class="btn btn-success" onclick=" return alerta();">Guardar</button>
                        <a href="<?= base_url() . "/visualizarusuario"; ?>" class="btn btn-primary">Cancelar</a>
                    </div>
                </div>

                </form>
            </div>
        </div> 
    </div> 



</div>
</div>
<!-- /page content -->

<!-- footer content -->
<footer>
    <div class="pull-right">
        Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src= "<?= base_url() . "/public/vendors/validator/multifield.js" ?>"></script>
<script src= "<?= base_url() . "/public/vendors/validator/validator.js" ?>"></script>

<!-- Javascript functions	-->
<script>
                            function hideshow() {
                                var password = document.getElementById("password1");
                                var slash = document.getElementById("slash");
                                var eye = document.getElementById("eye");

                                if (password.type === 'password') {
                                    password.type = "text";
                                    slash.style.display = "block";
                                    eye.style.display = "none";
                                }
                                else {
                                    password.type = "password";
                                    slash.style.display = "none";
                                    eye.style.display = "block";
                                }

                            }
</script>
<script type="text/javascript">
    let telefono = document.getElementById( 'telefono' );
    telefono.addEventListener( 'input', function()
        {
            if( this.value < 0 )
            {
                this.value = null;
            }
            else if( !Number.isInteger( this.value ) )
            {
                this.value = parseInt(this.value);
                if( this.value == "NaN" )
                {
                    this.value = "";
                }
            }
            else if( isNaN( this.value ) )
            {
                this.value = "";
            }
            else if( this.value == "NaN" )
            {
                this.value = "";
            } 
        } );
    let dni = document.getElementById( 'dni' );
    dni.addEventListener( 'input', function()
        {
            if( this.value < 0 )
            {
                this.value = null;
            } 
            else if( !Number.isInteger( this.value ) )
            {
                this.value = parseInt(this.value);
                if( this.value == "NaN" )
                {
                    this.value = "";
                }
            }
            else if( isNaN( this.value ) )
            {
                this.value = "";
            }
            else if( this.value == "NaN" )
            {
                this.value = "";
            } 
        } );
</script>
<script type="text/javascript">
    function alerta()
    {
        var m = confirm("¿Está seguro que desea modificar este usuario?");
        if (m)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
</script>
