<script type="text/javascript">

 function traerProducto(idproducto, funcion)
 {
     // Utilizamos AJAX para conseguir las secciones de un grado
     // en tiempo real
     var respuesta;
     var xhttp = new XMLHttpRequest();
     
     xhttp.onreadystatechange = function()
     {
	 if (xhttp.readyState == 4 && xhttp.status == 200)
	 {
	     respuesta = this.responseText;
	     if (funcion)
		 funcion(respuesta);
	 }

     };
     // Aqui enviamos los datos al servidor
     xhttp.open("POST", "../ventas/traerPrecioDeProducto", true);
     xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     xhttp.send("idproducto=" + idproducto);
 }

 function ponerPrecio()
 {
     var id_producto;

     id_producto = document.forms[0].idproducto.value;

     /* Si hay valores en los campos de cantidad y subtotal, eliminarlos
      * al cambiar de producto
      */ 
     o_cantidad = document.getElementById("cantidad");
     o_subtotal = document.getElementById("subtotal");

     if (o_cantidad.value != "" || o_subtotal.value != "")
     {
	 o_cantidad.value = "";
	 o_subtotal.value = "";
     }

     traerProducto(id_producto, function(respuesta) {
	 var producto = JSON.parse(respuesta);

	 document.getElementById("preciounidad").value = producto.preciounidad;
     });
 }

 function ponerSubtotal(cantidad)
 {
     precio = document.getElementById("preciounidad").value;
     subtotal = precio * cantidad;
     document.getElementById("subtotal").value = subtotal.toFixed(2);
 }

 var total = 0;

/* Funciones para formar la tabla, para guardar los id's de los productos
 * lo que hare sera crear un checkbox cada vez que se agregue un producto
 * de esta manera tendre los id's en $_POST["productos"], supongo que hay
 * mejores maneras de hacerlo, pero al menos functina */

 function agregarProducto()
 {
     var tbody = "";
     var cuerpo = document.getElementById("tabla").getElementsByTagName("tbody")[0];
     var nuevaFila = cuerpo.insertRow(cuerpo.rows.length);

     id_producto = document.forms[0].idproducto.value;

     traerProducto(id_producto, function(respuesta) {
	 var producto = JSON.parse(respuesta);

	 var existeProducto = document.getElementById(producto.idproducto);
	 if (existeProducto != null)
	 {
	     alert("Este producto ya esta en la tabla");
	     return;
	 }

	 o_cantidad = document.getElementById("cantidad");
	 o_subtotal = document.getElementById("subtotal");
	 o_preciounidad = document.getElementById("preciounidad");

	 tbody += "<tr>";
	 tbody += "<td>" +  o_cantidad.value + "</td>";	 
	 tbody += "<td>" +  producto.producto + "</td>";
	 tbody += "<td>" +  o_preciounidad.value + "</td>";
	 tbody += "<td>" +  o_subtotal.value + "</td>";	 
	 tbody += "<td> <input class='btn btn-warning' onclick='eliminar(" + producto.idproducto + ","+ o_subtotal.value + ", this)' type='button' value='Eliminar'> </td>";
	 tbody += "</tr>";
	 nuevaFila.innerHTML = tbody;

	 // Agregamos el total al campo de total de venta
	 total += parseFloat(o_subtotal.value);
	 document.getElementById("totalventa").value = total.toFixed(2);
	 var strong = "<strong>" + total.toFixed(2) + "</strong>";
	 document.getElementById("total").innerHTML = strong;

	 // Insertar un checkbox con los id's de los cursos
	 var check = document.createElement("input");
	 check.type = "checkbox";
	 check.id = producto.idproducto;
	 check.value = producto.idproducto;
	 check.checked = "checked";
	 check.name = "productos[]";
	 check.style = "opacity:0; position:absolute; left:9999px;"
	 document.getElementById("productos").appendChild(check); // El div

	 // Otros checkbox para las cantidades de cada producto sera del de arriba
	 check = document.createElement("input");
	 check.type = "checkbox";
	 check.value = o_cantidad.value;
	 check.checked = "checked";
	 check.name = "cantidades[]";
	 check.style = "opacity:0; position:absolute; left:9999px;"
	 document.getElementById(producto.idproducto).appendChild(check);

	 
     });
 }

 // El id del producto y el input de donde se hace click
 function eliminar(idproducto, subtotal, input)
 {
     // Eliminamos el tr (fila) de la tabla
     var fila = input.parentNode.parentNode; // LLegamos al tr
     fila.parentNode.removeChild(fila); // Del tbody eliminar el mismo tr

     // Eliminamos el id del producto para no agregarlo
     var producto = document.getElementById(idproducto);
     producto.remove();

     // Reducimos el total
     total -= parseFloat(subtotal);
     document.getElementById("totalventa").value = total.toFixed(2);
     var strong = "<strong>" + total.toFixed(2) + "</strong>";
     document.getElementById("total").innerHTML = strong;

 }

 function traerCliente(idcliente, funcion)
 {
     var respuesta;
     var xhttp = new XMLHttpRequest();
     
     xhttp.onreadystatechange = function()
     {
	 if (xhttp.readyState == 4 && xhttp.status == 200)
	 {
	     respuesta = this.responseText;
	     if (funcion)
		 funcion(respuesta);
	 }

     };
     // Aqui enviamos los datos al servidor
     xhttp.open("POST", "../ventas/traerCliente", true);
     xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     xhttp.send("idcliente=" + idcliente);
     
 }

 function ponerDocumento()
 {
     id_cliente = document.forms[0].idcliente.value;
     traerCliente(id_cliente, function(respuesta) {
	 var cliente = JSON.parse(respuesta);
	 document.getElementById("documento").value = cliente.documento;
     });
 }


</script>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Registrar Nueva Venta</h3>
        </div>
    </div>
    <div class="col-md-3-6 ">
        <div class="x_panel">
            <div class="x_content">
                <br />
                <form class="form-horizontal form-label-left h6" action="../ventas/crear" method="POST">
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Cliente
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <select onchange="ponerDocumento()" class="form-control" id="idcliente" name="idcliente" required="">
                                <option value="">Seleccione ...</option>
                                <?php
                                $html = '';
                                foreach ($clientes as $key => $value) {
                                    $html .= '<option value="' . $value['idcliente'] . '">' . $value['razonsocial'] . '</option>';
                                }
                                echo $html;
                                ?>
                            </select>
                        </div>
                    </div>



                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Documento
                        </label>
                        <div class="col-md-9 col-sm-9 ">
			    <input type="text" class="form-control" value="" id="documento" name="comprobantecompra" readonly>
                        </div>
		    </div> 


		    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Dirección Cliente
                        </label>
                        <div class="col-md-9 col-sm-9 ">
			    <input type="text" class="form-control"  id="direccioncliente" name="direccioncliente" required>
                        </div>
		    </div>           

                            <input type="hidden" value="<?= $_SESSION["idusuario"];?>" class="form-control" id="idusuario" name="idusuario" required="">

                    <div class="form-group row ">			
                        <label class="control-label col-md-3 col-sm-3 ">Tipo de Comprobante
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <select class="form-control" id="idcomprobante" name="idcomprobante" required="">
                                <option value="">Seleccione ...</option>
                                <?php
                                $html = '';
                                foreach ($comprobantes as $key => $value) {
                                    $html .= '<option value="' . $value['idcomprobante'] . '">' . $value['comprobante'] . '</option>';
                                }
                                echo $html;
                                ?>
                            </select>
                        </div>
		    </div>
            <div class="form-group row ">
                <label class="control-label col-md-3 col-sm-3 ">Número de Comprobante</label>
                        <label class="control-label col-md-2 col-sm-2 "> Serie
                        </label>
                        <div class="col-md-2 col-sm-2 ">
                            <select class="form-control" id="idseriecorrelativo" name="idseriecorrelativo" required="">
                                <option value="">Seleccione ...</option>
                            </select>
                        </div>
                        <label class="control-label col-md-2 col-sm-2 "> Correlativo
                        </label>
                        <div class="col-md-2 col-sm-2 ">
                            <input type="text" class="form-control" name="serie" id="serie" readonly >
                        </div>
            </div>
		    
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Fecha de Venta
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="date" class="form-control"  name="fechaventa" value="<?php echo date("Y-m-d"); ?>" max="<?= date("Y-m-d"); ?>" required>
                        </div>
                    </div>

                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Total de Venta en Soles
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control"  id="totalventa" name="totalventa" value="" readonly>
                        </div>
                    </div>


                    <div class="ln_solid bg-red"></div>
                    <div class="form-group row ">
                        <label class="control-label col-md-1 col-sm-1 ">Producto:</label>
                        <div class="col-md-3 col-sm-3 ">
                            <select onchange="ponerPrecio()" class="form-control" id="idproducto" name="idproducto">
                                <option value="">Seleccione ...</option>
                                <?php
                                $html = '';
                                foreach ($productos as $key => $value) {
                                    $html .= '<option value="' . $value['idproducto'] . '">' . $value['producto'] . '</option>';
                                }
                                echo $html;
                                ?>
                            </select>
                        </div>
                        <label class="control-label col-md-1 col-sm-1 ">Cantidad:</label>
                        <div class="col-md-1 col-sm-1">
                            <input type="text" onchange="ponerSubtotal(this.value)" minlength="1" maxlength="3" class="form-control" value="" id="cantidad" name="cantidad" >
                        </div>
                        <label class="control-label col-md-1 col-sm-1 ">Precio:</label>
                        <div class="col-md-1 col-sm-1">
                            <input type="text" class="form-control" value="" id="preciounidad" name="preciounidad" readonly >
                        </div>
                        <label class="control-label col-md-1 col-sm-1 ">SubTotal:</label>
                        <div class="col-md-1 col-sm-1">
                            <input type="text" class="form-control" value="" id="subtotal" name="subtotal" readonly >
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <button type="button" class="btn btn-round btn-primary" onclick="agregarProducto();"><i class="fa fa-level-down"> Agregar</i></button>
                        </div>
                    </div>
                    <div class="ln_solid bg-red"></div>
                    <table class="table table-bordered" id="tabla" style="text-align: center;">
                        <thead class="table-danger">
                            <tr>
                                <th>Cantidad</th>
                                <th>Producto</th>
                                <th>Precio Unidad</th>
                                <th>Sub Total</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
			    
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" style="text-align: right;"><strong>Total : </strong></td>
				<td id="total"> <!-- strong -->

                                </td>
				<tr>
                        </tfoot>
                    </table>

		    <div class="form-group" id="productos">

		    </div>
		    
                    <div class="form-group row">
                        <center class="col-md-12 col-sm-12  offset-md-12">
                            <button type="submit" class="btn btn-success">Guardar</button>
                            <a href="<?php echo base_url() . '/ventas' ?>" class="btn btn-primary">Cancelar</a>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div> 
</div> 
</div>
<script type="text/javascript">
    let a =  '<?php echo json_encode( $seriecomprobantes ); ?>' ;
    a = JSON.parse(a);
    let idcomprobante = document.getElementById( 'idcomprobante' );
     idcomprobante.addEventListener( 'change', function()
        {
            let seriecorrelativo = document.getElementById( 'idseriecorrelativo' );
            while(seriecorrelativo.firstChild)
            {
                seriecorrelativo.removeChild(seriecorrelativo.firstChild);
            }
            if( this.value == "1" )
            {
                let c = 0;
                a.forEach( function( valor, indice, array )
                    {
                        if( valor[ 'idcomprobante' ] == "1" && valor[ 'correlativosc' ] != "9999" )
                        {
                        console.log(valor);
                        c = c+1;
                        let option = document.createElement( 'option' );
                        option.text = valor[ 'seriesc' ];
                        option.value = valor[ 'idseriecorrelativo' ];
                        seriecorrelativo.add( option );
                        if( c == "1" )
                        {
                        let serie = document.getElementById( 'serie' );
                        serie.value = valor[ 'correlativosc' ];
                        }
                        }
                    }  );   
            }
            else if( this.value == "2" )
            {
                 let c = 0;
                 a.forEach( function( valor, indice, array )
                    {
                        if( valor[ 'idcomprobante' ] == "2" && valor[ 'correlativosc' ] != "9999" )
                        {
                        c=c+1;
                        let option = document.createElement( 'option' );
                        option.text = valor[ 'seriesc' ];
                        option.value = valor[ 'idseriecorrelativo' ];
                        seriecorrelativo.add( option );
                        let serie = document.getElementById( 'serie' );
                        if( c == "1" )
                        {
                        let serie = document.getElementById( 'serie' );
                        serie.value = valor[ 'correlativosc' ];
                        }
                        }
                    } );   
            }
        } );
     let cantid = document.getElementById( 'cantidad' );
    cantid.addEventListener( 'input', function()
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
<script type="text/javascript">
    let b =  '<?php echo json_encode( $seriecomprobantes ); ?>' ;
    b = JSON.parse(b);
    let seriecorrelativo2 = document.getElementById( 'idseriecorrelativo' );
    console.log(a);
    seriecorrelativo2.addEventListener( 'change', function()
    {
        let comprobante2 = document.getElementById( 'idcomprobante' );
        b.forEach( function( valor, indice, array )
                    {
                        if( valor[ 'idcomprobante' ] == comprobante2.value && valor[ 'idseriecorrelativo' ] == seriecorrelativo2.value )
                        {
                            let serie = document.getElementById( 'serie' );
                            serie.value = valor[ 'correlativosc' ];
                        }
                    } );   
    } );
</script>
