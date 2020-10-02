<script>
    $(document).ready(function () {
        $('#idproducto').select2();
        $('#idproducto').change(function () {
            $.post('../salida/getPrecioThisProducto', 'idproducto=' + $(this).val(), function (data) {
                if (data.resp == 1) {
                    $("#preciounidad").val(data.msg.preciounidad);
                }
            }, 'json');
            return false;
        });
        $("#cantidad").change(function () {
            $("#subtotal").val(eval($(this).val()) * eval($("#preciounidad").val()));
        });
        agregarProductoCarrito = function () {
            idproducto = $("#idproducto").val();
            descripcion_producto = $("#idproducto option:selected").text();
            cantidad = $("#cantidad").val();
            preciounidad = $("#preciounidad").val();
            subtotal = $("#subtotal").val();
            $.post('../salida/setProductoAlCarrito', 'idproducto=' + idproducto + '&cantidad=' + cantidad
                    + '&preciounidad=' + preciounidad + '&subtotal=' + subtotal + '&descripcion_producto=' + descripcion_producto, function (data) {
                        $("#tabla_carrito").html();
                        var html = '';
                        $.each(data, function (key, val) {
                            html += '<tr>';
                            html += '<td>' + val.cantidad + '</td>';
                            html += '<td>' + val.descripcion_producto + '</td>';
                            html += '<td>' + val.preciounidad + '</td>';
                            html += '<td>' + val.subtotal + '</td>';
                            html += '<td><button class="btn btn-round btn-warning">Eliminar</button></td>';

                            html += '</tr>';
                        });
                        $("#tabla_carrito tbody").html(html);
                    }, 'json');
        };
    });

</script>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Registrar Salida de Almacén</h3>
        </div>
    </div>
    <div class="col-md-3-6 ">
        <div class="x_panel">
            <div class="x_content">
                <br />
                <form class="form-horizontal form-label-left h6" action="salida/create" method="POST">
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Tipo Salida
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <select class="form-control" id="idtiposalida" name="idtiposalida">
                                <option value="">Seleccione ...</option>
                                <?php
                                $html = '';
                                foreach ($tiposalida as $key => $value) {
                                    $html .= '<option value="' . $value['idtiposalida'] . '">' . $value['tiposalida'] . '</option>';
                                }
                                echo $html;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Fecha Salida
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="datetime-local" class="form-control"  name="fechasalida" required>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Total Soles Salida
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control"  id="totalsalida" name="totalsalida" required>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Descripcion Salida
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control"  id="descripcionsalida" name="descripcionsalida" required>
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
                        <div class="col-md-1 col-sm-1">
                            <button type="button" class="btn btn-round btn-primary" onclick="agregarProductoCarrito();">Agregar</button>
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
                            <tr>
                                <td colspan="4">No se ha agregado productos</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group row">
                        <center class="col-md-12 col-sm-12  offset-md-12">
                            <a href="<?php echo base_url() . '/salida' ?>" class="btn btn-primary">Cancelar</a>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </center>
                    </div>

                </form>
            </div>
        </div>
    </div> 
</div> 
</div>
