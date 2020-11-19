
<script src="<?= base_url().'/public/js/ajax.js'; ?>" type="text/javascript"></script>

<script>
 
 function usuario(respuesta, cadena)
 {
     let usuarios = JSON.parse(respuesta);
     for (let i in usuarios)
     {
	 if (usuarios[i].nombreusuario === cadena)
	 {
	     alert("Este nombre de usuario ya existe");
	     document.getElementById("nombreusuario").value = "";
	 }
     }
     
 }

 function verificarUsuario(entrada)
 {
     ajax_get("../visualizarusuario/traerUsuarios", entrada.value, usuario);
 }
 
</script>

<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Registrar Usuario</h3>
        </div>
    </div>
    <div class="col-md-3-6 ">
        <div class="x_panel">

            <div class="x_content">
                <br />
                <form class="form-horizontal form-label-left h6" action="../usuario/create" method="POST">

                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Nombre Usuario
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" onchange="verificarUsuario(this)" id="nombreusuario" value="" class="form-control" name="nombreusuario" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 ">Contraseña</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="password" class="form-control" name="contrasena" id="contrasena" maxlength="8" required oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                        </div>
                    </div>

                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Nombre </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" name="nombre" id="nombre" required>
                        </div>
                    </div>

                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">DNI </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" name="dni" id="dni" minlength="8" maxlength="8" required oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" >
                        </div>
                    </div>

                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Telefono</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" name="telefono" id="telefono" minlength="9" maxlength="9" required oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
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
                                    ?>

                                    <option value="<?php echo $idperfil ?>"> <?php echo $nombreperfil ?> 
                                    </option> <?php } ?>

                            </select>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9  offset-md-3">
                            <button type="submit" onclick="return alerta();" class="btn btn-success">Guardar</button>
                            <a href= "<?= base_url() . "/visualizarusuario" ?>" class="btn btn-primary">Cancelar</a>
                        </div>
                    </div>

                </form>
            </div>
        </div> 
    </div> 
</div>
<script type="text/javascript">
    function alerta()
    {
        var m = confirm("¿Está seguro que desea registrar este usuario?");
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
