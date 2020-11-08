<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Registrar Serie de Comprobante</h3>
        </div>
    </div>
    <div class="col-md-3-6 ">
        <div class="x_panel">

            <div class="x_content">
                <br />
                <form class="form-horizontal form-label-left h6" action="<?php echo base_url().'/SerieComprobante/update/'.$seriecomprobante[ 'idseriecorrelativo' ] ?>" method="POST">

                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Tipo de Comprobante
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <select class="form-control" name="idcomprobante" id="idcomprobante" required>

                                <?php
                                foreach ($comprobantes as $comprobante) {
                                    if( $comprobante[ 'idcomprobante' ] == $seriecomprobante[ 'idcomprobante' ] )
                                        {  ?>
                                    <option selected value="<?= $comprobante[ 'idcomprobante' ] ?>"> <?= $comprobante[ 'comprobante' ] ?> 
                                    </option> 
                                <?php   }
                                        else
                                        { ?>
                                            <option value="<?= $comprobante[ 'idcomprobante' ] ?>"> <?= $comprobante[ 'comprobante' ] ?> 
                                    </option> <?php } ?>
                                <?php   } ?>

                                    

                            </select>
                        </div>
                    </div>
                   <div class="form-group row">
                          <label class="control-label col-md-3 col-sm-3 " for="seriesc">Serie</label>
                          <div class="col-md-9 col-sm-9">
                            <input type="text" minlength="3" maxlength="3" class="form-control"  id="seriesc" name="seriesc" value="<?= $seriecomprobante[ 'seriesc' ] ?>" required>            
                          </div>
                    </div>
                    <div class="form-group row">
                          <label class="control-label col-md-3 col-sm-3 " for="seriesc">Correlativo</label>
                          <div class="col-md-9 col-sm-9">
                            <input type="text" class="form-control"  id="correlativosc" name="correlativosc" value="<?= $seriecomprobante[ 'correlativosc' ] ?>" readonly>            
                          </div>
                    </div>
                    <br>


                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9  offset-md-3">
                            <button type="submit" onclick="return alerta();" class="btn btn-success">Guardar</button>
                            <a href="<?php echo base_url().'/SerieComprobante'?>" class="btn btn-primary">Cancelar</a>
                        </div>
                    </div>

                </form>
            </div>
        </div> 
    </div> 
</div>
<script>
    let seriesc = document.getElementById( 'seriesc' );
    seriesc.addEventListener( 'input', function()
        {
            if( this.value < 0 )
            {
                this.value = null;
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
        var m = confirm("¿Está seguro que desea modificar este serie de comprobante?");
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