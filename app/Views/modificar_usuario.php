<div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <nav class="nav navbar-nav">

                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <!-- page content -->
               
                <div class="right_col" role="main">
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
                                    <?= form_open('visualizarusuario/update/'.$usuarios['idusuario'], 'class="form-horizontal form-label-left h6" ' ); ?>
                                        <div class="form-group row ">
                                            <label class="control-label col-md-3 col-sm-3 ">Nombre Usuario
                                            </label>
                                            <div class="col-md-9 col-sm-9 ">
                                                <?= form_input( ['type' => 'text', 'class' => 'form-control','value' => $usuarios['nombreusuario'] ,'name' => 'nombreusuario','required'] ); ?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="control-label col-md-3 col-sm-3 ">Contraseña</label>
                                            <div class="col-md-9 col-sm-9 ">
                                                <?= form_input( ['type' => 'password', 'class' => 'form-control', 'value' => $usuarios['contrasena'] ,'name' => 'contrasena','required'] ); ?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row ">
                                            <label class="control-label col-md-3 col-sm-3 ">Nombre </label>
                                            <div class="col-md-9 col-sm-9 ">
                                                <?= form_input( ['type' => 'text', 'class' => 'form-control','value' => $usuarios['nombre'] , 'name' => 'nombre', 'id'=> 'nombre' ,'required'] ); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row ">
                                            <label class="control-label col-md-3 col-sm-3 ">DNI </label>
                                            <div class="col-md-9 col-sm-9 ">
                                                <?= form_input( ['type' => 'text', 'class' => 'form-control','value' => $usuarios['dni'] ,'name' => 'dni', 'id' => 'dni' ,'required'] ); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row ">
                                            <label class="control-label col-md-3 col-sm-3 ">Telefono</label>
                                            <div class="col-md-9 col-sm-9 ">
                                                <?= form_input( ['type' => 'number', 'class' => 'form-control', 'value' => $usuarios['telefono'] , 'name' => 'telefono', 'id' => 'telefono','required'] ); ?>
                                            </div>
                                        </div>
                                        
                                        <br>

                                     <div class="form-group row">
                                        <label class="control-label col-md-3 col-sm-3 ">Perfil</label>
                                          <div class="col-md-9 col-sm-9 ">
                                            <?php 
                                            $datos1 = [ 
                                                'name' => 'idperfil',
                                                'class' => 'form-control',
                                                'id' => 'idperfil',
                                                'required'
                                             ];
                                             $c = 1;
                                            foreach ($perfiles as $perfil)
                                            {
                                                if ( $c == 1 ) 
                                                {
                                                    $datos2['x'] = [ $perfil['idperfil'] => $perfil['nombre'] ];
                                                    ++$c;
                                                }
                                                else
                                                {
                                                    $a = [ $perfil['idperfil'] => $perfil['nombre'] ];
                                                    $datos2['x'] = array_merge($datos2['x'],$a);
                                                }
                                                
                                            }
                                            echo form_dropdown( $datos1, $datos2['x'],$usuarios['idperfil'] ); ?>
                                                          
                                                <?php /*foreach ($perfiles as $perfil){   
                                                    $nombreperfil = $perfil['nombre'];
                                                    $idperfil = $perfil['idperfil']; ?>

                                                <option value="<?php echo $idperfil?>"> <?php echo $nombreperfil ?> 
                                                </option> <?php } */?>

                                            </select>
                                            </div>
                                        </div>

                                        
                                        

                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-9 col-sm-9  offset-md-3">
                                                <a href="<?= base_url()."/index.php/visualizarusuario";?>" class="btn btn-primary">Cancelar</a>
                                                <button type="submit" class="btn btn-success">Guardar</button>
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
    <script src= "<?= base_url()."/public/vendors/validator/multifield.js" ?>"></script>
    <script src= "<?= base_url()."/public/vendors/validator/validator.js" ?>"></script>
    
    <!-- Javascript functions	-->
	<script>
		function hideshow(){
			var password = document.getElementById("password1");
			var slash = document.getElementById("slash");
			var eye = document.getElementById("eye");
			
			if(password.type === 'password'){
				password.type = "text";
				slash.style.display = "block";
				eye.style.display = "none";
			}
			else{
				password.type = "password";
				slash.style.display = "none";
				eye.style.display = "block";
			}

		}
	</script>

    <script>
        // initialize a validator instance from the "FormValidator" constructor.
        // A "<form>" element is optionally passed as an argument, but is not a must
        var validator = new FormValidator({
            "events": ['blur', 'input', 'change']
        }, document.forms[0]);
        // on form "submit" event
        document.forms[0].onsubmit = function(e) {
            var submit = true,
                validatorResult = validator.checkAll(this);
            console.log(validatorResult);
            return !!validatorResult.valid;
        };
        // on form "reset" event
        document.forms[0].onreset = function(e) {
            validator.reset();
        };
        // stuff related ONLY for this demo page:
        $('.toggleValidationTooltips').change(function() {
            validator.settings.alerts = !this.checked;
            if (this.checked)
                $('form .alert').remove();
        }).prop('checked', false);

    </script>
