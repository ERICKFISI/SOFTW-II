<script>
    $(document).ready(function () {
        $('#idproducto').select2();
        $('#idproducto').change(function () {
            $.post('../ingreso/getPrecioThisProducto', 'idproducto=' + $(this).val(), function (data) {
                if (data.resp == 1) {
                    $("#preciounidad").val(data.msg.preciounidad);
                }
            }, 'json');
            return false;
        });
        $("#cantidad, #idproducto").change(function () {
            if ($("#cantidad").val() != "") {
                $("#subtotal").val(eval($(this).val()) * eval($("#preciounidad").val()));
            }

        });
        formar_tabla = function (data) {
            $("#tabla_carrito tbody").html('');
            var html = '';
            if (data.msg == '') {
                html += '<td colspan="5">No se ha agregado productos</td>';
            } else {
                $.each(data.msg, function (key, val) {
                    html += '<tr>';
                    html += '<td>' + val.cantidad + ' Unid</td>';
                    html += '<td>' + val.descripcion_producto + '</td>';
                    html += '<td>' + eval(val.preciounidad).toFixed(2) + '</td>';
                    html += '<td>' + eval(val.subtotal).toFixed(2) + '</td>';
                    html += '<td><button class="btn btn-round btn-warning" type ="button" onclick="eliminar(' + key + ')">Eliminar</button></td>';

                    html += '</tr>';
                });
            }

            $("#tabla_carrito tbody").html(html);
            $("#total").html(data.total.toFixed(2));
            $("#totalingreso").val(data.total.toFixed(2));
        };
        agregarProductoCarrito = function () {
            idproducto = $("#idproducto").val();
            if ($("#cantidad").val() == "") {
                alert("asigne una cantidad para agregar al Carrito");
                return false;
            }
            $.post('../ingreso/verificarProductoEnCarrito', 'idproducto=' + idproducto, function (dt) {
                if (dt.resp == 1) {
                    var r = confirm(dt.msg);
                    if (r == true) {
                        agregarProducto();
                    }
                } else {
                    agregarProducto();
                }
            }, 'json');

        };
        agregarProducto = function () {
            idproducto = $("#idproducto").val();
            descripcion_producto = $("#idproducto option:selected").text();
            cantidad = $("#cantidad").val();
            preciounidad = $("#preciounidad").val();
            subtotal = $("#subtotal").val();
            $.post('../ingreso/setProductoAlCarrito', 'idproducto=' + idproducto + '&cantidad=' + cantidad
                    + '&preciounidad=' + preciounidad + '&subtotal=' + subtotal + '&descripcion_producto=' + descripcion_producto, function (data) {
                        formar_tabla(data);
                    }, 'json');
        };
        eliminar = function (id) {
            $.post('../ingreso/eliminarProductoAlCarrito', 'idproducto=' + id, function (data) {
                if (data.resp == 1) {
                    formar_tabla(data);
                }
            }, 'json');
        };
    });

</script>
<?php
$total = 0;
if (isset($_SESSION['add_carro2'])) {

    foreach ($_SESSION['add_carro2'] as $key => $value) {
        $total += $value['subtotal'];
    }
}
?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Registrar Ingreso de Almacén</h3>
        </div>
    </div>
    <div class="col-md-3-6 ">
        <div class="x_panel">
            <div class="x_content">
                <br />
                <form class="form-horizontal form-label-left h6" action="../ingreso/create" method="POST">
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Tipo Ingreso
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <select class="form-control" id="idtipoingreso" name="idtipoingreso" required="">
                                <option value="">Seleccione ...</option>
                                <?php
                                $html = '';
                                foreach ($tipoingreso as $key => $value) {
                                    $html .= '<option value="' . $value['idtipoingreso'] . '">' . $value['tipoingreso'] . '</option>';
                                }
                                echo $html;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Fecha Ingreso
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="datetime-local" class="form-control"  name="fechaingreso" value="<?php echo date("Y-m-d")."T".date("H:i");?>" required>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Total Soles Ingreso S/.
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control"  id="totalingreso" name="totalingreso" value="<?php echo  number_format($total, 2);?>" disabled="disbled">
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Descripcion Ingreso
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control"  id="descripcioningreso" name="descripcioningreso" required>
                        </div>
                    </div>           
                    <div class="ln_solid bg-red"></div>
                    <div class="form-group row ">
                        <label class="control-label col-md-1 col-sm-1 ">Producto:</label>
                        <div class="col-md-3 col-sm-3 ">
                            <select class="form-control" id="idproducto" name="idproducto">
                                <option value="">Seleccione ...</option>
                                <?php
                                $html = '';
                                foreach ($producto as $key => $value) {
                                    $html .= '<option value="' . $value['idproducto'] . '">' . $value['producto'] . '</option>';
                                }
                                echo $html;
                                ?>
                            </select>
                        </div>
                        <label class="control-label col-md-1 col-sm-1 ">Cantidad:</label>
                        <div class="col-md-1 col-sm-1">
                            <input type="text" class="form-control"  id="cantidad" name="cantidad" >
                        </div>
                        <label class="control-label col-md-1 col-sm-1 ">Precio:</label>
                        <div class="col-md-1 col-sm-1">
                            <input type="text" class="form-control"  id="preciounidad" name="preciounidad" >
                        </div>
                        <label class="control-label col-md-1 col-sm-1 ">SubTotal:</label>
                        <div class="col-md-1 col-sm-1">
                            <input type="text" class="form-control"  id="subtotal" name="subtotal" >
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <button type="button" class="btn btn-round btn-primary" onclick="agregarProductoCarrito();"><i class="fa fa-level-down"> Agregar</i></button>
                        </div>
                    </div>
                    <div class="ln_solid bg-red"></div>
                    <table class="table table-bordered" id="tabla_carrito" style="text-align: center;">
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
                            <?php
                            $html = '';
                            if (isset($_SESSION['add_carro2'])) {
                                foreach ($_SESSION['add_carro2'] as $key => $value) {
                                    $html .= '<tr>';
                                    $html .= '<td>' . $value['cantidad'] . ' Unid</td>';
                                    $html .= '<td>' . $value['descripcion_producto'] . '</td>';
                                    $html .= '<td>' . number_format($value['preciounidad'],2) . '</td>';
                                    $html .= '<td>' . number_format($value['subtotal'],2) . '</td>';
                                    $html .= '<td><button class="btn btn-round btn-warning" type ="button" onclick="eliminar(' . $key . ')">Eliminar</button></td>';
                                    $html .='</tr>';
                                }
                            } else {
                                $html .= '<tr><td colspan="5">No se ha agregado productos</td> </tr>';
                            }
                            echo $html;
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" style="text-align: right;"><strong>Total : </strong></td>
                                <td id="total">
                                    <strong>
                                        <?php echo number_format($total,2); ?>
                                    </strong>
                                </td>
                            <tr>
                        </tfoot>
                    </table>
                    <div class="form-group row">
                        <center class="col-md-12 col-sm-12  offset-md-12">
                            <button type="submit" class="btn btn-success">Guardar</button>
                            <a href="<?php echo base_url() . '/ingreso' ?>" class="btn btn-primary">Cancelar</a>
                        </center>
                    </div>

                </form>
            </div>
        </div>
    </div> 
</div> 
</div>
