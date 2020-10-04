<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Modificar Marca</h3>
        </div>
    </div>
    <div class="col-md-3-6 ">
        <div class="x_panel">

            <div class="x_content">
                <br />
                <?= form_open('VisualizarMarca/update/' . $marca['idmarca'], 'class="form-horizontal form-label-left h6" '); ?> 

                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Nombre de la marca
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" value="<?php echo $marca['marca']; ?>" class="form-control" name="marca" required>
                        </div>
                    </div>


                    <br>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9  offset-md-3">
                            <a href= "<?= base_url() . "/VisualizarMarca" ?>" class="btn btn-primary">Cancelar</a>
                            <button type="submit" class="btn btn-success" onclick="return alerta();">Guardar</button>
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