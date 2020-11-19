<script src="<?= base_url().'/public/js/ajax.js'; ?>" type="text/javascript"></script>

<script>
 
 function producto(respuesta, cadena)
 {
     let productos = JSON.parse(respuesta);
     for (let i in productos)
     {
	 if (productos[i].producto === cadena)
	 {
	     alert("Este nombre de producto ya existe");
	     document.getElementById("producto").value = "";
	 }
     }
 }

 function verificarProducto(entrada)
 {
     ajax_get("../producto/traerProductos", entrada.value, producto);
 }
 
</script>

<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Registrar Producto</h3>
        </div>
    </div>
    <div class="col-md-3-6 ">
        <div class="x_panel">

            <div class="x_content">
                <br />
                <form class="form-horizontal form-label-left h6" action="../producto/create" method="POST">

                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Nombre del producto
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" id="producto" value="" onchange="verificarProducto(this)" name="producto" required>
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
			<textarea class="form-control" name="descripcionproducto" id="descripcionproducto" rows="3"></textarea>			
		      </div>
		    </div>



                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Stock </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" id="stock" name="stock" minlength="1" maxlength="4" id="stock" required>
                        </div>
                    </div>

                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Precio unidad </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" id="preciounidad" name="preciounidad" minlength="1" maxlength="5" id="preciounidad" >
                        </div>
                    </div>

                    <div class="form-group row">
                      <label class="control-label col-md-3 col-sm-3 ">Elija una foto</label>
		      <div class="col-md-9 col-sm-9">
			<input type="file" class="form-control-file" accept="image/png, image/jpg, image/jpeg" name="rutafoto" id="rutafoto">			
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
        var m = confirm("¿Está seguro que desea registrar este producto?");
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
