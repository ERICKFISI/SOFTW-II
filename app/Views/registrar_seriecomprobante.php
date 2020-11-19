
<script src="<?= base_url().'/public/js/ajax.js'; ?>" type="text/javascript"></script>

<script>
 
 function serie(respuesta, cadena)
 {
     let series = JSON.parse(respuesta);
     let idcomprobante = document.forms[0].idcomprobante.value;
	 
     for (let i in series)
     {
	 if (series[i].seriesc === cadena &&
	     series[i].idcomprobante === idcomprobante)
	 {
	     alert("Este serie ya existe");
	     document.getElementById("seriesc").value = "";
	 }
     }
 }

 function verificarSerie(entrada)
 {
     ajax_get("../serieComprobante/traerSeries", entrada.value, serie);
 }

 // Cuando se produce un cambio en el select
 function verificarSerieB()
 {
     if (document.getElementById("seriesc").value == "")
	 return;
     let serieActual = document.getElementById("seriesc").value;
     
     ajax_get("../serieComprobante/traerSeries", serieActual, serie);
 }
 
</script>




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
                <form class="form-horizontal form-label-left h6" action="<?php echo base_url().'/SerieComprobante/create' ?>" method="POST">

                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Tipo de Comprobante
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <select class="form-control" onchange="verificarSerieB()" name="idcomprobante" id="idcomprobante" required>

                                <?php
                                foreach ($comprobantes as $comprobante) {
                                    ?>

                                    <option value="<?= $comprobante[ 'idcomprobante' ] ?>"> <?= $comprobante[ 'comprobante' ] ?> 
                                    </option> <?php } ?>

                            </select>
                        </div>
                    </div>
                   <div class="form-group row">
                          <label class="control-label col-md-3 col-sm-3 " for="seriesc">Serie</label>
                          <div class="col-md-9 col-sm-9">
                            <input type="text" minlength="3" maxlength="3" value="" onchange="verificarSerie(this)" class="form-control"  id="seriesc" name="seriesc" required>
                          </div>
                    </div>
                    <div class="form-group row">
                          <label class="control-label col-md-3 col-sm-3 " for="seriesc">Correlativo</label>
                          <div class="col-md-9 col-sm-9">
                            <input type="text" class="form-control"  id="correlativosc" name="correlativosc" value="0001" readonly>            
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
        var m = confirm("¿Está seguro que desea guardar este serie de comprobante?");
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
