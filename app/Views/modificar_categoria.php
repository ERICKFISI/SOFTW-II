<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Modificar Categoría</h3>
        </div>
    </div>
    <div class="col-md-3-6 ">
        <div class="x_panel">

            <div class="x_content">
                <br />
                <form class="form-horizontal form-label-left h6" action="<?php echo base_url().'/visualizarcategoria/update/'.$categoria['idcategoria']?>" method="POST">

                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Nombre de categoría
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" value="<?= $categoria['categoria'] ?>" name="categoria" required>
                        </div>
                    </div>
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
                            <button type="submit" class="btn btn-success" onclick="return alerta();">Guardar</button>
                            <a href="<?php echo base_url().'/visualizarcategoria'?>" class="btn btn-primary">Cancelar</a>
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
        var m = confirm("¿Está seguro que desea modificar esta marca?");
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