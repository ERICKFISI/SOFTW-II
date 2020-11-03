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
                <form class="form-horizontal form-label-left h6" >
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Tipo Salida
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <select class="form-control" id="idtiposalida" name="idtiposalida" readonly>
                                <option value=""><?= $salida["tiposalida"]; ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Fecha
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" value="<?= $salida["fechasalida"]; ?>"  id="descripcionsalida" name="descripcionsalida" readonly>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Total de Salida en Soles (S/.)
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control"  id="totalsalida" name="totalsalida" value="<?= $salida["totalsalida"]; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Descripción
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" value="<?= $salida["descripcionsalida"]; ?>"  id="descripcionsalida" name="descripcionsalida" readonly>
                        </div>
                    </div>          
                    <div class="ln_solid bg-red"></div>
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
                            <?php $total = 0; foreach ($detalles as $detalle): ?>
				<tr>
				<td> <?= $detalle["cantidadsalida"]; ?> </td>
				<td> <?= $detalle["producto"]; ?> </td>
				<td> <?= $detalle["preciounidad"]; ?> </td>
				<td> <?= $detalle["subtotal"]; ?> </td>
				<td><button class="btn btn-round btn-warning" type ="button" disabled>Eliminar</button></td>
				</tr>
				<?php $total += $detalle["subtotal"]; endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" style="text-align: right;"><strong>Total : </strong></td>
                                <td id="total">
                                    <strong>
					<?= number_format($total, 2); ?>
                                    </strong>
                                </td>
				<tr>
                        </tfoot>
                    </table>
                    <div class="form-group row">
                        <center class="col-md-12 col-sm-12  offset-md-12">
                            <a href="<?php echo base_url() . '/salida' ?>" class="btn btn-primary">Aceptar</a>
                        </center>
                    </div>

                </form>
            </div>
        </div>
    </div> 
</div> 
</div>
