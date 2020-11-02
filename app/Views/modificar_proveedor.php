<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3> Modificar  Proveedor</h3>
        </div>
    </div>
    <div class="col-md-3-6 ">
        <div class="x_panel">

            <div class="x_content">
              <br />
                <?= form_open('VisualizarProveedor/update/' . $proveedor['idproveedor'], 'class="form-horizontal form-label-left h6" '); ?>	      

                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Proveedor
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <?php if($proveedor['idtipodocumento']==1){
                                 $razon=$proveedor['nombrecomercial'];
                            }else{ $razon=$proveedor['razonsocial']; } ?>
                          <?= form_input(["type"=>"text", "class"=>"form-control", "value" => $razon, "name"=>"proveedor", "required"]); ?>
                        </div>
                    </div>


                    <div class="form-group row">
                      <label class="control-label col-md-3 col-sm-3 ">Documento</label>
                        <div class="col-md-9 col-sm-9 ">
                            <select class="form-control" name="idtipodocumento" id="idtipodocumento" required>

                                <?php
                                foreach ($tipodocumento as $td) {

                                    $nombretipodocumento = $td['tipodocumento'];
                                    $idtipodocumento = $td['idtipodocumento'];
                                    ?>

                                    <option selected="selected" value="<?php echo $idtipodocumento ?>"> <?php echo $nombretipodocumento ?> 
                                    </option> <?php } ?>

                            </select>
                        </div>
                    </div>


		    <div class="form-group row">
		      <label class="control-label col-md-3 col-sm-3 ">Num. Documento</label>
		      <div class="col-md-9 col-sm-9">	
            <?= form_input(["type"=>"number", "class"=>"form-control", "value" => $proveedor["documento"], "name"=>"documento", "required"]); ?>		
		      </div>
		    </div>



                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Direccion </label>
                        <div class="col-md-9 col-sm-9 ">
                            <?= form_input(["type"=>"text", "class"=>"form-control", "value"=>$proveedor["direccion"], "name"=>"direccion", "id"=>"direccion", "required"]); ?>
                        </div>
                    </div>

                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Email </label>
                        <div class="col-md-9 col-sm-9 ">
                            <?= form_input(["type"=>"email", "class"=>"form-control", "value"=>$proveedor["email"], "name"=>"email", "id"=>"email"]); ?>
                        </div>
                    </div>

            <div class="form-group row">
              <label class="control-label col-md-3 col-sm-3 ">Telefono</label>
              <div class="col-md-9 col-sm-9">   
            <?= form_input(["type"=>"text", "class"=>"form-control", "value" => $proveedor["telefono_cel"], "name"=>"telefono_cel", "required"]); ?>        
              </div>
            </div>


                    <br>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9  offset-md-3">
                            <button type="submit" onclick="return alerta();" class="btn btn-success">Guardar</button>
                            <a href= "<?= base_url() . "/VisualizarProveedor" ?>" class="btn btn-primary">Cancelar</a>
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
        var m = confirm("¿Está seguro que desea modificar este proveedor?");
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