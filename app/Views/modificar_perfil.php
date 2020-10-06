<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Modificar Perfil</h3>
        </div>
    </div>
    <div class="col-md-3-6 ">
        <div class="x_panel">

            <div class="x_content">
                <br />
                <?= form_open('visualizarperfil/update/' . $perfiles['idperfil'], 'class="form-horizontal form-label-left h6" '); ?>
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Nombre Perfil
                    </label>
                    <div class="col-md-9 col-sm-9 ">
                        <?= form_input(['type' => 'text', 'class' => 'form-control', 'value' => $perfiles['nombre'], 'name' => 'nombre', 'required']); ?>
                    </div>
                </div>
                <br>

                <?php foreach ($modulos as $modulo => $key){
                        if ( !empty($permisos [$modulo]['idmodulo']) ) {
                            if ( $key['idmodulo'] == $permisos[$modulo]['idmodulo'] && $permisos[$modulo]['idperfil'] == $perfiles['idperfil'] ) { ?>
                               <div class="checkbox">
                                <label>
                                 <?= form_input(['type' => 'checkbox', 'checked' => 'checked' ,'value' => $key['idmodulo'], 'name' => 'checks[]', 'required']); ?> <?= $key['nombre']; ?>
                                </label>
                               </div>
                 <?php      }
                             else {?>
                                <div class="checkbox">
                                    <label>
                                        <?= form_input(['type' => 'checkbox','value' => $key['idmodulo'], 'name' => 'checks[]', 'required']); ?> <?= $key['nombre']; ?>
                                    </label>
                                </div>
                            <?php } 
                        }
                        else
                        { ?>
                             <div class="checkbox">
                                    <label>
                                         <?= form_input(['type' => 'checkbox','value' => $key['idmodulo'], 'name' => 'checks[]', 'required']); ?> <?= $key['nombre']; ?>
                                    </label>
                                </div>
                        <?php }
                }?>
                                        <br>


                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-9 col-sm-9  offset-md-3">
                                                <button type="submit" class="btn btn-success" onclick=" return alerta();">Guardar</button>
                                                <a href="/motorepuestosjc/visualizarperfil" class="btn btn-primary">Cancelar</a>
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

<!-- Javascript functions   -->
<script type="text/javascript">
    function alerta()
    {
        var m = confirm("¿Está seguro que desea modificar este perfil?");
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
    <script src="public/vendors/validator/multifield.js"></script>
    <script src="public/vendors/validator/validator.js"></script>
    
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
