<script>

 function ajax_get(nombre_perfil)
 {
     let xhttp = new XMLHttpRequest();
     xhttp.onreadystatechange = function()
     {
	 if (this.readyState == 4 && this.status == 200)
	 {
	     let perfiles = JSON.parse(this.responseText);
	     for (let i in perfiles)
	     {
		 if (perfiles[i].nombre === nombre_perfil)
		 {
		     alert("Ya existe este perfil");
		     document.getElementById("nombreperfil").value = "";
		 }
	     }
	 }
     }
     xhttp.open("GET", "registrarperfil/traerPerfiles", true);
     xhttp.send();
 }

 function verificarPerfil(entrada) // El input de nombre de perfil
 {
     ajax_get(entrada.value);
 }
 
</script>

<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Registrar Perfil</h3>
        </div>
    </div>
    <div class="col-md-3-6 ">
        <div class="x_panel">

            <div class="x_content">
                <br />
                <form class="form-horizontal form-label-left h6" action="registrarperfil/crear" method="POST">

                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Nombre del perfil
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" onchange="verificarPerfil(this)" id="nombreperfil" class="form-control" value="" name="nombreperfil" required>
                        </div>
                    </div>
                    <?php foreach ($registros as $registro): ?>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="<?php echo $registro->idmodulo; ?>" id="<?php echo $registro->idmodulo; ?>" name="checks[]"><?php echo $registro->nombre; ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                    <!--
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
                            <input type="number" class="form-control" name="dni" id="dni" maxlength="8" required oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" >
                        </div>
                    </div>

                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Telefono</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="number" class="form-control" name="telefono" id="telefono" maxlength="9" required oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                        </div>
                    </div>
                    -->
                    <br>


                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9  offset-md-3">
                            <button type="submit" class="btn btn-success">Guardar</button>
                            <a href="<?php echo base_url().'/visualizarperfil'?>" class="btn btn-primary">Cancelar</a>
                        </div>
                    </div>

                </form>
            </div>
        </div> 
    </div> 



</div>
