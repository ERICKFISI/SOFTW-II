<script>
 function verificarProducto_2(entrada)
 {
     let productos = <?= $tproductos; ?>;
     let productoActual = entrada.value;

     for (i in productos)
     {
	 if (productos[i]["producto"] === productoActual)
	 {
	     alert("Este producto ya existe");
	     document.getElementById("producto").value = "";
	 }
     }
 }
</script>


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
              <?= form_open('VisualizarProducto/update/' . $producto['idproducto'], 'class="form-horizontal form-label-left h6", enctype="multipart/form-data", method="post"'); ?>

                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Nombre del producto
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <?= form_input(["type"=>"text", "class"=>"form-control", "value" => $producto["producto"], "name"=>"producto", "id" => "producto", "onchange" => "verificarProducto_2(this)", "required"]); ?>
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
                        <label class="control-label col-md-3 col-sm-3 ">Marca</label>
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
                        <label class="control-label col-md-3 col-sm-3 ">Linea</label>
                        <div class="col-md-9 col-sm-9 ">
                            <select class="form-control" name="idlinea" id="idlinea" required>

                                <?php
                                foreach ($lineas as $linea) {
                                    $nombrelinea = $linea['linea'];
                                    $idlinea = $linea['idlinea'];
                                    ?>

                                    <option value="<?php echo $idlinea ?>"> <?php echo $nombrelinea ?> 
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
                            <?= form_input(["type"=>"text", "class"=>"form-control", "value"=>$producto["stock"], "name"=>"stock", "id"=>"stock",'maxlength' => '4', "required"]); ?>
                        </div>
                    </div>

                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Precio unidad </label>
                        <div class="col-md-9 col-sm-9 ">
                            <?= form_input(["type"=>"text", "class"=>"form-control", "value"=>$producto["preciounidad"], "name"=>"preciounidad", 'maxlength' => '5',"id"=>"preciounidad"]); ?>
                        </div>
                    </div>

                    <div class="form-group row">
                      <label class="control-label col-md-3 col-sm-3 ">Elija una foto</label>
		      <div class="col-md-9 col-sm-9">
			<?= form_input(["type"=>"file", "class"=>"form-control-file", "name"=>"rutafoto", "id"=>"rutafoto"]); ?>			
		      </div>
                    </div>

                    <br>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9  offset-md-3">
                            <button type="submit" onclick="return alerta();" class="btn btn-success">Guardar</button>
                            <a href= "<?= base_url() . "/VisualizarProducto" ?>" class="btn btn-primary">Cancelar</a>
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
        var m = confirm("¿Está seguro que desea modificar este producto?");
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
    let stock = document.getElementById( 'stock' );
    stock.addEventListener( 'input', function()
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
    let preciounidad = document.getElementById( 'preciounidad' );
    preciounidad.addEventListener( 'input', function()
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
