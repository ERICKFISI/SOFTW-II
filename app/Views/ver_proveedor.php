<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3> Ver  Producto</h3>
        </div>
    </div>
    <div class="col-md-3-6 ">
        <div class="x_panel">

            <div class="x_content">
              <br />
                <?= form_open('VisualizarProducto/', 'class="form-horizontal form-label-left h6" '); ?>	      
	      <fieldset disabled>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Proveedor
                        </label>
                        <div class="col-md-9 col-sm-9 ">

                            <?php if($proveedor['idtipodocumento']==1){
                                 $razon=$proveedor['nombrecomercial'];
                            }else{ $razon=$proveedor['razonsocial']; } ?>
                          <?= form_input(["type"=>"text", "class"=>"form-control", "value" => $razon, "name"=>"producto", "required"]); ?>
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

                                    <option <?= $selec ?> value="<?php echo $idtipodocumento ?>"> <?php echo $nombretipodocumento ?> 
                                    </option> <?php } ?>

                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 ">Num. Documento</label>
                        <div class="col-md-9 col-sm-9 ">
                            <select class="form-control" name="documento" id="documento" required>

                                    <option value="<?php echo $proveedor['documento'] ?>"> <?php echo $proveedor['documento'] ?> 
                                    </option>

                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 ">Direccion</label>
                        <div class="col-md-9 col-sm-9 ">
                            <select class="form-control" name="direccion" id="direccion" required>

                                    <option value="<?php echo $proveedor['direccion'] ?>"> <?php echo $proveedor['direccion'] ?> 
                                    </option>

                            </select>
                        </div>
                    </div>


		    <div class="form-group row">
		      <label class="control-label col-md-3 col-sm-3 ">Email</label>
		      <div class="col-md-9 col-sm-9">
			<?= form_input(["type"=>"email", "class"=>"form-control", "value" => $proveedor["email"], "name"=>"email", "required"]); ?>			
		      </div>
		    </div>



                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Telefono </label>
                        <div class="col-md-9 col-sm-9 ">
                            <?= form_input(["type"=>"number", "class"=>"form-control", "value"=>$proveedor["telefono_cel"], "name"=>"stock", "id"=>"stock", "required"]); ?>
                        </div>
                    </div>


		    </fieldset>
                    <br>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9  offset-md-3">
                            <a href= "<?= base_url() . "/VisualizarProveedor" ?>" class="btn btn-primary">Salir</a>
                        </div>
                    </div>

                </form>
            </div>
        </div> 
    </div> 
</div>
