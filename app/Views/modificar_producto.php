<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3> Modificar  Producto</h3>
        </div>
    </div>
    <div class="col-md-3-6 ">
        <div class="x_panel">

            <div class="x_content">
              <br />
                <?= form_open('VisualizarProducto/update/' . $producto['idproducto'], 'class="form-horizontal form-label-left h6" '); ?>	      

                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Nombre del producto
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                          <?= form_input(["type"=>"text", "class"=>"form-control", "value" => $producto["producto"], "name"=>"producto", "required"]); ?>
                        </div>
                    </div>


                    <div class="form-group row">
                      <label class="control-label col-md-3 col-sm-3 ">Categor&iacute;a</label>
                        <div class="col-md-9 col-sm-9 ">
                            <select class="form-control" name="idcategoria" id="idcategoria" required>

                                <?php
                                foreach ($categorias as $categoria) {
                                    $nombrecategoria = $categoria['categoria'];
                                    $idcategoria = $categoria['idcategoria'];
                                    ?>

                                    <option value="<?php echo $idcategoria ?>"> <?php echo $nombrecategoria ?> 
                                    </option> <?php } ?>

                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 ">Marca o linea</label>
                        <div class="col-md-9 col-sm-9 ">
                            <select class="form-control" name="idmarca" id="idmarca" required>

                                <?php
                                foreach ($marcas as $marca) {
                                    $nombremarca = $marca['marca'];
                                    $idmarca = $marca['idmarca'];
                                    ?>

                                    <option value="<?php echo $idmarca ?>"> <?php echo $nombremarca ?> 
                                    </option> <?php } ?>

                            </select>
                        </div>
                    </div>


		    <div class="form-group row">
		      <label class="control-label col-md-3 col-sm-3 ">Descripci&oacute;n del producto</label>
		      <div class="col-md-9 col-sm-9">
			<?= form_input(["class "=> "form-control","value" => $producto["descripcionproducto"], "name" => "descripcionproducto", "id" => "descripcionproducto", "rows" =>"3"]); ?>			
		      </div>
		    </div>



                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Stock </label>
                        <div class="col-md-9 col-sm-9 ">
                            <?= form_input(["type"=>"number", "class"=>"form-control", "value"=>$producto["stock"], "name"=>"stock", "id"=>"stock", "required"]); ?>
                        </div>
                    </div>

                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Precio unidad </label>
                        <div class="col-md-9 col-sm-9 ">
                            <?= form_input(["type"=>"number", "class"=>"form-control", "value"=>$producto["preciounidad"], "name"=>"preciounidad", "id"=>"preciounidad"]); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                      <label class="control-label col-md-3 col-sm-3 ">Elija una foto</label>
		      <div class="col-md-9 col-sm-9">
			<?= form_input(["type"=>"file", "class"=>"form-control-file", "value"=>$producto["rutafoto"], "name"=>"rutafoto", "id"=>"rutafoto"]); ?>			
		      </div>
                    </div>

                    <br>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9  offset-md-3">
                            <a href= "<?= base_url() . "/VisualizarProducto" ?>" class="btn btn-primary">Cancelar</a>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </div>

                </form>
            </div>
        </div> 
    </div> 
</div>
